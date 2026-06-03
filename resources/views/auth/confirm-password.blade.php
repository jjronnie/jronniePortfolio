<x-guest-layout>
    <div class="mb-4 text-sm" style="color: var(--muted-foreground);">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div>
            <label for="password" class="form-label">{{ __('Password') }}</label>
            <input id="password" class="form-input mt-1 block w-full" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-6">
            <button type="submit" class="btn-primary" style="justify-content: center;">
                {{ __('Confirm') }}
            </button>
        </div>
    </form>
</x-guest-layout>
