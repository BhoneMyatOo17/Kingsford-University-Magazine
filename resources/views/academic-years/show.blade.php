<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $academicYear->name }} - Kingsford University</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 dark:bg-[#18181b]">
  @include('components.sidebar_navigation')
  @include('components.top_navigation', ['title' => 'Academic Year Details'])

  <div class="lg:ml-64">
    <main class="p-4 lg:p-8">

      <div class="mb-6 flex items-center justify-between">
        <a href="{{ route('academic-years.index') }}"
          class="inline-flex items-center text-sm text-gray-600 dark:text-gray-400 hover:text-[#dc2d3d] transition-colors">
          <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
          </svg>
          Back to Academic Years
        </a>
        <a href="{{ route('academic-years.edit', $academicYear) }}"
          class="inline-flex items-center px-4 py-2 bg-yellow-500 hover:text-white dark:text-white dark:hover:text-slate-200 text-white text-sm font-medium rounded-lg hover:bg-yellow-600 transition-colors">
          <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
          </svg>
          Edit
        </a>
      </div>

      @if(session('success'))
        <div
          class="mb-6 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-200 px-4 py-3 rounded-lg flex items-center">
          <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd"
              d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
              clip-rule="evenodd" />
          </svg>
          <span>{{ session('success') }}</span>
        </div>
      @endif

      {{-- Header --}}
      <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mb-6">
        <div class="flex items-start justify-between mb-4">
          <div>
            <div class="flex items-center gap-3 mb-1">
              <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $academicYear->name }}</h2>
              @if($academicYear->is_active)
                <span
                  class="px-3 py-1 bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400 text-xs font-semibold rounded-full">Active</span>
              @else
                <span
                  class="px-3 py-1 bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-400 text-xs font-semibold rounded-full">Inactive</span>
              @endif
            </div>
            @if($academicYear->description)
              <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ $academicYear->description }}</p>
            @endif
          </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
          <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-4">
            <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Year</p>
            <p class="text-lg font-bold text-gray-900 dark:text-white">{{ $academicYear->year }}</p>
          </div>
          <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-4">
            <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Submission Closure</p>
            <p class="text-sm font-semibold text-gray-900 dark:text-white">
              {{ $academicYear->closure_date->format('d M Y') }}
            </p>
            <p class="text-xs text-gray-400 mt-0.5">New submissions deadline</p>
          </div>
          <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-4">
            <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Final Closure</p>
            <p class="text-sm font-semibold text-gray-900 dark:text-white">
              {{ $academicYear->final_closure_date->format('d M Y') }}
            </p>
            <p class="text-xs text-gray-400 mt-0.5">Edit deadline for students</p>
          </div>
        </div>
      </div>

      {{-- Posts under this academic year --}}
      <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
          <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300">Posts in this Academic Year</h3>
          <span class="text-xs text-gray-400">{{ $academicYear->posts->count() }} post(s)</span>
        </div>
        <div class="overflow-x-auto">
          <table class="w-full">
            <thead class="bg-gray-50 dark:bg-gray-700">
              <tr>
                <th
                  class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                  Title</th>
                <th
                  class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                  Faculty</th>
                <th
                  class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                  Closure Date</th>
                <th
                  class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                  Contributions</th>
                <th
                  class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                  Actions</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
              @forelse($academicYear->posts as $post)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                  <td class="px-6 py-4 text-sm font-medium text-gray-900 dark:text-white">{{ $post->title }}</td>
                  <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">{{ $post->faculty->name }}</td>
                  <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">
                    {{ $post->closure_date->format('d M Y') }}
                  </td>
                  <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">{{ $post->contributions_count }}</td>
                  <td class="px-6 py-4 text-right">
                    <a href="{{ route('posts.show', $post) }}"
                      class="text-[#dc2d3d] hover:text-[#b82532] text-sm font-medium transition-colors">View</a>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="5" class="px-6 py-8 text-center text-sm text-gray-400 dark:text-gray-500">
                    No posts created for this academic year yet.
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>

    </main>
  </div>

  @include('components.dashboard_scripts')
</body>

</html>