<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Organization;
use App\Models\Team;
use App\Models\Project;
use App\Models\Task;
use App\Policies\OrganizationPolicy;
use App\Policies\TeamPolicy;
use App\Policies\ProjectPolicy;
use App\Policies\TaskPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Organization::class => OrganizationPolicy::class,
        Team::class => TeamPolicy::class,
        Project::class => ProjectPolicy::class,
        Task::class => TaskPolicy::class,
    ];
    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
