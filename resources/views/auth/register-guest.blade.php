<x-guest-layout>
  <x-slot name="heading">Guest Registration</x-slot>
  <x-slot name="subheading">View a faculty's published contributions</x-slot>

  <div class="w-full px-4">
    <form method="POST" action="{{ route('register.guest.store') }}" class="space-y-6 max-w-none">
      @csrf

      <div>
        <x-input-label for="name">
          {{ __('Full Name') }}<span class="text-red-500 ml-1">*</span>
        </x-input-label>
        <x-text-input id="name" type="text" name="name" :value="old('name')" placeholder="John Doe" required autofocus
          autocomplete="name" />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
      </div>

      <div>
        <x-input-label for="email">
          {{ __('Email Address') }}<span class="text-red-500 ml-1">*</span>
        </x-input-label>
        <x-text-input id="email" type="email" name="email" :value="old('email')" placeholder="you@example.com" required
          autocomplete="username" />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
      </div>

      <div>
        <x-input-label for="guest_faculty_id">
          {{ __('Faculty to View') }}<span class="text-red-500 ml-1">*</span>
        </x-input-label>
        <div class="relative">
          <select id="guest_faculty_id" name="guest_faculty_id" required
            class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-[#dc2d3d]">
            <option value="">Select a faculty</option>
            @foreach($faculties as $faculty)
              <option value="{{ $faculty->id }}" {{ old('guest_faculty_id') == $faculty->id ? 'selected' : '' }}>
                {{ $faculty->name }}
              </option>
            @endforeach
          </select>
          <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
            <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd"
                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                clip-rule="evenodd" />
            </svg>
          </div>
        </div>
        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">You will be able to view this faculty's published
          contributions after registration.</p>
        <x-input-error :messages="$errors->get('guest_faculty_id')" class="mt-2" />
      </div>

      <div>
        <x-input-label for="password">
          {{ __('Password') }}<span class="text-red-500 ml-1">@include('components.password-info')</span>
        </x-input-label>
        <x-text-input id="password" type="password" name="password" required autocomplete="new-password" />
        <x-input-error :messages="$errors->get('password')" class="mt-2" />
      </div>

      <div>
        <x-input-label for="password_confirmation">
          {{ __('Confirm Password') }}<span class="text-red-500 ml-1">*</span>
        </x-input-label>
        <x-text-input id="password_confirmation" type="password" name="password_confirmation" required
          autocomplete="new-password" />
        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
      </div>

      <x-primary-button class="w-full justify-center">Create Guest Account</x-primary-button>
    </form>
  </div>

  <x-slot name="additionalLinks">
    <p class="text-sm text-gray-600 dark:text-gray-300">
      Already have an account?
      <a href="{{ route('login') }}"
        class="text-[#dc2d3d] hover:text-[#b82532] font-semibold transition-colors">Login</a>
    </p>
    <p class="text-sm text-gray-600 dark:text-gray-300 mt-2">
      Kingsford student?
      <a href="{{ route('register') }}"
        class="text-[#dc2d3d] hover:text-[#b82532] font-semibold transition-colors">Register here</a>
    </p>
  </x-slot>

  <style>
    select {
      appearance: none;
      -webkit-appearance: none;
    }
  </style>
</x-guest-layout>