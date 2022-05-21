<?php

namespace App\Providers;

use App\Models\Team;
use App\Models\Tarea;
use App\Models\User;
use App\Policies\TareaPolicy;
use App\Policies\TeamPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Team::class => TeamPolicy::class,
        Tarea::class => TareaPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin', function (User $user, Tarea $tarea) 
        {
            return $user->id == $tarea->user_id;
        });
    }
}
