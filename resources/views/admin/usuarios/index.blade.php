@extends('layouts.app')

@section('content')
<div class="min-h-screen pt-40 pb-20 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        
        {{-- Encabezado y Navegación --}}
        <div class="flex justify-between items-center mb-8 gap-10">
            <div class="flex items-center gap-4 mb-2">
                <a href="{{ route('admin.dashboard') }}" class="w-10 h-10 flex items-center justify-center rounded-full bg-white/5 hover:bg-magma-diablillo text-white transition">
                    <span class="material-symbols-outlined">arrow_back</span>
                </a>                    
                <h1 class="text-3xl font-black text-white italic tracking-tighter uppercase">Registro de <span class="text-emerald-500">Tripulación</span></h1>
            </div>
            
            <div class="tarjeta-cristal px-4 py-2 flex items-center gap-3 rounded-xl border border-emerald-500/30">
                <span class="material-symbols-outlined text-emerald-500">radar</span>
                <span class="text-white font-mono font-bold">{{ $usuarios->total() }}</span>
                <span class="text-xs text-gray-400 uppercase tracking-widest">Activos</span>
            </div>
        </div>

        {{-- Alertas --}}
        @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-xl text-sm font-bold">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mb-6 p-4 bg-magma-diablillo/10 border border-magma-diablillo/20 text-magma-diablillo rounded-xl text-sm font-bold">
                {{ session('error') }}
            </div>
        @endif

        {{-- Tabla de Usuarios --}}
        <div class="tarjeta-cristal overflow-hidden border border-white/5 rounded-2xl shadow-2xl">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm whitespace-nowrap">
                    <thead class="bg-black/60 text-white uppercase font-black tracking-widest text-[10px] border-b border-white/10">
                        <tr>
                            <th class="px-6 py-4">Explorador</th>
                            <th class="px-6 py-4">Contacto</th>
                            <th class="px-6 py-4 text-center">Rango</th>
                            <th class="px-6 py-4">Fecha de Alta</th>
                            <th class="px-6 py-4 text-right">Acción Táctica</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5 text-gray-300">
                        @forelse($usuarios as $user)
                            <tr class="hover:bg-white/5 transition-colors">
                                {{-- Nombre y foto --}}
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        <img src="{{ $user->avatar_url }}" alt="Avatar" class="w-10 h-10 rounded-full border border-gray-600 object-cover">
                                        <div>
                                            <p class="font-bold text-white text-base">{{ $user->name }}</p>
                                            <p class="text-xs text-gray-500 font-mono">ID: #{{ str_pad($user->id, 4, '0', STR_PAD_LEFT) }}</p>
                                        </div>
                                    </div>
                                </td>
                                {{-- Email --}}
                                <td class="px-6 py-4 text-gray-400">{{ $user->email }}</td>
                                {{-- Rango --}}
                                <td class="px-6 py-4 text-center">
                                    <form action="{{ route('admin.usuarios.updateRole', $user->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <select name="rol" onchange="this.form.submit()" 
                                                class="w-[6rem] text-xs font-black uppercase tracking-wider rounded-lg border px-2 py-1 focus:ring-0 focus:outline-none cursor-pointer transition-colors
                                                {{ $user->rol === 'admin' ? 'bg-fuchsia-500/10 text-fuchsia-400 border-fuchsia-500/30 hover:bg-fuchsia-500/20' : 'bg-blue-500/10 text-blue-400 border-blue-500/30 hover:bg-blue-500/20' }}">
                                            <option value="cliente" class="bg-gray-900 text-white" {{ $user->rol === 'cliente' ? 'selected' : '' }}>Cliente</option>
                                            <option value="admin" class="bg-gray-900 text-white" {{ $user->rol === 'admin' ? 'selected' : '' }}>Admin</option>
                                        </select>
                                    </form>
                                </td>
                                {{-- Fecha de Alta --}}
                                <td class="px-6 py-4 text-xs text-gray-400">
                                    {{ $user->created_at->format('d / M / Y') }}
                                </td>
                                {{-- Acciones --}}
                                <td class="px-6 py-4 text-right">
                                    <form action="{{ route('admin.usuarios.destroy', $user->id) }}" method="POST" onsubmit="return confirm('¿Autorizas revocar los accesos de {{ $user->name }}? Esta acción le impedirá volver a la plataforma.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-gray-500 hover:text-magma-diablillo transition-colors p-2 rounded-lg hover:bg-magma-diablillo/10" title="Revocar Acceso (Ban)">
                                            <span class="material-symbols-outlined">person_off</span>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-gray-500 italic">
                                    No hay más tripulantes registrados en los radares.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            {{-- Paginación nativa de Laravel --}}
            @if($usuarios->hasPages())
                <div class="border-t border-white/10 p-4 bg-black/40">
                    {{ $usuarios->links() }}
                </div>
            @endif
        </div>

    </div>
</div>
@endsection