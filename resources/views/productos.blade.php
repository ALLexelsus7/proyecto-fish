@extends('layouts.app')
{{-- Seccion con el catalogo de peces --}}
@section('content')
<div>    
    {{-- Animación de descenso --}}
    <section class="relative h-screen w-full bg-cover bg-no-repeat animacion-descenso flex items-center justify-center"
             style="background-image: url('{{ asset('img/bg/bg_expanded6.png') }}');">
        <div class="absolute inset-0 bg-black/10"></div>
        {{-- inset-0 hace que el div cubra todo el área del contenedor padre --}}
        
        <div class="relative z-10 text-center" x-show="!animacionTerminada" x-transition:leave="transition ease-in duration-500 opacity-0">
            <h2 class="text-5xl md:text-7xl font-black text-white italic tracking-widest drop-shadow-2xl">
                DESCENDIENDO...
            </h2>
            <p class="text-coral-electrico font-bold mt-4">Explorando la zona abisal</p>
            <a href="#catalogo" class="mt-2 text-xs text-gray-100/50 animate-pulse hover:text-ojo-aberracion transition-all duration-300">↓ Continua abajo ↓</a>
        </div>
    </section>

    {{-- Catalogo --}}
    <section id="catalogo" class="pt-60 bg-gradient-to-b from-black/100 via-black/5 to-black/0 min-h-screen">        
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-white mb-2">Nuestro Catálogo Exótico</h2>
                <div class="h-1 w-24 bg-magma-diablillo mx-auto"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                
                @php
                    // Prueba de datos
                    $peces = [
                        ['nombre' => 'Pez Quimera', 'precio' => 1500, 'img' => 'fish1.png'],
                        ['nombre' => 'Rape Abisal', 'precio' => 2200, 'img' => 'fish2.png'],
                        ['nombre' => 'Pez Hacha', 'precio' => 800, 'img' => 'fish3.png'],
                        ['nombre' => 'Anguila Pelícano', 'precio' => 3100, 'img' => 'fish4.png'],
                        ['nombre' => 'Calamar Vampiro', 'precio' => 4500, 'img' => 'fish5.png'],
                        ['nombre' => 'Pez Dragón', 'precio' => 1900, 'img' => 'fish6.png'],
                        ['nombre' => 'Pez Trípode', 'precio' => 1200, 'img' => 'fish7.png'],
                        ['nombre' => 'Pulpo Dumbo', 'precio' => 5000, 'img' => 'fish8.png'],
                        ['nombre' => 'Tiburón Duende', 'precio' => 7000, 'img' => 'fish9.png'],
                        ['nombre' => 'Pez Caracol', 'precio' => 600, 'img' => 'fish10.png'],
                        ['nombre' => 'Isópodo Gigante', 'precio' => 2500, 'img' => 'fish11.png'],
                        ['nombre' => 'Medusa Atolla', 'precio' => 3300, 'img' => 'fish12.png'],
                    ];
                @endphp

                @foreach($peces as $pez)
                <article class="tarjeta-cristal overflow-hidden group hover:border-magma-diablillo transition-all duration-700 ease-out opacity-0 translate-y-12 observar-tarjeta">
                    {{-- opacity-0 oculta las tarjetas hasta que entren en pantalla  con el script de abajo.
                         Translate-y-12 las posiciona fuera de la pantalla --}}
                    
                    <div class="h-56 overflow-hidden bg-white/5 flex items-center justify-center p-4">
                        <img src="{{ asset('img/fish/' . $pez['img']) }}" 
                            alt="{{ $pez['nombre'] }}" 
                            class="w-full h-full object-contain transform group-hover:scale-110 transition-transform duration-500">
                    </div>
                    
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-white mb-2">{{ $pez['nombre'] }}</h3>
                        {{-- Falta el boton de favorito
                            no seleccionado: bg-pink-500 text-white shadow-red-400/20 
                            seleccionado: bg-pink-500 hover:text-white --}}
                        
                        <div class="flex justify-between items-center">
                            <span class="text-coral-electrico font-bold text-lg">${{ number_format($pez['precio'], 2) }}</span>
                            <button class="bg-magma-diablillo p-2 rounded-lg hover:bg-ojo-aberracion transition shadow-lg shadow-magma-diablillo/20">
                                <span class="material-symbols-outlined text-white">add_shopping_cart</span>
                            </button>
                        </div>
                    </div>
                </article>
                @endforeach

            </div>
        </div>
    </section>
</div>
@endsection