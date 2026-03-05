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
    document.querySelectorAll('.sidebar-link').forEach(function (link) {
      link.addEventListener('click', function () {
        document.querySelectorAll('.sidebar-link').forEach(function (l) { l.classList.remove('active'); });
        this.classList.add('active');
      });
    });

    // Theme toggle
    const themeToggleTop = document.getElementById('theme-toggle-top');
    const themeToggleDarkIconTop = document.getElementById('theme-toggle-dark-icon-top');
    const themeToggleLightIconTop = document.getElementById('theme-toggle-light-icon-top');

    function updateAllThemeIcons(isDark) {
      if (isDark) {
        themeToggleDarkIconTop?.classList.remove('hidden');
        themeToggleLightIconTop?.classList.add('hidden');
      } else {
        themeToggleLightIconTop?.classList.remove('hidden');
        themeToggleDarkIconTop?.classList.add('hidden');
      }
    }

    updateAllThemeIcons(document.documentElement.classList.contains('dark'));

    function toggleTheme() {
      const isDark = document.documentElement.classList.contains('dark');
      document.documentElement.classList.toggle('dark', !isDark);
      document.documentElement.setAttribute('data-web-theme', isDark ? 'light' : 'dark');
      localStorage.setItem('color-theme', isDark ? 'light' : 'dark');
      updateAllThemeIcons(!isDark);
    }

    if (themeToggleTop) themeToggleTop.addEventListener('click', toggleTheme);

    // Notification dropdown
    const notificationButton = document.getElementById('notification-button');
    const notificationMenu = document.getElementById('notification-menu');
    const notificationDropdown = document.getElementById('notification-dropdown');

    if (notificationButton && notificationMenu) {
      notificationButton.addEventListener('click', function (e) {
        e.stopPropagation();
        notificationMenu.classList.toggle('hidden');
      });

      document.addEventListener('click', function (e) {
        if (notificationDropdown && !notificationDropdown.contains(e.target)) {
          notificationMenu.classList.add('hidden');
        }
      });
    }

    // Badge update helper
    function updateBadge() {
      var remaining = document.querySelectorAll('.notification-item[data-read="0"]').length;
      var bellBadge = document.getElementById('bell-badge');
      var headerBadge = document.getElementById('header-badge');
      if (remaining === 0) {
        if (bellBadge) bellBadge.remove();
        if (headerBadge) headerBadge.remove();
      } else {
        var count = remaining > 9 ? '9+' : String(remaining);
        if (bellBadge) bellBadge.textContent = count;
        if (headerBadge) headerBadge.textContent = count;
      }
    }

    // Notification item click
    document.querySelectorAll('.notification-item').forEach(function (item) {
      item.addEventListener('click', function (e) {
        e.preventDefault();
        e.stopPropagation();

        var id = this.dataset.notificationId;
        var url = this.getAttribute('href');
        var isUnread = this.dataset.read === '0';
        var el = this;

        if (isUnread) {
          fetch('/notifications/' + id + '/read', {
            method: 'POST',
            headers: {
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
              'Content-Type': 'application/json',
            },
          })
            .catch(function () { })
            .finally(function () {
              el.dataset.read = '1';
              el.classList.remove('bg-blue-50/30', 'dark:bg-blue-900/10');
              el.classList.add('opacity-60');
              updateBadge();
              if (url && url !== '#') window.location.href = url;
            });
        } else {
          if (url && url !== '#') window.location.href = url;
        }
      });
    });
  });
</script>