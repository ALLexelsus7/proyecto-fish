{{-- Componente nuevo para el dropdown lateral del carrito de compra --}}
@auth
<div x-data="carrito({ 
        getRoute: '{{ route('carrito.get') }}', 
        removeUrl: '{{ url('/carrito/remove') }}', 
        updateUrl: '{{ url('/carrito/update') }}',
        checkoutUrl: '{{ route('checkout.process') }}'
     })" 
     {{-- logica en app.js --}}
     {{-- Carga los datos apenas se entra a la página --}}
     x-init="cargarCarrito()"
     {{-- Cuando adquieres un pez, se abre el carrito y vuelve a cargar los datos --}}
     @togglecart.window="cargarCarrito(); open = true" 
     @keydown.escape.window="open = false"
     class="relative z-50 scrollbar-abisal">
    
    <div x-show="open" 
         x-transition.opacity.duration.500ms
         @click="open = false"
         style="display: none;"
         class="fixed inset-0 bg-black/60 backdrop-blur-sm transition-opacity"></div>

    <div class="fixed inset-0 overflow-hidden" x-show="open" style="display: none;">
        <div class="absolute inset-0 overflow-hidden">
            <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10">
                
                <div x-show="open" 
                     x-transition:enter="transform transition ease-in-out duration-500" 
                     x-transition:enter-start="translate-x-full" 
                     x-transition:enter-end="translate-x-0" 
                     x-transition:leave="transform transition ease-in-out duration-500" 
                     x-transition:leave-start="translate-x-0" 
                     x-transition:leave-end="translate-x-full" 
                     class="pointer-events-auto w-screen max-w-md">
                    
                    <div class="flex h-full flex-col tarjeta-cristal bg-mar-profundo/25 border-l border-white/10 shadow-2xl rounded-l-3xl rounded-r-none">
                        {{-- Titulo y boton de cierre --}}
                        <div class="flex items-center justify-between border-b border-white/10 py-6 pl-6 pr-2">
                            <h2 class="text-2xl font-black text-white italic tracking-tighter leading-none">TU <span class="text-magma-diablillo">CARGAMENTO</span></h2>
                            <button @click="open = false" class="inline-flex h-10 w-10 items-center justify-center text-gray-400 hover:text-white transition">
                                <span class="material-symbols-outlined">close</span>
                            </button>
                        </div>
                        {{-- Lista de items + scrollbar personalizado --}}
                        <div class="flex-1 overflow-y-auto scrollbar-abisal px-4 py-6 sm:px-6">                          
                            <div class="mt-8">
                                <div class="flow-root">
                                    <ul role="list" class="-my-6 divide-y divide-white/5">
                                        
                                        <li x-show="items.length === 0" class="py-6 text-center text-gray-500 italic text-sm">
                                            Tu red está vacía. Sumérgete en el catálogo para atrapar algunas criaturas.
                                        </li>

                                        {{-- Este es como un for para mostrar cada item del carrito con Alpine.js --}}
                                        <template x-for="item in items" :key="item.carrito_id">
                                            <li class="flex py-6 transition-all hover:bg-white/5 p-2 rounded-lg -mx-2">
                                                {{-- Imagen --}}
                                                <div class="h-20 w-20 flex-shrink-0 overflow-hidden rounded-md border border-white/10 bg-black/40 p-2">
                                                    <img :src="item.imagen_url" class="h-full w-full object-contain">
                                                </div>

                                                <div class="ml-4 flex flex-1 flex-col justify-between">
                                                    {{-- Nombre, precio y categoria --}}
                                                    <div>
                                                        <div class="flex justify-between text-base font-bold text-white">
                                                            <h3 x-text="item.nombre_comun"></h3>
                                                            <p class="ml-4 text-coral-electrico" x-text="'$' + item.precio_formateado"></p>
                                                        </div>
                                                        <p class="mt-1 text-[10px] text-gray-500 uppercase tracking-widest italic" 
                                                           x-text="item.tipo_compra"
                                                           :class="item.tipo_compra === 'consumo' ? 'text-magma-diablillo' : 'text-blue-400'"></p>
                                                    </div>
                                                    
                                                    <div class="flex flex-1 items-end justify-between text-sm mt-2">
                                                        {{-- Botones de incremento / decremento de cantidad de producto --}}
                                                        <div class="flex items-center bg-black/50 border border-white/10 rounded-lg p-1 space-x-3 shadow-inner">
                                                            <button @click="cambiarCantidad(item.carrito_id, 'decrementar')" 
                                                                    type="button"
                                                                    class="text-gray-400 hover:text-magma-diablillo font-black text-sm px-2 py-0.5 transition rounded hover:bg-white/5">
                                                                -
                                                            </button>
                                                            
                                                            <span class="font-mono text-white text-xs font-bold w-4 text-center" x-text="item.cantidad"></span>
                                                            
                                                            <button @click="cambiarCantidad(item.carrito_id, 'incrementar')" 
                                                                    type="button"
                                                                    class="text-gray-400 hover:text-coral-electrico font-black text-sm px-2 py-0.5 transition rounded hover:bg-white/5">
                                                                +
                                                            </button>
                                                        </div>
                                                        
                                                        {{-- Boton de eliminar del carrito --}}
                                                        <button @click="eliminarItem(item.carrito_id)" type="button" class="font-black text-gray-500 hover:text-red-500 transition uppercase text-xs">
                                                            Liberar
                                                        </button>
                                                    </div>
                                                </div>
                                            </li>
                                        </template>

                                    </ul>
                                </div>
                            </div>
                        </div>

                        {{-- Caja de subtotal y realizar pedido --}}
                        <div class="border-t border-white/10 px-4 py-6 sm:px-6 bg-black/60 rounded-lg">
                            <div class="flex justify-between text-base font-medium text-gray-400 uppercase tracking-widest mb-4">
                                <p>Subtotal</p>
                                <p class="text-white font-mono text-2xl font-bold" x-text="'$' + total"></p>
                            </div>
                            
                            <div class="mt-6">
                                <button @click="realizarAdquisicion()" 
                                    class="w-full flex items-center justify-center rounded-xl bg-magma-diablillo px-6 py-4 text-base font-black text-white shadow-lg shadow-magma-diablillo/20 hover:scale-[1.02] transition-transform uppercase italic"
                                    :disabled="items.length === 0"
                                    :class="items.length === 0 ? 'opacity-50 cursor-not-allowed hover:scale-100' : ''">
                                    Realizar pedido
                                </button>
                            </div>
                            <div class="mt-6 flex justify-center text-center text-sm text-gray-400">
                                <p>o <button @click="open = false" class="font-bold text-coral-electrico hover:underline ml-1 uppercase text-xs">Seguir explorando</button></p>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endauth