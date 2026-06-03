<!-- Instalador para portabilidar y automatizacion del sistema para su uso en otros computadores -->
<!-- Al pasar el proyecto a otros computadores, no se debe pasar la carpeta vendor ni node_modules
 ya que son pesadas y causan conflictos entre sistemas. Las imagenes requieren de un enlace simbolico
 y se requiere configurar el .env, la instalacion de la base de datos si no existe, la ejecucion de 
 migraciones, factories y seeders, ademas de ejecutar lo siguiente... -->

 <?php
// =====================================================================
// SCRIPT DE DESPLIEGUE
// =====================================================================

echo "\n[⚡] INICIANDO PROTOCOLO DE DESPLIEGUE...\n\n";

// Función auxiliar para ejecutar comandos en la terminal y mostrar el resultado
function ejecutar($comando) {
    echo ">> Ejecutando: $comando \n";
    passthru($comando, $resultado);
    if ($resultado !== 0) {
        echo "\n[❌] ERROR CRÍTICO AL EJECUTAR: $comando \n";
        exit;
    }
    echo "[✅] Completado.\n\n";
}

// 1. Verificar/Crear archivo .env a partir de .env.example
if (!file_exists('.env')) {
    echo "[!] Archivo .env no encontrado. Clonando de .env.example...\n";
    copy('.env.example', '.env');
    echo "[✅] .env creado exitosamente.\n\n";
}

// 2. Extraer credenciales de la base de datos del .env
$envContent = file_get_contents('.env');
preg_match('/DB_DATABASE=(.*)/', $envContent, $dbMatch);
preg_match('/DB_USERNAME=(.*)/', $envContent, $userMatch);
preg_match('/DB_PASSWORD=(.*)/', $envContent, $passMatch);

$dbName = trim($dbMatch[1] ?? 'proyecto_fish'); // despues del ?? es la opcion B
$dbUser = trim($userMatch[1] ?? 'root');
$dbPass = trim($passMatch[1] ?? '');

// 3. Crear la Base de Datos si no existe usando PDO
echo ">> Conectando a MySQL para verificar la base de datos: '$dbName'...\n";
try {
    $pdo = new PDO("mysql:host=127.0.0.1;port=3306", $dbUser, $dbPass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbName` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");
    echo "[✅] Base de datos '$dbName' operativa.\n\n";
} catch (PDOException $e) {
    echo "[❌] FALLO DE CONEXIÓN A MYSQL: " . $e->getMessage() . "\n";
    echo "Asegúrate de que XAMPP o Laragon con MySQL esté encendido.\n";
    exit;
}

// 4. Instalar Dependencias de PHP (Composer)
ejecutar('composer install');

// 5. Generar Clave de Encriptación de Laravel (lo pone en el .env)
ejecutar('php artisan key:generate');

// 6. Ejecutar Migraciones y Seeders (Destruye y recrea la BD)
// Usamos --force para evitar que nos pida confirmación
ejecutar('php artisan migrate:fresh --seed --force');
// Extra: si falla algo de las api se hace:
//ejecutar('php artisan install:api --force');

// 7. Enlace Simbólico (CRÍTICO para que las fotos de los peces se vean)
// Primero eliminamos el enlace anterior si existe, para evitar errores en la nueva PC
if (file_exists('public/storage')) {
    // Comando para Windows (rmdir) o Linux (rm)
    strtoupper(substr(PHP_OS, 0, 3)) === 'WIN' ? exec('rmdir /s /q public\storage') : exec('rm -rf public/storage');
}
ejecutar('php artisan storage:link');

// 8. Instalar Dependencias de Frontend y Compilar Tailwind/Alpine
ejecutar('npm install');
ejecutar('npm run build');

echo "=====================================================================\n";
echo "[🏆] DESPLIEGUE TÁCTICO COMPLETADO CON ÉXITO.\n";
echo "[🚀] Ejecuta 'php artisan serve' para encender los motores.\n";
echo "=====================================================================\n";

/* NOTAS:
1. Ejecuta este instalador en terminal: php installer.php
2. El .gitingore evita que se copien ciertos archivos en github
3. Se hace npm run dev cuando se desarrolla (cambios en vivo con terminal ejecutandose),
    y npm run build para produccion, copia todo hacia /public/build 
    y ya esta listo para usarse sin terminales ejecutandose 
    (pero si cambiamos algo habra que hacer de nuevo npm run build).
4. Se puede usar tanto Laragon, como Xampp o Wampp, mientras use el mismo puerto 3306,
    el motor de MySQL y el usuario por defecto 'root' sin password.
    Pero antes de ejecutar este installer.php, enciende alguno de estos servidores locales.
5. Para pasar este proyecto a otros computadores se puede:
    a) Descargar el .zip pero se pierde la carpeta .git y no se podran hacer los git commit ni git push
    b) Usar (gh repo clone ALLexelsus7/proyecto-fish)
        o (git clone https://github.com/ALLexelsus7/proyecto-fish.git) en la carpeta deseada
        del otro computador para mantener el historial y hacer git commit o git push, y en la laptop
        de desarrollo original, hacer git pull.
    Para ambos casos, pon el proyecto en C:\laragon\www
6. El archivo .env.example debe tener:
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=proyecto_fish
    DB_USERNAME=root
    DB_PASSWORD=
7. proyecto_fish (DB) vs proyecto-fish (Carpeta)
    No importa que se llamen distinto, el primero usa snake_case (guiones bajos) para evitar confusion con el signo menos '-'
    y el segundo usa kebab-case (guiones medios) porque los S.O o Navegadores lo leen mejor.
8. No hacen falta mas configuraciones de laragon en este installer, ya que los virtualhost los crea al
detectar una nueva carpeta en C:\laragon\www, y se crea el archivo de config de
Apache/Nginx para que el proyecto responda a la URL http://nombredelacarpeta.test
*/
 