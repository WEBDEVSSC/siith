<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::command('felicitaciones:enviar')->dailyAt('10:00');

Schedule::command('correo:firma-nomina-pendiente')->dailyAt('10:00');
