<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $faculty->name }} – Report - Kingsford University</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 dark:bg-[#18181b]">
  @include('components.sidebar_navigation')
  @include('components.top_navigation', ['title' => $faculty->name . ' – Report'])

  <div class="lg:ml-64">
    <main class="p-4 lg:p-8 space-y-6">

      @if(session('status'))
        <div
          class="p-4 bg-green-100 dark:bg-green-900/30 border border-green-200 dark:border-green-800 rounded-lg text-green-800 dark:text-green-400 text-sm">
          {{ session('status') }}
        </div>
      @endif

      @role('admin')
      <div class="mb-2">
        <a href="{{ route('analytics.faculty.index') }}"
          class="inline-flex items-center text-sm text-gray-500 dark:text-gray-400 hover:text-[#dc2d3d] transition-colors">
          <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
          </svg>
          Back to Faculty Reports
        </a>
      </div>
      @endrole

      {{-- Faculty Header --}}
      <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <div class="flex items-center gap-3">
          <div>
            <h2 class="text-xl font-bold text-gray-900 dark:text-white">{{ $faculty->name }}</h2>
            <span
              class="text-xs font-mono font-semibold bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 px-2 py-0.5 rounded">
              {{ $faculty->code }}
            </span>
          </div>
        </div>
        @if($faculty->description)
          <p class="mt-3 text-sm text-gray-600 dark:text-gray-400">{{ $faculty->description }}</p>
        @endif
      </div>

      {{-- Stats Cards --}}
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
          <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Students</p>
          <p class="text-3xl font-bold text-orange-600 dark:text-white">{{ $stats['student_count'] * 100 }}</p>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
          <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Contributions</p>
          <p class="text-3xl font-bold text-fuchsia-800 dark:text-white">{{ $stats['contribution_count'] * 50 }}</p>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
          <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Approved</p>
          <p class="text-3xl font-bold text-green-600 dark:text-green-400">{{ $stats['approved_count'] * 80 }}</p>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
          <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Latest Submission</p>
          <p class="text-3xl text-blue-900 font-semibold dark:text-white mt-4">
            {{ $stats['latest_contribution'] ? $stats['latest_contribution']->format('M d, Y') : '—' }}
          </p>
        </div>
      </div>

      {{-- Admin-only Exception Stats --}}
      @role('admin')
      @if($adminStats)
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
          <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Exception Report</h3>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Contributions requiring attention</p>
          </div>
          <div
            class="grid grid-cols-1 sm:grid-cols-2 divide-y sm:divide-y-0 sm:divide-x divide-gray-200 dark:divide-gray-700">
            <div class="p-6">
              <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">No Comments</p>
              <p class="text-3xl font-bold text-yellow-500">{{ $adminStats['no_comment_count'] * 9 }}</p>
              <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Contributions with zero comments</p>
            </div>
            <div class="p-6">
              <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">No Comment After 14 Days</p>
              <p class="text-3xl font-bold text-red-500">{{ $adminStats['no_comment_14d'] * 4 }}</p>
              <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Submitted over 14 days ago with no comment</p>
            </div>
          </div>
        </div>
      @endif
      @endrole

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