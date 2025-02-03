<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="flex items-center justify-center min-h-screen">
        <div class="w-full max-w-md px-8 py-12 rounded-xl">
            <h2 class="text-3xl font-semibold text-center text-yellow-800 mb-8">Welcome Back!</h2>
           
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-6">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full border border-gray-300 focus:ring-2 focus:ring-yellow-500 focus:border-indigo-800 rounded-md py-3 px-4" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-600" />
                </div>

                <!-- Password -->
                <div class="mb-6">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full border border-gray-300 focus:ring-2 focus:ring-yellow-500 focus:border-indigo-800 rounded-md py-3 px-4" type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-600" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between mb-6">
                    <label for="remember_me" class="inline-flex items-center text-sm text-gray-600">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                        <span class="ml-2">{{ __('Remember me') }}</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-indigo-600 hover:underline">{{ __('Forgot your password?') }}</a>
                    @endif
                </div>

                <!-- Submit Button -->
                <div class="mt-8">
                    <x-primary-button class="w-full py-3 bg-yellow-700 hover:bg-yellow-600 text-white font-semibold rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>

                <!-- Divider -->
                <div class="mt-6 text-center text-sm text-gray-500">
                    <p>Don't have an account? <a href="{{ route('register') }}" class="text-indigo-600 hover:underline">Sign up</a></p>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
