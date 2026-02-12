<div class="inline-block relative group">
  <!-- Question mark circle trigger -->
  <div
    class="w-4 h-4 font-sans bg-red-500 rounded-full flex items-center justify-center cursor-help text-white text-xs font-bold">
    ?
  </div>

  <!-- Tooltip content - shows on hover -->
  <div
    class="absolute left-0 top-6 w-80 bg-white dark:bg-gray-800 text-gray-900 dark:text-white text-sm rounded-lg p-4 shadow-xl border border-gray-200 dark:border-gray-700 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
    <!-- Arrow pointing up -->
    <div
      class="absolute -top-2 left-3 w-4 h-4 bg-white dark:bg-gray-800 border-l border-t border-gray-200 dark:border-gray-700 transform rotate-45">
    </div>

    <!-- Content -->
    <div class="relative">
      <p class="font-semibold mb-2">Password must contain:</p>
      <ul class="space-y-1 font-normal">
        <li class="flex items-start">
          <span class="text-green-600 dark:text-green-400 mr-2">•</span>
          <span>At least 8 characters</span>
        </li>
        <li class="flex items-start">
          <span class="text-green-600 dark:text-green-400 mr-2">•</span>
          <span>At least one upper and lowercase letter</span>
        </li>
        <li class="flex items-start">
          <span class="text-green-600 dark:text-green-400 mr-2">•</span>
          <span>At least one number and symbol</span>
        </li>
      </ul>
    </div>
  </div>
</div>