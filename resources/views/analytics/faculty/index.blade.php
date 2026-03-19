<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Faculty Reports - Kingsford University</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 dark:bg-[#18181b]">
  @include('components.sidebar_navigation')
  @include('components.top_navigation', ['title' => 'Faculty Reports'])

  <div class="lg:ml-64">
    <main class="p-4 lg:p-8">

      <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Faculty Reports</h2>
        <p class="text-gray-600 dark:text-gray-400 text-sm mt-1">Select a faculty to view its detailed report.</p>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse($faculties as $faculty)
          <a href="{{ route('analytics.faculty.show', $faculty) }}"
            class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 hover:shadow-md hover:border-[#dc2d3d] border border-transparent transition-all">
            <div class="flex items-start justify-between mb-3">
              <h3 class="text-sm font-semibold text-gray-900 dark:text-white leading-snug">{{ $faculty->name }}</h3>
              <span
                class="ml-2 px-2 py-0.5 text-xs font-mono font-semibold bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 rounded flex-shrink-0">
                {{ $faculty->code }}
              </span>
            </div>
            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $faculty->students_count }} students enrolled</p>
            <div class="mt-4 flex items-center text-xs text-[#dc2d3d] font-medium">
              View Report
              <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
              </svg>
            </div>
          </a>
        @empty
          <p class="text-gray-500 dark:text-gray-400 col-span-3">No active faculties found.</p>
        @endforelse
      </div>

    </main>

    <footer class="bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 mt-12">
      <div class="px-4 lg:px-8 py-6">
        <p class="text-sm text-gray-600 dark:text-gray-400">© 2026 Kingsford University. All rights reserved.</p>
      </div>
    </footer>
  </div>

  @include('components.dashboard_scripts')
</body>

</html>