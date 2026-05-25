<section>
    <header>
        <h2 class="text-lg font-medium text-gray-300">
            Update Password
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Ensure your account is using a long, random password to stay secure.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div x-data="{ show: false }">
            <x-input-label for="update_password_current_password" :value="__('Current Password')" />
            <div class="relative mt-1">
                <x-text-input id="update_password_current_password" 
                              name="current_password" 
                              x-bind:type="show ? 'text' : 'password'" 
                              class="block w-full text-coral-electrico pr-10" 
                              autocomplete="current-password" />
                
                <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-coral-electrico focus:outline-none">
                    <span class="material-symbols-outlined text-sm" x-text="show ? 'visibility_off' : 'visibility'">visibility</span>
                </button>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div x-data="{ show: false }">
            <x-input-label for="update_password_password" :value="__('New Password')" />
            <div class="relative mt-1">
                <x-text-input id="update_password_password" 
                              name="password" 
                              x-bind:type="show ? 'text' : 'password'" 
                              class="block w-full text-coral-electrico pr-10" 
                              autocomplete="new-password" />
                
                <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-coral-electrico focus:outline-none">
                    <span class="material-symbols-outlined text-sm" x-text="show ? 'visibility_off' : 'visibility'">visibility</span>
                </button>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div x-data="{ show: false }">
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
            <div class="relative mt-1">
                <x-text-input id="update_password_password_confirmation" 
                              name="password_confirmation" 
                              x-bind:type="show ? 'text' : 'password'" 
                              class="block w-full text-coral-electrico pr-10" 
                              autocomplete="new-password" />
                
                <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-coral-electrico focus:outline-none">
                    <span class="material-symbols-outlined text-sm" x-text="show ? 'visibility_off' : 'visibility'">visibility</span>
                </button>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>Save</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-fosforescencia-abisal"
                >Saved.</p>
            @endif
        </div>
    </form>
</section>