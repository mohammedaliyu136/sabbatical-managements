<x-mail::message>
# Sabbatical Request Update 📋

Dear **{{ $sabbatical->doctor->name }}**,

Your sabbatical request has been **rejected** by the administration. Here are the details:

## 📋 Sabbatical Details
- **Destination:** {{ $sabbatical->destination }}
- **Duration:** {{ $sabbatical->duration }} days
- **Start Date:** {{ $sabbatical->start_date->format('M d, Y') }}
- **End Date:** {{ $sabbatical->end_date->format('M d, Y') }}

## 📝 Purpose
{{ $sabbatical->purpose }}

## ❌ Rejection Information
- **Rejected By:** {{ $sabbatical->approver->name }}
- **Rejected At:** {{ $sabbatical->approved_at->format('M d, Y H:i') }}
- **Reason:** {{ $sabbatical->rejection_reason }}

<x-mail::button :url="$sabbaticalUrl">
View Sabbatical Details
</x-mail::button>

<x-mail::button :url="$newRequestUrl" color="success">
Submit New Request
</x-mail::button>

<x-mail::button :url="$dashboardUrl" color="secondary">
Go to Dashboard
</x-mail::button>

---

**Next Steps:**
1. Review the rejection reason
2. Consider submitting a new request with modifications
3. Contact administration if you need clarification

If you have any questions about the rejection, please contact the administration.

Best regards,<br>
{{ config('app.name') }} Team
</x-mail::message> 