<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Posts - Kingsford University</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 dark:bg-[#18181b]">
  @include('components.sidebar_navigation')
  @include('components.top_navigation', ['title' => 'Posts'])

  <div class="lg:ml-64">
    <main class="p-4 lg:p-8">

      @if(session('success'))
        <div class="mb-6 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-200 px-4 py-3 rounded-lg flex items-center">
          <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
          <span>{{ session('success') }}</span>
        </div>
      @endif

      <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
          <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Posts</h2>
          <p class="text-gray-600 dark:text-gray-400 mt-1">Browse available posts and submit contributions</p>
        </div>
        @if(auth()->user()->hasRole('admin'))
          <a href="{{ route('posts.create') }}"
            class="inline-flex items-center justify-center px-6 py-3 dark:text-white dark:hover:text-slate-300 hover:text-white bg-[#dc2d3d] text-white font-semibold rounded-lg hover:bg-[#b82532] transition-all duration-300 shadow-lg hover:shadow-xl">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            New Post
          </a>
        @endif
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($posts as $post)
          @php
            $isOpen       = $post->isOpenForSubmission();
            $hasSubmitted = $submittedPostIds->has($post->id);
          @endphp
          <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden flex flex-col">
            <div class="p-6 flex-1">
              <div class="flex items-center justify-between mb-2">
                <span class="text-xs font-semibold text-[#dc2d3d] uppercase dark:text-gray-300 tracking-wide">{{ $post->faculty->code }}</span>
                <span class="text-xs text-gray-400 dark:text-gray-300">{{ $post->academicYear->name }}</span>
              </div>
              <h3 class="text-lg font-bold text-gray-900 dark:text-white mt-1">
                <a href="{{ route('posts.show', $post) }}" class="hover:text-[#dc2d3d] transition-colors">{{ $post->title }}</a>
              </h3>
              @if($post->description)
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-2 line-clamp-2">{{ $post->description }}</p>
              @endif
            </div>
            <div class="px-6 py-4 border-t border-gray-100 dark:border-gray-700 flex items-center justify-between">
              <div class="text-xs text-gray-500 dark:text-gray-400">
                Closes: <span class="{{ $isOpen ? 'text-green-600 dark:text-green-400' : 'text-red-500' }} font-semibold">
                  {{ $post->closure_date->format('d M Y') }}
                </span>
              </div>
              @role('student')
                @if($hasSubmitted)
                  @php $submission = auth()->user()->student->contributions()->where('post_id', $post->id)->first(); @endphp
                  <a href="{{ route('contributions.show', $submission) }}"
                    class="px-3 py-1.5 text-xs bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 font-medium transition-colors">
                    View Submission
                  </a>
                @elseif($isOpen)
                  <a href="{{ route('contributions.create', $post) }}"
                    class="px-3 py-1.5 text-xs bg-[#dc2d3d] hover:text-white text-white rounded-lg hover:bg-[#b82532] font-medium transition-colors">
                    Add Contribution
                  </a>
                @else
                  <span class="text-xs text-gray-400 italic">Closed</span>
                @endif
              @else
                <a href="{{ route('posts.show', $post) }}"
                  class="px-3 py-1.5 text-xs bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 font-medium transition-colors">
                  View
                </a>
              @endrole
            </div>
          </div>
        @empty
          <div class="col-span-3 flex flex-col items-center justify-center py-16">
            <svg class="w-28 h-28 text-red-300 dark:text-slate-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
            </svg>
            <p class="text-gray-500 dark:text-gray-400 text-lg font-medium">No posts found</p>
          </div>
        @endforelse
      </div>

      <div class="mt-6">{{ $posts->links() }}</div>

    </main>
  </div>

  @include('components.dashboard_scripts')
</body>
</html>