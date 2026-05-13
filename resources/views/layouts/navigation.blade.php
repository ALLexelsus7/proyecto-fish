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
        <button class="hover:text-ojo-aberracion transition">
            <span class="material-symbols-outlined">shopping_cart</span>
        </button>
        @guest
        <a href="{{ route('login') }}" class="text-white border border-magma-diablillo px-4 py-2 rounded-lg hover:bg-magma-diablillo transition">Login</a>
        <a href="{{ route('register') }}" class="text-white border border-magma-diablillo px-4 py-2 rounded-lg hover:bg-magma-diablillo transition">Register</a>
        @endguest

        @auth
            <div class="flex items-center gap-4">
                @if(Auth::user()->email == 'prueba@prueba.com') {{-- Ajuste temporal --}}
                    <a href="{{ route('admin.productos.index') }}" class="text-magma-diablillo font-bold hover:text-white transition">
                        [ Panel Admin ]
                    </a>
                @endif

                <a href="{{ route('dashboard') }}" class="text-coral-electrico hover:text-white transition flex items-center gap-1">
                    <span class="material-symbols-outlined text-sm">account_circle</span>
                    Mi Cuenta
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-gray-400 hover:text-red-500 transition text-xs uppercase font-black">
                        Salir
                    </button>
                </form>
            </div>
        @endauth
    </div>
</nav>