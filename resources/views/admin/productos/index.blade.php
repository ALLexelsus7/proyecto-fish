@extends('layouts.app')

@section('content')
    <div class="py-12 min-h-screen flex items-center justify-center">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h2 class="text-3xl font-black text-white italic tracking-tighter">
                        INVENTARIO DE <span class="text-magma-diablillo">ESPECIES</span>
                    </h2>
                    <p class="text-gray-400 text-sm">Gestiona las existencias de la zona abisal.</p>
                </div>
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
                                <img src="{{ asset('img/fish/' . $producto->imagen) }}" class="w-16 h-16 object-contain rounded-lg bg-black/20 p-1">
                            </td>
                            <td class="px-6 py-4 font-bold text-white">
                                {{ $producto->nombre }}
                                <span class="block text-xs font-normal text-gray-500 uppercase">{{ $producto->categoria }}</span>
                            </td>
                            <td class="px-6 py-4 font-mono text-coral-electrico">
                                ${{ number_format($producto->precio, 2) }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-xs font-bold {{ $producto->stock > 0 ? 'bg-green-500/20 text-green-400' : 'bg-red-500/20 text-red-400' }}">
                                    {{ $producto->stock }} unidades
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center gap-3">
                                    <a href="{{-- route('admin.productos.edit', $producto->id) --}}" class="text-gray-400 hover:text-white transition">
                                        <span class="material-symbols-outlined">edit_square</span>
                                    </a>

                                    <form action="{{-- route('admin.productos.destroy', $producto->id) --}}" method="POST" onsubmit="return confirm('¿Seguro que quieres eliminar esta especie?');">
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
        </div>
    </div>
@endsection