<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $user->name }} - User Details - Kingsford University</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 dark:bg-[#18181b]">
  @include('components.sidebar_navigation')
  @include('components.top_navigation', ['title' => 'User Details'])

  <!-- Main Content -->
  <div class="lg:ml-64">
    <main class="p-4 lg:p-8">
      <!-- SuccessMessage -->
      @if(session('success'))
        <div
          class="mb-6 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-200 px-4 py-3 rounded-lg flex items-center">
          <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd"
              d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
              clip-rule="evenodd" />
          </svg>
          {{ session('success') }}
        </div>
      @endif

      <!-- Back Button -->
      <div class="mb-6">
        <a href="{{ route('users.index') }}"
          class="inline-flex items-center text-gray-600 dark:text-gray-400 hover:text-[#dc2d3d] dark:hover:text-[#dc2d3d] transition-colors text-sm">
          <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
          </svg>
          Back to Users
        </a>
      </div>

      <!-- Profile Header -->
      <div class="bg-[#dc2d3d] dark:bg-gray-800 rounded-lg shadow-sm mb-6">
        <!-- Red Header Banner -->
        <div class="h-24 bg-[#dc2d3d] rounded-t-lg"></div>

        <!-- Profile Info -->
        <div class="px-8 pb-8">
          <div class="flex flex-col md:flex-row md:items-end md:justify-between -mt-16 mb-6">
            <div class="flex items-end space-x-5 mb-4 md:mb-0">
              <!-- Profile Picture -->
              @if($user->profile_picture)
                <img src="{{ Storage::url($user->profile_picture) }}" alt="{{ $user->name }}"
                  class="w-32 h-32 rounded-lg border-4 border-white dark:border-gray-800 object-cover shadow-lg">
              @else
                <div
                  class="w-32 h-32 bg-white rounded-lg border-4 border-gray-300 dark:border-gray-800 flex items-center justify-center text-[#dc2d3d] font-bold text-5xl shadow-lg">
                  {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
              @endif

              <!-- Name and Badges -->
              <div class="pb-2">
                <h1 class="text-3xl font-bold text-white dark:text-white mb-3">{{ $user->name }}</h1>
                <div class="flex flex-wrap items-center gap-2">
                  @php
                    $role = $user->roles->first();
                    $roleColors = [
                      'student' => 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400',
                      'marketing_coordinator' => 'bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-400',
                      'marketing_manager' => 'bg-orange-100 text-orange-700 dark:bg-orange-900/30 dark:text-orange-400',
                      'admin' => 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400',
                      'guest' => 'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-400',
                    ];
                  @endphp
                  <span
                    class="px-3 py-1 text-sm font-medium rounded-md {{ $roleColors[$role->name] ?? 'bg-gray-100 text-gray-700' }}">
                    {{ ucwords(str_replace('_', ' ', $role->name)) }}
                  </span>

                  @if($user->is_active)
                    <span
                      class="px-3 py-1 inline-flex items-center text-sm font-medium rounded-md bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400">
                      <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                      Active
                    </span>
                  @else
                    <span
                      class="px-3 py-1 inline-flex items-center text-sm font-medium rounded-md bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400">
                      <span class="w-2 h-2 bg-red-500 rounded-full mr-2"></span>
                      Inactive
                    </span>
                  @endif

                  @if($user->email_verified_at)
                    <span
                      class="px-3 py-1 inline-flex items-center text-sm font-medium rounded-md bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400">
                      <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                          d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                          clip-rule="evenodd" />
                      </svg>
                      Verified
                    </span>
                  @endif
                </div>
              </div>
            </div>

            <!-- Edit Button -->
            @if(auth()->user()->hasRole('admin'))
              <a href="{{ route('users.edit', $user) }}"
                class="inline-flex items-center px-5 py-2.5 bg-white hover:text-[#dc2d3d] hover:bg-slate-100 text-[#dc2d3d] font-medium rounded-lg transition-colors shadow-sm">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                Edit User
              </a>
            @endif
          </div>
        </div>
      </div>

      <!-- Information Cards -->
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Basic Information -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
          <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-6 flex items-center">
            <svg class="w-5 h-5 text-[#dc2d3d] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            Basic Information
          </h2>

          <div class="space-y-4">
            <div>
              <label class="block text-sm text-gray-500 dark:text-gray-400 mb-1">Email Address</label>
              <p class="text-base text-gray-900 dark:text-white">{{ $user->email }}</p>
            </div>

            <div>
              <label class="block text-sm text-gray-500 dark:text-gray-400 mb-1">Account Created</label>
              <p class="text-base text-gray-900 dark:text-white">{{ $user->created_at->format('M d, Y') }}</p>
            </div>

            <div>
              <label class="block text-sm text-gray-500 dark:text-gray-400 mb-1">Last Login</label>
              <p class="text-base text-gray-900 dark:text-white">
                {{ $user->last_login_at ? $user->last_login_at->format('M d, Y \a\t H:i') : 'Never' }}
              </p>
            </div>

            <div>
              <label class="block text-sm text-gray-500 dark:text-gray-400 mb-1">Password Status</label>
              @if($user->must_change_password)
                <span class="inline-flex items-center text-sm text-orange-700 dark:text-orange-400">
                  Temporary Password
                </span>
              @else
                <span class="inline-flex items-center text-sm text-green-700 dark:text-green-400">
                  Permanent Password
                </span>
              @endif
            </div>
          </div>
        </div>

        <!-- Student/Staff Information -->
        @if($user->isStudent() && $user->student)
          <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
            <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-6 flex items-center">
              <svg class="w-5 h-5 text-[#dc2d3d] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
              </svg>
              Student Information
            </h2>

            <div class="space-y-4">
              <div>
                <label class="block text-sm text-gray-500 dark:text-gray-400 mb-1">Student ID</label>
                <p class="text-base text-gray-900 dark:text-white font-mono uppercase">{{ $user->student->student_id }}
                </p>
              </div>

              <div>
                <label class="block text-sm text-gray-500 dark:text-gray-400 mb-1">Faculty</label>
                <p class="text-base text-gray-900 dark:text-white">
                  {{ $user->student->faculty ? $user->student->faculty->name : 'Not assigned' }}
                </p>
              </div>

              <div>
                <label class="block text-sm text-gray-500 dark:text-gray-400 mb-1">Program</label>
                <p class="text-base text-gray-900 dark:text-white">{{ $user->student->program }}</p>
              </div>

              <div class="grid grid-cols-2 gap-4">
                <div>
                  <label class="block text-sm text-gray-500 dark:text-gray-400 mb-1">Study Level</label>
                  <p class="text-base text-gray-900 dark:text-white capitalize">{{ $user->student->study_level }}</p>
                </div>

                <div>
                  <label class="block text-sm text-gray-500 dark:text-gray-400 mb-1">Enrollment Year</label>
                  <p class="text-base text-gray-900 dark:text-white">{{ $user->student->enrollment_year }}</p>
                </div>
              </div>

              @if($user->student->phone)
                <div>
                  <label class="block text-sm text-gray-500 dark:text-gray-400 mb-1">Phone</label>
                  <p class="text-base text-gray-900 dark:text-white">{{ $user->student->phone }}</p>
                </div>
              @endif

              @if($user->student->address)
                <div>
                  <label class="block text-sm text-gray-500 dark:text-gray-400 mb-1">Address</label>
                  <p class="text-base text-gray-900 dark:text-white">{{ $user->student->address }}</p>
                </div>
              @endif
            </div>
          </div>
        @elseif($user->staff)
          <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
            <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-6 flex items-center">
              <svg class="w-5 h-5 text-[#dc2d3d] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
              </svg>
              Staff Information
            </h2>

            <div class="space-y-4">
              <div>
                <label class="block text-sm text-gray-500 dark:text-gray-400 mb-1">Staff ID</label>
                <p class="text-base text-gray-900 dark:text-white font-mono uppercase">{{ $user->staff->staff_id }}</p>
              </div>

              @if($user->staff->faculty)
                <div>
                  <label class="block text-sm text-gray-500 dark:text-gray-400 mb-1">Faculty</label>
                  <p class="text-base text-gray-900 dark:text-white">{{ $user->staff->faculty->name }}</p>
                </div>
              @endif

              <div class="grid grid-cols-2 gap-4">
                <div>
                  <label class="block text-sm text-gray-500 dark:text-gray-400 mb-1">Department</label>
                  <p class="text-base text-gray-900 dark:text-white">{{ $user->staff->department ?? 'N/A' }}</p>
                </div>

                <div>
                  <label class="block text-sm text-gray-500 dark:text-gray-400 mb-1">Position</label>
                  <p class="text-base text-gray-900 dark:text-white">{{ $user->staff->position ?? 'N/A' }}</p>
                </div>
              </div>

              @if($user->staff->hire_date)
                <div>
                  <label class="block text-sm text-gray-500 dark:text-gray-400 mb-1">Hire Date</label>
                  <p class="text-base text-gray-900 dark:text-white">
                    {{ \Carbon\Carbon::parse($user->staff->hire_date)->format('M d, Y') }}
                  </p>
                </div>
              @endif

              @if($user->staff->phone)
                <div>
                  <label class="block text-sm text-gray-500 dark:text-gray-400 mb-1">Phone</label>
                  <p class="text-base text-gray-900 dark:text-white">{{ $user->staff->phone }}</p>
                </div>
              @endif

              @if($user->staff->office_location)
                <div>
                  <label class="block text-sm text-gray-500 dark:text-gray-400 mb-1">Office Location</label>
                  <p class="text-base text-gray-900 dark:text-white">{{ $user->staff->office_location }}</p>
                </div>
              @endif
            </div>
          </div>
        @endif
      </div>
    </main>
  </div>

  @include('components.dashboard_scripts')
</body>

</html>