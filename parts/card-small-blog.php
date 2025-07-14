<?php
$post_id = get_the_ID();
?>

<article class="flex gap-4 items-start">
    <?php if (has_post_thumbnail()) : ?>
        <figure class="w-16 h-16 overflow-hidden rounded">
            <a href="<?php echo get_permalink($post_id); ?>">
                <?php echo get_the_post_thumbnail($post_id, 'thumbnail', ['class' => 'object-cover w-full h-full']); ?>
            </a>
        </figure>
    <?php endif; ?>

    <div class="flex-1">
        <h5 class="text-sm font-semibold leading-snug">
            <a href="<?php echo get_permalink($post_id); ?>" class="hover:text-green-700">
                <?php echo wp_trim_words(get_the_title($post_id), 10, '...'); ?>
            </a>
        </h5>
        <p class="text-xs text-gray-500">
            <?php echo get_the_date('M d, Y', $post_id); ?>
        </p>
    </div>
</article>