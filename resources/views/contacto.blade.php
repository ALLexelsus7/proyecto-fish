@extends('layouts.app')
{{-- https://gradienty.codes/#google_vignette --}}
{{-- @section('body-style', 'background: linear-gradient(to bottom left, #84cc16, #16a34a, #0f766e);') --}}
@section('body-background', asset('img/bg/office2.jpeg'))
{{-- Seccion con el formulario de contacto --}}
@section('content')
{{-- CONTACTO --}}
<section class="relative min-h-screen py-60 flex items-center justify-center bg-fixed bg-cover bg-center">
  
    <div class="absolute inset-0 bg-black/30 backdrop-blur-sm  -z-10
                [mask-image:linear-gradient(to_bottom,black_70%,transparent_100%)] 
                -webkit-[mask-image:linear-gradient(to_bottom,black_70%,transparent_100%)]">
    </div>  

    <div class="relative z-10 max-w-5xl w-full mx-4 grid grid-cols-1 md:grid-cols-2 gap-10">
        
        <div class="text-white space-y-8">
            <div>
                <h1 class="text-5xl font-black tracking-tighter mb-4">CONTACTO <span class="text-magma-diablillo">ABISAL</span></h1>
                <p class="text-gray-300 text-lg">¿Buscas una especie en particular o necesitas un pedido mayorista? Envíanos una señal de sonar.</p>
            </div>

            <div class="space-y-6">
                <div class="flex items-center gap-4 group">
                    <div class="w-12 h-12 rounded-full bg-magma-diablillo flex items-center justify-center group-hover:scale-110 transition">
                        <span class="material-symbols-outlined">location_on</span>
                    </div>
                    <div>
                        <h4 class="font-bold text-magma-diablillo">Ubicación</h4>
                        <p class="text-sm">Zapopan, Jalisco. Sector Industrial.</p>
                    </div>
                </div>

                <div class="flex items-center gap-4 group">
                    <div class="w-12 h-12 rounded-full bg-coral-electrico flex items-center justify-center group-hover:scale-110 transition">
                        <span class="material-symbols-outlined">mail</span>
                    </div>
                    <div>
                        <h4 class="font-bold text-coral-electrico">Email</h4>
                        <p class="text-sm">expediciones@abyssalcatch.com</p>
                    </div>
                </div>
                <a href="#resenia" class="flex items-center gap-4 group">
                     
                    <div class="w-12 h-12 rounded-full bg-mangle-toxico flex items-center justify-center group-hover:scale-110 transition">
                        <span class="material-symbols-outlined">reviews</span>
                    </div>
                    <div>
                        <h4 class="font-bold text-mangle-toxico">Reseñas</h4>
                        <p class="text-sm">Justo abajo 😁</p>
                    </div>                    
                </a>
            </div>
        </div>

        {{-- Alerta de exito del form de contacto --}}
        @if(session('success_contact'))
            <div class="mb-8 p-4 z-20 absolute w-auto bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-xl text-center font-bold">
                <span class="material-symbols-outlined align-middle mr-2">cell_tower</span>
                {{ session('success_contact') }}
            </div>
        @endif
        <form action="{{ route('contacto.store') }}" method="POST" class="tarjeta-cristal p-8 space-y-5 border border-white/10 text-white rounded-xl">
            @csrf
            @method('POST')

            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label class="text-xs font-bold uppercase tracking-widest">Nombre</label>
                    <input type="text" name="nombre" 
                           value="{{ Auth::check() ? Auth::user()->name : old('nombre') }}"
                           class="w-full bg-white/5 border border-white/10 rounded-lg p-3 text-white focus:border-magma-diablillo focus:ring-1 focus:ring-magma-diablillo outline-none transition"
                           {{ Auth::check() ? 'readonly' : '' }}> {{-- readonly evita que cambien su nombre si ya están logueados --}}
                    @error('nombre') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                <div class="space-y-2">
                    <label class="text-xs font-bold uppercase tracking-widest">Correo Electrónico</label>
                    <input type="email" name="email" 
                           value="{{ Auth::check() ? Auth::user()->email : old('email') }}"
                           class="w-full bg-white/5 border border-white/10 rounded-lg p-3 text-white focus:border-magma-diablillo focus:ring-1 focus:ring-magma-diablillo outline-none transition"
                           {{ Auth::check() ? 'readonly' : '' }}>
                    @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="space-y-2">
                <label class="text-xs font-bold uppercase tracking-widest">Asunto</label>
                <input type="text" name="asunto" class="w-full bg-white/5 border border-white/10 rounded-lg p-3 text-white focus:border-magma-diablillo focus:ring-1 focus:ring-magma-diablillo outline-none transition">
                @error('asunto') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="space-y-2">
                <label class="text-xs font-bold uppercase tracking-widest">Mensaje</label>
                <textarea rows="4" name="mensaje" class="w-full bg-white/5 border border-white/10 rounded-lg p-3 focus:border-magma-diablillo focus:ring-1 focus:ring-magma-diablillo outline-none transition"></textarea>
                @error('mensaje') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="w-full bg-magma-diablillo hover:bg-ojo-aberracion hover:text-terror-submarino font-black py-4 rounded-xl shadow-lg shadow-magma-diablillo/20 transition-all transform hover:-translate-y-1">
                ENVIAR SEÑAL
            </button>
        </form>
    </div>
</section>

{{-- RESEÑAS --}}
<section class="relative pt-[13rem] pb-20" id="resenia">

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12 rounded-3xl tarjeta-cristal-2">
        
        <div class="text-center mb-12">
            <h2 class="text-3xl font-black text-white tracking-tight uppercase italic">
                Testimonios del <span class="text-magma-diablillo">Abismo</span>
            </h2>
            <p class="mt-2 text-sm text-gray-200">Lo que los valientes exploradores dicen de nuestras capturas.</p>
        </div>

        {{-- Alertas de Éxito de Laravel Session --}}
        @if(session('success_review'))
            <div class="mb-8 p-4 bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 rounded-xl text-sm text-center">
                {{ session('success_review') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            
            {{-- COLUMNA 1 Y 2: FEED DE RESEÑAS EXISTENTES (modificables si es la del usuario) --}}
            <div class="lg:col-span-2 space-y-6 max-h-[600px] overflow-y-auto pr-2 scrollbar-abisal">
                @forelse($reviews as $review)
                    <div class="bg-gray-900/50 border border-gray-800 p-6 rounded-2xl shadow-md transition-all hover:border-gray-700" 
                        x-data="{ editando: false, hoverRating: {{ $review->rating }}, currentRating: {{ $review->rating }} }">
                        
                        <div class="flex items-center justify-between mb-4">
                            {{-- Foto de perfil, nombre y fecha de publicación --}}
                            <div class="flex items-center space-x-3">
                                <img src="{{ $review->user->avatar_url }}" alt="Avatar" class="w-10 h-10 rounded-full border border-magma-diablillo/30 object-cover">
                                {{-- Uso avatar_url ya que en User.php hice un accesor que verifica si no hay foto, pone la primer letra del user --}}
                                <div>
                                    <h4 class="text-sm font-bold text-white">{{ $review->user->name }}</h4>
                                    <p class="text-xs text-gray-500">{{ $review->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            
                            {{-- Controles (Solo visibles para el dueño o admin) --}}
                            @if(Auth::check() && (Auth::id() === $review->user_id || Auth::user()->is_admin))
                                <div class="flex space-x-2">
                                    @if(Auth::id() === $review->user_id)
                                        <button @click="editando = !editando" class="text-gray-500 hover:text-amber-400 transition" title="Editar">
                                            <span class="material-symbols-outlined text-sm">edit</span>
                                        </button>
                                    @endif
                                    <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas purgar este testimonio?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-gray-500 hover:text-red-500 transition" title="Eliminar">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                        
                        {{-- Vista Normal --}}
                        <div x-show="!editando">
                            <div class="flex text-amber-400 mb-2">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg class="w-4 h-4 {{ $i <= $review->rating ? 'fill-current' : 'text-gray-700' }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755
                                         1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                @endfor
                            </div>
                            <p class="text-gray-300 text-sm italic leading-relaxed">"{{ $review->comentario }}"</p>
                        </div>

                        {{-- Formulario de Edición (Oculto por defecto) --}}
                        <template x-if="editando">
                            <form action="{{ route('reviews.update', $review->id) }}" method="POST" class="mt-4 border-t border-gray-700 pt-4">
                                @csrf @method('PATCH')
                                
                                <input type="hidden" name="rating" :value="currentRating">
                                <div class="flex mb-3 cursor-pointer">
                                    <template x-for="i in 5">
                                        <svg @click="currentRating = i" @mouseover="hoverRating = i" @mouseleave="hoverRating = currentRating"
                                            class="w-5 h-5 transition-colors duration-150" :class="i <= hoverRating ? 'text-amber-400 fill-current' : 'text-gray-700'"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1
                                             0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 
                                             0 00.951-.69l1.07-3.292z"/></svg>
                                    </template>
                                </div>
                                
                                <textarea name="comentario" rows="3" class="w-full bg-gray-950 border border-gray-700 rounded-lg p-2 text-sm text-gray-200 mb-2">{{ $review->comentario }}</textarea>
                                
                                <div class="flex justify-end space-x-2">
                                    <button type="button" @click="editando = false" class="text-xs text-gray-500 hover:text-gray-300">Cancelar</button>
                                    <button type="submit" class="text-xs bg-magma-diablillo text-white px-3 py-1 rounded hover:bg-orange-600">Guardar</button>
                                </div>
                            </form>
                        </template>
                    </div>
                @empty
                    <div class="text-center py-12 border border-dashed border-gray-800 rounded-2xl">
                        <p class="text-gray-200 text-sm">Nadie ha salido con vida para dejar una reseña aún...</p>
                    </div>
                @endforelse
            </div>

            {{-- COLUMNA 3: FORMULARIO PARA DEJAR RESEÑA --}}
            <div class="bg-gray-950/40 border border-gray-800 p-6 rounded-2xl h-fit">
                <h3 class="text-lg font-bold text-white mb-2">Escribe tu Bitácora</h3>
                <p class="text-xs text-gray-400 mb-6">Comparte tu experiencia con la tripulación.</p>
                {{-- Solo los logueados ven el formulario para escribir --}}
                @auth
                    <form action="{{ route('reviews.store') }}" method="POST" x-data="{ rating: 5, hoverRating: 0 }">
                        @csrf
                        
                        {{-- Selector de Estrellas Interactivo con Alpine.js --}}
                        <div class="mb-5">
                            <label class="block text-xs font-black text-gray-400 uppercase tracking-wider mb-2">Tu Puntuación</label>
                            <input type="hidden" name="rating" :value="rating">
                            <div class="flex space-x-1">
                                <template x-for="i in 5">
                                    <button type="button" 
                                        @click="rating = i" 
                                        @mouseover="hoverRating = i" 
                                        @mouseleave="hoverRating = 0"
                                        class="focus:outline-none transition-transform hover:scale-110">
                                        <svg class="w-7 h-7 transition-colors duration-150"
                                             :class="(hoverRating ? i <= hoverRating : i <= rating) ? 'text-amber-400 fill-current' : 'text-gray-700'"
                                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1
                                             1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                    </button>
                                </template>
                            </div>
                            @error('rating') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Comentario --}}
                        <div class="mb-5">
                            <label for="comentario" class="block text-xs font-black text-gray-400 uppercase tracking-wider mb-2">Mensaje</label>
                            <textarea id="comentario" name="comentario" rows="4" 
                                class="w-full bg-gray-900 border border-gray-800 rounded-xl px-4 py-3 text-sm text-gray-200 placeholder-gray-600 focus:outline-none focus:border-magma-diablillo transition-colors resize-none"
                                placeholder="¿Cómo estuvo el abordaje y el empaque al vacío...?"></textarea>
                            @error('comentario') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <button type="submit" 
                            class="w-full bg-magma-diablillo hover:bg-magma-diablillo/90 text-white font-black text-xs uppercase tracking-widest py-3 px-4 rounded-xl transition-colors shadow-lg shadow-magma-diablillo/10">
                            Transmitir Reseña
                        </button>
                    </form>
                @else
                    {{-- Bloqueo si no está logueado --}}
                    <div class="text-center py-6 bg-gray-900/30 border border-gray-800 rounded-xl">
                        <p class="text-xs text-gray-500 mb-3">Debes iniciar sesión para reportar tus comentarios.</p>
                        <a href="{{ route('login') }}" class="inline-block text-xs font-black uppercase text-magma-diablillo hover:underline">
                            Iniciar Sesión &rarr;
                        </a>
                    </div>
                @endauth
            </div>

        </div>
    </div>
</section>
@endsection