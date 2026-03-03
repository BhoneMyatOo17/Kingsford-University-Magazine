<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Kingsford University</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 dark:bg-[#18181b]">
    @include('components.sidebar_navigation')
    @include('components.top_navigation',['title' => 'My Profile'])

    <!-- Main Content -->
    <div class="lg:ml-64">
        <!-- Profile Content -->
        <main class="p-4 lg:p-8">
            @if (session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative dark:bg-green-900 dark:border-green-700 dark:text-green-200"
                    role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Profile Header Card -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden mb-8">
                <!-- Red Background Banner with Profile Picture and Name -->
                <div class="bg-[#dc2d3d] px-6 lg:px-8 py-5">
                    <div class="flex flex-col md:flex-row items-center md:items-center gap-6">
                        <!-- Profile Picture -->
                        <div
                            class="w-32 h-32 bg-white dark:bg-gray-700 rounded-full border-4 border-white flex items-center justify-center shadow-lg flex-shrink-0">
                            @if ($user->profile_picture)
                                <img src="{{ app(\App\Services\StorageService::class)->profilePictureUrl($user->profile_picture) }}" alt="{{ $user->name }}"
                                    class="w-full h-full rounded-full object-cover">
                            @else
                                <span class="text-4xl font-bold text-[#dc2d3d]">
                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                </span>
                            @endif
                        </div>

                        <!-- User Name in Red Section - Aligned with Profile Picture -->
                        <div class="flex-1 text-center md:text-left">
                            <h2 class="text-3xl lg:text-4xl font-bold text-white drop-shadow-lg">
                                {{ $user->name }}
                            </h2>
                            <p class="text-white/90 text-lg mt-1">
                                @if ($user->isStudent() && isset($student))
                                    {{ $student->program ?? '' }} @if($student->faculty) • {{ $student->faculty->name }} @endif
                                @elseif (!$user->isStudent() && isset($staff))
                                    {{ $staff->position ?? '' }} @if($staff->department) • {{ $staff->department }} @endif
                                @endif
                            </p>
                        </div>

                        <!-- Edit Button -->
                        <div class="flex-shrink-0">
                            <a href="{{ route('profile.edit') }}"
                                class="inline-flex items-center px-4 py-2 bg-white text-[#dc2d3d] rounded-lg hover:bg-gray-100 transition-colors font-medium shadow-lg">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Edit Profile
                            </a>
                        </div>
                    </div>
                </div>

                <!-- White Section with User Info -->
                <div class="px-6 lg:px-8 py-6">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                        <div>
                            <p class="text-gray-600 dark:text-gray-400 text-lg mb-2">{{ $user->email }}</p>
                            <div class="flex flex-wrap gap-2">
                                @if ($user->isStudent())
                                    <span
                                        class="px-3 py-1 text-sm bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200 rounded-full">
                                        Student
                                    </span>
                                @elseif ($user->isMarketingCoordinator())
                                    <span
                                        class="px-3 py-1 text-sm bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 rounded-full">
                                        Marketing Coordinator
                                    </span>
                                @elseif ($user->isMarketingManager())
                                    <span
                                        class="px-3 py-1 text-sm bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200 rounded-full">
                                        Marketing Manager
                                    </span>
                                @elseif ($user->isAdmin())
                                    <span
                                        class="px-3 py-1 text-sm bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200 rounded-full">
                                        Administrator
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Student Statistics (Only for Students) -->
            @if ($user->isStudent() && isset($stats))
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Total Contributions</p>
                                <h3 class="text-3xl font-bold text-gray-900 dark:text-white">
                                    {{ $stats['total_contributions'] }}
                                </h3>
                            </div>
                            <div
                                class="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Approved</p>
                                <h3 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $stats['approved'] }}
                                </h3>
                            </div>
                            <div
                                class="w-12 h-12 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">Published</p>
                                <h3 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $stats['published'] }}
                                </h3>
                            </div>
                            <div
                                class="w-12 h-12 bg-[#dc2d3d]/10 dark:bg-[#dc2d3d]/20 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-[#dc2d3d]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Profile Details -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Personal Information -->
                <div class="lg:col-span-2">
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6">Personal Information</h3>

                        <div class="space-y-4">
                            <div
                                class="flex flex-col sm:flex-row sm:items-center py-3 border-b border-gray-200 dark:border-gray-700">
                                <span class="text-sm font-medium text-gray-500 dark:text-gray-400 w-40">Full
                                    Name:</span>
                                <span class="text-gray-900 dark:text-white mt-1 sm:mt-0">{{ $user->name }}</span>
                            </div>

                            <div
                                class="flex flex-col sm:flex-row sm:items-center py-3 border-b border-gray-200 dark:border-gray-700">
                                <span class="text-sm font-medium text-gray-500 dark:text-gray-400 w-40">Email:</span>
                                <span class="text-gray-900 dark:text-white mt-1 sm:mt-0">{{ $user->email }}</span>
                            </div>

                            @if ($user->isStudent() && isset($student))
                                <div
                                    class="flex flex-col sm:flex-row sm:items-center py-3 border-b border-gray-200 dark:border-gray-700">
                                    <span class="text-sm font-medium text-gray-500 dark:text-gray-400 w-40">Student
                                        ID:</span>
                                    <span
                                        class="text-gray-900 dark:text-white mt-1 sm:mt-0">{{ $student->student_id }}</span>
                                </div>

                                <div
                                    class="flex flex-col sm:flex-row sm:items-center py-3 border-b border-gray-200 dark:border-gray-700">
                                    <span class="text-sm font-medium text-gray-500 dark:text-gray-400 w-40">Faculty:</span>
                                    <span
                                        class="text-gray-900 dark:text-white mt-1 sm:mt-0">{{ $student->faculty->name ?? 'N/A' }}</span>
                                </div>

                                <div
                                    class="flex flex-col sm:flex-row sm:items-center py-3 border-b border-gray-200 dark:border-gray-700">
                                    <span class="text-sm font-medium text-gray-500 dark:text-gray-400 w-40">Program:</span>
                                    <span class="text-gray-900 dark:text-white mt-1 sm:mt-0">{{ $student->program }}</span>
                                </div>

                                <div
                                    class="flex flex-col sm:flex-row sm:items-center py-3 border-b border-gray-200 dark:border-gray-700">
                                    <span class="text-sm font-medium text-gray-500 dark:text-gray-400 w-40">Enrollment
                                        Year:</span>
                                    <span
                                        class="text-gray-900 dark:text-white mt-1 sm:mt-0">{{ $student->enrollment_year }}</span>
                                </div>

                                <div
                                    class="flex flex-col sm:flex-row sm:items-center py-3 border-b border-gray-200 dark:border-gray-700">
                                    <span class="text-sm font-medium text-gray-500 dark:text-gray-400 w-40">Study
                                        Level:</span>
                                    <span
                                        class="text-gray-900 dark:text-white capitalize mt-1 sm:mt-0">{{ $student->study_level }}</span>
                                </div>

                                @if($student->phone)
                                    <div
                                        class="flex flex-col sm:flex-row sm:items-center py-3 border-b border-gray-200 dark:border-gray-700">
                                        <span class="text-sm font-medium text-gray-500 dark:text-gray-400 w-40">Phone:</span>
                                        <span class="text-gray-900 dark:text-white mt-1 sm:mt-0">{{ $student->phone }}</span>
                                    </div>
                                @endif

                                @if($student->address)
                                    <div
                                        class="flex flex-col sm:flex-row sm:items-start py-3 border-b border-gray-200 dark:border-gray-700">
                                        <span class="text-sm font-medium text-gray-500 dark:text-gray-400 w-40">Address:</span>
                                        <span class="text-gray-900 dark:text-white mt-1 sm:mt-0">{{ $student->address }}</span>
                                    </div>
                                @endif
                            @endif

                            @if (!$user->isStudent() && isset($staff))
                                <div
                                    class="flex flex-col sm:flex-row sm:items-center py-3 border-b border-gray-200 dark:border-gray-700">
                                    <span class="text-sm font-medium text-gray-500 dark:text-gray-400 w-40">Staff ID:</span>
                                    <span class="text-gray-900 dark:text-white mt-1 sm:mt-0">{{ $staff->staff_id }}</span>
                                </div>

                                @if ($staff->faculty)
                                    <div
                                        class="flex flex-col sm:flex-row sm:items-center py-3 border-b border-gray-200 dark:border-gray-700">
                                        <span class="text-sm font-medium text-gray-500 dark:text-gray-400 w-40">Faculty:</span>
                                        <span
                                            class="text-gray-900 dark:text-white mt-1 sm:mt-0">{{ $staff->faculty->name }}</span>
                                    </div>
                                @endif

                                <div
                                    class="flex flex-col sm:flex-row sm:items-center py-3 border-b border-gray-200 dark:border-gray-700">
                                    <span
                                        class="text-sm font-medium text-gray-500 dark:text-gray-400 w-40">Department:</span>
                                    <span
                                        class="text-gray-900 dark:text-white mt-1 sm:mt-0">{{ $staff->department ?? 'N/A' }}</span>
                                </div>

                                <div
                                    class="flex flex-col sm:flex-row sm:items-center py-3 border-b border-gray-200 dark:border-gray-700">
                                    <span class="text-sm font-medium text-gray-500 dark:text-gray-400 w-40">Position:</span>
                                    <span
                                        class="text-gray-900 dark:text-white mt-1 sm:mt-0">{{ $staff->position ?? 'N/A' }}</span>
                                </div>

                                @if ($staff->hire_date)
                                    <div
                                        class="flex flex-col sm:flex-row sm:items-center py-3 border-b border-gray-200 dark:border-gray-700">
                                        <span class="text-sm font-medium text-gray-500 dark:text-gray-400 w-40">Hire
                                            Date:</span>
                                        <span
                                            class="text-gray-900 dark:text-white mt-1 sm:mt-0">{{ $staff->hire_date->format('F d, Y') }}</span>
                                    </div>
                                @endif

                                @if($staff->phone)
                                    <div
                                        class="flex flex-col sm:flex-row sm:items-center py-3 border-b border-gray-200 dark:border-gray-700">
                                        <span class="text-sm font-medium text-gray-500 dark:text-gray-400 w-40">Phone:</span>
                                        <span class="text-gray-900 dark:text-white mt-1 sm:mt-0">{{ $staff->phone }}</span>
                                    </div>
                                @endif

                                @if($staff->office_location)
                                    <div
                                        class="flex flex-col sm:flex-row sm:items-center py-3 border-b border-gray-200 dark:border-gray-700">
                                        <span class="text-sm font-medium text-gray-500 dark:text-gray-400 w-40">Office:</span>
                                        <span
                                            class="text-gray-900 dark:text-white mt-1 sm:mt-0">{{ $staff->office_location }}</span>
                                    </div>
                                @endif
                            @endif

                            <div
                                class="flex flex-col sm:flex-row sm:items-center py-3 border-b border-gray-200 dark:border-gray-700">
                                <span class="text-sm font-medium text-gray-500 dark:text-gray-400 w-40">Member
                                    Since:</span>
                                <span
                                    class="text-gray-900 dark:text-white mt-1 sm:mt-0">{{ $user->created_at->format('F d, Y') }}</span>
                            </div>

                            @if ($user->last_login_at)
                                <div class="flex flex-col sm:flex-row sm:items-center py-3">
                                    <span class="text-sm font-medium text-gray-500 dark:text-gray-400 w-40">Last
                                        Login:</span>
                                    <span
                                        class="text-gray-900 dark:text-white mt-1 sm:mt-0">{{ $user->last_login_at->diffForHumans() }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div>
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6">Quick Actions</h3>

                        <div class="space-y-3">
                            <a href="{{ route('profile.edit') }}"
                                class="w-full flex items-center justify-between px-4 py-3 bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                                <span class="font-medium">Edit Profile</span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </a>

                            <a href="{{ route('password.request') }}"
                                class="w-full flex items-center justify-between px-4 py-3 bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                                <span class="font-medium">Change Password</span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </a>

                            <a href="{{ route('dashboard') }}"
                                class="w-full flex items-center justify-between px-4 py-3 bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                                <span class="font-medium">Back to Dashboard</span>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Account Status -->
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mt-6">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Account Status</h3>

                        <div class="space-y-3">
                            <div class="flex items-center justify-between py-2">
                                <span class="text-sm text-gray-600 dark:text-gray-400">Account Status</span>
                                @if ($user->is_active)
                                    <span
                                        class="px-2 py-1 text-xs bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 rounded-full font-medium">
                                        Active
                                    </span>
                                @else
                                    <span
                                        class="px-2 py-1 text-xs bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200 rounded-full font-medium">
                                        Inactive
                                    </span>
                                @endif
                            </div>

                            <div class="flex items-center justify-between py-2">
                                <span class="text-sm text-gray-600 dark:text-gray-400">Email Verified</span>
                                @if ($user->email_verified_at)
                                    <span
                                        class="px-2 py-1 text-xs bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200 rounded-full font-medium">
                                        Verified
                                    </span>
                                @else
                                    <span
                                        class="px-2 py-1 text-xs bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200 rounded-full font-medium">
                                        Pending
                                    </span>
                                @endif
                            </div>
                        </div>
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
                </div>
            </div>
        </footer>
    </div>

    @include('components.dashboard_scripts')
</body>

</html>
