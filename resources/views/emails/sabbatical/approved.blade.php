<x-mail::message>
# Sabbatical Request Approved! 🎉

Dear **{{ $sabbatical->doctor->name }}**,

Your sabbatical request has been **approved** by the administration. Here are the details:

## 📋 Sabbatical Details
- **Destination:** {{ $sabbatical->destination }}
- **Duration:** {{ $sabbatical->duration }} days
- **Start Date:** {{ $sabbatical->start_date->format('M d, Y') }}
- **End Date:** {{ $sabbatical->end_date->format('M d, Y') }}
- **Update Frequency:** {{ ucfirst($sabbatical->update_frequency) }}

## 📝 Purpose
{{ $sabbatical->purpose }}

## ✅ Approval Information
- **Approved By:** {{ $sabbatical->approver->name }}
- **Approved At:** {{ $sabbatical->approved_at->format('M d, Y H:i') }}

<x-mail::button :url="$sabbaticalUrl">
View Sabbatical Details
</x-mail::button>

<x-mail::button :url="$progressReportsUrl" color="success">
Submit Progress Report
</x-mail::button>

<x-mail::button :url="$dashboardUrl" color="secondary">
Go to Dashboard
</x-mail::button>

---

**Next Steps:**
1. Review your sabbatical details
2. Start preparing for your sabbatical
3. Submit progress reports as required ({{ ucfirst($sabbatical->update_frequency) }})

If you have any questions, please contact the administration.

Best regards,<br>
{{ config('app.name') }} Team
</x-mail::message> 