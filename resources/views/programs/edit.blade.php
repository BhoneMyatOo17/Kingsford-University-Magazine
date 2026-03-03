<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Program - Kingsford University</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 dark:bg-[#18181b]">
  @include('components.sidebar_navigation')
  @include('components.top_navigation', ['title' => 'Edit Program'])

  <div class="lg:ml-64">
    <main class="p-4 lg:p-8">

      <div class="mb-6">
        <a href="{{ route('programs.index') }}"
          class="inline-flex items-center text-sm text-gray-500 dark:text-gray-400 hover:text-[#dc2d3d] transition-colors">
          <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
          </svg>
          Back to Programs
        </a>
      </div>

      <div class="max-w-2xl">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 lg:p-8">
          <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6">Edit Program</h2>

          <form action="{{ route('programs.update', $program) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
              <label for="faculty_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Faculty
                <span class="text-red-500">*</span></label>
              <select id="faculty_id" name="faculty_id" required
                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#dc2d3d]"
                style="appearance:none;">
                <option value="">Select faculty</option>
                @foreach($faculties as $faculty)
                  <option value="{{ $faculty->id }}" {{ old('faculty_id', $program->faculty_id) == $faculty->id ? 'selected' : '' }}>{{ $faculty->name }}</option>
                @endforeach
              </select>
              @error('faculty_id')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
            </div>

            <div>
              <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Program Name
                <span class="text-red-500">*</span></label>
              <input type="text" id="name" name="name" value="{{ old('name', $program->name) }}"
                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#dc2d3d] @error('name') border-red-500 @enderror">
              @error('name')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
            </div>

            <div>
              <label for="description"
                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description</label>
              <textarea id="description" name="description" rows="3"
                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#dc2d3d]">{{ old('description', $program->description) }}</textarea>
              @error('description')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
            </div>

            <div>
              <label for="level" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Level <span
                  class="text-red-500">*</span></label>
              <select id="level" name="level" required
                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#dc2d3d]"
                style="appearance:none;">
                <option value="">Select level</option>
                <option value="undergraduate" {{ old('level', $program->level) === 'undergraduate' ? 'selected' : '' }}>
                  Undergraduate</option>
                <option value="postgraduate" {{ old('level', $program->level) === 'postgraduate' ? 'selected' : '' }}>
                  Postgraduate</option>
                <option value="doctorate" {{ old('level', $program->level) === 'doctorate' ? 'selected' : '' }}>Doctorate
                </option>
              </select>
              @error('level')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
              <div>
                <label for="duration_years"
                  class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Duration (Years) <span
                    class="text-red-500">*</span></label>
                <input type="number" id="duration_years" name="duration_years"
                  value="{{ old('duration_years', $program->duration_years) }}" min="1" max="10"
                  class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#dc2d3d]">
                @error('duration_years')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
              </div>
              <div>
                <label for="duration_mode" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Mode
                  <span class="text-red-500">*</span></label>
                <select id="duration_mode" name="duration_mode"
                  class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#dc2d3d]"
                  style="appearance:none;">
                  <option value="Full-time" {{ old('duration_mode', $program->duration_mode) === 'Full-time' ? 'selected' : '' }}>Full-time</option>
                  <option value="Full-time / Part-time" {{ old('duration_mode', $program->duration_mode) === 'Full-time / Part-time' ? 'selected' : '' }}>Full-time / Part-time</option>
                </select>
              </div>
            </div>

            <div>
              <label for="fees_per_semester"
                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Fees per Semester (£) <span
                  class="text-red-500">*</span></label>
              <input type="number" id="fees_per_semester" name="fees_per_semester"
                value="{{ old('fees_per_semester', $program->fees_per_semester) }}" step="0.01" min="0"
                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#dc2d3d]">
              @error('fees_per_semester')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
            </div>

            <div class="flex items-center space-x-3">
              <input type="hidden" name="is_active" value="0">
              <input type="checkbox" id="is_active" name="is_active" value="1"
                class="w-4 h-4 text-[#dc2d3d] border-gray-300 rounded focus:ring-[#dc2d3d]" {{ old('is_active', $program->is_active) ? 'checked' : '' }}>
              <label for="is_active" class="text-sm font-medium text-gray-700 dark:text-gray-300">Active</label>
            </div>

            <div class="flex items-center space-x-4 pt-2">
              <button type="submit"
                class="px-6 py-2.5 bg-[#dc2d3d] text-white text-sm font-medium rounded-lg hover:bg-[#b82532] transition-colors">
                Update Program
              </button>
              <a href="{{ route('programs.show', $program) }}"
                class="px-6 py-2.5 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                Cancel
              </a>
            </div>
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