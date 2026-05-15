@extends('layouts.app')

@section('content')
<div class="min-h-screen py-64 flex items-center justify-center">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
        
        {{-- Titulo --}}
        <div class="tarjeta-cristal p-8 border-l-8 border-magma-diablillo flex justify-between items-center">
            <div>
                <h2 class="text-3xl font-black text-white italic tracking-tighter">PANEL DE <span class="text-magma-diablillo">ADMINISTRACIÓN</span></h2>
                <p class="text-gray-400">Bienvenido Comandante <span class="text-fuchsia-500 uppercase">{{ Auth::user()->name }}</span>. Los sistemas MySQL están en línea.</p>
            </div>            
        </div>

        {{-- Datos estadisticos rapidos --}}
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

        {{-- Gestión de Inventario --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <a href="{{ route('admin.productos.index') }}" class="group tarjeta-cristal p-8 border border-white/10 hover:border-magma-diablillo transition-all cursor-pointer">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold text-white">Gestión de Inventario</h3>
                    <span class="material-symbols-outlined text-gray-500 group-hover:text-magma-diablillo transition">arrow_forward</span>
                </div>
                <p class="text-gray-400 text-sm">Visualiza la tabla completa de especies, edita información, actualiza precios y elimina registros obsoletos.</p>
            </a>          
        </div>

        {{-- Hisorial de pedidos --}}
        <div class="flex justify-between items-end mb-8">
            <div>
                <h2 class="text-3xl font-black text-white italic tracking-tighter uppercase">Monitor de <span class="text-coral-electrico">Pedidos</span></h2>
                <p class="text-gray-400 text-sm">Gestión global de ventas y logística de entrega.</p>
            </div>
            <div class="flex gap-2">
                <span class="bg-black/40 text-xs text-gray-400 p-2 rounded border border-white/5 italic">Total Ventas: $45,200.00</span>
            </div>
        </div>

        <div class="tarjeta-cristal overflow-hidden border border-white/5">
            <table class="w-full text-left text-sm">
                <thead class="bg-black/60 text-white uppercase font-black tracking-widest border-b border-white/10">
                    <tr>
                        <th class="px-6 py-4">Orden</th>
                        <th class="px-6 py-4">Cliente</th>
                        <th class="px-6 py-4">Detalle</th>
                        <th class="px-6 py-4">Total</th>
                        <th class="px-6 py-4">Estatus</th>
                        <th class="px-6 py-4 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5 text-gray-300">
                    <tr class="hover:bg-white/5 transition">
                        <td class="px-6 py-4 font-mono">#EXP-102</td>
                        <td class="px-6 py-4">
                            <div class="flex flex-col">
                                <span class="text-white font-bold">Alex Ruiz</span>
                                <span class="text-[10px] text-gray-500">alex@abyssal.com</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">3x Pez Linterna (Ornamental)</td>
                        <td class="px-6 py-4 font-bold text-coral-electrico">$4,500</td>
                        <td class="px-6 py-4">
                            <select class="bg-black/40 border-none text-[10px] uppercase font-black rounded text-magma-diablillo focus:ring-0">
                                <option>Pendiente</option>
                                <option>En Camino</option>
                                <option selected>Entregado</option>
                            </select>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <button class="text-gray-500 hover:text-white transition">
                                <span class="material-symbols-outlined">visibility</span>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection