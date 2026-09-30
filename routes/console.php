<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::command('felicitaciones:enviar')
    ->dailyAt('10:00')
    ->withoutOverlapping()
    ->description('Envía felicitaciones de cumpleaños a los profesionales');

Schedule::command('db:backup')
    ->dailyAt('02:00')
    ->withoutOverlapping()
    ->description('Crea el respado de la DB');

Schedule::exec('/usr/bin/python3 /home/recursosh/Escritorio/ine.py')
    ->dailyAt('08:40')
    ->withoutOverlapping()
    ->appendOutputTo(storage_path('logs/ine_ocr.log'))
    ->description('Procesamiento de INE mediante Python OCR');