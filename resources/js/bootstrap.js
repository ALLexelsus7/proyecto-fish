// Este documento no tiene nada que ver con Bootstrap CSS, 
// Axios es una biblioteca de JavaScript para hacer solicitudes HTTP (es como el mesero en un restaurant)
// sin tener que recargar la pagina. Es muy útil para enviar datos al servidor 
// o pedir información sin interrumpir la experiencia del usuario.
import axios from 'axios'; //hice "npm install axios" (ya que no lo incluye Laravel ni Breeze)
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/*⚠️OJO Hubo una Vulnerabilidad ⚠️
npm fue vulnerado el 31 de marzo de 2026 (justo antes de iniciar el proyecto), 
y de entre las librerias, axios... las versiones 1.14.1 y 0.30.4, y la dependencia malisiosa:
plain-crypto-js@4.2.1 Esto instalaba un RAT (Remote Access Troyan) y un .bat para persistir. 
Unas horas despues el equipo de Axios lo soluciono y actualizo a versiones parche 1.15.0, 1.16.0 
(Al iniciar el proyecto me instalo la 1.16.0 por lo que me salve... esa version se lanzo a inicios de mayo
y la mas actual es la 1.16.1, por lo que hice: npm install axios@latest)
Para verificarlo use en terminal:

    PS C:\laragon\www\proyecto-fish> npm audit;
        found 0 vulnerabilities
    PS C:\laragon\www\proyecto-fish> npm list axios
        proyecto-fish@ C:\laragon\www\proyecto-fish
        └── axios@1.16.0

    PS C:\laragon\www\proyecto-fish> npm list plain-crypto-js
        proyecto-fish@ C:\laragon\www\proyecto-fish
        └── (empty)

Y ademas revise el archivo package-lock.json y package.json para verificar la version de axios.

Si hubiera estado infectada con esas versiones, probablemente un malware se haya ejecutado
silenciosamente en el script automatico postinstall de nmp, por lo que se debe:
1. Desinfectar el proyecto:
    npm uninstall axios
    npm cache clean --force
    npm install axios@1.16.0 (o cualquier otra version)
1.5 Tambien se puede hacer automaticamente a una version limpia con:
    npm audit fix
2. Verificar que se haya ido la carpeta node_modules/plain-crypto-js
3. Cambiar todas las contraseñas que tengo guardadas en .env y en navegadores.
4. Escanear en modo profundo el sistema operativo con un antivirus, ya que el malware intenta instalar
binarios ocultos para mantener un acceso remoto persistente.

✔️¿QUE HACER AHORA? 😀
a) Se pueden usar herraminetas de analisis en tiempo real como (Socket.dev o Synk)
que analizan los paquetes de npm buscando comportamientos raros.
Se puede instalar su extension o integrarlo en los repositores de github

b) Tambien se puede configurar un .npmrc que gestione paquetes que lleven publicados al menos
7 dias en el registro de npm.

c) Se pueden activar alertas de Dependabot de Github, el cual manda un pullrequest automatico
para parchear el codigo si se detectan vulnerabilidades en su base de datos.

d) Seguir cuentas en redes sociales de divulgacion de ciberseguridad para mantenerse informado.

e) usa "npm config set min-release-age 7" para que solo se instalen dependencias de no mas de 7 dias
de antiguo

f) Extra: Aunque esto no hubiese evitado la infeccion, se recomienda  dejar de usar 'npm' y en su 
lugar usar 'pnpm'. El tradicional duplica librerias por cada vez que se use en un proyecto distinto, 
pero con el pnpm se instala una sola version glabal y en cada proyecto se llega a estos paquetes 
con "accesos directos". De igual manera al usar 'yarn'.
Ademas, el archivo pnpm-lock.yaml bloquea dependencias fantasma y hacer 'pnmp audit' es mas rapido 
y eficiente

*/

/*⚠️OJO Hubo otra Vulnerabilidad 😁 ⚠️ 
Esta vez laravel-lang y composer el 22 de mayo.
Me salve de nuevo ya que yo hice en terminal composer install o require el 11 de mayo 
y desde entonces no use el comando...
✔️Que hacer?
Verifica con: 
'composer audit' 
a mi me salen advertencias de bugs en mi proyecto, pero no malware,
por lo que actualice esas librerias con: 
'composer update symfony/http-foundation symfony/http-kernel symfony/mailer symfony/mime symfony/polyfill-intl-idn symfony/routing --with-dependencies'
lo que solamente actualiza esas en especifico, sin riesgo de las librerias infectadas... 

Actualiza composer:
'composer self-update' 
para la ultima version global, o
'composer update --prefer-dist --no-cache' 
para evitar el cache con posible infeccion, o
'rm composer.lock' y luego 'composer install --prefer-dist --no-cache' 
para hacerlo completamente limpio y desde 0
*/

/* Nota Final: 
1. Usa herramientas como Socket.dev o el CLI de Synk
2. Ejecuta npm audit y composer audit cada cierto tiempo.
3. Sigue redes sociales que informan de esto. */