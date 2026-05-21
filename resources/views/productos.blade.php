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

                {{-- Se recorre cada producto de la base de datos --}}
                @forelse($productos as $producto)
                {{-- Alpine.js para seleccionar favoritos y categoria --}}
                <article x-data="{ isFavorite: false, estado_vida: {{ $producto->estado_vida ? 'true' : 'false' }} }" 
                        class="tarjeta-cristal overflow-hidden group hover:border-magma-diablillo transition-all duration-700 ease-out opacity-0 translate-y-12 observar-tarjeta">
                    {{-- opacity-0 y Translate-y-12 oculta las tarjetas hasta que entren en pantalla con el script. --}}
                    
                    {{-- Boton fav --}}
                    <button @click="isFavorite = !isFavorite" 
                            class="absolute top-4 right-4 z-10 p-2 rounded-full bg-black/40 backdrop-blur-md transition-all border border-white/10 flex items-center justify-center hover:bg-pink-500"
                            :class="isFavorite ? 'text-white bg-pink-500 border-white' : 'text-gray-400 hover:text-white'">
                        <span class="material-symbols-outlined transition-transform" 
                            :class="isFavorite ? 'fill-1 scale-110' : 'fill-0'">
                            favorite
                        </span>
                    </button>
                    
                    {{-- Imagen --}}
                    <div class="h-56 overflow-hidden bg-white/5 flex items-center justify-center p-4 rounded-md">
                        <img src="{{ asset($producto->imagen_url ?? 'img/peces/fish1.png') }}" {{-- la segunda opcion es por si acaso --}}
                            alt="{{ $producto->nombre_comun }}" 
                            class="w-full h-full object-contain transform group-hover:scale-105 transition-transform duration-500">
                    </div>
                    
                    {{-- Nombre, boton estado de vida, precio, boton de compra y categoria --}}
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-white mb-2">{{ $producto->nombre_comun }}</h3> 

                        <p class="text-gray-500 text-xs italic">{{ $producto->nombre_cientifico }}</p>        
                        
                        <p class="text-gray-400 text-xs line-clamp-2 mt-2">{{ $producto->descripcion }}</p>
                        
                        <div class="flex items-center justify-between bg-black/40 p-2 rounded-lg border border-white/5 mb-5 mt-2">
                            <span class="text-[10px] font-black uppercase tracking-widest" 
                                :class="!estado_vida ? 'text-mangle-toxico' : 'text-gray-500'">Vivo</span>
                            
                            <button @click="estado_vida = !estado_vida" 
                                    class="relative inline-flex h-5 w-10 items-center rounded-full transition-colors focus:outline-none"
                                    :class="estado_vida ? 'bg-ojo-aberracion' : 'bg-mangle-toxico'">
                                <span :class="estado_vida ? 'translate-x-5' : 'translate-x-1'"
                                    class="inline-block h-3 w-3 transform rounded-full bg-white transition-transform"></span>
                            </button>

                            <span class="text-[10px] font-black uppercase tracking-widest" 
                                :class="estado_vida ? 'text-ojo-aberracion' : 'text-gray-500'">Consumo</span>
                        </div>

                        
                        <div class="flex justify-between items-center">
                            <span class="text-coral-electrico font-bold text-lg">${{ number_format($producto->precio, 2) }}</span>
                            {{-- Boton de poner en carrito con AXIOS --}}
                            <button @click="
                                    axios.post('{{ route('carrito.add') }}', {
                                        producto_id: {{ $producto->id }},
                                        tipo_compra: estado_vida ? 'consumo' : 'ornamental'
                                    }).then(response => {
                                        {{-- Si es correcto, se abre el carrito --}}
                                        $dispatch('togglecart');
                                        console.log(response.data.message);
                                    }).catch(error => {
                                        if(error.response.status === 401) {
                                            alert('Debes iniciar sesión en tu bitácora para adquirir criaturas.');
                                            window.location.href = '{{ route('login') }}';
                                        }
                                    })
                                " 
                                class="bg-magma-diablillo px-4 py-2 rounded-lg font-black italic text-xs uppercase hover:scale-105 transition shadow-lg shadow-magma-diablillo/20">
                                <span class="material-symbols-outlined text-white">add_shopping_cart</span>
                            </button>       
                        </div>
                        <span class="text-[9px] bg-white/5 border border-white/10 px-2 py-0.5 rounded-full uppercase tracking-widest font-mono text-gray-400">
                            {{ str_replace('_', ' ', $producto->categoria) }}
                        </span>
                    </div>
                </article>
                @empty
                <div class="col-span-full tarjeta-cristal p-12 text-center text-gray-400 italic">
                    Ninguna criatura ha sobrevivido al ascenso hoy... Inténtalo más tarde.
                </div>
                @endforelse

            </div>
        </div>
    </section>
</div>
@endsection