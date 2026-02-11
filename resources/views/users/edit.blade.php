<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User - {{ $user->name }} - Kingsford University</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 dark:bg-[#18181b]">
    @include('components.sidebar_navigation')
    @include('components.top_navigation', ['title' => 'Edit User'])

    <!-- Main Content -->
    <div class="lg:ml-64">
        <main class="p-4 lg:p-8 max-w-4xl">
            <!-- Back Button -->
            <div class="mb-6">
                <a href="{{ route('users.show', $user) }}"
                    class="inline-flex items-center text-gray-600 dark:text-gray-400 hover:text-[#dc2d3d] dark:hover:text-[#dc2d3d] transition-colors text-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Back to User Details
                </a>
            </div>

            <form action="{{ route('users.update', $user) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Basic Information -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 mb-6">
                    <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-6 flex items-center">
                        <svg class="w-5 h-5 text-[#dc2d3d] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Basic Information
                    </h2>

                    <div class="space-y-5">
                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Full Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-[#dc2d3d] focus:border-transparent dark:bg-gray-700 dark:text-white">
                            @error('name')
                                <p class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Email Address <span class="text-red-500">*</span>
                            </label>
                            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                                class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-[#dc2d3d] focus:border-transparent dark:bg-gray-700 dark:text-white">
                            @error('email')
                                <p class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Profile Picture -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Profile Picture
                            </label>
                            <div class="flex items-center space-x-4">
                                <div class="flex-1">
                                    <input type="file" name="profile_picture" id="profile_picture" accept="image/jpeg,image/png,image/jpg"
                                        class="block w-full text-sm text-gray-500 dark:text-gray-400
                                            file:mr-4 file:py-2 file:px-4
                                            file:rounded-lg file:border-0
                                            file:text-sm file:font-semibold
                                            file:bg-[#dc2d3d] file:text-white
                                            hover:file:bg-[#b82532]
                                            file:cursor-pointer">
                                    <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">Max size: 2MB. Allowed: JPG, PNG</p>
                                </div>
                            </div>
                            @error('profile_picture')
                                <p class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Student/Staff Specific Information -->
                @if($user->isStudent() && $user->student)
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 mb-6">
                        <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-6 flex items-center">
                            <svg class="w-5 h-5 text-[#dc2d3d] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                            Student Information
                        </h2>

                        <div class="space-y-5">
                            <!-- Student ID (Read-only) -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Student ID
                                </label>
                                <input type="text" name="student_id" value="{{ $user->student->student_id }}"
                            class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-[#dc2d3d] focus:border-transparent dark:bg-gray-700 dark:text-white uppercase">
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <!-- Faculty -->
                                <div>
                                    <label for="faculty_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Faculty
                                    </label>
                                    <select name="faculty_id" id="faculty_id"
                                        class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-[#dc2d3d] focus:border-transparent dark:bg-gray-700 dark:text-white">
                                        <option value="">Select Faculty</option>
                                        @foreach($faculties as $faculty)
                                            <option value="{{ $faculty->id }}"
                                                {{ old('faculty_id', $user->student->faculty_id) == $faculty->id ? 'selected' : '' }}>
                                                {{ $faculty->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('faculty_id')
                                        <p class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Program -->
                                <div>
                                    <label for="program" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Program
                                    </label>
                                    <input type="text" name="program" id="program" value="{{ old('program', $user->student->program) }}"
                                        class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-[#dc2d3d] focus:border-transparent dark:bg-gray-700 dark:text-white">
                                    @error('program')
                                        <p class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Phone -->
                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Phone Number
                                    </label>
                                    <input type="text" name="phone" id="phone" value="{{ old('phone', $user->student->phone) }}"
                                        class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-[#dc2d3d] focus:border-transparent dark:bg-gray-700 dark:text-white">
                                    @error('phone')
                                        <p class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Address -->
                            <div>
                                <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Address
                                </label>
                                <textarea name="address" id="address" rows="3"
                                    class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-[#dc2d3d] focus:border-transparent dark:bg-gray-700 dark:text-white">{{ old('address', $user->student->address) }}</textarea>
                                @error('address')
                                    <p class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                @elseif($user->staff)
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 mb-6">
                        <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-6 flex items-center">
                            <svg class="w-5 h-5 text-[#dc2d3d] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            Staff Information
                        </h2>

                        <div class="space-y-5">
                            <!-- Staff ID (Read-only) -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Staff ID
                                </label>
                                <input type="text" value="{{ $user->staff->staff_id }}" disabled
                                    class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg bg-gray-50 dark:bg-gray-900 text-gray-500 dark:text-gray-400 uppercase font-mono cursor-not-allowed">
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <!-- Department -->
                                <div>
                                    <label for="department" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Department
                                    </label>
                                    <input type="text" name="department" id="department" value="{{ old('department', $user->staff->department) }}"
                                        class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-[#dc2d3d] focus:border-transparent dark:bg-gray-700 dark:text-white">
                                    @error('department')
                                        <p class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Position -->
                                <div>
                                    <label for="position" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Position
                                    </label>
                                    <input type="text" name="position" id="position" value="{{ old('position', $user->staff->position) }}"
                                        class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-[#dc2d3d] focus:border-transparent dark:bg-gray-700 dark:text-white">
                                    @error('position')
                                        <p class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Phone -->
                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Phone Number
                                    </label>
                                    <input type="text" name="phone" id="phone" value="{{ old('phone', $user->staff->phone) }}"
                                        class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-[#dc2d3d] focus:border-transparent dark:bg-gray-700 dark:text-white">
                                    @error('phone')
                                        <p class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Office Location -->
                                <div>
                                    <label for="office_location" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Office Location
                                    </label>
                                    <input type="text" name="office_location" id="office_location" value="{{ old('office_location', $user->staff->office_location) }}"
                                        class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-[#dc2d3d] focus:border-transparent dark:bg-gray-700 dark:text-white">
                                    @error('office_location')
                                        <p class="mt-1.5 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Action Buttons -->
                <div class="flex items-center justify-between">
                    <!-- Activate/Deactivate Button (Left) -->
                    @if($user->id !== auth()->id())
                        <button type="button" onclick="openToggleModal()"
                            class="inline-flex items-center px-5 py-2.5 {{ $user->is_active ? 'bg-red-600 hover:bg-red-700' : 'bg-green-600 hover:bg-green-700' }} text-white font-medium rounded-lg transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                @if($user->is_active)
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                @else
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                @endif
                            </svg>
                            {{ $user->is_active ? 'Deactivate Account' : 'Activate Account' }}
                        </button>
                    @else
                        <div></div>
                    @endif

                    <!-- Save/Cancel Buttons (Right) -->
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('users.show', $user) }}"
                            class="px-5 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 font-medium transition-colors">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-5 py-2.5 bg-[#dc2d3d] text-white rounded-lg hover:bg-[#b82532] font-medium transition-colors">
                            Save Changes
                        </button>
                    </div>
                </div>
            </form>
        </main>
    </div>

    <!-- Confirmation Modal -->
    <div id="toggleModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-2xl max-w-md w-full mx-4">
            <div class="p-6">
                <div class="flex items-center justify-center w-12 h-12 mx-auto mb-4 rounded-full {{ $user->is_active ? 'bg-red-100 dark:bg-red-900/30' : 'bg-green-100 dark:bg-green-900/30' }}">
                    <svg class="w-6 h-6 {{ $user->is_active ? 'text-red-600 dark:text-red-400' : 'text-green-600 dark:text-green-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        @if($user->is_active)
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        @else
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        @endif
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-center text-gray-900 dark:text-white mb-2">
                    {{ $user->is_active ? 'Deactivate Account' : 'Activate Account' }}
                </h3>
                <p class="text-center text-gray-600 dark:text-gray-400 mb-6">
                    @if($user->is_active)
                        Are you sure you want to deactivate <strong>{{ $user->name }}'s</strong> account? They will not be able to log in.
                    @else
                        Are you sure you want to activate <strong>{{ $user->name }}'s</strong> account? They will be able to log in.
                    @endif
                </p>
                <div class="flex space-x-3">
                    <button onclick="closeToggleModal()"
                        class="flex-1 px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 font-medium transition-colors">
                        Cancel
                    </button>
                    <form action="{{ route('users.toggle-status', $user) }}" method="POST" class="flex-1">
                        @csrf
                        @method('PATCH')
                        <button type="submit"
                            class="w-full px-4 py-2.5 {{ $user->is_active ? 'bg-red-600 hover:bg-red-700' : 'bg-green-600 hover:bg-green-700' }} text-white rounded-lg font-medium transition-colors">
                            {{ $user->is_active ? 'Deactivate' : 'Activate' }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('components.dashboard_scripts')

    <script>
        function openToggleModal() {
            document.getElementById('toggleModal').classList.remove('hidden');
            document.getElementById('toggleModal').classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function closeToggleModal() {
            document.getElementById('toggleModal').classList.add('hidden');
            document.getElementById('toggleModal').classList.remove('flex');
            document.body.style.overflow = 'auto';
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeToggleModal();
        });

        document.getElementById('toggleModal').addEventListener('click', function(e) {
            if (e.target === this) closeToggleModal();
        });
    </script>
</body>

</html>