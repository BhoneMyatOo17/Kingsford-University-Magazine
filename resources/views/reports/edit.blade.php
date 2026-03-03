<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Resolve Report - Kingsford University</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 dark:bg-[#18181b]">
  @include('components.sidebar_navigation')
  @include('components.top_navigation', ['title' => 'Resolve Report'])

  <div class="lg:ml-64">
    <main class="p-4 lg:p-8">

      <div class="mb-6">
        <a href="{{ route('reports.index') }}"
          class="inline-flex items-center text-sm text-gray-600 dark:text-gray-400 hover:text-[#dc2d3d] transition-colors">
          <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
          </svg>
          Back to Reports
        </a>
      </div>

      <div class="mb-8 flex items-center justify-between">
        <div>
          <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Report #{{ $report->id }}</h2>
          <p class="text-gray-600 dark:text-gray-400 mt-1">Submitted {{ $report->created_at->format('d M Y, H:i') }}</p>
        </div>
        @php
          $badge = match ($report->status) {
            'pending' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400',
            'reviewed' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400',
            'resolved' => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400',
            'dismissed' => 'bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-400',
            default => 'bg-gray-100 text-gray-600',
          };
        @endphp
        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold {{ $badge }}">
          {{ ucfirst($report->status) }}
        </span>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Left: report details --}}
        <div class="lg:col-span-2 space-y-6">

          {{-- Report info --}}
          <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            <h3 class="text-base font-semibold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
              <svg class="w-4 h-4 text-[#dc2d3d]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
              </svg>
              Report Details
            </h3>
            <div class="space-y-4">
              <div>
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Reported By</p>
                <p class="text-gray-900 dark:text-white font-medium">{{ $report->reportedBy->name ?? '—' }}</p>
                <p class="text-sm text-gray-500">{{ $report->reportedBy->email ?? '' }}</p>
              </div>
              <div>
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Reason</p>
                <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-3">
                  <p class="text-sm text-red-800 dark:text-red-200">{{ $report->reason }}</p>
                </div>
              </div>
            </div>
          </div>

          {{-- Reported contribution --}}
          <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            <h3 class="text-base font-semibold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
              <svg class="w-4 h-4 text-[#dc2d3d]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
              </svg>
              Reported Contribution
            </h3>
            @if($report->reportable)
              <div class="space-y-3">
                <div>
                  <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Title</p>
                  <p class="text-gray-900 dark:text-white font-medium">{{ $report->reportable->title }}</p>
                </div>
                @if($report->reportable->description)
                  <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Description</p>
                    <p class="text-sm text-gray-700 dark:text-gray-300">{{ $report->reportable->description }}</p>
                  </div>
                @endif
                <div class="grid grid-cols-2 gap-4">
                  <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Student</p>
                    <p class="text-sm text-gray-900 dark:text-white">{{ $report->reportable->student->user->name ?? '—' }}
                    </p>
                  </div>
                  <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Faculty</p>
                    <p class="text-sm text-gray-900 dark:text-white">{{ $report->reportable->post->faculty->name ?? '—' }}
                    </p>
                  </div>
                  <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Post</p>
                    <p class="text-sm text-gray-900 dark:text-white">{{ $report->reportable->post->title ?? '—' }}</p>
                  </div>
                  <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Contribution Status</p>
                    <p class="text-sm text-gray-900 dark:text-white">
                      {{ ucfirst(str_replace('_', ' ', $report->reportable->status)) }}</p>
                  </div>
                </div>
                <div class="pt-2">
                  <a href="{{ route('contributions.show', $report->reportable) }}" target="_blank"
                    class="inline-flex items-center gap-1.5 text-sm text-[#dc2d3d] hover:underline font-medium">
                    View full contribution
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                  </a>
                </div>
              </div>
            @else
              <div class="text-center py-6">
                <p class="text-gray-400 italic">The reported content has been deleted.</p>
              </div>
            @endif
          </div>

          {{-- Resolution history --}}
          @if($report->resolvedBy)
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
              <h3 class="text-base font-semibold text-gray-900 dark:text-white mb-4">Resolution History</h3>
              <div class="flex items-start gap-3">
                <div
                  class="w-8 h-8 rounded-full bg-green-100 dark:bg-green-900/30 flex items-center justify-center flex-shrink-0">
                  <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                  </svg>
                </div>
                <div>
                  <p class="text-sm font-medium text-gray-900 dark:text-white">
                    {{ $report->resolvedBy->name }}
                    <span class="font-normal text-gray-500">updated this report</span>
                  </p>
                  @if($report->resolved_at)
                    <p class="text-xs text-gray-400 mt-0.5">{{ $report->resolved_at->format('d M Y, H:i') }}</p>
                  @endif
                  @if($report->resolution_note)
                    <p class="text-sm text-gray-700 dark:text-gray-300 mt-2 bg-gray-50 dark:bg-gray-700/50 rounded p-2">
                      {{ $report->resolution_note }}
                    </p>
                  @endif
                </div>
              </div>
            </div>
          @endif

        </div>

        {{-- Right: resolve form --}}
        <div class="space-y-6">
          <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            <h3 class="text-base font-semibold text-gray-900 dark:text-white mb-4">Update Status</h3>

            @if($errors->any())
              <div
                class="mb-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-800 dark:text-red-200 px-4 py-3 rounded-lg">
                <ul class="list-disc list-inside text-sm space-y-1">
                  @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif

            <form action="{{ route('reports.update', $report) }}" method="POST" class="space-y-4">
              @csrf
              @method('PUT')

              <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status</label>
                <select name="status"
                  class="w-full px-3 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-[#dc2d3d] focus:border-transparent">
                  @foreach(['pending' => 'Pending', 'reviewed' => 'Reviewed', 'resolved' => 'Resolved', 'dismissed' => 'Dismissed'] as $val => $label)
                    <option value="{{ $val }}" {{ $report->status === $val ? 'selected' : '' }}>{{ $label }}</option>
                  @endforeach
                </select>
              </div>

              <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                  Resolution Note
                  <span class="text-xs text-gray-400 font-normal ml-1">(optional)</span>
                </label>
                <textarea name="resolution_note" rows="5"
                  placeholder="Describe what action was taken or why this report was dismissed..."
                  class="w-full px-3 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-[#dc2d3d] focus:border-transparent resize-none">{{ old('resolution_note', $report->resolution_note) }}</textarea>
              </div>

              <div class="flex flex-col gap-2 pt-1">
                <button type="submit"
                  class="w-full px-4 py-2.5 bg-[#dc2d3d] text-white font-semibold rounded-lg hover:bg-[#b82532] transition-colors">
                  Update Report
                </button>
                <a href="{{ route('reports.index') }}"
                  class="w-full px-4 py-2.5 text-center bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 font-semibold rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                  Cancel
                </a>
              </div>
            </form>
          </div>
        </div>

      </div>
    </main>
  </div>

  @include('components.dashboard_scripts')
</body>

</html>