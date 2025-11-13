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

        /**
         * 
         * 
         * ROLES PARA USUARIOS
         * 
         * 
         */

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

        /**
         * 
         * 
         * ROLES PARA ENSEÑANZA
         * 
         * 
         */        

        // ROL ENSENANZA
        Gate::define('ensenanza', function ($user) {
            return $user->role === 'ensenanza';
        });

        // ROL ENSENANZA
        Gate::define('universitario', function ($user) {
            return $user->role === 'universitario';
        });

    
        /**
         * 
         * 
         * ROLES PARA RECURSOS HUMANOS
         * 
         * 
         */

        // ROL ENSENANZA
        Gate::define('normatividad', function ($user) {
            return $user->role === 'normatividad';
        });

        // ROL DIRECTIVOdirectivo
        Gate::define('directivo', function ($user) {
            return $user->role === 'directivo';
        });

        // ROL PROFESIONALES
        Gate::define('profesionales', function ($user) {
            return $user->role === 'profesionales';
        });

        // ROL SISTEMATIZACION
        Gate::define('sistematizacion', function ($user) {
            return $user->role === 'sistematizacion';
        });

        // ROL EVENTUAL
        Gate::define('eventual', function ($user) {
            return $user->role === 'eventual';
        });

        // ROL PRESTACIONES
        Gate::define('prestaciones', function ($user) {
            return $user->role === 'prestaciones';
        });

        // ROL RH CREDENCIALIZACION
        Gate::define('credencializacion', function ($user) {
            return $user->role === 'credencializacion';
        });

        // ROL RH CREDENCIALIZACION
        Gate::define('rhusuarios', function ($user) {
            return $user->role === 'rhusuarios';
        });

        // ROL RH CREDENCIALIZACION
        Gate::define('rhasistente', function ($user) {
            return $user->role === 'rhasistente';
        });

        // ROL RH CREDENCIALIZACION
        Gate::define('rhauditoria', function ($user) {
            return $user->role === 'rhauditoria';
        });

        // ROL RH RIESGOS
        Gate::define('riesgos', function ($user) {
            return $user->role === 'riesgos';
        });
    }

    public function register(): void
    {
        // ...
    }
}
