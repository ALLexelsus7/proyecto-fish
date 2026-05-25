// Importacion del archivo bootstrap.js
import './bootstrap';
//Alpine.js es un framework de JavaScript para crear interfaces de usuario reactivas.
import Alpine from 'alpinejs';

window.Alpine = Alpine;

// Componente global para el efecto de aparición en cascada para las tarjetas de productos.blade.php
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

// Carrusel de sitios de pesca en home
window.carruselSitios = function() {
    return {
        currentIndex: 0,
        sitios: [
            { name: 'Sidney, Australia', icon: 'Sydney.svg' },
            { name: 'Barcelona, España', icon: 'Barcelona.svg' },
            { name: 'Niza, Francia', icon: 'Niza.svg' },
            { name: 'Rio de Janeiro, Brasil', icon: 'Rio de Janeiro.svg' }
        ],
        autoplayDelay: 7000, // milisegundos
        autoplayInterval: null,
        init() {
            // iniciar autoplay al montar el componente
            this.play();
        },
        play() {
            this.pause();
            this.autoplayInterval = setInterval(() => this.next(), this.autoplayDelay);
        },
        pause() {
            if (this.autoplayInterval) {
                clearInterval(this.autoplayInterval);
                this.autoplayInterval = null;
            }
        },
        next() {
            this.currentIndex = (this.currentIndex + 1) % this.sitios.length;
        },
        prev() {
            this.currentIndex = (this.currentIndex - 1 + this.sitios.length) % this.sitios.length;
        }
    }
};

// I. Almacen GLOBAL para la cantidad de items en el carrito
Alpine.store('carritoGlobal', {
    count: 0
});
// Varias funciones Alpine & Registrar el componente global del CARRITO
Alpine.data('carrito', (config) => ({
    open: false,
    items: [],
    total: '0.00',

    // Función para cargar los datos desde MySQL vía Axios 
    cargarCarrito() {
        axios.get(config.getRoute)
            .then(response => {
                this.items = response.data.items;
                this.total = response.data.total_formateado;
                // II. calculo del total de items
                const totalPiezas = this.items.reduce((sum, item) => sum + item.cantidad, 0);                
                // III. actualiza el almacen GLOBAL
                Alpine.store('carritoGlobal').count = totalPiezas;
            })
            .catch(error => console.error('Error al cargar la red', error));
    },

    // Función para eliminar un ítem con la URL absoluta
    eliminarItem(id) {
        axios.delete(`${config.removeUrl}/${id}`)
            .then(() => {
                this.cargarCarrito();
            })
            .catch(error => console.error('Error al liberar', error));
    },

    // Función para modificar cantidades con los botones + y -
    cambiarCantidad(id, accion) {
        axios.patch(`${config.updateUrl}/${id}`, { accion: accion })
            .then(() => {
                this.cargarCarrito();
            })
            .catch(error => console.error('Error al actualizar cantidad', error));
    },

    // Funcion para hacer el pedido
    realizarAdquisicion() {
        // Puedo cambiar texto del botón a "Procesando..."
        axios.post(config.checkoutUrl)
            .then(response => {
                // Mensaje de exito del backend
                alert(response.data.message);                 
                // Cierra el panel lateral carrito
                this.open = false;                 
                // Recarga el carrito (lo deja vacío y actualiza la burbuja del navbar a 0)
                this.cargarCarrito(); 
            })
            .catch(error => {
                console.error('Error en checkout', error);
                alert('Hubo un error al procesar tu adquisición en las profundidades.');
            });
    }

}));

// Componente global para el manejo de estatus en el dashboard admin
document.addEventListener('alpine:init', () => {
    Alpine.data('manejadorEstatus', (estatusInicial, urlUpdate) => ({
        estatus: estatusInicial,
        isUpdating: false,
        
        actualizar() {
            this.isUpdating = true;
            
            // Petición Axios a nuestro backend (con post + _method para simular PATCH)
            axios.post(urlUpdate, {
                _method: 'PATCH',
                estatus: this.estatus
            })
            .then(response => {
                // Quita el estado de carga
                this.isUpdating = false;
                console.log('Estatus actualizado con éxito.');
            })
            .catch(error => {
                console.error('Error táctico:', error);
                this.isUpdating = false;
                alert('Fallo en la comunicación con la Base de Datos.');
                // Revierte el selector si fallo
                this.estatus = estatusInicial; 
            });
        }
    }));
});

// Iniciar Alpine.js después de definir todas las funciones
Alpine.start();