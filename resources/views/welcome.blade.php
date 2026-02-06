<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kingsford University - Home</title>
    <link rel="preload" as="image" href="{{ asset('assets/hero.jpg') }}">
    <link rel="preload" as="image" href="{{ asset('assets/hero-night.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    @include('components.navigation')

    <!-- Hero Section -->
    <section id="home" data-hero-light="/assets/hero.jpg" data-hero-dark="/assets/hero-night.png"
        class="relative h-[70vh] md:h-[80vh] lg:min-h-screen flex items-end pb-16 lg:pb-24 bg-cover bg-center bg-no-repeat"
        style="background-image: url('{{ asset('assets/hero.jpg') }}');">

        <!-- Dark Overlay -->
        <div class="absolute inset-0 bg-black bg-opacity-20"></div>

        <!-- Content -->
        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-md lg:max-w-lg mx-auto lg:ml-8 xl:ml-16 lg:mx-0">
                <!-- Red Rectangle Overlay Box - Centered on mobile, left-aligned on desktop -->
                <div class="bg-[#dc2d3d] p-5 md:p-6 lg:p-8 rounded-lg shadow-2xl">
                    <h1 class="text-2xl md:text-3xl lg:text-4xl font-bold text-white mb-3 leading-tight">
                        Shape Your Future at Kingsford
                    </h1>
                    <p class="text-sm md:text-base text-white mb-5 leading-relaxed">
                        Empowering innovation, technology, and excellence in computer science education.
                    </p>
                    <a href="#about"
                        class="inline-flex items-center space-x-2 bg-white text-[#dc2d3d] px-5 py-2.5 rounded-md font-semibold text-sm hover:bg-opacity-90 transition-all shadow-lg">
                        <span>Explore Programs</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
            <svg class="w-6 h-6 md:w-8 md:h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
            </svg>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-12 md:py-16 lg:py-24 bg-[#dc2d3d]">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-4 gap-4 lg:gap-8">
                <div class="text-center">
                    <h3 class="text-3xl md:text-5xl lg:text-6xl font-bold text-white mb-1">3K+</h3>
                    <p class="text-xs md:text-lg lg:text-xl text-white font-medium">Students</p>
                </div>
                <div class="text-center">
                    <h3 class="text-3xl md:text-5xl lg:text-6xl font-bold text-white mb-1">9</h3>
                    <p class="text-xs md:text-lg lg:text-xl text-white font-medium">Faculties</p>
                </div>
                <div class="text-center">
                    <h3 class="text-3xl md:text-5xl lg:text-6xl font-bold text-white mb-1">45+</h3>
                    <p class="text-xs md:text-lg lg:text-xl text-white font-medium">Programs</p>
                </div>
                <div class="text-center">
                    <h3 class="text-3xl md:text-5xl lg:text-6xl font-bold text-white mb-1">150+</h3>
                    <p class="text-xs md:text-lg lg:text-xl text-white font-medium">Research</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="section-area">
        <div class="container mx-auto px-4">
            <div class="row items-center">
                <div class="col-12 lg:col-6">
                    <div class="mb-8 lg:mb-0">
                        <img src="{{ asset('assets/introduction.jpg') }}" alt="Kingsford Campus"
                            class="rounded-lg shadow-xl w-full h-auto">
                    </div>
                </div>
                <div class="col-12 lg:col-6">
                    <div class="lg:pl-12">
                        <span class="text-[#dc2d3d] font-semibold text-sm uppercase tracking-wider mb-4 block">About Our
                            University</span>
                        <h2 class="text-3xl md:text-4xl font-bold mb-6">
                            An Introduction To Our <span class="text-[#dc2d3d]">University</span>
                        </h2>
                        <p class="text-gray-600 dark:text-gray-300 mb-6 leading-relaxed">
                            Unlock your potential and shape a brighter tomorrow with Kingsford University—where
                            innovation, knowledge, and opportunities come together to pave the way for your success.
                        </p>

                        <div class="space-y-4 mb-8">
                            <div class="flex items-start space-x-4">
                                <div
                                    class="flex-shrink-0 w-12 h-12 bg-[#dc2d3d] rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-lg mb-1">Industry-Leading Excellence</h4>
                                    <p class="text-gray-600 dark:text-gray-300">We are committed to fostering a culture
                                        of excellence, ensuring our programs prepare students for global success.</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-4">
                                <div
                                    class="flex-shrink-0 w-12 h-12 bg-[#dc2d3d] rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-lg mb-1">Trusted By Students</h4>
                                    <p class="text-gray-600 dark:text-gray-300">More trusted & recommended by students
                                        across the nation for academic excellence and career growth.</p>
                                </div>
                            </div>
                        </div>

                        <a href="#"
                            class="inline-flex items-center space-x-2 bg-[#dc2d3d]  text-white px-6 py-3 rounded-md font-semibold hover:text-white hover:bg-[#b82532] dark:bg-white dark:text-[#dc2d3d] dark:hover:bg-gray-100 transition-all shadow-lg">
                            <span>Learn More About Us</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Faculties Highlight Section -->
    <section class="section-area">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <span class="text-[#dc2d3d] font-semibold text-sm uppercase tracking-wider mb-4 block">Our
                    Faculties</span>
                <h2 class="text-3xl md:text-4xl font-bold mb-4">
                    Explore Our <span class="text-[#dc2d3d]">Academic Programs</span>
                </h2>
                <p class="text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                    Choose from world-class programs across nine specialized faculties, each designed to equip you with
                    cutting-edge skills and knowledge.
                </p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6 md:gap-8">
                <!-- Faculty Card 1 -->
                <div
                    class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-4 md:p-6 lg:p-8 hover:shadow-xl transition-all hover:-translate-y-2">
                    <div
                        class="w-12 h-12 md:w-16 md:h-16 bg-[#dc2d3d] rounded-lg flex items-center justify-center mb-4 md:mb-6">
                        <svg class="w-6 h-6 md:w-8 md:h-8 text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                        </svg>
                    </div>
                    <h3 class="text-base md:text-lg lg:text-xl font-bold mb-2 md:mb-3">Software Engineering</h3>
                    <p class="text-sm md:text-base text-gray-600 dark:text-gray-300 mb-3 md:mb-4 line-clamp-2">Master
                        the art of building scalable, secure, and
                        innovative software solutions for the digital age.</p>
                    <a href="#"
                        class="text-[#dc2d3d] text-sm md:text-base font-semibold hover:underline inline-flex items-center">
                        Learn More
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>

                <!-- Faculty Card 2 -->
                <div
                    class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-4 md:p-6 lg:p-8 hover:shadow-xl transition-all hover:-translate-y-2">
                    <div
                        class="w-12 h-12 md:w-16 md:h-16 bg-[#dc2d3d] rounded-lg flex items-center justify-center mb-4 md:mb-6">
                        <svg class="w-6 h-6 md:w-8 md:h-8 text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                        </svg>
                    </div>
                    <h3 class="text-base md:text-lg lg:text-xl font-bold mb-2 md:mb-3">Computer Network</h3>
                    <p class="text-sm md:text-base text-gray-600 dark:text-gray-300 mb-3 md:mb-4 line-clamp-2">Design
                        and manage robust network infrastructures
                        that power global connectivity and communications.</p>
                    <a href="#"
                        class="text-[#dc2d3d] text-sm md:text-base font-semibold hover:underline inline-flex items-center">
                        Learn More
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>

                <!-- Faculty Card 3 -->
                <div
                    class="hidden md:block bg-white dark:bg-gray-800 rounded-lg shadow-lg p-4 md:p-6 lg:p-8 hover:shadow-xl transition-all hover:-translate-y-2 faculty-card-hidden">
                    <div
                        class="w-12 h-12 md:w-16 md:h-16 bg-[#dc2d3d] rounded-lg flex items-center justify-center mb-4 md:mb-6">
                        <svg class="w-6 h-6 md:w-8 md:h-8 text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-base md:text-lg lg:text-xl font-bold mb-2 md:mb-3">Computer Science</h3>
                    <p class="text-sm md:text-base text-gray-600 dark:text-gray-300 mb-3 md:mb-4 line-clamp-2">Explore
                        the fundamentals of computing, algorithms,
                        and theoretical foundations of technology.</p>
                    <a href="#"
                        class="text-[#dc2d3d] text-sm md:text-base font-semibold hover:underline inline-flex items-center">
                        Learn More
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>

                <!-- Faculty Card 4 -->
                <div
                    class="hidden md:block bg-white dark:bg-gray-800 rounded-lg shadow-lg p-4 md:p-6 lg:p-8 hover:shadow-xl transition-all hover:-translate-y-2 faculty-card-hidden">
                    <div
                        class="w-12 h-12 md:w-16 md:h-16 bg-[#dc2d3d] rounded-lg flex items-center justify-center mb-4 md:mb-6">
                        <svg class="w-6 h-6 md:w-8 md:h-8 text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <h3 class="text-base md:text-lg lg:text-xl font-bold mb-2 md:mb-3">Cybersecurity</h3>
                    <p class="text-sm md:text-base text-gray-600 dark:text-gray-300 mb-3 md:mb-4 line-clamp-2">Protect
                        digital assets and combat cyber threats
                        with advanced security methodologies and practices.</p>
                    <a href="#"
                        class="text-[#dc2d3d] text-sm md:text-base font-semibold hover:underline inline-flex items-center">
                        Learn More
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>

                <!-- Faculty Card 5 -->
                <div
                    class="hidden md:block bg-white dark:bg-gray-800 rounded-lg shadow-lg p-4 md:p-6 lg:p-8 hover:shadow-xl transition-all hover:-translate-y-2 faculty-card-hidden">
                    <div
                        class="w-12 h-12 md:w-16 md:h-16 bg-[#dc2d3d] rounded-lg flex items-center justify-center mb-4 md:mb-6">
                        <svg class="w-6 h-6 md:w-8 md:h-8 text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h3 class="text-base md:text-lg lg:text-xl font-bold mb-2 md:mb-3">Data Science & AI</h3>
                    <p class="text-sm md:text-base text-gray-600 dark:text-gray-300 mb-3 md:mb-4 line-clamp-2">Harness
                        the power of data and artificial
                        intelligence to drive insights and innovation.</p>
                    <a href="#"
                        class="text-[#dc2d3d] text-sm md:text-base font-semibold hover:underline inline-flex items-center">
                        Learn More
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>

                <!-- Faculty Card 6 -->
                <div
                    class="hidden md:block bg-white dark:bg-gray-800 rounded-lg shadow-lg p-4 md:p-6 lg:p-8 hover:shadow-xl transition-all hover:-translate-y-2 faculty-card-hidden">
                    <div
                        class="w-12 h-12 md:w-16 md:h-16 bg-[#dc2d3d] rounded-lg flex items-center justify-center mb-4 md:mb-6">
                        <svg class="w-6 h-6 md:w-8 md:h-8 text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-base md:text-lg lg:text-xl font-bold mb-2 md:mb-3">FinTech</h3>
                    <p class="text-sm md:text-base text-gray-600 dark:text-gray-300 mb-3 md:mb-4 line-clamp-2">Bridge
                        technology and finance to revolutionize
                        banking, payments, and financial services.</p>
                    <a href="#"
                        class="text-[#dc2d3d] text-sm md:text-base font-semibold hover:underline inline-flex items-center">
                        Learn More
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>

                <!-- Faculty Card 7 -->
                <div
                    class="hidden md:block bg-white dark:bg-gray-800 rounded-lg shadow-lg p-4 md:p-6 lg:p-8 hover:shadow-xl transition-all hover:-translate-y-2 faculty-card-hidden">
                    <div
                        class="w-12 h-12 md:w-16 md:h-16 bg-[#dc2d3d] rounded-lg flex items-center justify-center mb-4 md:mb-6">
                        <svg class="w-6 h-6 md:w-8 md:h-8 text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-base md:text-lg lg:text-xl font-bold mb-2 md:mb-3">Business IT</h3>
                    <p class="text-sm md:text-base text-gray-600 dark:text-gray-300 mb-3 md:mb-4 line-clamp-2">Combine
                        business acumen with technical expertise to
                        lead digital transformation initiatives.</p>
                    <a href="#"
                        class="text-[#dc2d3d] text-sm md:text-base font-semibold hover:underline inline-flex items-center">
                        Learn More
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>

                <!-- Faculty Card 8 -->
                <div
                    class="hidden md:block bg-white dark:bg-gray-800 rounded-lg shadow-lg p-4 md:p-6 lg:p-8 hover:shadow-xl transition-all hover:-translate-y-2 faculty-card-hidden">
                    <div
                        class="w-12 h-12 md:w-16 md:h-16 bg-[#dc2d3d] rounded-lg flex items-center justify-center mb-4 md:mb-6">
                        <svg class="w-6 h-6 md:w-8 md:h-8 text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <h3 class="text-base md:text-lg lg:text-xl font-bold mb-2 md:mb-3">Information Systems</h3>
                    <p class="text-sm md:text-base text-gray-600 dark:text-gray-300 mb-3 md:mb-4 line-clamp-2">Integrate
                        technology and business processes to
                        optimize organizational efficiency and innovation.</p>
                    <a href="#"
                        class="text-[#dc2d3d] text-sm md:text-base font-semibold hover:underline inline-flex items-center">
                        Learn More
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>

                <!-- Faculty Card 9 -->
                <div
                    class="hidden md:block bg-white dark:bg-gray-800 rounded-lg shadow-lg p-4 md:p-6 lg:p-8 hover:shadow-xl transition-all hover:-translate-y-2 faculty-card-hidden">
                    <div
                        class="w-12 h-12 md:w-16 md:h-16 bg-[#dc2d3d] rounded-lg flex items-center justify-center mb-4 md:mb-6">
                        <svg class="w-6 h-6 md:w-8 md:h-8 text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z" />
                        </svg>
                    </div>
                    <h3 class="text-base md:text-lg lg:text-xl font-bold mb-2 md:mb-3">Cloud Computing</h3>
                    <p class="text-sm md:text-base text-gray-600 dark:text-gray-300 mb-3 md:mb-4 line-clamp-2">Master
                        cloud technologies and architecture to build
                        scalable, resilient distributed systems.</p>
                    <a href="#"
                        class="text-[#dc2d3d] text-sm md:text-base font-semibold hover:underline inline-flex items-center">
                        Learn More
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Show More Button (Mobile Only) -->
            <div class="text-center mt-8 md:hidden">
                <button id="show-more-programs-btn"
                    class="inline-flex items-center space-x-2 bg-[#dc2d3d] text-white px-6 py-3 rounded-md font-semibold hover:bg-[#b82532] transition-all shadow-lg">
                    <span>Show More Programs</span>
                    <svg class="w-5 h-5 transition-transform" id="show-more-arrow" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
            </div>
        </div>
    </section>

    <!-- Magazine & Testimonies Section -->
    <section id="magazine" class="section-area">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <span class="text-[#dc2d3d] font-semibold text-sm uppercase tracking-wider mb-4 block">Student
                    Voices</span>
                <h2 class="text-3xl md:text-4xl font-bold mb-4">
                    Our <span class="text-[#dc2d3d]">Magazine</span> & Student Stories
                </h2>
                <p class="text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                    Discover inspiring stories, academic achievements, and creative contributions from our vibrant
                    student community.
                </p>
            </div>

            <div class="row">
                <!-- Magazine Feature -->
                <div class="col-12 lg:col-6 mb-8 lg:mb-0">
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden h-full">
                        <img src="{{ asset('assets/magazine.jpg') }}" alt="Latest Magazine"
                            class="w-full h-64 object-cover">
                        <div class="p-8">
                            <span
                                class="text-[#dc2d3d] font-semibold text-sm uppercase tracking-wider mb-2 block">Latest
                                Edition</span>
                            <h3 class="text-2xl font-bold mb-4">Annual Student Magazine 2025</h3>
                            <p class="text-gray-600 dark:text-gray-300 mb-6">
                                Explore a collection of outstanding articles, research papers, creative
                                writing, and photography submitted by our talented students across all faculties.
                            </p>
                            <div class="flex items-center justify-between">
                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                    <span class="font-semibold">250+</span> Contributions
                                </div>
                                <a href="#"
                                    class="inline-flex items-center text-[#dc2d3d] font-semibold hover:underline">
                                    Read Magazine
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Student Testimonials -->
                <div class="col-12 lg:col-6">
                    <div class="space-y-6">
                        <!-- Testimony 1 -->
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 hover:shadow-xl transition-all">
                            <div class="flex items-start space-x-4">
                                <img src="{{ asset('assets/profile-1.jpg') }}" alt="Student"
                                    class="w-16 h-16 rounded-full object-cover flex-shrink-0">
                                <div class="flex-1">
                                    <div class="flex items-center justify-between mb-2">
                                        <h4 class="font-bold text-lg">Sarah Mitchell</h4>
                                        <span class="text-sm text-gray-500 dark:text-gray-400">Software
                                            Engineering</span>
                                    </div>
                                    <p class="text-gray-600 dark:text-gray-300 text-sm mb-3">
                                        "Kingsford University has been instrumental in shaping my career. The hands-on
                                        projects and industry connections opened doors I never imagined possible."
                                    </p>
                                    <div class="flex text-[#dc2d3d]">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Testimony 2 -->
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 hover:shadow-xl transition-all">
                            <div class="flex items-start space-x-4">
                                <img src="{{ asset('assets/profile-2.jpg') }}" alt="Student"
                                    class="w-16 h-16 rounded-full object-cover flex-shrink-0">
                                <div class="flex-1">
                                    <div class="flex items-center justify-between mb-2">
                                        <h4 class="font-bold text-lg">James Rodriguez</h4>
                                        <span class="text-sm text-gray-500 dark:text-gray-400">Data Science & AI</span>
                                    </div>
                                    <p class="text-gray-600 dark:text-gray-300 text-sm mb-3">
                                        "The research opportunities and cutting-edge curriculum at Kingsford prepared me
                                        to tackle real-world challenges in AI and machine learning."
                                    </p>
                                    <div class="flex text-[#dc2d3d]">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Testimony 3 -->
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 hover:shadow-xl transition-all">
                            <div class="flex items-start space-x-4">
                                <img src="{{ asset('assets/profile-3.jpg') }}" alt="Student"
                                    class="w-16 h-16 rounded-full object-cover flex-shrink-0">
                                <div class="flex-1">
                                    <div class="flex items-center justify-between mb-2">
                                        <h4 class="font-bold text-lg">Emily Chen</h4>
                                        <span class="text-sm text-gray-500 dark:text-gray-400">Cybersecurity</span>
                                    </div>
                                    <p class="text-gray-600 dark:text-gray-300 text-sm mb-3">
                                        "The cybersecurity program equipped me with practical skills and certifications
                                        that made me job-ready from day one after graduation."
                                    </p>
                                    <div class="flex text-[#dc2d3d]">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-12">
                <a href="#"
                    class="inline-flex items-center space-x-2 bg-[#dc2d3d] hover:text-white text-white px-8 py-4 rounded-md font-semibold text-lg hover:bg-[#b82532] dark:bg-white dark:text-[#dc2d3d] dark:hover:bg-gray-100 transition-all shadow-lg">
                    <span>Submit Your Article</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    @include('components.footer')
</body>

</html>