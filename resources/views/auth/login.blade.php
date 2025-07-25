<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('auth.authenticate') }}">
        @csrf

        <!-- nik -->
        <div>
            <x-input-label for="nik" :value="__('NIK')" />
            <x-text-input id="nik" class="block mt-2 w-full" type="text" name="nik" :value="old('nik')" required autofocus />
            <x-input-error :messages="$errors->get('nik')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                        type="password"
                        name="password"
                        required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />

            <!-- Show Password Checkbox -->
            <div class="mt-2">
                <label class="inline-flex items-center">
                    <input type="checkbox" id="show_password" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring focus:ring-indigo-500" onclick="togglePasswordVisibility()">
                    <span class="ml-2 text-sm text-gray-600">Show password</span>
                </label>
            </div>
        </div>


        <!-- Remember Me -->
        {{-- <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div> --}}

        <div class="flex items-center justify-end mt-4">
            {{-- @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif --}}

            <x-primary-button class="ml-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
<script>
    function togglePasswordVisibility() {
        const input = document.getElementById('password');
        const checkbox = document.getElementById('show_password');
        input.type = checkbox.checked ? 'text' : 'password';
    }
</script>
