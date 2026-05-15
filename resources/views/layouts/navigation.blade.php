{{-- Este es el navbar --}}
<nav class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
    <a href="{{ route('home') }}" class="flex items-center gap-3 text-2xl font-bold tracking-tighter">
        <img src="{{ asset('img/logos/logo.png') }}" alt="logo" class="w-20 ">
        <span>ABYSSAL <span class="text-magma-diablillo">CATCH</span></span>
    </a>

    <ul class="hidden md:flex space-x-8 font-medium">   
        {{-- x-nav-link es una etiqueta de Alpine.js por Breeze --}}
        <x-nav-link :href="route('home')" :active="request()->routeIs('home')" class="text-white hover:text-coral-electrico transition">
            Inicio
        </x-nav-link>
        <x-nav-link :href="route('productos')" :active="request()->routeIs('productos')" class="text-white hover:text-coral-electrico transition">
            Catálogo
        </x-nav-link>
        <x-nav-link :href="route('contacto')" :active="request()->routeIs('contacto')" class="text-white hover:text-coral-electrico transition">
            Contacto
        </x-nav-link>
    </ul>

    <div class="flex items-center gap-5">
        {{-- Interactividad al boton con un evento de Alpine.js (solo actua si esta el atributo x-data) --}}
        <button x-data @click="$dispatch('togglecart')" class="relative hover:text-ojo-aberracion transition p-2">
            <span class="material-symbols-outlined text-3xl">shopping_cart</span>
            <span class="absolute top-0 right-0 bg-magma-diablillo/80 text-white text-[10px] font-black px-1.5 py-0.5 rounded-full border-2 border-mar-profundo">
                3 {{-- Aqui ira una funcion para mostrar la cantidad de productos en el carrito (la logica aparte) --}}
            </span>
        </button>
        {{-- Opciones para los usuarios no registrados --}}
        @guest
        <a href="{{ route('login') }}" class="text-white border border-magma-diablillo px-4 py-2 rounded-lg hover:bg-magma-diablillo transition">Login</a>
        <a href="{{ route('register') }}" class="text-white border border-magma-diablillo px-4 py-2 rounded-lg hover:bg-magma-diablillo transition">Register</a>
        @endguest

        {{-- Opciones para los usuarios registrados --}}
        @auth
            <div class="flex items-center gap-4">
                @if(Auth::user()->email == 'prueba@prueba.com') {{-- Ajuste temporal --}}
                    <a href="{{ route('admin.dashboard') }}" class="text-magma-diablillo font-bold hover:text-mangle-toxico transition flex items-center gap-1 p-2">
                        <span class="material-symbols-outlined text-sm">admin_panel_settings</span>
                        Panel Admin
                    </a>
                @else
                    <a href="{{ route('dashboard') }}" class="text-coral-electrico hover:text-mangle-toxico transition flex items-center gap-1 p-2">
                        <span class="material-symbols-outlined text-sm">account_circle</span>
                        Panel Usuario
                    </a>
                @endif              

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-gray-400 hover:text-red-500 transition text-xs uppercase font-black p-2">
                        Salir
                    </button>
                </form>
            </div>
        @endauth
    </div>
</nav>