/* Este documento no tiene nada que ver con Bootstrap CSS, Axios es una biblioteca de JavaScript
para hacer solicitudes HTTP (es como el mesero en un restaurant) sin tener que recargar la pagina. 
Es muy útil para enviar datos al servidor o pedir información sin interrumpir la experiencia del usuario.*/
import axios from 'axios'; //hice "npm install axios" (ya que no lo incluye Laravel ni Breeze)
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/*⚠️OJO Hubo una Vulnerabilidad ⚠️
♦️SUCESO:
npm fue vulnerado el 31 de marzo de 2026 (justo antes de iniciar el proyecto).
Entre las librerías afectadas estuvo axios en las versiones 1.14.1 y 0.30.4, 
junto con la dependencia maliciosa: plain-crypto-js@4.2.1
Esta instalaba un RAT (Remote Access Trojan) y un archivo .bat para persistencia.
Horas después el equipo de Axios publicó versiones parcheadas (1.15.0 y 1.16.0).
Al iniciar el proyecto instale la 1.16.0, así que no resulté afectado 
(esa versión salió a inicios de mayo). Actualmente la más reciente es 1.16.1, 
por lo que ejecuté: npm install axios@latest

♦️VERIFICACION en terminal y archivos:
    npm audit -> found 0 vulnerabilities
    npm list axios -> axios@1.16.0
    npm list plain-crypto-js -> (empty)
Revisa package-lock.json y package.json para confirmar la versión de axios.

♦️PLAN DE ACCION:
Si hubiera estado infectado, probablemente el malware se habría ejecutado mediante el 
script automático postinstall de npm. Qué hacer si ocurrió:
1. Desinfectar el proyecto:
    npm uninstall axios
    npm cache clean --force
    npm install axios@1.16.0 (o cualquier versión segura)
1.5 También se puede intentar automáticamente: npm audit fix
2. Verificar que ya no exista: node_modules/plain-crypto-js
3. Cambiar contraseñas almacenadas en .env y navegadores.
4. Escanear el sistema con antivirus en modo profundo, ya que 
el malware intenta instalar binarios ocultos para mantener acceso remoto.

♦️¿QUE HACER AHORA?
A) Usar herramientas que analizan: 
I. Socket.dev. Busca malware activo y secuestros. Los bloquea.
   Se vincula a github desde la web de socket.dev
   Se instala como una aplicación de GitHub que vigila 
   ciertos repositorios o todos ellos (se dan permisos y en la web se debe 
   crear una nueva organizacion en la que puedo ver las analiticas de mis repositorios).   
II. Snyk CLI. Ecanea el propio código en busca de malas prácticas.
    Se puede vincular la cuenta de GitHub en su web snyk.io. 
    Se instala el CLI global con 'npm install -g snyk'. Verifica con 'snyk --version'.
    Me autentico con 'snyk auth'. Analizo un proyecto con 'snyk test'.
    Empieza las notificaciones en vivo de vulnerabilidades con 'snyk monitor'.
    En su web, se importan y escanean los repos que elija. 
III. Activar opciones de Dependabot en un repo individual de github para recibir pullrequest 
     automáticos de actualización. En /.github/dependabot.yml se especifican los paquetes que
     deben actualizarse y donde estan alojados.

B) NPM y PNPM
I. Configurar el .npmrc global o del proyecto para evitar instalar paquetes demasiado recientes.
   O tambien se puede usar "npm config set min-release-age 7" para configurar rapidamente el npm global y
   que no se instalen paquetes de menos de 7 dias. (La carpeta global esta en C:\Users\AlexR\AppData\Roaming\npm 
   o se ubica con 'npm config get globalconfig')
II. Actualizar npm con "npm install -g npm@latest" (puede que se requiera actualizar el comando anterior a menos dias) 
III. (OPCIONAL) Aunque esto no habría evitado una infección postinstall, se recomienda considerar 
     pnpm en lugar de npm. Instala globalmente con 'npm install -g pnpm'. Verifica con 'pnpm -v'. 
     En el proyecto con npm se importa mediante 'pnpm import' para que lea el package-lock.json y 
     lo convierta a pnpm-lock.yaml sin romper nada. Luego se puede borrar el package-lock.json 
     e instalar todo limpiamente con: rm -rf node_modules, pnpm install, pnpm audit.
     (Ojo, se tendria que actualizar el dependabot.yml con el nuevo pnpm y actualizar el Scheduler de Laravel
     del cual se habla adelante)  .
     La diferencia es que: npm duplica dependencias entre proyectos; 
     pnpm reutiliza una instalación global mediante enlaces (Es similar a yarn).
     Además, pnpm-lock.yaml reduce dependencias fantasma y 'pnpm audit' suele ser más rápido.

C) Automatizar Auditorías para ejecutar comandos de analisis cada cierto tiempo.
I. Crea un pequeño archivo YAML en mi repositorio. Este archivo le dice a los servidores de GitHub: 
   "Todos los lunes a las 9:00 AM, abre una terminal invisible, ejecuta npm audit y composer audit. 
    Si algo sale en rojo, envíame un email urgente".
II. Vía Laravel Scheduler: Crea un comando personalizado (php artisan make:command AuditarSistemas)
    que ejecute los comandos en la consola mediante la función shell_exec('npm audit'). 
    Luego, en el archivo routes/console.php, simplemente escribe: 
    Schedule::command('app:auditar-sistemas')->weekly(); 
    (necesito tener el cron job de Laravel activado en el servidor).

D) Seguir cuentas y medios de divulgación en ciberseguridad para mantenerse informado.
    Ej. Feross Aboukhadijeh / @SocketSecurity, vx-underground, ThePrimeagen / Fireship, Troy Hunt
        Midudev, Victor Robles WEB, Hola Mundo...
    

E) Documentación Profesional.
I. Usa la página web readme.so para hacer un readme.md rapido
II. Usa una página web para documentar con VitePress, Mintlify 
    o Laravel Scribe (que lee los comentarios en PHP y arma un manual de la API automáticamente).

*/

/*⚠️OJO Hubo otra Vulnerabilidad 😁 ⚠️ 
♦️SUCESO:
Esta vez laravel-lang y composer el 22 de mayo.
No resulté afectado porque ejecuté composer install / composer require 
el 11 de mayo y después no volví a usar esos comandos.
♦️VERIFICACION y PLAN DE ACCION
1.  composer audit
    (En mi caso solo aparecieron advertencias de bugs, no malware.
    Actualicé únicamente las librerías necesarias con):
    composer update symfony/http-foundation symfony/http-kernel symfony/mailer 
    symfony/mime symfony/polyfill-intl-idn symfony/routing --with-dependencies

2.  composer self-update (ultima version global)
    composer update --prefer-dist --no-cache (evitar el cache con posible infeccion)
    rm composer.lock y
    composer install --prefer-dist --no-cache (completamente limpio y desde 0)
*/