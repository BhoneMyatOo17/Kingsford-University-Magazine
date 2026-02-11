<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password - Kingsford University</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 dark:bg-[#18181b]">
    @include('components.navigation')
    <div class="min-h-screen flex items-center justify-center px-4 py-36">
        <div class="w-full max-w-md">
            <!-- Warning Message -->
            @if(session('warning'))
                <div
                    class="mb-6 bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 text-yellow-800 dark:text-yellow-200 px-4 py-3 rounded-lg">
                    {{ session('warning') }}
                </div>
            @endif

            <!-- Form Card -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl overflow-hidden">
                <!-- Card Header -->
                <div class="bg-[#dc2d3d] px-6 py-4">
                    <h2 class="text-xl font-bold text-white">Password Change Required</h2>
                </div>

                <!-- Form -->
                <form method="POST" action="{{ route('temporary-password.update') }}" class="p-6" id="password-form">
                    @csrf

                    <!-- Error Messages -->
                    @if($errors->any())
                        <div
                            class="mb-6 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4">
                            <ul class="text-sm text-red-800 dark:text-red-200 space-y-1">
                                @foreach($errors->all() as $error)
                                    <li class="flex items-start">
                                        <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        {{ $error }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- New Password -->
                    <div class="mb-6">
                        <label for="new_password"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            New Password
                        </label>
                        <div class="relative">
                            <input type="password" name="new_password" id="new_password" required
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-[#dc2d3d] focus:border-transparent dark:bg-gray-700 dark:text-white transition-all"
                                placeholder="Create a strong password">
                            <button type="button" onclick="toggleBothPasswords()"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                                <svg id="eye-icon" class="w-5 h-5" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                        @error('new_password')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-6">
                        <label for="new_password_confirmation"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Confirm New Password
                        </label>
                        <div class="relative">
                            <input type="password" name="new_password_confirmation" id="new_password_confirmation"
                                required
                                class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-[#dc2d3d] focus:border-transparent dark:bg-gray-700 dark:text-white transition-all"
                                placeholder="Confirm your new password">
                        </div>
                    </div>

                    <!-- Password Requirements -->
                    <div
                        class="mb-6 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4">
                        <p class="text-sm font-medium text-blue-800 dark:text-blue-200 mb-2">Password Requirements:</p>
                        <ul class="text-xs text-blue-700 dark:text-blue-300 space-y-1">
                            <li class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                                At least 8 characters long
                            </li>
                            <li class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                                Contains uppercase and lowercase letters
                            </li>
                            <li class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                                Contains numbers
                            </li>
                            <li class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                                One special character(!@#$%)
                            </li>
                        </ul>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full bg-gradient-to-r from-[#dc2d3d] to-[#b82532] text-white font-semibold py-3 px-4 rounded-lg hover:shadow-lg transition-all duration-300">
                        Set Password
                    </button>

                    <!-- Logout Link -->
                    <div class="mt-4 text-center">
                        <button type="button" onclick="handleLogout()"
                            class="text-sm text-gray-600 dark:text-gray-400 hover:text-[#dc2d3d] dark:hover:text-[#dc2d3d] transition-colors">
                            Logout Instead
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Hidden Logout Form -->
    <form id="logout-form" method="POST" action="{{ route('logout') }}" class="hidden">
        @csrf
    </form>

    <script>
        // Toggle both password fields simultaneously
        function toggleBothPasswords() {
            const newPassword = document.getElementById('new_password');
            const confirmPassword = document.getElementById('new_password_confirmation');
            const currentType = newPassword.type;
            const newType = currentType === 'password' ? 'text' : 'password';

            newPassword.type = newType;
            confirmPassword.type = newType;
        }

        // Handle logout without form validation
        function handleLogout() {
            // Remove required attributes temporarily
            const passwordForm = document.getElementById('password-form');
            const requiredFields = passwordForm.querySelectorAll('[required]');
            requiredFields.forEach(field => field.removeAttribute('required'));

            // Submit the logout form
            document.getElementById('logout-form').submit();
        }

        // Check for saved theme preference
        if (localStorage.getItem('color-theme') === 'dark') {
            document.documentElement.classList.add('dark');
        }
    </script>
</body>

</html>