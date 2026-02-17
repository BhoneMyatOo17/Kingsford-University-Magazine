<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create User - Kingsford University</title>
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
          <h1 class="text-xl lg:text-2xl font-bold text-gray-900 dark:text-white">Create New User</h1>

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
          </div>
        </div>
      </div>
    </header>

    <!-- Form Content -->
    <main class="p-4 lg:p-8">
      <div class="max-w-4xl mx-auto">
        <!-- Back Button -->
        <a href="{{ route('users.index') }}"
          class="inline-flex items-center text-[#dc2d3d] hover:text-[#b82532] font-medium mb-6 transition-colors">
          <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
          </svg>
          Back to Users
        </a>

        <!-- Form Card -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
          <!-- Card Header -->
          <div class="bg-gradient-to-r from-[#dc2d3d] to-[#b82532] px-6 py-8">
            <h2 class="text-2xl font-bold text-white">Create New User Account</h2>
            <p class="text-white/90 mt-2">Add a new student, coordinator, or manager to the system</p>
          </div>

          <!-- Form -->
          <form action="{{ route('users.store') }}" method="POST" class="p-6 lg:p-8">
            @csrf

            <!-- Error Messages -->
            @if($errors->any())
              <div class="mb-6 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4">
                <div class="flex">
                  <svg class="w-5 h-5 text-red-400 mr-3 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                      d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                      clip-rule="evenodd" />
                  </svg>
                  <div>
                    <h3 class="text-sm font-medium text-red-800 dark:text-red-200">There were errors with your submission:
                    </h3>
                    <ul class="mt-2 text-sm text-red-700 dark:text-red-300 list-disc list-inside">
                      @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
                </div>
              </div>
            @endif

            <!-- Basic Information Section -->
            <div class="mb-8">
              <h3
                class="text-lg font-semibold text-gray-900 dark:text-white mb-4 pb-2 border-b border-gray-200 dark:border-gray-700">
                Basic Information
              </h3>

              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Full Name -->
                <div>
                  <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Full Name <span class="text-red-500">*</span>
                  </label>
                  <input type="text" name="name" id="name" value="{{ old('name') }}" required
                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-[#dc2d3d] focus:border-transparent dark:bg-gray-700 dark:text-white transition-all"
                    placeholder="Enter full name">
                  @error('name')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                  @enderror
                </div>

                <!-- Email -->
                <div>
                  <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Email Address <span class="text-red-500">*</span>
                  </label>
                  <div class="relative">
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required
                      placeholder="user@ksf.it.com"
                      class="w-full px-4 py-3 rounded-lg shadow-sm focus:outline-none pr-12 dark:bg-gray-700 dark:text-white transition-all"
                      style="border: 1px solid #d1d5db;" />

                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                      <svg id="icon-checking" class="animate-spin h-6 w-6 text-gray-400 hidden" fill="none"
                        viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                        </circle>
                        <path class="opacity-75" fill="currentColor"
                          d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                      </svg>

                      <svg id="icon-valid" class="h-8 w-8 text-green-500 hidden" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                          d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                          clip-rule="evenodd" />
                      </svg>

                      <svg id="icon-invalid" class="h-8 w-8 text-red-500 hidden" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                          d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                          clip-rule="evenodd" />
                      </svg>
                    </div>
                  </div>

                  <div id="msg" class="mt-2 text-sm font-bold"></div>
                  @error('email')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                  @enderror
                </div>

                <!-- User Type -->
                <div>
                  <label for="user_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    User Type <span class="text-red-500">*</span>
                  </label>
                  <select name="user_type" id="user_type" required
                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-[#dc2d3d] focus:border-transparent dark:bg-gray-700 dark:text-white transition-all">
                    <option value="">Select user type</option>
                    <option value="student" {{ old('user_type') == 'student' ? 'selected' : '' }}>Student</option>
                    <option value="marketing_coordinator" {{ old('user_type') == 'marketing_coordinator' ? 'selected' : '' }}>Marketing Coordinator</option>
                    <option value="marketing_manager" {{ old('user_type') == 'marketing_manager' ? 'selected' : '' }}>
                      Marketing Manager</option>
                  </select>
                  @error('user_type')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                  @enderror
                </div>

                <!-- Faculty -->
                <div>
                  <label for="faculty_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Faculty <span class="text-red-500">*</span>
                  </label>
                  <select name="faculty_id" id="faculty_id" required
                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-[#dc2d3d] focus:border-transparent dark:bg-gray-700 dark:text-white transition-all">
                    <option value="">Select faculty</option>
                    @foreach($faculties as $faculty)
                      <option value="{{ $faculty->id }}" {{ old('faculty_id') == $faculty->id ? 'selected' : '' }}>
                        {{ $faculty->name }}
                      </option>
                    @endforeach
                  </select>
                  <p class="mt-1 text-xs text-gray-500 dark:text-gray-400" id="faculty-note">Required for students and
                    coordinators</p>
                  @error('faculty_id')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                  @enderror
                </div>

                <!-- Phone -->
                <div class="md:col-span-2">
                  <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Phone Number
                  </label>
                  <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-[#dc2d3d] focus:border-transparent dark:bg-gray-700 dark:text-white transition-all"
                    placeholder="Optional">
                  @error('phone')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                  @enderror
                </div>
              </div>
            </div>

            <!-- Student-Specific Fields -->
            <div id="student-fields" class="hidden mb-8">
              <h3
                class="text-lg font-semibold text-gray-900 dark:text-white mb-4 pb-2 border-b border-gray-200 dark:border-gray-700">
                Student Information
              </h3>

              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Student ID -->
                <div>
                  <label for="student_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Student ID <span class="text-red-500">*</span>
                  </label>
                  <input type="text" name="student_id" id="student_id" value="{{ old('student_id') }}"
                    class="w-full px-4 uppercase py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-[#dc2d3d] focus:border-transparent dark:bg-gray-700 dark:text-white transition-all"
                    placeholder="e.g., S2024001" maxlength="7">
                  @error('student_id')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                  @enderror
                </div>

                <!-- Program -->
                <div>
                  <label for="program" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Program <span class="text-red-500">*</span>
                  </label>
                  <input type="text" name="program" id="program" value="{{ old('program') }}"
                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-[#dc2d3d] focus:border-transparent dark:bg-gray-700 dark:text-white transition-all"
                    placeholder="e.g., BSc Computer Science">
                  @error('program')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                  @enderror
                </div>

                <!-- Enrollment Year -->
                <div>
                  <label for="enrollment_year" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Enrollment Year <span class="text-red-500">*</span>
                  </label>
                  <input type="number" name="enrollment_year" id="enrollment_year"
                    value="{{ old('enrollment_year', date('Y')) }}" min="2000" max="{{ date('Y') + 1 }}"
                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-[#dc2d3d] focus:border-transparent dark:bg-gray-700 dark:text-white transition-all">
                  @error('enrollment_year')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                  @enderror
                </div>

                <!-- Study Level -->
                <div>
                  <label for="study_level" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Study Level <span class="text-red-500">*</span>
                  </label>
                  <select name="study_level" id="study_level"
                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-[#dc2d3d] focus:border-transparent dark:bg-gray-700 dark:text-white transition-all">
                    <option value="undergraduate" {{ old('study_level') == 'undergraduate' ? 'selected' : '' }}>
                      Undergraduate</option>
                    <option value="postgraduate" {{ old('study_level') == 'postgraduate' ? 'selected' : '' }}>Postgraduate
                    </option>
                    <option value="doctorate" {{ old('study_level') == 'doctorate' ? 'selected' : '' }}>Doctorate</option>
                  </select>
                  @error('study_level')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                  @enderror
                </div>
              </div>
            </div>

            <!-- Staff-Specific Fields -->
            <div id="staff-fields" class="hidden mb-8">
              <h3
                class="text-lg font-semibold text-gray-900 dark:text-white mb-4 pb-2 border-b border-gray-200 dark:border-gray-700">
                Staff Information
              </h3>

              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Staff ID -->
                <div>
                  <label for="staff_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Staff ID <span class="text-red-500">*</span>
                  </label>
                  <input type="text" name="staff_id" id="staff_id" value="{{ old('staff_id') }}"
                    class="w-full px-4 uppercase py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-[#dc2d3d] focus:border-transparent dark:bg-gray-700 dark:text-white transition-all"
                    placeholder="e.g., STF0001" maxlength="7">
                  @error('staff_id')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                  @enderror
                </div>

                <!-- Department -->
                <div>
                  <label for="department" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Department
                  </label>
                  <input type="text" name="department" id="department" value="{{ old('department') }}"
                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-[#dc2d3d] focus:border-transparent dark:bg-gray-700 dark:text-white transition-all">
                  @error('department')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                  @enderror
                </div>

                <!-- Position -->
                <div>
                  <label for="position" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Position
                  </label>
                  <input type="text" name="position" id="position" value="{{ old('position') }}"
                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-[#dc2d3d] focus:border-transparent dark:bg-gray-700 dark:text-white transition-all"
                    placeholder="Auto-filled from user type">
                  @error('position')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                  @enderror
                </div>

                <!-- Hire Date -->
                <div>
                  <label for="hire_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Hire Date
                  </label>
                  <input type="date" name="hire_date" id="hire_date" value="{{ old('hire_date', date('Y-m-d')) }}"
                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-[#dc2d3d] focus:border-transparent dark:bg-gray-700 dark:text-white transition-all">
                  @error('hire_date')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                  @enderror
                </div>

                <!-- Office Location -->
                <div class="md:col-span-2">
                  <label for="office_location" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Office Location
                  </label>
                  <input type="text" name="office_location" id="office_location" value="{{ old('office_location') }}"
                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-[#dc2d3d] focus:border-transparent dark:bg-gray-700 dark:text-white transition-all"
                    placeholder="e.g., Building A, Room 301">
                  @error('office_location')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                  @enderror
                </div>
              </div>
            </div>

            <!-- Info Box -->
            <div class="mb-6 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4">
              <div class="flex">
                <svg class="w-5 h-5 text-blue-400 mr-3 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd"
                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                    clip-rule="evenodd" />
                </svg>
                <div class="text-sm text-blue-700 dark:text-blue-300">
                  <p><strong>Important:</strong> A temporary password will be automatically generated and sent to the
                    user's email address. The user must change this password on first login.</p>
                </div>
              </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200 dark:border-gray-700">
              <button type="submit"
                class="flex-1 sm:flex-initial inline-flex justify-center items-center px-8 py-3 bg-[#dc2d3d] text-white font-semibold rounded-lg hover:bg-[#b82532] transition-all duration-300 shadow-lg hover:shadow-xl">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Create User Account
              </button>
              <a href="{{ route('users.index') }}"
                class="flex-1 sm:flex-initial inline-flex justify-center items-center px-8 py-3 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 font-semibold rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-all duration-300">
                Cancel
              </a>
            </div>
          </form>
        </div>
      </div>
    </main>
  </div>

  <!-- Scripts -->
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const userTypeSelect = document.getElementById('user_type');
      const studentFields = document.getElementById('student-fields');
      const staffFields = document.getElementById('staff-fields');
      const facultyNote = document.getElementById('faculty-note');

      // Toggle fields based on user type
      userTypeSelect.addEventListener('change', function () {
        const userType = this.value;
        const facultySelect = document.getElementById('faculty_id');
        const facultyWrapper = facultySelect.closest('div');

        // Hide all specific fields first
        studentFields.classList.add('hidden');
        staffFields.classList.add('hidden');

        // Reset faculty field
        facultySelect.disabled = false;
        facultySelect.required = true;
        facultyWrapper.style.opacity = '1';

        // Show relevant fields
        if (userType === 'student') {
          studentFields.classList.remove('hidden');
          facultyNote.textContent = 'Required for students';
        } else if (userType === 'marketing_coordinator') {
          staffFields.classList.remove('hidden');
          facultyNote.textContent = 'Required for coordinators';
        } else if (userType === 'marketing_manager') {
          staffFields.classList.remove('hidden');
          facultySelect.disabled = true;
          facultySelect.required = false;
          facultySelect.value = '';
          facultyWrapper.style.opacity = '0.4';
          facultyNote.textContent = 'Not applicable for managers';
        }
      });

      // Trigger on page load if there's an old value
      if (userTypeSelect.value) {
        userTypeSelect.dispatchEvent(new Event('change'));
      }

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

      if (document.documentElement.classList.contains('dark')) {
        updateDashboardThemeIcons(true);
      } else {
        updateDashboardThemeIcons(false);
      }

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

      // Email validation
      const emailInput = document.getElementById('email');
      const checking = document.getElementById('icon-checking');
      const valid = document.getElementById('icon-valid');
      const invalid = document.getElementById('icon-invalid');
      const msg = document.getElementById('msg');
      let timer;

      emailInput.addEventListener('input', function () {
        clearTimeout(timer);

        // Reset
        checking.classList.add('hidden');
        valid.classList.add('hidden');
        invalid.classList.add('hidden');
        msg.innerHTML = '';
        this.style.border = '1px solid #d1d5db';

        const email = this.value.trim();
        if (!email) return;

        // Show loading
        checking.classList.remove('hidden');

        timer = setTimeout(() => {
          // Check domain
          if (!email.endsWith('@ksf.it.com')) {
            checking.classList.add('hidden');
            invalid.classList.remove('hidden');
            msg.innerHTML = '<span style="color: #ef4444;">Please use a @ksf.it.com email</span>';
            emailInput.style.border = '2px solid #ef4444';
            return;
          }

          // Check if exists
          fetch('/api/check-email', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'Accept': 'application/json'
            },
            body: JSON.stringify({ email })
          })
            .then(r => r.json())
            .then(data => {
              console.log('API Response:', data); // Debug log
              checking.classList.add('hidden');

              // Your controller returns { valid, exists, message }
              // exists = true means email is already taken
              if (data.exists === true) {
                // RED - email already exists
                invalid.classList.remove('hidden');
                msg.innerHTML = '<span style="color: #ef4444;">Email already registered</span>';
                emailInput.style.border = '2px solid #ef4444';
              } else if (data.valid === true || data.exists === false) {
                // GREEN - email is available
                valid.classList.remove('hidden');
                msg.innerHTML = '<span style="color: #22c55e;"></span>';
                emailInput.style.border = '2px solid #22c55e';
              } else {
                // Invalid format or other error
                invalid.classList.remove('hidden');
                msg.innerHTML = '<span style="color: #ef4444;">' + (data.message || 'Invalid email') + '</span>';
                emailInput.style.border = '2px solid #ef4444';
              }
            })
            .catch((error) => {
              console.error('Email check error:', error);
              checking.classList.add('hidden');
              // Show error state
              invalid.classList.remove('hidden');
              msg.innerHTML = '<span style="color: #ef4444;">Could not verify email</span>';
              emailInput.style.border = '2px solid #ef4444';
            });
        }, 500);
      });
    });
  </script>
</body>

</html>