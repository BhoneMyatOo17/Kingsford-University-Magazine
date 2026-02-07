<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us - Kingsford University</title>
  <link rel="preload" as="image" href="{{ asset('assets/us.jpg') }}">
  <link rel="preload" as="image" href="{{ asset('assets/us-night.png') }}">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
  @include('components.navigation')

  <!-- Page Header -->
  <section id="about" data-hero-light="{{ asset('assets/us.jpg') }}" data-hero-dark="{{ asset('assets/us-night.png') }}"
    class="relative bg-cover bg-center bg-no-repeat text-white min-h-screen flex items-center"
    style="background-image: url('{{ asset('assets/us.jpg') }}');">
    <!-- Dark Tinted Overlay -->
    <div class="absolute inset-0 bg-gray-900 bg-opacity-30"></div>

    <!-- Content -->
    <div class="container mx-auto px-4 relative z-10">
      <div class="max-w-3xl mx-auto text-center">
        <span class="text-white/80 font-semibold text-sm uppercase tracking-wider mb-4 block">
          About Us
        </span>
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 text-white">About Kingsford University</h1>
        <p class="text-lg md:text-xl text-white/90 leading-relaxed">
          Founded in 1989, Kingsford University is a provider of high-quality education and technology. The university
          equips students with practical skills and academic knowledge with the information needed to be successful in a
          global digital economy.
        </p>
      </div>
    </div>
  </section>

  <!-- University Bio/History Section -->
  <section class="section-area">
    <div class="container mx-auto px-10">
      <div class="row items-center">
        <div class="col-12 lg:col-6">
          <div class="mb-8 lg:mb-0">
            <span class="text-[#dc2d3d] font-semibold text-sm uppercase tracking-wider mb-4 block">
              Our Story
            </span>
            <h2 class="text-3xl md:text-4xl font-bold mb-6">
              A Legacy of <span class="text-[#dc2d3d]">Excellence</span>
            </h2>
            <div class="space-y-4 text-gray-600 dark:text-gray-300">
              <p>Kingsford University was founded in 1989 with a clear vision to provide high-quality education in the
                areas of technology and applied disciplines. The university was set up to support students who have a
                practical knowledge and good academic foundation.</p>
              <p>Over the years, Kingsford University has added to its academic programmes and how it teaches. Key
                milestones include development of the curriculum in line with industry requirements and sustained
                investment in learning resources.</p>
              <p>Today, Kingsford University is a future-ready University with a vision and mission for innovation and
                global relevance. The university continues to enhance the academic quality and prepare graduates for the
                challenges of being a future professional.</p>
            </div>
          </div>
        </div>
        <div class="col-12 lg:col-6">
          <div class="lg:pl-12">
            <img src="{{ asset('assets/campus.jpg') }}" alt="Kingsford University Campus"
              class="rounded-lg shadow-xl w-full h-auto">
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-2 text-center">
              Modern campus facilities supporting innovation and learning
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Mission, Vision & Values Section -->
  <section class="section-area">
    <div class="container mx-auto px-4">
      <div class="text-center mb-16">
        <span class="text-[#dc2d3d] font-semibold text-sm uppercase tracking-wider mb-4 block">
          What Drives Us
        </span>
        <h2 class="text-3xl md:text-4xl font-bold mb-4">
          Our <span class="text-[#dc2d3d]">Mission & Vision</span>
        </h2>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Mission -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8 hover:shadow-xl transition-all">
          <div class="w-16 h-16 bg-[#dc2d3d] rounded-lg flex items-center justify-center mb-6 mx-auto">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
          </div>
          <h3 class="text-2xl font-bold mb-4 text-center">Our Mission</h3>
          <p class="text-gray-600 dark:text-gray-300 text-center">
            To provide high-quality education that combines academic knowledge with practical skills and professional
            competence.
          </p>
        </div>

        <!-- Vision -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8 hover:shadow-xl transition-all">
          <div class="w-16 h-16 bg-[#dc2d3d] rounded-lg flex items-center justify-center mb-6 mx-auto">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>
          </div>
          <h3 class="text-2xl font-bold mb-4 text-center">Our Vision</h3>
          <p class="text-gray-600 dark:text-gray-300 text-center">
            To be a recognised institution for excellence in technology and applied education with global impact.
          </p>
        </div>

        <!-- Values -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8 hover:shadow-xl transition-all">
          <div class="w-16 h-16 bg-[#dc2d3d] rounded-lg flex items-center justify-center mb-6 mx-auto">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
            </svg>
          </div>
          <h3 class="text-2xl font-bold mb-4 text-center">Our Values</h3>
          <p class="text-gray-600 dark:text-gray-300 text-center">
            Excellence, Innovation, Integrity, Inclusion, and Collaboration guide every aspect of our academic
            community.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- Leadership Team Section -->
  <section class="section-area">
    <div class="container mx-auto px-4">
      <div class="text-center mb-16">
        <span class="text-[#dc2d3d] font-semibold text-sm uppercase tracking-wider mb-4 block">
          Meet Our Team
        </span>
        <h2 class="text-3xl md:text-4xl font-bold mb-4">
          University <span class="text-[#dc2d3d]">Leadership</span>
        </h2>
        <p class="text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
          Our experienced leadership team is committed to academic excellence and the success of every student.
        </p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
        <!-- Leader 1 - Chancellor/President -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-all">
          <div class="aspect-square bg-gray-200 dark:bg-gray-700">
            <img src="{{ asset('assets/robert.jpg') }}" alt="Chancellor Name" class="w-full h-full object-cover">
          </div>
          <div class="p-6 text-center">
            <h3 class="text-xl font-bold mb-1">Dr. Robert Williams</h3>
            <p class="text-[#dc2d3d] font-semibold text-sm mb-3">Chancellor</p>
            <p class="text-gray-600 dark:text-gray-300 text-sm">
              PhD in Education Management. Over 20 years in higher education leadership, focusing on academic innovation
              and student success.
            </p>
          </div>
        </div>

        <!-- Leader 2 - Vice Chancellor -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-all">
          <div class="aspect-square bg-gray-200 dark:bg-gray-700">
            <img src="{{ asset('assets/sarah.jpg') }}" alt="Vice Chancellor Name" class="w-full h-full object-cover">
          </div>
          <div class="p-6 text-center">
            <h3 class="text-xl font-bold mb-1">Prof. Sarah Johnson</h3>
            <p class="text-[#dc2d3d] font-semibold text-sm mb-3">Vice Chancellor</p>
            <p class="text-gray-600 dark:text-gray-300 text-sm">
              Expert in Computer Science with international teaching experience. Leads academic strategy and curriculum
              development.
            </p>
          </div>
        </div>

        <!-- Leader 3 - Dean of Academic Affairs -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-all">
          <div class="aspect-square bg-gray-200 dark:bg-gray-700">
            <img src="{{ asset('assets/michael.jpg') }}" alt="Dean Name" class="w-full h-full object-cover">
          </div>
          <div class="p-6 text-center">
            <h3 class="text-xl font-bold mb-1">Dr. Michael Chen</h3>
            <p class="text-[#dc2d3d] font-semibold text-sm mb-3">Dean of Academic Affairs</p>
            <p class="text-gray-600 dark:text-gray-300 text-sm">
              Specialises in educational quality assurance and academic programme development with 15 years of
              experience.
            </p>
          </div>
        </div>

        <!-- Leader 4 - Director of Student Services -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-all">
          <div class="aspect-square bg-gray-200 dark:bg-gray-700">
            <img src="{{ asset('assets/emily.jpg') }}" alt="Director Name" class="w-full h-full object-cover">
          </div>
          <div class="p-6 text-center">
            <h3 class="text-xl font-bold mb-1">Ms. Emily Rodriguez</h3>
            <p class="text-[#dc2d3d] font-semibold text-sm mb-3">Director of Student Services</p>
            <p class="text-gray-600 dark:text-gray-300 text-sm">
              Dedicated to student welfare and support services. Oversees counselling, career guidance, and student
              activities.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Why Choose Kingsford Section -->
  <section class="section-area">
    <div class="container mx-auto px-4">
      <div class="text-center mb-16">
        <span class="text-[#dc2d3d] font-semibold text-sm uppercase tracking-wider mb-4 block">
          Why Kingsford
        </span>
        <h2 class="text-3xl md:text-4xl font-bold mb-4">
          Why Choose <span class="text-[#dc2d3d]">Kingsford University</span>
        </h2>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Reason 1 -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8 hover:shadow-xl transition-all">
          <div class="w-16 h-16 bg-[#dc2d3d] rounded-lg flex items-center justify-center mb-6">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
            </svg>
          </div>
          <h3 class="text-xl font-bold mb-3">Industry-Relevant Curriculum</h3>
          <p class="text-gray-600 dark:text-gray-300">
            Our programmes are designed in collaboration with industry partners to ensure graduates have the skills
            employers need.
          </p>
        </div>

        <!-- Reason 2 -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8 hover:shadow-xl transition-all">
          <div class="w-16 h-16 bg-[#dc2d3d] rounded-lg flex items-center justify-center mb-6">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
            </svg>
          </div>
          <h3 class="text-xl font-bold mb-3">Modern Facilities</h3>
          <p class="text-gray-600 dark:text-gray-300">
            State-of-the-art computer labs, libraries, and learning spaces equipped with the latest technology and
            resources.
          </p>
        </div>

        <!-- Reason 3 -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8 hover:shadow-xl transition-all">
          <div class="w-16 h-16 bg-[#dc2d3d] rounded-lg flex items-center justify-center mb-6">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
          </div>
          <h3 class="text-xl font-bold mb-3">Experienced Faculty</h3>
          <p class="text-gray-600 dark:text-gray-300">
            Learn from qualified academics and industry professionals who bring real-world experience to the classroom.
          </p>
        </div>

        <!-- Reason 4 -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8 hover:shadow-xl transition-all">
          <div class="w-16 h-16 bg-[#dc2d3d] rounded-lg flex items-center justify-center mb-6">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
          </div>
          <h3 class="text-xl font-bold mb-3">Career Support</h3>
          <p class="text-gray-600 dark:text-gray-300">
            Dedicated career services including internship placement, job fairs, and professional development workshops.
          </p>
        </div>

        <!-- Reason 5 -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8 hover:shadow-xl transition-all">
          <div class="w-16 h-16 bg-[#dc2d3d] rounded-lg flex items-center justify-center mb-6">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
          </div>
          <h3 class="text-xl font-bold mb-3">Global Perspective</h3>
          <p class="text-gray-600 dark:text-gray-300">
            International partnerships and exchange programmes provide students with global learning opportunities.
          </p>
        </div>

        <!-- Reason 6 -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8 hover:shadow-xl transition-all">
          <div class="w-16 h-16 bg-[#dc2d3d] rounded-lg flex items-center justify-center mb-6">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
            </svg>
          </div>
          <h3 class="text-xl font-bold mb-3">Accredited Programmes</h3>
          <p class="text-gray-600 dark:text-gray-300">
            All programmes are accredited and recognised nationally and internationally, ensuring quality education.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- Campus Life & Facilities Section -->
  <section class="section-area">
    <div class="container mx-auto px-4">
      <div class="text-center mb-16">
        <span class="text-[#dc2d3d] font-semibold text-sm uppercase tracking-wider mb-4 block">
          Experience Kingsford
        </span>
        <h2 class="text-3xl md:text-4xl font-bold mb-4">
          Campus <span class="text-[#dc2d3d]">Life & Facilities</span>
        </h2>
        <p class="text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
          Our modern campus provides an ideal environment for learning, research, and personal development.
        </p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Facility 1 -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-all">
          <div class="aspect-video bg-gray-200 dark:bg-gray-700">
            <img src="{{ asset('assets/library.jpg') }}" alt="Library" class="w-full h-full object-cover">
          </div>
          <div class="p-6">
            <h3 class="text-xl font-bold mb-2">State-of-the-Art Library</h3>
            <p class="text-gray-600 dark:text-gray-300 text-sm">
              A spacious library with physical and digital resources, quiet study areas, and online access. Open daily
              to support study, research, and independent learning.
            </p>
          </div>
        </div>

        <!-- Facility 2 -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-all">
          <div class="aspect-video bg-gray-200 dark:bg-gray-700">
            <img src="{{ asset('assets/computer.jpg') }}" alt="Computer Labs" class="w-full h-full object-cover">
          </div>
          <div class="p-6">
            <h3 class="text-xl font-bold mb-2">Modern Computer Labs</h3>
            <p class="text-gray-600 dark:text-gray-300 text-sm">
              Equipped with up-to-date hardware and industry-standard software. Available for teaching, practical work,
              and student projects.
            </p>
          </div>
        </div>

        <!-- Facility 3 -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-all">
          <div class="aspect-video bg-gray-200 dark:bg-gray-700">
            <img src="{{ asset('assets/cafeteria.jpg') }}" alt="Student Center" class="w-full h-full object-cover">
          </div>
          <div class="p-6">
            <h3 class="text-xl font-bold mb-2">Student Center & Cafeteria</h3>
            <p class="text-gray-600 dark:text-gray-300 text-sm">
              Provides dining options, recreational facilities, and social spaces. Designed to support student
              interaction, relaxation, and campus life.
            </p>
          </div>
        </div>

        <!-- Facility 4 -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-all">
          <div class="aspect-video bg-gray-200 dark:bg-gray-700">
            <img src="{{ asset('assets/sport.jpg') }}" alt="Sports Complex" class="w-full h-full object-cover">
          </div>
          <div class="p-6">
            <h3 class="text-xl font-bold mb-2">Sports & Recreation</h3>
            <p class="text-gray-600 dark:text-gray-300 text-sm">
              Comprehensive sports facilities including gymnasium, sports fields, and fitness centre for student health
              and recreation.
            </p>
          </div>
        </div>

        <!-- Facility 5 -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-all">
          <div class="aspect-video bg-gray-200 dark:bg-gray-700">
            <img src="{{ asset('assets/lab.jpg') }}" alt="Research Centers" class="w-full h-full object-cover">
          </div>
          <div class="p-6">
            <h3 class="text-xl font-bold mb-2">Research & Innovation Hub</h3>
            <p class="text-gray-600 dark:text-gray-300 text-sm">
              Dedicated facilities for research activities, innovation projects, and collaborative work with industry
              partners.
            </p>
          </div>
        </div>

        <!-- Facility 6 -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-all">
          <div class="aspect-video bg-gray-200 dark:bg-gray-700">
            <img src="{{ asset('assets/dorm.jpg') }}" alt="Student Housing" class="w-full h-full object-cover">
          </div>
          <div class="p-6">
            <h3 class="text-xl font-bold mb-2">Student Accommodation</h3>
            <p class="text-gray-600 dark:text-gray-300 text-sm">
              Comfortable on-campus accommodation options providing a safe and convenient living environment for
              students.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Statistics & Achievements Section -->
  <section class="py-16 lg:py-24 bg-[#dc2d3d]">
    <div class="container mx-auto px-4">
      <div class="text-center mb-12">
        <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
          Kingsford by the Numbers
        </h2>
      </div>

      <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
        <div class="text-center">
          <h3 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-2">
            35+
          </h3>
          <p class="text-lg md:text-xl text-white font-medium">
            Years of Excellence
          </p>
        </div>

        <div class="text-center">
          <h3 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-2">
            92%
          </h3>
          <p class="text-lg md:text-xl text-white font-medium">
            Graduate Employment Rate
          </p>
        </div>

        <div class="text-center">
          <h3 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-2">
            150+
          </h3>
          <p class="text-lg md:text-xl text-white font-medium">
            Faculty Members
          </p>
        </div>

        <div class="text-center">
          <h3 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-2">
            60+
          </h3>
          <p class="text-lg md:text-xl text-white font-medium">
            Industry Partnerships
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- Call to Action Section -->
  <section class="section-area">
    <div class="container mx-auto px-4">
      <div
        class="bg-gradient-to-r from-[#dc2d3d] to-[#b82532] rounded-2xl shadow-2xl p-12 lg:p-16 text-center text-white">
        <h2 class="text-3xl text-white md:text-4xl lg:text-5xl font-bold mb-4">
          Ready to Join Our Community?
        </h2>
        <p class="text-lg md:text-xl mb-8 max-w-2xl mx-auto opacity-80">
          Begin your journey with Kingsford University and shape your future through high-quality education. Apply now
          or visit the campus to experience our learning environment and opportunities.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
          <a href="#"
            class="inline-flex items-center justify-center space-x-2 bg-white text-[#dc2d3d] px-8 py-4 rounded-md font-semibold text-lg hover:bg-gray-100 transition-all shadow-lg">
            <span>Apply Now</span>
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
            </svg>
          </a>
          <a href="#"
            class="inline-flex items-center justify-center dark:text-white space-x-2 border-2 border-white text-white px-8 py-4 rounded-md font-semibold text-lg hover:bg-white hover:text-[#dc2d3d] transition-all">
            <span>Schedule a Visit</span>
          </a>
        </div>
      </div>
    </div>
  </section>

  @include('components.footer')
</body>

</html>