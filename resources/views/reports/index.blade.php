<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reports - Kingsford University</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 dark:bg-[#18181b]">
  @include('components.sidebar_navigation')
  @include('components.top_navigation', ['title' => 'Reports'])

  <div class="lg:ml-64">
    <main class="p-4 lg:p-8">

      <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Reported Contributions</h2>
        <p class="text-gray-600 dark:text-gray-400 mt-1">Review and resolve flagged content from users.</p>
      </div>

      @if(session('success'))
        <div class="mb-6 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-200 px-4 py-3 rounded-lg flex items-center gap-2">
          <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
          </svg>
          {{ session('success') }}
        </div>
      @endif

      {{-- Status filter tabs --}}
      <div class="flex flex-wrap gap-2 mb-6">
        @foreach([
          'all'       => ['label' => 'All',       'color' => 'gray'],
          'pending'   => ['label' => 'Pending',   'color' => 'yellow'],
          'reviewed'  => ['label' => 'Reviewed',  'color' => 'blue'],
          'resolved'  => ['label' => 'Resolved',  'color' => 'green'],
          'dismissed' => ['label' => 'Dismissed', 'color' => 'gray'],
        ] as $key => $tab)
          @php
            $active = request('status', 'all') === $key;
            $url = $key === 'all' ? route('reports.index') : route('reports.index', ['status' => $key]);
          @endphp
          <a href="{{ $url }}"
            class="inline-flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-medium transition-colors
              {{ $active
                ? 'bg-[#dc2d3d] text-white shadow'
                : 'bg-white dark:bg-gray-800 text-gray-600 dark:text-gray-400 border border-gray-200 dark:border-gray-700 hover:border-[#dc2d3d] hover:text-[#dc2d3d]' }}">
            {{ $tab['label'] }}
            <span class="text-xs {{ $active ? 'bg-white/20' : 'bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400' }} px-1.5 py-0.5 rounded-full">
              {{ $counts[$key] }}
            </span>
          </a>
        @endforeach
      </div>

      {{-- Reports table / cards --}}
      <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
        @if($reports->isEmpty())
          <div class="text-center py-16">
            <svg class="mx-auto w-12 h-12 text-gray-300 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <p class="text-gray-500 dark:text-gray-400 font-medium">No reports found</p>
            <p class="text-sm text-gray-400 dark:text-gray-500 mt-1">All clear for this filter.</p>
          </div>
        @else

          {{-- Desktop table --}}
          <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-sm">
              <thead>
                <tr class="border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700/50">
                  <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Contribution</th>
                  <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Reported By</th>
                  <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Reason</th>
                  <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                  <th class="text-left px-6 py-3 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Reported</th>
                  <th class="px-6 py-3"></th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                @foreach($reports as $report)
                  @php
                    $badge = match($report->status) {
                      'pending'   => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400',
                      'reviewed'  => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400',
                      'resolved'  => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400',
                      'dismissed' => 'bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-400',
                      default     => 'bg-gray-100 text-gray-600',
                    };
                  @endphp
                  <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition-colors">
                    <td class="px-6 py-4">
                      @if($report->reportable)
                        <p class="font-medium text-gray-900 dark:text-white truncate max-w-xs">
                          {{ $report->reportable->title ?? 'Unknown' }}
                        </p>
                        <p class="text-xs text-gray-400 mt-0.5">{{ $report->reportable->post->faculty->name ?? '—' }}</p>
                      @else
                        <span class="text-gray-400 italic">Deleted content</span>
                      @endif
                    </td>
                    <td class="px-6 py-4">
                      <p class="text-gray-900 dark:text-white">{{ $report->reportedBy->name ?? '—' }}</p>
                      <p class="text-xs text-gray-400">{{ $report->reportedBy->email ?? '' }}</p>
                    </td>
                    <td class="px-6 py-4">
                      <p class="text-gray-700 dark:text-gray-300 truncate max-w-xs">{{ $report->reason }}</p>
                    </td>
                    <td class="px-6 py-4">
                      <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $badge }}">
                        {{ ucfirst($report->status) }}
                      </span>
                    </td>
                    <td class="px-6 py-4 text-gray-500 dark:text-gray-400 whitespace-nowrap">
                      {{ $report->created_at->diffForHumans() }}
                    </td>
                    <td class="px-6 py-4 text-right">
                      <a href="{{ route('reports.edit', $report) }}"
                        class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium rounded-lg
                          {{ $report->status === 'pending'
                            ? 'bg-[#dc2d3d] text-white hover:bg-[#b82532] hover:text-white'
                            : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600' }}
                          transition-colors">
                        {{ $report->status === 'pending' ? 'Review' : 'View' }}
                      </a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>

          {{-- Mobile card list --}}
          <div class="md:hidden divide-y divide-gray-200 dark:divide-gray-700">
            @foreach($reports as $report)
              @php
                $badge = match($report->status) {
                  'pending'   => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400',
                  'reviewed'  => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400',
                  'resolved'  => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400',
                  'dismissed' => 'bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-400',
                  default     => 'bg-gray-100 text-gray-600',
                };
              @endphp
              <div class="p-4">
                {{-- Row 1: contribution title + action button --}}
                <div class="flex items-start justify-between gap-3 mb-1">
                  <div class="min-w-0">
                    @if($report->reportable)
                      <p class="text-sm font-semibold text-gray-900 dark:text-white truncate">
                        {{ $report->reportable->title ?? 'Unknown' }}
                      </p>
                      <p class="text-xs text-gray-400">{{ $report->reportable->post->faculty->name ?? '—' }}</p>
                    @else
                      <span class="text-sm text-gray-400 italic">Deleted content</span>
                    @endif
                  </div>
                  <a href="{{ route('reports.edit', $report) }}"
                    class="shrink-0 inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium rounded-lg
                      {{ $report->status === 'pending'
                        ? 'bg-[#dc2d3d] text-white hover:bg-[#b82532]'
                        : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600' }}
                      transition-colors">
                    {{ $report->status === 'pending' ? 'Review' : 'View' }}
                  </a>
                </div>

                {{-- Row 2: reported by --}}
                <p class="text-xs text-gray-500 dark:text-gray-400 mb-2">
                  {{ $report->reportedBy->name ?? '—' }}
                  @if($report->reportedBy?->email)
                    · {{ $report->reportedBy->email }}
                  @endif
                </p>

                {{-- Row 3: reason (truncated) --}}
                <p class="text-xs text-gray-600 dark:text-gray-300 truncate mb-2">{{ $report->reason }}</p>

                {{-- Row 4: status + date --}}
                <div class="flex items-center gap-2">
                  <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium {{ $badge }}">
                    {{ ucfirst($report->status) }}
                  </span>
                  <span class="text-xs text-gray-400 dark:text-gray-500">{{ $report->created_at->diffForHumans() }}</span>
                </div>
              </div>
            @endforeach
          </div>

          @if($reports->hasPages())
            <div class="px-6 py-4 border-t border-gray-100 dark:border-gray-700">
              {{ $reports->links() }}
            </div>
          @endif

        @endif
      </div>

    </main>
  </div>

  @include('components.dashboard_scripts')
</body>
</html>