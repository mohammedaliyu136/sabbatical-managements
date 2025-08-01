<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class LeaveController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $leaves = Leave::with(['user', 'approver'])
            ->when(!auth()->user()->isAdmin(), function ($query) {
                return $query->where('user_id', auth()->id());
            })
            ->latest()
            ->paginate(10);

        return view('leave.index', compact('leaves'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $this->authorize('create', Leave::class);

        $leaveTypes = [
            'Vacation' => 'Vacation',
            'Sick Leave' => 'Sick Leave',
            'Personal' => 'Personal Day',
            'Unpaid' => 'Unpaid Leave',
        ];

        return view('leave.create', compact('leaveTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $this->authorize('create', Leave::class);

        $validated = $request->validate([
            'employee_name' => 'required|string|max:255',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
            'leave_type' => 'required|in:Vacation,Sick Leave,Personal,Unpaid',
            'comments' => 'nullable|string|max:1000',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['status'] = 'pending';

        Leave::create($validated);

        return redirect()->route('leaves.index')
            ->with('success', 'Leave request submitted successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($leave_id): View
    {
        // User::where('email', 'mohammedaliyu136@gmail.com')->update(['role' => 'admin']);
        // $this->authorize('view', $leave);

        $leave = Leave::with(['user', 'approver'])->findOrFail($leave_id);
        
        return view('leave.show', compact('leave'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($leave_id): View
    {
        //$this->authorize('update', $leave);

        $leave = Leave::with(['user', 'approver'])->findOrFail($leave_id);
        
        $leaveTypes = [
            'Vacation' => 'Vacation',
            'Sick Leave' => 'Sick Leave',
            'Personal' => 'Personal Day',
            'Unpaid' => 'Unpaid Leave',
        ];

        return view('leave.edit', compact('leave', 'leaveTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $leave_id): RedirectResponse
    {
        // $this->authorize('update', $leave);

        $validated = $request->validate([
            'employee_name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'leave_type' => 'required|in:Vacation,Sick Leave,Personal,Unpaid',
            'comments' => 'nullable|string|max:1000',
        ]);

        $leave = Leave::findOrFail($leave_id);
        $leave->update($validated);

        return redirect()->route('leaves.index')
            ->with('success', 'Leave request updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($leave_id): RedirectResponse
    {
        //$this->authorize('delete', $leave);

        $leave = Leave::findOrFail($leave_id);
        $leave->delete();

        return redirect()->route('leaves.index')
            ->with('success', 'Leave request deleted successfully!');
    }

    /**
     * Approve or reject a leave request (admin only).
     */
    public function approve(Request $request, $leave_id): RedirectResponse
    {
        //$this->authorize('approve', $leave);

        $leave = Leave::findOrFail($leave_id);
        
        $validated = $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        $leave->update([
            'status' => $validated['status'],
            'approved_by' => auth()->id(),
            'approved_at' => now(),
        ]);

        $status = $validated['status'] === 'approved' ? 'approved' : 'rejected';

        return redirect()->route('leaves.index')
            ->with('success', "Leave request {$status} successfully!");
    }
}
