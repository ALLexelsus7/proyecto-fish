@extends('layouts.app')
@section('body-background', asset('img/bg/workstation.jpeg'))

@section('content')
<div class="pt-40 min-h-screen flex items-center justify-center">

    <div class="absolute inset-0 bg-gradient-to-b from-black/80 via-black/40 to-black/0 -z-10"></div>

    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        
        <div class="flex items-center justify-start gap-4 mb-8">
            <a href="{{ route('admin.productos.index') }}" class="w-10 h-10 flex items-center justify-center rounded-full bg-white/5 hover:bg-magma-diablillo text-white transition">
                <span class="material-symbols-outlined">arrow_back</span>
            </a>
            <div>
                <h2 class="text-3xl font-black text-white italic tracking-tighter">
                    EDITAR <span class="text-magma-diablillo">ESPECIMEN</span>
                </h2>
                <p class="text-gray-200 text-sm">Actualizando datos en la base de datos MySQL.</p>
            </div>
        </div>

        <div class="tarjeta-cristal p-8 border border-white/10 shadow-2xl shadow-magma-diablillo/10 rounded-2xl">
            <form action="{{ route('admin.productos.update', $producto->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                {{-- Grid principal de 6 campos (3 filas de 2 columnas en escritorio) --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="nombre_comun" class="text-white font-bold uppercase text-xs tracking-widest">Nombre Común</label>
                        <input type="text" id="nombre_comun" name="nombre_comun" value="{{ old('nombre_comun', $producto->nombre_comun) }}" class="block mt-1 w-full bg-ojo-aberracion/10 border-white/20 text-white focus:ring-magma-diablillo focus:border-magma-diablillo rounded-md" required>
                        @error('nombre_comun') <span class="text-red-400 text-xs italic mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="nombre_cientifico" class="text-white font-bold uppercase text-xs tracking-widest">Nombre Científico</label>
                        <input type="text" id="nombre_cientifico" name="nombre_cientifico" value="{{ old('nombre_cientifico', $producto->nombre_cientifico) }}" class="block mt-1 w-full bg-ojo-aberracion/10 border-white/20 text-white focus:ring-magma-diablillo focus:border-magma-diablillo rounded-md italic" required>
                        @error('nombre_cientifico') <span class="text-red-400 text-xs italic mt-1">{{ $message }}</span> @enderror
                    </div>

                    {{-- Ajustado a Zona de Profundidad (Mantiene name="categoria" para tu BD) --}}
                    <div>
                        <label for="categoria" class="text-white font-bold uppercase text-xs tracking-widest">Categoria</label>
                        <select id="categoria" name="categoria" class="block mt-1 w-full bg-ojo-aberracion/10 border-white/20 text-white focus:ring-magma-diablillo focus:border-magma-diablillo rounded-md [&>option]:bg-mar-profundo" required>
                            <option value="hadal_zone" {{ old('categoria', $producto->categoria) == 'hadal_zone' ? 'selected' : '' }}> 
                                Zona Hadal (Hadal Zone)
                            </option>
                            <option value="oceanic" {{ old('categoria', $producto->categoria) == 'oceanic' ? 'selected' : '' }}>
                                Oceánica (Oceanic)
                            </option>
                            <option value="shallow_coastal" {{ old('categoria', $producto->categoria) == 'shallow_coastal' ? 'selected' : '' }}>
                                Costa Poco Profunda (Shallow Coastal)
                            </option>
                        </select>
                        @error('categoria') <span class="text-red-400 text-xs italic mt-1">{{ $message }}</span> @enderror
                    </div>

                    {{-- NUEVO: Campo Estado de Vida integrado perfectamente --}}
                    <div>
                        <label for="estado_vida" class="text-white font-bold uppercase text-xs tracking-widest">Estado de Vida</label>
                        <select id="estado_vida" name="estado_vida" class="block mt-1 w-full bg-ojo-aberracion/10 border-white/20 text-white focus:ring-magma-diablillo focus:border-magma-diablillo rounded-md [&>option]:bg-mar-profundo" required>
                            <option value="ambos" {{ old('estado_vida', $producto->estado_vida) == 'ambos' ? 'selected' : '' }}>
                                Ambos (Vivo o Consumo)
                            </option>
                            <option value="vivo" {{ old('estado_vida', $producto->estado_vida) == 'vivo' ? 'selected' : '' }}>
                                Solo Vivo (Ornamental)
                            </option>
                            <option value="consumo" {{ old('estado_vida', $producto->estado_vida) == 'consumo' ? 'selected' : '' }}>
                                Solo Consumo (Gastronómico)
                            </option>
                        </select>
                        @error('estado_vida') <span class="text-red-400 text-xs italic mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="precio" class="text-white font-bold uppercase text-xs tracking-widest">Precio Unitario</label>
                        <input type="number" id="precio" name="precio" step="0.01" min="0" value="{{ old('precio', $producto->precio) }}" class="block mt-1 w-full bg-ojo-aberracion/10 border-white/20 text-coral-electrico font-mono focus:ring-magma-diablillo focus:border-magma-diablillo rounded-md" required>
                        @error('precio') <span class="text-red-400 text-xs italic mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="stock" class="text-white font-bold uppercase text-xs tracking-widest">Stock Disponible</label>
                        <input type="number" id="stock" name="stock" min="0" value="{{ old('stock', $producto->stock) }}" class="block mt-1 w-full bg-ojo-aberracion/10 border-white/20 text-white focus:ring-magma-diablillo focus:border-magma-diablillo rounded-md" required>
                        @error('stock') <span class="text-red-400 text-xs italic mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div>
                    <label for="descripcion" class="text-white font-bold uppercase text-xs tracking-widest">Descripción</label>
                    <textarea id="descripcion" name="descripcion" rows="4" class="block mt-1 w-full bg-ojo-aberracion/10 border-white/20 text-gray-300 focus:ring-magma-diablillo focus:border-magma-diablillo rounded-md" required>{{ old('descripcion', $producto->descripcion) }}</textarea>
                    @error('descripcion') <span class="text-red-400 text-xs italic mt-1">{{ $message }}</span> @enderror
                </div>

                {{-- Imagen actual y nueva (con alpine) --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center">                    
                    <div>
                        <label class="text-white font-bold uppercase text-xs tracking-widest block mb-2">Imagen Actual</label>
                        <img src="{{ asset('img/fish/' . $producto->imagen_url) }}" alt="{{ $producto->nombre_comun }}" class="h-32 w-full object-contain rounded-lg bg-black/40 border border-white/10 p-2">
                    </div>
                    <div x-data="{ fileName: null }">
                        <label class="text-white font-bold uppercase text-xs tracking-widest block mb-2">Actualizar Imagen (Opcional)</label>
                        <div class="flex items-center justify-center w-full">
                            <label for="imagen_url" class="flex flex-col items-center justify-center w-full h-32 border-2 border-white/20 border-dashed rounded-lg cursor-pointer bg-ojo-aberracion/5 hover:bg-ojo-aberracion/20 transition relative overflow-hidden">
                                
                                <div class="flex flex-col items-center justify-center pt-5 pb-6 text-center" :class="{ 'opacity-50': fileName }">
                                    <span class="material-symbols-outlined text-4xl mb-2" :class="fileName ? 'text-coral-electrico' : 'text-gray-400'">
                                        <span x-text="fileName ? 'check_circle' : 'cloud_upload'"></span>
                                    </span>
                                    <p class="mb-2 text-sm text-gray-300">
                                        <span x-show="!fileName"><span class="font-semibold text-magma-diablillo">Haz clic para subir</span> o arrastra</span>
                                        <span x-show="fileName" class="font-bold text-coral-electrico" x-text="fileName"></span>
                                    </p>
                                    <p x-show="!fileName" class="text-xs text-gray-200">PNG, JPG o WebP (MAX. 2MB)</p>
                                </div>
                                
                                {{-- Sin el atributo "required" --}}
                                <input 
                                    id="imagen_url" 
                                    name="imagen_url" 
                                    type="file" 
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" 
                                    accept="image/*" 
                                    @change="fileName = $event.target.files[0].name" 
                                />
                            </label>
                        </div>
                        @error('imagen_url') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex justify-end pt-4">
                    <button type="submit" class="bg-coral-electrico hover:bg-white text-mar-profundo font-black py-3 px-8 rounded-lg shadow-lg shadow-coral-electrico/20 transition-all transform hover:-translate-y-1 flex items-center gap-2">
                        <span class="material-symbols-outlined">update</span>
                        ACTUALIZAR DATOS
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection