<?php

namespace App\Http\Controllers;

use App\Models\ProgressReport;
use App\Models\Sabbatical;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProgressReportController extends Controller
{
    use AuthorizesRequests;

    /**
     * Store a newly created progress report.
     */
    public function store(Request $request, $sabbatical_id): RedirectResponse
    {
        $sabbatical = Sabbatical::findOrFail($sabbatical_id);
        
        $this->authorize('submitReport', $sabbatical);

        $validated = $request->validate([
            'content' => 'required|string|max:2000',
            'report_date' => 'required|date|before_or_equal:today',
        ]);

        $validated['sabbatical_id'] = $sabbatical_id;
        $validated['user_id'] = auth()->id();

        ProgressReport::create($validated);

        return redirect()->route('sabbaticals.show', $sabbatical)
            ->with('success', 'Progress report submitted successfully!');
    }

    /**
     * Remove the specified progress report.
     */
    public function destroy($sabbatical_id, $report_id): RedirectResponse
    {
        $report = ProgressReport::findOrFail($report_id);
        
        $this->authorize('delete', $report);

        $report->delete();

        return redirect()->route('sabbaticals.show', $sabbatical_id)
            ->with('success', 'Progress report deleted successfully!');
    }
} 