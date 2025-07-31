<?php

namespace App\Http\Controllers;

use App\Models\Sabbatical;
use App\Models\User;
use App\Mail\SabbaticalApprovedMail;
use App\Mail\SabbaticalRejectedMail;
use App\Mail\SabbaticalStatusChangedMail;
use App\Mail\SabbaticalCreatedMail;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Mail;

class SabbaticalController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        // Update statuses for all sabbaticals
        Sabbatical::all()->each(function ($sabbatical) {
            $sabbatical->updateStatus();
        });

        $sabbaticals = Sabbatical::with(['doctor'])
            ->when(auth()->user()->isDoctor(), function ($query) {
                return $query->where('user_id', auth()->id());
            })
            ->latest()
            ->paginate(10);

        return view('sabbaticals.index', compact('sabbaticals'));
    }

    /**
     * Display a listing of active sabbaticals.
     */
    public function active(): View
    {
        // Update statuses for all sabbaticals
        Sabbatical::all()->each(function ($sabbatical) {
            $sabbatical->updateStatus();
        });

        $sabbaticals = Sabbatical::with(['doctor'])
            ->where('status', 'active')
            ->when(auth()->user()->isDoctor(), function ($query) {
                return $query->where('user_id', auth()->id());
            })
            ->latest()
            ->paginate(10);

        return view('sabbaticals.index', compact('sabbaticals'));
    }

    /**
     * Display a listing of upcoming sabbaticals.
     */
    public function upcoming(): View
    {
        // Update statuses for all sabbaticals
        Sabbatical::all()->each(function ($sabbatical) {
            $sabbatical->updateStatus();
        });

        $sabbaticals = Sabbatical::with(['doctor'])
            ->where('status', 'upcoming')
            ->when(auth()->user()->isDoctor(), function ($query) {
                return $query->where('user_id', auth()->id());
            })
            ->latest()
            ->paginate(10);

        return view('sabbaticals.index', compact('sabbaticals'));
    }

    /**
     * Display a listing of completed sabbaticals.
     */
    public function completed(): View
    {
        // Update statuses for all sabbaticals
        Sabbatical::all()->each(function ($sabbatical) {
            $sabbatical->updateStatus();
        });

        $sabbaticals = Sabbatical::with(['doctor'])
            ->where('status', 'completed')
            ->when(auth()->user()->isDoctor(), function ($query) {
                return $query->where('user_id', auth()->id());
            })
            ->latest()
            ->paginate(10);

        return view('sabbaticals.index', compact('sabbaticals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $this->authorize('create', Sabbatical::class);

        $doctors = User::where('role', 'doctor')->get();
        $updateFrequencies = [
            'weekly' => 'Weekly',
            'monthly' => 'Monthly',
            'quarterly' => 'Quarterly',
        ];

        return view('sabbaticals.create', compact('doctors', 'updateFrequencies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $this->authorize('create', Sabbatical::class);

        $validated = $request->validate([
            'user_id' => auth()->user()->isAdmin() ? 'required|exists:users,id' : 'nullable',
            'destination' => 'required|string|max:255',
            'purpose' => 'required|string|max:1000',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'update_frequency' => 'required|in:weekly,monthly,quarterly',
        ]);

        // If doctor is creating, set user_id to their own ID
        if (auth()->user()->isDoctor()) {
            $validated['user_id'] = auth()->id();
            $validated['approval_status'] = 'pending'; // Doctor requests need approval
        } else {
            $validated['approval_status'] = 'approved'; // Admin creates are auto-approved
        }

        $validated['status'] = 'upcoming';

        $sabbatical = Sabbatical::create($validated);

        // Send email notification to the doctor
        Mail::to($sabbatical->doctor->email)->send(new SabbaticalCreatedMail($sabbatical));

        return redirect()->route('sabbaticals.index')
            ->with('success', auth()->user()->isDoctor() 
                ? 'Sabbatical request submitted successfully! Awaiting approval. Email notification sent.' 
                : 'Sabbatical created successfully! Email notification sent.');
    }

    /**
     * Display the specified resource.
     */
    public function show($sabbatical_id): View
    {
        $sabbatical = Sabbatical::with(['doctor', 'progressReports.doctor'])->findOrFail($sabbatical_id);
        
        // Automatically update status based on current date
        $sabbatical->updateStatus();
        
        $this->authorize('view', $sabbatical);

        return view('sabbaticals.show', compact('sabbatical'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($sabbatical_id): View
    {
        $sabbatical = Sabbatical::findOrFail($sabbatical_id);
        
        $this->authorize('update', $sabbatical);

        $doctors = User::where('role', 'doctor')->get();
        $updateFrequencies = [
            'weekly' => 'Weekly',
            'monthly' => 'Monthly',
            'quarterly' => 'Quarterly',
        ];

        return view('sabbaticals.edit', compact('sabbatical', 'doctors', 'updateFrequencies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $sabbatical_id): RedirectResponse
    {
        $sabbatical = Sabbatical::findOrFail($sabbatical_id);
        
        $this->authorize('update', $sabbatical);

        $validated = $request->validate([
            'user_id' => auth()->user()->isAdmin() ? 'required|exists:users,id' : 'nullable',
            'destination' => 'required|string|max:255',
            'purpose' => 'required|string|max:1000',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'update_frequency' => 'required|in:weekly,monthly,quarterly',
            'status' => auth()->user()->isAdmin() ? 'required|in:upcoming,active,completed' : 'nullable',
        ]);

        // If doctor is updating, ensure they can't change user_id or status
        if (auth()->user()->isDoctor()) {
            $validated['user_id'] = auth()->id();
            $validated['status'] = $sabbatical->status; // Keep existing status
        }

        // Store old status for comparison
        $oldStatus = $sabbatical->status;

        $sabbatical->update($validated);

        // Send email notification if status changed (admin only)
        if (auth()->user()->isAdmin() && $oldStatus !== $validated['status']) {
            Mail::to($sabbatical->doctor->email)->send(new SabbaticalStatusChangedMail($sabbatical, $oldStatus, $validated['status']));
        }

        return redirect()->route('sabbaticals.index')
            ->with('success', 'Sabbatical updated successfully!' . (auth()->user()->isAdmin() && $oldStatus !== $validated['status'] ? ' Email notification sent.' : ''));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($sabbatical_id): RedirectResponse
    {
        $sabbatical = Sabbatical::findOrFail($sabbatical_id);
        
        $this->authorize('delete', $sabbatical);

        $sabbatical->delete();

        return redirect()->route('sabbaticals.index')
            ->with('success', 'Sabbatical deleted successfully!');
    }

    /**
     * Approve a sabbatical request.
     */
    public function approve($sabbatical_id): RedirectResponse
    {
        $sabbatical = Sabbatical::findOrFail($sabbatical_id);
        
        $this->authorize('approve', $sabbatical);

        $sabbatical->approve(auth()->id());
        $sabbatical->updateStatus(); // Update status after approval

        // Send email notification to the doctor
        Mail::to($sabbatical->doctor->email)->send(new SabbaticalApprovedMail($sabbatical));

        return redirect()->route('sabbaticals.index')
            ->with('success', 'Sabbatical approved successfully! Email notification sent.');
    }

    /**
     * Reject a sabbatical request.
     */
    public function reject(Request $request, $sabbatical_id): RedirectResponse
    {
        $sabbatical = Sabbatical::findOrFail($sabbatical_id);
        
        $this->authorize('approve', $sabbatical);

        $validated = $request->validate([
            'rejection_reason' => 'required|string|max:500',
        ]);

        $sabbatical->reject(auth()->id(), $validated['rejection_reason']);

        // Send email notification to the doctor
        Mail::to($sabbatical->doctor->email)->send(new SabbaticalRejectedMail($sabbatical));

        return redirect()->route('sabbaticals.index')
            ->with('success', 'Sabbatical rejected successfully! Email notification sent.');
    }
} 