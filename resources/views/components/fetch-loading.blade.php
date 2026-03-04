<div id="fetch-loader" class="fixed inset-0 hidden" style="z-index: 99998;">
  {{-- Backdrop --}}
  <div class="absolute inset-0 bg-white/60 backdrop-blur-[2px]"></div>

  {{-- Centered spinner card --}}
  <div class="relative flex flex-col items-center justify-center min-h-screen gap-5">

    {{-- Spinner --}}
    <div class="relative w-14 h-14">
      {{-- Outer track --}}
      <svg class="absolute inset-0 w-14 h-14 opacity-20" viewBox="0 0 56 56" fill="none">
        <circle cx="28" cy="28" r="24" stroke="#dc2d3d" stroke-width="3" />
      </svg>
      {{-- Spinning arc --}}
      <svg class="absolute inset-0 w-14 h-14 fetch-spin" viewBox="0 0 56 56" fill="none">
        <circle cx="28" cy="28" r="24" stroke="#dc2d3d" stroke-width="3" stroke-dasharray="40 111"
          stroke-linecap="round" />
      </svg>
    </div>

    {{-- Label --}}
    <div class="text-center">
      <p id="fetch-loader-msg" class="text-gray-700 font-medium text-sm tracking-wide">Loading...</p>
      <p class="text-gray-400 text-xs mt-1">Please wait a moment</p>
    </div>

  </div>
</div>

<style>
  @keyframes fetch-spin {
    to {
      transform: rotate(360deg);
    }
  }

  @keyframes fetch-pulse {

    0%,
    100% {
      transform: scale(1);
      opacity: 1;
    }

    50% {
      transform: scale(1.5);
      opacity: 0.6;
    }
  }

  .fetch-spin {
    animation: fetch-spin 0.9s linear infinite;
  }

  .fetch-pulse {
    animation: fetch-pulse 1.2s ease-in-out infinite;
  }
</style>

<script>
  (function () {
    window.showFetchLoader = function (msg) {
      const loader = document.getElementById('fetch-loader');
      const msgEl = document.getElementById('fetch-loader-msg');
      if (!loader) return;
      if (msgEl && msg) msgEl.textContent = msg;
      loader.classList.remove('hidden');
      document.body.style.overflow = 'hidden';
    };

    window.hideFetchLoader = function () {
      const loader = document.getElementById('fetch-loader');
      if (loader) loader.classList.add('hidden');
      document.body.style.overflow = '';
    };

    document.addEventListener('DOMContentLoaded', function () {
      // Auto-attach to any <a> or <button> with class "fetch-link" or data-fetch-loading
      document.addEventListener('click', function (e) {
        const el = e.target.closest('[data-fetch-loading], .fetch-link');
        if (!el) return;

        // Don't trigger on form submit buttons or elements with target="_blank"
        if (el.target === '_blank') return;
        if (el.tagName === 'BUTTON' && el.form) return;

        const msg = el.getAttribute('data-fetch-msg') || 'Loading...';
        showFetchLoader(msg);
      });

      // Hide loader when page finishes loading (e.g. back navigation)
      window.addEventListener('pageshow', function () {
        hideFetchLoader();
      });
    });
  })();
</script>