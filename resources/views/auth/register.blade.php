<x-guest-layout>
    <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0">        
        
        <a class="z-10 pt-5 hover:scale-105 transition-all duration-300 ease-in-out" href="{{ route('home') }}" aria-label="Abyssal Home" title="Abyssal Home">            
            <img src="{{ asset('img/logos/logo.png') }}" class="h-32 fill-current" />          
        </a>

        <div class="z-10 w-full sm:max-w-md mt-6 px-6 py-8 tarjeta-cristal overflow-hidden border border-white/10 shadow-2xl shadow-magma-diablillo/20">
            <h2 class="text-white text-2xl font-black text-center mb-6 tracking-widest uppercase">
                Nueva <span class="text-magma-diablillo text-3xl">Expedición</span>
            </h2>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div>
                    <x-input-label for="name" class="text-white font-bold" :value="__('Nombre del Recluta')" />
                    <x-text-input id="name" class="block mt-1 w-full bg-ojo-aberracion/10 border-white/20 text-ojo-aberracion focus:ring-magma-diablillo focus:border-magma-diablillo" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="email" class="text-white font-bold" :value="__('Email de Contacto')" />
                    <x-text-input id="email" class="block mt-1 w-full bg-ojo-aberracion/10 border-white/20 text-ojo-aberracion focus:ring-magma-diablillo focus:border-magma-diablillo" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mt-4" x-data="{ show: false }">
                    <x-input-label for="password" class="text-white font-bold" :value="__('Clave de Acceso')" />
                    
                    <div class="relative mt-1">
                        <x-text-input id="password" 
                            class="block w-full pr-10 bg-ojo-aberracion/10 border-white/20 text-ojo-aberracion focus:ring-magma-diablillo focus:border-magma-diablillo"
                            x-bind:type="show ? 'text' : 'password'"
                            name="password"
                            required autocomplete="new-password" />
                        
                        <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-magma-diablillo transition focus:outline-none">
                            <span class="material-symbols-outlined text-sm" x-text="show ? 'visibility_off' : 'visibility'">visibility</span>
                        </button>
                    </div>

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="mt-4" x-data="{ show: false }">
                    <x-input-label for="password_confirmation" class="text-white font-bold" :value="__('Confirmar Clave')" />
                    
                    <div class="relative mt-1">
                        <x-text-input id="password_confirmation" 
                            class="block w-full pr-10 bg-ojo-aberracion/10 border-white/20 text-ojo-aberracion focus:ring-magma-diablillo focus:border-magma-diablillo"
                            x-bind:type="show ? 'text' : 'password'"
                            name="password_confirmation" required autocomplete="new-password" />
                        
                        <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-magma-diablillo transition focus:outline-none">
                            <span class="material-symbols-outlined text-sm" x-text="show ? 'visibility_off' : 'visibility'">visibility</span>
                        </button>
                    </div>

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-6">
                    <a class="text-sm text-gray-400 hover:text-white transition font-medium underline rounded-md focus:outline-none" href="{{ route('login') }}">
                        ¿Ya tienes cuenta?
                    </a>

                    <x-primary-button class="ms-4 bg-magma-diablillo hover:bg-ojo-aberracion border-none py-3 px-8 font-black shadow-lg shadow-magma-diablillo/40">
                        Registrarse
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>