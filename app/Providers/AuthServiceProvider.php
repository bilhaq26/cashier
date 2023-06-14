<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('dev', function (User $user) {
            return $user->role_id == '1';
        });

        Gate::define('all', function (User $user) {
            $logika = ($user->role_id == '1' || $user->role_id == '2' || $user->role_id == '3') || $user->role_id == '4';
            return $logika;
        });

        Gate::define('admin', function (User $user) {
            $logika = ($user->role_id == '1' || $user->role_id == '2');
            return $logika;
        });

        Gate::define('kasir', function (User $user) {
            $logika = ($user->role_id == '1' || $user->role_id == '2' || $user->role_id == '3');
            return $logika;
        });

        Gate::define('gudang', function (User $user) {
            $logika = ($user->role_id == '1' || $user->role_id == '2' || $user->role_id == '4');
            return $logika;
        });
    }
}
