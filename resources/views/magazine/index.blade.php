<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Magazine - Kingsford University</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 dark:bg-[#18181b]">
  @include('components.navigation')
  @include('components.fetch-loading')

  <div class="pt-32 max-w-7xl mx-auto px-4 py-10">

    {{-- Header --}}
    <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
      <div>
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
          {{ request('trash') ? 'Archived Magazines' : 'Magazine' }}
        </h1>
        <p class="text-gray-500 dark:text-gray-400 mt-1 text-sm">
          {{ request('trash') ? 'Restore archived magazines or permanently delete them.' : 'Published editions and articles from Kingsford University' }}
        </p>
      </div>
      <div class="flex items-center gap-3">
        @if(auth()->check() && auth()->user()->hasAnyRole(['marketing_manager', 'admin']))
          @if(request('trash'))
            <a href="{{ route('magazine.index') }}"
              class="inline-flex items-center gap-2 px-5 py-2.5 border border-gray-300 dark:border-gray-600 text-gray-600 dark:text-gray-400 text-sm font-semibold rounded-lg hover:border-[#dc2d3d] hover:text-[#dc2d3d] transition">
              Back to Magazines
            </a>
          @else
            <a href="{{ route('magazine.index', ['trash' => 1]) }}"
              class="inline-flex items-center gap-2 px-5 py-2.5 border border-gray-300 dark:border-gray-600 text-gray-600 dark:text-gray-400 text-sm font-semibold rounded-lg hover:border-[#dc2d3d] hover:text-[#dc2d3d] transition">
              Archives
            </a>
            <a href="{{ route('magazine.create') }}"
              class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#dc2d3d] text-white text-sm font-semibold rounded-lg hover:bg-[#b82532] transition shadow">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
              </svg>
              Publish
            </a>
          @endif
        @endif
      </div>
    </div>

    @if(session('success'))
      <div
        class="mb-6 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-200 px-4 py-3 rounded-lg">
        {{ session('success') }}
      </div>
    @endif

    {{-- TRASH VIEW --}}
    @if(request('trash') && auth()->check() && auth()->user()->hasAnyRole(['marketing_manager', 'admin']))

      @if($magazines->isEmpty())
        <div class="text-center py-20 text-gray-400 dark:text-gray-600">
          <svg class="mx-auto w-16 h-16 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
          </svg>
          <p class="text-lg font-medium">No archived magazines</p>
        </div>
      @else
        <div
          class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
          <table class="w-full text-sm">
            <thead>
              <tr class="border-b border-gray-200 dark:border-gray-700">
                <th class="text-left px-6 py-4 font-semibold text-gray-600 dark:text-gray-400">Title</th>
                <th class="text-left px-6 py-4 font-semibold text-gray-600 dark:text-gray-400">Year</th>
                <th class="text-left px-6 py-4 font-semibold text-gray-600 dark:text-gray-400">Deleted At</th>
                <th class="px-6 py-4"></th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
              @foreach($magazines as $magazine)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                  <td class="px-6 py-4 text-gray-900 dark:text-white font-medium">{{ $magazine->title }}</td>
                  <td class="px-6 py-4 text-gray-500 dark:text-gray-400">{{ $magazine->academicYear->name ?? '—' }}</td>
                  <td class="px-6 py-4 text-gray-500 dark:text-gray-400">{{ $magazine->deleted_at->format('d M Y, H:i') }}
                  </td>
                  <td class="px-6 py-4">
                    <div class="flex items-center justify-end gap-2">
                      <form action="{{ route('magazine.restore', $magazine->id) }}" method="POST">
                        @csrf
                        <button type="submit"
                          class="px-4 py-2 text-xs font-semibold text-green-600 dark:text-green-400 border border-green-300 dark:border-green-700 rounded-lg hover:bg-green-50 dark:hover:bg-green-900/20 transition">
                          Restore
                        </button>
                      </form>
                      <form action="{{ route('magazine.forceDelete', $magazine->id) }}" method="POST"
                        onsubmit="return confirm('Permanently delete this magazine? This action cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                          class="px-4 py-2 text-xs font-semibold text-red-600 dark:text-red-400 border border-red-300 dark:border-red-700 rounded-lg hover:bg-red-50 dark:hover:bg-red-900/20 transition">
                          Delete Permanently
                        </button>
                      </form>
                    </div>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="mt-6">{{ $magazines->links() }}</div>
      @endif

      {{-- NORMAL VIEW --}}
    @else

      {{-- Search + Filters --}}
      <div class="mb-6 space-y-3">
        <form method="GET" action="{{ route('magazine.index') }}" class="flex gap-2">
          @if(request('year'))<input type="hidden" name="year" value="{{ request('year') }}">@endif
          @if(request('annual'))<input type="hidden" name="annual" value="1">@endif
          <div class="relative flex-1 max-w-sm">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
              viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0" />
            </svg>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by title..."
              class="w-full pl-9 pr-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-sm text-gray-900 dark:text-white focus:ring-2 focus:ring-[#dc2d3d] focus:border-transparent">
          </div>
          <button type="submit"
            class="px-4 py-2 bg-[#dc2d3d] text-white text-sm font-semibold rounded-lg hover:bg-[#b82532] transition">
            Search
          </button>
          @if(request('search'))
            <a href="{{ route('magazine.index', array_filter(['year' => request('year'), 'annual' => request('annual')])) }}"
              class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-gray-600 dark:text-gray-400 text-sm font-semibold rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition">
              Clear
            </a>
          @endif
        </form>

        <div class="flex flex-wrap gap-2">
          <a href="{{ route('magazine.index', array_filter(['search' => request('search')])) }}"
            class="px-4 py-2 rounded-lg text-sm font-medium transition-colors
                      {{ !request('year') && !request('annual') ? 'bg-[#dc2d3d] text-white shadow' : 'bg-white dark:bg-gray-800 text-gray-600 dark:text-gray-400 border border-gray-200 dark:border-gray-700 hover:border-[#dc2d3d] hover:text-[#dc2d3d]' }}">
            All
          </a>
          <a href="{{ route('magazine.index', array_filter(['search' => request('search'), 'annual' => '1'])) }}"
            class="px-4 py-2 rounded-lg text-sm font-medium transition-colors
                      {{ request('annual') ? 'bg-[#dc2d3d] text-white shadow' : 'bg-white dark:bg-gray-800 text-gray-600 dark:text-gray-400 border border-gray-200 dark:border-gray-700 hover:border-[#dc2d3d] hover:text-[#dc2d3d]' }}">
            Annual Magazines
          </a>
          @foreach($academicYears as $year)
            <a href="{{ route('magazine.index', array_filter(['search' => request('search'), 'year' => $year->id])) }}"
              class="px-4 py-2 rounded-lg text-sm font-medium transition-colors
                                {{ request('year') == $year->id ? 'bg-[#dc2d3d] text-white shadow' : 'bg-white dark:bg-gray-800 text-gray-600 dark:text-gray-400 border border-gray-200 dark:border-gray-700 hover:border-[#dc2d3d] hover:text-[#dc2d3d]' }}">
              {{ $year->name }}
            </a>
          @endforeach
        </div>
      </div>

      @if($magazines->isEmpty())
        <div class="text-center py-20 text-gray-400 dark:text-gray-600">
          <svg class="mx-auto w-16 h-16 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
              d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
          </svg>
          <p class="text-lg font-medium">No magazines published yet</p>
        </div>
      @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
          @foreach($magazines as $magazine)
            <div
              class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden flex flex-col">

              <a href="{{ route('magazine.show', $magazine) }}"
                class="block relative bg-gray-100 dark:bg-gray-700 overflow-hidden" style="height: 220px;">
                @if($magazine->cover_image_path && $magazine->cover_image_disk)
                  <img src="{{ Storage::disk($magazine->cover_image_disk)->url($magazine->cover_image_path) }}"
                    alt="{{ $magazine->title }}"
                    class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                @else
                  <div class="w-full h-full flex items-center justify-center">
                    <svg class="w-16 h-16 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor"
                      viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                  </div>
                @endif
              </a>

              <div class="p-5 flex flex-col flex-1 border-t border-gray-100 dark:border-gray-700">
                <div class="flex items-center justify-between mb-2">
                  <span
                    class="inline-block px-3 py-1 text-xs font-semibold text-[#dc2d3d] bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-full">
                    {{ $magazine->academicYear->name ?? '—' }}
                  </span>
                  <span class="flex items-center gap-1 text-xs text-gray-400 dark:text-gray-500">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    {{ number_format($magazine->view_count) }}
                  </span>
                </div>

                <h2 class="text-base font-bold text-gray-900 dark:text-white leading-snug mb-1">
                  <a href="{{ route('magazine.show', $magazine) }}" class="hover:text-[#dc2d3d] transition">
                    {{ $magazine->title }}
                  </a>
                </h2>

                <p class="text-xs font-semibold uppercase tracking-wide text-gray-400 dark:text-gray-500 mb-2">
                  {{ $magazine->published_date->format('F j, Y') }}
                </p>

                @if($magazine->description)
                  <p class="text-sm text-gray-500 dark:text-gray-400 line-clamp-2 mb-4">{{ $magazine->description }}</p>
                @else
                  <div class="mb-4"></div>
                @endif

                <div class="mt-auto flex items-center gap-2 pt-1">
                  <a href="{{ route('magazine.show', $magazine) }}"
                    class="fetch-link flex-1 text-center px-4 py-2.5 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 text-sm font-semibold rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition">
                    View Edition
                  </a>
                  @if(auth()->check() && auth()->user()->hasAnyRole(['marketing_manager', 'admin']))
                    <a href="{{ route('magazine.edit', $magazine) }}"
                      class="fetch-link px-4 py-2.5 border border-gray-200 dark:border-gray-600 text-gray-600 dark:text-gray-400 text-sm font-semibold rounded-lg hover:border-[#dc2d3d] hover:text-[#dc2d3d] transition">
                      Edit
                    </a>
                  @endif
                </div>
              </div>

            </div>
          @endforeach
        </div>
        <div class="mt-8">{{ $magazines->links() }}</div>
      @endif

    @endif

  </div>
</body>

</html>