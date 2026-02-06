<x-guest-layout>
  <x-slot name="heading">Change Your Password</x-slot>
  <x-slot name="subheading">You must change your temporary password</x-slot>

  <!-- Warning Banner -->
  <div class="mb-6 rounded-lg bg-yellow-50 dark:bg-yellow-900/20 p-6 border-2 border-yellow-500 dark:border-yellow-700">
    <div class="flex items-start space-x-4">
      <svg class="h-6 w-6 text-yellow-600 dark:text-yellow-400 flex-shrink-0 mt-0.5" fill="currentColor"
        viewBox="0 0 20 20">
        <path fill-rule="evenodd"
          d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
          clip-rule="evenodd" />
      </svg>
      <div>
        <h3 class="text-lg font-bold text-yellow-800 dark:text-yellow-200 mb-2">
          ⚠️ Temporary Password Detected
        </h3>
        <p class="text-sm text-yellow-700 dark:text-yellow-300">
          For your security, you must change your temporary password before accessing your account.
          Please choose a strong, unique password that you haven't used elsewhere.
        </p>
      </div>
    </div>
  </div>

  <form method="POST" action="{{ route('password.update.temporary') }}" class="space-y-4">
    @csrf
    @method('PUT')

    <!-- Current Password -->
    <div>
      <x-input-label for="current_password" :value="__('Current Password')" />
      <div class="relative">
        <x-text-input id="current_password" type="password" name="current_password" placeholder="kingsford123" required
          class="pr-10" />

        <button type="button" onclick="togglePasswordVisibility('current_password')"
          class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
          <svg id="current_password-eye-icon" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
          </svg>
          <svg id="current_password-eye-slash-icon" class="h-5 w-5 hidden" fill="none" stroke="currentColor"
            viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
          </svg>
        </button>
      </div>
      <x-input-error :messages="$errors->get('current_password')" class="mt-2" />
    </div>

    <!-- New Password -->
    <div>
      <x-input-label for="password" :value="__('New Password')" />
      <div class="relative">
        <x-text-input id="password" type="password" name="password" placeholder="Enter new strong password" required
          class="pr-10" />

        <button type="button" onclick="togglePasswordVisibility('password')"
          class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
          <svg id="password-eye-icon" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
          </svg>
          <svg id="password-eye-slash-icon" class="h-5 w-5 hidden" fill="none" stroke="currentColor"
            viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
          </svg>
        </button>
      </div>
      <x-input-error :messages="$errors->get('password')" class="mt-2" />

      <!-- Password Requirements -->
      <div class="mt-2 text-xs text-gray-600 dark:text-gray-400 space-y-1">
        <p class="font-medium">Your new password must contain:</p>
        <ul class="list-disc list-inside ml-2 space-y-0.5">
          <li>At least 8 characters</li>
          <li>At least one uppercase letter (A-Z)</li>
          <li>At least one lowercase letter (a-z)</li>
          <li>At least one number (0-9)</li>
          <li>Cannot be "kingsford123"</li>
        </ul>
      </div>
    </div>

    <!-- Confirm New Password -->
    <div>
      <x-input-label for="password_confirmation" :value="__('Confirm New Password')" />
      <div class="relative">
        <x-text-input id="password_confirmation" type="password" name="password_confirmation"
          placeholder="Re-enter new password" required class="pr-10" />

        <button type="button" onclick="togglePasswordVisibility('password_confirmation')"
          class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
          <svg id="password_confirmation-eye-icon" class="h-5 w-5" fill="none" stroke="currentColor"
            viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
          </svg>
          <svg id="password_confirmation-eye-slash-icon" class="h-5 w-5 hidden" fill="none" stroke="currentColor"
            viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
          </svg>
        </button>
      </div>
      <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
    </div>

    <!-- Change Password Button -->
    <x-primary-button class="w-full justify-center">
      {{ __('Change Password') }}
    </x-primary-button>
  </form>

  <!-- Help Text -->
  <div class="mt-4 text-center">
    <p class="text-xs text-gray-500 dark:text-gray-400">
      Need help? Contact
      <a href="mailto:support@ksf.it.com" class="text-[#dc2d3d] hover:text-[#b82532] transition-colors">
        support@ksf.it.com
      </a>
    </p>
  </div>

  <!-- JavaScript -->
  <script>
    function togglePasswordVisibility(fieldId) {
      const field = document.getElementById(fieldId);
      const eyeIcon = document.getElementById(fieldId + '-eye-icon');
      const eyeSlashIcon = document.getElementById(fieldId + '-eye-slash-icon');

      if (field.type === 'password') {
        field.type = 'text';
        eyeIcon.classList.add('hidden');
        eyeSlashIcon.classList.remove('hidden');
      } else {
        field.type = 'password';
        eyeIcon.classList.remove('hidden');
        eyeSlashIcon.classList.add('hidden');
      }
    }
  </script>
</x-guest-layout>