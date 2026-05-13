// Importacion del archivo bootstrap.js
import './bootstrap';
//Alpine.js es un framework de JavaScript para crear interfaces de usuario reactivas.
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

// Efecto de aparición en cascada para las tarjetas de productos.blade.php
document.addEventListener("DOMContentLoaded", function() {
    // Creamos un observador que detecta cuando los elementos entran a la pantalla
    const observer = new IntersectionObserver((entries) => {
        let delay = 0; // Para el efecto "cascada"
        
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                // Pequeño retraso a cada tarjeta para que salgan una por una
                setTimeout(() => {
                    entry.target.classList.remove('opacity-0', 'translate-y-12');
                    entry.target.classList.add('opacity-100', 'translate-y-0');
                }, delay);
                
                delay += 150; // + 150 milisegundos por cada tarjeta
                observer.unobserve(entry.target); // Dejamos de observar una vez animada
            }
        });
    }, { 
        threshold: 0.1 // Se activa cuando al menos el 10% de la tarjeta es visible
    });

    // El observador vigila todas las tarjetas
    document.querySelectorAll('.observar-tarjeta').forEach((el) => {
        observer.observe(el);
    });
});