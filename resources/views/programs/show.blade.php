<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $program->name }} - Kingsford University</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 dark:bg-[#18181b]">
  @include('components.sidebar_navigation')
  @include('components.top_navigation', ['title' => $program->name])

  <div class="lg:ml-64">
    <main class="p-4 lg:p-8">

      <div class="mb-6 flex items-center justify-between">
        <a href="{{ route('programs.index') }}"
          class="inline-flex items-center text-sm text-gray-500 dark:text-gray-400 hover:text-[#dc2d3d] transition-colors">
          <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
          </svg>
          Back to Programs
        </a>
        <a href="{{ route('programs.edit', $program) }}"
          class="inline-flex items-center px-4 py-2 bg-[#dc2d3d] hover:text-white text-white text-sm font-medium rounded-lg hover:bg-[#b82532] transition-colors">
          <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
          </svg>
          Edit Program
        </a>
      </div>

      <div class="max-w-2xl space-y-6">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 lg:p-8">
          <div class="flex items-start justify-between mb-6">
            <div>
              <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $program->name }}</h2>
              <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ $program->faculty->name }}</p>
            </div>
            @php
              $levelColors = [
                'undergraduate' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400',
                'postgraduate' => 'bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-400',
                'doctorate' => 'bg-orange-100 text-orange-800 dark:bg-orange-900/30 dark:text-orange-400',
              ];
            @endphp
            <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $levelColors[$program->level] ?? '' }}">
              {{ $program->level_label }}
            </span>
          </div>

          <div class="space-y-4">
            <div>
              <p class="text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider mb-1">
                Description</p>
              <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed">
                {{ $program->description ?? 'No description provided.' }}
              </p>
            </div>

            <div class="border-t border-gray-100 dark:border-gray-700 pt-4 grid grid-cols-2 gap-4">
              <div>
                <p class="text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider mb-1">Duration
                </p>
                <p class="text-sm text-gray-700 dark:text-gray-300">{{ $program->duration_string }}</p>
              </div>
              <div>
                <p class="text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider mb-1">Fees /
                  Semester</p>
                <p class="text-sm text-gray-700 dark:text-gray-300">£{{ number_format($program->fees_per_semester, 0) }}
                </p>
              </div>
              <div>
                <p class="text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider mb-1">Status
                </p>
                @if($program->is_active)
                  <span
                    class="px-2 py-1 inline-flex text-xs font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">Active</span>
                @else
                  <span
                    class="px-2 py-1 inline-flex text-xs font-semibold rounded-full bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-400">Inactive</span>
                @endif
              </div>
              <div>
                <p class="text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider mb-1">Last
                  Updated</p>
                <p class="text-sm text-gray-700 dark:text-gray-300">{{ $program->updated_at->format('M d, Y') }}</p>
              </div>
            </div>
          </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
          <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-4">Danger Zone</h3>
          <form action="{{ route('programs.destroy', $program) }}" method="POST"
            onsubmit="return confirm('Delete this program?')">
            @csrf
            @method('DELETE')
            <button type="submit"
              class="px-4 py-2 bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 text-sm font-medium rounded-lg border border-red-200 dark:border-red-800 hover:bg-red-100 dark:hover:bg-red-900/30 transition-colors">
              Delete Program
            </button>
          </form>
        </div>
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