<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Our Faculties - Kingsford University</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
  @include('components.navigation')

  <!-- Search Bar -->
  <div class="container mx-auto px-4 max-w-4xl pt-32 pb-8">
    {{ Breadcrumbs::render('faculties.index') }}
    <div class="flex flex-col sm:flex-row gap-3">
      <div class="relative flex-1">
        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
          viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0" />
        </svg>
        <input id="search" type="text" placeholder="Search programs or faculties..."
          class="w-full pl-9 pr-4 py-2.5 text-sm border border-gray-200 dark:border-gray-700 rounded-lg bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#dc2d3d]">
      </div>
      <div class="relative">
        <select id="filter-level"
          class="pl-3 pr-8 py-2.5 text-sm border border-gray-200 dark:border-gray-700 rounded-lg bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#dc2d3d] appearance-none cursor-pointer">
          <option value="">All Levels</option>
          <option value="undergraduate">Undergraduate</option>
          <option value="postgraduate">Postgraduate</option>
          <option value="doctorate">Doctorate</option>
        </select>
        <svg class="absolute right-2 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400 pointer-events-none" fill="none"
          stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
      </div>
    </div>
  </div>

  <!-- Faculties & Programs List -->
  <div class="container mx-auto px-4 max-w-4xl pb-16">

    <div id="no-results" class="hidden text-center py-16">
      <p class="text-gray-500 dark:text-gray-400 font-medium">No programs found matching your search.</p>
      <button onclick="clearFilters()" class="mt-3 text-sm text-[#dc2d3d] hover:text-[#b82532] font-semibold">Clear
        filters</button>
    </div>

    <div class="space-y-6">
      @forelse($faculties as $faculty)
        <div class="faculty-block" id="faculty-{{ $faculty->id }}" data-faculty-name="{{ strtolower($faculty->name) }}">

          <details
            class="group border border-gray-200 dark:border-gray-800 rounded-xl bg-gray-50 dark:bg-gray-900 overflow-hidden shadow-sm">
            <summary
              class="flex justify-between items-center p-6 cursor-pointer transition-colors hover:bg-red-50 dark:hover:bg-gray-800 group-open:bg-red-50 dark:group-open:bg-gray-800">
              <div>
                <h3 class="font-bold text-xl group-open:text-[#dc2d3d]">{{ $faculty->name }}</h3>
                @if($faculty->description)
                  <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">{{ $faculty->description }}</p>
                @endif
              </div>
              <svg class="chevron w-6 h-6 text-gray-400 transition-transform flex-shrink-0 ml-4" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
              </svg>
            </summary>

            <div class="p-6 pt-4 grid grid-cols-1 md:grid-cols-2 gap-6 border-t border-gray-100 dark:border-gray-800">
              @forelse($faculty->activePrograms as $program)
                <a href="{{ route('programs.public.show', $program) }}"
                  class="program-card block p-4 rounded-lg bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 hover:border-[#dc2d3d] hover:shadow-md transition-all group/card"
                  data-program-name="{{ strtolower($program->name) }}"
                  data-program-desc="{{ strtolower($program->description) }}" data-level="{{ $program->level }}">

                  <h4 class="font-bold text-[#dc2d3d] mb-1 group-hover/card:underline">{{ $program->name }}</h4>
                  @if($program->description)
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-3">{{ $program->description }}</p>
                  @endif
                  <p class="text-sm font-semibold text-gray-600 dark:text-gray-400 mb-1">Duration:
                    {{ $program->duration_string }}
                  </p>
                  <p class="text-xs font-bold text-gray-600 dark:text-gray-400 uppercase tracking-wider">Tuition Fees:
                    £{{ number_format($program->fees_per_semester, 0) }} / Semester</p>
                </a>
              @empty
                <p class="col-span-2 text-sm text-gray-400 py-4 text-center">No programs available.</p>
              @endforelse
            </div>
          </details>
        </div>
      @empty
        <p class="text-center text-gray-500 dark:text-gray-400 py-16">No faculties are currently available.</p>
      @endforelse
    </div>
  </div>

  @include('components.footer')

  <script>
    const searchInput = document.getElementById('search');
    const levelFilter = document.getElementById('filter-level');
    const noResults = document.getElementById('no-results');
    const facultyBlocks = document.querySelectorAll('.faculty-block');

    function applyFilters() {
      const query = searchInput.value.toLowerCase().trim();
      const level = levelFilter.value;
      let totalVisible = 0;

      facultyBlocks.forEach(block => {
        const facultyName = block.dataset.facultyName;
        const cards = block.querySelectorAll('.program-card');
        let visible = 0;

        cards.forEach(card => {
          const match = (card.dataset.programName.includes(query) || facultyName.includes(query) || card.dataset.programDesc.includes(query))
            && (!level || card.dataset.level === level);
          card.style.display = match ? '' : 'none';
          if (match) visible++;
        });

        block.style.display = visible > 0 ? '' : 'none';
        const details = block.querySelector('details');
        if ((query || level) && visible > 0) details.setAttribute('open', '');
        else if (!query && !level) details.removeAttribute('open');
        totalVisible += visible;
      });

      noResults.classList.toggle('hidden', totalVisible > 0);
    }

    function clearFilters() {
      searchInput.value = '';
      levelFilter.value = '';
      applyFilters();
    }

    searchInput.addEventListener('input', applyFilters);
    levelFilter.addEventListener('change', applyFilters);
  </script>
</body>

</html>