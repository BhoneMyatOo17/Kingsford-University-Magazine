<script>
  document.addEventListener('DOMContentLoaded', function () {
    // Sidebar toggle for mobile
    const sidebarToggle = document.getElementById('sidebar-toggle');
    const sidebarClose = document.getElementById('sidebar-close');
    const sidebar = document.getElementById('sidebar');
    const sidebarOverlay = document.getElementById('sidebar-overlay');

    if (sidebarToggle && sidebar && sidebarOverlay) {
      sidebarToggle.addEventListener('click', function () {
        sidebar.classList.remove('-translate-x-full');
        sidebarOverlay.classList.remove('hidden');
      });

      sidebarClose.addEventListener('click', function () {
        sidebar.classList.add('-translate-x-full');
        sidebarOverlay.classList.add('hidden');
      });

      sidebarOverlay.addEventListener('click', function () {
        sidebar.classList.add('-translate-x-full');
        sidebarOverlay.classList.add('hidden');
      });
    }

    // Dashboard theme toggle
    const themeToggleDashboard = document.getElementById('theme-toggle-dashboard');
    const themeToggleDarkIconDashboard = document.getElementById('theme-toggle-dark-icon-dashboard');
    const themeToggleLightIconDashboard = document.getElementById('theme-toggle-light-icon-dashboard');

    function updateDashboardThemeIcons(isDark) {
      if (isDark) {
        themeToggleDarkIconDashboard?.classList.remove('hidden');
        themeToggleLightIconDashboard?.classList.add('hidden');
      } else {
        themeToggleLightIconDashboard?.classList.remove('hidden');
        themeToggleDarkIconDashboard?.classList.add('hidden');
      }
    }

    // Check initial theme
    if (document.documentElement.classList.contains('dark')) {
      updateDashboardThemeIcons(true);
    } else {
      updateDashboardThemeIcons(false);
    }

    // Theme toggle click
    if (themeToggleDashboard) {
      themeToggleDashboard.addEventListener('click', function () {
        const isDarkMode = document.documentElement.classList.contains('dark');

        if (isDarkMode) {
          document.documentElement.classList.remove('dark');
          document.documentElement.setAttribute('data-web-theme', 'light');
          localStorage.setItem('color-theme', 'light');
          updateDashboardThemeIcons(false);
        } else {
          document.documentElement.classList.add('dark');
          document.documentElement.setAttribute('data-web-theme', 'dark');
          localStorage.setItem('color-theme', 'dark');
          updateDashboardThemeIcons(true);
        }
      });
    }
  });
</script>