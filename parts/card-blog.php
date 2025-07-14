<!-- parts/card-blog.php -->
<article class="p-6 border border-gray-200 rounded flex flex-col md:flex-row items-center gap-6 relative overflow-hidden hover:shadow">
    <div class="relative">
        <p class="absolute top-4 left-4 w-12 h-12 text-center bg-white">
            <span><?php echo get_the_date('d'); ?></span>
            <span><?php echo strtoupper(get_the_date('M')); ?></span>
        </p>
        <figure class="w-full md:w-80">
            <?php if (has_post_thumbnail()) : ?>
                <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>" alt="<?php the_title_attribute(); ?>">
            <?php endif; ?>
        </figure>
    </div>

    <div>
        <h4 class="font-semibold text-2xl text-[#242424] mb-2"><?php the_title(); ?></h4>
        <p><?php echo wp_trim_words(get_the_excerpt(), 30, '...'); ?></p>
    </div>

    <a href="<?php the_permalink(); ?>" class="absolute inset-0 z-10" aria-label="<?php the_title_attribute(); ?>"></a>
</article>