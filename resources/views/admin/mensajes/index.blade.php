@extends('layouts.app')

@section('content')
<div class="min-h-screen pt-40 pb-20 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        
        {{-- Titulo --}}
        <div class="flex items-center justify-between mb-8">
            <div class="flex items-center gap-4 mb-2">
                <a href="{{ route('admin.dashboard') }}" class="w-10 h-10 flex items-center justify-center rounded-full bg-white/5 hover:bg-magma-diablillo text-white transition">
                    <span class="material-symbols-outlined">arrow_back</span>
                </a> 
                <h1 class="text-3xl font-black text-white italic tracking-tighter uppercase">Centro de <span class="text-blue-500">Comunicaciones</span></h1>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 bg-blue-500/10 border border-blue-500/20 text-blue-400 rounded-xl text-sm font-bold">
                {{ session('success') }}
            </div>
        @endif

        <div class="space-y-4">
            @forelse($mensajes as $mensaje)
                <div class="tarjeta-cristal p-6 rounded-2xl border transition-all {{ $mensaje->leido ? 'border-white/5 opacity-70' : 'border-blue-500/40 shadow-[0_0_15px_rgba(59,130,246,0.1)]' }}">
                    <div class="flex flex-col sm:flex-row justify-between gap-4">
                        
                        {{-- Info del Remitente --}}
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-2">
                                @if(!$mensaje->leido)
                                    <span class="w-3 h-3 rounded-full bg-blue-500 animate-pulse" title="Mensaje Nuevo"></span>
                                @endif
                                <h3 class="text-lg font-bold text-white">{{ $mensaje->asunto }}</h3>
                            </div>
                            <p class="text-sm text-gray-400 mb-1">
                                <strong class="text-gray-300">{{ $mensaje->nombre }}</strong> ({{ $mensaje->email }})
                            </p>
                            <p class="text-xs text-gray-500 font-mono mb-4">{{ $mensaje->created_at->format('d/m/Y H:i') }}</p>
                            
                            <div class="p-4 bg-gray-900/50 rounded-xl border border-gray-800 text-gray-300 text-sm leading-relaxed">
                                "{{ $mensaje->mensaje }}"
                            </div>
                        </div>

                        {{-- Acciones Tácticas --}}
                        <div class="flex sm:flex-col gap-2 justify-start sm:justify-center border-t sm:border-t-0 sm:border-l border-gray-800 pt-4 sm:pt-0 sm:pl-6">
                            {{-- Botón Marcar Leído/No Leído --}}
                            <form action="{{ route('admin.mensajes.toggle', $mensaje->id) }}" method="POST">
                                @csrf @method('PATCH')
                                <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2 rounded-lg text-sm font-bold transition-colors {{ $mensaje->leido ? 'bg-gray-800 text-gray-400 hover:bg-gray-700' : 'bg-blue-600 text-white hover:bg-blue-500' }}">
                                    <span class="material-symbols-outlined text-sm">{{ $mensaje->leido ? 'mark_email_unread' : 'mark_email_read' }}</span>
                                    {{ $mensaje->leido ? 'Marcar No Leído' : 'Marcar Leído' }}
                                </button>
                            </form>

                            {{-- Botón Eliminar --}}
                            <form action="{{ route('admin.mensajes.destroy', $mensaje->id) }}" method="POST" onsubmit="return confirm('¿Confirmas la eliminación permanente de esta transmisión?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2 rounded-lg text-sm font-bold bg-red-500/10 text-red-500 border border-red-500/20 hover:bg-red-500 hover:text-white transition-colors">
                                    <span class="material-symbols-outlined text-sm">delete</span>
                                    Purgar
                                </button>
                            </form>
                        </div>

                    </div>
                </div>
            @empty
                <div class="tarjeta-cristal p-12 text-center border border-white/5 rounded-2xl">
                    <span class="material-symbols-outlined text-6xl text-gray-700 mb-4">inbox</span>
                    <h3 class="text-xl font-bold text-gray-500">Radar Silencioso</h3>
                    <p class="text-gray-600 mt-2">No hay transmisiones entrantes en el Cuartel General.</p>
                </div>
            @endforelse

            {{-- Paginación --}}
            @if($mensajes->hasPages())
                <div class="mt-8">
                    {{ $mensajes->links() }}
                </div>
            @endif
        </div>

    </div>
</div>
@endsection