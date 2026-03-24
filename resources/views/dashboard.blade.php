<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - Kingsford University</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 dark:bg-[#18181b]">
  @include('components.sidebar_navigation')
  @include('components.top_navigation', ['title' => 'Dashboard', 'overdueContributions' => $overdueContributions])

  <div class="lg:ml-64">
    <main class="p-4 lg:p-8">

      {{-- Welcome --}}
      <div class="mb-8">
        @if(auth()->user()->previous_login_at === null)
          <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">
            Welcome to Kingsford University, {{ auth()->user()->name }}!
          </h2>
          <p class="text-gray-600 dark:text-gray-400">Your account is ready. Start exploring the platform.</p>
        @else
          <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">
            Welcome back, {{ auth()->user()->name }}!
          </h2>
          <p class="text-gray-600 dark:text-gray-400">
            Last login: {{ auth()->user()->previous_login_at->format('d M Y \a\t H:i') }}
          </p>
        @endif
      </div>

      {{-- Coordinator: Overdue Alert Banner (count only) --}}
      @if(auth()->user()->hasRole('marketing_coordinator') && $overdueContributions->isNotEmpty())
        <div class="mb-8 bg-red-50 dark:bg-red-900/20 border border-[#dc2d3d] rounded-lg p-4">
          <div class="flex items-center justify-between">
            <div class="flex items-center gap-3">
              <svg class="w-5 h-5 text-[#dc2d3d] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
              </svg>
              <div>
                <h4 class="text-sm font-semibold text-[#dc2d3d]">
                  {{ $overdueContributions->count() }} {{ Str::plural('contribution', $overdueContributions->count()) }}
                  overdue for comment
                </h4>
                <p class="text-xs text-red-600 dark:text-red-400 mt-0.5">
                  These submissions have had no comment for over 14 days.
                </p>
              </div>
            </div>
            <a href="{{ route('contributions.index') }}"
              class="flex-shrink-0 px-4 py-2 bg-[#dc2d3d] text-white text-sm font-medium rounded-lg hover:bg-[#b82532] transition-colors">
              Review Now →
            </a>
          </div>
        </div>
      @endif

      {{-- Stats Cards --}}
      {{-- Stats Cards --}}
      @if(!empty($stats))
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">

          {{-- Card 1: Total Contributions --}}
          <div
            class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-4 hover:shadow-xl transition-all flex flex-col justify-between">
            <div class="flex items-center justify-between">
              <p class="text-xs text-gray-600 dark:text-gray-400">Total Contributions</p>
              <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor"
                  viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                </svg>
              </div>
            </div>
            <div class="mt-3">
              <h3 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['total'] }}</h3>
              <span class="text-xs text-gray-500 dark:text-gray-400">All submissions</span>
            </div>
          </div>

          {{-- Card 2: Pending / Overdue --}}
          <div
            class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-4 hover:shadow-xl transition-all flex flex-col justify-between
            {{ auth()->user()->hasRole('marketing_coordinator') && $overdueContributions->isNotEmpty() ? 'border border-[#dc2d3d]' : '' }}">
            <div class="flex items-center justify-between">
              <p class="text-xs text-gray-600 dark:text-gray-400">
                {{ auth()->user()->hasRole('marketing_coordinator') ? 'Overdue Comments' : 'Pending Review' }}
              </p>
              <div
                class="w-10 h-10 rounded-lg flex items-center justify-center
                {{ auth()->user()->hasRole('marketing_coordinator') && $overdueContributions->isNotEmpty() ? 'bg-red-100 dark:bg-red-900/30' : 'bg-yellow-100 dark:bg-yellow-900/30' }}">
                <svg
                  class="w-5 h-5 {{ auth()->user()->hasRole('marketing_coordinator') && $overdueContributions->isNotEmpty() ? 'text-[#dc2d3d]' : 'text-yellow-600 dark:text-yellow-400' }}"
                  fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
              </div>
            </div>
            <div class="mt-3">
              <h3
                class="text-2xl font-bold {{ auth()->user()->hasRole('marketing_coordinator') && $overdueContributions->isNotEmpty() ? 'text-[#dc2d3d]' : 'text-gray-900 dark:text-white' }}">
                {{ auth()->user()->hasRole('marketing_coordinator') ? $stats['overdue'] : $stats['pending'] }}
              </h3>
              @if(auth()->user()->hasRole('marketing_coordinator') && $overdueContributions->isNotEmpty())
                <span class="text-xs text-[#dc2d3d] font-medium">Action required</span>
              @else
                <span class="text-xs text-gray-500 dark:text-gray-400">Awaiting review</span>
              @endif
            </div>
          </div>

          {{-- Card 3: Approved --}}
          <div
            class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-4 hover:shadow-xl transition-all flex flex-col justify-between">
            <div class="flex items-center justify-between">
              <p class="text-xs text-gray-600 dark:text-gray-400">Approved</p>
              <div class="w-10 h-10 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor"
                  viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
              </div>
            </div>
            <div class="mt-3">
              <h3 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['approved'] }}</h3>
              <span class="text-xs text-green-600 dark:text-green-400 font-medium">{{ $stats['approval_rate'] }}% approval
                rate</span>
            </div>
          </div>

          {{-- Card 4: Selected --}}
          <div
            class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-4 hover:shadow-xl transition-all flex flex-col justify-between">
            <div class="flex items-center justify-between">
              <p class="text-xs text-gray-600 dark:text-gray-400">Selected</p>
              <div class="w-10 h-10 bg-[#dc2d3d]/10 dark:bg-[#dc2d3d]/20 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-[#dc2d3d]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                </svg>
              </div>
            </div>
            <div class="mt-3">
              <h3 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $stats['selected'] }}</h3>
              <span class="text-xs text-gray-500 dark:text-gray-400">Selected articles</span>
            </div>
          </div>

        </div>
      @endif

      {{-- Two Column Layout --}}
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- Recent Activity / Contributions --}}
        <div class="lg:col-span-2">
          <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
              <h3 class="text-xl font-bold text-gray-900 dark:text-white">Recent Contributions</h3>
              <a href="{{ route('contributions.index') }}"
                class="text-[#dc2d3d] hover:text-[#b82532] text-sm font-medium">View All</a>
            </div>

            {{-- Mobile Card View --}}
            <div class="block md:hidden divide-y divide-gray-200 dark:divide-gray-700">
              @forelse($recentContributions as $contribution)
                @php $status = $contribution->status; @endphp
                <div class="px-4 py-4 flex items-center justify-between gap-3">
                  <div class="min-w-0 flex-1">
                    <p class="text-sm font-medium text-gray-900 dark:text-white truncate">{{ $contribution->title }}</p>
                    @if(auth()->user()->hasRole('marketing_coordinator') || auth()->user()->hasRole('admin') || auth()->user()->hasRole('marketing_manager'))
                      <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">
                        {{ $contribution->student->user->name ?? '—' }}
                      </p>
                    @endif
                    <span
                      class="mt-1 inline-flex px-2 py-0.5 text-xs font-semibold rounded-full
                  {{ $status === 'approved' ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' : '' }}
                  {{ $status === 'rejected' ? 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400' : '' }}
                  {{ $status === 'under_review' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400' : '' }}
                  {{ $status === 'submitted' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400' : '' }}">
                      {{ ucfirst(str_replace('_', ' ', $status)) }}
                    </span>
                  </div>
                  <a href="{{ route('contributions.show', $contribution) }}"
                    class="flex-shrink-0 text-sm text-[#dc2d3d] hover:text-[#b82532] font-medium">View</a>
                </div>
              @empty
                <div class="px-4 py-10 text-center text-sm text-gray-500 dark:text-gray-400">No contributions yet.</div>
              @endforelse
            </div>

            {{-- Desktop Table View --}}
            <div class="hidden md:block overflow-x-auto">
              <table class="w-full">
                <thead class="bg-gray-50 dark:bg-gray-700">
                  <tr>
                    <th
                      class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                      Title</th>
                    @if(auth()->user()->hasRole('marketing_coordinator') || auth()->user()->hasRole('admin') || auth()->user()->hasRole('marketing_manager'))
                      <th
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                        Student</th>
                    @endif
                    <th
                      class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                      Status</th>
                    <th
                      class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                      Action</th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                  @forelse($recentContributions as $contribution)
                    @php $status = $contribution->status; @endphp
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                      <td class="px-6 py-4">
                        <div class="text-sm font-medium text-gray-900 dark:text-white truncate max-w-xs">
                          {{ $contribution->title }}
                        </div>
                      </td>
                      @if(auth()->user()->hasRole('marketing_coordinator') || auth()->user()->hasRole('admin') || auth()->user()->hasRole('marketing_manager'))
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-400">
                          {{ $contribution->student->user->name ?? '—' }}
                        </td>
                      @endif
                      <td class="px-6 py-4 whitespace-nowrap">
                        <span
                          class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                      {{ $status === 'approved' ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' : '' }}
                      {{ $status === 'rejected' ? 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400' : '' }}
                      {{ $status === 'under_review' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400' : '' }}
                      {{ $status === 'submitted' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400' : '' }}">
                          {{ ucfirst(str_replace('_', ' ', $status)) }}
                        </span>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="{{ route('contributions.show', $contribution) }}"
                          class="text-[#dc2d3d] hover:text-[#b82532]">View</a>
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="4" class="px-6 py-10 text-center text-sm text-gray-500 dark:text-gray-400">No
                        contributions yet.</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>

          </div>
        </div>

        {{-- Right Column --}}
        <div class="space-y-6">

          {{-- Quick Actions --}}
          <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Quick Actions</h3>
            <div class="space-y-3">
              @if(auth()->user()->hasRole('student'))
                <a href="{{ route('posts.index') }}"
                  class="w-full flex items-center justify-between px-4 py-3 bg-[#dc2d3d] text-white rounded-lg hover:bg-[#b82532] transition-colors">
                  <span class="font-medium">Submit New Article</span>
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                  </svg>
                </a>
              @endif
              @if(auth()->user()->hasRole('marketing_coordinator'))
                <a href="{{ route('contributions.index') }}"
                  class="w-full flex items-center justify-between px-4 py-3 bg-[#dc2d3d] text-white rounded-lg hover:bg-[#b82532] transition-colors">
                  <span class="font-medium">
                    Review Contributions
                    @if($overdueContributions->isNotEmpty())
                      <span class="ml-2 bg-white text-[#dc2d3d] text-xs font-bold px-2 py-0.5 rounded-full">
                        {{ $overdueContributions->count() }}
                      </span>
                    @endif
                  </span>
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                  </svg>
                </a>
              @endif
              @if(!auth()->user()->hasRole('student'))
                <a href="{{ route('contributions.index') }}"
                  class="w-full flex items-center justify-between px-4 py-3 bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                  <span class="font-medium">View All Contributions</span>
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                  </svg>
                </a>
              @endif
            </div>
          </div>

          {{-- Important Dates --}}
          @if($activeYear)
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
              <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-1">Important Dates</h3>
              <p class="text-xs text-gray-400 dark:text-gray-500 mb-4">{{ $activeYear->name }}</p>
              <div class="space-y-4">
                <div class="flex items-start space-x-3">
                  <div
                    class="w-12 h-12 bg-[#dc2d3d] rounded-lg flex flex-col items-center justify-center text-white flex-shrink-0">
                    <span
                      class="text-xs font-medium">{{ \Carbon\Carbon::parse($activeYear->closure_date)->format('M') }}</span>
                    <span
                      class="text-lg font-bold">{{ \Carbon\Carbon::parse($activeYear->closure_date)->format('d') }}</span>
                  </div>
                  <div>
                    <p class="font-medium text-gray-900 dark:text-white">Closure for New Entries</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Last day for submissions</p>
                    @if(\Carbon\Carbon::parse($activeYear->closure_date)->isPast())
                      <span class="text-xs text-red-500 font-medium">Closed</span>
                    @else
                      <span class="text-xs text-green-600 dark:text-green-400 font-medium">
                        {{ \Carbon\Carbon::parse($activeYear->closure_date)->diffForHumans() }}
                      </span>
                    @endif
                  </div>
                </div>

                <div class="flex items-start space-x-3">
                  <div
                    class="w-12 h-12 bg-blue-600 rounded-lg flex flex-col items-center justify-center text-white flex-shrink-0">
                    <span
                      class="text-xs font-medium">{{ \Carbon\Carbon::parse($activeYear->final_closure_date)->format('M') }}</span>
                    <span
                      class="text-lg font-bold">{{ \Carbon\Carbon::parse($activeYear->final_closure_date)->format('d') }}</span>
                  </div>
                  <div>
                    <p class="font-medium text-gray-900 dark:text-white">Final Closure Date</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400">No more updates allowed</p>
                    @if(\Carbon\Carbon::parse($activeYear->final_closure_date)->isPast())
                      <span class="text-xs text-red-500 font-medium">Closed</span>
                    @else
                      <span class="text-xs text-green-600 dark:text-green-400 font-medium">
                        {{ \Carbon\Carbon::parse($activeYear->final_closure_date)->diffForHumans() }}
                      </span>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          @endif

        </div>
      </div>

    </main>

    <footer class="bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 mt-12">
      <div class="px-4 lg:px-8 py-6">
        <div class="flex flex-col md:flex-row items-center justify-between">
          <p class="text-sm text-gray-600 dark:text-gray-400">© 2026 Kingsford University. All rights reserved.</p>
          <div class="flex items-center space-x-6 mt-4 md:mt-0">
            <a href="#" class="text-sm text-gray-600 dark:text-gray-400 hover:text-[#dc2d3d]">Privacy Policy</a>
            <a href="#" class="text-sm text-gray-600 dark:text-gray-400 hover:text-[#dc2d3d]">Terms of Service</a>
            <a href="#" class="text-sm text-gray-600 dark:text-gray-400 hover:text-[#dc2d3d]">Help Center</a>
          </div>
        </div>
      </div>
    </footer>
  </div>

  @include('components.dashboard_scripts')
</body>

</html>