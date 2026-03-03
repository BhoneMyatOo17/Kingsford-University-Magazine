<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Program Management - Kingsford University</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 dark:bg-[#18181b]">
  @include('components.sidebar_navigation')
  @include('components.top_navigation', ['title' => 'Program Management'])

  <div class="lg:ml-64">
    <main class="p-4 lg:p-8">

      @if(session('success'))
        <div
          class="mb-6 p-4 bg-green-100 dark:bg-green-900/30 border border-green-200 dark:border-green-800 rounded-lg text-green-800 dark:text-green-400 text-sm">
          {{ session('success') }}
        </div>
      @endif

      <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
        <div>
          <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Programs</h2>
          <p class="text-gray-600 dark:text-gray-400 text-sm mt-1">Manage all university programs.</p>
        </div>
        <a href="{{ route('programs.create') }}"
          class="inline-flex items-center px-4 py-2 bg-[#dc2d3d] hover:text-white text-white text-sm font-medium rounded-lg hover:bg-[#b82532] transition-colors dark:text-white dark:hover:text-slate-200">
          <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
          </svg>
          Add Program
        </a>
      </div>

      <!-- Filters -->
      <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-4 mb-6 flex flex-wrap gap-4">
        <div class="flex-1 min-w-48">
          <input type="text" id="search" placeholder="Search programs..."
            class="w-full px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#dc2d3d]">
        </div>
        <select id="filter-faculty"
          class="px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#dc2d3d]">
          <option value="">All Faculties</option>
          @foreach($faculties as $faculty)
            <option value="{{ $faculty->id }}">{{ $faculty->name }}</option>
          @endforeach
        </select>
        <select id="filter-level"
          class="px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#dc2d3d]">
          <option value="">All Levels</option>
          <option value="undergraduate">Undergraduate</option>
          <option value="postgraduate">Postgraduate</option>
          <option value="doctorate">Doctorate</option>
        </select>
      </div>

      <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
          <table class="w-full" id="programs-table">
            <thead class="bg-gray-50 dark:bg-gray-700">
              <tr>
                <th
                  class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                  Program</th>
                <th
                  class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                  Faculty</th>
                <th
                  class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                  Level</th>
                <th
                  class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                  Fee/Semester</th>
                <th
                  class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                  Status</th>
                <th
                  class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                  Actions</th>
              </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
              @forelse($programs as $program)
                <tr
                  class="hover:bg-gray-50 dark:hover:bg-gray-700/50 program-row {{ $program->trashed() ? 'opacity-60' : '' }}"
                  data-name="{{ strtolower($program->name) }}" data-faculty="{{ $program->faculty_id }}"
                  data-level="{{ $program->level }}">
                  <td class="px-6 py-4">
                    <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $program->name }}</div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-600 dark:text-gray-400">{{ $program->faculty->code ?? '—' }}</div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    @php
                      $levelColors = [
                        'undergraduate' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400',
                        'postgraduate' => 'bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-400',
                        'doctorate' => 'bg-orange-100 text-orange-800 dark:bg-orange-900/30 dark:text-orange-400',
                      ];
                    @endphp
                    <span
                      class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $levelColors[$program->level] ?? '' }}">
                      {{ $program->level_label }}
                    </span>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-400">
                    £{{ number_format($program->fees_per_semester, 0) }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    @if($program->trashed())
                      <span
                        class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400">Deleted</span>
                    @elseif($program->is_active)
                      <span
                        class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">Active</span>
                    @else
                      <span
                        class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-400">Inactive</span>
                    @endif
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-3">
                    @if($program->trashed())
                      <button type="button" data-restore-url="{{ route('programs.restore', $program->id) }}"
                        data-restore-name="{{ $program->name }}"
                        class="text-green-600 hover:text-green-800 dark:text-green-400">
                        Restore
                      </button>
                    @else
                      <a href="{{ route('programs.show', $program) }}"
                        class="text-gray-500 hover:text-gray-700 dark:text-gray-400">View</a>
                    @endif
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="7" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">No programs found.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        @if($programs->hasPages())
          <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
            {{ $programs->links() }}
          </div>
        @endif
      </div>

    </main>

    <footer class="bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 mt-12">
      <div class="px-4 lg:px-8 py-6">
        <p class="text-sm text-gray-600 dark:text-gray-400">© 2026 Kingsford University. All rights reserved.</p>
      </div>
    </footer>
  </div>
  @include('components.restore-modal')
  @include('components.dashboard_scripts')

  <script>
    const search = document.getElementById('search');
    const filterFaculty = document.getElementById('filter-faculty');
    const filterLevel = document.getElementById('filter-level');
    const rows = document.querySelectorAll('.program-row');

    function applyFilters() {
      const q = search.value.toLowerCase();
      const faculty = filterFaculty.value;
      const level = filterLevel.value;

      rows.forEach(row => {
        const matchName = row.dataset.name.includes(q);
        const matchFaculty = !faculty || row.dataset.faculty === faculty;
        const matchLevel = !level || row.dataset.level === level;
        row.style.display = matchName && matchFaculty && matchLevel ? '' : 'none';
      });
    }

    search.addEventListener('input', applyFilters);
    filterFaculty.addEventListener('change', applyFilters);
    filterLevel.addEventListener('change', applyFilters);
  </script>

</body>

</html>