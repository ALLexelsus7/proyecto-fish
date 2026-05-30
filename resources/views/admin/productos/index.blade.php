@extends('layouts.app')
@section('body-background', asset('img/bg/table3.jpeg'))

{{-- Gestions de productos del admin--}}
@section('content')
<div class="relative pt-60 min-h-screen flex items-center justify-center" x-data="{ filtrosOpen: false }">
    
    <div class="absolute inset-0 bg-black/30 backdrop-blur-sm 
            [mask-image:linear-gradient(to_bottom,black_70%,transparent_100%)] 
            -webkit-[mask-image:linear-gradient(to_bottom,black_70%,transparent_100%)] -z-10"></div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        {{-- Alerta de Operación Exitosa --}}
        @if(session('success'))
            <div x-data="{ show: true }" 
                 x-show="show" 
                 x-transition.duration.500ms
                 class="mb-6 bg-green-500/10 border border-green-500/30 text-green-400 px-6 py-4 rounded-xl flex justify-between items-center shadow-[0_0_15px_rgba(34,197,94,0.1)]">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined">task_alt</span>
                    <span class="font-bold tracking-wide">{{ session('success') }}</span>
                </div>
                <button @click="show = false" class="text-green-400/50 hover:text-green-400 transition">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
        @endif

        <div class="flex justify-between items-center mb-8 gap-10">
            <div>
                <div class="flex items-center gap-4 mb-2">
                    <a href="{{ route('admin.dashboard') }}" class="w-10 h-10 flex items-center justify-center rounded-full bg-white/5 hover:bg-magma-diablillo text-white transition">
                        <span class="material-symbols-outlined">arrow_back</span>
                    </a>
                    <h2 class="text-3xl font-black text-white italic tracking-tighter">
                        INVENTARIO DE <span class="text-magma-diablillo">ESPECIES</span>
                    </h2>
                </div>
                <p class="text-gray-300 text-sm pl-20">Gestiona las existencias de la zona abisal.</p>
            </div>
            <button @click="filtrosOpen = true" class="flex items-center gap-2 bg-gray-800 hover:bg-gray-700 text-white border border-gray-600 py-2 px-4 rounded-lg transition">
                <span class="material-symbols-outlined">tune</span>
                Filtros Avanzados
            </button>
            <a href="{{ route('admin.productos.create') }}" class="bg-magma-diablillo hover:bg-ojo-aberracion text-white px-6 py-3 rounded-xl font-bold flex items-center gap-2 transition-all transform hover:scale-105 shadow-lg shadow-magma-diablillo/20">
                <span class="material-symbols-outlined">add_circle</span>
                Nueva Captura
            </a>            
        </div>       

        <div class="tarjeta-cristal overflow-hidden border border-white/10">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-white/5 text-coral-electrico uppercase text-xs tracking-widest">
                        <th class="px-6 py-4">Imagen</th>
                        <th class="px-6 py-4">Especie</th>
                        <th class="px-6 py-4">Precio</th>
                        <th class="px-6 py-4">Stock</th>
                        <th class="px-6 py-4 text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5 text-gray-300">
                    @foreach ($productos as $producto)
                    <tr class="hover:bg-white/5 transition-colors">
                        <td class="px-6 py-4">
                            <img src="{{ asset('img/fish/' . $producto->imagen_url ?? 'img/peces/fish1.png') }}"
                                 class="w-16 h-16 object-contain rounded-lg bg-black/20 p-1">
                        </td>
                        <td class="px-6 py-4 font-bold text-white">
                            {{ $producto->nombre_comun }}
                            <span class="block text-xs font-normal text-gray-400 uppercase">{{ $producto->categoria }}</span>
                        </td>
                        <td class="px-6 py-4 font-mono text-coral-electrico">
                            ${{ number_format($producto->precio, 2) }}
                        </td>
                        
                        {{-- CELDA DE STOCK EVOLUCIONADA CON ALPINE JS --}}
                        <td class="px-6 py-4" x-data="{
                            cantidad: {{ $producto->stock }},
                            guardando: false,
                            sincronizar() {
                                this.guardando = true;
                                axios.patch('{{ route('admin.productos.updateStock', $producto->id) }}', { stock: this.cantidad })
                                    .then(res => { this.guardando = false; })
                                    .catch(err => {
                                        this.guardando = false;
                                        alert('Fallo al sincronizar stock con el servidor Abisal.');
                                    });
                            }
                        }">
                            <div class="flex items-center gap-3">
                                <input
                                    type="number"
                                    x-model="cantidad"
                                    @change="sincronizar"
                                    min="0"
                                    class="w-20 bg-black/40 border border-white/10 text-center font-mono font-bold rounded focus:ring-1 focus:ring-magma-diablillo text-white py-1 outline-none"
                                    :class="{ 'opacity-50 pointer-events-none' : guardando }"
                                >
                                
                                {{-- Badges dinámicos que respetan tu diseño --}}
                                <span x-show="cantidad > 0" class="px-3 py-1 rounded-full text-xs font-bold bg-green-500/20 text-green-400 transition-all">
                                    En Tanque
                                </span>
                                <span x-show="cantidad <= 0" class="px-3 py-1 rounded-full text-xs font-bold bg-red-500/20 text-red-400 animate-pulse transition-all">
                                    Agotado
                                </span>
                                
                                {{-- Icono de carga sutil --}}
                                <span x-show="guardando" class="material-symbols-outlined text-sm text-magma-diablillo animate-spin">sync</span>
                            </div>
                        </td>
                        {{-- FIN CELDA STOCK --}}

                        {{-- Acciones de edicion o eliminar --}}
                        <td class="px-6 py-4">
                            <div class="flex justify-center gap-3">
                                <a href="{{ route('admin.productos.edit', $producto->id) }}" class="text-gray-400 hover:text-white transition">
                                    <span class="material-symbols-outlined">edit_square</span>
                                </a>

                                <form action="{{ route('admin.productos.destroy', $producto->id) }}" method="POST" onsubmit="return confirm('¿Seguro que quieres eliminar esta especie del catálogo abisal?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-gray-400 hover:text-magma-diablillo transition">
                                        <span class="material-symbols-outlined">delete_forever</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Paginación del Catálogo admin --}}
        <div class="mt-6 px-4">
            {{ $productos->links() }}
        </div>

        

    </div>

    {{-- incluyo el componente de filtros aclarando que es el de admin --}}
    @include('components.filtros-sidebar', [
            'isAdmin' => true, 
            'rutaAction' => route('admin.productos.index')
        ])
</div>
@endsection