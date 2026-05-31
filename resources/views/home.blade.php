@extends('layouts.app')
{{-- Uso un fondo distinto en el body --}}
@section('body-background', asset('img/bg/HadalZone.png'))
{{-- Seccion con las categorias destacadas y features --}}
@section('content')
    <section class="relative h-screen flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-b from-mar-profundo/15 via-terror-submarino/10 to-black/40 -z-10"></div>
        
        <div class="text-center px-4">
            {{-- Implemento el efecto parallax en el titulo --}}
            {{-- Ver mas atributos en https://github.com/wagerfield/parallax#22-configuration-options --}}
            <div id="scene" data-hover-only="false" data-invert-x="false" data-invert-y="false">
                <h1 data-depth="0.1"  class="absolute w-full h-full text-6xl md:text-8xl font-black mb-6 tracking-tighter drop-shadow-2xl">
                    CAPTURAS DEL <span class="text-magma-diablillo italic">ABISMO</span>
                </h1>
            </div>
            <p class="text-xl md:text-2xl text-gray-300 max-w-2xl mx-auto mb-10 leading-relaxed">
                Peces exóticos de aguas profundas, seleccionados para la gastronomía de alta gama y acuarios de colección.
            </p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-1 justify-items-center">
                <a href="#proceso" class="bg-white/5 hover:bg-white/10 border border-white/20 backdrop-blur-md px-10 py-4 rounded-xl font-bold text-lg transition-all md:w-auto w-full text-center">
                    Nuestro Proceso
                </a>                             
                <a href="#sitios" class="bg-white/5 hover:bg-white/10 border border-white/20 backdrop-blur-md px-10 py-4 rounded-xl font-bold text-lg transition-all md:w-auto w-full text-center">
                    Sitios de pesca
                </a>
                <a href="{{ route('productos.index') }}" class="bg-magma-diablillo hover:bg-ojo-aberracion text-white px-10 py-4 rounded-xl font-bold text-lg transition-all transform hover:scale-105 shadow-lg shadow-magma-diablillo/20 md:col-span-2 text-center">
                    Explorar Catálogo
                </a>  
            </div>
        </div>
    </section>

    <section id="proceso" class="bg-gradient-to-b from-black/40 via-black/25 to-black/0 relative h-screen rounded-3xl pt-[5rem]">
        <div class="max-w-7xl mx-auto px-6 flex flex-col items-center justify-center h-full">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <article class="tarjeta-cristal p-8 text-center border-t-4 border-coral-electrico rounded-t-2xl">
                    <span class="material-symbols-outlined text-5xl text-coral-electrico mb-4">tsunami</span>
                    <h3 class="text-2xl font-bold mb-3 italic">Origen Profundo</h3>
                    <p class="text-gray-400">Capturados a más de 2000 metros bajo el nivel del mar con tecnología de punta.</p>
                </article>

                <article class="tarjeta-cristal p-8 text-center border-t-4 border-ojo-aberracion rounded-b-2xl">
                    <span class="material-symbols-outlined text-5xl text-ojo-aberracion mb-4">ac_unit</span>
                    <h3 class="text-2xl font-bold mb-3 italic">Cadena de Frío</h3>
                    <p class="text-gray-400">Garantizamos la frescura criogénica desde el anzuelo hasta tu mesa o tanque.</p>
                </article>

                <article class="tarjeta-cristal p-8 text-center border-t-4 border-magma-diablillo rounded-t-2xl">
                    <span class="material-symbols-outlined text-5xl text-magma-diablillo mb-4">verified_user</span>
                    <h3 class="text-2xl font-bold mb-3 italic">Exclusividad</h3>
                    <p class="text-gray-400">Solo 5 ejemplares de cada especie disponibles por temporada.</p>
                </article>
            </div>
        </div>
    </section>

    <section id="sitios" class="relative h-screen rounded-3xl pt-[8rem]">
        {{-- Esto permite precargar las imagenes --}}
        @push('head')
            <link rel="preload" href="{{ asset('img/svg/Sydney.svg') }}" as="image">
            <link rel="preload" href="{{ asset('img/svg/Barcelona.svg') }}" as="image">
            <link rel="preload" href="{{ asset('img/svg/Niza.svg') }}" as="image">
            <link rel="preload" href="{{ asset('img/svg/Rio de Janeiro.svg') }}" as="image">
        @endpush

        <div class="max-w-7xl mx-auto px-6 flex flex-col items-center justify-center h-full" x-data="carruselSitios()" @mouseenter="pause()" @mouseleave="play()">
            {{-- Carrusel con Alpine.js --}}
            <div class="relative w-full md:max-w-3xl">
                {{-- Contenedor de artículos --}}
                <div class="overflow-hidden">
                    <div class="flex transition-transform duration-500 ease-out" :style="`transform: translateX(-${currentIndex * 100}%)`">
                        {{-- Sydney --}}
                        <article class="w-full flex-shrink-0 tarjeta-cristal p-8 text-center border-t-4 border-madera-humeda flex flex-col h-full rounded-2xl">
                            <div class="flex-1 flex items-center justify-center mb-6">
                                <img src="{{ asset('img/svg/Sydney.svg') }}" alt="Sydney" class="w-full h-auto max-h-96 object-contain rounded-[6rem]" loading="eager" fetchpriority="high" width="960" height="768">
                            </div>
                            <div class="flex-none">
                                <h3 class="text-2xl font-bold mb-3 italic">Sidney, Australia</h3>
                                <p class="text-gray-200 text-sm">Aguas del océano Pacífico, profundidades extremas con biodiversidad única.</p>
                            </div>
                        </article>

                        {{-- Barcelona --}}
                        <article class="w-full flex-shrink-0 tarjeta-cristal p-8 text-center border-t-4 border-madera-humeda flex flex-col h-full rounded-2xl">
                            <div class="flex-1 flex items-center justify-center mb-6">
                                <img src="{{ asset('img/svg/Barcelona.svg') }}" alt="Barcelona" class="w-full h-auto max-h-96 object-contain rounded-[6rem]" loading="eager" fetchpriority="high" width="960" height="768">
                            </div>
                            <div class="flex-none">
                                <h3 class="text-2xl font-bold mb-3 italic">Barcelona, España</h3>
                                <p class="text-gray-200 text-sm">Mar Mediterráneo, zona de captura controlada con estándares europeos.</p>
                            </div>
                        </article>

                        {{-- Niza --}}
                        <article class="w-full flex-shrink-0 tarjeta-cristal p-8 text-center border-t-4 border-madera-humeda flex flex-col h-full rounded-2xl">
                            <div class="flex-1 flex items-center justify-center mb-6">
                                <img src="{{ asset('img/svg/Niza.svg') }}" alt="Niza" class="w-full h-auto max-h-96 object-contain rounded-[6rem]" loading="eager" fetchpriority="high" width="960" height="768">
                            </div>
                            <div class="flex-none">
                                <h3 class="text-2xl font-bold mb-3 italic">Niza, Francia</h3>
                                <p class="text-gray-200 text-sm">Costa Azul, tradición pesquera centenaria y aguas cristalinas.</p>
                            </div>
                        </article>

                        {{-- Rio de Janeiro --}}
                        <article class="w-full flex-shrink-0 tarjeta-cristal p-8 text-center border-t-4 border-madera-humeda flex flex-col h-full rounded-2xl">
                            <div class="flex-1 flex items-center justify-center mb-6">
                                <img src="{{ asset('img/svg/Rio de Janeiro.svg') }}" alt="Rio de Janeiro" class="w-full h-auto max-h-96 object-contain rounded-[6rem]" loading="eager" fetchpriority="high" width="960" height="768">
                            </div>
                            <div class="flex-none">
                                <h3 class="text-2xl font-bold mb-3 italic">Rio de Janeiro, Brasil</h3>
                                <p class="text-gray-200 text-sm">Atlántico Sur, especies tropicales y subtropicales de aguas profundas.</p>
                            </div>
                        </article>
                    </div>
                </div>

                {{-- Botones de navegacion --}}
                <button @click="prev()" class="absolute -left-4 md:-left-16 top-1/2 -translate-y-1/2 flex items-center justify-center bg-magma-diablillo hover:bg-ojo-aberracion text-white p-3 rounded-full transition-all transform hover:scale-110">
                    <span class="material-symbols-outlined">arrow_back</span>
                </button>
                <button @click="next()" class="absolute -right-4 md:-right-16 top-1/2 -translate-y-1/2 flex items-center justify-center bg-magma-diablillo hover:bg-ojo-aberracion text-white p-3 rounded-full transition-all transform hover:scale-110">
                    <span class="material-symbols-outlined">arrow_forward</span>
                </button>

                {{-- Indicadores (dots) --}}
                <div class="flex justify-center gap-2 mt-8">
                    <template x-for="(item, index) in sitios" :key="index">
                        <button 
                            @click="currentIndex = index" 
                            :class="`w-3 h-3 rounded-full transition-all ${currentIndex === index ? 'bg-magma-diablillo w-8' : 'bg-white/90 hover:bg-white/50'}`"
                        ></button>
                    </template>
                </div>
            </div>
        </div>
    </section>
    {{-- Inicio el efecto parallax --}}
    @push('scripts')
    <script>
        var scene = document.getElementById('scene');
        var parallaxInstance = new Parallax(scene);
    </script>
    @endpush
@endsection