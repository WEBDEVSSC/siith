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

        // ROL ADMINISTRADOR (OFICINA CENTRAL) CATALOGO 6
        Gate::define('admin', function ($user) {
            return $user->role === 'admin';
        });

        // ROL CENTRO DE SALUD URBANO Y RURAL (CATALOGO 1)
        Gate::define('csuyr', function ($user) {
            return $user->role === 'csuyr';
        });

        // ROL HOSPITAL (CATALOGO 2)
        Gate::define('hospital', function ($user) {
            return $user->role === 'hospital';
        });

        // ROL OFICINAS JURISDICCIONALES (CATALOGO 3)
        Gate::define('ofJurisdiccional', function ($user) {
            return $user->role === 'ofJurisdiccional';
        });

        // ROL OFICINAS JURISDICCIONALES (CATALOGO 3)
        Gate::define('criCree', function ($user) {
            return $user->role === 'criCree';
        });

        // ROL OFICINAS JURISDICCIONALES (CATALOGO 3)
        Gate::define('samuCrum', function ($user) {
            return $user->role === 'samuCrum';
        });

        // ROL OFICINAS JURISDICCIONALES (CATALOGO 3)
        Gate::define('ofCentral', function ($user) {
            return $user->role === 'ofCentral';
        });

        // ROL OFICINAS JURISDICCIONALES (CATALOGO 3)
        Gate::define('almacen', function ($user) {
            return $user->role === 'almacen';
        });

        // ROL OFICINAS JURISDICCIONALES (CATALOGO 3)
        Gate::define('lesp', function ($user) {
            return $user->role === 'lesp';
        });

        // ROL OFICINAS JURISDICCIONALES (CATALOGO 3)
        Gate::define('cets', function ($user) {
            return $user->role === 'cets';
        });

        // ROL OFICINAS JURISDICCIONALES (CATALOGO 3)
        Gate::define('oncologico', function ($user) {
            return $user->role === 'oncologico';
        });

        // ROL OFICINAS JURISDICCIONALES (CATALOGO 3)
        Gate::define('issreei', function ($user) {
            return $user->role === 'issreei';
        });

        // ROL OFICINAS JURISDICCIONALES (CATALOGO 3)
        Gate::define('cesame', function ($user) {
            return $user->role === 'cesame';
        });

        // ROL OFICINAS JURISDICCIONALES (CATALOGO 3)
        Gate::define('psiParras', function ($user) {
            return $user->role === 'psiParras';
        });

        // ROL OFICINAS JURISDICCIONALES (CATALOGO 3)
        Gate::define('ceam', function ($user) {
            return $user->role === 'ceam';
        });

        // ROL OFICINAS JURISDICCIONALES (CATALOGO 3)
        Gate::define('hospitalNino', function ($user) {
            return $user->role === 'hospitalNino';
        });

        // ROL JEFE DE DEPARTAMENTO
        Gate::define('jefeDepartamento', function ($user) {
            return $user->role === 'jefeDepartamento';
        });

        // ROL RH CREDENCIALIZACION
        Gate::define('credencializacion', function ($user) {
            return $user->role === 'credencializacion';
        });
        
    }

    public function register(): void
    {
        // ...
    }
}
