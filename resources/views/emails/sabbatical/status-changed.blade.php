<x-mail::message>
# Sabbatical Status Updated 📊

Dear **{{ $sabbatical->doctor->name }}**,

Your sabbatical status has been updated by the administration. Here are the details:

## 📋 Sabbatical Details
- **Destination:** {{ $sabbatical->destination }}
- **Duration:** {{ $sabbatical->duration }} days
- **Start Date:** {{ $sabbatical->start_date->format('M d, Y') }}
- **End Date:** {{ $sabbatical->end_date->format('M d, Y') }}

## 🔄 Status Change
- **Previous Status:** {{ $oldStatus }}
- **New Status:** {{ $newStatus }}
- **Updated At:** {{ now()->format('M d, Y H:i') }}

## 📝 Purpose
{{ $sabbatical->purpose }}

<x-mail::button :url="$sabbaticalUrl">
View Sabbatical Details
</x-mail::button>

@if($newStatus === 'active')
<x-mail::button :url="$progressReportsUrl" color="success">
Submit Progress Report
</x-mail::button>
@endif

<x-mail::button :url="$dashboardUrl" color="secondary">
Go to Dashboard
</x-mail::button>

---

**What this means:**
@if($newStatus === 'upcoming')
- Your sabbatical is scheduled to begin soon
- Start preparing for your sabbatical
@elseif($newStatus === 'active')
- Your sabbatical is now active
- You can submit progress reports
- Make sure to submit reports as required ({{ ucfirst($sabbatical->update_frequency) }})
@elseif($newStatus === 'completed')
- Your sabbatical has been completed
- Review your progress reports
- Consider submitting a final summary
@endif

If you have any questions about this status change, please contact the administration.

Best regards,<br>
{{ config('app.name') }} Team
</x-mail::message> 