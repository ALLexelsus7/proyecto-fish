@extends('layouts.app')
@section('body-background', asset('img/bg/table2.jpeg'))
{{-- Gestion del usuario --}}
@section('content')
<div class="min-h-screen py-64" x-data="{ tab: 'pedidos' }">
    <div class="absolute inset-0 bg-gradient-to-b from-black/80 via-black/45 to-black/0 -z-10"></div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        {{-- Cambio de tabs --}}
        <div class="tarjeta-cristal p-8 mb-8 border-l-8 border-magma-diablillo flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h2 class="text-4xl font-black text-white italic tracking-tighter">MI <span class="text-magma-diablillo">BITÁCORA</span></h2>
                <p class="text-gray-200 text-xs tracking-[0.2em] font-bold">Registro de expediciones de <span class="text-red-400 font-bold uppercase">{{ Auth::user()->name }}</span>.</p>
            </div>
            
            <div class="flex bg-black/40 p-1 rounded-xl border border-white/10">
                <button @click="tab = 'pedidos'" 
                        :class="tab === 'pedidos' ? 'bg-magma-diablillo text-white' : 'text-gray-500 hover:text-white'"
                        class="px-6 py-2 rounded-lg font-black italic transition-all uppercase text-sm flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">history</span> Historial
                </button>
                <button @click="tab = 'favoritos'" 
                        :class="tab === 'favoritos' ? 'bg-magma-diablillo text-white' : 'text-gray-500 hover:text-white'"
                        class="px-6 py-2 rounded-lg font-black italic transition-all uppercase text-sm flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">heart_check</span> Favoritos
                </button>
                <button class="px-6 py-2 rounded-lg font-black italic transition-all uppercase text-sm flex items-center gap-2">                   
                    <a href="{{ route('profile.edit') }}" class="text-gray-400 hover:text-white transition flex items-center gap-2 text-xs font-bold uppercase tracking-widest">
                        <span class="material-symbols-outlined text-sm">settings</span>
                        Configurar Perfil
                    </a>
                </button>
            </div>
        </div>

        {{-- Tab de historial de pedidos --}}
        <div x-show="tab === 'pedidos'" x-transition:enter="fade-in">
            <div class="tarjeta-cristal overflow-hidden border border-white/5">
                <table class="w-full text-left">
                    <thead class="bg-black/60 text-magma-diablillo uppercase text-xs font-black tracking-widest">
                        <tr>
                            <th class="px-6 py-4">ID Expedición</th>
                            <th class="px-6 py-4">Fecha</th>
                            <th class="px-6 py-4">Especies</th>
                            <th class="px-6 py-4">Total</th>
                            <th class="px-6 py-4 text-right">Estatus</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5 text-white">
                        <tr class="hover:bg-white/5 transition">
                            <td class="px-6 py-4 font-mono text-gray-400">#AB-9923</td>
                            <td class="px-6 py-4">12 May 2026</td>
                            <td class="px-6 py-4">2x Pez Quimera</td>
                            <td class="px-6 py-4 font-bold text-coral-electrico">$3,200.00</td>
                            <td class="px-6 py-4 text-right">
                                <span class="bg-green-500/20 text-green-400 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-tighter">Enviado</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Tab de favoritos --}}
        <div x-show="tab === 'favoritos'" x-transition:enter="fade-in" style="display: none;">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="tarjeta-cristal p-4">
                    <p class="text-gray-500 italic text-center py-10">Tu acuario de favoritos está vacío por ahora.</p>
                </div>
            </div>
        </div>       

    </div>
</div>
@endsection