<header class="mb-8 border-b border-gray-200 pb-6">
  <h2 class="text-3xl md:text-4xl font-bold mb-3 leading-tight"><?php the_title(); ?></h2>
  <p class="text-gray-600 text-sm flex items-center space-x-4">
    <span class="flex items-center">
      <svg class="w-4 h-4 mr-1 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
      </svg>
      By <span class="font-medium ml-1"><?php the_author(); ?></span>
    </span>
    <span class="flex items-center">
      <svg class="w-4 h-4 mr-1 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
      </svg>
      <time datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date(); ?></time>
    </span>
  </p>
</header>
