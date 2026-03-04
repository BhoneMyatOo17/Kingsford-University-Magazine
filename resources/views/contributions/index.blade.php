<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contributions - Kingsford University</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 dark:bg-[#18181b]">
  @include('components.sidebar_navigation')
  @include('components.top_navigation', ['title' => 'Contributions'])

  <div class="lg:ml-64">
    <main class="p-4 lg:p-8">

      @if(session('success'))
        <div
          class="mb-6 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-200 px-4 py-3 rounded-lg flex items-center">
          <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd"
              d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
              clip-rule="evenodd" />
          </svg>
          <span>{{ session('success') }}</span>
        </div>
      @endif

      <div class="mb-6 flex flex-wrap items-start justify-between gap-4">
        <div>
          <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Contributions</h2>
          <p class="text-gray-600 dark:text-gray-400 mt-1">
            @if($isManager)
              Browse and download approved contributions
            @else
              Contributions submitted to your faculty's posts
            @endif
          </p>
        </div>
      </div>

      @php
        $statusColor = function ($status) {
          return match ($status) {
            'approved' => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400',
            'rejected' => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400',
            default => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400',
          };
        };
      @endphp

      {{-- ── MANAGER VIEW ── --}}
      @if($isManager)
        <div x-data="{ selected: [] }" x-init="$watch('selected', val => {
                            document.getElementById('download-ids').value = val.join(',');
                            document.getElementById('download-count').textContent = val.length;
                          })">

          {{-- Filter tabs + Download --}}
          <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="flex flex-wrap gap-2">
              @foreach(['approved' => 'Approved', 'all' => 'All', 'submitted' => 'Submitted', 'under_review' => 'Under Review', 'rejected' => 'Rejected'] as $val => $label)
                      @php
                        $active = $statusFilter === $val;
                        $mobileHidden = !in_array($val, ['approved', 'all']);
                      @endphp
                      <a href="{{ route('contributions.index', ['status' => $val]) }}"
                        class="{{ $mobileHidden ? 'hidden sm:inline-flex' : 'inline-flex' }} px-4 py-2 rounded-lg text-sm font-medium transition-colors
                                                                                                    {{ $active
                ? 'bg-[#dc2d3d] text-white shadow'
                : 'bg-white dark:bg-gray-800 text-gray-600 dark:text-gray-400 border border-gray-200 dark:border-gray-700 hover:border-[#dc2d3d] hover:text-[#dc2d3d]' }}">
                        {{ $label }}
                      </a>
              @endforeach
            </div>

            <form action="{{ route('contributions.download') }}" method="GET" class="flex items-center gap-3">
              <input type="hidden" name="ids" id="download-ids" value="">
              <span class="text-sm text-gray-500 dark:text-gray-400">
                <span id="download-count">0</span> selected
              </span>
              <button type="submit" :disabled="selected.length === 0"
                class="inline-flex items-center gap-2 px-4 py-2.5 bg-[#dc2d3d] text-white text-sm font-semibold rounded-lg hover:bg-[#b82532] transition-colors shadow disabled:opacity-40 disabled:cursor-not-allowed">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                </svg>
                Download ZIP
              </button>
            </form>
          </div>

          <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">

            {{-- Desktop table --}}
            <div class="hidden md:block overflow-x-auto">
              <table class="w-full">
                <thead class="bg-gray-50 dark:bg-gray-700">
                  <tr>
                    <th class="px-4 py-4 w-10">
                      <input type="checkbox" class="w-4 h-4 rounded border-gray-300 text-[#dc2d3d] focus:ring-[#dc2d3d]"
                        @change="selected = $event.target.checked ? {{ $contributions->pluck('id') }} : []">
                    </th>
                    <th
                      class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                      Title</th>
                    <th
                      class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                      Student</th>
                    <th
                      class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                      Post</th>
                    <th
                      class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                      Faculty</th>
                    <th
                      class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                      Status</th>
                    <th
                      class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                      Submitted</th>
                    <th
                      class="px-6 py-4 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                      Actions</th>
                  </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                  @forelse($contributions as $contribution)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                      <td class="px-4 py-4">
                        <input type="checkbox" :value="{{ $contribution->id }}" x-model="selected"
                          class="w-4 h-4 rounded border-gray-300 text-[#dc2d3d] focus:ring-[#dc2d3d]">
                      </td>
                      <td class="px-6 py-4">
                        <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $contribution->title }}</p>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <p class="text-sm text-gray-700 dark:text-gray-300">{{ $contribution->student->user->name }}</p>
                      </td>
                      <td class="px-6 py-4">
                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $contribution->post->title }}</p>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <span class="text-xs font-semibold text-[#dc2d3d]">{{ $contribution->post->faculty->code }}</span>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <span
                          class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusColor($contribution->status) }}">
                          {{ ucfirst(str_replace('_', ' ', $contribution->status)) }}
                        </span>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                        {{ $contribution->created_at->format('d M Y') }}
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap text-right">
                        <a href="{{ route('contributions.show', $contribution) }}"
                          class="text-[#dc2d3d] hover:text-[#b82532] fetch-link text-sm font-medium transition-colors">View</a>
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="8" class="px-6 py-12 text-center">
                        <svg class="mx-auto w-16 h-16 text-gray-400 dark:text-gray-600 mb-4" fill="none"
                          stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <p class="text-gray-500 dark:text-gray-400 text-lg font-medium">No contributions found</p>
                      </td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>

            {{-- Mobile card list --}}
            <div class="md:hidden divide-y divide-gray-200 dark:divide-gray-700">
              @forelse($contributions as $contribution)
                <div class="p-4">
                  {{-- Row 1: checkbox + title + view --}}
                  <div class="flex items-start gap-3 mb-2">
                    <input type="checkbox" :value="{{ $contribution->id }}" x-model="selected"
                      class="mt-0.5 w-4 h-4 rounded border-gray-300 text-[#dc2d3d] focus:ring-[#dc2d3d] shrink-0">
                    <p class="text-sm font-semibold text-gray-900 dark:text-white flex-1">{{ $contribution->title }}</p>
                    <a href="{{ route('contributions.show', $contribution) }}"
                      class="text-sm text-[#dc2d3d] fetch-link hover:text-[#b82532] font-medium shrink-0">View</a>
                  </div>
                  {{-- Row 2: student · faculty --}}
                  <p class="text-xs text-gray-500 dark:text-gray-400 mb-2 ml-7">
                    {{ $contribution->student->user->name }}
                    · <span class="font-semibold text-[#dc2d3d]">{{ $contribution->post->faculty->code }}</span>
                  </p>
                  {{-- Row 3: status + date --}}
                  <div class="flex items-center gap-2 ml-7">
                    <span class="px-2 py-0.5 text-xs font-semibold rounded-full {{ $statusColor($contribution->status) }}">
                      {{ ucfirst(str_replace('_', ' ', $contribution->status)) }}
                    </span>
                    <span
                      class="text-xs text-gray-400 dark:text-gray-500">{{ $contribution->created_at->format('d M Y') }}</span>
                  </div>
                </div>
              @empty
                <div class="p-8 text-center text-gray-500 dark:text-gray-400">No contributions found</div>
              @endforelse
            </div>

          </div>

        </div>{{-- end x-data --}}

      @else
        {{-- ── COORDINATOR / ADMIN VIEW ── --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">

          {{-- Desktop table --}}
          <div class="hidden md:block overflow-x-auto">
            <table class="w-full">
              <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                  <th
                    class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                    Title</th>
                  <th
                    class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                    Student</th>
                  <th
                    class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                    Post</th>
                  <th
                    class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                    Faculty</th>
                  <th
                    class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                    Status</th>
                  <th
                    class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                    Submitted</th>
                  <th
                    class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                    Selected</th>
                  <th
                    class="px-6 py-4 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                    Actions</th>
                </tr>
              </thead>
              <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($contributions as $contribution)
                  @php
                    $isOverdue = auth()->user()->isMarketingCoordinator()
                      && $contribution->comments->isEmpty()
                      && $contribution->created_at->lte(now()->subDays(14));
                  @endphp
                  <tr
                    class="transition-colors {{ $isOverdue ? 'bg-red-50 dark:bg-red-900/20 hover:bg-red-100 dark:hover:bg-red-900/30' : 'hover:bg-gray-50 dark:hover:bg-gray-700/50' }}">
                    <td class="px-6 py-4">
                      <p class="text-sm font-medium {{ $isOverdue ? 'text-[#dc2d3d]' : 'text-gray-900 dark:text-white' }}">
                        {{ $contribution->title }}</p>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <p class="text-sm text-gray-700 dark:text-gray-300">{{ $contribution->student->user->name }}</p>
                    </td>
                    <td class="px-6 py-4">
                      <p class="text-sm text-gray-600 dark:text-gray-400">{{ $contribution->post->title }}</p>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <span class="text-xs font-semibold text-[#dc2d3d]">{{ $contribution->post->faculty->code }}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <span
                        class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusColor($contribution->status) }}">
                        {{ ucfirst(str_replace('_', ' ', $contribution->status)) }}
                      </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                      {{ $contribution->created_at->format('d M Y') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      @if($contribution->is_selected)
                        <span class="text-green-600 dark:text-green-400 font-semibold text-sm">✓ Yes</span>
                      @else
                        <span class="text-gray-300 dark:text-gray-600 text-sm">—</span>
                      @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right">
                      <a href="{{ route('contributions.show', $contribution) }}"
                        class="text-[#dc2d3d] hover:text-[#b82532] fetch-link text-sm font-medium transition-colors">View</a>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="8" class="px-6 py-12 text-center">
                      <svg class="mx-auto w-16 h-16 text-gray-400 dark:text-gray-600 mb-4" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                      </svg>
                      <p class="text-gray-500 dark:text-gray-400 text-lg font-medium">No contributions found</p>
                    </td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>

          {{-- Mobile card list --}}
          <div class="md:hidden divide-y divide-gray-200 dark:divide-gray-700">
            @forelse($contributions as $contribution)
              @php
                $isOverdue = auth()->user()->isMarketingCoordinator()
                  && $contribution->comments->isEmpty()
                  && $contribution->created_at->lte(now()->subDays(14));
              @endphp
              <div class="p-4 {{ $isOverdue ? 'bg-red-50 dark:bg-red-900/20' : '' }}">
                {{-- Row 1: title + view --}}
                <div class="flex items-start justify-between gap-3 mb-1">
                  <p class="text-sm font-semibold {{ $isOverdue ? 'text-[#dc2d3d]' : 'text-gray-900 dark:text-white' }}">
                    {{ $contribution->title }}</p>
                  <a href="{{ route('contributions.show', $contribution) }}"
                    class="text-sm text-[#dc2d3d] hover:text-[#b82532] font-medium shrink-0">View</a>
                </div>
                {{-- Row 2: student · faculty --}}
                <p class="text-xs text-gray-500 dark:text-gray-400 mb-2">
                  {{ $contribution->student->user->name }}
                  · <span class="font-semibold text-[#dc2d3d]">{{ $contribution->post->faculty->code }}</span>
                </p>
                {{-- Row 3: status + selected + date --}}
                <div class="flex items-center gap-2 flex-wrap">
                  <span class="px-2 py-0.5 text-xs font-semibold rounded-full {{ $statusColor($contribution->status) }}">
                    {{ ucfirst(str_replace('_', ' ', $contribution->status)) }}
                  </span>
                  @if($contribution->is_selected)
                    <span class="text-xs font-semibold text-green-600 dark:text-green-400">✓ Selected</span>
                  @endif
                  <span
                    class="text-xs text-gray-400 dark:text-gray-500">{{ $contribution->created_at->format('d M Y') }}</span>
                </div>
              </div>
            @empty
              <div class="p-8 text-center text-gray-500 dark:text-gray-400">No contributions found</div>
            @endforelse
          </div>

        </div>
      @endif

      <div class="mt-4">{{ $contributions->links() }}</div>

    </main>
  </div>
  @include('components.fetch-loading')
  @include('components.dashboard_scripts')
</body>

</html>