<?php
$product = wc_get_product(get_the_ID());

$regular_price = $product->get_regular_price();
$sale_price = $product->get_sale_price();
$is_on_sale = $product->is_on_sale();
?>

<article class="flex gap-4 <?php echo $border_class; ?>">
    <figure class="w-20 h-20 overflow-hidden rounded">
        <a href="<?php echo get_permalink(); ?>">
            <?php echo get_the_post_thumbnail(get_the_ID(), 'thumbnail'); ?>
        </a>
    </figure>
    <div class="flex-1">
        <h5 class="font-semibold text-sm leading-snug">
            <a href="<?php echo get_permalink(); ?>" class="hover:text-green-700">
                <?php the_title(); ?>
            </a>
        </h5>

        <p class="text-sm">
            <?php if ($is_on_sale) : ?>
                <span class="line-through text-gray-400 mr-2">
                    <?php echo wc_price($regular_price); ?>
                </span>
                <span class="text-green-600 font-bold">
                    <?php echo wc_price($sale_price); ?>
                </span>
            <?php else : ?>
                <span class="text-black font-medium">
                    <?php echo wc_price($regular_price); ?>
                </span>
            <?php endif; ?>
        </p>
    </div>
</article>