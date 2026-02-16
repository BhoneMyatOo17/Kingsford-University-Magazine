<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile - Kingsford University</title>
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>

                    <!-- Page Title -->
                    <h1 class="text-xl lg:text-2xl font-bold text-gray-900 dark:text-white">Edit Profile</h1>

                    <!-- Right Side Actions -->
                    <div class="flex items-center space-x-4">
                        <!-- Dark Mode Toggle -->
                        <button id="theme-toggle-dashboard"
                            class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                            <svg id="theme-toggle-dark-icon-dashboard" class="w-6 h-6 hidden" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                            </svg>
                            <svg id="theme-toggle-light-icon-dashboard" class="w-6 h-6" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path
                                    d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                                    fill-rule="evenodd" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </header>

        <!-- Edit Profile Content -->
        <main class="p-4 lg:p-8">
            @if ($errors->any())
                <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative dark:bg-red-900 dark:border-red-700 dark:text-red-200"
                    role="alert">
                    <strong class="font-bold">Whoops!</strong>
                    <span class="block sm:inline">There were some problems with your input.</span>
                    <ul class="mt-2 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Main Profile Form -->
                    <div class="lg:col-span-2">
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6">Personal Information</h3>

                            <div class="space-y-6">
                                <!-- Full Name -->
                                <div>
                                    <label for="name"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Full Name <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                                        required
                                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-[#dc2d3d] focus:border-transparent dark:bg-gray-700 dark:text-white">
                                </div>

                                <!-- Email -->
                                <div>
                                    <label for="email"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        University Email <span class="text-red-500">*</span>
                                    </label>
                                    <input type="email" id="email" name="email"
                                        value="{{ old('email', $user->email) }}" required
                                        class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-[#dc2d3d] focus:border-transparent dark:bg-gray-700 dark:text-white">
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Must end with @ksf.it.com
                                    </p>
                                </div>

                                @if ($user->isStudent() && isset($student))
                                    <!-- Student ID (Read-only) -->
                                    <div>
                                        <label for="student_id"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                            Student ID
                                        </label>
                                        <input type="text" id="student_id" value="{{ $student->student_id }}" disabled
                                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-100 dark:bg-gray-600 dark:text-gray-300 cursor-not-allowed">
                                    </div>

                                    <!-- Faculty (Read-only for students) -->
                                    <div>
                                        <label for="faculty"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                            Faculty
                                        </label>
                                        <input type="text" id="faculty"
                                            value="{{ $student->faculty->name ?? 'N/A' }}" disabled
                                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-100 dark:bg-gray-600 dark:text-gray-300 cursor-not-allowed">
                                    </div>

                                    <!-- Program -->
                                    <div>
                                        <label for="program"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                            Program
                                        </label>
                                        <input type="text" id="program" name="program"
                                            value="{{ old('program', $student->program) }}"
                                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-[#dc2d3d] focus:border-transparent dark:bg-gray-700 dark:text-white">
                                    </div>

                                    <!-- Phone -->
                                    <div>
                                        <label for="phone"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                            Phone Number
                                        </label>
                                        <input type="tel" id="phone" name="phone"
                                            value="{{ old('phone', $student->phone ?? '') }}"
                                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-[#dc2d3d] focus:border-transparent dark:bg-gray-700 dark:text-white">
                                    </div>

                                    <!-- Address -->
                                    <div>
                                        <label for="address"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                            Address
                                        </label>
                                        <textarea id="address" name="address" rows="3"
                                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-[#dc2d3d] focus:border-transparent dark:bg-gray-700 dark:text-white">{{ old('address', $student->address ?? '') }}</textarea>
                                    </div>
                                @endif

                                @if (!$user->isStudent() && isset($staff))
                                    <!-- Staff ID (Read-only) -->
                                    <div>
                                        <label for="staff_id"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                            Staff ID
                                        </label>
                                        <input type="text" id="staff_id" value="{{ $staff->staff_id }}" disabled
                                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-100 dark:bg-gray-600 dark:text-gray-300 cursor-not-allowed">
                                    </div>

                                    @if ($staff->faculty)
                                        <!-- Faculty (Read-only for coordinators) -->
                                        <div>
                                            <label for="faculty"
                                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                                Faculty
                                            </label>
                                            <input type="text" id="faculty" value="{{ $staff->faculty->name }}"
                                                disabled
                                                class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-100 dark:bg-gray-600 dark:text-gray-300 cursor-not-allowed">
                                        </div>
                                    @endif

                                    <!-- Department -->
                                    <div>
                                        <label for="department"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                            Department
                                        </label>
                                        <input type="text" id="department" name="department"
                                            value="{{ old('department', $staff->department ?? '') }}"
                                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-[#dc2d3d] focus:border-transparent dark:bg-gray-700 dark:text-white">
                                    </div>

                                    <!-- Position -->
                                    <div>
                                        <label for="position"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                            Position
                                        </label>
                                        <input type="text" id="position" name="position"
                                            value="{{ old('position', $staff->position ?? '') }}"
                                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-[#dc2d3d] focus:border-transparent dark:bg-gray-700 dark:text-white">
                                    </div>

                                    <!-- Phone -->
                                    <div>
                                        <label for="phone"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                            Phone Number
                                        </label>
                                        <input type="tel" id="phone" name="phone"
                                            value="{{ old('phone', $staff->phone ?? '') }}"
                                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-[#dc2d3d] focus:border-transparent dark:bg-gray-700 dark:text-white">
                                    </div>

                                    <!-- Office Location -->
                                    <div>
                                        <label for="office_location"
                                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                            Office Location
                                        </label>
                                        <input type="text" id="office_location" name="office_location"
                                            value="{{ old('office_location', $staff->office_location ?? '') }}"
                                            class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-[#dc2d3d] focus:border-transparent dark:bg-gray-700 dark:text-white">
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Profile Picture Upload -->
                    <div>
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6">Profile Picture</h3>

                            <!-- Current Profile Picture -->
                            <div class="mb-6">
                                <div
                                    class="w-32 h-32 mx-auto bg-gray-200 dark:bg-gray-700 rounded-full flex items-center justify-center overflow-hidden">
                                    @if ($user->profile_picture)
                                        <img id="preview-image" src="{{ app(\App\Services\StorageService::class)->profilePictureUrl($user->profile_picture) }}"
                                            alt="{{ $user->name }}" class="w-full h-full object-cover">
                                    @else
                                        <span id="preview-initials" class="text-4xl font-bold text-[#dc2d3d]">
                                            {{ strtoupper(substr($user->name, 0, 2)) }}
                                        </span>
                                        <img id="preview-image" src="" alt="" class="w-full h-full object-cover hidden">
                                    @endif
                                </div>
                            </div>

                            <!-- Upload New Picture -->
                            <div>
                                <label for="profile_picture"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Upload New Picture
                                </label>
                                <input type="file" id="profile_picture" name="profile_picture" accept="image/*"
                                    class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-[#dc2d3d] focus:border-transparent dark:bg-gray-700 dark:text-white">
                                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                    JPG, PNG or JPEG. Max 2MB.
                                </p>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mt-6">
                            <div class="space-y-3">
                                <button type="submit"
                                    class="w-full px-4 py-2 bg-[#dc2d3d] text-white rounded-lg hover:bg-[#b82532] transition-colors font-medium">
                                    Save Changes
                                </button>

                                <a href="{{ route('profile.show') }}"
                                    class="w-full block text-center px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors font-medium">
                                    Cancel
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
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

    <script>
        // Image preview
        document.getElementById('profile_picture').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const previewImage = document.getElementById('preview-image');
                    const previewInitials = document.getElementById('preview-initials');

                    previewImage.src = e.target.result;
                    previewImage.classList.remove('hidden');
                    if (previewInitials) {
                        previewInitials.classList.add('hidden');
                    }
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>

</html>