<?php

namespace App\Providers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('user_update_role', fn(User $user) => $user->role_id == Role::ADMIN);
        Gate::define('tasks_create', fn(User $user) => $user->role_id == Role::TEACHER);
        Gate::define('tasks_applications', fn(User $user) => $user->role_id == Role::TEACHER);
        Gate::define('tasks_apply', fn(User $user) => $user->role_id == Role::STUDENT);

    }
}
