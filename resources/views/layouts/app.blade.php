{{-- Este es el layout principal plantilla para las demas vistas --}}
<!DOCTYPE html>
<html lang="es"> {{-- {{ str_replace('_', '-', app()->getLocale()) }} --}}
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Abyssal Catch Co. - Peces Exóticos </title> {{-- config('app.name', 'Laravel') --}}
        <!-- Fonts & Icons -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,400,0,0" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    {{-- Estilo para el cuerpo de la página según la sección y el tipo de background (imagen o color) --}}
    @php
        $bodyStyle = trim($__env->yieldContent('body-style'));
        $bodyBackground = trim($__env->yieldContent('body-background'));
    @endphp
    <body class="@yield('body-class', 'font-sans antialiased text-white bg-cover bg-center bg-no-repeat bg-fixed bg-black/10')"
          style="{{ $bodyStyle ?: 'background-image:url(\''.($bodyBackground ?: asset('img/svg/pattern-abismal.svg')).'\');' }}">
          {{-- Aqui el style admite imagenes o colores de fondo y ese svg sera el default --}}

        <div class="min-h-screen">
            <header class="fixed w-full z-50 tarjeta-cristal transition-all duration-300">
                @include('layouts.navigation')
            </header>

            <main>
                {{-- {{ $slot }}  es la froma de Breeze para inyectar contenido--}}
                {{-- y el contenido se pone entre <x-app-layout> ... </x-app-layout> --}}
                @yield('content') {{-- pero @yield() es el modo default de Laravel --}}
            </main>
          
            @include('layouts.footer')
            
        </div>

        {{-- Agrego la libreria Parallax.js para hacer scrolls cool y animado --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/parallax/3.1.0/parallax.min.js"></script>    
        @stack('scripts') {{-- Esto sirve para meter código JS desde otras vistas --}}
    </body>
</html>
