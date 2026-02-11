<!-- Navbar -->
<nav class="ic-navbar fixed top-0 left-0 right-0 w-full z-50 transition-all duration-300">
  <div class="container mx-auto px-4 py-4 lg:py-6">
    <div class="flex items-center justify-between">
      <!-- Logo -->
      <a href="{{ url('/') }}" class="ic-navbar-logo flex items-center ml-4 lg:ml-8">
        <img id="logo-white" src="{{ asset('assets/logo-white.png') }}" alt="Kingsford Logo" class="h-14 w-auto">
        <img id="logo-red" src="{{ asset('assets/logo.png') }}" alt="Kingsford Logo" class="h-14 w-auto hidden">
      </a>

      <!-- Mobile: Theme Toggle + Login/Dashboard + Hamburger -->
      <div class="flex items-center space-x-3 lg:hidden">
        <!-- Dark Mode Toggle Mobile -->
        <button id="theme-toggle-mobile"
          class="theme-toggle-btn text-white hover:text-gray-300 transition-colors duration-300">
          <svg id="theme-toggle-dark-icon-mobile" class="w-6 h-6 hidden" fill="currentColor" viewBox="0 0 20 20">
            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
          </svg>
          <svg id="theme-toggle-light-icon-mobile" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
            <path
              d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
              fill-rule="evenodd" clip-rule="evenodd"></path>
          </svg>
        </button>

        @auth
          <a href="{{ route('dashboard') }}"
            class="btn-navbar px-4 py-2 bg-white text-gray-900 font-semibold rounded-md hover:bg-gray-100 transition-all duration-300 text-sm">
            Dashboard
          </a>
        @else
          @if(request()->routeIs('login'))
            <a href="{{ route('register') }}"
              class="btn-navbar px-6 py-2.5 bg-white dark:bg-white text-gray-900 dark:text-gray-900 font-semibold rounded-md hover:bg-gray-100 dark:hover:bg-gray-100 transition-all duration-300">
              Register
            </a>
          @else
            <a href="{{ route('login') }}"
              class="btn-navbar px-6 py-2.5 bg-white dark:bg-white text-gray-900 dark:text-gray-900 font-semibold rounded-md hover:bg-gray-100 dark:hover:bg-gray-100 transition-all duration-300">
              Login
            </a>
          @endif

        @endauth
        <button class="ic-navbar-toggler text-white text-3xl">
          <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
        </button>
      </div>

      <!-- Desktop Menu -->
      <div class="ic-navbar-desktop hidden lg:flex items-center space-x-8">
        <a href="{{ route('about') }}"
          class="nav-link text-white dark:text-white hover:text-gray-300 dark:hover:text-gray-300 font-medium transition-colors duration-300">About
          Us</a>

        <!-- Faculties Dropdown -->
        <div class="relative group">
          <button
            class="faculties-dropdown-btn nav-link text-white dark:text-white hover:text-gray-300 dark:hover:text-gray-300 font-medium transition-colors ml-2 duration-300 flex items-center space-x-1">
            <span>Faculties</span>
            <svg class="w-4 h-4 transition-transform duration-300 group-hover:rotate-180" fill="none"
              stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
          </button>
          <div
            class="faculties-dropdown absolute left-1/2 transform -translate-x-1/2 mt-2 w-screen max-w-2xl bg-white dark:bg-gray-800 rounded-lg shadow-2xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 group-hover:translate-y-0 -translate-y-2 z-50">
            <div class="p-8">
              <p class="text-[#dc2d3d] text-m mb-3">Our faculties</p>
              <div class="grid grid-cols-3 gap-x-8 gap-y-4">
                <a href="#"
                  class="text-gray-700 dark:text-gray-300 hover:text-[#dc2d3d] dark:hover:text-[#dc2d3d] transition-colors duration-200 font-medium">Software
                  Engineering</a>
                <a href="#"
                  class="text-gray-700 dark:text-gray-300 hover:text-[#dc2d3d] dark:hover:text-[#dc2d3d] transition-colors duration-200 font-medium">Computer
                  Network</a>
                <a href="#"
                  class="text-gray-700 dark:text-gray-300 hover:text-[#dc2d3d] dark:hover:text-[#dc2d3d] transition-colors duration-200 font-medium">Computer
                  Science</a>
                <a href="#"
                  class="text-gray-700 dark:text-gray-300 hover:text-[#dc2d3d] dark:hover:text-[#dc2d3d] transition-colors duration-200 font-medium">Cybersecurity</a>
                <a href="#"
                  class="text-gray-700 dark:text-gray-300 hover:text-[#dc2d3d] dark:hover:text-[#dc2d3d] transition-colors duration-200 font-medium">Data
                  Science & AI</a>
                <a href="#"
                  class="text-gray-700 dark:text-gray-300 hover:text-[#dc2d3d] dark:hover:text-[#dc2d3d] transition-colors duration-200 font-medium">Business
                  IT</a>
                <a href="#"
                  class="text-gray-700 dark:text-gray-300 hover:text-[#dc2d3d] dark:hover:text-[#dc2d3d] transition-colors duration-200 font-medium">FinTech</a>
                <a href="#"
                  class="text-gray-700 dark:text-gray-300 hover:text-[#dc2d3d] dark:hover:text-[#dc2d3d] transition-colors duration-200 font-medium">Information
                  Systems</a>
                <a href="#"
                  class="text-gray-700 dark:text-gray-300 hover:text-[#dc2d3d] dark:hover:text-[#dc2d3d] transition-colors duration-200 font-medium">Cloud
                  Computing</a>
              </div>
            </div>
          </div>
        </div>

        <a href="#magazine"
          class="ic-page-scroll nav-link text-white dark:text-white hover:text-gray-300 dark:hover:text-gray-300 font-medium transition-colors duration-300">Our
          Magazine</a>

        <!-- Dark Mode Toggle -->
        <button id="theme-toggle"
          class="theme-toggle-btn text-white dark:text-white hover:text-gray-300 dark:hover:text-gray-300 transition-colors duration-300">
          <svg id="theme-toggle-dark-icon" class="w-6 h-6 hidden" fill="currentColor" viewBox="0 0 20 20">
            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
          </svg>
          <svg id="theme-toggle-light-icon" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
            <path
              d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
              fill-rule="evenodd" clip-rule="evenodd"></path>
          </svg>
        </button>

        <!-- Login/Dashboard Button -->
        @auth
          <a href="{{ route('dashboard') }}"
            class="btn-navbar px-4 py-2 bg-white text-gray-900 font-semibold rounded-md hover:bg-gray-100 transition-all duration-300 text-sm">
            Dashboard
          </a>
        @else
          @if(request()->routeIs('login'))
            <a href="{{ route('register') }}"
              class="btn-navbar px-6 py-2.5 bg-white dark:bg-white text-gray-900 dark:text-gray-900 font-semibold rounded-md hover:bg-gray-100 dark:hover:bg-gray-100 transition-all duration-300">
              Register
            </a>
          @else
            <a href="{{ route('login') }}"
              class="btn-navbar px-6 py-2.5 bg-white dark:bg-white text-gray-900 dark:text-gray-900 font-semibold rounded-md hover:bg-gray-100 dark:hover:bg-gray-100 transition-all duration-300">
              Login
            </a>
          @endif

        @endauth
      </div>
    </div>

    <!-- Mobile Menu -->
    <div class="ic-navbar-mobile lg:hidden hidden mt-4 bg-white dark:bg-gray-800 rounded-lg shadow-xl p-6 space-y-4">
      <a href="{{ route('about') }}"
        class="block text-gray-700 dark:text-gray-300 hover:text-[#dc2d3d] font-medium transition-colors duration-300">About
        Us</a>

      <!-- Mobile Faculties Accordion -->
      <div>
        <button id="mobile-faculties-toggle"
          class="w-full text-left text-gray-700 dark:text-gray-300 hover:text-[#dc2d3d] font-semibold transition-colors duration-300 flex items-center justify-between">
          <span>Faculties</span>
          <svg class="w-5 h-5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
          </svg>
        </button>
        <div id="mobile-faculties-menu"
          class="hidden mt-3 ml-4 space-y-2 border-l-2 border-gray-200 dark:border-gray-700 pl-4">
          <a href="#"
            class="block text-gray-600 dark:text-gray-400 hover:text-[#dc2d3d] transition-colors duration-300 text-sm">Software
            Engineering</a>
          <a href="#"
            class="block text-gray-600 dark:text-gray-400 hover:text-[#dc2d3d] transition-colors duration-300 text-sm">Computer
            Network</a>
          <a href="#"
            class="block text-gray-600 dark:text-gray-400 hover:text-[#dc2d3d] transition-colors duration-300 text-sm">Computer
            Science</a>
          <a href="#"
            class="block text-gray-600 dark:text-gray-400 hover:text-[#dc2d3d] transition-colors duration-300 text-sm">Cybersecurity</a>
          <a href="#"
            class="block text-gray-600 dark:text-gray-400 hover:text-[#dc2d3d] transition-colors duration-300 text-sm">Data
            Science & AI</a>
          <a href="#"
            class="block text-gray-600 dark:text-gray-400 hover:text-[#dc2d3d] transition-colors duration-300 text-sm">Business
            IT</a>
          <a href="#"
            class="block text-gray-600 dark:text-gray-400 hover:text-[#dc2d3d] transition-colors duration-300 text-sm">FinTech</a>
          <a href="#"
            class="block text-gray-600 dark:text-gray-400 hover:text-[#dc2d3d] transition-colors duration-300 text-sm">Information
            Systems</a>
          <a href="#"
            class="block text-gray-600 dark:text-gray-400 hover:text-[#dc2d3d] transition-colors duration-300 text-sm">Cloud
            Computing</a>
        </div>
      </div>

      <a href="#magazine"
        class="ic-page-scroll block text-gray-700 dark:text-gray-300 hover:text-[#dc2d3d] font-medium transition-colors duration-300">Our
        Magazine</a>
    </div>
  </div>
</nav>