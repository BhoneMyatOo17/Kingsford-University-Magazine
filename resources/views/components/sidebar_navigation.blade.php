<!-- Sidebar Navigation -->
<aside id="sidebar" class="fixed left-0 top-0 h-screen w-64 
         overflow-y-auto no-scrollbar
         bg-white dark:bg-gray-800 
         border-r border-gray-200 dark:border-gray-700 
         z-40 transition-transform duration-300 
         lg:translate-x-0 -translate-x-full">

  <!-- Sidebar Header -->
  <div class="h-20 flex items-center justify-between px-6 border-b border-gray-200 dark:border-gray-700">
    <a href="{{ route('home') }}" class="flex items-center">
      <img src="{{ asset('assets/logo.png') }}" alt="Kingsford Logo" class="h-10 w-auto">
    </a>
    <button id="sidebar-close"
      class="lg:hidden text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
      </svg>
    </button>
  </div>

  <div class="px-4 py-4 border-b border-gray-200 dark:border-gray-700">
    <a href="{{ route('profile.show') }}"
      class="{{ request()->routeIs('profile.*') ? 'bg-gray-100 dark:bg-gray-700' : '' }} flex items-center space-x-3 hover:bg-gray-50 dark:hover:bg-gray-700/50 p-2 rounded-lg transition-colors">
      <div
        class="w-12 h-12 bg-[#dc2d3d] rounded-full flex items-center justify-center text-white font-bold text-lg flex-shrink-0">
        @if(auth()->user()->profile_picture)
          <img src="{{ app(\App\Services\StorageService::class)->profilePictureUrl($user->profile_picture) }}"
            alt="{{ auth()->user()->name }}" class="w-full h-full rounded-full object-cover">
        @else
          {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
        @endif
      </div>
      <div class="flex-1 min-w-0">
        <h3 class="text-lg text-gray-900 dark:text-white truncate">{{ auth()->user()->name }}</h3>
        <p class="text-sm text-gray-500 dark:text-gray-400 truncate">
          @if(auth()->user()->isStudent())
            Student
          @elseif(auth()->user()->isMarketingCoordinator())
            Coordinator
          @elseif(auth()->user()->isMarketingManager())
            Manager
          @elseif(auth()->user()->isAdmin())
            Admin
          @else
            Guest
          @endif
        </p>
      </div>
    </a>
  </div>
  <!-- Navigation Menu - Scrollable -->
  <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto h-[calc(130vh-280px)]">
    <!-- Dashboard -->
    <a href="{{ route('dashboard') }}"
      class="sidebar-link {{ request()->routeIs('dashboard') ? 'active bg-[#dc2d3d] text-white' : '' }} flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
      </svg>
      <span class="font-medium">Dashboard</span>
    </a>

    @if(auth()->user()->isStudent())
      <!-- My Contributions -->
      <a href="#"
        class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
        </svg>
        <span class="font-medium">My Contributions</span>
      </a>

      <!-- Submit Article -->
      <a href="#"
        class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        <span class="font-medium">Submit Article</span>
      </a>
    @endif

    <!-- Browse Magazine -->
    <a href="#"
      class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
      </svg>
      <span class="font-medium">Browse Magazine</span>
    </a>

    @if(auth()->user()->hasRole(['admin', 'marketing_manager']))
      <!-- Contact Requests (Admin/Manager) -->
      <a href="{{ route('contact.index') }}"
        class="sidebar-link {{ request()->routeIs('contact.index', 'contact.show', 'contact.edit') ? 'active bg-[#dc2d3d] text-white' : '' }} flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
        </svg>
        <span class="font-medium">Contact List</span>
        @php
          $pendingContacts = \App\Models\Contact::where('status', 'pending')->count();
        @endphp
        @if($pendingContacts > 0)
          <span class="ml-auto flex items-center justify-center
                       w-6 h-6
                       text-xs font-bold rounded-full
                       {{ request()->routeIs('contact.index', 'contact.show', 'contact.edit')
          ? 'bg-white text-[#dc2d3d]'
          : 'bg-[#dc2d3d] text-white' }}">
            {{ $pendingContacts }}
          </span>
        @endif
      </a>
    @else
      <!-- Contact Us (Students/Coordinators) -->
      <a href="{{ route('contact.create') }}"
        class="sidebar-link {{ request()->routeIs('contact.create') ? 'active bg-[#dc2d3d] text-white' : '' }} flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
        </svg>
        <span class="font-medium">Contact Us</span>
      </a>
    @endif

    @if(auth()->user()->isMarketingCoordinator() || auth()->user()->isMarketingManager())
      <!-- Divider -->
      <div class="pt-4 pb-2">
        <div class="border-t border-gray-200 dark:border-gray-700"></div>
      </div>

      <!-- Faculty Section (for Coordinators) -->
      <div class="space-y-2">
        <p class="px-4 text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Faculty Management
        </p>

        <a href="#"
          class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
          </svg>
          <span class="font-medium">Review Submissions</span>
        </a>

        <a href="#"
          class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
          </svg>
          <span class="font-medium">Pending Comments</span>
          <span class="ml-auto bg-[#dc2d3d] text-white text-xs font-bold px-2 py-1 rounded-full">3</span>
        </a>

        <a href="#"
          class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          <span class="font-medium">Selected Articles</span>
        </a>
      </div>
    @endif
    @if(auth()->user()->hasRole(['admin', 'marketing_manager']))

      <a href="{{ route('users.index') }}"
        class="sidebar-link {{ request()->routeIs('users.*') ? 'active bg-[#dc2d3d] text-white' : 'text-gray-700 dark:text-gray-300' }} flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
        </svg>
        <span class="font-medium">All Users</span>
      </a>
    @endif

    @if(auth()->user()->isMarketingManager() || auth()->user()->isAdmin())
      <!-- Divider -->
      <div class="pt-4 pb-2">
        <div class="border-t border-gray-200 dark:border-gray-700"></div>
      </div>

      <!-- Reports Section -->
      <div class="space-y-2">
        <p class="px-4 text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Reports &
          Analytics</p>

        <a href="#"
          class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
          </svg>
          <span class="font-medium">Statistics</span>
        </a>

        <a href="#"
          class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
          </svg>
          <span class="font-medium">Download Reports</span>
        </a>
      </div>
    @endif

    <!-- Divider -->
    <div class="pt-4 pb-2">
      <div class="border-t border-gray-200 dark:border-gray-700"></div>
    </div>


    <form action="{{ route('logout') }}" method="POST" id="logout-form">
      @csrf
      <button type="button" onclick="confirmLogout()"
        class="w-full sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
        </svg>
        <span class="font-medium">Logout</span>
      </button>
    </form>
    </div>
  </nav>
</aside>

<!-- Sidebar Overlay for Mobile -->
<div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 lg:hidden hidden"></div>

<!-- Logout Confirmation Modal -->
<div id="logout-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
  <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl max-w-md w-full p-6 transform transition-all">
    <div class="flex items-center justify-center w-12 h-12 mx-auto bg-red-100 dark:bg-red-900/30 rounded-full mb-4">
      <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
      </svg>
    </div>
    <h3 class="text-lg font-bold text-gray-900 dark:text-white text-center mb-2">Confirm Logout</h3>
    <p class="text-gray-600 dark:text-gray-400 text-center mb-6">Are you sure you want to logout? Any unsaved changes
      will be lost.</p>
    <div class="flex space-x-3">
      <button type="button" onclick="closeLogoutModal()"
        class="flex-1 px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors font-medium">
        Cancel
      </button>
      <button type="button" onclick="document.getElementById('logout-form').submit()"
        class="flex-1 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors font-medium">
        Logout
      </button>
    </div>
  </div>
</div>

<script>
  function confirmLogout() {
    document.getElementById('logout-modal').classList.remove('hidden');
  }

  function closeLogoutModal() {
    document.getElementById('logout-modal').classList.add('hidden');
  }

  // Close modal when clicking outside
  document.getElementById('logout-modal')?.addEventListener('click', function (e) {
    if (e.target === this) {
      closeLogoutModal();
    }
  });

  // Close modal with Escape key
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') {
      closeLogoutModal();
    }
  });
</script>