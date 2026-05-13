// Este documento no tiene nada que ver con Bootstrap CSS, 
// Axios es una biblioteca de JavaScript para hacer solicitudes HTTP (es como el mesero en un restaurant)
// sin tener que recargar la pagina. Es muy útil para enviar datos al servidor 
// o pedir información sin interrumpir la experiencia del usuario.
import axios from 'axios'; //hice npm install axios (ya que no lo incluye Laravel ni Breeze)
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';