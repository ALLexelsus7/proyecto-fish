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

        <div class="tarjeta-cristal p-8 border border-white/10 shadow-2xl shadow-magma-diablillo/10">
            <form action="#" method="POST" enctype="multipart/form-data" class="space-y-6">
                {{-- enctype="multipart/form-data" permite recibir archivos --}}
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="nombre_comun" class="text-white font-bold uppercase text-xs tracking-widest">Nombre Común</label>
                        <input type="text" id="nombre_comun" name="nombre_comun" placeholder="Ej. Rape Abisal" class="block mt-1 w-full bg-ojo-aberracion/10 border-white/20 text-white focus:ring-magma-diablillo focus:border-magma-diablillo rounded-md" required>
                    </div>

                    <div>
                        <label for="nombre_cientifico" class="text-white font-bold uppercase text-xs tracking-widest">Nombre Científico</label>
                        <input type="text" id="nombre_cientifico" name="nombre_cientifico" placeholder="Ej. Melanocetus johnsonii" class="block mt-1 w-full bg-ojo-aberracion/10 border-white/20 text-white focus:ring-magma-diablillo focus:border-magma-diablillo rounded-md italic" required>
                    </div>

                    <div>
                        <label for="categoria" class="text-white font-bold uppercase text-xs tracking-widest">Categoría (Consumo/Ornamental)</label>
                        <select id="categoria" name="categoria" class="block mt-1 w-full bg-ojo-aberracion/10 border-white/20 text-white focus:ring-magma-diablillo focus:border-magma-diablillo rounded-md [&>option]:bg-mar-profundo">
                            <option value="Consumo">Para Consumo (Crudo/Gastronómico)</option>
                            <option value="Ornamental">Ornamental (Estética/Cuidado)</option>
                        </select>
                    </div>

                    <div>
                        <label for="precio" class="text-white font-bold uppercase text-xs tracking-widest">Precio Unitario</label>
                        <input type="number" id="precio" name="precio" step="0.01" min="0" class="block mt-1 w-full bg-ojo-aberracion/10 border-white/20 text-coral-electrico font-mono focus:ring-magma-diablillo focus:border-magma-diablillo rounded-md" required>
                    </div>

                    <div>
                        <label for="stock" class="text-white font-bold uppercase text-xs tracking-widest">Stock Disponible</label>
                        <input type="number" id="stock" name="stock" min="0" class="block mt-1 w-full bg-ojo-aberracion/10 border-white/20 text-white focus:ring-magma-diablillo focus:border-magma-diablillo rounded-md" required>
                    </div>
                </div>

                <div>
                    <label for="descripcion" class="text-white font-bold uppercase text-xs tracking-widest">Descripción</label>
                    <textarea id="descripcion" name="descripcion" rows="4" class="block mt-1 w-full bg-ojo-aberracion/10 border-white/20 text-gray-300 focus:ring-magma-diablillo focus:border-magma-diablillo rounded-md" required></textarea>
                </div>

                <div>
                    <label class="text-white font-bold uppercase text-xs tracking-widest block mb-2">Imagen del Espécimen </label>
                    <div class="flex items-center justify-center w-full">
                        <label for="imagen_url" class="flex flex-col items-center justify-center w-full h-40 border-2 border-white/20 border-dashed rounded-lg cursor-pointer bg-ojo-aberracion/5 hover:bg-ojo-aberracion/20 transition">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <span class="material-symbols-outlined text-4xl text-gray-400 mb-2">cloud_upload</span>
                                <p class="mb-2 text-sm text-gray-400"><span class="font-semibold text-magma-diablillo">Haz clic para subir</span> o arrastra el archivo</p>
                                <p class="text-xs text-gray-500">PNG, JPG o WebP (MAX. 2MB)</p>
                            </div>
                            <input id="imagen_url" name="imagen_url" type="file" class="hidden" accept="image/*" required />
                        </label>
                    </div>
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