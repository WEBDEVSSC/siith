<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema; // Asegúrate de agregar esto

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Schema::defaultStringLength(191);  // Aquí ya está bien
    }

    public function register(): void
    {
        // ...
    }
}
