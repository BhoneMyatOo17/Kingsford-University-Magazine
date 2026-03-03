<!-- Restore Confirmation Modal -->
<div id="restore-modal" class="fixed inset-0 z-50 hidden items-center justify-center">
  <!-- Backdrop -->
  <div id="restore-modal-backdrop" class="absolute inset-0 bg-black/50"></div>

  <!-- Dialog -->
  <div class="relative bg-white dark:bg-gray-800 rounded-xl shadow-2xl p-6 w-full max-w-md mx-4">
    <div class="flex items-center gap-4 mb-4">
      <div class="w-12 h-12 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center shrink-0">
        <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
        </svg>
      </div>
      <div>
        <h3 class="text-lg font-bold text-gray-900 dark:text-white">Restore Record</h3>
        <p class="text-sm text-gray-500 dark:text-gray-400">This action will make the record active again.</p>
      </div>
    </div>

    <p class="text-gray-700 dark:text-gray-300 mb-6">
      Are you sure you want to restore <span id="restore-modal-name"
        class="font-semibold text-gray-900 dark:text-white"></span>?
    </p>

    <div class="flex gap-3 justify-end">
      <button id="restore-modal-cancel"
        class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-lg transition-colors">
        Cancel
      </button>
      <form id="restore-modal-form" method="POST">
        @csrf
        <button type="submit"
          class="px-4 py-2 text-sm font-medium text-white bg-green-600 hover:bg-green-700 rounded-lg transition-colors">
          Yes, Restore
        </button>
      </form>
    </div>
  </div>
</div>

<script>
  const restoreModal = document.getElementById('restore-modal');
  const restoreForm = document.getElementById('restore-modal-form');
  const restoreName = document.getElementById('restore-modal-name');
  const restoreCancel = document.getElementById('restore-modal-cancel');
  const restoreBackdrop = document.getElementById('restore-modal-backdrop');

  document.querySelectorAll('[data-restore-url]').forEach(btn => {
    btn.addEventListener('click', function (e) {
      e.preventDefault();
      restoreForm.action = this.dataset.restoreUrl;
      restoreName.textContent = this.dataset.restoreName;
      restoreModal.classList.remove('hidden');
      restoreModal.classList.add('flex');
    });
  });

  function closeRestoreModal() {
    restoreModal.classList.add('hidden');
    restoreModal.classList.remove('flex');
  }

  restoreCancel.addEventListener('click', closeRestoreModal);
  restoreBackdrop.addEventListener('click', closeRestoreModal);
</script>