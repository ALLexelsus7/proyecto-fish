@extends('layouts.app')

{{-- Seccion con las categorias destacadas y features --}}
@section('content')
    <section class="relative h-screen flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-b from-mar-profundo/15 via-terror-submarino/10 to-black/40 -z-10"></div>
        
        <div class="text-center px-4">
            <h1 class="text-6xl md:text-8xl font-black mb-6 tracking-tighter drop-shadow-2xl">
                CAPTURAS DEL <span class="text-magma-diablillo italic">ABISMO</span>
            </h1>
            <p class="text-xl md:text-2xl text-gray-300 max-w-2xl mx-auto mb-10 leading-relaxed">
                Peces exóticos de aguas profundas, seleccionados para la gastronomía de alta gama y acuarios de colección.
            </p>
            <div class="flex flex-col md:flex-row justify-center gap-4">
                <a href="{{ route('productos') }}" class="bg-magma-diablillo hover:bg-ojo-aberracion text-white px-10 py-4 rounded-xl font-bold text-lg transition-all transform hover:scale-105 shadow-lg shadow-magma-diablillo/20">
                    Explorar Catálogo
                </a>
                <a href="#proceso" class="bg-white/5 hover:bg-white/10 border border-white/20 backdrop-blur-md px-10 py-4 rounded-xl font-bold text-lg transition-all">
                    Nuestro Proceso
                </a>
            </div>
        </div>
    </section>

    <section id="proceso" class="bg-gradient-to-b from-black/40 via-black/25 to-black/0 relative h-screen rounded-3xl">
        <div class="max-w-7xl mx-auto px-6 flex flex-col items-center justify-center h-full">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <article class="tarjeta-cristal p-8 text-center border-t-4 border-coral-electrico">
                    <span class="material-symbols-outlined text-5xl text-coral-electrico mb-4">tsunami</span>
                    <h3 class="text-2xl font-bold mb-3 italic">Origen Profundo</h3>
                    <p class="text-gray-400">Capturados a más de 2000 metros bajo el nivel del mar con tecnología de punta.</p>
                </article>

                <article class="tarjeta-cristal p-8 text-center border-t-4 border-ojo-aberracion">
                    <span class="material-symbols-outlined text-5xl text-ojo-aberracion mb-4">ac_unit</span>
                    <h3 class="text-2xl font-bold mb-3 italic">Cadena de Frío</h3>
                    <p class="text-gray-400">Garantizamos la frescura criogénica desde el anzuelo hasta tu mesa o tanque.</p>
                </article>

                <article class="tarjeta-cristal p-8 text-center border-t-4 border-magma-diablillo">
                    <span class="material-symbols-outlined text-5xl text-magma-diablillo mb-4">verified_user</span>
                    <h3 class="text-2xl font-bold mb-3 italic">Exclusividad</h3>
                    <p class="text-gray-400">Solo 5 ejemplares de cada especie disponibles por temporada.</p>
                </article>
            </div>
        </div>
    </section>
@endsection