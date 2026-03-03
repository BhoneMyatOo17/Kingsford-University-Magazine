<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Post - Kingsford University</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 dark:bg-[#18181b]">
  @include('components.sidebar_navigation')
  @include('components.top_navigation', ['title' => 'Edit Post'])

  <div class="lg:ml-64">
    <main class="p-4 lg:p-8">

      <div class="mb-6">
        <a href="{{ route('posts.show', $post) }}" class="inline-flex items-center text-sm text-gray-600 dark:text-gray-400 hover:text-[#dc2d3d] transition-colors">
          <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
          </svg>
          Back to Post
        </a>
      </div>

      <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Edit Post</h2>
        <p class="text-gray-600 dark:text-gray-400 mt-1">{{ $post->title }}</p>
      </div>

      <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 max-w-3xl">
        <form action="{{ route('posts.update', $post) }}" method="POST" class="space-y-6">
          @csrf @method('PUT')

          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
              Title <span class="text-red-500">*</span>
            </label>
            <input type="text" name="title" value="{{ old('title', $post->title) }}"
              class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-[#dc2d3d] focus:border-transparent @error('title') border-red-500 @enderror">
            @error('title')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description</label>
            <textarea name="description" rows="4"
              class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-[#dc2d3d] focus:border-transparent">{{ old('description', $post->description) }}</textarea>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Faculty <span class="text-red-500">*</span>
              </label>
              <select name="faculty_id"
                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-[#dc2d3d] focus:border-transparent">
                @foreach($faculties as $faculty)
                  <option value="{{ $faculty->id }}" {{ old('faculty_id', $post->faculty_id) == $faculty->id ? 'selected' : '' }}>
                    {{ $faculty->name }} ({{ $faculty->code }})
                  </option>
                @endforeach
              </select>
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Academic Year <span class="text-red-500">*</span>
              </label>
              <select name="academic_year_id" id="academic_year_id"
                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-[#dc2d3d] focus:border-transparent">
                @foreach($academicYears as $ay)
                  <option value="{{ $ay->id }}"
                    data-closure="{{ $ay->closure_date->format('Y-m-d') }}"
                    {{ old('academic_year_id', $post->academic_year_id) == $ay->id ? 'selected' : '' }}>
                    {{ $ay->name }} {{ $ay->is_active ? '(Active)' : '' }}
                  </option>
                @endforeach
              </select>
            </div>
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
              Submission Closure Date <span class="text-red-500">*</span>
            </label>
            <input type="date" name="closure_date" id="closure_date"
              value="{{ old('closure_date', $post->closure_date->format('Y-m-d')) }}"
              class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-[#dc2d3d] focus:border-transparent @error('closure_date') border-red-500 @enderror">
            <p id="ay-closure-hint" class="mt-1 text-xs text-gray-400"></p>
            @error('closure_date')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
          </div>

          <div class="flex items-center gap-3">
            <input type="checkbox" name="is_published" id="is_published" value="1"
              {{ old('is_published', $post->is_published) ? 'checked' : '' }}
              class="w-4 h-4 rounded border-gray-300 text-[#dc2d3d] focus:ring-[#dc2d3d]">
            <label for="is_published" class="text-sm text-gray-700 dark:text-gray-300">Published</label>
          </div>

          <div class="flex gap-3 pt-2">
            <button type="submit"
              class="inline-flex items-center px-6 py-3 bg-[#dc2d3d] text-white font-semibold rounded-lg hover:bg-[#b82532] transition-colors shadow-lg hover:shadow-xl">
              Update Post
            </button>
            <a href="{{ route('posts.show', $post) }}"
              class="inline-flex items-center px-6 py-3 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 font-semibold rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
              Cancel
            </a>
          </div>
        </form>
      </div>

    </main>
  </div>

  @include('components.dashboard_scripts')
  <script>
    const aySelect = document.getElementById('academic_year_id');
    const closureDateInput = document.getElementById('closure_date');
    const hint = document.getElementById('ay-closure-hint');

    function updateHint() {
      const selected = aySelect.options[aySelect.selectedIndex];
      const maxDate = selected.dataset.closure;
      if (maxDate) {
        closureDateInput.max = maxDate;
        hint.textContent = 'Academic year closure: ' + maxDate;
      }
    }
    aySelect.addEventListener('change', updateHint);
    updateHint();
  </script>
</body>
</html>