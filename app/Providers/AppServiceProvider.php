<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Ajuste para el campo de correo en la tabla users
        Schema::defaultStringLength(191);

        //------------------------------------------------//
        //               ROLES Y PERMISOS                 //
        //------------------------------------------------//

        // ROL ADMINISTRADOR (OFICINA CENTRAL)
        Gate::define('isAdmin', function ($user) {
            return $user->role === 'admin';
        });
    }

    public function register(): void
    {
        // ...
    }
}
