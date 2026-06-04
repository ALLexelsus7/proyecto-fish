<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Ejecuta el scheduler semanal (en app\Console\Commands\AuditarSistemas.php)
Schedule::command('seguridad:auditar')->weekly();
// Prueba manual con 'php artisan seguridad:auditar'
// Se requiere tener activado el cron job de laravel activado en el servidor