<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $post->title }} - Kingsford University</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 dark:bg-[#18181b]">
  @include('components.sidebar_navigation')
  @include('components.top_navigation', ['title' => 'Post Details'])

  <div class="lg:ml-64">
    <main class="p-4 lg:p-8">

      <!-- Back + Actions -->
      <div class="mb-6 flex items-center justify-between gap-4">
        <a href="{{ route('posts.index') }}"
          class="inline-flex items-center text-sm text-gray-600 dark:text-gray-400 hover:text-[#dc2d3d] transition-colors">
          <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
          </svg>
          Back to Posts
        </a>
        @if(auth()->user()->hasRole('admin'))
          <div class="flex gap-2">
            <a href="{{ route('posts.edit', $post) }}"
              class="inline-flex items-center px-4 py-2 bg-yellow-500 text-white text-sm font-medium rounded-lg hover:bg-yellow-600 transition-colors">
              <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
              </svg>
              Edit
            </a>
            <form action="{{ route('posts.destroy', $post) }}" method="POST"
              onsubmit="return confirm('Delete this post?')">
              @csrf @method('DELETE')
              <button
                class="inline-flex items-center px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition-colors">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
                Delete
              </button>
            </form>
          </div>
        @endif
      </div>

      <!-- Post Info Card -->
      <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mb-6">
        <div class="flex items-start justify-between gap-4 mb-4">
          <div class="min-w-0">
            <div class="flex items-center flex-wrap gap-2 mb-2">
              <span
                class="text-xs font-semibold text-[#dc2d3d] uppercase tracking-wide">{{ $post->faculty->code }}</span>
              <span class="text-xs text-gray-400 dark:text-gray-500">{{ $post->academicYear->name }}</span>
              @if(!$post->is_published)
                <span
                  class="px-2 py-0.5 bg-gray-100 dark:bg-gray-700 text-gray-500 dark:text-gray-400 text-xs rounded-full">Unpublished</span>
              @endif
            </div>
            <h2 class="text-xl lg:text-2xl font-bold text-gray-900 dark:text-white">{{ $post->title }}</h2>
          </div>
          <span
            class="shrink-0 px-3 py-1 rounded-full text-xs font-semibold {{ $post->isOpenForSubmission() ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : 'bg-red-100 text-red-600 dark:bg-red-900/30 dark:text-red-400' }}">
            {{ $post->isOpenForSubmission() ? 'Open' : 'Closed' }}
          </span>
        </div>

        @if($post->description)
          <p class="text-gray-600 dark:text-gray-400 mb-6 whitespace-pre-line">{{ $post->description }}</p>
        @endif

        <div class="grid grid-cols-2 lg:grid-cols-3 gap-3">
          <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-3 lg:p-4">
            <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Faculty</p>
            <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $post->faculty->name }}</p>
          </div>
          <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-3 lg:p-4">
            <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Submission Deadline</p>
            <p
              class="text-sm font-semibold {{ $post->isOpenForSubmission() ? 'text-green-600 dark:text-green-400' : 'text-red-500' }}">
              {{ $post->closure_date->format('d M Y') }}
            </p>
          </div>
          <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-3 lg:p-4">
            <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Edit Deadline</p>
            <p class="text-sm font-semibold text-gray-900 dark:text-white">
              {{ $post->academicYear->final_closure_date->format('d M Y') }}
            </p>
          </div>
          <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-3 lg:p-4">
            <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Academic Year</p>
            <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $post->academicYear->name }}</p>
          </div>
          <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-3 lg:p-4">
            <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Created By</p>
            <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $post->createdBy->name }}</p>
          </div>
          <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-3 lg:p-4">
            <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Created</p>
            <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $post->created_at->format('d M Y') }}</p>
          </div>
        </div>
      </div>

      <!-- Student CTA -->
      @role('student')
      <div class="flex gap-3">
        @if($studentSubmission)
          <a href="{{ route('contributions.show', $studentSubmission) }}"
            class="inline-flex items-center px-6 py-3 bg-gray-700 text-white font-semibold rounded-lg hover:bg-gray-800 transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>
            View My Submission
          </a>
        @elseif($post->isOpenForSubmission())
          <a href="{{ route('contributions.create', $post) }}"
            class="inline-flex items-center px-6 py-3 bg-[#dc2d3d] text-white font-semibold rounded-lg hover:bg-[#b82532] transition-colors shadow-lg hover:shadow-xl">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Add Contribution
          </a>
        @else
          <div
            class="inline-flex items-center px-6 py-3 bg-gray-100 dark:bg-gray-700 text-gray-400 font-semibold rounded-lg cursor-not-allowed">
            Submissions Closed
          </div>
        @endif
      </div>
      @endrole

      <!-- Submissions list -->
      @hasanyrole('marketing_coordinator|marketing_manager|admin')
      <div class="mt-8">
        <div class="flex items-center justify-between mb-4">
          <h3 class="text-lg font-bold text-gray-900 dark:text-white">
            Submissions
            @if($contributions->total() > 0)
              <span
                class="ml-2 text-sm font-normal text-gray-500 dark:text-gray-400">({{ $contributions->total() }})</span>
            @endif
          </h3>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
          @if($contributions->isEmpty())
            <div class="text-center py-12">
              <svg class="mx-auto w-12 h-12 text-gray-300 dark:text-gray-600 mb-3" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                  d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
              </svg>
              <p class="text-gray-500 dark:text-gray-400 font-medium">No submissions yet</p>
            </div>
          @else

            {{-- Desktop table --}}
            <div class="hidden md:block overflow-x-auto">
              <table class="w-full text-sm">
                <thead class="bg-gray-50 dark:bg-gray-700/50">
                  <tr>
                    <th
                      class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                      Student</th>
                    <th
                      class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                      Title</th>
                    <th
                      class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                      Status</th>
                    <th
                      class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                      Submitted</th>
                    <th
                      class="px-6 py-3 text-right text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                      Actions</th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                  @foreach($contributions as $contribution)
                              <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                                <td class="px-6 py-4">
                                  <p class="font-medium text-gray-900 dark:text-white">{{ $contribution->student->user->name }}</p>
                                </td>
                                <td class="px-6 py-4">
                                  <p class="text-gray-700 dark:text-gray-300">{{ $contribution->title }}</p>
                                </td>
                                <td class="px-6 py-4">
                                  <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold
                                        {{ $contribution->status === 'approved' ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' :
                    ($contribution->status === 'rejected' ? 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400' :
                      'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400') }}">
                                    {{ ucfirst(str_replace('_', ' ', $contribution->status)) }}
                                  </span>
                                </td>
                                <td class="px-6 py-4 text-gray-500 dark:text-gray-400 whitespace-nowrap">
                                  {{ $contribution->created_at->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                  <a href="{{ route('contributions.show', $contribution) }}"
                                    class="text-[#dc2d3d] hover:text-[#b82532] text-sm font-medium transition-colors">View</a>
                                </td>
                              </tr>
                  @endforeach
                </tbody>
              </table>
            </div>

            {{-- Mobile card list --}}
            <div class="md:hidden divide-y divide-gray-200 dark:divide-gray-700">
              @foreach($contributions as $contribution)
                      <div class="p-4">
                        {{-- Row 1: title + view --}}
                        <div class="flex items-start justify-between gap-3 mb-1">
                          <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $contribution->title }}</p>
                          <a href="{{ route('contributions.show', $contribution) }}"
                            class="text-sm text-[#dc2d3d] hover:text-[#b82532] font-medium shrink-0">View</a>
                        </div>
                        {{-- Row 2: student --}}
                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-2">{{ $contribution->student->user->name }}</p>
                        {{-- Row 3: status + date --}}
                        <div class="flex items-center gap-2">
                          <span class="px-2 py-0.5 text-xs font-semibold rounded-full
                                {{ $contribution->status === 'approved' ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' :
                ($contribution->status === 'rejected' ? 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400' :
                  'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400') }}">
                            {{ ucfirst(str_replace('_', ' ', $contribution->status)) }}
                          </span>
                          <span
                            class="text-xs text-gray-400 dark:text-gray-500">{{ $contribution->created_at->format('d M Y') }}</span>
                        </div>
                      </div>
              @endforeach
            </div>

            @if($contributions->hasPages())
              <div class="px-6 py-4 border-t border-gray-100 dark:border-gray-700">
                {{ $contributions->links() }}
              </div>
            @endif

          @endif
        </div>
      </div>
      @endhasanyrole

    </main>
  </div>

  @include('components.dashboard_scripts')
</body>

</html>