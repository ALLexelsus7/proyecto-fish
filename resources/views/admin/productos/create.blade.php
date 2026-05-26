@extends('layouts.app')
@section('body-background', asset('img/bg/workstation2.jpeg'))
{{-- Seccion para agregar productos --}}
@section('content')
<div class="py-48 min-h-screen flex items-center justify-center">

    <div class="absolute inset-0 bg-gradient-to-b from-black/80 via-black/40 to-black/0 -z-10"></div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <div class="flex items-center justify-center gap-4 mb-8">
            <a href="{{ route('admin.productos.index') }}" class="w-10 h-10 flex items-center justify-center rounded-full bg-white/5 hover:bg-magma-diablillo text-white transition">
                <span class="material-symbols-outlined">arrow_back</span>
            </a>
            <div>
                <h2 class="text-3xl font-black text-white italic tracking-tighter">
                    REGISTRAR NUEVA <span class="text-magma-diablillo">CAPTURA</span>
                </h2>
                <p class="text-gray-200 text-sm">Añade una nueva especie a la base de datos abisal.</p>
            </div>
        </div>

        {{-- Formulario de Registro de Productos --}}
        <div class="tarjeta-cristal p-8 border border-white/10 shadow-2xl shadow-magma-diablillo/10">
            <form action="{{ route('admin.productos.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                {{-- enctype="multipart/form-data" permite el envio de archivos --}}
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Nombre Comun --}}
                    <div>
                        <label for="nombre_comun" class="text-white font-bold uppercase text-xs tracking-widest">Nombre Común</label>
                        <input type="text" id="nombre_comun" name="nombre_comun" placeholder="Ej. Rape Abisal" class="block mt-1 w-full bg-ojo-aberracion/10 border-white/20 text-white focus:ring-magma-diablillo focus:border-magma-diablillo rounded-md" required value="{{old('nombre_comun')}}">
                        {{-- Este es un mensaje de error por si no se cumple la validacion --}}
                        @error('nombre_comun') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    {{-- Nombre Cientifico --}}
                    <div>
                        <label for="nombre_cientifico" class="text-white font-bold uppercase text-xs tracking-widest">Nombre Científico</label>
                        <input type="text" id="nombre_cientifico" name="nombre_cientifico" placeholder="Ej. Melanocetus johnsonii" class="block mt-1 w-full bg-ojo-aberracion/10 border-white/20 text-white focus:ring-magma-diablillo focus:border-magma-diablillo rounded-md italic" required value="{{old('nombre_cientifico')}}">
                        @error('nombre_cientifico') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    {{-- Categoria --}}
                    <div>
                        <label for="categoria" class="text-white font-bold uppercase text-xs tracking-widest">Zona Hábitat (Categoría)</label>
                        <select id="categoria" name="categoria" class="block mt-1 w-full bg-ojo-aberracion/10 border-white/20 text-white focus:ring-magma-diablillo focus:border-magma-diablillo rounded-md [&>option]:bg-mar-profundo" required>
                            <option value="hadal_zone" {{ old('categoria') == 'hadal_zone' ? 'selected' : '' }}>
                                Zona Hadal (Hadal Zone)
                            </option>
                            <option value="oceanic" {{ old('categoria') == 'oceanic' ? 'selected' : '' }}>
                                Oceánica (Oceanic)
                            </option>
                            <option value="shallow_coastal" {{ old('categoria') == 'shallow_coastal' ? 'selected' : '' }}>
                                Costa Poco Profunda (Shallow Coastal)
                            </option>
                        </select>
                        @error('categoria') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    {{-- Estado de Vida (ENUM de la BD) --}}
                    <div>
                        <label for="estado_vida" class="text-white font-bold uppercase text-xs tracking-widest">Estado de Vida</label>
                        <select id="estado_vida" name="estado_vida" class="block mt-1 w-full bg-ojo-aberracion/10 border-white/20 text-white focus:ring-magma-diablillo focus:border-magma-diablillo rounded-md [&>option]:bg-mar-profundo" required>
                            <option value="ambos" {{ old('estado_vida') == 'ambos' ? 'selected' : '' }}>
                                Ambos (Vivo o Consumo)
                            </option>
                            <option value="vivo" {{ old('estado_vida') == 'vivo' ? 'selected' : '' }}>
                                Solo Vivo (Ornamental)
                            </option>
                            <option value="consumo" {{ old('estado_vida') == 'consumo' ? 'selected' : '' }}>
                                Solo Consumo (Gastronómico)
                            </option>
                        </select>
                        @error('estado_vida') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    {{-- Precio --}}
                    <div>
                        <label for="precio" class="text-white font-bold uppercase text-xs tracking-widest">Precio Unitario</label>
                        <input type="number" id="precio" name="precio" step="0.01" min="0" class="block mt-1 w-full bg-ojo-aberracion/10 border-white/20 text-white font-mono focus:ring-magma-diablillo focus:border-magma-diablillo rounded-md" required value="{{old('precio')}}">
                        @error('precio') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    {{-- Stock --}}
                    <div>
                        <label for="stock" class="text-white font-bold uppercase text-xs tracking-widest">Stock Disponible</label>
                        <input type="number" id="stock" name="stock" min="0" class="block mt-1 w-full bg-ojo-aberracion/10 border-white/20 text-white focus:ring-magma-diablillo focus:border-magma-diablillo rounded-md" required value="{{old('stock')}}">
                        @error('stock') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>

                {{-- Descripción --}}
                <div>
                    <label for="descripcion" class="text-white font-bold uppercase text-xs tracking-widest">Breve descripción</label>
                    <textarea id="descripcion" name="descripcion" rows="4" class="block mt-1 w-full bg-ojo-aberracion/10 border-white/20 text-gray-300 focus:ring-magma-diablillo focus:border-magma-diablillo rounded-md" required>{{ old('descripcion') }}</textarea>
                    @error('descripcion') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                {{-- Imagen (Con Alpine.js) --}}
                <div x-data="{ fileName: null }">
                    <label class="text-white font-bold uppercase text-xs tracking-widest block mb-2">Imagen del Espécimen </label>
                    <div class="flex items-center justify-center w-full">
                        <label for="imagen_url" class="flex flex-col items-center justify-center w-full h-40 border-2 border-white/20 border-dashed rounded-lg cursor-pointer bg-ojo-aberracion/5 hover:bg-ojo-aberracion/20 transition relative overflow-hidden">
                            
                            <div class="flex flex-col items-center justify-center pt-5 pb-6 text-center" :class="{ 'opacity-50': fileName }">
                                <span class="material-symbols-outlined text-4xl mb-2" :class="fileName ? 'text-coral-electrico' : 'text-gray-400'">
                                    <span x-text="fileName ? 'check_circle' : 'cloud_upload'"></span>
                                </span>
                                <p class="mb-2 text-sm text-gray-300">
                                    <span x-show="!fileName"><span class="font-semibold text-magma-diablillo">Haz clic para subir</span> o arrastra el archivo</span>
                                    <span x-show="fileName" class="font-bold text-coral-electrico" x-text="fileName"></span>
                                </p>
                                <p x-show="!fileName" class="text-xs text-gray-200">PNG, JPG o WebP (MAX. 2MB)</p>
                            </div>
                            
                            <input 
                                id="imagen_url" 
                                name="imagen_url" 
                                type="file" 
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" 
                                accept="image/*" 
                                required
                                @change="fileName = $event.target.files[0].name" 
                            />
                        </label>
                    </div>
                    @error('imagen_url') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="flex justify-end pt-4">
                    <button type="submit" class="bg-magma-diablillo hover:bg-ojo-aberracion text-white font-black py-3 px-8 rounded-lg shadow-lg shadow-magma-diablillo/40 transition-all transform hover:-translate-y-1 flex items-center gap-2">
                        <span class="material-symbols-outlined">save</span>
                        GUARDAR ESPECIE
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection