<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contribution - Kingsford University</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 dark:bg-[#18181b]">
  @include('components.sidebar_navigation')
  @include('components.top_navigation', ['title' => 'Contribution Details'])

  <div class="lg:ml-64">
    <main class="p-4 lg:p-8">

      <div class="mb-6 flex items-center justify-between">
        <a href="{{ $backUrl }}"
          class="inline-flex items-center text-sm text-gray-600 dark:text-gray-400 hover:text-[#dc2d3d] transition-colors">
          <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
          </svg>
          Back
        </a>
        <div class="flex gap-2">
          @if($canEdit)
            <a href="{{ route('contributions.edit', $contribution) }}"
              class="inline-flex items-center px-4 py-2 bg-yellow-500 text-white text-sm font-medium rounded-lg hover:bg-yellow-600 transition-colors">
              <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
              </svg>
              Edit
            </a>
          @endif
          @if($canDelete)
            <form action="{{ route('contributions.destroy', $contribution) }}" method="POST">
              @csrf @method('DELETE')
              <button type="button"
                onclick="if(confirm('Delete this contribution? This cannot be undone.')) this.closest('form').submit();"
                class="inline-flex items-center px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition-colors">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
                Delete
              </button>
            </form>
          @endif
        </div>
      </div>

      @foreach(['success', 'info', 'error'] as $msg)
        @if(session($msg))
          <div
            class="mb-6 px-4 py-3 rounded-lg flex items-center
                          {{ $msg === 'error' ? 'bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-800 dark:text-red-200' :
          ($msg === 'info' ? 'bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 text-blue-800 dark:text-blue-200' :
            'bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-200') }}">
            {{ session($msg) }}
          </div>
        @endif
      @endforeach

      @if(auth()->user()->isMarketingCoordinator() && $contribution->comments->isEmpty() && $contribution->created_at->lte(now()->subDays(14)))
        <div
          class="mb-6 bg-red-50 dark:bg-red-900/20 border border-[#dc2d3d] rounded-lg px-4 py-3 flex items-center gap-3">
          <svg class="w-5 h-5 text-[#dc2d3d] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
          </svg>
          <p class="text-sm font-medium text-[#dc2d3d]">
            This contribution was submitted {{ $contribution->created_at->diffForHumans() }} and has not received a
            comment yet. Please leave a comment below.
          </p>
        </div>
      @endif

      {{-- Details --}}
      <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mb-6">
        <div class="flex items-start justify-between mb-4">
          <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $contribution->title }}</h2>
          <div class="flex gap-2 flex-shrink-0 ml-4">
            <span class="px-3 py-1 rounded-full text-xs font-semibold
              {{ $contribution->status === 'approved' ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' :
  ($contribution->status === 'rejected' ? 'bg-red-100 text-red-600 dark:bg-red-900/30 dark:text-red-400' :
    'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400') }}">
              {{ ucfirst(str_replace('_', ' ', $contribution->status)) }}
            </span>
            @if($contribution->is_selected)
              <span
                class="px-3 py-1 rounded-full text-xs font-semibold bg-indigo-100 text-indigo-700 dark:bg-indigo-900/30 dark:text-indigo-400">
                Selected for Publication
              </span>
            @endif
          </div>
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-3 gap-3 mb-4">
          <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-3 lg:p-4">
            <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Student</p>
            <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $contribution->student->user->name }}</p>
          </div>
          <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-3 lg:p-4">
            <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Post</p>
            <a href="{{ route('posts.show', $contribution->post) }}"
              class="text-sm font-semibold text-[#dc2d3d] hover:underline">
              {{ $contribution->post->title }}
            </a>
          </div>
          <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-3 lg:p-4">
            <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Faculty</p>
            <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $contribution->post->faculty->name }}</p>
          </div>
          <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-3 lg:p-4">
            <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Academic Year</p>
            <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $contribution->academicYear->name }}</p>
          </div>
          <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-3 lg:p-4">
            <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Submitted</p>
            <p class="text-sm font-semibold text-gray-900 dark:text-white">
              {{ $contribution->created_at->format('d M Y, H:i') }}
            </p>
          </div>
          <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-3 lg:p-4">
            <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Publication</p>
            @if($contribution->status === 'pending')
              <span class="text-sm font-semibold text-yellow-600 dark:text-yellow-400">Pending Approval</span>
            @elseif($contribution->status === 'rejected')
              <span class="text-sm font-semibold text-red-500 dark:text-red-400">Rejected</span>
            @elseif($contribution->is_selected)
              <span class="inline-flex items-center gap-1 text-sm font-semibold text-indigo-600 dark:text-indigo-400">
                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd"
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                    clip-rule="evenodd" />
                </svg>
                Selected
              </span>
            @else
              <span class="text-sm font-semibold text-gray-400 dark:text-gray-500">Not selected</span>
            @endif
          </div>
        </div>

        @if($contribution->description)
          <div class="mt-4 pt-4 border-t border-gray-100 dark:border-gray-700">
            <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">Description</p>
            <p class="text-sm text-gray-700 dark:text-gray-300 whitespace-pre-line">{{ $contribution->description }}</p>
          </div>
        @endif
      </div>

      {{-- Files --}}
      @if($contribution->files->count())
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mb-6">
          <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-4">Attached Files</h3>
          <ul class="divide-y divide-gray-100 dark:divide-gray-700">
            @foreach($contribution->files as $file)
                  <li class="py-3 flex items-center justify-between gap-4">
                    <div class="flex items-center gap-3 min-w-0">
                      <span class="w-20 shrink-0 text-center px-2 py-0.5 rounded text-xs font-medium
                                            {{ $file->file_type === 'document'
              ? 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400'
              : 'bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-400' }}">
                        {{ strtoupper($file->file_type) }}
                      </span>
                      <div class="min-w-0">
                        <p class="text-sm text-gray-700 dark:text-gray-300 font-medium truncate">{{ $file->original_name }}</p>
                        <p class="text-xs text-gray-400">{{ $file->file_size_formatted }}</p>
                      </div>
                    </div>
                    <a href="{{ $file->getUrl() }}" target="_blank"
                      class="shrink-0 inline-flex items-center px-3 py-1.5 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 text-xs font-medium rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                      <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                      </svg>
                      Download
                    </a>
                  </li>
            @endforeach
          </ul>
        </div>
      @endif

      {{-- Coordinator: approval + reject --}}
      @if($canApprove)
          <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mb-6">
            <div class="flex items-start justify-between gap-4 flex-wrap">
              <div>
                <p class="text-sm font-semibold text-gray-700 dark:text-gray-300">Publication Status</p>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">
                  {{ $contribution->is_selected ? 'Currently selected for publication.' : ($contribution->status === 'rejected' ? 'This contribution has been rejected.' : 'Not yet selected for publication.') }}
                </p>
                @if(!$hasCommented)
                  <p class="text-xs text-[#dc2d3d] mt-1">You must leave a comment before approving or rejecting.</p>
                @endif
              </div>
              <div class="flex gap-2 flex-wrap">
                @if($contribution->status !== 'rejected')
                        <form action="{{ route('contributions.reject', $contribution) }}" method="POST">
                          @csrf
                          <button type="button" @if($hasCommented)
                            onclick="if(confirm('Reject this contribution? The student will be notified.')) this.closest('form').submit();"
                          @endif @disabled(!$hasCommented)
                            class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-lg transition-colors
                                  {{ $hasCommented
                  ? 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400 hover:bg-red-200 dark:hover:bg-red-900/50 cursor-pointer'
                  : 'bg-gray-100 text-gray-400 dark:bg-gray-700 dark:text-gray-500 cursor-not-allowed opacity-50' }}">
                            Reject
                          </button>
                        </form>
                @endif
                <form action="{{ route('contributions.toggleApproval', $contribution) }}" method="POST">
                  @csrf
                  <button type="button" @if($hasCommented)
                    onclick="if(confirm('{{ $contribution->is_selected ? 'Revoke approval for this contribution?' : 'Approve this contribution for publication?' }}')) this.closest('form').submit();"
                  @endif @disabled(!$hasCommented)
                    class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-lg transition-colors
                        {{ !$hasCommented
        ? 'bg-gray-100 text-gray-400 dark:bg-gray-700 dark:text-gray-500 cursor-not-allowed opacity-50'
        : ($contribution->is_selected
          ? 'bg-orange-100 text-orange-700 dark:bg-orange-900/30 dark:text-orange-400 hover:bg-orange-200 cursor-pointer'
          : 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400 hover:bg-green-200 dark:hover:bg-green-900/50 cursor-pointer') }}">
                    {{ $contribution->is_selected ? 'Revoke Approval' : 'Approve for Publication' }}
                  </button>
                </form>
              </div>
            </div>
          </div>
      @endif

      {{-- Comments --}}
      <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mb-6">
        <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-4">Comments</h3>

        @forelse($contribution->comments as $comment)
          <div class="mb-4 p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg border border-gray-100 dark:border-gray-700">
            <div class="flex items-center justify-between mb-2">
              <div class="flex items-center gap-2">
                <div
                  class="w-7 h-7 bg-[#dc2d3d] rounded-full flex items-center justify-center text-white text-xs font-bold shrink-0">
                  {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                </div>
                <span class="text-sm font-semibold text-gray-700 dark:text-gray-300">{{ $comment->user->name }}</span>
              </div>
              <span
                class="text-xs text-gray-400 dark:text-gray-500">{{ $comment->created_at->format('d M Y, H:i') }}</span>
            </div>
            <p class="text-sm text-gray-700 dark:text-gray-300 whitespace-pre-line pl-9">{{ $comment->content }}</p>
          </div>
        @empty
          <p class="text-sm text-gray-400 dark:text-gray-500">No comments yet.</p>
        @endforelse

        @if($canComment)
          <form action="{{ route('contributions.comment', $contribution) }}" method="POST" class="mt-4 space-y-3">
            @csrf
            <textarea name="content" rows="3" placeholder="Write a comment..."
              class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-[#dc2d3d] focus:border-transparent @error('content') border-red-500 @enderror"></textarea>
            @error('content')<p class="text-xs text-red-500">{{ $message }}</p>@enderror
            <button type="submit"
              class="inline-flex items-center px-4 py-2 bg-[#dc2d3d] text-white text-sm font-medium rounded-lg hover:bg-[#b82532] transition-colors">
              Post Comment
            </button>
          </form>
        @endif
      </div>

      {{-- Report --}}
      @if($canReport)
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
          <h3 class="text-sm font-semibold text-red-600 dark:text-red-400 mb-1">Report this Contribution</h3>
          <p class="text-xs text-gray-500 dark:text-gray-400 mb-4">Report inappropriate, irrelevant, or incomplete
            content. An admin will be notified.</p>
          <form action="{{ route('contributions.report', $contribution) }}" method="POST" class="space-y-3">
            @csrf
            <textarea name="reason" rows="2" placeholder="Describe the issue..."
              class="w-full px-4 py-2.5 border dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-red-500 focus:border-transparent @error('reason') border-red-500 @enderror"></textarea>
            @error('reason')<p class="text-xs text-red-500">{{ $message }}</p>@enderror
            <button type="submit" onclick="return confirm('Submit this report to admin?')"
              class="inline-flex items-center px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition-colors">
              Submit Report
            </button>
          </form>
        </div>
      @endif

    </main>
  </div>

  @include('components.dashboard_scripts')
</body>

</html>