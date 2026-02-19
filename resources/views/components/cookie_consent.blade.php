@php
  $cookieSet = isset($_COOKIE['ksf_cookie_consent']);
@endphp

@if(!$cookieSet)
  <div id="cookie-banner" class="ck-banner" role="dialog" aria-label="Cookie consent">
    <div class="ck-card">
      <div class="ck-left">
        <div class="ck-icon-wrap">
          <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
            <circle cx="8.5" cy="9" r="1.5" />
            <circle cx="15.5" cy="12" r="1.5" />
            <circle cx="14" cy="6" r="1" />
            <circle cx="10" cy="15" r="1" />
            <path d="M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2zm0 18a8 8 0 1 1 8-8 8 8 0 0 1-8 8z" />
          </svg>
        </div>
        <div class="ck-text">
          <span class="ck-title">We use cookies</span>
          <span class="ck-desc">We use cookies to improve your experience. Your preference will be saved.</span>
        </div>
      </div>
      <div class="ck-actions">
        <button class="ck-btn ck-btn--ghost" onclick="setCookieConsent('necessary')">Necessary Only</button>
        <button class="ck-btn ck-btn--outline" onclick="setCookieConsent('rejected')">Reject All</button>
        <button class="ck-btn ck-btn--solid" onclick="setCookieConsent('all')">Accept All</button>
      </div>
    </div>
  </div>

  <style>
    @import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600&display=swap');

    .ck-banner {
      position: fixed;
      bottom: 28px;
      left: 50%;
      transform: translateX(-50%) translateY(120px);
      width: calc(100% - 48px);
      max-width: 900px;
      z-index: 9999;
      opacity: 0;
      transition: transform 0.5s cubic-bezier(0.22, 1, 0.36, 1), opacity 0.5s ease;
      pointer-events: none;
    }

    .ck-banner.ck-visible {
      transform: translateX(-50%) translateY(0);
      opacity: 1;
      pointer-events: auto;
    }

    .ck-banner.ck-dismissing {
      transform: translateX(-50%) translateY(120px);
      opacity: 0;
      pointer-events: none;
    }

    .ck-card {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 20px;
      background: #fff;
      border-radius: 16px;
      padding: 14px 18px 14px 16px;
      box-shadow:
        0 0 0 1px rgba(0, 0, 0, 0.07),
        0 8px 32px rgba(0, 0, 0, 0.12),
        0 2px 8px rgba(0, 0, 0, 0.06);
      border-left: 4px solid #dc2d3d;
    }

    .dark .ck-card {
      background: #1e1e21;
      box-shadow:
        0 0 0 1px rgba(255, 255, 255, 0.07),
        0 8px 32px rgba(0, 0, 0, 0.4),
        0 2px 8px rgba(0, 0, 0, 0.2);
    }

    .ck-left {
      display: flex;
      align-items: center;
      gap: 12px;
      min-width: 0;
      flex: 1;
    }

    .ck-icon-wrap {
      flex-shrink: 0;
      width: 36px;
      height: 36px;
      border-radius: 10px;
      background: #fff0f1;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #dc2d3d;
    }

    .dark .ck-icon-wrap {
      background: rgba(220, 45, 61, 0.15);
    }

    .ck-text {
      display: flex;
      flex-direction: column;
      gap: 1px;
      min-width: 0;
    }

    .ck-title {
      font-family: 'DM Sans', sans-serif;
      font-size: 0.875rem;
      font-weight: 600;
      color: #111;
      white-space: nowrap;
    }

    .dark .ck-title {
      color: #f5f5f7;
    }

    .ck-desc {
      font-family: 'DM Sans', sans-serif;
      font-size: 0.775rem;
      color: #888;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .dark .ck-desc {
      color: #71717a;
    }

    .ck-actions {
      display: flex;
      align-items: center;
      gap: 8px;
      flex-shrink: 0;
    }

    .ck-btn {
      font-family: 'DM Sans', sans-serif;
      font-size: 0.8rem;
      font-weight: 600;
      border: none;
      cursor: pointer;
      border-radius: 9px;
      padding: 8px 15px;
      transition: all 0.18s ease;
      white-space: nowrap;
      letter-spacing: 0.01em;
    }

    .ck-btn--ghost {
      background: transparent;
      color: #999;
      border: 1.5px solid rgba(0, 0, 0, 0.12) !important;
      padding: 7px 14px !important;
    }

    .dark .ck-btn--ghost {
      color: #71717a;
      border-color: rgba(255, 255, 255, 0.1) !important;
    }

    .ck-btn--ghost:hover {
      color: #dc2d3d !important;
      border-color: #dc2d3d !important;
      background: rgba(220, 45, 61, 0.04) !important;
    }

    .ck-btn--outline {
      background: #f4f4f5;
      color: #52525b;
    }

    .dark .ck-btn--outline {
      background: #2a2a2e;
      color: #a1a1aa;
    }

    .ck-btn--outline:hover {
      background: #e4e4e7;
      color: #111;
    }

    .dark .ck-btn--outline:hover {
      background: #333338;
      color: #f5f5f7;
    }

    .ck-btn--solid {
      background: #dc2d3d;
      color: #fff;
      box-shadow: 0 2px 10px rgba(220, 45, 61, 0.3);
    }

    .ck-btn--solid:hover {
      background: #b82532;
      box-shadow: 0 4px 16px rgba(220, 45, 61, 0.45);
      transform: translateY(-1px);
    }

    .ck-btn--solid:active {
      transform: translateY(0);
    }

    @media (max-width: 640px) {
      .ck-banner {
        bottom: 16px;
        width: calc(100% - 24px);
      }

      .ck-card {
        flex-direction: column;
        align-items: flex-start;
        gap: 12px;
        padding: 14px;
      }

      .ck-desc {
        white-space: normal;
      }

      .ck-actions {
        width: 100%;
      }

      .ck-btn {
        flex: 1;
        text-align: center;
      }
    }
  </style>

  <script>
    window.addEventListener('load', function () {
      setTimeout(function () {
        var banner = document.getElementById('cookie-banner');
        if (banner) banner.classList.add('ck-visible');
      }, 1500);
    });

    function setCookieConsent(choice) {
      var expires = new Date();
      expires.setDate(expires.getDate() + 1);
      document.cookie = 'ksf_cookie_consent=' + choice + '; expires=' + expires.toUTCString() + '; path=/; SameSite=Lax';

      var banner = document.getElementById('cookie-banner');
      if (banner) {
        banner.classList.remove('ck-visible');
        banner.classList.add('ck-dismissing');
        setTimeout(function () { banner.remove(); }, 520);
      }
    }
  </script>
@endif