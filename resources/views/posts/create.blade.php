<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Post - Kingsford University</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 dark:bg-[#18181b]">
  @include('components.sidebar_navigation')
  @include('components.top_navigation', ['title' => 'Create Post'])

  <div class="lg:ml-64">
    <main class="p-4 lg:p-8">

      <div class="mb-6">
        <a href="{{ route('posts.index') }}" class="inline-flex items-center text-sm text-gray-600 dark:text-gray-400 hover:text-[#dc2d3d] transition-colors">
          <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
          </svg>
          Back to Posts
        </a>
      </div>

      <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Create Post</h2>
        <p class="text-gray-600 dark:text-gray-400 mt-1">Add a new post for student contributions</p>
      </div>

      <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 max-w-3xl">
        <form action="{{ route('posts.store') }}" method="POST" class="space-y-6">
          @csrf

          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
              Title <span class="text-red-500">*</span>
            </label>
            <input type="text" name="title" value="{{ old('title') }}"
              class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-[#dc2d3d] focus:border-transparent @error('title') border-red-500 @enderror">
            @error('title')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description</label>
            <textarea name="description" rows="4"
              class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-[#dc2d3d] focus:border-transparent">{{ old('description') }}</textarea>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Faculty <span class="text-red-500">*</span>
              </label>
              <select name="faculty_id"
                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-[#dc2d3d] focus:border-transparent @error('faculty_id') border-red-500 @enderror">
                <option value="">— Select Faculty —</option>
                @foreach($faculties as $faculty)
                  <option value="{{ $faculty->id }}" {{ old('faculty_id') == $faculty->id ? 'selected' : '' }}>
                    {{ $faculty->name }} ({{ $faculty->code }})
                  </option>
                @endforeach
              </select>
              @error('faculty_id')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                Academic Year <span class="text-red-500">*</span>
              </label>
              <select name="academic_year_id" id="academic_year_id"
                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-[#dc2d3d] focus:border-transparent @error('academic_year_id') border-red-500 @enderror">
                <option value="">— Select Academic Year —</option>
                @foreach($academicYears as $ay)
                  <option value="{{ $ay->id }}"
                    data-closure="{{ $ay->closure_date->format('Y-m-d') }}"
                    {{ old('academic_year_id') == $ay->id ? 'selected' : '' }}>
                    {{ $ay->name }} {{ $ay->is_active ? '(Active)' : '' }}
                  </option>
                @endforeach
              </select>
              @error('academic_year_id')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
            </div>
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
              Submission Closure Date <span class="text-red-500">*</span>
              <span class="text-xs text-gray-400 font-normal ml-1">(must be on or before academic year closure date)</span>
            </label>
            <input type="date" name="closure_date" id="closure_date" value="{{ old('closure_date') }}"
              class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-[#dc2d3d] focus:border-transparent @error('closure_date') border-red-500 @enderror">
            <p id="ay-closure-hint" class="mt-1 text-xs text-gray-400"></p>
            @error('closure_date')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
          </div>

          <div class="flex items-center gap-3">
            <input type="checkbox" name="is_published" id="is_published" value="1"
              {{ old('is_published', '1') ? 'checked' : '' }}
              class="w-4 h-4 rounded border-gray-300 text-[#dc2d3d] focus:ring-[#dc2d3d]">
            <label for="is_published" class="text-sm text-gray-700 dark:text-gray-300">Published (visible to students)</label>
          </div>

          <div class="flex gap-3 pt-2">
            <button type="submit"
              class="inline-flex items-center px-6 py-3 bg-[#dc2d3d] text-white font-semibold rounded-lg hover:bg-[#b82532] transition-colors shadow-lg hover:shadow-xl">
              Create Post
            </button>
            <a href="{{ route('posts.index') }}"
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

    aySelect.addEventListener('change', function () {
      const selected = this.options[this.selectedIndex];
      const maxDate = selected.dataset.closure;
      if (maxDate) {
        closureDateInput.max = maxDate;
        hint.textContent = 'Academic year closure: ' + maxDate;
      } else {
        closureDateInput.removeAttribute('max');
        hint.textContent = '';
      }
    });
    aySelect.dispatchEvent(new Event('change'));
  </script>
</body>
</html>