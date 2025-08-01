<x-mail::message>
# New Sabbatical Request Submitted 📝

Dear **{{ $sabbatical->doctor->name }}**,

Your sabbatical request has been **submitted** successfully. Here are the details:

## 📋 Sabbatical Details
- **Destination:** {{ $sabbatical->destination }}
- **Duration:** {{ $sabbatical->duration }} days
- **Start Date:** {{ $sabbatical->start_date->format('M d, Y') }}
- **End Date:** {{ $sabbatical->end_date->format('M d, Y') }}
- **Update Frequency:** {{ ucfirst($sabbatical->update_frequency) }}

## 📝 Purpose
{{ $sabbatical->purpose }}

## ⏳ Current Status
- **Status:** {{ ucfirst($sabbatical->status) }}
- **Approval Status:** {{ ucfirst($sabbatical->approval_status) }}
- **Submitted At:** {{ $sabbatical->created_at->format('M d, Y H:i') }}

<x-mail::button :url="$sabbaticalUrl">
View Sabbatical Details
</x-mail::button>

<x-mail::button :url="$dashboardUrl" color="secondary">
Go to Dashboard
</x-mail::button>

---

**What happens next:**
1. Your request will be reviewed by the administration
2. You'll receive an email notification when it's approved or rejected
3. You can track the status in your dashboard

If you need to make any changes to your request, please contact the administration.

Best regards,<br>
{{ config('app.name') }} Team
</x-mail::message> 