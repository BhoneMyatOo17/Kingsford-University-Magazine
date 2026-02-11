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

    // Sidebar active link
    const sidebarLinks = document.querySelectorAll('.sidebar-link');
    sidebarLinks.forEach(link => {
      link.addEventListener('click', function (e) {
        sidebarLinks.forEach(l => l.classList.remove('active'));
        this.classList.add('active');
      });
    });

    // Top navbar theme toggle
    const themeToggleTop = document.getElementById('theme-toggle-top');
    const themeToggleDarkIconTop = document.getElementById('theme-toggle-dark-icon-top');
    const themeToggleLightIconTop = document.getElementById('theme-toggle-light-icon-top');

    function updateAllThemeIcons(isDark) {
      // Update top navbar icons
      if (isDark) {
        themeToggleDarkIconTop?.classList.remove('hidden');
        themeToggleLightIconTop?.classList.add('hidden');
      } else {
        themeToggleLightIconTop?.classList.remove('hidden');
        themeToggleDarkIconTop?.classList.add('hidden');
      }
    }

    // Check initial theme
    if (document.documentElement.classList.contains('dark')) {
      updateAllThemeIcons(true);
    } else {
      updateAllThemeIcons(false);
    }

    // Function to toggle theme
    function toggleTheme() {
      const isDarkMode = document.documentElement.classList.contains('dark');

      if (isDarkMode) {
        document.documentElement.classList.remove('dark');
        document.documentElement.setAttribute('data-web-theme', 'light');
        localStorage.setItem('color-theme', 'light');
        updateAllThemeIcons(false);
      } else {
        document.documentElement.classList.add('dark');
        document.documentElement.setAttribute('data-web-theme', 'dark');
        localStorage.setItem('color-theme', 'dark');
        updateAllThemeIcons(true);
      }
    }

    // Add event listener to theme toggle
    if (themeToggleTop) {
      themeToggleTop.addEventListener('click', toggleTheme);
    }

    // Notification dropdown toggle
    const notificationButton = document.getElementById('notification-button');
    const notificationMenu = document.getElementById('notification-menu');
    const notificationDropdown = document.getElementById('notification-dropdown');

    if (notificationButton && notificationMenu) {
      notificationButton.addEventListener('click', function (e) {
        e.stopPropagation();
        notificationMenu.classList.toggle('hidden');
      });

      // Close dropdown when clicking outside
      document.addEventListener('click', function (e) {
        if (notificationDropdown && !notificationDropdown.contains(e.target)) {
          notificationMenu.classList.add('hidden');
        }
      });

      // Prevent closing when clicking inside the dropdown
      notificationMenu.addEventListener('click', function (e) {
        e.stopPropagation();
      });
    }
  });
</script>