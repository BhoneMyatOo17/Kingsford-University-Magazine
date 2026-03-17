<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Terms and Conditions - Kingsford University</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 dark:bg-[#18181b]">
  @include('components.navigation')
  <div class="mt-16"></div>
  {{-- Content --}}
  <div class="max-w-6xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-12 py-16 px-6">

    {{-- Sidebar TOC --}}
    <aside class="lg:col-span-3 hidden lg:block sticky top-28 h-fit">
      <h4 class="text-xs font-bold text-[#dc2d3d] uppercase tracking-widest mb-4">Agreement Sections</h4>
      <ul class="space-y-3 text-sm font-medium border-l border-gray-200 dark:border-gray-700">
        <li><a href="#data-collection"
            class="block pl-4 border-l-2 border-transparent hover:border-[#dc2d3d] hover:text-[#dc2d3d] text-gray-600 dark:text-gray-400 transition-all">Data
            Collection</a></li>
        <li><a href="#data-usage"
            class="block pl-4 border-l-2 border-transparent hover:border-[#dc2d3d] hover:text-[#dc2d3d] text-gray-600 dark:text-gray-400 transition-all">Use
            of Data</a></li>
        <li><a href="#security"
            class="block pl-4 border-l-2 border-transparent hover:border-[#dc2d3d] hover:text-[#dc2d3d] text-gray-600 dark:text-gray-400 transition-all">Security
            & Storage</a></li>
        <li><a href="#rights"
            class="block pl-4 border-l-2 border-transparent hover:border-[#dc2d3d] hover:text-[#dc2d3d] text-gray-600 dark:text-gray-400 transition-all">Rights
            & Responsibilities</a></li>
        <li><a href="#university"
            class="block pl-4 border-l-2 border-transparent hover:border-[#dc2d3d] hover:text-[#dc2d3d] text-gray-600 dark:text-gray-400 transition-all">University
            Rights</a></li>
        <li><a href="#changes"
            class="block pl-4 border-l-2 border-transparent hover:border-[#dc2d3d] hover:text-[#dc2d3d] text-gray-600 dark:text-gray-400 transition-all">Changes
            to Terms</a></li>
      </ul>
    </aside>

    {{-- Main Content --}}
    <main class="lg:col-span-9 space-y-16">

      <hr class="border-gray-200 dark:border-gray-700">

      {{-- 01 Data Collection --}}
      <section id="data-collection" class="scroll-mt-32">
        <h2 class="text-2xl font-bold mb-8 text-gray-900 dark:text-white flex items-center gap-3">
          <span
            class="w-8 h-8 bg-[#dc2d3d] text-white rounded flex items-center justify-center text-sm font-bold">01</span>
          Data Collection
        </h2>
        <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 border border-gray-200 dark:border-gray-700 shadow-sm">
          <p class="mb-6 text-gray-600 dark:text-gray-400">The system collects the following personal information:</p>
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-sm font-medium">
            @foreach(['Full Name', 'University Email Address (@ksf.it.com)', 'Student ID', 'Faculty Assignment', 'Login Credentials (Username/Password)', 'Magazine Contributions'] as $item)
              <div
                class="flex items-center gap-2 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg text-gray-700 dark:text-gray-300">
                <span class="w-2 h-2 rounded-full bg-[#dc2d3d] flex-shrink-0"></span> {{ $item }}
              </div>
            @endforeach
          </div>
        </div>
      </section>

      {{-- 02 Use of Data --}}
      <section id="data-usage" class="scroll-mt-32">
        <h2 class="text-2xl font-bold mb-8 text-gray-900 dark:text-white flex items-center gap-3">
          <span
            class="w-8 h-8 bg-[#dc2d3d] text-white rounded flex items-center justify-center text-sm font-bold">02</span>
          Use of Your Data
        </h2>
        <div
          class="bg-white dark:bg-gray-800 p-8 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm space-y-6">
          <p class="text-gray-600 dark:text-gray-400">Your data will be used for:</p>
          <ul class="space-y-2 ml-2 text-gray-600 dark:text-gray-400">
            @foreach(['Account Management', 'Magazine Contribution Management', 'Faculty Coordination', 'Statistical and Exception Reporting', 'Annual Magazine Publication'] as $item)
              <li class="flex items-center gap-2">
                <span class="w-1.5 h-1.5 rounded-full bg-[#dc2d3d] flex-shrink-0"></span> {{ $item }}
              </li>
            @endforeach
          </ul>
          <div class="p-4 bg-red-50 dark:bg-red-900/10 border border-red-200 dark:border-red-800 rounded-xl">
            <p class="text-sm text-[#b82532] dark:text-red-400 font-semibold">Important: Your data will NOT be used for
              commercial purposes or shared with external organizations.</p>
          </div>
        </div>
      </section>

      {{-- 03 Security --}}
      <section id="security" class="scroll-mt-32">
        <h2 class="text-2xl font-bold mb-8 text-gray-900 dark:text-white flex items-center gap-3">
          <span
            class="w-8 h-8 bg-[#dc2d3d] text-white rounded flex items-center justify-center text-sm font-bold">03</span>
          Data Storage & Security
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          @foreach([
              'All data is stored securely on university-managed systems.',
              'Data is retained only for academic, administrative, and audit purposes.',
              'Your submissions are visible to authorized personnel (Marketing Coordinator, Marketing Manager, and Administrators) based on Faculty alignment.',
              'Statistical reports (e.g., contribution counts per Faculty) may be generated for university reporting.'
            ] as $item)
              <div class="p-6 bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm">
                <p class="text-sm leading-relaxed text-gray-600 dark:text-gray-400">{{ $item }}</p>
              </div>
          @endforeach
        </div>
      </section
 >          

      {{-- 04 Rights --}}
      <section id="rights" class="scroll-mt-32">
        <h2 class="text-2xl font-bold mb-8 text-gray-900 dark:text-white flex items-center gap-3">
          <span class="w-8 h-8 bg-[#dc2d3d] text-white rounded flex items-center justify-center text-sm font-bold">04</span>
          Your Rights & Responsibilities
        </h2>
            
           <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
               
          <div class="space-y-4">
            <h3 class="text-lg font-bold text-[#dc2d3d]">Your Rights</h3>
            <ul class="text-sm space-y-3 text-gray-600 dark:text-gray-400">
              <li class="flex gap-2"><span class="text-[#dc2d3d]">•</span> Privacy and data protection according to applicable laws</li>
              <li class="flex gap-2"><span class="text-[#dc2d3d]">•</span> Request correction of inaccurate personal information</li>
              <li class="flex gap-2"><span class="text-[#dc2d3d]">•</span> Report misuse, abuse, or security issues</li>
            </ul>

                         </div>
          <div class="space-y-4">

                           <h3 class="text-lg font-bold text-[#dc2d3d]">Your Responsibilities</h3>

                           <ul class="text-sm space-y-3 text-gray-600 dark:text-gray-400">
              <li class="flex gap-2"><span class="text-[#dc2d3d]">•</span> Provide accurate and complete information during registration</li>
              <li class="flex gap-2"><span class="text-[#dc2d3d]">•</span> Keep account credentials confidential</li>
              <li class="flex gap-2"><span class="text-[#dc2d3d]">•</span> Do not attempt to access or misuse data belonging to others</li>
              <li class="flex gap-2"><span class="text-[#dc2d3d]">•</span> No impersonation or misrepresentation of identity</li>
              <li class="flex gap-2"><span class="text-[#dc2d3d]">•</span> Report unauthorized access immediately</li>
            </ul>
          </div>
        </div>
      </section
      >     

      {{-- 05 University Rights --}}
      <section id="university" class="scroll-mt-32">
        <h2 class="text-2xl font-bold mb-8 text-gray-900 dark:text-white flex items-center gap-3">
          <span class="w-8 h-8 bg-[#dc2d3d] text-white rounded flex items-center justify-center text-sm font-bold">05</span>
          University Rights
     
                </h2>

                     <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 border-l-4 border-[#dc2d3d] shadow-sm">
      
                 <p class="text-sm mb-4 font-semibold text-gray-900 dark:text-white">The University reserves the right to:</p>
          <ul class="text-sm text-gray-600 dark:text-gray-400 space-y-2 mb-6 ml-2">

           
                       <li class="flex gap-2"><span class="text-[#dc2d3d]">•</span> Suspend or terminate access for users who violate these Terms</li>
            <li class="flex gap-2"><span class="text-[#dc2d3d]">•</span> Remove content that violates intellectual property laws or policies</li>
            <li class="flex gap-2"><span class="text-[#dc2d3d]">•</span> Take disciplinary action for serious breaches under University regulations</li>
          </ul>
          <p class="text-xs text-gray-400 dark:text-gray-500 italic">Note: The University does not guarantee uninterrupted availability and is not liable for data loss caused by technical failures beyond reasonable control.</p>
        </div>
      </section
          > 

      {{-- 06 Changes --}}
      <section id="changes" class="scroll-mt-32 pb-8">
        <h2 class="text-2xl font-bold mb-8 text-gray-900 dark:text-white flex items-center gap-3">

                     <span class="w-8 h-8 bg-[#dc2d3d] text-white rounded flex items-center justify-center text-sm font-bold">06</span>
          Changes to These Terms
        </h2>
        <div class="bg-white dark:bg-gray-800 rounded-2xl p-8 border border-gray-200 dark:border-gray-700 shadow-sm">
          <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">The University may update these Terms at any time. Continued use of the system constitutes acceptance of updated terms.</p>
        </div>
      </section>

    </main>
  </div>

  @include('components.footer')
</body>

</html>