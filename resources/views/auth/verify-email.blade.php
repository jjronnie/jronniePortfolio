<x-guest-layout>
    <div class="mb-4 text-sm" style="color: var(--muted-foreground);">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm" style="color: var(--primary);">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn-primary" style="justify-content: center;">
                {{ __('Resend Verification Email') }}
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" style="color: var(--primary); text-decoration: underline; text-underline-offset: 2px; font-size: 0.875rem; background: none; border: none; cursor: pointer;">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout>
