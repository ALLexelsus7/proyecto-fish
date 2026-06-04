<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// desde app\Console\Commands\AuditarSistemas.php
// Ejecuta el scheduler semanal 
// (para cuando este en produccion con el cron job activado en el servidor)
Schedule::command('seguridad:auditar')->weekly();
// Ejecuta manual con 'php artisan seguridad:auditar'