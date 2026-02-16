<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Management - Kingsford University</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 dark:bg-[#18181b]">
  @include('components.sidebar_navigation')
  @include('components.top_navigation', ['title' => 'User Management'])

  <!-- Main Content -->
  <div class="lg:ml-64">
    <!-- Dashboard Content -->
    <main class="p-4 lg:p-8">
      <!-- Success/Error Messages -->
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

      @if(session('error'))
        <div
          class="mb-6 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-800 dark:text-red-200 px-4 py-3 rounded-lg flex items-center">
          <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd"
              d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
              clip-rule="evenodd" />
          </svg>
          <span>{{ session('error') }}</span>
        </div>
      @endif

      <!-- Header with Create Button -->
      <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
          <h2 class="text-2xl font-bold text-gray-900 dark:text-white">All Users</h2>
          <p class="text-gray-600 dark:text-gray-400 mt-1">Manage students, coordinators, and staff members</p>
        </div>

        @if(auth()->user()->hasRole('admin'))
          <a href="{{ route('users.create') }}"
            class="inline-flex items-center justify-center px-6 py-3 bg-[#dc2d3d] hover:text-white text-white font-semibold rounded-lg hover:bg-[#b82532] transition-all duration-300 shadow-lg hover:shadow-xl">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Create User
          </a>
        @endif
      </div>

      <!-- Stats Cards -->
      <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Total Users</p>
              <h3 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $users->count() }}</h3>
            </div>
            <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center">
              <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
              </svg>
            </div>
          </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Students</p>
              <h3 class="text-3xl font-bold text-gray-900 dark:text-white">
                {{ $users->filter(fn($u) => $u->hasRole('student'))->count() }}
              </h3>
            </div>
            <div class="w-12 h-12 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center">
              <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
              </svg>
            </div>
          </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
          <div class="flex items-center justify-between">
            <div>
              <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Coordinators</p>
              <h3 class="text-3xl font-bold text-gray-900 dark:text-white">
                {{ $users->filter(fn($u) => $u->hasRole('marketing_coordinator'))->count() }}
              </h3>
            </div>
            <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center">
              <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
              </svg>
            </div>
          </div>
        </div>

        @if(auth()->user()->hasRole('admin'))
          <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
              <div>
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Managers</p>
                <h3 class="text-3xl font-bold text-gray-900 dark:text-white">
                  {{ $users->filter(fn($u) => $u->hasRole('marketing_manager'))->count() }}
                </h3>
              </div>
              <div class="w-12 h-12 bg-orange-100 dark:bg-orange-900/30 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor"
                  viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
              </div>
            </div>
          </div>
        @endif
      </div>

      <!-- Users Table -->
      <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
          <table class="w-full">
            <div class="bg-gray-50 dark:bg-gray-700">
              <tr>
                <th
                  class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                  User</th>
                <th
                  class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                  Email</th>
                <th
                  class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                  Role</th>
                <th
                  class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                  Faculty</th>
                <th
                  class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                  Status</th>
                <th
                  class="px-6 py-4 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                  Last Login</th>
                @if(auth()->user()->hasRole('admin'))
                  <th
                    class="px-6 py-4 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                    Actions</th>
                @endif
              </tr>
            </div>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
              @forelse($users as $user)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                      @if($user->profile_picture)
                        <img src="{{ app(\App\Services\StorageService::class)->profilePictureUrl($user->profile_picture) }}" alt="{{ $user->name }}"
                          class="w-10 h-10 rounded-full object-cover">
                      @else
                        <div
                          class="w-10 h-10 bg-[#dc2d3d] rounded-full flex items-center justify-center text-white font-bold">
                          {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                      @endif
                      <div class="ml-4">
                        <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $user->name }}</div>
                        @if($user->student)
                          <div class="text-xs uppercase text-gray-500 dark:text-gray-400">{{ $user->student->student_id }}
                          </div>
                        @elseif($user->staff)
                          <div class="text-xs text-gray-500 dark:text-gray-400">{{ $user->staff->staff_id }}</div>
                        @endif
                      </div>
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900 dark:text-white">{{ $user->email }}</div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    @php
                      $role = $user->roles->first();
                      $roleColors = [
                        'student' => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400',
                        'marketing_coordinator' => 'bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-400',
                        'marketing_manager' => 'bg-orange-100 text-orange-800 dark:bg-orange-900/30 dark:text-orange-400',
                        'admin' => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400',
                        'guest' => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-400',
                      ];
                      $roleLabels = [
                        'student' => 'Student',
                        'marketing_coordinator' => 'Coordinator',
                        'marketing_manager' => 'Manager',
                        'admin' => 'Admin',
                        'guest' => 'Guest',
                      ];
                    @endphp
                    <span
                      class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $roleColors[$role->name] ?? 'bg-gray-100 text-gray-800' }}">
                      {{ $roleLabels[$role->name] ?? ucwords(str_replace('_', ' ', $role->name)) }}
                    </span>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900 dark:text-white">
                      @if($user->student && $user->student->faculty)
                        {{ $user->student->faculty->name }}
                      @elseif($user->staff && $user->staff->faculty)
                        {{ $user->staff->faculty->name }}
                      @else
                        <span class="text-gray-400 dark:text-gray-500">N/A</span>
                      @endif
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    @if($user->is_active)
                      <span
                        class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">
                        Active
                      </span>
                    @else
                      <span
                        class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400">
                        Inactive
                      </span>
                    @endif
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-400">
                    {{ $user->last_login_at ? $user->last_login_at->diffForHumans() : 'Never' }}
                  </td>
                  @if(auth()->user()->hasRole('admin'))
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                      <a href="{{ route('users.show', $user) }}"
                        class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 font-medium">
                        View
                      </a>
                    </td>
                  @endif
                </tr>
              @empty
                <tr>
                  <td colspan="{{ auth()->user()->hasRole('admin') ? '7' : '6' }}" class="px-6 py-12 text-center">
                    <div class="flex flex-col items-center justify-center">
                      <svg class="w-16 h-16 text-gray-400 dark:text-gray-600 mb-4" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                      </svg>
                      <p class="text-gray-500 dark:text-gray-400 text-lg font-medium">No users found</p>
                      <p class="text-gray-400 dark:text-gray-500 text-sm mt-1">Get started by creating a new user</p>
                    </div>
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </main>
  </div>

  @include('components.dashboard_scripts')
</body>

</html>