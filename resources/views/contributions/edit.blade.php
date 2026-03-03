<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Contribution - Kingsford University</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 dark:bg-[#18181b]">
  @include('components.sidebar_navigation')
  @include('components.top_navigation', ['title' => 'Edit Contribution'])

  <div class="lg:ml-64">
    <main class="p-4 lg:p-8">

      <div class="mb-6">
        <a href="{{ route('contributions.show', $contribution) }}"
          class="inline-flex items-center text-sm text-gray-600 dark:text-gray-400 hover:text-[#dc2d3d] transition-colors">
          <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
          </svg>
          Back to Contribution
        </a>
      </div>

      <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Edit Contribution</h2>
        <p class="text-gray-600 dark:text-gray-400 mt-1">{{ $contribution->post->title }}</p>
      </div>

      <div
        class="mb-6 bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 text-yellow-800 dark:text-yellow-200 px-4 py-3 rounded-lg flex items-center gap-3">
        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span class="text-sm"><strong>Edit deadline:</strong>
          {{ $contribution->post->academicYear->final_closure_date->format('d M Y') }}</span>
      </div>

      <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 max-w-3xl">

        @if($errors->any())
          <div
            class="mb-6 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-800 dark:text-red-200 px-4 py-3 rounded-lg">
            <ul class="list-disc list-inside text-sm space-y-1">
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form action="{{ route('contributions.update', $contribution) }}" method="POST" enctype="multipart/form-data"
          class="space-y-6">
          @csrf @method('PUT')

          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
              Title <span class="text-red-500">*</span>
            </label>
            <input type="text" name="title" value="{{ old('title', $contribution->title) }}"
              class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-[#dc2d3d] focus:border-transparent @error('title') border-red-500 @enderror">
            @error('title')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description</label>
            <textarea name="description" rows="4"
              class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-[#dc2d3d] focus:border-transparent">{{ old('description', $contribution->description) }}</textarea>
          </div>

          @if($contribution->files->count())
            <div>
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Current Files</label>
              <ul class="space-y-2">
                @foreach($contribution->files as $file)
                  <li
                    class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700/50 rounded-lg border border-gray-100 dark:border-gray-700">
                    <div class="flex items-center gap-3">
                      <span
                        class="inline-block px-2 py-0.5 rounded text-xs font-medium
                            {{ $file->file_type === 'document' ? 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400' : 'bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-400' }}">
                        {{ strtoupper($file->file_type) }}
                      </span>
                      <div>
                        <p class="text-sm text-gray-700 dark:text-gray-300">{{ $file->original_name }}</p>
                        <p class="text-xs text-gray-400">{{ $file->file_size_formatted }}</p>
                      </div>
                    </div>
                    <label
                      class="flex items-center gap-2 text-red-600 dark:text-red-400 text-xs cursor-pointer hover:text-red-700 transition-colors">
                      <input type="checkbox" name="remove_files[]" value="{{ $file->id }}"
                        class="rounded border-gray-300 text-red-600 focus:ring-red-500">
                      Remove
                    </label>
                  </li>
                @endforeach
              </ul>
            </div>
          @endif

          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
              Add Documents
              <span class="text-xs text-gray-400 font-normal ml-1">(Word or PDF — max 2 total)</span>
            </label>
            <div
              class="mt-1 border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-4 hover:border-[#dc2d3d] transition-colors">
              <input type="file" name="documents[]" multiple accept=".doc,.docx,.pdf"
                class="w-full text-sm text-gray-500 dark:text-gray-400">
            </div>
            @error('documents.*')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
              Add Images
              <span class="text-xs text-gray-400 font-normal ml-1">(max 5 total)</span>
            </label>
            <div
              class="mt-1 border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-4 hover:border-[#dc2d3d] transition-colors">
              <input type="file" name="images[]" multiple accept="image/jpeg,image/png,image/gif,image/webp"
                class="w-full text-sm text-gray-500 dark:text-gray-400">
            </div>
            @error('images.*')<p class="mt-1 text-xs text-red-500">{{ $message }}</p>@enderror
          </div>

          <div class="flex gap-3 pt-2">
            <button type="submit"
              class="inline-flex items-center px-6 py-3 bg-[#dc2d3d] text-white font-semibold rounded-lg hover:bg-[#b82532] transition-colors shadow-lg hover:shadow-xl">
              Save Changes
            </button>
            <a href="{{ route('contributions.show', $contribution) }}"
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