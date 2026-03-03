<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Academic Year - Kingsford University</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 dark:bg-[#18181b]">
  @include('components.sidebar_navigation')
  @include('components.top_navigation', ['title' => 'Edit Academic Year'])

  <div class="lg:ml-64">
    <main class="p-4 lg:p-8">

      <div class="mb-6">
        <a href="{{ route('academic-years.show', $academicYear) }}"
          class="inline-flex items-center text-sm text-gray-600 dark:text-gray-400 hover:text-[#dc2d3d] transition-colors">
          <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
          </svg>
          Back to {{ $academicYear->name }}
        </a>
      </div>

      <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Edit Academic Year</h2>
        <p class="text-gray-600 dark:text-gray-400 mt-1">{{ $academicYear->name }}</p>
      </div>

      <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 max-w-2xl">

        @if($errors->any())
          <div
            class="mb-6 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-800 dark:text-red-200 px-4 py-3 rounded-lg">
            <ul class="list-disc list-inside text-sm space-y-1">
              @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
          </div>
        @endif

        <form action="{{ route('academic-years.update', $academicYear) }}" method="POST" class="space-y-5">
          @csrf @method('PUT')

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Name <span class="text-red-500">*</span>
              </label>
              <input type="text" name="name" value="{{ old('name', $academicYear->name) }}"
                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-[#dc2d3d] focus:border-transparent @error('name') border-red-500 @enderror">
              @error('name')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Year <span class="text-red-500">*</span>
              </label>
              <input type="number" name="year" value="{{ old('year', $academicYear->year) }}" min="2000" max="2100"
                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-[#dc2d3d] focus:border-transparent @error('year') border-red-500 @enderror">
              @error('year')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
            </div>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Submission Closure Date <span class="text-red-500">*</span>
              </label>
              <input type="date" name="closure_date"
                value="{{ old('closure_date', $academicYear->closure_date->format('Y-m-d')) }}"
                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-[#dc2d3d] focus:border-transparent @error('closure_date') border-red-500 @enderror">
              <p class="mt-1 text-xs text-gray-400">Deadline for new submissions</p>
              @error('closure_date')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Final Closure Date <span class="text-red-500">*</span>
              </label>
              <input type="date" name="final_closure_date"
                value="{{ old('final_closure_date', $academicYear->final_closure_date->format('Y-m-d')) }}"
                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-[#dc2d3d] focus:border-transparent @error('final_closure_date') border-red-500 @enderror">
              <p class="mt-1 text-xs text-gray-400">Deadline for edits (must be after submission closure)</p>
              @error('final_closure_date')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
            </div>
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description</label>
            <textarea name="description" rows="3"
              class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-[#dc2d3d] focus:border-transparent">{{ old('description', $academicYear->description) }}</textarea>
          </div>

          <div
            class="flex items-start gap-3 p-4 bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg">
            <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $academicYear->is_active) ? 'checked' : '' }}
              class="mt-0.5 w-4 h-4 rounded border-gray-300 text-[#dc2d3d] focus:ring-[#dc2d3d]">
            <div>
              <label for="is_active" class="text-sm font-medium text-gray-700 dark:text-gray-300 cursor-pointer">
                Set as Active Academic Year
              </label>
              <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">
                Only one academic year can be active at a time. Activating this will deactivate the current one.
              </p>
            </div>
          </div>

          <div class="flex gap-3 pt-2">
            <button type="submit"
              class="inline-flex items-center px-6 py-3 bg-[#dc2d3d] text-white font-semibold rounded-lg hover:bg-[#b82532] transition-colors shadow-lg hover:shadow-xl">
              Save Changes
            </button>
            <a href="{{ route('academic-years.show', $academicYear) }}"
              class="inline-flex items-center px-6 py-3 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 font-semibold rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
              Cancel
            </a>
          </div>
        </form>
      </div>

    </main>
  </div>

  @include('components.dashboard_scripts')
</body>

</html>