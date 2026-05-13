@extends('layouts.app')

@section('content')
    <div class="min-h-screen flex items-center justify-center">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="tarjeta-cristal p-8 text-white mb-8 border-l-8 border-magma-diablillo">
                <h3 class="text-3xl font-black italic">BITÁCORA DE CONTROL</h3>
                <p class="mt-2 text-gray-300">Bienvenido de nuevo, Comandante <span class="text-magma-diablillo font-bold">{{ Auth::user()->name }}</span>.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                {{-- <div class="tarjeta-cristal p-6 hover:scale-105 transition-transform border border-magma-diablillo/30">
                    <div class="flex items-center gap-4 mb-4">
                        <span class="material-symbols-outlined text-magma-diablillo text-4xl">inventory_2</span>
                        <h4 class="text-xl font-bold">Gestión de Stock</h4>
                    </div>
                    <p class="text-sm text-gray-400 mb-4">Añade nuevas capturas abisales o actualiza precios.</p>
                    <a href="#" class="inline-block bg-magma-diablillo px-4 py-2 rounded font-bold text-xs">ADMINISTRAR</a>
                </div> --}}

                <div class="tarjeta-cristal p-6 hover:scale-105 transition-transform border border-coral-electrico/30">
                    <div class="flex items-center gap-4 mb-4">
                        <span class="material-symbols-outlined text-coral-electrico text-4xl">shopping_bag</span>
                        <h4 class="text-xl font-bold">Mis Pedidos</h4>
                    </div>
                    <p class="text-sm text-gray-400 mb-4">Rastrea tus envíos criogénicos en tiempo real.</p>
                    <a href="#" class="inline-block bg-coral-electrico text-mar-profundo px-4 py-2 rounded font-bold text-xs">VER ESTADO</a>
                </div>

            </div>
        </div>
    </div>
@endsection