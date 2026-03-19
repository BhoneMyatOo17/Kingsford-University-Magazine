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
          <img src="{{ app(\App\Services\StorageService::class)->profilePictureUrl(auth()->user()->profile_picture) }}"
            alt="{{ auth()->user()->name }}" class="w-full h-full rounded-full object-cover">
        @else
          {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
        @endif
      </div>
      <div class="flex-1 min-w-0">
        <h3 class="text-lg text-gray-900 dark:text-white truncate">{{ auth()->user()->name }}</h3>
        <p class="text-sm text-gray-500 dark:text-gray-400 truncate">
          @if(auth()->user()->isStudent()) Student
          @elseif(auth()->user()->isMarketingCoordinator()) Coordinator
          @elseif(auth()->user()->isMarketingManager()) Manager
          @elseif(auth()->user()->isAdmin()) Admin
          @else Guest
          @endif
        </p>
      </div>
    </a>
  </div>

  <!-- Navigation Menu -->
  <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto h-[calc(130vh-280px)]">

    {{-- ================================ --}}
    {{-- GUEST --}}
    {{-- ================================ --}}
    @if(auth()->user()->isGuest())
      <a href="{{ route('analytics.faculty.show', auth()->user()->guest_faculty_id) }}"
        class="sidebar-link {{ request()->routeIs('analytics.faculty.show') ? 'active bg-[#dc2d3d] text-white' : '' }} flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
        </svg>
        <span class="font-medium">Faculty Report</span>
      </a>
      <a href="{{ route('contributions.index') }}"
        class="sidebar-link {{ request()->routeIs('contributions.*') ? 'active bg-[#dc2d3d] text-white' : '' }} flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
        </svg>
        <span class="font-medium">Selected Contributions</span>
      </a>
    @endif

    {{-- ================================ --}}
    {{-- STUDENT --}}
    {{-- ================================ --}}
    @if(auth()->user()->isStudent())
      <a href="{{ route('dashboard') }}"
        class="sidebar-link {{ request()->routeIs('dashboard') ? 'active bg-[#dc2d3d] text-white' : '' }} flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
        </svg>
        <span class="font-medium">Dashboard</span>
      </a>
      <a href="{{ route('posts.index') }}"
        class="sidebar-link {{ request()->routeIs('posts.*') || request()->routeIs('contributions.*') ? 'active bg-[#dc2d3d] text-white' : '' }} flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
        </svg>
        <span class="font-medium">Submission Posts</span>
      </a>
      <a href="{{ route('contact.create') }}"
        class="sidebar-link {{ request()->routeIs('contact.create') ? 'active bg-[#dc2d3d] text-white' : '' }} flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
        </svg>
        <span class="font-medium">Contact Us</span>
      </a>
    @endif

    {{-- ================================ --}}
    {{-- COORDINATOR --}}
    {{-- ================================ --}}
    @if(auth()->user()->isMarketingCoordinator())
      <a href="{{ route('dashboard') }}"
        class="sidebar-link {{ request()->routeIs('dashboard') ? 'active bg-[#dc2d3d] text-white' : '' }} flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
        </svg>
        <span class="font-medium">Dashboard</span>
      </a>
      <div class="pt-3 pb-1">
        <div class="border-t border-gray-200 dark:border-gray-700"></div>
        <p class="px-1 pt-3 text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Faculty
          Management</p>
      </div>
      <a href="{{ route('posts.index') }}"
        class="sidebar-link {{ request()->routeIs('posts.*') ? 'active bg-[#dc2d3d] text-white' : '' }} flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
        </svg>
        <span class="font-medium">Posts</span>
      </a>
      <a href="{{ route('contributions.index') }}"
        class="sidebar-link {{ request()->routeIs('contributions.*') ? 'active bg-[#dc2d3d] text-white' : '' }} flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
        </svg>
        <span class="font-medium">Submissions</span>
        @php
          $overdueCount = \App\Models\Contribution::whereDoesntHave('comments')
            ->whereHas('student', function ($q) {
              $faculty = auth()->user()->getFaculty();
              $q->where('faculty_id', $faculty?->id);
            })
            ->where('created_at', '<=', now()->subDays(14))
            ->whereNull('deleted_at')
            ->count();
        @endphp
        @if($overdueCount > 0)
          <span
            class="ml-auto flex items-center justify-center w-6 h-6 text-xs font-bold rounded-full {{ request()->routeIs('contributions.*') ? 'bg-white text-[#dc2d3d]' : 'bg-[#dc2d3d] text-white' }}">
            {{ $overdueCount }}
          </span>
        @endif
      </a>
      <a href="{{ route('guests.index') }}"
        class="sidebar-link {{ request()->routeIs('guests.*') ? 'active bg-[#dc2d3d] text-white' : '' }} flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
        </svg>
        <span class="font-medium">Guests</span>
      </a>
      <a href="{{ route('contact.create') }}"
        class="sidebar-link {{ request()->routeIs('contact.create') ? 'active bg-[#dc2d3d] text-white' : '' }} flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
        </svg>
        <span class="font-medium">Contact Us</span>
      </a>
    @endif

    {{-- ================================ --}}
    {{-- MARKETING MANAGER --}}
    {{-- ================================ --}}
    @if(auth()->user()->isMarketingManager())
      <a href="{{ route('dashboard') }}"
        class="sidebar-link {{ request()->routeIs('dashboard') ? 'active bg-[#dc2d3d] text-white' : '' }} flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
        </svg>
        <span class="font-medium">Dashboard</span>
      </a>
      <div class="pt-3 pb-1">
        <div class="border-t border-gray-200 dark:border-gray-700"></div>
        <p class="px-1 pt-3 text-xs font-semibold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Management
        </p>
      </div>
      <a href="{{ route('users.index') }}"
        class="sidebar-link {{ request()->routeIs('users.*') ? 'active bg-[#dc2d3d] text-white' : '' }} flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
        </svg>
        <span class="font-medium">All Users</span>
      </a>
      <a href="{{ route('posts.index') }}"
        class="sidebar-link {{ request()->routeIs('posts.*') ? 'active bg-[#dc2d3d] text-white' : '' }} flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
        </svg>
        <span class="font-medium">Posts</span>
      </a>
      <a href="{{ route('contributions.index') }}"
        class="sidebar-link {{ request()->routeIs('contributions.*') ? 'active bg-[#dc2d3d] text-white' : '' }} flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
        </svg>
        <span class="font-medium">All Contributions</span>
      </a>
      <a href="{{ route('magazine.index') }}"
        class="sidebar-link {{ request()->routeIs('magazine.*') ? 'active bg-[#dc2d3d] text-white' : '' }} flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
        </svg>
        <span class="font-medium">Magazine</span>
      </a>
      <a href="{{ route('academic-years.index') }}"
        class="sidebar-link {{ request()->routeIs('academic-years.*') ? 'active bg-[#dc2d3d] text-white' : '' }} flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
        </svg>
        <span class="font-medium">Academic Years</span>
      </a>
    @endif

    {{-- ================================ --}}
    {{-- ADMIN --}}
    {{-- ================================ --}}
    @if(auth()->user()->isAdmin())
      <a href="{{ route('dashboard') }}"
        class="sidebar-link {{ request()->routeIs('dashboard') ? 'active bg-[#dc2d3d] text-white' : '' }} flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
        </svg>
        <span class="font-medium">Dashboard</span>
      </a>

      @php
        $userMgmtActive = request()->routeIs('users.*') || request()->routeIs('faculty.*') || request()->routeIs('programs.*') || request()->routeIs('contact.*') || request()->routeIs('reports.*') || request()->routeIs('guests.*');
        $contributionActive = request()->routeIs('contributions.*') || request()->routeIs('posts.*') || request()->routeIs('academic-years.*') || request()->routeIs('magazine.*');
        $analyticsActive = request()->routeIs('analytics.*');
      @endphp

      <!-- Management Collapsible -->
      <button type="button" onclick="toggleAdminGroup('userMgmt')"
        class="w-full flex items-center justify-between px-4 py-3 rounded-lg transition-colors {{ $userMgmtActive ? 'bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
        <div class="flex items-center space-x-3">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
          </svg>
          <span class="font-medium">Management</span>
        </div>
        <svg id="userMgmt-chevron"
          class="w-4 h-4 transition-transform duration-200 {{ $userMgmtActive ? 'rotate-180' : '' }}" fill="none"
          stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
      </button>

      <div id="userMgmt-group" class="{{ $userMgmtActive ? '' : 'hidden' }} pl-3 space-y-1 mt-1">
        <a href="{{ route('users.index') }}"
          class="sidebar-link {{ request()->routeIs('users.*') ? 'active bg-[#dc2d3d] text-white' : 'text-gray-600 dark:text-gray-400' }} flex items-center space-x-3 px-4 py-2.5 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors text-sm">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
          </svg>
          <span class="font-medium">Users</span>
        </a>
        <a href="{{ route('guests.index') }}"
          class="sidebar-link {{ request()->routeIs('guests.*') ? 'active bg-[#dc2d3d] text-white' : 'text-gray-600 dark:text-gray-400' }} flex items-center space-x-3 px-4 py-2.5 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors text-sm">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
          </svg>
          <span class="font-medium">Guests</span>
        </a>
        <a href="{{ route('faculty.index') }}"
          class="sidebar-link {{ request()->routeIs('faculty.*') ? 'active bg-[#dc2d3d] text-white' : 'text-gray-600 dark:text-gray-400' }} flex items-center space-x-3 px-4 py-2.5 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors text-sm">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
          </svg>
          <span class="font-medium">Faculties</span>
        </a>
        <a href="{{ route('programs.index') }}"
          class="sidebar-link {{ request()->routeIs('programs.*') ? 'active bg-[#dc2d3d] text-white' : 'text-gray-600 dark:text-gray-400' }} flex items-center space-x-3 px-4 py-2.5 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors text-sm">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
          </svg>
          <span class="font-medium">Programs</span>
        </a>
        <a href="{{ route('contact.index') }}"
          class="sidebar-link {{ request()->routeIs('contact.*') ? 'active bg-[#dc2d3d] text-white' : 'text-gray-600 dark:text-gray-400' }} flex items-center space-x-3 px-4 py-2.5 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors text-sm">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
          </svg>
          <span class="font-medium">Contact List</span>
          @php $pendingContacts = \App\Models\Contact::where('status', 'pending')->count(); @endphp
          @if($pendingContacts > 0)
            <span
              class="ml-auto flex items-center justify-center w-6 h-6 text-xs font-bold rounded-full {{ request()->routeIs('contact.*') ? 'bg-white text-[#dc2d3d]' : 'bg-[#dc2d3d] text-white' }}">
              {{ $pendingContacts }}
            </span>
          @endif
        </a>
        <a href="{{ route('reports.index') }}"
          class="sidebar-link {{ request()->routeIs('reports.*') ? 'active bg-[#dc2d3d] text-white' : 'text-gray-600 dark:text-gray-400' }} flex items-center space-x-3 px-4 py-2.5 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors text-sm">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6H13l-1-1H5a2 2 0 00-2 2zm9-13.5V9" />
          </svg>
          <span class="font-medium">Reports</span>
          @php $pendingReports = \App\Models\Report::where('status', 'pending')->count(); @endphp
          @if($pendingReports > 0)
            <span
              class="ml-auto flex items-center justify-center w-6 h-6 text-xs font-bold rounded-full {{ request()->routeIs('reports.*') ? 'bg-white text-[#dc2d3d]' : 'bg-[#dc2d3d] text-white' }}">
              {{ $pendingReports }}
            </span>
          @endif
        </a>
      </div>

      <!-- Contributions Collapsible -->
      <button type="button" onclick="toggleAdminGroup('contributions')"
        class="w-full flex items-center justify-between px-4 py-3 rounded-lg transition-colors mt-1 {{ $contributionActive ? 'bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
        <div class="flex items-center space-x-3">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
          </svg>
          <span class="font-medium">Contributions</span>
        </div>
        <svg id="contributions-chevron"
          class="w-4 h-4 transition-transform duration-200 {{ $contributionActive ? 'rotate-180' : '' }}" fill="none"
          stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
      </button>

      <div id="contributions-group" class="{{ $contributionActive ? '' : 'hidden' }} pl-3 space-y-1 mt-1">
        <a href="{{ route('posts.index') }}"
          class="sidebar-link {{ request()->routeIs('posts.*') ? 'active bg-[#dc2d3d] text-white' : 'text-gray-600 dark:text-gray-400' }} flex items-center space-x-3 px-4 py-2.5 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors text-sm">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
          </svg>
          <span class="font-medium">Posts</span>
        </a>
        <a href="{{ route('contributions.index') }}"
          class="sidebar-link {{ request()->routeIs('contributions.*') ? 'active bg-[#dc2d3d] text-white' : 'text-gray-600 dark:text-gray-400' }} flex items-center space-x-3 px-4 py-2.5 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors text-sm">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
          </svg>
          <span class="font-medium">All Contributions</span>
        </a>
        <a href="{{ route('magazine.index') }}"
          class="sidebar-link {{ request()->routeIs('magazine.*') ? 'active bg-[#dc2d3d] text-white' : 'text-gray-600 dark:text-gray-400' }} flex items-center space-x-3 px-4 py-2.5 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors text-sm">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
          </svg>
          <span class="font-medium">Magazine</span>
        </a>
        <a href="{{ route('academic-years.index') }}"
          class="sidebar-link {{ request()->routeIs('academic-years.*') ? 'active bg-[#dc2d3d] text-white' : 'text-gray-600 dark:text-gray-400' }} flex items-center space-x-3 px-4 py-2.5 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors text-sm">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
          </svg>
          <span class="font-medium">Academic Years</span>
        </a>
      </div>

      <!-- Analytics Collapsible -->
      <button type="button" onclick="toggleAdminGroup('analytics')"
        class="w-full flex items-center justify-between px-4 py-3 rounded-lg transition-colors mt-1 {{ $analyticsActive ? 'bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
        <div class="flex items-center space-x-3">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
          </svg>
          <span class="font-medium">Analytics</span>
        </div>
        <svg id="analytics-chevron"
          class="w-4 h-4 transition-transform duration-200 {{ $analyticsActive ? 'rotate-180' : '' }}" fill="none"
          stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
      </button>

      <div id="analytics-group" class="{{ $analyticsActive ? '' : 'hidden' }} pl-3 space-y-1 mt-1">
        <a href="{{ route('analytics.contributions') }}"
          class="sidebar-link {{ request()->routeIs('analytics.contributions') ? 'active bg-[#dc2d3d] text-white' : 'text-gray-600 dark:text-gray-400' }} flex items-center space-x-3 px-4 py-2.5 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors text-sm">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
          </svg>
          <span class="font-medium">Contributions</span>
        </a>
        <a href="{{ route('analytics.users') }}"
          class="sidebar-link {{ request()->routeIs('analytics.users') ? 'active bg-[#dc2d3d] text-white' : 'text-gray-600 dark:text-gray-400' }} flex items-center space-x-3 px-4 py-2.5 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors text-sm">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
          </svg>
          <span class="font-medium">User Activity</span>
        </a>
        <a href="{{ route('analytics.faculty.index') }}"
          class="sidebar-link {{ request()->routeIs('analytics.faculty.*') ? 'active bg-[#dc2d3d] text-white' : 'text-gray-600 dark:text-gray-400' }} flex items-center space-x-3 px-4 py-2.5 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors text-sm">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
          </svg>
          <span class="font-medium">Faculty Reports</span>
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
  document.getElementById('logout-modal')?.addEventListener('click', function (e) {
    if (e.target === this) closeLogoutModal();
  });
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') closeLogoutModal();
  });

  function toggleAdminGroup(group) {
    const el = document.getElementById(group + '-group');
    const chevron = document.getElementById(group + '-chevron');
    el.classList.toggle('hidden');
    chevron.classList.toggle('rotate-180');
  }

  document.addEventListener('click', function (e) {
    const sidebar = document.getElementById('sidebar');
    if (!sidebar.contains(e.target)) {
      ['userMgmt', 'contributions', 'analytics'].forEach(function (group) {
        const el = document.getElementById(group + '-group');
        const chevron = document.getElementById(group + '-chevron');
        if (el && !el.classList.contains('hidden')) {
          const hasActive = el.querySelector('.active');
          if (!hasActive) {
            el.classList.add('hidden');
            chevron.classList.remove('rotate-180');
          }
        }
      });
    }
  });
</script>