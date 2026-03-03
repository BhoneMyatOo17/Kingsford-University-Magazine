<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Faculty - Kingsford University</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 dark:bg-[#18181b]">
  @include('components.sidebar_navigation')
  @include('components.top_navigation', ['title' => 'Edit Faculty'])

  <div class="lg:ml-64">
    <main class="p-4 lg:p-8">

      <div class="mb-6">
        <a href="{{ route('faculty.index') }}"
          class="inline-flex items-center text-sm text-gray-500 dark:text-gray-400 hover:text-[#dc2d3d] transition-colors">
          <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
          </svg>
          Back to Faculties
        </a>
      </div>

      <div class="max-w-2xl">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 lg:p-8">
          <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6">Edit Faculty</h2>

          <form action="{{ route('faculty.update', $faculty) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
              <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Faculty Name
                <span class="text-red-500">*</span></label>
              <input type="text" id="name" name="name" value="{{ old('name', $faculty->name) }}"
                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#dc2d3d] focus:border-transparent @error('name') border-red-500 @enderror">
              @error('name')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
              @enderror
            </div>

            <div>
              <label for="code" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Faculty Code
                <span class="text-red-500">*</span></label>
              <input type="text" id="code" name="code" value="{{ old('code', $faculty->code) }}" maxlength="10"
                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#dc2d3d] focus:border-transparent @error('code') border-red-500 @enderror">
              <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Max 10 characters. Used as a short identifier.
              </p>
              @error('code')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
              @enderror
            </div>

            <div>
              <label for="description"
                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description</label>
              <textarea id="description" name="description" rows="4"
                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#dc2d3d] focus:border-transparent @error('description') border-red-500 @enderror">{{ old('description', $faculty->description) }}</textarea>
              @error('description')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
              @enderror
            </div>

            <div class="flex items-center space-x-3">
              <input type="hidden" name="is_active" value="0">
              <input type="checkbox" id="is_active" name="is_active" value="1"
                class="w-4 h-4 text-[#dc2d3d] border-gray-300 rounded focus:ring-[#dc2d3d]" {{ old('is_active', $faculty->is_active) ? 'checked' : '' }}>
              <label for="is_active" class="text-sm font-medium text-gray-700 dark:text-gray-300">Active</label>
            </div>

            <div class="flex items-center space-x-4 pt-2">
              <button type="submit"
                class="px-6 py-2.5 bg-[#dc2d3d] text-white text-sm font-medium rounded-lg hover:bg-[#b82532] transition-colors">
                Update Faculty
              </button>
              <a href="{{ route('faculty.show', $faculty) }}"
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