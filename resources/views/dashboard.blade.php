@extends('layouts.app')
@section('body-background', asset('img/bg/table2.jpeg'))
{{-- Gestion del usuario --}}
@section('content')
<div class="min-h-screen pt-48" x-data="{ tab: 'pedidos' }">
    <div class="absolute inset-0 bg-gradient-to-b from-black/80 via-black/45 to-black/0 -z-10"></div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        {{-- Tarjeta con acciones y Cambio de tabs --}}
        <div class="tarjeta-cristal p-8 mb-8 border-l-8 border-magma-diablillo flex flex-col md:flex-row justify-between items-start md:items-center gap-4 rounded-l-3xl rounded-r-lg">
            
            {{-- Avatar con indicador de estado --}}
            <div class="relative shrink-0 hover:scale-105 transition-transform duration-300">
                <img src="{{ Auth::user()->avatar_url }}" alt="Avatar de {{ Auth::user()->name }}" 
                    class="w-24 h-24 sm:w-32 sm:h-32 rounded-full object-cover border-4 border-magma-diablillo/40 shadow-xl shadow-magma-diablillo/20">
                
                {{-- Puntito verde de "En Línea" / "Sistemas Activos" --}}
                <div class="absolute bottom-2 right-2 w-5 h-5 sm:w-6 sm:h-6 bg-green-500 border-4 border-gray-900 rounded-full" title="Conexión Abisal Estable"></div>
            </div>
            
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
            <div class="tarjeta-cristal overflow-hidden border border-white/5 rounded-lg">
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
                        @forelse ($pedidos as $pedido)
                            <tr class="hover:bg-white/5 transition">
                                <td class="px-6 py-4 font-mono text-gray-400">
                                    #AB-{{ str_pad($pedido->id, 4, '0', STR_PAD_LEFT) }}
                                    {{-- str_pad le da un formato a la cadena --}}
                                </td>
                                
                                <td class="px-6 py-4">
                                    {{ $pedido->created_at->format('d M Y') }}
                                </td>
                                
                                <td class="px-6 py-4 text-xs text-gray-300">
                                    @foreach($pedido->detalles as $detalle)
                                        <div class="truncate max-w-[200px]">
                                            <span class="text-magma-diablillo font-bold">{{ $detalle->cantidad }}x</span> 
                                            {{ $detalle->producto->nombre_comun ?? 'Especie clasificada' }}
                                        </div>
                                    @endforeach
                                </td>
                                
                                <td class="px-6 py-4 font-bold text-coral-electrico">
                                    ${{ number_format($pedido->total, 2) }}
                                </td>
                                
                                <td class="px-6 py-4 text-right">
                                    @if($pedido->estado === 'pendiente')
                                        <span class="bg-yellow-500/20 text-yellow-400 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-tighter">Procesando</span>
                                    @elseif($pedido->estado === 'enviado')
                                        <span class="bg-blue-500/20 text-blue-400 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-tighter">En Tránsito</span>
                                    @elseif($pedido->estado === 'entregado')
                                        <span class="bg-green-500/20 text-green-400 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-tighter">Capturado</span>
                                    @else
                                        <span class="bg-gray-500/20 text-gray-400 px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-tighter">{{ $pedido->estado }}</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-gray-500 italic text-sm">
                                    Tu bitácora está en blanco. No hay registro de expediciones aún.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Tab de favoritos --}}
        <div x-show="tab === 'favoritos'" x-transition:enter="fade-in" style="display: none;">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($favoritos as $producto)
                    <div class="tarjeta-cristal p-4 relative flex flex-col justify-between group border border-white/5 overflow-hidden rounded-3xl" 
                        id="fav-card-{{ $producto->id }}"
                        x-data="{ eliminado: false }"
                        x-show="!eliminado"
                        x-transition:leave="transition ease-in duration-300 transform opacity-0 scale-95">
                        
                        <div>
                            <div class="w-full h-40 bg-black/40 rounded-xl overflow-hidden relative mb-4 flex items-center justify-center">
                                <img src="{{ asset('img/fish/' . $producto->imagen_url ?? 'img/peces/fish1.png') }}" 
                                    alt="{{ $producto->nombre_comun }}" 
                                    class="w-90% h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            </div>

                            <h3 class="text-lg font-black text-white italic tracking-tight">{{ $producto->nombre_comun }}</h3>
                            <p class="text-xs text-gray-400 font-mono italic mb-2">{{ $producto->nombre_cientifico }}</p>
                            <p class="text-xl font-bold text-coral-electrico mb-4">${{ number_format($producto->precio, 2) }}</p>
                        </div>

                        <div class="flex gap-2">                            
                            <button @click.prevent="axios.post('{{ route('favoritos.toggle', $producto->id) }}').then(r => eliminado = true).catch(e => console.error(e))" 
                                    class="p-2 bg-red-500/50 hover:bg-magma-diablillo text-white rounded-xl transition-all" 
                                    title="Remover del radar">
                                <span class="material-symbols-outlined text-sm block">delete</span>
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full tarjeta-cristal p-8 border border-white/5 text-center rounded-3xl">
                        <span class="material-symbols-outlined text-4xl text-gray-600 mb-2">heart_broken</span>
                        <p class="text-gray-400 italic text-sm">Tu acuario de favoritos está vacío por ahora.</p>
                        <a href="{{ url('/productos') }}" class="inline-block mt-4 text-xs font-black text-magma-diablillo uppercase italic tracking-wider hover:underline">
                            Explorar el catálogo →
                        </a>
                    </div>
                @endforelse
            </div>
        </div>   

    </div>
</div>
@endsection