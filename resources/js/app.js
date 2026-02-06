import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// ============================================
// THEME TOGGLE - Desktop & Mobile
// ============================================
document.addEventListener('DOMContentLoaded', function() {
    // Get all theme toggle elements
    const themeToggleBtn = document.getElementById('theme-toggle');
    const themeToggleMobileBtn = document.getElementById('theme-toggle-mobile');
    
    const themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
    const themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');
    
    const themeToggleDarkIconMobile = document.getElementById('theme-toggle-dark-icon-mobile');
    const themeToggleLightIconMobile = document.getElementById('theme-toggle-light-icon-mobile');

    // Function to update all icon states
    function updateAllThemeIcons(isDark) {
        if (isDark) {
            // Dark mode is ON - Show moon icons
            themeToggleDarkIcon?.classList.remove('hidden');
            themeToggleLightIcon?.classList.add('hidden');
            themeToggleDarkIconMobile?.classList.remove('hidden');
            themeToggleLightIconMobile?.classList.add('hidden');
        } else {
            // Light mode is ON - Show sun icons
            themeToggleLightIcon?.classList.remove('hidden');
            themeToggleDarkIcon?.classList.add('hidden');
            themeToggleLightIconMobile?.classList.remove('hidden');
            themeToggleDarkIconMobile?.classList.add('hidden');
        }
    }

    // Check for saved theme preference or default to light mode
    if (localStorage.getItem('color-theme') === 'dark' || 
        (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
        document.documentElement.setAttribute('data-web-theme', 'dark');
        updateAllThemeIcons(true);
        updateHeroImage(true); 

    } else {
        document.documentElement.classList.remove('dark');
        document.documentElement.setAttribute('data-web-theme', 'light');
        updateAllThemeIcons(false);
        updateHeroImage(false); 
    }

    // Function to toggle theme
    function toggleTheme() {
        const isDarkMode = document.documentElement.classList.contains('dark');
        
        if (isDarkMode) {
            // Switch to light mode
            document.documentElement.classList.remove('dark');
            document.documentElement.setAttribute('data-web-theme', 'light');
            localStorage.setItem('color-theme', 'light');
            updateAllThemeIcons(false);
            updateHeroImage(false); 
        } else {
            // Switch to dark mode
            document.documentElement.classList.add('dark');
            document.documentElement.setAttribute('data-web-theme', 'dark');
            localStorage.setItem('color-theme', 'dark');
            updateAllThemeIcons(true);
            updateHeroImage(true); 
        }
    }

    // Add event listeners to both buttons
    if (themeToggleBtn) {
        themeToggleBtn.addEventListener('click', toggleTheme);
    }
    
    if (themeToggleMobileBtn) {
        themeToggleMobileBtn.addEventListener('click', toggleTheme);
    }

    function updateHeroImage(isDark) {
    const heroes = document.querySelectorAll('[data-hero-light][data-hero-dark]');

    heroes.forEach(hero => {
        const lightImg = hero.getAttribute('data-hero-light');
        const darkImg = hero.getAttribute('data-hero-dark');

        hero.style.backgroundImage = `url('${isDark ? darkImg : lightImg}')`;
    });
}


});


// ============================================
// MOBILE MENU TOGGLE
// ============================================
document.addEventListener('DOMContentLoaded', function() {
    const navbarToggler = document.querySelector('.ic-navbar-toggler');
    const navbarMobile = document.querySelector('.ic-navbar-mobile');
    
    if (navbarToggler && navbarMobile) {
        navbarToggler.addEventListener('click', function() {
            navbarMobile.classList.toggle('hidden');
        });
    }
});


// ============================================
// MOBILE FACULTIES ACCORDION
// ============================================
document.addEventListener('DOMContentLoaded', function() {
    const mobileFacultiesToggle = document.getElementById('mobile-faculties-toggle');
    const mobileFacultiesMenu = document.getElementById('mobile-faculties-menu');

    if (mobileFacultiesToggle && mobileFacultiesMenu) {
        mobileFacultiesToggle.addEventListener('click', function() {
            mobileFacultiesMenu.classList.toggle('hidden');
            const arrow = this.querySelector('svg');
            if (arrow) {
                arrow.classList.toggle('rotate-180');
            }
        });
    }
});


// ============================================
// STICKY NAVBAR ON SCROLL
// ============================================
document.addEventListener('DOMContentLoaded', function() {
    const navbar = document.querySelector('.ic-navbar');
    const logoWhite = document.getElementById('logo-white');
    const logoRed = document.getElementById('logo-red');
    
    // Check if we're on a page with a hero section
    // Home page has #home with background-image
    // About page and other hero pages have sections with bg-cover bg-center (hero background pattern)
    const homeHero = document.querySelector('#home[style*="background-image"]');
    const aboutHero = document.querySelector('section[style*="background-image"].bg-cover');
    const hasHeroSection = homeHero !== null || aboutHero !== null;

    if (navbar) {
        if (hasHeroSection) {
            // Pages with hero sections: navbar starts transparent, becomes sticky on scroll
            window.addEventListener('scroll', function() {
                if (window.scrollY > 100) {
                    navbar.classList.add('sticky');
                    // Switch to red logo
                    logoWhite?.classList.add('hidden');
                    logoRed?.classList.remove('hidden');
                } else {
                    navbar.classList.remove('sticky');
                    // Switch to white logo
                    logoWhite?.classList.remove('hidden');
                    logoRed?.classList.add('hidden');
                }
            });
        } else {
            // All other pages: navbar is always sticky with red logo
            navbar.classList.add('sticky');
            logoWhite?.classList.add('hidden');
            logoRed?.classList.remove('hidden');
        }
    }
});


// ============================================
// SMOOTH SCROLL FOR NAVIGATION LINKS
// ============================================
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.ic-page-scroll').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            const targetSection = document.querySelector(targetId);
            
            if (targetSection) {
                targetSection.scrollIntoView({ behavior: 'smooth' });
            }
            
            // Close mobile menu if open
            const navbarMobile = document.querySelector('.ic-navbar-mobile');
            if (navbarMobile) {
                navbarMobile.classList.add('hidden');
            }
        });
    });
});


// ============================================
// SCROLL TO TOP BUTTON
// ============================================
document.addEventListener('DOMContentLoaded', function() {
    const scrollTopBtn = document.getElementById('scroll-top');
    
    if (scrollTopBtn) {
        window.addEventListener('scroll', function() {
            if (window.scrollY > 300) {
                scrollTopBtn.classList.remove('opacity-0', 'invisible');
            } else {
                scrollTopBtn.classList.add('opacity-0', 'invisible');
            }
        });

        scrollTopBtn.addEventListener('click', function() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }
});


// ============================================
// SHOW MORE PROGRAMS TOGGLE (Mobile Only)
// ============================================
document.addEventListener('DOMContentLoaded', function() {
    const showMoreBtn = document.getElementById('show-more-programs-btn');
    const showMoreArrow = document.getElementById('show-more-arrow');
    const hiddenCards = document.querySelectorAll('.faculty-card-hidden');
    let programsExpanded = false;

    if (showMoreBtn) {
        showMoreBtn.addEventListener('click', function() {
            programsExpanded = !programsExpanded;
            
            hiddenCards.forEach(card => {
                if (programsExpanded) {
                    card.classList.remove('hidden');
                    card.classList.add('block');
                } else {
                    card.classList.add('hidden');
                    card.classList.remove('block');
                }
            });

            // Update button text and arrow
            const buttonText = this.querySelector('span');
            if (programsExpanded) {
                buttonText.textContent = 'Show Less Programs';
                showMoreArrow.style.transform = 'rotate(180deg)';
            } else {
                buttonText.textContent = 'Show More Programs';
                showMoreArrow.style.transform = 'rotate(0deg)';
            }
        });
    }
});

