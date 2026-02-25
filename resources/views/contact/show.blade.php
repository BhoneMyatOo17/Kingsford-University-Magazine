<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact - {{ $contact->name }}</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 dark:bg-[#18181b]">
  @include('components.sidebar_navigation')
  @include('components.top_navigation', ['title' => $contact->subject])

  <div class="lg:ml-64">
    <main class="p-4 lg:p-8">
      <div class="max-w-4xl mx-auto">
        <!-- Contact Details Card -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8 mb-6">
          <div class="flex items-start justify-between mb-6">
            <div class="flex items-center space-x-4">
              <div
                class="w-16 h-16 bg-[#dc2d3d] rounded-full flex items-center justify-center text-white text-2xl font-bold">
                {{ strtoupper(substr($contact->name, 0, 1)) }}
              </div>
              <div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $contact->name }}</h2>
                <p class="text-gray-600 dark:text-gray-400">{{ $contact->email }}</p>
                @if($contact->user_id)
                  <span
                    class="inline-block mt-1 px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400">
                    {{ ucfirst($contact->user_role ?? 'User') }}
                  </span>
                @else
                  <span
                    class="inline-block mt-1 px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                    Guest
                  </span>
                @endif
              </div>
            </div>

            @if($contact->status == 'pending')
              <span
                class="px-3 py-1 text-sm font-semibold rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400">
                Pending
              </span>
            @elseif($contact->status == 'in_progress')
              <span
                class="px-3 py-1 text-sm font-semibold rounded-full bg-orange-100 text-orange-800 dark:bg-orange-900/30 dark:text-orange-400">
                In Progress
              </span>
            @else
              <span
                class="px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">
                Resolved
              </span>
            @endif
          </div>

          <div class="space-y-6">
            <!-- Subject -->
            <div>
              <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Subject</label>
              <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $contact->subject }}</p>
            </div>

            <!-- Message -->
            <div>
              <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Message</label>
              <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                <p class="text-gray-900 dark:text-white whitespace-pre-wrap">{{ $contact->message }}</p>
              </div>
            </div>

            <!-- Timestamps -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-4 border-t border-gray-200 dark:border-gray-700">
              <div>
                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Submitted</label>
                <p class="text-gray-900 dark:text-white">{{ $contact->created_at->format('M d, Y h:i A') }}</p>
              </div>
              @if($contact->responded_at)
                <div>
                  <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Responded</label>
                  <p class="text-gray-900 dark:text-white">{{ $contact->responded_at->format('M d, Y h:i A') }}</p>
                </div>
              @endif
            </div>
          </div>
        </div>

        <!-- Admin Response Card -->
        @if($contact->admin_response)
          <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-6 mb-6">
            <div class="flex items-start space-x-3 mb-3">
              <svg class="w-6 h-6 text-green-600 dark:text-green-400 flex-shrink-0 mt-1" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
              <div class="flex-1">
                <h3 class="text-lg font-semibold text-green-900 dark:text-green-400 mb-2">Admin Response</h3>
                <p class="text-green-800 dark:text-green-300 whitespace-pre-wrap">{{ $contact->admin_response }}</p>
              </div>
            </div>
          </div>
        @endif

        <!-- Action Buttons -->
        <div class="flex flex-wrap gap-4">
          <a href="{{ route('contact.edit', $contact) }}"
            class="flex-1 sm:flex-none inline-flex items-center justify-center dark:text-white dark:hover:text-slate-200 px-6 py-3 hover:text-white bg-[#dc2d3d] text-white rounded-lg font-semibold hover:bg-[#b82532] transition-colors">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
            </svg>
            Respond
          </a>

          <form action="{{ route('contact.destroy', $contact) }}" method="POST" class="flex-1 sm:flex-none"
            onsubmit="return confirm('Are you sure you want to delete this contact request?');">
            @csrf
            @method('DELETE')
            <button type="submit"
              class="w-full inline-flex items-center justify-center px-6 py-3 bg-red-600 text-white rounded-lg font-semibold hover:bg-red-700 transition-colors">
              <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
              </svg>
              Delete
            </button>
          </form>

          <a href="{{ route('contact.index') }}"
            class="flex-1 sm:flex-none inline-flex items-center dark:hover:text-slate-200 justify-center px-6 py-3 bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg font-semibold hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors">
            Cancel
          </a>
        </div>
      </div>
    </main>
  </div>
  @include('components.dashboard_scripts')
</body>

</html>