<x-guest-layout>
    <x-slot name="heading">Reset Password</x-slot>
    <x-slot name="subheading">Enter your new password</x-slot>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-4">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" />
            <x-text-input id="email" type="email" name="email" :value="old('email', $request->email)"
                placeholder="example@ksf.it.com" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password">
                <span>{{ __('New Password') }}</span>
                @include('components.password-info')
            </x-input-label>
            <div class="relative">
                <x-text-input id="password" type="password" name="password" placeholder="Enter new password" required
                    autocomplete="new-password" class="pr-10" />
                <x-password-toggle :targets="['password', 'password_confirmation']" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" type="password" name="password_confirmation"
                placeholder="Confirm new password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Reset Button -->
        <x-primary-button>
            {{ __('Reset Password') }}
        </x-primary-button>
    </form>

    <x-slot name="additionalLinks">
        <p class="text-sm text-gray-600 dark:text-gray-300">
            Remember your password?
            <a href="{{ route('login') }}"
                class="text-[#dc2d3d] hover:text-[#b82532] dark:text-[#dc2d3d] dark:hover:text-[#ff4757] font-semibold transition-colors">
                Back to Login
            </a>
        </p>
    </x-slot>


</x-guest-layout>