<section class="bg-white p-6 rounded-lg shadow-md">
  <h3 class="text-xl font-bold mb-6 border-b border-gray-200 pb-3 text-gray-800">Latest Posts</h3>
  <ul class="space-y-4">
    <?php
    $recent_posts = wp_get_recent_posts([
      'numberposts' => 5,
      'post_status' => 'publish',
      'post_type' => 'post',
      'exclude' => get_the_ID(),
    ]);
    foreach ($recent_posts as $post) : ?>
      <li>
        <a href="<?php echo get_permalink($post['ID']); ?>" class="group flex items-start text-blue-700 hover:text-blue-900 transition-colors duration-200">
          <svg class="w-5 h-5 mt-1 mr-2 flex-shrink-0 text-blue-500 group-hover:text-blue-700 transition-colors duration-200" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
          </svg>
          <span class="font-medium leading-tight group-hover:underline"><?php echo esc_html($post['post_title']); ?></span>
        </a>
      </li>
    <?php endforeach; ?>
  </ul>
</section>