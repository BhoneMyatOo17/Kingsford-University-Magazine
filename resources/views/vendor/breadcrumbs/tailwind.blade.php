@unless($breadcrumbs->isEmpty())
  <nav class="text-sm text-gray-500 dark:text-gray-400 mb-6" aria-label="breadcrumb">
    <ol class="flex items-center flex-wrap gap-1">
      @foreach($breadcrumbs as $breadcrumb)
        @if(!$loop->last)
          <li class="flex items-center gap-1">
            <a href="{{ $breadcrumb->url }}" class="hover:text-[#dc2d3d] transition-colors font-medium">
              {{ $breadcrumb->title }}
            </a>
            <svg class="w-3 h-3 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
          </li>
        @else
          <li class="text-gray-700 dark:text-gray-300 font-semibold" aria-current="page">
            {{ $breadcrumb->title }}
          </li>
        @endif
      @endforeach
    </ol>
  </nav>
@endunless