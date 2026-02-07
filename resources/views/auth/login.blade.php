<x-guest-layout>
    <x-slot name="heading">Welcome</x-slot>
    <x-slot name="subheading">Login to access your account</x-slot>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Account Lockout Banner with Countdown -->
    @if($errors->has('email') && str_contains($errors->first('email'), 'Account Locked'))
        <div id="lockout-banner"
            class="mb-6 rounded-lg bg-red-50 dark:bg-red-900/20 p-6 border-2 border-red-500 dark:border-red-700 shadow-lg">
            <div class="flex items-start space-x-4">
                <div class="flex-shrink-0">
                    <svg class="h-8 w-8 text-red-600 dark:text-red-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 1.944A11.954 11.954 0 012.166 5C2.056 5.649 2 6.319 2 7c0 5.225 3.34 9.67 8 11.317C14.66 16.67 18 12.225 18 7c0-.682-.057-1.35-.166-2.001A11.954 11.954 0 0110 1.944zM11 14a1 1 0 11-2 0 1 1 0 012 0zm0-7a1 1 0 10-2 0v3a1 1 0 102 0V7z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="flex-1">
                    <h3 class="text-lg font-bold text-red-800 dark:text-red-200 mb-2">
                        🔒 Account Temporarily Locked
                    </h3>
                    <p class="text-sm text-red-700 dark:text-red-300 mb-3">
                        Too many failed login attempts. Your account has been temporarily locked for security reasons.
                    </p>

                    <!-- Countdown Timer -->
                    <div class="bg-red-100 dark:bg-red-900/40 rounded-lg p-4 mb-3">
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-red-800 dark:text-red-200">
                                Time remaining:
                            </span>
                            <span id="countdown-timer" class="text-2xl font-bold text-red-600 dark:text-red-400">
                                <span id="minutes">3</span>:<span id="seconds">00</span>
                            </span>
                        </div>
                        <div class="mt-2">
                            <div class="w-full bg-red-200 dark:bg-red-800 rounded-full h-2">
                                <div id="progress-bar"
                                    class="bg-red-600 dark:bg-red-500 h-2 rounded-full transition-all duration-1000"
                                    style="width: 100%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-start space-x-2 text-sm text-red-700 dark:text-red-300">
                        <svg class="h-5 w-5 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                clip-rule="evenodd" />
                        </svg>
                        <p>
                            Need immediate help? Contact
                            <a href="mailto:support@ksf.it.com"
                                class="font-semibold underline hover:text-red-900 dark:hover:text-red-100">
                                support@ksf.it.com
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-4" id="login-form">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" placeholder="example@ksf.it.com"
                required autofocus autocomplete="username" />

            <!-- Show error only if it's NOT a lockout message -->
            @if($errors->has('email') && !str_contains($errors->first('email'), 'Account Locked'))
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            @endif

            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                Use your Kingsford University email (@ksf.it.com)
            </p>
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" />
            <div class="relative">
                <x-text-input id="password" type="password" name="password" placeholder="Enter your password" required
                    autocomplete="current-password" class="pr-10" />

                <!-- Toggle Password Visibility -->
                <button type="button" onclick="togglePasswordVisibility()"
                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                    <svg id="eye-icon" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <svg id="eye-slash-icon" class="h-5 w-5 hidden" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox" name="remember"
                    class="rounded border-gray-300 dark:border-gray-600 text-[#dc2d3d] shadow-sm focus:ring-[#dc2d3d] focus:ring-offset-0 dark:bg-gray-700 cursor-pointer">
                <span class="ml-2 text-sm text-gray-600 dark:text-gray-300">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                    class="text-sm text-[#dc2d3d] hover:text-[#b82532] dark:text-[#dc2d3d] dark:hover:text-[#ff4757] font-medium transition-colors">
                    {{ __('Forgot password?') }}
                </a>
            @endif
        </div>

        <!-- Login Button -->
        <x-primary-button id="login-button">
            {{ __('Log in') }}
        </x-primary-button>
    </form>

    <!-- Help Text -->
    <div class="mt-4 text-center">
        <p class="text-xs text-gray-500 dark:text-gray-400">
            Having trouble logging in? Contact
            <a href="mailto:support@ksf.it.com"
                class="text-[#dc2d3d] hover:text-[#b82532] dark:hover:text-[#ff4757] transition-colors">
                support@ksf.it.com
            </a>
        </p>
    </div>

    <x-slot name="additionalLinks">
        <p class="text-sm text-gray-600 dark:text-gray-300">
            Don't have an account?
            <a href="{{ route('register') }}"
                class="text-[#dc2d3d] hover:text-[#b82532] dark:text-[#dc2d3d] dark:hover:text-[#ff4757] font-semibold transition-colors">
                Register here
            </a>
        </p>
    </x-slot>

    <!-- JavaScript -->
    <script>
        // Password visibility toggle
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
            const eyeSlashIcon = document.getElementById('eye-slash-icon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.add('hidden');
                eyeSlashIcon.classList.remove('hidden');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('hidden');
                eyeSlashIcon.classList.add('hidden');
            }
        }

        // Countdown timer for lockout
        document.addEventListener('DOMContentLoaded', function () {
            const lockoutBanner = document.getElementById('lockout-banner');

            if (lockoutBanner) {
                // Disable form during lockout
                const form = document.getElementById('login-form');
                const loginButton = document.getElementById('login-button');
                const emailInput = document.getElementById('email');
                const passwordInput = document.getElementById('password');

                form.style.opacity = '0.6';
                form.style.pointerEvents = 'none';

                // Extract minutes from error message or default to 3
                const errorMessage = "{{ $errors->first('email') ?? '' }}";
                const minutesMatch = errorMessage.match(/(\d+)\s+minute/);
                let totalSeconds = minutesMatch ? parseInt(minutesMatch[1]) * 60 : 180; // Default 3 minutes

                const minutesDisplay = document.getElementById('minutes');
                const secondsDisplay = document.getElementById('seconds');
                const progressBar = document.getElementById('progress-bar');
                const totalDuration = totalSeconds;

                // Update countdown every second
                const countdownInterval = setInterval(function () {
                    totalSeconds--;

                    const minutes = Math.floor(totalSeconds / 60);
                    const seconds = totalSeconds % 60;

                    minutesDisplay.textContent = minutes;
                    secondsDisplay.textContent = seconds.toString().padStart(2, '0');

                    // Update progress bar
                    const progressPercentage = (totalSeconds / totalDuration) * 100;
                    progressBar.style.width = progressPercentage + '%';

                    // When countdown reaches 0
                    if (totalSeconds <= 0) {
                        clearInterval(countdownInterval);

                        // Hide lockout banner with animation
                        lockoutBanner.style.transition = 'opacity 0.5s, transform 0.5s';
                        lockoutBanner.style.opacity = '0';
                        lockoutBanner.style.transform = 'translateY(-20px)';

                        // Re-enable form
                        form.style.opacity = '1';
                        form.style.pointerEvents = 'auto';

                        // Remove banner from DOM
                        setTimeout(function () {
                            lockoutBanner.remove();
                        }, 500);

                        // Show success message
                        const successBanner = document.createElement('div');
                        successBanner.className = 'mb-6 rounded-lg bg-green-50 dark:bg-green-900/20 p-4 border border-green-500 dark:border-green-700';
                        successBanner.innerHTML = `
                            <div class="flex items-center space-x-3">
                                <svg class="h-5 w-5 text-green-600 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <p class="text-sm font-medium text-green-800 dark:text-green-200">
                                    Lockout expired. You can now try logging in again.
                                </p>
                            </div>
                        `;
                        lockoutBanner.parentElement.insertBefore(successBanner, form);

                        // Auto-hide success message after 5 seconds
                        setTimeout(function () {
                            successBanner.style.transition = 'opacity 0.5s';
                            successBanner.style.opacity = '0';
                            setTimeout(function () {
                                successBanner.remove();
                            }, 500);
                        }, 5000);
                    }
                }, 1000);
            }
        });
    </script>
</x-guest-layout>