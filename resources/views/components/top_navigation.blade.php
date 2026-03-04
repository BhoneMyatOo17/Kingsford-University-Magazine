<!-- Top Navigation Bar (Mobile & Desktop) -->
<header class="lg:ml-64 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 sticky top-0 z-20">
  <div class="px-4 lg:px-8 h-20 flex items-center">
    <div class="flex items-center justify-between w-full">
      <!-- Mobile Menu Toggle -->
      <button id="sidebar-toggle"
        class="lg:hidden text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
      </button>

      <!-- Page Title -->
      <h1 class="text-lg lg:text-2xl font-bold text-gray-900 dark:text-white">
        {{ $title ?? 'Dashboard' }}
      </h1>

      <!-- Right Side Actions -->
      <div class="flex items-center space-x-3 lg:space-x-4">
        <!-- Dark Mode Toggle -->
        <button id="theme-toggle-top"
          class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
          <svg id="theme-toggle-dark-icon-top" class="w-5 h-5 lg:w-6 lg:h-6 hidden" fill="currentColor"
            viewBox="0 0 20 20">
            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
          </svg>
          <svg id="theme-toggle-light-icon-top" class="w-5 h-5 lg:w-6 lg:h-6" fill="currentColor" viewBox="0 0 20 20">
            <path
              d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
              fill-rule="evenodd" clip-rule="evenodd"></path>
          </svg>
        </button>

        <!-- Notifications -->
        <div class="relative" id="notification-dropdown">
          <button id="notification-button"
            class="relative text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
            <svg class="w-5 h-5 lg:w-6 lg:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
            @if(auth()->user()->hasRole('marketing_coordinator') && isset($overdueContributions) && $overdueContributions->isNotEmpty())
              <span
                class="absolute top-0 right-0 block h-2 w-2 rounded-full bg-[#dc2d3d] ring-2 ring-white dark:ring-gray-800"></span>
            @endif
          </button>

          <!-- Notification Dropdown -->
          <div id="notification-menu"
            class="hidden absolute right-0 mt-2 w-80 bg-white dark:bg-gray-800 rounded-lg shadow-xl border border-gray-200 dark:border-gray-700 z-50">
            <!-- Header -->
            <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700">
              <div class="flex items-center justify-between">
                <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Notifications</h3>
                @if(auth()->user()->hasRole('marketing_coordinator') && isset($overdueContributions) && $overdueContributions->isNotEmpty())
                  <span class="bg-[#dc2d3d] text-white text-xs font-bold px-2 py-1 rounded-full">
                    {{ $overdueContributions->count() }}
                  </span>
                @endif
              </div>
            </div>

            <!-- Notification List -->
            <div class="max-h-96 overflow-y-auto">
              @if(auth()->user()->hasRole('marketing_coordinator') && isset($overdueContributions) && $overdueContributions->isNotEmpty())
                @foreach($overdueContributions as $contribution)
                  <a href="{{ route('contributions.show', $contribution) }}"
                    class="block px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors border-b border-gray-100 dark:border-gray-700">
                    <div class="flex items-start space-x-3">
                      <div
                        class="flex-shrink-0 w-10 h-10 bg-red-100 dark:bg-red-900/30 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-[#dc2d3d]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                      </div>
                      <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 dark:text-white">Comment Overdue</p>
                        <p class="text-xs text-gray-600 dark:text-gray-400 mt-1 truncate">
                          "{{ $contribution->title }}"
                        </p>
                        <p class="text-xs text-[#dc2d3d] mt-1">
                          Submitted {{ $contribution->created_at->diffForHumans() }} — no comment yet
                        </p>
                      </div>
                    </div>
                  </a>
                @endforeach
              @else
                <div class="px-4 py-6 text-center text-sm text-gray-500 dark:text-gray-400">
                  No new notifications
                </div>
              @endif
            </div>

            <!-- Footer -->
            <div class="px-4 py-3 border-t border-gray-200 dark:border-gray-700">
              @if(auth()->user()->hasRole('marketing_coordinator'))
                <a href="{{ route('contributions.index') }}"
                  class="text-sm text-[#dc2d3d] hover:text-[#b82532] font-medium block text-center">
                  View all contributions
                </a>
              @else
                <a href="#" class="text-sm text-[#dc2d3d] hover:text-[#b82532] font-medium block text-center">
                  View all notifications
                </a>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>