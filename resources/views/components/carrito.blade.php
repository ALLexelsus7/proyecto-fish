{{-- Componente nuevo para el dropdown del carrito de compra --}}

<div x-data="{ open: false }" {{-- el carrito inicia cerrado --}}
     @togglecart.window="open = true" {{-- evento para abrirlo --}}
     @keydown.escape.window="open = false"
     x-show="open" 
     class="relative z-50" 
     >
    
    <div x-show="open" {{-- al abrir sucede esto: --}}
         x-transition:enter="ease-in-out duration-500"  {{-- transisiones fluidas --}}
         x-transition:enter-start="opacity-0" 
         x-transition:enter-end="opacity-100" 
         x-transition:leave="ease-in-out duration-500" 
         x-transition:leave-start="opacity-100" 
         x-transition:leave-end="opacity-0" 
         @click="open = false"
         class="fixed inset-0 bg-black/60 backdrop-blur-sm transition-opacity"></div>

    {{-- Contenedor del carrito --}}
    <div class="fixed inset-0 overflow-hidden">
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
                    
                    {{-- Titulo y boton cierre --}}
                    <div class="flex h-full flex-col overflow-y-scroll tarjeta-cristal border-l border-white/10 shadow-2xl">
                        <div class="flex-1 overflow-y-auto px-4 py-6 sm:px-6">
                            <div class="flex items-start justify-between border-b border-white/10 pb-6">
                                <h2 class="text-2xl font-black text-white italic tracking-tighter">TU <span class="text-magma-diablillo">CARGAMENTO</span></h2>
                                <button @click="open = false" class="text-gray-400 hover:text-white transition">
                                    <span class="material-symbols-outlined">close</span>
                                </button>
                            </div>

                            {{-- Listado de productos seleccionados --}}
                            <div class="mt-8">
                                <div class="flow-root">                                   
                                    <ul role="list" class="-my-6 divide-y divide-white/5">
                                        <li class="flex py-6">
                                            <div class="h-24 w-24 flex-shrink-0 overflow-hidden rounded-md border border-white/10 bg-black/20 p-2">
                                                <img src="{{ asset('img/fish/fish1.png') }}" class="h-full w-full object-contain">
                                            </div>

                                            <div class="ml-4 flex flex-1 flex-col">
                                                <div>
                                                    <div class="flex justify-between text-base font-bold text-white">
                                                        <h3>Rape Abisal</h3>
                                                        <p class="ml-4 text-coral-electrico">$1,500.00</p>
                                                    </div>
                                                    <p class="mt-1 text-xs text-gray-500 uppercase tracking-widest italic">Ornamental</p>
                                                </div>
                                                <div class="flex flex-1 items-end justify-between text-sm">
                                                    <div class="flex items-center border border-white/20 rounded-lg overflow-hidden">
                                                        <button class="px-2 py-1 hover:bg-white/10 text-white">-</button>
                                                        <span class="px-3 py-1 text-white font-mono">1</span>
                                                        <button class="px-2 py-1 hover:bg-white/10 text-white">+</button>
                                                    </div>
                                                    <button type="button" class="font-black text-magma-diablillo hover:text-white transition uppercase text-xs">Eliminar</button>
                                                </div>
                                            </div>
                                        </li>
                                        </ul>
                                </div>
                            </div>
                        </div>

                        {{-- Realizar el pedido --}}
                        <div class="border-t border-white/10 px-4 py-6 sm:px-6 bg-black/40">
                            <div class="flex justify-between text-base font-medium text-gray-400 uppercase tracking-widest">
                                <p>Subtotal</p>
                                <p class="text-white font-mono text-xl">$1,500.00</p>
                            </div>
                            <p class="mt-0.5 text-xs text-gray-500 italic">Impuestos y envío calculados al finalizar.</p>
                            <div class="mt-6">
                                <a href="#" class="flex items-center justify-center rounded-xl bg-magma-diablillo px-6 py-4 text-base font-black text-white shadow-lg shadow-magma-diablillo/20 hover:scale-[1.02] transition-transform uppercase italic">
                                    Finalizar Adquisición
                                </a>
                            </div>
                            <div class="mt-6 flex justify-center text-center text-sm text-gray-400">
                                <p>o <button @click="open = false" class="font-bold text-coral-electrico hover:underline ml-1">Seguir explorando</button></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>