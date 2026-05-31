@extends('layouts.app')

@section('content')
<div class="min-h-screen pt-40 flex items-center justify-center" x-data="visorPedidos">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
        
        {{-- Titulo, config. perfil y musica de fondo On-Demand que solo se escucha en esta vista --}}
        <div class="tarjeta-cristal p-8 border-l-8 border-magma-diablillo flex justify-between items-center rounded-l-2xl rounded-r-lg">
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
            
            <div class="tarjeta-cristal p-4 flex flex-col justify-center items-center text-center border border-white/5 hover:border-coral-electrico/50 transition-colors rounded-2xl">
                <div class="p-3 bg-coral-electrico/20 rounded-full text-coral-electrico mb-2">
                    <span class="material-symbols-outlined text-2xl">phishing</span>
                </div>
                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Especies BD</p>
                <p class="text-2xl font-black text-white">{{ $especiesEnBd }}</p> 
            </div>

            <div class="tarjeta-cristal p-4 flex flex-col justify-center items-center text-center border border-white/5 hover:border-green-400/50 transition-colors rounded-2xl">
                <div class="p-3 bg-green-500/20 rounded-full text-green-400 mb-2">
                    <span class="material-symbols-outlined text-2xl">inventory_2</span>
                </div>
                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Stock Total</p>
                <p class="text-2xl font-black text-white">{{ number_format($stockTotal) }}</p>
            </div>

            <div class="tarjeta-cristal p-4 flex flex-col justify-center items-center text-center border border-white/5 hover:border-magma-diablillo/50 transition-colors rounded-2xl">
                <div class="p-3 bg-magma-diablillo/20 rounded-full text-magma-diablillo mb-2">
                    <span class="material-symbols-outlined text-2xl">warning</span>
                </div>
                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Sin Stock</p>
                <p class="text-2xl font-black text-white">{{ $sinStock }}</p>
            </div>

            <div class="tarjeta-cristal p-4 flex flex-col justify-center items-center text-center border border-white/5 hover:border-amber-400/50 transition-colors rounded-2xl">
                <div class="p-3 bg-amber-500/20 rounded-full text-amber-400 mb-2">
                    <span class="material-symbols-outlined text-2xl">pending_actions</span>
                </div>
                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Envíos Pendientes</p>
                <p class="text-2xl font-black text-white">{{ $pedidosPendientes }}</p>
            </div>

            <div class="tarjeta-cristal p-4 flex flex-col justify-center items-center text-center border border-white/5 hover:border-fuchsia-500/50 transition-colors rounded-2xl">
                <div class="p-3 bg-fuchsia-500/20 rounded-full text-fuchsia-400 mb-2">
                    <span class="material-symbols-outlined text-2xl">payments</span>
                </div>
                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Ingresos Mes</p>
                <p class="text-2xl font-black text-white">${{ number_format($ingresosMes, 2) }}</p>
            </div>

        </div>

        {{-- Gestión de Inventario --}}
        <div class="w-full flex justify-center items-center">
            <a href="{{ route('admin.productos.index') }}" class="group tarjeta-cristal p-8 border border-white/10 hover:border-magma-diablillo transition-all cursor-pointer rounded-3xl">
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

            <div class="tarjeta-cristal overflow-hidden border border-white/5 rounded-lg">
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
                                    <button 
                                        @click="cargarDetalles('{{ route('admin.pedidos.detalles', $pedido->id) }}')"
                                        class="text-gray-500 hover:text-coral-electrico transition" 
                                        title="Ver Detalles de la Orden">
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

    {{-- Modal de detalles de pedido --}}
    <div 
        x-show="abierto" 
        style="display: none;"
        class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto overflow-x-hidden bg-black/80 backdrop-blur-sm"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
    >
        <div 
            @click.away="abierto = false"
            class="relative w-full max-w-3xl p-6 my-8 tarjeta-cristal border border-coral-electrico/30 shadow-2xl shadow-coral-electrico/10 rounded-2xl"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
        >
            {{-- Botón Cerrar --}}
            <button @click="abierto = false" class="absolute top-4 right-4 text-gray-400 hover:text-white">
                <span class="material-symbols-outlined">close</span>
            </button>

            {{-- Estado de Carga: Pez Espada Animado con SVG y CSS puro --}}
            <div x-show="cargando" class="py-16 flex flex-col items-center justify-center">
                <svg class="w-32 h-32 text-coral-electrico mb-4" viewBox="0 0 100 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g fill="currentColor">
                        <path d="M5,25 C25,25 35,15 55,15 C75,15 90,25 95,25 C90,35 75,35 55,35 C35,35 25,25 5,25 Z" />
                        <polygon points="45,15 55,2 60,15" />
                        <polygon points="45,28 35,40 50,30" />
                        <circle cx="35" cy="22" r="2" fill="#000" />
                        
                        <animateTransform 
                            attributeName="transform" 
                            type="translate" 
                            values="0,0; 8,-4; 0,0" 
                            dur="1.2s" 
                            repeatCount="indefinite"
                        />
                    </g>
                </svg>
                <p class="text-gray-400 animate-pulse tracking-widest uppercase text-sm font-bold">Rastreando especies...</p>
            </div>

            {{-- Contenido de la Orden --}}
            <div x-show="!cargando && pedido">
                <h3 class="text-2xl font-black text-white italic tracking-tighter uppercase mb-6 border-b border-white/10 pb-4">
                    Orden <span class="text-coral-electrico" x-text="'#EXP-' + String(pedido?.id).padStart(4, '0')"></span>
                </h3>

                {{-- Datos del Cliente --}}
                <div class="grid grid-cols-2 gap-4 mb-6 text-sm">
                    <div class="bg-black/40 p-4 rounded border border-white/5">
                        <p class="text-gray-500 uppercase font-bold text-[10px] mb-1">Cliente</p>
                        <p class="text-white font-bold" x-text="pedido?.user?.name"></p>
                        <p class="text-gray-400" x-text="pedido?.user?.email"></p>
                    </div>
                    <div class="bg-black/40 p-4 rounded border border-white/5">
                        <p class="text-gray-500 uppercase font-bold text-[10px] mb-1">Fecha de Operación</p>
                        <p class="text-white font-bold" x-text="new Date(pedido?.created_at).toLocaleDateString('es-MX', { year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' })"></p>
                    </div>
                </div>

                {{-- Lista de Productos --}}
                <div class="overflow-x-auto border border-white/10 rounded">
                    <table class="w-full text-left text-sm text-gray-300">
                        <thead class="bg-black/60 text-white uppercase text-[10px] tracking-widest border-b border-white/10">
                            <tr>
                                <th class="px-4 py-3">Especie</th>
                                <th class="px-4 py-3">Categoría</th>
                                <th class="px-4 py-3">Tipo de compra</th>
                                <th class="px-4 py-3 text-center">Cant.</th>
                                <th class="px-4 py-3 text-right">Precio Unit.</th>
                                <th class="px-4 py-3 text-right">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            {{-- Itera sobre los detalles del pedido --}}
                            <template x-for="detalle in pedido?.detalles" :key="detalle.id">
                                <tr class="hover:bg-white/5 transition">
                                    {{-- El nombre del pez y la categoria vive dentro del objeto producto anidado --}}
                                    <td class="px-4 py-3 font-bold text-white" x-text="detalle.producto?.nombre_comun || 'Especie no encontrada'"></td>                
                                    <td class="px-4 py-3 font-bold text-white" x-text="detalle.producto?.categoria || 'Categoria no encontrada'"></td>                                    
                                    
                                    {{-- El tipo de compra, la cantidad y el precio unitario viven directamente en el detalle --}}
                                    <td class="px-4 py-3 font-bold text-white" x-text="detalle.tipo_compra || 'Tipo no reconocido'"></td>
                                    <td class="px-4 py-3 text-center" x-text="detalle.cantidad"></td>
                                    <td class="px-4 py-3 text-right" x-text="formatearMoneda(detalle.precio_unitario)"></td>
                                    
                                    {{-- Calculamos el subtotal multiplicando los campos del detalle --}}
                                    <td class="px-4 py-3 text-right text-coral-electrico font-bold" x-text="formatearMoneda(detalle.cantidad * detalle.precio_unitario)"></td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>

                {{-- Acciones y Totales --}}
                <div class="mt-8 flex flex-col sm:flex-row justify-between items-end sm:items-center border-t border-white/10 pt-6">
                    
                    {{-- Botón de PDF --}}
                    <div class="mb-4 sm:mb-0">
                        <a :href="'/pedidos/' + pedido?.id + '/recibo-pdf'" 
                            target="_blank"
                            class="inline-flex items-center gap-2 bg-transparent border border-coral-electrico text-coral-electrico
                             hover:bg-coral-electrico hover:text-black px-6 py-3 rounded font-black uppercase text-xs tracking-widest 
                             transition-all duration-300 shadow-[0_0_15px_rgba(255,127,80,0.1)] hover:shadow-fosforescencia-abisal">
                            <span class="material-symbols-outlined text-sm">download</span>
                            Descargar Recibo PDF
                        </a>
                    </div>

                    {{-- Total del Pedido --}}
                    <div class="bg-coral-electrico/10 border border-coral-electrico/20 p-4 rounded min-w-[200px] text-right">
                        <p class="text-gray-400 text-xs uppercase tracking-widest font-bold mb-1">Gran Total</p>
                        <p class="text-3xl font-black text-white" x-text="formatearMoneda(pedido?.total)"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- FIN DEL MODAL --}} 

</div>
@endsection