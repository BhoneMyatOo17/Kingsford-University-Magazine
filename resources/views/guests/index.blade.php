<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Guest Accounts - Kingsford University</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 dark:bg-[#18181b]">
  @include('components.sidebar_navigation')
  @include('components.top_navigation', ['title' => 'Guest Accounts'])

  <div class="lg:ml-64">
    <main class="p-4 lg:p-8">

      @if(session('success'))
        <div
          class="mb-6 p-4 bg-green-100 dark:bg-green-900/30 border border-green-200 dark:border-green-800 rounded-lg text-green-800 dark:text-green-400 text-sm">
          {{ session('success') }}
        </div>
      @endif

      <div class="flex items-center justify-between mb-6">
        <div>
          <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Guest Accounts</h2>
          <p class="text-gray-600 dark:text-gray-400 text-sm mt-1">
            @role('admin') All guest accounts across faculties. @endrole
            @role('marketing_coordinator') Guest accounts registered under your faculty. @endrole
          </p>
        </div>
      </div>

      <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
          <table class="w-full">
            <thead class="bg-gray-50 dark:bg-gray-700">
              <tr>
                <th
                  class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                  Name</th>
                <th
                  class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                  Email</th>
                <th
                  class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                  Faculty</th>
                <th
                  class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                  Status</th>
                <th
                  class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                  Registered</th>
                <th
                  class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                  Actions</th>
              </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
              @forelse($guests as $guest)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 {{ $guest->trashed() ? 'opacity-60' : '' }}">
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $guest->name }}</div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-600 dark:text-gray-400">{{ $guest->email }}</div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-600 dark:text-gray-400">{{ $guest->guestFaculty?->name ?? '—' }}</div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    @if($guest->trashed())
                      <span
                        class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400">Removed</span>
                    @elseif($guest->is_active)
                      <span
                        class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">Active</span>
                    @else
                      <span
                        class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-400">Inactive</span>
                    @endif
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-600 dark:text-gray-400">{{ $guest->created_at->format('M d, Y') }}</div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    @unless($guest->trashed())
                      <form action="{{ route('guests.destroy', $guest) }}" method="POST"
                        onsubmit="return confirm('Remove this guest account? This cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                          class="text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300">
                          Remove
                        </button>
                      </form>
                    @endunless
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="6" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">No guest accounts found.
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        @if($guests->hasPages())
          <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
            {{ $guests->links() }}
          </div>
        @endif
      </div>

    </main>

    <footer class="bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 mt-12">
      <div class="px-4 lg:px-8 py-6">
        <p class="text-sm text-gray-600 dark:text-gray-400">© 2026 Kingsford University. All rights reserved.</p>
      </div>
    </footer>
  </div>

  @include('components.dashboard_scripts')
</body>

</html>