<?php
// con 'php artisan make:command AuditarSistemas' para hacer un scheduler
// de recuerdo de ejecucion de ciertos comandos importantes de analisis y seguridad del proyecto
namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
// use Illuminate\Support\Facades\Shell;


#[Signature('seguridad:auditar')]
#[Description('Ejecuta comandos de analisis de seguridad para buscar malware o vulnerabilidades')]
class AuditarSistemas extends Command
{
     /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Iniciando escaneo del perímetro de seguridad...');
        // Uso exec() en lugar de shell_exec(), ya que guarda el texto en el Array ($output) 
        // y el Código de Salida en la variable ($codigo) para saber si hubo una vulnerabilidad.
        // El 2>&1 redirige los errores para que PHP pueda leerlos.
        // implode() convierte el Array en un String 
        // para poder buscar la palabra "vulnerabilit" (vulnerability/vulnerabilidades) con stripos()

        // 1. Auditar Backend (PHP)
        exec('composer audit 2>&1', $composerOutput, $composerCode);
        $composerAudit = implode("\n", $composerOutput);
        
        // 2. Auditar Frontend (Node/npm o pnpm)
        exec('npm audit 2>&1', $npmOutput, $npmCode);
        $npmAudit = implode("\n", $npmOutput);
        
        // 3. Auditar con herramientas externas
        exec('snyk test 2>&1', $snykOutput, $snykCode);
        $snykAudit = implode("\n", $snykOutput);

        // Evaluacion: Si algun código es mayor a 0, las alarmas suenan.
        if ($composerCode > 0 || $npmCode > 0 || $snykCode > 0) {
            Log::critical('🚨 ALERTA DE SEGURIDAD: Se han detectado vulnerabilidades en las dependencias.');
            // Solo manda al log el reporte del sistema que haya fallado para no saturar el archivo
            if ($composerCode > 0) Log::warning("Reporte Composer:\n" . $composerAudit);
            if ($npmCode > 0) Log::warning("Reporte NPM:\n" . $npmAudit);
            if ($snykCode > 0) Log::warning("Reporte SNYK:\n" . $snykAudit);
            
            $this->error('¡Brecha detectada! Revisa tus logs en storage/logs/laravel.log');
            // Aqui podria agregar código para enviar un correo electrónico usando Mail::to('admin@abyssal.com')
        } else {
            Log::info('Auditoría completada: Sistemas limpios.');
            $this->info('El abismo está seguro. Cero vulnerabilidades encontradas.');
        }
    }
}
// Prueba manual con 'php artisan seguridad:auditar'
// Sino, este archivo se manda a llamar desde routes/console.php