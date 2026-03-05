<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Contact Request - {{ $contact->subject }}</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 dark:bg-[#18181b]">
  @include('components.sidebar_navigation')
  @include('components.top_navigation', ['title' => 'Contact Request'])

  <div class="lg:ml-64">
    <main class="p-4 lg:p-8">
      <div class="max-w-3xl mx-auto">

        <!-- Your Message Card -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 lg:p-8 mb-6">
          <div class="flex items-start justify-between gap-4 mb-6">
            <div>
              <h2 class="text-xl font-bold text-gray-900 dark:text-white">{{ $contact->subject }}</h2>
              <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                Submitted {{ $contact->created_at->format('M d, Y h:i A') }}
              </p>
            </div>
            @if($contact->status == 'pending')
              <span
                class="shrink-0 px-3 py-1 text-sm font-semibold rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400">
                Pending
              </span>
            @elseif($contact->status == 'in_progress')
              <span
                class="shrink-0 px-3 py-1 text-sm font-semibold rounded-full bg-orange-100 text-orange-800 dark:bg-orange-900/30 dark:text-orange-400">
                In Progress
              </span>
            @else
              <span
                class="shrink-0 px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">
                Resolved
              </span>
            @endif
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Your Message</label>
            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
              <p class="text-gray-900 dark:text-white whitespace-pre-wrap break-words">{{ $contact->message }}</p>
            </div>
          </div>
        </div>

        <!-- Admin Response Card -->
        @if($contact->admin_response)
          <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-6 mb-6">
            <div class="flex items-start space-x-3">
              <svg class="w-6 h-6 text-green-600 dark:text-green-400 flex-shrink-0 mt-1" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
              <div class="flex-1 min-w-0">
                <div class="flex items-center justify-between gap-2 mb-2">
                  <h3 class="text-lg font-semibold text-green-900 dark:text-green-400">Admin Response</h3>
                  @if($contact->responded_at)
                    <span class="text-xs text-green-700 dark:text-green-500 shrink-0">
                      {{ $contact->responded_at->format('M d, Y h:i A') }}
                    </span>
                  @endif
                </div>
                <p class="text-green-800 dark:text-green-300">
                  {{ $contact->admin_response }}
                </p>
              </div>
            </div>
          </div>
        @else
          <div
            class="bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 rounded-lg p-6 mb-6 text-center">
            <p class="text-gray-500 dark:text-gray-400 text-sm">No response yet. We will get back to you soon.</p>
          </div>
        @endif

        <!-- Back Button -->
        <a href="{{ route('dashboard') }}"
          class="inline-flex items-center px-6 py-3 bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg font-semibold hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors">
          <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
          </svg>
          Back to Dashboard
        </a>

      </div>
    </main>
  </div>
  @include('components.dashboard_scripts')
</body>

</html>