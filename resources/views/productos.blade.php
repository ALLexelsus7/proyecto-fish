@extends('layouts.app')
{{-- Seccion con el catalogo de peces --}}
@section('content')
{{-- Invocar el componente de carga --}}
@include('components.loader')
<div>    
    {{-- Animación de descenso una sola vez por sesion --}}
    <section x-data="{ 
                animacionVista: sessionStorage.getItem('descenso_{{ session()->getId() }}'),
                iniciarOmision() {
                    sessionStorage.setItem('descenso_{{ session()->getId() }}', 'true');
                    this.animacionVista = true;
                }
             }"
             x-show="!animacionVista"
             x-init="if(!animacionVista) { setTimeout(() => iniciarOmision(), 10000) }"
             x-transition:leave="transition ease-in duration-700 opacity-0 translate-y-[-10%]"
             class="relative h-screen w-full bg-cover bg-no-repeat animacion-descenso flex items-center justify-center"
             style="background-image: url('{{ asset('img/bg/bg_expanded6.png') }}');">
        
        <div class="absolute inset-0 bg-black/10"></div>
        
        <div class="relative z-10 text-center">
            <h2 class="text-5xl md:text-7xl font-black text-white italic tracking-widest drop-shadow-2xl">
                DESCENDIENDO...
            </h2>
            <p class="text-coral-electrico font-bold mt-4">Explorando la zona abisal</p>
            <button @click="iniciarOmision()" class="mt-8 px-4 py-2 border border-white/20 text-xs text-gray-400 hover:text-white hover:border-white transition-all rounded">
                Omitir Secuencia ⏭
            </button>
        </div>
    </section>

    {{-- Catalogo y alpine para sidebar con filtros --}}
    <section id="catalogo" x-data="{ filtrosOpen: false }" class="relative pt-40 bg-gradient-to-b from-black/100 via-black/5 to-black/0 min-h-screen">        
        <div class="max-w-7xl mx-auto px-6">
            {{-- Titulo y boton de filtro --}}
            <div class="text-center mb-16 flex flex-col items-center justify-center gap-4">
                <h2 class="text-4xl font-bold text-white mb-2">Nuestro Catálogo Exótico</h2>
                <div class="h-1 w-24 bg-magma-diablillo mx-auto -mt-3 mb-3"></div>
                <button @click="filtrosOpen = true" class="flex items-center gap-2 bg-black/50 hover:bg-magma-diablillo text-white border border-white/20 py-2 px-6 rounded-lg transition shadow-lg shadow-black/50">
                    <span class="material-symbols-outlined">tune</span>
                    <span class="font-bold tracking-widest text-sm uppercase">Filtros Avanzados</span>
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">               

                
                {{-- Se recorre cada producto de la base de datos --}}
                @forelse($productos as $producto)
                {{-- Se comprueba antes si un pez es favorito --}}
                @php                    
                    $esFavorito = in_array($producto->id, $favoritosUser);
                @endphp
                {{-- Alpine.js para seleccionar favoritos y categoria --}}
                <article class="tarjeta-cristal overflow-hidden group hover:border-magma-diablillo transition-all 
                         duration-700 ease-out opacity-0 translate-y-12 observar-tarjeta rounded-lg"
                        {{-- opacity-0 y Translate-y-12 oculta las tarjetas hasta que entren en pantalla con el script --}}
                         x-data="{ 
                            tipoSeleccionado: '{{ $producto->estado_vida === 'consumo' ? 'consumo' : 'ornamental' }}', 
                            puedeCambiar: {{ $producto->estado_vida === 'ambos' ? 'true' : 'false' }},
                            esFavorito: {{ $esFavorito ? 'true' : 'false' }}
                        }">

                {{-- OVERLAY de "sin stock" cuando es 0 --}}
                @if($producto->stock <= 0)
                    <div class="absolute inset-0 z-20 flex items-center justify-center bg-black/40 backdrop-blur-[2px]">
                        <div class="bg-red-600/80 text-white font-black text-xl px-6 py-2 uppercase tracking-widest border-2 border-white/20 shadow-2xl shadow-red-600/50 transform -rotate-12">
                            Agotado
                        </div>
                    </div>
                @endif
                        
                    {{-- Boton fav --}}                    
                    <button @click.prevent="
                            @auth
                                // Si está logueado, disparamos a nuestra ruta toggle
                                axios.post('{{ url('/favoritos/toggle') }}/{{ $producto->id }}')
                                    .then(response => {
                                        // Cambiamos el estado reactivo según lo que diga el backend
                                        esFavorito = response.data.es_favorito;
                                    })
                                    .catch(error => console.error('Error en el radar:', error));
                            @else
                                // Si no está logueado, lo mandamos a identificarse
                                window.location.href = '{{ route('login') }}';
                            @endauth
                            "
                            class="z-20 absolute top-4 right-4 p-2 rounded-full bg-black/40 backdrop-blur-md transition-all border border-white/10 flex items-center justify-center hover:bg-pink-500"
                            :class="esFavorito ? 'text-white bg-pink-500 border-white' : 'text-gray-400 hover:text-white'">
                        <span class="material-symbols-outlined transition-transform" 
                            :class="esFavorito ? 'fill-1 scale-110' : 'fill-0'">
                            favorite
                        </span>
                    </button>
                    
                    {{-- Imagen (se pone gris si no hay stock) --}}
                    <div class="h-56 overflow-hidden bg-white/5 flex items-center justify-center p-4 rounded-md">
                        <img src="{{ asset('img/fish/' . $producto->imagen_url ?? 'img/peces/fish1.png') }}" {{-- la segunda opcion es por si acaso --}}
                            alt="{{ $producto->nombre_comun }}" 
                            class="w-full h-full object-contain transform group-hover:scale-105 transition-transform duration-500
                                    {{ $producto->stock <= 0 ? 'grayscale blur-[1px]' : '' }}">
                    </div>
                    
                    <div class="p-6">
                        {{-- Nombre común, cientifico, breve descripcion y stock --}}
                        <h3 class="text-xl font-bold text-white mb-2">{{ $producto->nombre_comun }}</h3> 
                        <p class="text-gray-500 text-xs italic">{{ $producto->nombre_cientifico }}</p>                       
                        <p class="text-gray-400 text-xs line-clamp-2 mt-2">{{ $producto->descripcion }}</p>
                        <p class="text-xs mt-1 {{ $producto->stock > 0 ? 'text-gray-600' : 'text-red-400 font-bold' }}">
                            Stock: {{ $producto->stock > 0 ? $producto->stock . ' unidades' : '0 unidades' }}
                        </p>
                        
                        {{-- Toggle de categoria --}}
                        <div class="flex items-center justify-between bg-black/40 p-2 rounded-lg border border-white/5 mb-5 mt-2">    
                            <span class="text-[10px] font-black uppercase tracking-widest transition-colors" 
                                :class="tipoSeleccionado === 'ornamental' ? 'text-mangle-toxico' : 'text-gray-500'">
                                Vivo
                            </span>                            
                            <button @click="if(puedeCambiar) tipoSeleccionado = (tipoSeleccionado === 'ornamental' ? 'consumo' : 'ornamental')" 
                                    :disabled="!puedeCambiar"
                                    class="relative inline-flex h-5 w-10 items-center rounded-full transition-all focus:outline-none"
                                    :class="[
                                        tipoSeleccionado === 'consumo' ? 'bg-ojo-aberracion' : 'bg-mangle-toxico', 
                                        !puedeCambiar ? 'opacity-30 cursor-not-allowed scale-95' : 'hover:scale-105'
                                    ]">
                                <span :class="tipoSeleccionado === 'consumo' ? 'translate-x-5' : 'translate-x-1'" 
                                    class="inline-block h-3 w-3 transform rounded-full bg-white transition-transform"></span>
                            </button>
                            <span class="text-[10px] font-black uppercase tracking-widest transition-colors" 
                                :class="tipoSeleccionado === 'consumo' ? 'text-ojo-aberracion' : 'text-gray-500'">
                                Consumo
                            </span>
                        </div>

                        {{-- Precio y Agregar al carrito con AXIOS --}}
                        <div class="flex justify-between items-center">
                            <span class="text-coral-electrico font-bold text-lg">${{ number_format($producto->precio, 2) }}</span> 
                            @if($producto->stock > 0) {{-- Hay stock --}}                           
                                <button @click="axios.post('{{ route('carrito.add') }}', {
                                            producto_id: {{ $producto->id }},
                                            tipo_compra: tipoSeleccionado, {{-- Se manda exactamente lo que la UI tenga activo --}}
                                        }).then(response => {
                                            $dispatch('togglecart');
                                            console.log(response.data.message);
                                        }).catch(error => {
                                            if(error.response.status === 401) {
                                                alert('Debes iniciar sesión en tu bitácora para adquirir criaturas.');
                                                window.location.href = '{{ route('login') }}';
                                            }
                                        })
                                    "
                                    class="bg-magma-diablillo px-3 py-2 rounded-lg font-black italic text-xs uppercase hover:scale-105 transition shadow-lg shadow-magma-diablillo/20">
                                    <span class="material-symbols-outlined text-white">add_shopping_cart</span>
                                    {{-- OJO, aqui la logica es: al darle al boton se guarda el producto en la tabla de carrito con AXIOS por si algun
                                        problema externo cierra la pagina y pierde los datos. Luego, al instante se refleja en la UI del lateral del 
                                        carrito con alpine.js. Al darle "Hacer pedido" se actualiza el stock de productos, se actualiza la tabla pedido, 
                                        se congela en detalles pedidos y se borra la tabla de carrito del usuario junto a la UI del carrito --}}
                                </button> 
                            @else {{-- No hay stock, boton desactivado --}}                                
                                <button disabled class="bg-gray-800 text-gray-500 px-3 py-2 rounded-lg font-black italic text-xs uppercase cursor-not-allowed">
                                    <span class="material-symbols-outlined align-middle">block</span>
                                </button>
                            @endif
                        </div>
                        {{-- Categoria --}}
                        <span class="text-[9px] bg-white/5 border border-white/10 px-2 py-0.5 rounded-full uppercase tracking-widest font-mono text-gray-400">
                            {{ str_replace('_', ' ', $producto->categoria) }}
                        </span>
                    </div>
                </article>
                @empty
                <div class="col-span-full tarjeta-cristal p-12 text-center text-gray-400 italic rounded-lg">
                    Ninguna criatura ha sobrevivido al ascenso hoy... Inténtalo más tarde.
                </div>
                @endforelse

            </div>

            {{-- Paginación de Laravel --}}
            <div class="mt-12">
                {{ $productos->links() }}
            </div>

        </div>

        {{-- Invoco el componente de filtros --}}
        @include('components.filtros-sidebar')

    </section>
</div>
@endsection