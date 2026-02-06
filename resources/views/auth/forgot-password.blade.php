<x-guest-layout>
    <x-slot name="heading">Forgot Password?</x-slot>
    <x-slot name="subheading">Reset your password</x-slot>

    <div class="mb-6 text-sm text-gray-600 dark:text-gray-300 leading-relaxed">
        {{ __('Enter your email address and we will send you a reset link.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" placeholder="example@ksf.it.com"
                required autofocus autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Submit Button -->
        <x-primary-button>
            {{ __('Email Password Reset Link') }}
        </x-primary-button>
    </form>

    <x-slot name="additionalLinks">
        <p class="text-sm text-gray-600 dark:text-gray-300">
            <a href="{{ route('login') }}"
                class="text-[#dc2d3d] hover:text-[#b82532] dark:text-[#dc2d3d] dark:hover:text-[#ff4757] font-semibold transition-colors">
                Back to Login
            </a>
        </p>
    </x-slot>
</x-guest-layout>