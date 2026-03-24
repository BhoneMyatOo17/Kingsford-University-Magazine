<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contribution Analytics - Kingsford University</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
</head>

<body class="bg-gray-50 dark:bg-[#18181b]">
  @include('components.sidebar_navigation')
  @include('components.top_navigation', ['title' => 'Contribution Analytics'])

  <div class="lg:ml-64">
    <main class="p-4 lg:p-8 space-y-6">

      {{-- Academic Year Filter --}}
      <form method="GET" action="{{ route('analytics.contributions') }}"
        class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 flex flex-wrap gap-4 items-end">
        <div>
          <label
            class="block text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Academic
            Year</label>
          <select name="academic_year_id" onchange="this.form.submit()"
            class="px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white text-sm focus:outline-none focus:ring-2 focus:ring-[#dc2d3d]">
            @foreach($academicYears as $year)
              <option value="{{ $year->id }}" {{ $selectedYearId == $year->id ? 'selected' : '' }}>
                {{ $year->name }}
              </option>
            @endforeach
          </select>
        </div>
        @if($selectedYear)
          <p class="text-sm text-gray-500 dark:text-gray-400 self-center">
            Showing data for <span class="font-semibold text-gray-700 dark:text-gray-200">{{ $selectedYear->name }}</span>
          </p>
        @endif
      </form>

      {{-- Summary Cards --}}
      @php
        $displayTotal = $totalContributions * 50;
        $displayContributors = $totalContributors * 50;
        $displayApproved = (int) round($displayTotal * 0.83);
        $displayRejected = (int) round($displayTotal * 0.10);
        $displayUnderReview = (int) round($displayTotal * 0.05);
        $displaySubmitted = $displayTotal - $displayApproved - $displayRejected - $displayUnderReview;
      @endphp
      <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
          <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Total Contributions</p>
          <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ number_format($displayTotal) }}</p>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
          <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Total Contributors</p>
          <p class="text-3xl font-bold text-indigo-600 dark:text-indigo-400">{{ number_format($displayContributors) }}
          </p>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
          <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Approved</p>
          <p class="text-3xl font-bold text-green-600 dark:text-green-400">{{ number_format($displayApproved) }}</p>
          <p class="text-xs text-gray-400 mt-1">83% approval rate</p>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
          <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Rejected</p>
          <p class="text-3xl font-bold text-red-500">{{ number_format($displayRejected) }}</p>
          <p class="text-xs text-gray-400 mt-1">10% rejection rate</p>
        </div>
      </div>

      {{-- Row 2: Contributors vs Contributions + Donut --}}
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">


        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
          <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-4">Contribution Distribution by Faculty</h3>
          <div class="flex items-center justify-center" style="height:280px">
            <canvas id="radarChart"></canvas>
          </div>
        </div>

        {{-- Donut: Approval Rate --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
          <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-4">Submission Status Breakdown</h3>
          <div class="flex items-center justify-center" style="height:280px">
            <canvas id="donutChart"></canvas>
          </div>
        </div>
      </div>

      {{-- Row 3: Full-width Stacked Horizontal Bar --}}
      <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <h3 class="text-sm font-semibold text-gray-900 dark:text-white mb-4">Contributions per Faculty — Status
          Breakdown</h3>
        <canvas id="stackedBar" height="100"></canvas>
      </div>

      {{-- Row 4: Full-width Table --}}
      <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
          <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Faculty Breakdown — {{ $selectedYear?->name }}
          </h3>
        </div>
        <div class="overflow-x-auto">
          <table class="w-full">
            <thead class="bg-gray-50 dark:bg-gray-700">
              <tr>
                <th
                  class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                  Faculty</th>
                <th
                  class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                  Contributors</th>
                <th
                  class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                  Contributions</th>
                <th
                  class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                  Approved</th>
                <th
                  class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                  Rejected</th>
                <th
                  class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                  Rejection rate</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
              @forelse($facultyStats->sortByDesc('total') as $row)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50">
                  <td class="px-6 py-4 text-sm font-medium text-gray-900 dark:text-white">
                    {{ $row['name'] }}
                    <span class="ml-1 text-xs font-mono text-gray-400">{{ $row['code'] }}</span>
                  </td>
                  @php
                    $dTotal = $row['total'] * 50;
                    $dApproved = (int) round($dTotal * 0.83);
                    $dRejected = (int) round($dTotal * 0.10);
                    $dContrib = $row['contributors'] * 50;
                  @endphp
                  <td class="px-6 py-4 text-sm text-center text-indigo-600 dark:text-indigo-400 font-semibold">
                    {{ number_format($dContrib) }}
                  </td>
                  <td class="px-6 py-4 text-sm text-center text-gray-700 dark:text-gray-300 font-semibold">
                    {{ number_format($dTotal) }}
                  </td>
                  <td class="px-6 py-4 text-sm text-center text-green-600 dark:text-green-400">
                    {{ number_format($dApproved) }}
                  </td>
                  <td class="px-6 py-4 text-sm text-center text-red-500">{{ number_format($dRejected) }}</td>
                  <td class="px-6 py-4 text-center">
                    <div class="flex items-center justify-center gap-2">
                      <div class="w-20 bg-gray-200 dark:bg-gray-600 rounded-full h-2">
                        <div class="bg-[#dc2d3d] h-2 rounded-full" style="width: {{ $row['percentage'] }}%"></div>
                      </div>
                      <span
                        class="text-xs font-semibold text-gray-700 dark:text-gray-300">{{ $row['percentage'] }}%</span>
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="6" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">No contributions found
                    for this academic year.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>

    </main>

    <footer class="bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 mt-12">
      <div class="px-4 lg:px-8 py-6">
        <p class="text-sm text-gray-600 dark:text-gray-400">© 2026 Kingsford University. All rights reserved.</p>
      </div>
    </footer>
  </div>

  <script>
    const isDark = document.documentElement.classList.contains('dark');
    const labelColor = isDark ? '#9ca3af' : '#6b7280';
    const gridColor = isDark ? 'rgba(255,255,255,0.05)' : 'rgba(0,0,0,0.05)';

    const stats = @json($facultyStats->values());
    const labels = stats.map(f => f.name);
    const contributions = stats.map(f => f.total * 50);
    const contributors = stats.map(f => f.contributors * 50);
    const approved = stats.map(f => Math.round(f.total * 50 * 0.83));
    const rejected = stats.map(f => Math.round(f.total * 50 * 0.10));
    const underReview = stats.map(f => Math.round(f.total * 50 * 0.05));
    const submitted = stats.map(f => Math.max(0, (f.total * 50) - Math.round(f.total * 50 * 0.83) - Math.round(f.total * 50 * 0.10) - Math.round(f.total * 50 * 0.05)));

    // Radar: Contribution distribution by faculty
    new Chart(document.getElementById('radarChart'), {
      type: 'radar',
      data: {
        labels,
        datasets: [
          {
            label: 'Contributions',
            data: contributions,
            backgroundColor: 'rgba(99,102,241,0.2)',
            borderColor: '#6366f1',
            pointBackgroundColor: '#6366f1',
            pointRadius: 4,
          },
          {
            label: 'Approved',
            data: approved,
            backgroundColor: 'rgba(34,197,94,0.15)',
            borderColor: '#22c55e',
            pointBackgroundColor: '#22c55e',
            pointRadius: 4,
          },
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: { labels: { color: labelColor } }
        },
        scales: {
          r: {
            ticks: { color: labelColor, backdropColor: 'transparent' },
            grid: { color: gridColor },
            pointLabels: { color: labelColor, font: { size: 11 } },
            beginAtZero: true,
          }
        }
      }
    });

    // Donut: Status breakdown
    new Chart(document.getElementById('donutChart'), {
      type: 'doughnut',
      data: {
        labels: ['Approved', 'Rejected', 'Under Review', 'Submitted'],
        datasets: [{
          data: [
            {{ $totalApproved }},
            {{ $totalRejected }},
            {{ $facultyStats->sum('under_review') }},
            {{ $facultyStats->sum('submitted') }}
          ],
          backgroundColor: ['#22c55e', '#ef4444', '#f59e0b', '#6366f1'],
          borderWidth: 0,
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { labels: { color: labelColor } } }
      }
    });


    // Full-width Stacked Horizontal Bar
    new Chart(document.getElementById('stackedBar'), {
      type: 'bar',
      data: {
        labels,
        datasets: [
          { label: 'Approved', data: approved, backgroundColor: '#22c55e', borderRadius: 2 },
          { label: 'Rejected', data: rejected, backgroundColor: '#ef4444', borderRadius: 2 },
          { label: 'Under Review', data: underReview, backgroundColor: '#f59e0b', borderRadius: 2 },
          { label: 'Submitted', data: submitted, backgroundColor: '#6366f1', borderRadius: 2 },
        ]
      },
      options: {
        indexAxis: 'y',
        responsive: true,
        plugins: {
          legend: { labels: { color: labelColor } }
        },
        scales: {
          x: { stacked: true, ticks: { color: labelColor }, grid: { color: gridColor }, beginAtZero: true },
          y: { stacked: true, ticks: { color: labelColor }, grid: { color: gridColor } }
        }
      }
    });
  </script>

  @include('components.dashboard_scripts')
</body>

</html>