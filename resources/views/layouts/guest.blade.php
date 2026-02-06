<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Kingsford University' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 dark:bg-[#18181b]">
    @include('components.navigation')

    <section class="min-h-screen flex items-center justify-center py-24 mt-8 px-4">
        <div class="max-w-xl w-full">
            <!-- Title -->
            <div class="text-center mb-8">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-2">
                    {{ $heading ?? 'Welcome Back' }}
                </h1>
                <p class="text-gray-600 dark:text-gray-300">
                    {{ $subheading ?? 'Login to access your account' }}
                </p>
            </div>

            <!-- Content Card -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl px-8 py-6">
                {{ $slot }}
            </div>

            <!-- Additional Links -->
            @isset($additionalLinks)
                <div class="mt-6 text-center">
                    {{ $additionalLinks }}
                </div>
            @endisset

            <!-- Back to Home -->
            <div class="mt-6 text-center">
                <a href="{{ url('/') }}"
                    class="inline-flex items-center text-sm text-gray-600 dark:text-gray-300 hover:text-[#dc2d3d] dark:hover:text-[#dc2d3d] transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Home
                </a>
            </div>
        </div>
    </section>

    @include('components.footer')
</body>

</html>