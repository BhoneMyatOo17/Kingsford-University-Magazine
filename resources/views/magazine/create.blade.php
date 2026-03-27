<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Publish Magazine - Kingsford University</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
  <style>
    .ql-container {
      font-size: 1rem;
      min-height: 300px;
      border-bottom-left-radius: 0.5rem;
      border-bottom-right-radius: 0.5rem;
    }

    .ql-toolbar {
      border-top-left-radius: 0.5rem;
      border-top-right-radius: 0.5rem;
    }

    .dark .ql-toolbar,
    .dark .ql-container {
      background: #1f2937;
      border-color: #374151;
      color: #f3f4f6;
    }

    .dark .ql-toolbar .ql-stroke {
      stroke: #9ca3af;
    }

    .dark .ql-toolbar .ql-fill {
      fill: #9ca3af;
    }

    .dark .ql-toolbar .ql-picker {
      color: #9ca3af;
    }

    .dark .ql-editor {
      color: #f3f4f6;
    }

    .dark .ql-editor.ql-blank::before {
      color: #6b7280;
    }
  </style>
</head>

<body class="bg-gray-50 dark:bg-[#18181b]">
  @include('components.sidebar_navigation')
  @include('components.fetch-loading')
  @include('components.top_navigation', ['title' => 'Publish Magazine'])

  <div class="lg:ml-64">
    <main class="p-4 lg:p-8">
      <div class="max-w-3xl mx-auto">

        <div class="mb-8">
          <a href="{{ route('magazine.index') }}"
            class="group inline-flex items-center gap-2 text-gray-600 dark:text-gray-400 hover:text-[#dc2d3d] transition mb-4 text-sm font-semibold">
            <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor"
              viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m0 0l7-7m-7 7l7 7" />
            </svg>
            Back to Magazine
          </a>
          <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Publish Magazine</h1>
          <p class="text-gray-500 dark:text-gray-400 mt-1 text-sm">Upload a magazine edition or article.</p>
        </div>

        @if($errors->any())
          <div class="mb-6 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4">
            <ul class="text-sm text-red-600 dark:text-red-400 space-y-1">
              @foreach($errors->all() as $error)
                <li>• {{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form action="{{ route('magazine.store') }}" method="POST" enctype="multipart/form-data" id="magazine-form"
          class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 p-8 space-y-6">
          @csrf

          <div>
            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Academic Year</label>
            <select name="academic_year_id" required
              class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2.5 bg-white dark:bg-gray-700 text-gray-900 dark:text-white text-sm focus:ring-2 focus:ring-[#dc2d3d] focus:border-transparent">
              <option value="">Select year</option>
              @foreach($academicYears as $year)
                <option value="{{ $year->id }}" {{ old('academic_year_id') == $year->id ? 'selected' : '' }}>
                  {{ $year->name }}
                </option>
              @endforeach
            </select>
          </div>

          <div>
            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Title</label>
            <input type="text" name="title" value="{{ old('title') }}" required
              class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2.5 bg-white dark:bg-gray-700 text-gray-900 dark:text-white text-sm focus:ring-2 focus:ring-[#dc2d3d] focus:border-transparent"
              placeholder="e.g. Annual Magazine 2026">
          </div>

          <div>
            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">
              Sub title <span class="text-gray-400 font-normal">(optional)</span>
            </label>
            <input type="text" name="description" value="{{ old('description') }}"
              class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2.5 bg-white dark:bg-gray-700 text-gray-900 dark:text-white text-sm focus:ring-2 focus:ring-[#dc2d3d] focus:border-transparent"
              placeholder="e.g. A look at student creativity across all faculties">
          </div>

          <div>
            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Published Date</label>
            <input type="date" name="published_date" value="{{ old('published_date', now()->format('Y-m-d')) }}"
              required
              class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2.5 bg-white dark:bg-gray-700 text-gray-900 dark:text-white text-sm focus:ring-2 focus:ring-[#dc2d3d] focus:border-transparent">
          </div>

          <div>
            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">
              Cover Image <span class="text-gray-400 font-normal">(optional — jpg, png, webp, max 5MB)</span>
            </label>
            <div
              class="relative border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-6 text-center hover:border-[#dc2d3d] transition cursor-pointer"
              onclick="document.getElementById('cover_image').click()">
              <svg class="mx-auto w-10 h-10 text-gray-400 dark:text-gray-500 mb-2" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
              </svg>
              <p class="text-sm text-gray-500 dark:text-gray-400" id="cover-label">Click to upload cover image</p>
              <input type="file" id="cover_image" name="cover_image" accept="image/jpeg,image/png,image/webp"
                class="hidden"
                onchange="document.getElementById('cover-label').textContent = this.files[0]?.name ?? 'Click to upload cover image'">
            </div>
          </div>

          <div>
            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">
              PDF File <span class="text-gray-400 font-normal">(optional — max 50MB)</span>
            </label>
            <div
              class="relative border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-6 text-center hover:border-[#dc2d3d] transition cursor-pointer"
              onclick="document.getElementById('pdf_file').click()">
              <svg class="mx-auto w-10 h-10 text-gray-400 dark:text-gray-500 mb-2" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                  d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
              </svg>
              <p class="text-sm text-gray-500 dark:text-gray-400" id="pdf-label">Click to upload PDF</p>
              <input type="file" id="pdf_file" name="pdf_file" accept="application/pdf" class="hidden"
                onchange="document.getElementById('pdf-label').textContent = this.files[0]?.name ?? 'Click to upload PDF'">
            </div>
          </div>

          <div>
            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">Article Content</label>
            <div id="quill-editor" style="min-height: 300px;">{{ old('content') }}</div>
            <input type="hidden" name="content" id="content-input">
          </div>

          <div class="flex justify-end gap-3 pt-2">
            <a href="{{ route('magazine.index') }}"
              class="px-6 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg text-sm font-semibold text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
              Cancel
            </a>
            <button type="submit" id="submit-btn"
              class="px-6 py-2.5 bg-[#dc2d3d] text-white rounded-lg text-sm font-semibold hover:bg-[#b82532] transition">
              Publish
            </button>
          </div>

        </form>
      </div>
    </main>
  </div>

  <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
  <script>
    const quill = new Quill('#quill-editor', {
      theme: 'snow',
      placeholder: 'Write the magazine content here...',
      modules: {
        toolbar: [
          [{ header: [1, 2, 3, false] }],
          ['bold', 'italic', 'underline', 'strike'],
          [{ list: 'ordered' }, { list: 'bullet' }],
          ['blockquote', 'link', 'image'],
          [{ align: [] }],
          ['clean']
        ]
      }
    });

    @if(old('content'))
      quill.root.innerHTML = {!! json_encode(old('content')) !!};
    @endif

    document.getElementById('magazine-form').addEventListener('submit', function (e) {
      const content = quill.getText().trim();
      if (!content) {
        e.preventDefault();
        alert('Article content is required.');
        return;
      }
      document.getElementById('content-input').value = quill.root.innerHTML;
      showFetchLoader('Publishing magazine...');
    });
  </script>
</body>

</html>