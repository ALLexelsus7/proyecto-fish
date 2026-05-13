<x-guest-layout>
    <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0">        
        
        <div class="z-10 pt-5">            
            <img src="{{ asset('img/logos/logo.png') }}" class="h-32 fill-current" />          
        </div>

        <div class="z-10 w-full sm:max-w-md mt-6 px-6 py-8 tarjeta-cristal overflow-hidden border border-white/10 shadow-2xl shadow-magma-diablillo/20">
            <h2 class="text-white text-2xl font-black text-center mb-6 tracking-widest uppercase">
                Acceso <span class="text-magma-diablillo text-3xl">Abyssal</span>
            </h2>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" class="text-white font-bold" :value="__('Email')"/>
                    <x-text-input id="email" class="block mt-1 w-full bg-ojo-aberracion/10 border-white/20 text-ojo-aberracion focus:ring-magma-diablillo focus:border-magma-diablillo" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" class="text-white font-bold"/>

                    <x-text-input id="password" class="block mt-1 w-full bg-ojo-aberracion/10 border-white/20 text-ojo-aberracion focus:ring-magma-diablillo focus:border-magma-diablillo"
                                    type="password"
                                    name="password"
                                    required autocomplete="current-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded bg-white/10 border-white/20 text-magma-diablillo shadow-sm focus:ring-magma-diablillo" name="remember">
                        <span class="ms-2 text-sm text-gray-400 font-bold tracking-tighter">Remember me</span>
                    </label>
                </div>
                <a class="text-sm text-gray-400 hover:text-white transition font-medium underline rounded-md focus:outline-none" href="{{ route('register') }}">
                        ¿No tienes cuenta?
                </a>

                <div class="flex items-center justify-end mt-4">
                    @if (Route::has('password.request'))
                        <a class="text-sm text-gray-400 hover:text-white transition font-medium underline rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                            Forgot your password?
                        </a>
                    @endif

                    <x-primary-button class="ms-3 bg-magma-diablillo hover:bg-ojo-aberracion border-none py-3 px-8 font-black shadow-lg shadow-magma-diablillo/40">
                        Log in
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>