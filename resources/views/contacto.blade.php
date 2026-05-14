@extends('layouts.app')
{{-- https://gradienty.codes/#google_vignette --}}
{{-- @section('body-style', 'background: linear-gradient(to bottom left, #84cc16, #16a34a, #0f766e);') --}}
@section('body-background', asset('img/bg/office2.jpeg'))
{{-- Seccion con el formulario de contacto --}}
@section('content')
<section class="relative min-h-screen pt-60 pb-20 flex items-center justify-center bg-fixed bg-cover bg-center">
  
    <div class="absolute inset-0 bg-gradient-to-b from-black/80 via-black/25 to-black/0 -z-10"></div>  

    <div class="relative z-10 max-w-5xl w-full mx-4 grid grid-cols-1 md:grid-cols-2 gap-10">
        
        <div class="text-white space-y-8">
            <div>
                <h1 class="text-5xl font-black tracking-tighter mb-4">CONTACTO <span class="text-magma-diablillo">ABISAL</span></h1>
                <p class="text-gray-300 text-lg">¿Buscas una especie en particular o necesitas un pedido mayorista? Envíanos una señal de sonar.</p>
            </div>

            <div class="space-y-6">
                <div class="flex items-center gap-4 group">
                    <div class="w-12 h-12 rounded-full bg-magma-diablillo flex items-center justify-center group-hover:scale-110 transition">
                        <span class="material-symbols-outlined">location_on</span>
                    </div>
                    <div>
                        <h4 class="font-bold text-coral-electrico">Ubicación</h4>
                        <p class="text-sm">Zapopan, Jalisco. Sector Industrial.</p>
                    </div>
                </div>

                <div class="flex items-center gap-4 group">
                    <div class="w-12 h-12 rounded-full bg-coral-electrico flex items-center justify-center group-hover:scale-110 transition">
                        <span class="material-symbols-outlined">mail</span>
                    </div>
                    <div>
                        <h4 class="font-bold text-coral-electrico">Email</h4>
                        <p class="text-sm">expediciones@abyssalcatch.com</p>
                    </div>
                </div>
            </div>
        </div>

        <form action="#" class="tarjeta-cristal p-8 space-y-5 border border-white/10 text-white">
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label class="text-xs font-bold uppercase tracking-widest">Nombre</label>
                    <input type="text" class="w-full bg-white/5 border border-white/10 rounded-lg p-3 text-white focus:border-magma-diablillo focus:ring-1 focus:ring-magma-diablillo outline-none transition">
                </div>
                <div class="space-y-2">
                    <label class="text-xs font-bold uppercase tracking-widest">Asunto</label>
                    <input type="text" class="w-full bg-white/5 border border-white/10 rounded-lg p-3 text-white focus:border-magma-diablillo focus:ring-1 focus:ring-magma-diablillo outline-none transition">
                </div>
            </div>

            <div class="space-y-2">
                <label class="text-xs font-bold uppercase tracking-widest">Correo Electrónico</label>
                <input type="email" class="w-full bg-white/5 border border-white/10 rounded-lg p-3 text-white focus:border-magma-diablillo focus:ring-1 focus:ring-magma-diablillo outline-none transition">
            </div>

            <div class="space-y-2">
                <label class="text-xs font-bold uppercase tracking-widest">Mensaje</label>
                <textarea rows="4" class="w-full bg-white/5 border border-white/10 rounded-lg p-3 focus:border-magma-diablillo focus:ring-1 focus:ring-magma-diablillo outline-none transition"></textarea>
            </div>

            <button type="submit" class="w-full bg-magma-diablillo hover:bg-ojo-aberracion hover:text-terror-submarino font-black py-4 rounded-xl shadow-lg shadow-magma-diablillo/20 transition-all transform hover:-translate-y-1">
                ENVIAR SEÑAL
            </button>
        </form>
    </div>
</section>
@endsection