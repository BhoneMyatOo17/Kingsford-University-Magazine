<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Academic Years - Kingsford University</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 dark:bg-[#18181b]">
  @include('components.sidebar_navigation')
  @include('components.top_navigation', ['title' => 'Academic Years'])

  <div class="lg:ml-64">
    <main class="p-4 lg:p-8">

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

      @if(session('error'))
        <div
          class="mb-6 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-800 dark:text-red-200 px-4 py-3 rounded-lg flex items-center">
          <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd"
              d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
              clip-rule="evenodd" />
          </svg>
          <span>{{ session('error') }}</span>
        </div>
      @endif

      <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
          <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Academic Years</h2>
          <p class="text-gray-600 dark:text-gray-400 mt-1">Manage academic year cycles and their submission deadlines
          </p>
        </div>
        <a href="{{ route('academic-years.create') }}"
          class="inline-flex items-center justify-center px-6 py-3 bg-[#dc2d3d] text-white font-semibold rounded-lg hover:bg-[#b82532] transition-all duration-300 shadow-lg hover:shadow-xl">
          <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
          </svg>
          New Academic Year
        </a>
      </div>

      <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">

        {{-- Desktop table --}}
        <div class="hidden md:block overflow-x-auto">
          <table class="w-full">
            <thead class="bg-gray-50 dark:bg-gray-700">
              <tr>
                <th
                  class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                  Name</th>
                <th
                  class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                  Year</th>
                <th
                  class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                  Submission Closure</th>
                <th
                  class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                  Final Closure</th>
                <th
                  class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                  Status</th>
                <th
                  class="px-6 py-4 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                  Actions</th>
              </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
              @forelse($academicYears as $ay)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                  <td class="px-6 py-4">
                    <div class="flex items-center gap-2">
                      <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ $ay->name }}</span>
                      @if($ay->is_active)
                        <span
                          class="px-2 py-0.5 bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400 text-xs font-semibold rounded-full">Active</span>
                      @endif
                    </div>
                    @if($ay->description)
                      <p class="text-xs text-gray-400 mt-0.5 truncate max-w-xs">{{ $ay->description }}</p>
                    @endif
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-400">{{ $ay->year }}</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-400">
                    {{ $ay->closure_date->format('d M Y') }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-400">
                    {{ $ay->final_closure_date->format('d M Y') }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    @if($ay->is_active)
                      <span
                        class="px-3 py-1 inline-flex text-xs font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">Active</span>
                    @else
                      <span
                        class="px-3 py-1 inline-flex text-xs font-semibold rounded-full bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-400">Inactive</span>
                    @endif
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-right">
                    <div class="flex items-center justify-end gap-3">
                      <a href="{{ route('academic-years.show', $ay) }}"
                        class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 text-sm font-medium">View</a>
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="6" class="px-6 py-12 text-center">
                    <svg class="w-16 h-16 text-gray-400 dark:text-gray-600 mb-4 mx-auto" fill="none" stroke="currentColor"
                      viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <p class="text-gray-500 dark:text-gray-400 text-lg font-medium">No academic years yet</p>
                    <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">Create the first one to get started</p>
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        {{-- Mobile card list --}}
        <div class="md:hidden divide-y divide-gray-200 dark:divide-gray-700">
          @forelse($academicYears as $ay)
            <div class="p-4">
              {{-- Row 1: name + status badge + actions --}}
              <div class="flex items-start justify-between gap-3 mb-2">
                <div class="min-w-0">
                  <div class="flex items-center gap-2 flex-wrap">
                    <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $ay->name }}</p>
                    @if($ay->is_active)
                      <span
                        class="px-2 py-0.5 bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400 text-xs font-semibold rounded-full">Active</span>
                    @else
                      <span
                        class="px-2 py-0.5 bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-400 text-xs font-semibold rounded-full">Inactive</span>
                    @endif
                  </div>
                  @if($ay->description)
                    <p class="text-xs text-gray-400 mt-0.5 truncate">{{ $ay->description }}</p>
                  @endif
                </div>
                <div class="flex items-center gap-3 shrink-0">
                  <a href="{{ route('academic-years.show', $ay) }}"
                    class="text-sm text-indigo-600 dark:text-indigo-400 font-medium">View</a>
                  <a href="{{ route('academic-years.edit', $ay) }}"
                    class="text-sm text-yellow-600 dark:text-yellow-400 font-medium">Edit</a>
                  @if(!$ay->is_active)
                    <form action="{{ route('academic-years.destroy', $ay) }}" method="POST"
                      onsubmit="return confirm('Delete {{ $ay->name }}? This cannot be undone.')">
                      @csrf @method('DELETE')
                      <button class="text-sm text-red-600 dark:text-red-400 font-medium">Delete</button>
                    </form>
                  @endif
                </div>
              </div>

              {{-- Row 2: year · submission closure · final closure --}}
              <div class="flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400 flex-wrap">
                <span>{{ $ay->year }}</span>
                <span>·</span>
                <span>Sub: {{ $ay->closure_date->format('d M Y') }}</span>
                <span>·</span>
                <span>Final: {{ $ay->final_closure_date->format('d M Y') }}</span>
              </div>
            </div>
          @empty
            <div class="p-8 text-center">
              <svg class="w-12 h-12 text-gray-400 dark:text-gray-600 mb-3 mx-auto" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
              </svg>
              <p class="text-gray-500 dark:text-gray-400 font-medium">No academic years yet</p>
              <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">Create the first one to get started</p>
            </div>
          @endforelse
        </div>

      </div>

      <div class="mt-4">{{ $academicYears->links() }}</div>

    </main>
  </div>

  @include('components.dashboard_scripts')
</body>

</html>