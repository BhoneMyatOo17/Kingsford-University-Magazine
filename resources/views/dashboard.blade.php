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

  <!-- Main Content -->
  <div class="lg:ml-64">
    <!-- Top Navigation Bar -->
    <header class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 sticky top-0 z-20">
      <div class="px-4 lg:px-8 py-4">
        <div class="flex items-center justify-between">
          <!-- Mobile Menu Toggle -->
          <button id="sidebar-toggle"
            class="lg:hidden text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
          </button>

          <!-- Page Title -->
          <h1 class="text-xl lg:text-2xl font-bold text-gray-900 dark:text-white">Dashboard</h1>

          <!-- Right Side Actions -->
          <div class="flex items-center space-x-4">
            <!-- Dark Mode Toggle -->
            <button id="theme-toggle-dashboard"
              class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
              <svg id="theme-toggle-dark-icon-dashboard" class="w-6 h-6 hidden" fill="currentColor" viewBox="0 0 20 20">
                <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
              </svg>
              <svg id="theme-toggle-light-icon-dashboard" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                <path
                  d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                  fill-rule="evenodd" clip-rule="evenodd"></path>
              </svg>
            </button>

            <!-- Notifications -->
            <button class="relative text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
              </svg>
              <span
                class="absolute top-0 right-0 block h-2 w-2 rounded-full bg-[#dc2d3d] ring-2 ring-white dark:ring-gray-800"></span>
            </button>
          </div>
        </div>
      </div>
    </header>

    <!-- Dashboard Content -->
    <main class="p-4 lg:p-8">
      <!-- Welcome Section -->
      <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Welcome back, John!</h2>
        <p class="text-gray-600 dark:text-gray-400">Here's what's happening with your magazine contributions.</p>
      </div>

      <!-- Stats Cards -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Card 1: Total Contributions -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 hover:shadow-xl transition-all">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Total Contributions</p>
              <h3 class="text-3xl font-bold text-gray-900 dark:text-white">12</h3>
            </div>
            <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center">
              <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
              </svg>
            </div>
          </div>
          <div class="mt-4 flex items-center text-sm">
            <span class="text-green-600 dark:text-green-400 font-medium">+2</span>
            <span class="text-gray-600 dark:text-gray-400 ml-2">this month</span>
          </div>
        </div>

        <!-- Card 2: Pending Review -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 hover:shadow-xl transition-all">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Pending Review</p>
              <h3 class="text-3xl font-bold text-gray-900 dark:text-white">3</h3>
            </div>
            <div class="w-12 h-12 bg-yellow-100 dark:bg-yellow-900/30 rounded-lg flex items-center justify-center">
              <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </div>
          </div>
          <div class="mt-4 flex items-center text-sm">
            <span class="text-gray-600 dark:text-gray-400">Awaiting comments</span>
          </div>
        </div>

        <!-- Card 3: Approved -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 hover:shadow-xl transition-all">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Approved</p>
              <h3 class="text-3xl font-bold text-gray-900 dark:text-white">7</h3>
            </div>
            <div class="w-12 h-12 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center">
              <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </div>
          </div>
          <div class="mt-4 flex items-center text-sm">
            <span class="text-green-600 dark:text-green-400 font-medium">58%</span>
            <span class="text-gray-600 dark:text-gray-400 ml-2">approval rate</span>
          </div>
        </div>

        <!-- Card 4: Selected for Publication -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 hover:shadow-xl transition-all">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Published</p>
              <h3 class="text-3xl font-bold text-gray-900 dark:text-white">5</h3>
            </div>
            <div class="w-12 h-12 bg-[#dc2d3d]/10 dark:bg-[#dc2d3d]/20 rounded-lg flex items-center justify-center">
              <svg class="w-6 h-6 text-[#dc2d3d]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
              </svg>
            </div>
          </div>
          <div class="mt-4 flex items-center text-sm">
            <span class="text-gray-600 dark:text-gray-400">Selected articles</span>
          </div>
        </div>
      </div>

      <!-- Two Column Layout -->
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Recent Activity -->
        <div class="lg:col-span-2">
          <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            <div class="flex items-center justify-between mb-6">
              <h3 class="text-xl font-bold text-gray-900 dark:text-white">Recent Activity</h3>
              <a href="#" class="text-[#dc2d3d] hover:text-[#b82532] text-sm font-medium">View All</a>
            </div>

            <div class="space-y-4">
              <!-- Activity Item 1 -->
              <div
                class="flex items-start space-x-4 p-4 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                <div
                  class="w-10 h-10 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center flex-shrink-0">
                  <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                </div>
                <div class="flex-1">
                  <p class="text-gray-900 dark:text-white font-medium">Article Approved</p>
                  <p class="text-sm text-gray-600 dark:text-gray-400">Your article "AI in Education" has been approved
                    by Dr. Smith</p>
                  <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">2 hours ago</p>
                </div>
              </div>

              <!-- Activity Item 2 -->
              <div
                class="flex items-start space-x-4 p-4 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                <div
                  class="w-10 h-10 bg-blue-100 dark:bg-blue-900/30 rounded-full flex items-center justify-center flex-shrink-0">
                  <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                  </svg>
                </div>
                <div class="flex-1">
                  <p class="text-gray-900 dark:text-white font-medium">New Comment Received</p>
                  <p class="text-sm text-gray-600 dark:text-gray-400">Marketing Coordinator commented on "Future of
                    Technology"</p>
                  <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">5 hours ago</p>
                </div>
              </div>

              <!-- Activity Item 3 -->
              <div
                class="flex items-start space-x-4 p-4 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                <div
                  class="w-10 h-10 bg-[#dc2d3d]/10 dark:bg-[#dc2d3d]/20 rounded-full flex items-center justify-center flex-shrink-0">
                  <svg class="w-5 h-5 text-[#dc2d3d]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                  </svg>
                </div>
                <div class="flex-1">
                  <p class="text-gray-900 dark:text-white font-medium">New Submission</p>
                  <p class="text-sm text-gray-600 dark:text-gray-400">You submitted "Sustainable Computing Practices"
                  </p>
                  <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">1 day ago</p>
                </div>
              </div>

              <!-- Activity Item 4 -->
              <div
                class="flex items-start space-x-4 p-4 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                <div
                  class="w-10 h-10 bg-yellow-100 dark:bg-yellow-900/30 rounded-full flex items-center justify-center flex-shrink-0">
                  <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                  </svg>
                </div>
                <div class="flex-1">
                  <p class="text-gray-900 dark:text-white font-medium">Deadline Reminder</p>
                  <p class="text-sm text-gray-600 dark:text-gray-400">Final closure date is in 7 days</p>
                  <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">2 days ago</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Quick Actions & Important Dates -->
        <div class="space-y-6">
          <!-- Quick Actions -->
          <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Quick Actions</h3>
            <div class="space-y-3">
              <button
                class="w-full flex items-center justify-between px-4 py-3 bg-[#dc2d3d] text-white rounded-lg hover:bg-[#b82532] transition-colors">
                <span class="font-medium">Submit New Article</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
              </button>

              <button
                class="w-full flex items-center justify-between px-4 py-3 bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                <span class="font-medium">Upload Images</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
              </button>

              <button
                class="w-full flex items-center justify-between px-4 py-3 bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                <span class="font-medium">View Magazine</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
              </button>
            </div>
          </div>

          <!-- Important Dates -->
          <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Important Dates</h3>
            <div class="space-y-4">
              <div class="flex items-start space-x-3">
                <div
                  class="w-12 h-12 bg-[#dc2d3d] rounded-lg flex flex-col items-center justify-center text-white flex-shrink-0">
                  <span class="text-xs font-medium">MAR</span>
                  <span class="text-lg font-bold">15</span>
                </div>
                <div>
                  <p class="font-medium text-gray-900 dark:text-white">Closure for New Entries</p>
                  <p class="text-sm text-gray-600 dark:text-gray-400">Last day for submissions</p>
                </div>
              </div>

              <div class="flex items-start space-x-3">
                <div
                  class="w-12 h-12 bg-blue-600 rounded-lg flex flex-col items-center justify-center text-white flex-shrink-0">
                  <span class="text-xs font-medium">MAR</span>
                  <span class="text-lg font-bold">31</span>
                </div>
                <div>
                  <p class="font-medium text-gray-900 dark:text-white">Final Closure Date</p>
                  <p class="text-sm text-gray-600 dark:text-gray-400">No more updates allowed</p>
                </div>
              </div>

              <div class="flex items-start space-x-3">
                <div
                  class="w-12 h-12 bg-green-600 rounded-lg flex flex-col items-center justify-center text-white flex-shrink-0">
                  <span class="text-xs font-medium">APR</span>
                  <span class="text-lg font-bold">15</span>
                </div>
                <div>
                  <p class="font-medium text-gray-900 dark:text-white">Magazine Publication</p>
                  <p class="text-sm text-gray-600 dark:text-gray-400">Annual magazine release</p>
                </div>
              </div>
            </div>
          </div>

          <!-- Terms & Conditions Status -->
          <div class="bg-gradient-to-r from-[#dc2d3d] to-[#b82532] rounded-lg shadow-lg p-6 text-white">
            <div class="flex items-center space-x-3 mb-3">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
              <h4 class="font-bold">Terms Accepted</h4>
            </div>
            <p class="text-sm text-white/90">You have agreed to the Terms and Conditions for article submission.</p>
          </div>
        </div>
      </div>

      <!-- Recent Contributions Table -->
      <div class="mt-8">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
          <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h3 class="text-xl font-bold text-gray-900 dark:text-white">Recent Contributions</h3>
          </div>
          <div class="overflow-x-auto">
            <table class="w-full">
              <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                  <th
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                    Title</th>
                  <th
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                    Submitted</th>
                  <th
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                    Status</th>
                  <th
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                    Comments</th>
                  <th
                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                    Actions</th>
                </tr>
              </thead>
              <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-gray-900 dark:text-white">AI in Education</div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-600 dark:text-gray-400">Feb 1, 2026</div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <span
                      class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">
                      Approved
                    </span>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-400">
                    1 comment
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <button class="text-[#dc2d3d] hover:text-[#b82532]">View</button>
                  </td>
                </tr>
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-gray-900 dark:text-white">Sustainable Computing</div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-600 dark:text-gray-400">Feb 5, 2026</div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <span
                      class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400">
                      Pending
                    </span>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-400">
                    No comments
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <button class="text-[#dc2d3d] hover:text-[#b82532]">View</button>
                  </td>
                </tr>
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-gray-900 dark:text-white">Future of Technology</div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-600 dark:text-gray-400">Jan 28, 2026</div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <span
                      class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">
                      Approved
                    </span>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-400">
                    2 comments
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <button class="text-[#dc2d3d] hover:text-[#b82532]">View</button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 mt-12">
      <div class="px-4 lg:px-8 py-6">
        <div class="flex flex-col md:flex-row items-center justify-between">
          <p class="text-sm text-gray-600 dark:text-gray-400">
            © 2026 Kingsford University. All rights reserved.
          </p>
          <div class="flex items-center space-x-6 mt-4 md:mt-0">
            <a href="#" class="text-sm text-gray-600 dark:text-gray-400 hover:text-[#dc2d3d]">Privacy Policy</a>
            <a href="#" class="text-sm text-gray-600 dark:text-gray-400 hover:text-[#dc2d3d]">Terms of Service</a>
            <a href="#" class="text-sm text-gray-600 dark:text-gray-400 hover:text-[#dc2d3d]">Help Center</a>
          </div>
        </div>
      </div>
    </footer>
  </div>

  <!-- Dashboard-specific JavaScript -->
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      // Sidebar toggle for mobile
      const sidebarToggle = document.getElementById('sidebar-toggle');
      const sidebarClose = document.getElementById('sidebar-close');
      const sidebar = document.getElementById('sidebar');
      const sidebarOverlay = document.getElementById('sidebar-overlay');

      if (sidebarToggle && sidebar && sidebarOverlay) {
        sidebarToggle.addEventListener('click', function () {
          sidebar.classList.remove('-translate-x-full');
          sidebarOverlay.classList.remove('hidden');
        });

        sidebarClose.addEventListener('click', function () {
          sidebar.classList.add('-translate-x-full');
          sidebarOverlay.classList.add('hidden');
        });

        sidebarOverlay.addEventListener('click', function () {
          sidebar.classList.add('-translate-x-full');
          sidebarOverlay.classList.add('hidden');
        });
      }

      // Sidebar active link
      const sidebarLinks = document.querySelectorAll('.sidebar-link');
      sidebarLinks.forEach(link => {
        link.addEventListener('click', function (e) {
          sidebarLinks.forEach(l => l.classList.remove('active'));
          this.classList.add('active');
        });
      });

      // Dashboard theme toggle
      const themeToggleDashboard = document.getElementById('theme-toggle-dashboard');
      const themeToggleDarkIconDashboard = document.getElementById('theme-toggle-dark-icon-dashboard');
      const themeToggleLightIconDashboard = document.getElementById('theme-toggle-light-icon-dashboard');

      function updateDashboardThemeIcons(isDark) {
        if (isDark) {
          themeToggleDarkIconDashboard?.classList.remove('hidden');
          themeToggleLightIconDashboard?.classList.add('hidden');
        } else {
          themeToggleLightIconDashboard?.classList.remove('hidden');
          themeToggleDarkIconDashboard?.classList.add('hidden');
        }
      }

      // Check initial theme
      if (document.documentElement.classList.contains('dark')) {
        updateDashboardThemeIcons(true);
      } else {
        updateDashboardThemeIcons(false);
      }

      // Theme toggle click
      if (themeToggleDashboard) {
        themeToggleDashboard.addEventListener('click', function () {
          const isDarkMode = document.documentElement.classList.contains('dark');

          if (isDarkMode) {
            document.documentElement.classList.remove('dark');
            document.documentElement.setAttribute('data-web-theme', 'light');
            localStorage.setItem('color-theme', 'light');
            updateDashboardThemeIcons(false);
          } else {
            document.documentElement.classList.add('dark');
            document.documentElement.setAttribute('data-web-theme', 'dark');
            localStorage.setItem('color-theme', 'dark');
            updateDashboardThemeIcons(true);
          }
        });
      }
    });
  </script>
</body>

</html>