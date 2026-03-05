<!-- Top Navigation Bar (Mobile & Desktop) -->
<meta name="csrf-token" content="{{ csrf_token() }}">
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
          <svg id="theme-toggle-dark-icon-top" class="w-5 h-5 lg:w-6 lg:h-6 hidden" fill="currentColor" viewBox="0 0 20 20">
            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
          </svg>
          <svg id="theme-toggle-light-icon-top" class="w-5 h-5 lg:w-6 lg:h-6" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path>
          </svg>
        </button>

        <!-- Notifications -->
        @php
          $unreadNotifications = auth()->user()->unreadNotifications;
          $unreadCount = $unreadNotifications->count();
          $recentRead = auth()->user()->readNotifications()->latest()->take(5)->get();
          $allNotifications = $unreadNotifications->concat($recentRead);
        @endphp

        <div class="relative" id="notification-dropdown">
          <button id="notification-button"
            class="relative text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
            <svg class="w-5 h-5 lg:w-6 lg:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
            @if($unreadCount > 0)
              <span id="bell-badge"
                class="absolute -top-1 -right-1 flex items-center justify-center h-4 w-4 rounded-full bg-[#dc2d3d] text-white text-[10px] font-bold ring-2 ring-white dark:ring-gray-800">
                {{ $unreadCount > 9 ? '9+' : $unreadCount }}
              </span>
            @endif
          </button>

          <!-- Notification Dropdown -->
          <div id="notification-menu"
            class="hidden absolute right-0 mt-2 w-80 bg-white dark:bg-gray-800 rounded-lg shadow-xl border border-gray-200 dark:border-gray-700 z-50">

            <!-- Header -->
            <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
              <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Notifications</h3>
              <div class="flex items-center space-x-2">
                @if($unreadCount > 0)
                  <span id="header-badge" class="bg-[#dc2d3d] text-white text-xs font-bold px-2 py-0.5 rounded-full">
                    {{ $unreadCount }}
                  </span>
                  <form method="POST" action="{{ route('notifications.read-all') }}">
                    @csrf
                    <button type="submit" class="text-xs text-gray-400 hover:text-[#dc2d3d] transition-colors">
                      Mark all read
                    </button>
                  </form>
                @endif
              </div>
            </div>

            <!-- Notification List -->
            <div class="max-h-96 overflow-y-auto divide-y divide-gray-100 dark:divide-gray-700">
              @forelse($allNotifications as $notification)
                @php $data = $notification->data; @endphp

                <a href="{{ $data['url'] ?? '#' }}"
                  data-notification-id="{{ $notification->id }}"
                  data-read="{{ $notification->read_at ? '1' : '0' }}"
                  class="notification-item flex items-start space-x-3 px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors {{ $notification->read_at ? 'opacity-60' : 'bg-blue-50/30 dark:bg-blue-900/10' }}">

                  <div class="flex-shrink-0 w-9 h-9 rounded-full flex items-center justify-center
                    @switch($data['event'] ?? '')
                      @case('new_submission') bg-blue-100 dark:bg-blue-900/30 @break
                      @case('overdue_submission') bg-red-100 dark:bg-red-900/30 @break
                      @case('commented') bg-blue-100 dark:bg-blue-900/30 @break
                      @case('approved') bg-green-100 dark:bg-green-900/30 @break
                      @case('rejected') bg-red-100 dark:bg-red-900/30 @break
                      @case('deadline_reminder') bg-yellow-100 dark:bg-yellow-900/30 @break
                      @case('final_closure_passed') bg-orange-100 dark:bg-orange-900/30 @break
                      @case('new_report') bg-red-100 dark:bg-red-900/30 @break
                      @case('new_contact') bg-purple-100 dark:bg-purple-900/30 @break
                      @case('admin_contact_response') bg-green-100 dark:bg-green-900/30 @break
                      @case('report_resolved') bg-green-100 dark:bg-green-900/30 @break
                      @case('magazine_published') bg-[#dc2d3d]/10 dark:bg-[#dc2d3d]/20 @break
                      @case('guest_account_created') bg-purple-100 dark:bg-purple-900/30 @break
                      @default bg-gray-100 dark:bg-gray-700 @break
                    @endswitch
                  ">
                    @switch($data['event'] ?? '')
                      @case('new_submission')
                      @case('commented')
                        <svg class="w-4 h-4 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                        </svg>
                        @break
                      @case('approved')
                      @case('report_resolved')
                      @case('admin_contact_response')
                        <svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        @break
                      @case('rejected')
                      @case('overdue_submission')
                      @case('new_report')
                        <svg class="w-4 h-4 text-[#dc2d3d]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                        @break
                      @case('deadline_reminder')
                      @case('final_closure_passed')
                        <svg class="w-4 h-4 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        @break
                      @case('magazine_published')
                        <svg class="w-4 h-4 text-[#dc2d3d]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                        @break
                      @default
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                    @endswitch
                  </div>

                  <div class="flex-1 min-w-0">
                    <p class="text-xs text-gray-800 dark:text-gray-200 leading-snug">
                      {{ $data['message'] ?? 'You have a new notification.' }}
                    </p>
                    <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">
                      {{ $notification->created_at->diffForHumans() }}
                    </p>
                  </div>
                </a>
              @empty
                <div class="px-4 py-8 text-center text-sm text-gray-500 dark:text-gray-400">
                  No new notifications
                </div>
              @endforelse
            </div>

            <!-- Footer -->
            <div class="px-4 py-3 border-t border-gray-200 dark:border-gray-700 text-center">
              <a href="{{ route('contributions.index') }}"
                class="text-xs text-[#dc2d3d] hover:text-[#b82532] font-medium">
                View all
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>