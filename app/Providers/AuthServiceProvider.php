<?php

namespace App\Providers;

use App\Models\Leave;
use App\Models\Sabbatical;
use App\Models\ProgressReport;
use App\Policies\LeavePolicy;
use App\Policies\SabbaticalPolicy;
use App\Policies\ProgressReportPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Leave::class => LeavePolicy::class,
        Sabbatical::class => SabbaticalPolicy::class,
        ProgressReport::class => ProgressReportPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
