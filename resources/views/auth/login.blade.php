<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input id="email" class="form-input mt-1 block w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <label for="password" class="form-label">{{ __('Password') }}</label>
            <input id="password" class="form-input mt-1 block w-full" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center" style="color: var(--foreground);">
                <input id="remember_me" type="checkbox" name="remember" class="rounded" style="border-color: var(--border-color); color: var(--primary);">
                <span class="ms-2 text-sm">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-between mt-6">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" style="color: var(--primary); text-decoration: underline; text-underline-offset: 2px; font-size: 0.875rem;">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <button type="submit" class="btn-primary" style="justify-content: center;">
                {{ __('Log in') }}
            </button>
        </div>
    </form>
</x-guest-layout>
