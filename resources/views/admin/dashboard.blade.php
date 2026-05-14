@extends('layouts.app')

@section('content')
<div class="py-12 min-h-screen flex items-center justify-center">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
        
        <div class="tarjeta-cristal p-8 border-l-8 border-magma-diablillo flex justify-between items-center">
            <div>
                <h2 class="text-3xl font-black text-white italic tracking-tighter">PANEL DE <span class="text-magma-diablillo">ADMINISTRACIÓN</span></h2>
                <p class="text-gray-400">Bienvenido Comandante <span class="text-fuchsia-500">{{ Auth::user()->name }}</span>. Los sistemas MySQL están en línea.</p>
            </div>            
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="tarjeta-cristal p-6 flex items-center gap-4 border border-white/5">
                <div class="p-4 bg-coral-electrico/20 rounded-lg text-coral-electrico">
                    <span class="material-symbols-outlined text-3xl">phishing</span>
                </div>
                <div>
                    <p class="text-sm text-gray-400 font-bold uppercase">Especies en BD</p>
                    <p class="text-3xl font-black text-white">42</p> </div>
            </div>

            <div class="tarjeta-cristal p-6 flex items-center gap-4 border border-white/5">
                <div class="p-4 bg-green-500/20 rounded-lg text-green-400">
                    <span class="material-symbols-outlined text-3xl">inventory_2</span>
                </div>
                <div>
                    <p class="text-sm text-gray-400 font-bold uppercase">Stock Total</p>
                    <p class="text-3xl font-black text-white">1,204</p>
                </div>
            </div>

            <div class="tarjeta-cristal p-6 flex items-center gap-4 border border-white/5">
                <div class="p-4 bg-magma-diablillo/20 rounded-lg text-magma-diablillo">
                    <span class="material-symbols-outlined text-3xl">warning</span>
                </div>
                <div>
                    <p class="text-sm text-gray-400 font-bold uppercase">Sin Stock</p>
                    <p class="text-3xl font-black text-white">3</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <a href="{{ route('admin.productos.index') }}" class="group tarjeta-cristal p-8 border border-white/10 hover:border-magma-diablillo transition-all cursor-pointer">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold text-white">Gestión de Inventario</h3>
                    <span class="material-symbols-outlined text-gray-500 group-hover:text-magma-diablillo transition">arrow_forward</span>
                </div>
                <p class="text-gray-400 text-sm">Visualiza la tabla completa de especies, edita información, actualiza precios y elimina registros obsoletos.</p>
            </a>

            <a href="#" class="group tarjeta-cristal p-8 border border-white/10 hover:border-coral-electrico transition-all cursor-pointer">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold text-white">Monitor de Pedidos</h3>
                    <span class="material-symbols-outlined text-gray-500 group-hover:text-coral-electrico transition">arrow_forward</span>
                </div>
                <p class="text-gray-400 text-sm">Revisa las expediciones en curso, marca pedidos como entregados y revisa el historial de ventas.</p>
            </a>
        </div>

    </div>
</div>
@endsection