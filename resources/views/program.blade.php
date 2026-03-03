<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $program->name }} - Kingsford University</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
  @include('components.navigation')

  <div class="container mx-auto px-4 max-w-3xl pt-32 pb-16">
    <!-- Back link -->
    <a href="{{ route('faculties.index') }}#faculty-{{ $program->faculty_id }}"
      class="inline-flex items-center text-sm text-gray-500 dark:text-gray-400 hover:text-[#dc2d3d] transition-colors mb-8">
      <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
      </svg>
      Back to Faculties
    </a>

    {{ Breadcrumbs::render('programs.public.show', $program) }}


    <!-- Program Card -->
    <div
      class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 shadow-sm overflow-hidden">

      <!-- Header -->
      <div class="bg-gray-50 dark:bg-gray-800 px-8 py-6 border-b border-gray-200 dark:border-gray-700">
        <p class="text-sm font-semibold text-[#dc2d3d] uppercase tracking-wider mb-1">{{ $program->faculty->name }}</p>
        <h1 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white">{{ $program->name }}</h1>
      </div>

      <!-- Body -->
      <div class="px-8 py-8 space-y-8">

        @if($program->description)
          <div>
            <h2 class="text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider mb-2">About this
              Program</h2>
            <p class="text-gray-700 dark:text-gray-300 leading-relaxed">{{ $program->description }}</p>
          </div>
        @endif

        <!-- Key details grid -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
          <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-4">
            <p class="text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider mb-1">Level</p>
            <p class="text-gray-900 dark:text-white font-semibold">{{ $program->level_label }}</p>
          </div>
          <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-4">
            <p class="text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider mb-1">Duration</p>
            <p class="text-gray-900 dark:text-white font-semibold">{{ $program->duration_string }}</p>
          </div>
          <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-4">
            <p class="text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider mb-1">Tuition Fees
            </p>
            <p class="text-gray-900 dark:text-white font-semibold">£{{ number_format($program->fees_per_semester, 0) }}
              / Semester</p>
          </div>
        </div>

      </div>
    </div>

  </div>


  @include('components.footer')
</body>

</html>