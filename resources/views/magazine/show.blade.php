<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $magazine->title }} - Kingsford University</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <style>
    .magazine-content h1 {
      font-size: 2rem;
      font-weight: 800;
      margin: 1.5rem 0 0.75rem;
      line-height: 1.2;
    }

    .magazine-content h2 {
      font-size: 1.5rem;
      font-weight: 700;
      margin: 1.5rem 0 0.75rem;
      line-height: 1.3;
    }

    .magazine-content h3 {
      font-size: 1.25rem;
      font-weight: 600;
      margin: 1.25rem 0 0.5rem;
    }

    .magazine-content p {
      margin-bottom: 1.25rem;
      line-height: 1.8;
    }

    .magazine-content ul,
    .magazine-content ol {
      margin: 1rem 0 1.25rem 1.5rem;
      line-height: 1.8;
    }

    .magazine-content ul {
      list-style-type: disc;
    }

    .magazine-content ol {
      list-style-type: decimal;
    }

    .magazine-content li {
      margin-bottom: 0.4rem;
    }

    .magazine-content strong {
      font-weight: 700;
    }

    .magazine-content em {
      font-style: italic;
    }

    .magazine-content blockquote {
      border-left: 4px solid #dc2d3d;
      padding-left: 1rem;
      margin: 1.5rem 0;
      color: #6b7280;
      font-style: italic;
    }

    .magazine-content img {
      max-width: 100%;
      border-radius: 0.75rem;
      margin: 1.5rem 0;
    }

    .magazine-content a {
      color: #dc2d3d;
      text-decoration: underline;
    }
  </style>
</head>

<body class="bg-gray-50 dark:bg-[#18181b]">
  @include('components.navigation')

  <div class="pt-32 max-w-4xl mx-auto px-4 py-10">

    {{-- Back --}}
    <a href="{{ route('magazine.index') }}"
      class="group inline-flex items-center gap-3 text-gray-700 dark:text-gray-300 hover:text-[#dc2d3d] transition mb-8">
      <svg class="w-8 h-5 transform group-hover:-translate-x-2 transition-transform duration-300" fill="none"
        stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 12H5m0 0l7-7m-7 7l7 7" />
      </svg>
      <span class="text-xs font-bold tracking-[0.3em] uppercase">Back to Magazine</span>
    </a>

    @if(session('success'))
      <div
        class="mb-6 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-200 px-4 py-3 rounded-lg">
        {{ session('success') }}
      </div>
    @endif

    {{-- Editorial header --}}
    <header class="mb-10">
      <div class="flex flex-wrap items-center gap-3 mb-5">
        <span
          class="inline-block bg-gray-100 dark:bg-gray-800 px-3 py-1 rounded border border-gray-200 dark:border-gray-700 text-[#dc2d3d] text-xs font-bold uppercase tracking-wider">
          {{ $magazine->academicYear->name ?? '—' }}
        </span>
        @if(auth()->check() && auth()->user()->hasAnyRole(['marketing_manager', 'admin']))
          <a href="{{ route('magazine.edit', $magazine) }}"
            class="inline-flex items-center gap-1.5 px-3 py-1 border border-gray-200 dark:border-gray-700 text-gray-500 dark:text-gray-400 text-xs font-semibold rounded hover:border-[#dc2d3d] hover:text-[#dc2d3d] transition">
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
            </svg>
            Edit
          </a>
        @endif
      </div>

      <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 dark:text-white leading-[1.1] mb-5">
        {{ $magazine->title }}
      </h1>

      @if($magazine->description)
        <p class="text-lg md:text-xl text-gray-600 dark:text-gray-400 max-w-3xl leading-relaxed mb-5">
          {{ $magazine->description }}
        </p>
      @endif

      <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500 dark:text-gray-400">
        <span>Released {{ $magazine->published_date->format('d M Y') }}</span>
        <span>•</span>
        <span class="flex items-center gap-1.5">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
          </svg>
          {{ number_format($magazine->view_count) }} views
        </span>
        @if($pdfUrl)
          <span>•</span>
          <a href="{{ $pdfUrl }}" download
            class="inline-flex items-center gap-1.5 text-[#dc2d3d] font-semibold hover:text-[#b82532] transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
            </svg>
            Download PDF
          </a>
        @endif
      </div>
    </header>

    {{-- Hero cover image --}}
    @if($coverUrl)
      <section class="mb-12">
        <div class="rounded-3xl overflow-hidden shadow-2xl border border-gray-200 dark:border-gray-800">
          <img src="{{ $coverUrl }}" alt="{{ $magazine->title }}" class="w-full h-auto object-cover">
        </div>
      </section>
    @endif

    {{-- Article content --}}
    @if($magazine->content)
      <article class="magazine-content w-full max-w-3xl mx-auto text-gray-700 dark:text-gray-300 text-lg">
        {!! $magazine->content !!}
      </article>
    @else
      <div class="text-center py-16 text-gray-400 dark:text-gray-600">
        <p class="text-sm">No content yet.</p>
      </div>
    @endif

  </div>
</body>

</html>