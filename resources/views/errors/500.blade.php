<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>500 - Internal Server Error | Kingsford University</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap"
    rel="stylesheet">

  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      darkMode: 'class',
      theme: {
        extend: {
          colors: {
            brandRed: '#dc2d3d',
            darkRed: '#b82532',
            lighterRed: '#ff4757',
            lightPink: '#fef2f2',
            lGray50: '#f9fafb',
            lGray100: '#f3f4f6',
            lGray200: '#e5e7eb',
            lGray300: '#d1d5db',
            lGray400: '#9ca3af',
            lGray500: '#6b7280',
            lGray600: '#4b5563',
            lGray700: '#374151',
            lGray800: '#1f2937',
            lGray900: '#111827',
            darkBg: '#18181b',
            darkCard: '#1f1f23',
            dGray700: '#374151',
            dGray800: '#1f2937',
          }
        }
      }
    }
  </script>
  <script>
    if (localStorage.getItem('color-theme') === 'dark' ||
      (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
      document.documentElement.classList.add('dark');
    } else {
      document.documentElement.classList.remove('dark');
    }
  </script>
</head>

<body
  class="bg-lGray50 dark:bg-darkBg text-lGray800 dark:text-white transition-colors duration-300 min-h-screen flex flex-col">
  <style>
    body {
      font-family: "DM Sans", sans-serif;
    }
  </style>

  <div class="flex-grow flex items-center justify-center px-6">
    <div class="max-w-4xl w-full text-center">
      <div class="mb-4 md:mb-8 relative">
        <h1 class="text-8xl md:text-[12rem] font-extrabold text-brandRed opacity-20 dark:opacity-20 select-none">
          500
        </h1>
        <div class="absolute inset-0 flex items-center justify-center">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="w-16 h-16 md:w-24 md:h-24 text-brandRed">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
          </svg>
        </div>
      </div>

      <h2 class="text-2xl md:text-3xl font-bold text-lGray800 dark:text-white mb-4">
        Internal Server Error
      </h2>
      <p class="text-sm md:text-base text-lGray600 dark:text-lGray400 mb-10 leading-relaxed mx-auto">
        Something went wrong on our end. We are working to fix the issue. Please try refreshing the page or come back
        later.
      </p>

      <div class="flex flex-col items-center gap-4">
        <a href="{{ route('home') }}"
          class="group flex items-center gap-4 text-lGray800 dark:text-white hover:text-brandRed dark:hover:text-lighterRed transition-all duration-300">
          <svg class="w-8 h-5 md:w-10 md:h-6 transform group-hover:-translate-x-2 transition-transform duration-300"
            fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 12H5m0 0l7-7m-7 7l7 7">
            </path>
          </svg>
          <span class="text-xs font-bold tracking-[0.3em] uppercase">Back to Home</span>
        </a>
        <a href="{{ route('contact.create') }}"
          class="flex items-center gap-3 px-6 py-3 rounded-md text-white text-xs font-bold tracking-[0.3em] uppercase transition-all duration-300 hover:opacity-90"
          style="background-color: #dc2d3d;">
          <svg class="w-5 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
              d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
            </path>
          </svg>
          Contact Us
        </a>
      </div>
    </div>
  </div>
</body>

</html>