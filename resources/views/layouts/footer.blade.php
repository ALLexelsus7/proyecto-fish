<footer class="tarjeta-cristal-2 border-t border-white/10 pt-16 pb-8 mt-20">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
        
        <div class="space-y-4">
            <a href="#" class="flex items-center gap-3 text-2xl font-bold tracking-tighter text-white">
                <img src="{{ asset('img/logos/logo.png') }}" alt="logo" class="w-12">
                <span>ABYSSAL <span class="text-magma-diablillo font-black">CATCH</span></span>
            </a>
            <p class="text-gray-400 text-sm leading-relaxed">
                Llevando las maravillas más extrañas de las profundidades abisales directamente a tu mesa o acuario. Calidad criogénica garantizada.
            </p>
            <div class="flex gap-4">
                <a href="#" class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center hover:bg-magma-diablillo transition-all duration-300">
                    <i class="fa-brands fa-facebook-f text-white"></i>
                </a>
                <a href="#" class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center hover:bg-coral-electrico transition-all duration-300">
                    <i class="fa-brands fa-x-twitter text-white"></i>
                </a>
                <a href="#" class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center hover:bg-ojo-aberracion transition-all duration-300">
                    <i class="fa-brands fa-instagram text-white"></i>
                </a>
            </div>
        </div>

        <div>
            <h3 class="text-white text-lg font-bold mb-6 flex items-center gap-2">
                <span class="text-magma-diablillo">|</span> Información
            </h3>
            <ul class="space-y-4 text-gray-400">
                <li class="flex items-center gap-3 hover:text-white transition">
                    <span class="material-symbols-outlined text-coral-electrico">call</span>
                    <span>+52 (33) 1234 5678</span>
                </li>
                <li class="flex items-center gap-3 hover:text-white transition">
                    <span class="material-symbols-outlined text-coral-electrico">mail</span>
                    <span>ventas@abyssalcatch.com</span>
                </li>
                <li class="flex items-center gap-3 hover:text-white transition">
                    <span class="material-symbols-outlined text-coral-electrico">location_on</span>
                    <span>Zapopan, Jalisco, México</span>
                </li>
            </ul>
        </div>

        <div>
            <h3 class="text-white text-lg font-bold mb-6 flex items-center gap-2">
                <span class="text-magma-diablillo">|</span> Menú
            </h3>
            <nav class="flex flex-col space-y-3">
                <a href="{{ route('home') }}" class="text-gray-400 hover:text-coral-electrico flex items-center gap-2 group transition">
                    <span class="material-symbols-outlined text-sm group-hover:translate-x-1 transition-transform">arrow_forward_ios</span>
                    Inicio
                </a>
                <a href="{{ route('productos') }}" class="text-gray-400 hover:text-coral-electrico flex items-center gap-2 group transition">
                    <span class="material-symbols-outlined text-sm group-hover:translate-x-1 transition-transform">arrow_forward_ios</span>
                    Peces Exóticos
                </a>
                <a href="{{ route('contacto') }}" class="text-gray-400 hover:text-coral-electrico flex items-center gap-2 group transition">
                    <span class="material-symbols-outlined text-sm group-hover:translate-x-1 transition-transform">arrow_forward_ios</span>
                    Contacto
                </a>
                <a href="#" class="text-gray-400 hover:text-coral-electrico flex items-center gap-2 group transition">
                    <span class="material-symbols-outlined text-sm group-hover:translate-x-1 transition-transform">arrow_forward_ios</span>
                    Preguntas Frecuentes
                </a>
            </nav>
        </div>

        <div>
            <h3 class="text-white text-lg font-bold mb-6 flex items-center gap-2">
                <span class="text-magma-diablillo">|</span> Newsletter
            </h3>
            <p class="text-gray-400 text-sm mb-4">Suscríbete para recibir alertas de capturas raras.</p>
            <form class="space-y-3">
                <input type="email" placeholder="Tu correo electrónico" 
                    class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-magma-diablillo transition">
                <button type="submit" 
                    class="w-full bg-magma-diablillo hover:bg-ojo-aberracion text-white font-bold py-2 rounded-lg transition-all duration-300">
                    Suscribirse
                </button>
            </form>
        </div>

    </div>

    <div class="max-w-7xl mx-auto px-6 mt-16 pt-8 border-t border-white/5 flex flex-col md:flex-row justify-between items-center text-gray-500 text-xs">
        <p>Created by <span class="text-white font-medium">Alex Ruiz Jordan</span> | Ing. en Desarrollo de Software, CETI.</p>
        <div class="flex items-center gap-2 mt-4 md:mt-0">
            <span class="material-symbols-outlined text-sm">copyright</span>
            <span>2026 Abyssal Catch Co. - Casi todos los derechos reservados.</span>
        </div>
    </div>
</footer>