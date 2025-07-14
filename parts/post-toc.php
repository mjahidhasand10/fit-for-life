<?php if (function_exists('lwptoc_shortcode')) : ?>
  <div class="mb-8 p-5 bg-blue-50 border border-blue-200 rounded-lg shadow-sm">
    <h3 class="text-xl font-semibold mb-3 text-blue-800 flex items-center">
      <svg class="w-6 h-6 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
        <path fill-rule="evenodd" d="M4 5a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V7a2 2 0 00-2-2h-1.586a1 1 0 01-.707-.293l-1.121-1.121A2 2 0 0011.172 3H8.828a2 2 0 00-1.414.586L6.293 4.707A1 1 0 015.586 5H4zm6 9a1 1 0 100-2 1 1 0 000 2zm-3-1a1 1 0 11-2 0 1 1 0 012 0zm7-1a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path>
      </svg>
      Table of Contents
    </h3>
    <?php echo do_shortcode('[lwptoc]'); ?>
  </div>
<?php endif; ?>