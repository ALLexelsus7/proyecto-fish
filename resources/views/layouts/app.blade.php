{{-- Este es el layout principal --}}
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
    <body class="font-sans antialiased text-white bg-cover bg-center bg-no-repeat bg-fixed bg-black/10" style="background-image:url('{{ asset('img/bg/HadalZone.png') }}');"">
        <div class="min-h-screen">
            <header class="fixed w-full z-50 tarjeta-cristal transition-all duration-300">
                @include('layouts.navigation')
            </header>

            {{-- <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset --}}

            <!-- Page Content -->
            <main>
                {{-- {{ $slot }} --}}
                @yield('content')
            </main>
          
            @include('layouts.footer')
            
        </div>
    </body>
</html>
