<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Activity - Kingsford University</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 dark:bg-[#18181b]">
  @include('components.sidebar_navigation')
  @include('components.top_navigation', ['title' => 'User Activity'])

  <div class="lg:ml-64">
    <main class="p-4 lg:p-8 space-y-6">

      {{-- Filters --}}
      <form method="GET" action="{{ route('analytics.users') }}"
        class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 flex flex-wrap gap-4 items-end">
        <div>
          <label
            class="block text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Role</label>
          <select name="role"
            class="px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white text-sm focus:outline-none focus:ring-2 focus:ring-[#dc2d3d]">
            <option value="all" {{ $role === 'all' ? 'selected' : '' }}>All Roles</option>
            <option value="student" {{ $role === 'student' ? 'selected' : '' }}>Students</option>
            <option value="marketing_coordinator" {{ $role === 'marketing_coordinator' ? 'selected' : '' }}>Coordinators
            </option>
          </select>
        </div>
        <div>
          <label
            class="block text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Order</label>
          <select name="order"
            class="px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white text-sm focus:outline-none focus:ring-2 focus:ring-[#dc2d3d]">
            <option value="desc" {{ $order === 'desc' ? 'selected' : '' }}>Most Active</option>
            <option value="asc" {{ $order === 'asc' ? 'selected' : '' }}>Least Active</option>
          </select>
        </div>
        <button type="submit"
          class="px-4 py-2 bg-[#dc2d3d] text-white text-sm font-medium rounded-lg hover:bg-[#b82532] transition-colors">
          Apply
        </button>
      </form>

      {{-- Table --}}
      <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
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
                  Role</th>
                <th
                  class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                  Activity</th>
                <th
                  class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                  Last Login</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
              @forelse($users as $u)
                @php $roleName = $u->getRoleNames()->first() ?? ''; @endphp
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">

                  {{-- Name --}}
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $u->name }}</div>
                  </td>

                  {{-- Email --}}
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-600 dark:text-gray-400">{{ $u->email }}</div>
                  </td>

                  {{-- Role badge --}}
                  <td class="px-6 py-4 whitespace-nowrap">
                    @if($roleName === 'student')
                      <span
                        class="px-2 py-1 text-xs font-semibold rounded-full bg-indigo-100 dark:bg-indigo-900/40 text-indigo-700 dark:text-indigo-300">
                        Student
                      </span>
                    @elseif($roleName === 'marketing_coordinator')
                      <span
                        class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 dark:bg-blue-900/40 text-blue-700 dark:text-blue-300">
                        Coordinator
                      </span>
                    @else
                      <span
                        class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400">
                        {{ ucfirst(str_replace('_', ' ', $roleName)) ?: '—' }}
                      </span>
                    @endif
                  </td>

                  {{-- Activity --}}
                  <td class="px-6 py-4 whitespace-nowrap">
                    @if($roleName === 'student')
                      <div class="flex items-center gap-2">
                        <span
                          class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-green-100 dark:bg-green-900/40 text-green-700 dark:text-green-300">
                          <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                              d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                          </svg>
                          {{ $u->activity_score }}
                        </span>
                      </div>
                    @elseif($roleName === 'marketing_coordinator')
                      <div class="flex items-center gap-2">
                        <span
                          class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-blue-100 dark:bg-blue-900/40 text-blue-700 dark:text-blue-300">
                          <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                              d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                          </svg>
                          {{ $u->activity_score }}
                        </span>
                      </div>
                    @else
                      <span class="text-xs text-gray-400">—</span>
                    @endif
                  </td>

                  {{-- Last Login --}}
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-400">
                    {{ $u->last_login_at ? $u->last_login_at->diffForHumans() : 'Never' }}
                  </td>

                </tr>
              @empty
                <tr>
                  <td colspan="5" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">No users found.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>

      {{-- Pagination --}}
      @if($lastPage > 1)
        <div class="flex items-center justify-between bg-white dark:bg-gray-800 rounded-lg shadow px-6 py-4">
          <p class="text-sm text-gray-500 dark:text-gray-400">
            Showing {{ ($currentPage - 1) * $perPage + 1 }}–{{ min($currentPage * $perPage, $total) }} of {{ $total }}
            users
          </p>
          <div class="flex items-center gap-1">
            {{-- Prev --}}
            @if($currentPage > 1)
              <a href="{{ request()->fullUrlWithQuery(['page' => $currentPage - 1]) }}"
                class="px-3 py-1.5 text-sm rounded-lg border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                &larr; Prev
              </a>
            @endif

            {{-- Page numbers --}}
            @for($i = max(1, $currentPage - 2); $i <= min($lastPage, $currentPage + 2); $i++)
                  <a href="{{ request()->fullUrlWithQuery(['page' => $i]) }}"
                    class="px-3 py-1.5 text-sm rounded-lg border transition-colors
                                                                  {{ $i === $currentPage
              ? 'bg-[#dc2d3d] border-[#dc2d3d] text-white font-semibold'
              : 'border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700' }}">
                    {{ $i }}
                  </a>
            @endfor

            {{-- Next --}}
            @if($currentPage < $lastPage)
              <a href="{{ request()->fullUrlWithQuery(['page' => $currentPage + 1]) }}"
                class="px-3 py-1.5 text-sm rounded-lg border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                Next &rarr;
              </a>
            @endif
          </div>
        </div>
      @endif

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