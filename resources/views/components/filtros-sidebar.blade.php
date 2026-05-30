{{-- SIDEBAR de filtros con alpine.js para el catalogo de productos y el inventario del admin --}}
<div x-show="filtrosOpen" class="absolute inset-0 z-40 flex items-start" style="display: none;">
    
    <div x-show="filtrosOpen" 
            x-transition.opacity 
            @click="filtrosOpen = false" 
            class="absolute inset-0 cursor-pointer bg-black/30 backdrop-blur-sm 
            [mask-image:linear-gradient(to_bottom,black_95%,transparent_100%)] 
            -webkit-[mask-image:linear-gradient(to_bottom,black_95%,transparent_100%)]">
            {{-- OJO, uso mask-image para aplicar el degradado de el overlay black y del blur --}}
    </div>

    @if(isset($isAdmin) && $isAdmin)
    {{-- Panel lateral mas ancho para el inventario de admin --}}
    <div x-show="filtrosOpen"
         x-transition:enter="transition ease-out duration-300 transform"
         x-transition:enter-start="-translate-x-full"
         x-transition:enter-end="translate-x-0"
         x-transition:leave="transition ease-in duration-300 transform"
         x-transition:leave-start="translate-x-0"
         x-transition:leave-end="-translate-x-full"
         class="sticky top-[170px] left-0 w-[26rem] max-w-[85vw] h-[calc(100vh-12rem)] rounded-r-3xl
                bg-gray-900 border-y border-r border-white/10 shadow-2xl flex flex-col z-50">
    @else
    {{-- Panel lateral normal --}}
    <div x-show="filtrosOpen"
         x-transition:enter="transition ease-out duration-300 transform"
         x-transition:enter-start="-translate-x-full"
         x-transition:enter-end="translate-x-0"
         x-transition:leave="transition ease-in duration-300 transform"
         x-transition:leave-start="translate-x-0"
         x-transition:leave-end="-translate-x-full"
         class="sticky top-[170px] left-0 w-[16rem] max-w-[85vw] h-[calc(100vh-12rem)] rounded-r-3xl
                bg-gray-900 border-y border-r border-white/10 shadow-2xl flex flex-col z-50">
    @endif
        
        {{-- Titulo y cierre --}}
        <div class="p-6 border-b border-white/10 flex justify-between items-center bg-black/40 rounded-tr-3xl">
            <h2 class="text-xl font-bold text-white tracking-widest flex items-center gap-2">
                <span class="material-symbols-outlined text-coral-electrico">radar</span>
                SENSORES
            </h2>
            <button @click="filtrosOpen = false" class="text-gray-400 hover:text-white transition">
                <span class="material-symbols-outlined text-3xl">close</span>
            </button>
        </div>
        
        {{-- Formulario de filtros segun si es usuario o admin --}}
        <div class="p-6 flex-1 overflow-y-auto scrollbar-hide scrollbar-abisal">
            <form action="{{ $rutaAction ?? route('productos.index') }}" method="GET" class="space-y-6">
                
                {{-- Filtro de busqueda textual (nombre comun, cientifico y descripcion) para admin y cliente --}}
                <div>
                    <label class="text-xs font-bold text-gray-400 uppercase tracking-widest block mb-2">Búsqueda Textual</label>
                    <div class="relative">
                        <span class="material-symbols-outlined absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500">search</span>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Ej. Linterna..." 
                                class="w-full bg-black/50 border-white/10 text-white pl-10 focus:ring-magma-diablillo focus:border-magma-diablillo rounded-md">
                    </div>
                </div>

                {{-- Toggle para mostrar favoritos solo para usuarios --}}
                @if(!isset($isAdmin) || !$isAdmin)
                @auth
                <div class="bg-black/30 p-4 rounded-lg border border-white/5">
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox" name="solo_favoritos" value="1" class="sr-only peer" {{ request('solo_favoritos') ? 'checked' : '' }}>
                        <div class="w-11 h-6 bg-gray-700 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-coral-electrico relative"></div>
                        <span class="ml-3 text-sm font-bold text-white flex items-center gap-1">
                            <span class="material-symbols-outlined text-coral-electrico text-sm">favorite</span>
                            Mis Favoritos
                        </span>
                    </label>
                </div>
                @endauth
                @endif

                {{-- Filtros comunes para Admin y Usuario --}}
                {{-- Filtro por categoria (zona de profundidad)--}}
                <div>
                    <label class="text-xs font-bold text-gray-400 uppercase tracking-widest block mb-2">Zona</label>
                    <select name="categoria" class="w-full bg-black/50 border-white/10 text-white focus:ring-magma-diablillo rounded-md [&>option]:bg-gray-900">
                        <option value="">Cualquier Zona</option>
                        <option value="shallow_coastal" {{ request('categoria') == 'shallow_coastal' ? 'selected' : '' }}>Shallow Coastal</option>
                        <option value="oceanic" {{ request('categoria') == 'oceanic' ? 'selected' : '' }}>Oceanic</option>
                        <option value="hadal_zone" {{ request('categoria') == 'hadal_zone' ? 'selected' : '' }}>Hadal zone</option>
                    </select>
                </div>

                {{-- Filtro por estado de vida --}}                        
                <div>
                    <label class="text-xs font-bold text-gray-400 uppercase tracking-widest block mb-2">Estado</label>
                    <select name="estado_vida" class="w-full bg-black/50 border-white/10 text-white focus:ring-magma-diablillo rounded-md [&>option]:bg-gray-900">
                        <option value="">Cualquier Estado</option>
                        <option value="ambos" {{ request('estado_vida') == 'ambos' ? 'selected' : '' }}>Ambos</option>
                        <option value="vivo" {{ request('estado_vida') == 'vivo' ? 'selected' : '' }}>Vivo</option>
                        <option value="consumo" {{ request('estado_vida') == 'consumo' ? 'selected' : '' }}>Consumo</option>
                    </select>
                </div>

                {{-- Filtro por rango de precio --}}                        
                <div>
                    <label class="text-xs font-bold text-gray-400 uppercase tracking-widest block mb-2">Precio ($)</label>
                    <div class="flex items-center gap-2">
                        <input type="number" name="precio_min" value="{{ request('precio_min') }}" placeholder="Min" min="0" class="w-1/2 bg-black/50 border-white/10 text-white focus:ring-magma-diablillo rounded-md text-sm">
                        <span class="text-gray-500">-</span>
                        <input type="number" name="precio_max" value="{{ request('precio_max') }}" placeholder="Max" min="0" class="w-1/2 bg-black/50 border-white/10 text-white focus:ring-magma-diablillo rounded-md text-sm">
                    </div>
                </div>

                {{-- Filtro de Stock --}}
                <div class="mb-4">
                    <label class="text-xs font-bold text-gray-400 uppercase tracking-widest block mb-2">Unidades (Stock)</label>
                    <div class="flex items-center gap-2">
                        <input type="number" name="stock_min" value="{{ request('stock_min') }}" placeholder="Min" min="0" class="w-1/2 bg-black/50 border-white/10 text-white focus:ring-magma-diablillo rounded-md text-sm">
                        <span class="text-gray-500">-</span>
                        <input type="number" name="stock_max" value="{{ request('stock_max') }}" placeholder="Max" min="0" class="w-1/2 bg-black/50 border-white/10 text-white focus:ring-magma-diablillo rounded-md text-sm">
                    </div>
                </div>                       
                
                {{-- Filtros solo para admin --}}
                @if(isset($isAdmin) && $isAdmin)
                    <div class="mt-6 pt-6 border-t border-white/10">                                                      
                        {{-- Filtro por orden de Antigüedad --}}
                        <div>
                            <label class="text-xs font-bold text-gray-400 uppercase tracking-widest block mb-2">Orden de Captura (Antigüedad)</label>
                            <select name="orden" class="w-full bg-black/50 border-white/10 text-white focus:ring-magma-diablillo rounded-md [&>option]:bg-gray-900">
                                <option value="recientes" {{ request('orden') == 'recientes' ? 'selected' : '' }}>Recientes Primero</option>
                                <option value="antiguos" {{ request('orden') == 'antiguos' ? 'selected' : '' }}>Antiguos Primero</option>
                            </select>
                        </div>
                    </div>
                @endif

                {{-- Acciones para admin y cliente --}}
                <div class="pt-6 border-t border-white/10 flex flex-col gap-3">
                    <button type="submit" class="w-full bg-coral-electrico hover:bg-white text-black font-black py-3 rounded-lg transition">
                        APLICAR FILTROS
                    </button>
                    
                    @if(request()->anyFilled(['search', 'solo_favoritos', 'categoria', 'estado_vida', 'precio_min', 'precio_max', 'stock_min', 'stock_max', 'orden']))
                        <a href="{{ $rutaAction ?? route('productos.index') }}" class="w-full bg-transparent border border-gray-600 text-gray-400 hover:text-white hover:border-white text-center font-bold py-2 rounded-lg transition text-sm">
                            Limpiar Filtros
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>