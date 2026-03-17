<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Privacy Policy - Kingsford University</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 dark:bg-[#18181b]">
  @include('components.navigation')
  <div class="mt-16"></div>
  {{-- Content --}}
  <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-12 py-16 px-6">

    {{-- Sidebar TOC --}}
    <aside class="lg:col-span-3 hidden lg:block sticky top-28 h-fit">
      <h4 class="text-xs font-bold text-[#dc2d3d] uppercase tracking-widest mb-4">Table of Contents</h4>
      <ul class="space-y-3 text-sm font-medium border-l border-gray-200 dark:border-gray-700">
        <li><a href="#compliance"
            class="block pl-4 border-l-2 border-transparent hover:border-[#dc2d3d] hover:text-[#dc2d3d] text-gray-600 dark:text-gray-400 transition-all">Regulatory
            Compliance</a></li>
        <li><a href="#collection"
            class="block pl-4 border-l-2 border-transparent hover:border-[#dc2d3d] hover:text-[#dc2d3d] text-gray-600 dark:text-gray-400 transition-all">Collection
            & Usage</a></li>
        <li><a href="#security"
            class="block pl-4 border-l-2 border-transparent hover:border-[#dc2d3d] hover:text-[#dc2d3d] text-gray-600 dark:text-gray-400 transition-all">Storage
            & Security</a></li>
        <li><a href="#rights"
            class="block pl-4 border-l-2 border-transparent hover:border-[#dc2d3d] hover:text-[#dc2d3d] text-gray-600 dark:text-gray-400 transition-all">Your
            Rights</a></li>
      </ul>
    </aside>

    {{-- Main Content --}}
    <main class="lg:col-span-9 space-y-16">

      <hr class="border-gray-200 dark:border-gray-700">

      {{-- 01 Compliance --}}
      <section id="compliance" class="scroll-mt-32">
        <h2 class="text-2xl font-bold mb-8 text-gray-900 dark:text-white flex items-center gap-3">
          <span
            class="w-8 h-8 bg-[#dc2d3d] text-white rounded flex items-center justify-center text-sm font-bold">01</span>
          Regulatory Compliance
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm">
            <h3 class="font-bold text-gray-900 dark:text-white mb-2">PDPA</h3>
            <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">Full compliance with local data
              protection regulations.</p>
          </div>
          <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm">
            <h3 class="font-bold text-gray-900 dark:text-white mb-2">GDPR</h3>
            <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">Adhering to international standards for
              student data safety.</p>
          </div>
        </div>
      </section>

      {{-- 02 Collection --}}
      <section id="collection" class="scroll-mt-32">
        <h2 class="text-2xl font-bold mb-8 text-gray-900 dark:text-white flex items-center gap-3">
          <span
            class="w-8 h-8 bg-[#dc2d3d] text-white rounded flex items-center justify-center text-sm font-bold">02</span>
          Data Collection & Usage
        </h2>
        <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 border border-gray-200 dark:border-gray-700 shadow-sm">
          <p class="mb-8 text-gray-600 dark:text-gray-400">We collect the following information for academic and
            administrative operations:</p>
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-10">
            @foreach(['Full Name and ID', 'University Email', 'Faculty Assignment', 'Magazine Content'] as $item)
              <div class="flex items-center gap-4 p-4 bg-gray-50 dark:bg-gray-700 rounded-xl">
                <span class="text-[#dc2d3d] font-bold text-lg leading-none">✓</span>
                <span class="text-sm font-semibold text-gray-700 dark:text-gray-300">{{ $item }}</span>
              </div>
            @endforeach
          </div>
          <div class="border-t border-gray-100 dark:border-gray-700 pt-8">
            <h4 class="font-bold mb-4 text-gray-900 dark:text-white">Purposes of Data Use:</h4>
            <div class="flex flex-wrap gap-2">
              @foreach(['Contribution Management', 'Faculty Coordination', 'Exception Reporting'] as $tag)
                <span
                  class="px-3 py-1 bg-red-50 dark:bg-red-900/10 text-[#dc2d3d] text-xs font-bold rounded-full border border-red-200 dark:border-red-800">{{ $tag }}</span>
              @endforeach
            </div>
          </div>
        </div>
      </section>

      {{-- 03 Security --}}
      <section id="security" class="scroll-mt-32">
        <h2 class="text-2xl font-bold mb-8 text-gray-900 dark:text-white flex items-center gap-3">
          <span
            class="w-8 h-8 bg-[#dc2d3d] text-white rounded flex items-center justify-center text-sm font-bold">03</span>
          Storage, Security & Access
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
          <div class="space-y-6 text-sm text-gray-600 dark:text-gray-400">
            <p><strong class="text-gray-900 dark:text-white">Storage:</strong> All data is stored securely on
              university-managed systems.</p>
            <p><strong class="text-gray-900 dark:text-white">Retention:</strong> Data is retained only for as long as
              necessary for audit purposes.</p>
          </div>
          <div class="space-y-6 text-sm text-gray-600 dark:text-gray-400">
            <p><strong class="text-gray-900 dark:text-white">Access:</strong> Limited to authorized Marketing personnel
              based on Faculty alignment.</p>
            <p><strong class="text-gray-900 dark:text-white">Reporting:</strong> Anonymized statistical reports
              generated for internal reporting.</p>
          </div>
        </div>
      </section>

      {{-- 04 Rights --}}
      <section id="rights" class="scroll-mt-32 pb-8">
        <h2 class="text-2xl font-bold mb-8 text-gray-900 dark:text-white flex items-center gap-3">
          <span
            class="w-8 h-8 bg-[#dc2d3d] text-white rounded flex items-center justify-center text-sm font-bold">04</span>
          Your Rights
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
          <div class="p-6 bg-white dark:bg-gray-800 rounded-2xl border-b-4 border-[#dc2d3d] shadow-sm">
            <h4 class="font-bold text-sm mb-2 text-gray-900 dark:text-white">Protection</h4>
            <p class="text-xs text-gray-500 dark:text-gray-400 leading-relaxed">Protected according to applicable laws.
            </p>
          </div>
          <div class="p-6 bg-white dark:bg-gray-800 rounded-2xl border-b-4 border-[#dc2d3d] shadow-sm">
            <h4 class="font-bold text-sm mb-2 text-gray-900 dark:text-white">Correction</h4>
            <p class="text-xs text-gray-500 dark:text-gray-400 leading-relaxed">Request updates for any inaccurate info.
            </p>
          </div>
          <div class="p-6 bg-white dark:bg-gray-800 rounded-2xl border-b-4 border-[#dc2d3d] shadow-sm">
            <h4 class="font-bold text-sm mb-2 text-gray-900 dark:text-white">Reporting</h4>
            <p class="text-xs text-gray-500 dark:text-gray-400 leading-relaxed">Report suspected misuse or security
              issues.</p>
          </div>
        </div>
      </section>

    </main>
  </div>

  @include('components.footer')
</body>

</html>