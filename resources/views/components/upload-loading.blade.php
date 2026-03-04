<div id="upload-loader" class="fixed inset-0 hidden" style="z-index: 99999;">

  {{-- Backdrop with blur --}}
  <div class="absolute inset-0 bg-white/80 backdrop-blur-sm"></div>

  {{-- Animated background grid --}}
  <div class="absolute inset-0 overflow-hidden pointer-events-none">
    <div class="upload-grid-bg absolute inset-0"></div>
  </div>

  {{-- Center card --}}
  <div class="relative flex items-center justify-center min-h-screen px-4">
    <div class="upload-card bg-white dark:bg-gray-900 rounded-2xl shadow-2xl w-full max-w-sm p-8 text-center">

      {{-- Icon ring animation --}}
      <div class="relative mx-auto mb-6 w-20 h-20">
        {{-- Outer spinning ring --}}
        <svg class="absolute inset-0 w-20 h-20 upload-spin-slow" viewBox="0 0 80 80" fill="none">
          <circle cx="40" cy="40" r="36" stroke="#dc2d3d" stroke-width="2" stroke-dasharray="56 170"
            stroke-linecap="round" opacity="0.3" />
        </svg>
        {{-- Inner spinning ring (opposite direction) --}}
        <svg class="absolute inset-0 w-20 h-20 upload-spin-fast-reverse" viewBox="0 0 80 80" fill="none">
          <circle cx="40" cy="40" r="28" stroke="#dc2d3d" stroke-width="2.5" stroke-dasharray="30 146"
            stroke-linecap="round" />
        </svg>
        {{-- Center icon --}}
        <div class="absolute inset-0 flex items-center justify-center">
          <div
            class="w-10 h-10 bg-[#dc2d3d]/10 dark:bg-[#dc2d3d]/20 rounded-full flex items-center justify-center upload-pulse-icon">
            <svg class="w-5 h-5 text-[#dc2d3d]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
            </svg>
          </div>
        </div>
      </div>

      {{-- Title --}}
      <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-1 tracking-tight">
        Uploading your contribution
      </h3>
      <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">
        Please don't close or refresh this page
      </p>

      {{-- Progress bar --}}
      <div class="mb-4">
        <div class="h-1.5 w-full bg-gray-100 dark:bg-gray-800 rounded-full overflow-hidden">
          <div id="upload-progress-bar" class="h-full bg-[#dc2d3d] rounded-full upload-progress-indeterminate"></div>
        </div>
      </div>

      {{-- Rotating status messages --}}
      <p id="upload-status-msg" class="text-xs text-gray-400 dark:text-gray-500 h-4 transition-opacity duration-300">
        Preparing files...
      </p>

      {{-- File dots indicator --}}
      <div class="flex items-center justify-center gap-1.5 mt-5">
        <span class="upload-dot w-1.5 h-1.5 rounded-full bg-[#dc2d3d]" style="animation-delay: 0ms"></span>
        <span class="upload-dot w-1.5 h-1.5 rounded-full bg-[#dc2d3d]" style="animation-delay: 150ms"></span>
        <span class="upload-dot w-1.5 h-1.5 rounded-full bg-[#dc2d3d]" style="animation-delay: 300ms"></span>
      </div>

    </div>
  </div>
</div>

<style>
  /* Spinning rings */
  @keyframes upload-spin-cw {
    from {
      transform: rotate(0deg);
    }

    to {
      transform: rotate(360deg);
    }
  }

  @keyframes upload-spin-ccw {
    from {
      transform: rotate(0deg);
    }

    to {
      transform: rotate(-360deg);
    }
  }

  .upload-spin-slow {
    animation: upload-spin-cw 3s linear infinite;
  }

  .upload-spin-fast-reverse {
    animation: upload-spin-ccw 1.8s linear infinite;
  }

  /* Pulsing center icon */
  @keyframes upload-pulse-icon {

    0%,
    100% {
      transform: scale(1);
      opacity: 1;
    }

    50% {
      transform: scale(1.12);
      opacity: 0.8;
    }
  }

  .upload-pulse-icon {
    animation: upload-pulse-icon 2s ease-in-out infinite;
  }

  /* Indeterminate progress bar */
  @keyframes upload-progress {
    0% {
      transform: translateX(-100%) scaleX(0.4);
    }

    50% {
      transform: translateX(0%) scaleX(0.6);
    }

    100% {
      transform: translateX(100%) scaleX(0.4);
    }
  }

  .upload-progress-indeterminate {
    transform-origin: left center;
    animation: upload-progress 1.6s ease-in-out infinite;
  }

  /* Bouncing dots */
  @keyframes upload-bounce {

    0%,
    80%,
    100% {
      transform: scale(0.6);
      opacity: 0.4;
    }

    40% {
      transform: scale(1.2);
      opacity: 1;
    }
  }

  .upload-dot {
    animation: upload-bounce 1.2s ease-in-out infinite;
  }

  /* Card entrance */
  @keyframes upload-card-in {
    from {
      opacity: 0;
      transform: translateY(16px) scale(0.97);
    }

    to {
      opacity: 1;
      transform: translateY(0) scale(1);
    }
  }

  .upload-card {
    animation: upload-card-in 0.3s ease-out forwards;
  }

  /* Background grid */
  .upload-grid-bg {
    background-image:
      linear-gradient(rgba(220, 45, 61, 0.04) 1px, transparent 1px),
      linear-gradient(90deg, rgba(220, 45, 61, 0.04) 1px, transparent 1px);
    background-size: 40px 40px;
  }
</style>

<script>
  (function () {
    const messages = [
      'Preparing files...',
      'Uploading documents...',
      'Uploading images...',
      'Securing your submission...',
      'Almost there...',
      'Finalising upload...',
    ];

    let msgIndex = 0;
    let msgInterval = null;

    function cycleMessages() {
      const el = document.getElementById('upload-status-msg');
      if (!el) return;
      msgInterval = setInterval(() => {
        el.style.opacity = '0';
        setTimeout(() => {
          msgIndex = (msgIndex + 1) % messages.length;
          el.textContent = messages[msgIndex];
          el.style.opacity = '1';
        }, 300);
      }, 2200);
    }

    window.showUploadLoader = function (form) {
      // If called from onsubmit, validate the form first
      if (form && !form.checkValidity()) return;

      const loader = document.getElementById('upload-loader');
      if (!loader) return;

      msgIndex = 0;
      const msgEl = document.getElementById('upload-status-msg');
      if (msgEl) msgEl.textContent = messages[0];

      loader.classList.remove('hidden');
      document.body.style.overflow = 'hidden';
      cycleMessages();
    };

    window.hideUploadLoader = function () {
      const loader = document.getElementById('upload-loader');
      if (loader) loader.classList.add('hidden');
      document.body.style.overflow = '';
      if (msgInterval) clearInterval(msgInterval);
    };
  })();
</script>