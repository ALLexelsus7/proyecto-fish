{{-- Este loading lo uso para permitir la carga de otros componentes en ciertas vistas --}}
<div id="pantalla-carga" class="fixed inset-0 z-[100] flex flex-col items-center justify-center bg-black/95 backdrop-blur-md transition-opacity duration-700">
    
    <style>
        /* Animación Táctica: Nado Circular Continuo */
        @keyframes perseguirCola {
            0% { 
                transform: rotate(360deg) scale(1); 
                filter: drop-shadow(0 0 5px rgba(255, 60, 0, 0.4));
            }
            50% { 
                /* Se expande un poco y brilla más a la mitad del giro */
                transform: rotate(180deg) scale(1.08); 
                filter: drop-shadow(0 0 20px rgba(255, 60, 0, 0.9));
            }
            100% { 
                transform: rotate(0deg) scale(1); 
                filter: drop-shadow(0 0 5px rgba(255, 60, 0, 0.4));                
            }
        }

        .pez-giratorio {
            /* 1.8 segundos por vuelta, 'linear' asegura que no se frene ni acelere */
            animation: perseguirCola 1.8s linear infinite;
            /* Ajusta este origen si el pez no gira exactamente sobre su centro */
            transform-origin: center center; 
        }
    </style>

    <div class="relative w-48 h-48 flex items-center justify-center mb-8">
        
        <div class="absolute inset-0 rounded-full border-4 border-t-magma-diablillo border-r-transparent border-b-coral-electrico border-l-transparent animate-spin opacity-40 blur-[2px]"></div>
        
        <div class="absolute inset-4 rounded-full border-2 border-b-magma-diablillo border-l-transparent border-t-coral-electrico border-r-transparent animate-spin opacity-30" style="animation-direction: reverse; animation-duration: 3s;"></div>

        <img 
            src="{{ asset('img/logos/pezElegidoPlus.png') }}" 
            alt="Cargando..." 
            class="pez-giratorio relative z-10 w-32 h-32 object-contain"
        >
    </div>

    <div class="text-center">
        <h3 class="text-xl font-black text-white tracking-widest uppercase mb-2 flex items-center justify-center gap-2">
            <span class="material-symbols-outlined animate-pulse text-magma-diablillo">radar</span>
            Sondeando Profundidades
        </h3>
        <p class="text-xs text-coral-electrico font-mono tracking-widest animate-pulse">
            CALIBRANDO SENSORES ABISALES...
        </p>
    </div>
</div>

<script>
    // Este script oculta la pantalla de carga suavemente cuando el DOM y las imágenes están listos
    window.addEventListener('load', function() {
        const loader = document.getElementById('pantalla-carga');
        if (loader) {
            // Retraso táctico opcional (0.5s) para asegurar que el usuario vea la animación
            setTimeout(() => {
                loader.classList.add('opacity-0');
                setTimeout(() => {
                    loader.style.display = 'none';
                }, 700); // Coincide con el duration-700 de Tailwind
            }, 300); // .3 segundos para que se alcance a ver algo
        }
    });
</script>