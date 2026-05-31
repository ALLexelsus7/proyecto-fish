// Importacion del archivo bootstrap.js (aqui se importa axios, pero ojo, ver la info que puse alli...)
import './bootstrap';
//Alpine.js es un framework de JavaScript para crear interfaces de usuario reactivas.
import Alpine from 'alpinejs';

window.Alpine = Alpine;

// ==============================================================================
//               UTILIDADES Y EFECTOS INDEPENDIENTES (Vanilla JS)
// ==============================================================================

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

// Contenedor global para funciones exclusivas del navegador
window.AbyssalApp = {
    /**
     * Dispara el cuadro de diálogo de impresión nativo del sistema operativo.
     * Gracias a las utilidades print: de Tailwind, el navegador sabrá exactamente
     * qué elementos mostrar en el papel/PDF y cuáles ignorar.
     */
    imprimirRecibo() {
        window.print();
    }
};

// ==============================================================================
//                  ECOSISTEMA ALPINE.JS (Componentes y Stores)
// ==============================================================================

document.addEventListener('alpine:init', () => {

    // I. Almacen GLOBAL para la cantidad de items en el carrito
    Alpine.store('carritoGlobal', {
        count: 0
    });

    // --- COMPONENTES (Data) ---

    // Carrusel de sitios de pesca en home
    Alpine.data('carruselSitios', () => ({
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
    }));

    // Manejo del Carrito lateral
    Alpine.data('carrito', (config) => ({
        open: false,
        items: [],
        total: '0.00',
        procesando: false, //Bandera de seguridad para prevencion de doble click

        // Función para cargar los datos del carrito desde MySQL vía Axios 
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

        // Función para hacer el pedido
        realizarAdquisicion() {
            this.procesando = true; // Activa el bloqueo del botón
            axios.post(config.checkoutUrl)
                .then(response => {
                    // En lugar de un alert(), redirigimos a la URL de éxito que nos mandará el backend
                    if (response.data.redirect_url) {
                        window.location.href = response.data.redirect_url;
                    }
                })
                .catch(error => {
                    console.error('Error en checkout', error);
                    alert('Hubo un error al procesar tu adquisición en las profundidades.');
                    this.procesando = false; // Libera el botón si hay error
                });
        }
    }));

    // Manejo de estatus en el dashboard admin
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

    // Abrir el modal central de detalles pedidos en dashboard admin
    Alpine.data('visorPedidos', () => ({
        abierto: false,
        cargando: false,
        pedido: null,

        cargarDetalles(url) {
            this.abierto = true;
            this.cargando = true;
            this.pedido = null;

            axios.get(url)
                .then(response => {
                    // Simula un delay mínimo de 3 segundos para apreciar la animación
                    setTimeout(() => {
                        this.pedido = response.data;
                        this.cargando = false;
                    }, 3000);
                })
                .catch(error => {
                    console.error('Fallo de intercepción:', error);
                    this.cargando = false;
                    this.abierto = false;
                    alert('Error al obtener los manifiestos de carga.');
                });
        },
        
        formatearMoneda(valor) {
            return new Intl.NumberFormat('es-MX', { style: 'currency', currency: 'MXN' }).format(valor);
        }
    }));
});

// ==============================================================================
//           Iniciar Alpine.js después de definir todas las funciones
// ==============================================================================
Alpine.start();