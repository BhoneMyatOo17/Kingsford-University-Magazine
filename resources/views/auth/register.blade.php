<x-guest-layout>
    <x-slot name="heading">Student Registration</x-slot>
    <x-slot name="subheading">Create your Kingsford University account</x-slot>

    <div class="w-full px-4">
        <form method="POST" action="{{ route('register') }}" class="space-y-6 max-w-none">
            @csrf

            <!-- Name and Student ID -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <x-input-label for="student_id">
                        {{ __('Full Name') }}<span class="text-red-500 ml-1">*</span>
                    </x-input-label>
                    <x-text-input id="name" type="text" name="name" :value="old('name')" placeholder="John Doe" required
                        autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="student_id">
                        {{ __('Student ID') }}<span class="text-red-500 ml-1">*</span>
                    </x-input-label>
                    <x-text-input id="student_id" type="text" name="student_id" maxlength="7" class="uppercase"
                        :value="old('student_id')" placeholder="KSFXXXX" required />
                    <x-input-error :messages="$errors->get('student_id')" class="mt-2" />
                </div>
            </div>

            <!-- Email with INLINE BORDER -->
            <div>
                <x-input-label for="student_id">
                    {{ __('University Email') }}<span class="text-red-500 ml-1">*</span>
                </x-input-label>
                <div class="relative">
                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                        placeholder="yourname@ksf.it.com" required autocomplete="username"
                        class="block w-full px-3 py-2 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm focus:outline-none pr-12"
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
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Faculty and Program -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <x-input-label for="student_id">
                        {{ __('Faculty') }}<span class="text-red-500 ml-1">*</span>
                    </x-input-label>
                    <div class="relative">
                        <select id="faculty_id" name="faculty_id" required
                            class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-[#dc2d3d]">
                            <option value="">Select your faculty</option>
                            @foreach($faculties as $faculty)
                                <option value="{{ $faculty->id }}">{{ $faculty->name }}</option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('faculty_id')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="student_id">
                        {{ __('Program') }}<span class="text-red-500 ml-1">*</span>
                    </x-input-label>
                    <x-text-input id="program" type="text" name="program" :value="old('program')"
                        placeholder="BSc Computer Science" required />
                    <x-input-error :messages="$errors->get('program')" class="mt-2" />
                </div>
            </div>

            <!-- Year and Level -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <x-input-label for="student_id">
                        {{ __('Enrollment Year') }}<span class="text-red-500 ml-1">*</span>
                    </x-input-label>
                    <div class="relative">
                        <select id="enrollment_year" name="enrollment_year" required
                            class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-[#dc2d3d]">
                            <option value="">Select year</option>
                            @for($year = date('Y'); $year >= date('Y') - 10; $year--)
                                <option value="{{ $year }}" {{ $year == date('Y') ? 'selected' : '' }}>{{ $year }}</option>
                            @endfor
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('enrollment_year')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="student_id">
                        {{ __('Study Level') }}<span class="text-red-500 ml-1">*</span>
                    </x-input-label>
                    <div class="relative">
                        <select id="study_level" name="study_level" required
                            class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-[#dc2d3d]">
                            <option value="">Select level</option>
                            <option value="undergraduate">Undergraduate</option>
                            <option value="postgraduate">Postgraduate</option>
                            <option value="doctorate">Doctorate</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('study_level')" class="mt-2" />
                </div>
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Password')" />
                <div class="relative">
                    <x-text-input id="password" type="password" name="password" placeholder="Minimum 8 characters"
                        required autocomplete="new-password" class="pr-10" />

                    <button type="button" onclick="togglePass()"
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                        <svg id="eye1" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <svg id="eye2" class="h-5 w-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                        </svg>
                    </button>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div>
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation" type="password" name="password_confirmation"
                    placeholder="Re-enter password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Terms Checkbox -->
            <div class="flex items-start space-x-3">
                <input id="terms" type="checkbox" name="terms"
                    class="mt-1 h-4 w-4 rounded border-gray-300 text-[#dc2d3d] cursor-pointer">
                <span class="text-sm text-gray-600 dark:text-gray-400">
                    I agree to the <a href="{{ route('terms') }}" class="hover:underline">Terms and
                        Conditions</a>
                </span>
            </div>
            <x-input-error :messages="$errors->get('terms')" class="mt-2" />

            <x-primary-button class="w-full justify-center">Create Account</x-primary-button>
        </form>
    </div>

    <!-- Modal -->
    <div id="modal" class="fixed inset-0 hidden" style="z-index: 99999;">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 bg-black bg-opacity-50"></div>
            <div class="relative bg-white dark:bg-gray-800 rounded-lg max-w-3xl w-full">
                <div class="bg-[#dc2d3d] px-6 py-4 flex justify-between items-center">
                    <h3 class="text-xl font-bold text-white">Terms and Conditions</h3>
                    <button type="button" onclick="closeModal()" class="text-white hover:text-gray-200">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div id="content" class="px-6 py-4 max-h-96 overflow-y-auto">
                    <p class="text-sm text-gray-700 dark:text-gray-300 mb-3">By using this system, you agree to our
                        terms.</p>
                    <p class="text-sm text-gray-700 dark:text-gray-300 mb-3">Content here...</p>
                    <p class="text-sm text-gray-700 dark:text-gray-300 mb-3">More content...</p>
                    <p class="text-sm text-gray-700 dark:text-gray-300 mb-3">Scroll down...</p>
                </div>
                <div id="hint" class="px-6 py-2 bg-yellow-50 text-center border-t">
                    <p class="text-sm text-yellow-800">⬇️ Scroll to read all terms</p>
                </div>
                <div class="px-6 py-4 flex justify-between bg-gray-50">
                    <button type="button" onclick="closeModal()"
                        class="px-4 py-2 border border-gray-300 rounded hover:bg-gray-100">
                        Decline
                    </button>
                    <button type="button" id="agree"
                        class="px-6 py-2 bg-[#dc2d3d] text-white rounded hover:bg-[#b82532] disabled:opacity-50">
                        I Agree
                    </button>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="additionalLinks">
        <p class="text-sm">
            Already have an account?
            <a href="{{ route('login') }}" class="text-[#dc2d3d] font-semibold">Login</a>
        </p>
    </x-slot>

    <script>
        // Password toggle
        function togglePass() {
            const p = document.getElementById('password');
            const c = document.getElementById('password_confirmation');
            const e1 = document.getElementById('eye1');
            const e2 = document.getElementById('eye2');

            if (p.type === 'password') {
                p.type = 'text';
                c.type = 'text';
                e1.classList.add('hidden');
                e2.classList.remove('hidden');
            } else {
                p.type = 'password';
                c.type = 'password';
                e1.classList.remove('hidden');
                e2.classList.add('hidden');
            }
        }

        // Email validation - SIMPLE VERSION
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
                    msg.innerHTML = '<span style="color: #ef4444;">Please use your student email</span>';
                    emailInput.style.border = '2px solid #ef4444';
                    return;
                }

                // Check if exists
                fetch('/api/check-email', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ email })
                })
                    .then(r => r.json())
                    .then(data => {
                        checking.classList.add('hidden');

                        if (data.exists) {
                            // RED - exists
                            invalid.classList.remove('hidden');
                            msg.innerHTML = '<span style="color: #ef4444;">Email already registered</span>';
                            emailInput.style.border = '2px solid #ef4444';
                        } else {
                            // GREEN - available
                            valid.classList.remove('hidden');
                            msg.innerHTML = '<span style="color: #22c55e; font-weight: bold;"></span>';
                            emailInput.style.border = '2px solid #22c55e';
                        }
                    })
                    .catch(() => {
                        checking.classList.add('hidden');
                        // If API fails, just show available (don't block user)
                        valid.classList.remove('hidden');
                        msg.innerHTML = '<span style="color: #22c55e;"></span>';
                        emailInput.style.border = '2px solid #22c55e';
                    });
            }, 500);
        });

        // Modal - opens on FIRST click
        const modal = document.getElementById('modal');
        const checkbox = document.getElementById('terms');
        const agreeBtn = document.getElementById('agree');
        const content = document.getElementById('content');
        const hint = document.getElementById('hint');

        checkbox.addEventListener('change', function () {
            if (this.checked) {
                // First time checking - open modal
                modal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }
        });

        function closeModal() {
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
            checkbox.checked = false;
        }

        agreeBtn.addEventListener('click', function () {
            checkbox.checked = true;
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        });

        content.addEventListener('scroll', function () {
            if (this.scrollTop + this.clientHeight >= this.scrollHeight - 5) {
                agreeBtn.disabled = false;
                hint.classList.add('hidden');
            }
        });
    </script>

    <style>
        select {
            appearance: none;
            -webkit-appearance: none;
        }
    </style>
</x-guest-layout>