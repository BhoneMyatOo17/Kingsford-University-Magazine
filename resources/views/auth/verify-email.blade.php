<x-guest-layout>
    <x-slot name="heading">Verification Sent</x-slot>
    <x-slot name="subheading">Check your inbox to continue</x-slot>

    <!-- Paper Plane Image Section -->
    <div class="flex justify-center mb-8">
        <div class="relative">
            <!-- Add your paper plane image here -->
            <img src="{{ asset('assets/plane.png') }}" alt="Paper Plane"
                class="w-68 h-48 md:w-58 md:h-46 object-contain animate-bounce-slow">

            <!-- Decorative circles around the plane -->
            <div class="absolute -top-4 -right-4 w-16 h-16 bg-[#dc2d3d]/10 rounded-full blur-xl"></div>
            <div class="absolute -bottom-4 -left-4 w-20 h-20 bg-blue-500/10 rounded-full blur-xl"></div>
        </div>
    </div>

    <!-- Success Message -->
    @if (session('status'))
        <div
            class="mb-6 rounded-lg bg-green-50 dark:bg-green-900/20 p-4 border-l-4 border-green-500 dark:border-green-700 animate-fade-in">
            <div class="flex items-center space-x-3">
                <svg class="h-6 w-6 text-green-600 dark:text-green-400 flex-shrink-0" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd" />
                </svg>
                <p class="text-sm font-medium text-green-800 dark:text-green-200">
                    {{ session('status') }}
                </p>
            </div>
        </div>
    @endif

    <!-- Main Content Card -->
    <div
        class="mb-6 rounded-xl bg-gradient-to-br from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 p-8 border-2 border-blue-200 dark:border-blue-800 shadow-lg">
        <div class="text-center mb-6">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-[#dc2d3d] rounded-full mb-4 shadow-lg">
                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-3">
                Verification Email Sent!
            </h3>
            <p class="text-base text-gray-700 dark:text-gray-300 mb-4 leading-relaxed">
                Thanks for signing up! We've sent a verification link to
            </p>
            <p class="text-lg font-bold text-[#dc2d3d] mb-4">
                {{ Auth::user()->email }}
            </p>
            <p class="text-sm text-gray-600 dark:text-gray-400">
                Please check your inbox and click the verification link to activate your account and start contributing
                to the Kingsford University Magazine.
            </p>
        </div>
    </div>


    <!-- Resend Verification Email Button -->
    <form method="POST" action="{{ route('verification.send') }}" class="mb-6">
        @csrf
        <x-primary-button
            class="w-full justify-center py-4 text-base font-semibold shadow-lg hover:shadow-xl transition-all duration-300">
            {{ __('Resend Verification Email') }}
        </x-primary-button>
    </form>

    <!-- Troubleshooting Section -->
    <div class="mb-6 rounded-lg bg-gray-50 dark:bg-gray-800/50 p-6 border border-gray-200 dark:border-gray-700">
        <div class="flex items-start space-x-3 mb-3">
            <svg class="w-6 h-6 text-[#dc2d3d] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <div class="flex-1">
                <h4 class="font-bold text-gray-900 dark:text-white mb-3 text-base">
                    Didn't Receive the Email?
                </h4>
                <ul class="space-y-2 text-sm text-gray-600 dark:text-gray-400">
                    <li class="flex items-start">
                        <svg class="w-4 h-4 text-[#dc2d3d] mr-2 mt-0.5 flex-shrink-0" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                        <span>Check your spam or junk folder</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-4 h-4 text-[#dc2d3d] mr-2 mt-0.5 flex-shrink-0" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                        <span>Make sure you entered the correct email address</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-4 h-4 text-[#dc2d3d] mr-2 mt-0.5 flex-shrink-0" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                        <span>Wait a few minutes - emails can take time to arrive</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-4 h-4 text-[#dc2d3d] mr-2 mt-0.5 flex-shrink-0" fill="currentColor"
                            viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                        <span>Click the "Resend Verification Email" button afor a new link</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Logout Option -->
    <div class="text-center border-t border-gray-200 dark:border-gray-700 pt-6 mb-4">
        <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">
            Wrong email address or need to make changes?
        </p>
        <form method="POST" action="{{ route('logout') }}" class="inline">
            @csrf
            <button type="submit"
                class="inline-flex items-center text-sm text-gray-600 dark:text-gray-400 hover:text-[#dc2d3d] dark:hover:text-[#dc2d3d] transition-colors font-medium">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                Log out and try again
            </button>
        </form>
    </div>

    <!-- Help Text -->
    <div class="text-center">
        <p class="text-xs text-gray-500 dark:text-gray-400">
            Need assistance?
            <a href="mailto:support@ksf.it.com"
                class="text-[#dc2d3d] hover:text-[#b82532] transition-colors font-semibold hover:underline">
                Contact Support
            </a>
        </p>
    </div>

    <!-- Custom Animation Styles -->
    <style>
        @keyframes bounce-slow {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .animate-bounce-slow {
            animation: bounce-slow 3s ease-in-out infinite;
        }

        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.5s ease-out;
        }
    </style>
</x-guest-layout>