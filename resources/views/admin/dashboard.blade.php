@extends('layouts.app')

@section('content')
<div class="min-h-screen py-64 flex items-center justify-center">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
        
        {{-- Titulo, config. perfil y musica de fondo On-Demand que solo se escucha en esta vista --}}
        <div class="tarjeta-cristal p-8 border-l-8 border-magma-diablillo flex justify-between items-center">
            <div>
                <h2 class="text-3xl font-black text-white italic tracking-tighter">PANEL DE <span class="text-magma-diablillo">ADMINISTRACIÓN</span></h2>
                <p class="text-gray-400">Bienvenido Comandante <span class="text-fuchsia-500 uppercase">{{ Auth::user()->name }}</span>. Los sistemas MySQL están en línea.</p>
            </div>  
            <div class="flex items-center gap-6">
                <div x-data="{ 
                        playing: false, 
                        audio: null,
                        toggleAudio() {
                            if (!this.audio) {
                                // El archivo SOLO se empieza a descargar en este instante
                                this.audio = new Audio('{{ asset('audio/Lo-Fi_Abyssal_2.0.mp3') }}');
                                this.audio.loop = true;
                                this.audio.volume = 0.3; 
                            }
                            
                            if (this.playing) {
                                this.audio.pause();
                            } else {
                                this.audio.play().catch(e => console.log('Interacción requerida:', e));
                            }
                            this.playing = !this.playing;
                        }
                    }" 
                    class="hover:scale-105 transition-all cursor-pointer flex flex-col items-center justify-center">
                    <button @click="toggleAudio()" class="focus:outline-none group">
                        <span class="material-symbols-outlined text-4xl transition-colors duration-300"
                              :class="playing ? 'text-mangle-toxico animate-pulse' : 'text-gray-500 group-hover:text-gray-300'">
                            <span x-text="playing ? 'volume_up' : 'volume_off'">volume_off</span>
                        </span>   
                        <p class="text-xs font-bold mt-1 text-center transition-colors duration-300"
                           :class="playing ? 'text-mangle-toxico' : 'text-gray-500 group-hover:text-gray-300'">
                            Sónar Ambiental
                        </p>
                    </button>
                </div>

                {{-- Config. Perfil --}}
                <div class="hover:scale-105 transition-all cursor-pointer flex flex-col items-center justify-center">
                    <a href="{{ route('profile.edit') }}" class="flex flex-col items-center">
                        <span class="material-symbols-outlined text-4xl text-luz-de-linterna">admin_panel_settings</span>   
                        <p class="text-xs text-luz-de-linterna font-bold mt-1 text-center">Config. Perfil</p>
                    </a>
                </div>  
            </div>       
        </div>

        {{-- Datos estadisticos rapidos --}}
        <div class="grid grid-cols-2 lg:grid-cols-5 gap-4">
            
            <div class="tarjeta-cristal p-4 flex flex-col justify-center items-center text-center border border-white/5 hover:border-coral-electrico/50 transition-colors">
                <div class="p-3 bg-coral-electrico/20 rounded-full text-coral-electrico mb-2">
                    <span class="material-symbols-outlined text-2xl">phishing</span>
                </div>
                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Especies BD</p>
                <p class="text-2xl font-black text-white">{{ $especiesEnBd }}</p> 
            </div>

            <div class="tarjeta-cristal p-4 flex flex-col justify-center items-center text-center border border-white/5 hover:border-green-400/50 transition-colors">
                <div class="p-3 bg-green-500/20 rounded-full text-green-400 mb-2">
                    <span class="material-symbols-outlined text-2xl">inventory_2</span>
                </div>
                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Stock Total</p>
                <p class="text-2xl font-black text-white">{{ number_format($stockTotal) }}</p>
            </div>

            <div class="tarjeta-cristal p-4 flex flex-col justify-center items-center text-center border border-white/5 hover:border-magma-diablillo/50 transition-colors">
                <div class="p-3 bg-magma-diablillo/20 rounded-full text-magma-diablillo mb-2">
                    <span class="material-symbols-outlined text-2xl">warning</span>
                </div>
                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Sin Stock</p>
                <p class="text-2xl font-black text-white">{{ $sinStock }}</p>
            </div>

            <div class="tarjeta-cristal p-4 flex flex-col justify-center items-center text-center border border-white/5 hover:border-amber-400/50 transition-colors">
                <div class="p-3 bg-amber-500/20 rounded-full text-amber-400 mb-2">
                    <span class="material-symbols-outlined text-2xl">pending_actions</span>
                </div>
                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Envíos Pendientes</p>
                <p class="text-2xl font-black text-white">{{ $pedidosPendientes }}</p>
            </div>

            <div class="tarjeta-cristal p-4 flex flex-col justify-center items-center text-center border border-white/5 hover:border-fuchsia-500/50 transition-colors">
                <div class="p-3 bg-fuchsia-500/20 rounded-full text-fuchsia-400 mb-2">
                    <span class="material-symbols-outlined text-2xl">payments</span>
                </div>
                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Ingresos Mes</p>
                <p class="text-2xl font-black text-white">${{ number_format($ingresosMes, 2) }}</p>
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

        {{-- Monitor de pedidos --}}
        <div>
            <div class="flex justify-between items-end mb-8">
                <div>
                    <h2 class="text-3xl font-black text-white italic tracking-tighter uppercase">Monitor de <span class="text-coral-electrico">Pedidos</span></h2>
                    <p class="text-gray-400 text-sm">Gestión global de ventas y logística de entrega.</p>
                </div>
                <div class="flex gap-2">
                    <span class="bg-black/40 text-xs text-gray-400 p-2 rounded border border-white/5 italic">Total Ventas: ${{ number_format($totalVentas, 2) }}</span>
                </div>
            </div>

            <div class="tarjeta-cristal overflow-hidden border border-white/5">
                <table class="w-full text-left text-sm">
                    <thead class="bg-black/60 text-white uppercase font-black tracking-widest border-b border-white/10">
                        <tr>
                            <th class="px-6 py-4">Orden</th>
                            <th class="px-6 py-4">Cliente</th>
                            <th class="px-6 py-4">Total</th>
                            <th class="px-6 py-4">Fecha</th>
                            <th class="px-6 py-4">Estatus</th>
                            <th class="px-6 py-4 text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5 text-gray-300">
                        @forelse($pedidos as $pedido)
                            <tr class="hover:bg-white/5 transition">
                                <td class="px-6 py-4 font-mono">#EXP-{{ str_pad($pedido->id, 4, '0', STR_PAD_LEFT) }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-col">
                                        {{-- Relación estándar de Laravel: $pedido->user --}}
                                        <span class="text-white font-bold">{{ $pedido->user->name ?? 'Usuario Desconocido' }}</span>
                                        <span class="text-[10px] text-gray-500">{{ $pedido->user->email ?? 'N/A' }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 font-bold text-coral-electrico">${{ number_format($pedido->total, 2) }}</td>
                                <td class="px-6 py-4 text-xs">{{ $pedido->created_at->format('d M, Y') }}</td>

                                {{-- Cambio de estatus dinámico con Alpine.js y Axios
                                    En teoría, este campo podría actualizarse automáticamente vía webhooks 
                                    (ej. Stripe/PayPal cambia de Pendiente a Pagado, FedEx/DHL a Enviado, o el cliente a Cancelado).
                                    Pero al ser una startup de crecimiento orgánico, el admin gestiona todo manualmente 
                                    (empaquetados, cambios de estado, etc.), sin APIs externas. 
                                    Así también evita fallos de integración y mantiene la última palabra ante fraudes o errores.
                                --}}
                                {{-- Logica en app.js --}}
                                <td class="px-6 py-4" x-data="manejadorEstatus('{{ $pedido->estado }}', '{{ route('admin.pedidos.estatus', $pedido->id) }}')">    
                                    <select 
                                        x-model="estatus" 
                                        @change="actualizar"
                                        :disabled="isUpdating"
                                        class="bg-black/40 border-none text-[10px] uppercase font-black rounded focus:ring-0 cursor-pointer transition-all duration-300 outline-none shadow-sm"
                                        :class="{
                                            'text-amber-400 shadow-amber-400/20': estatus === 'pendiente',
                                            'text-coral-electrico shadow-coral-electrico/20': estatus === 'enviado',
                                            'text-green-400 shadow-green-400/20': estatus === 'entregado',
                                            'text-gray-500 shadow-gray-500/20': estatus === 'cancelado',
                                            'opacity-50 cursor-wait': isUpdating
                                        }"
                                    >
                                        <option value="pendiente" class="text-amber-400 bg-gray-900">Pendiente</option>
                                        <option value="enviado" class="text-coral-electrico bg-gray-900">Enviado</option>
                                        <option value="entregado" class="text-green-400 bg-gray-900">Entregado</option>
                                        <option value="cancelado" class="text-gray-500 bg-gray-900">Cancelado</option>
                                    </select>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button class="text-gray-500 hover:text-white transition" title="Ver Detalles de la Orden">
                                        <span class="material-symbols-outlined">visibility</span>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-gray-500 italic">
                                    El radar está limpio. No hay expediciones registradas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection