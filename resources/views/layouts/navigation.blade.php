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
        @auth
            <a href="{{ route('dashboard') }}" class="text-sm border border-white/20 px-4 py-2 rounded-full hover:bg-white/10">Panel</a>
        @else
            <a href="{{ route('login') }}" class="text-sm bg-magma-diablillo px-5 py-2 rounded-full hover:bg-ojo-aberracion transition font-bold hover:text-mar-profundo">Login</a>
            <a href="{{ route('register') }}" class="text-sm bg-magma-diablillo px-5 py-2 rounded-full hover:bg-ojo-aberracion transition font-bold hover:text-mar-profundo">Register</a>
        @endauth
    </div>
</nav>