<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Contact Request #{{ $contact->id }}</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 dark:bg-[#18181b]">
  @include('components.sidebar_navigation')
  @include('components.top_navigation', ['title' => 'Response'])

  <div class="lg:ml-64">
    <main class="p-4 lg:p-8">
      <div class="max-w-4xl mx-auto">

        <!-- Contact Info Card -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mb-6">
          <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Contact Information</h2>

          {{-- Mobile: compact single-line summary --}}
          <div class="md:hidden space-y-3">
            <div class="flex items-center justify-between gap-4">
              <div class="min-w-0">
                <p class="text-sm font-medium text-gray-900 dark:text-white truncate">{{ $contact->name }}</p>
                <p class="text-xs text-gray-500 dark:text-gray-400 break-all">{{ $contact->email }}</p>
              </div>
              <div class="shrink-0 flex items-center gap-2">
                @if($contact->user_id)
                  <span
                    class="px-2 py-0.5 text-xs font-semibold rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400">
                    {{ ucfirst($contact->user_role ?? 'User') }}
                  </span>
                @else
                  <span
                    class="px-2 py-0.5 text-xs font-semibold rounded-full bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                    Guest
                  </span>
                @endif
                <span
                  class="text-xs text-gray-400 dark:text-gray-500">{{ $contact->created_at->format('M d, Y') }}</span>
              </div>
            </div>

            <div>
              <p class="text-sm font-semibold text-gray-900 dark:text-white">{{ $contact->subject }}</p>
            </div>

            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-3">
              <p class="text-sm text-gray-900 dark:text-white whitespace-pre-wrap break-words">{{ $contact->message }}
              </p>
            </div>
          </div>

          {{-- Desktop: original full grid layout --}}
          <div class="hidden md:block">
            <div class="grid grid-cols-2 gap-4">
              <div>
                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Name</label>
                <p class="text-gray-900 dark:text-white font-medium">{{ $contact->name }}</p>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Email</label>
                <p class="text-gray-900 dark:text-white font-medium">{{ $contact->email }}</p>
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Type</label>
                @if($contact->user_id)
                  <span
                    class="inline-block px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400">
                    {{ ucfirst($contact->user_role ?? 'User') }}
                  </span>
                @else
                  <span
                    class="inline-block px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                    Guest
                  </span>
                @endif
              </div>
              <div>
                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Submitted</label>
                <p class="text-gray-900 dark:text-white">{{ $contact->created_at->format('M d, Y h:i A') }}</p>
              </div>
            </div>

            <div class="mt-4">
              <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Subject</label>
              <p class="text-gray-900 dark:text-white font-medium">{{ $contact->subject }}</p>
            </div>

            <div class="mt-4">
              <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Message</label>
              <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                <p class="text-gray-900 dark:text-white whitespace-pre-wrap">{{ $contact->message }}</p>
              </div>
            </div>
          </div>
        </div>

        <!-- Edit Form -->
        <form action="{{ route('contact.update', $contact) }}" method="POST">
          @csrf
          @method('PUT')

          <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 mb-6">
            <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-6">Update Status & Response</h2>

            <!-- Status -->
            <div class="mb-6">
              <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Status <span class="text-[#dc2d3d]">*</span>
              </label>
              <select id="status" name="status" required
                class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-[#dc2d3d] focus:border-transparent">
                <option value="pending" {{ $contact->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="in_progress" {{ $contact->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                <option value="resolved" {{ $contact->status == 'resolved' ? 'selected' : '' }}>Resolved</option>
              </select>
              @error('status')
                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
              @enderror
            </div>

            <!-- Admin Response -->
            <div class="mb-6">
              <label for="admin_response" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Admin Response
              </label>
              <textarea id="admin_response" name="admin_response" rows="6"
                placeholder="Enter your response to the user..."
                class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-[#dc2d3d] focus:border-transparent resize-none">{{ old('admin_response', $contact->admin_response) }}</textarea>
              <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                This response will be visible to the user and recorded with a timestamp.
              </p>
              @error('admin_response')
                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
              @enderror
            </div>

            @if($contact->responded_at)
              <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4">
                <div class="flex items-start space-x-2">
                  <svg class="w-5 h-5 text-blue-600 dark:text-blue-400 flex-shrink-0 mt-0.5" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                  <p class="text-sm text-blue-800 dark:text-blue-300">
                    Last responded on {{ $contact->responded_at->format('M d, Y h:i A') }}
                  </p>
                </div>
              </div>
            @endif
          </div>

          <!-- Action Buttons -->
          <div class="flex flex-col sm:flex-row gap-3">
            <button type="submit"
              class="inline-flex items-center justify-center px-8 py-3 bg-[#dc2d3d] text-white rounded-lg font-semibold hover:bg-[#b82532] transition-colors shadow-lg">
              <svg class="w-5 h-5 mr-2 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
              </svg>
              Save Changes
            </button>

            <a href="{{ route('contact.show', $contact) }}"
              class="inline-flex items-center justify-center px-8 py-3 bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg font-semibold hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors">
              Cancel
            </a>
          </div>
        </form>

      </div>
    </main>
  </div>
  @include('components.dashboard_scripts')
</body>

</html>