<?php
if (empty($product) || !is_a($product, 'WC_Product')) {
    return;
}

$product_id = $product->get_id();
$link       = esc_url(get_permalink($product_id));
$image_url  = esc_url(get_the_post_thumbnail_url($product_id, 'woocommerce_single') ?: wc_placeholder_img_src('woocommerce_single'));
$title      = esc_html($product->get_name());
$category   = strip_tags(wc_get_product_category_list($product_id, ', ', '', ''));

$regular_price = floatval($product->get_regular_price());
$sale_price    = floatval($product->get_sale_price());
$has_discount  = $product->is_on_sale() && $sale_price > 0 && $regular_price > $sale_price;
$discount_percentage = $has_discount && $regular_price > 0 ? '-' . round((($regular_price - $sale_price) / $regular_price) * 100) . '%' : '';

$current_price = $has_discount ? wc_price($sale_price) : wc_price($product->get_price());
$original_price = $has_discount ? wc_price($regular_price) : '';
?>

<div class="relative border border-gray-200 bg-white rounded-xl shadow-md overflow-hidden group transition-all duration-300">
    <?php if ($discount_percentage): ?>
        <span class="absolute top-3 left-3 bg-red-600 text-white text-xs font-bold px-2.5 py-1 rounded-full z-10">
            <?php echo esc_html($discount_percentage); ?>
        </span>
    <?php endif; ?>

    <a href="<?php echo $link; ?>" class="block">
        <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden">
            <img src="<?php echo $image_url; ?>" alt="<?php echo esc_attr($title); ?>"
                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" />
        </div>
    </a>

    <div class="p-4 text-center flex flex-col gap-2">
        <?php if (!empty($category)): ?>
            <p class="text-xs text-gray-500 uppercase tracking-wide"><?php echo esc_html($category); ?></p>
        <?php endif; ?>

        <h3 class="text-base font-bold text-gray-900 leading-snug line-clamp-2">
            <a href="<?php echo $link; ?>" class="hover:text-green-700 transition-colors duration-200">
                <?php echo $title; ?>
            </a>
        </h3>

        <div class="flex items-center justify-center gap-2 text-center">
            <?php if ($has_discount): ?>
                <span class="text-sm text-gray-400 line-through"><?php echo wp_kses_post($original_price); ?></span>
                <span class="text-lg font-semibold text-blue-700"><?php echo wp_kses_post($current_price); ?></span>
            <?php else: ?>
                <span class="text-lg font-semibold text-gray-900"><?php echo wp_kses_post($current_price); ?></span>
            <?php endif; ?>
        </div>

        <div class="mt-2">
            <?php if ($product->is_type('variable')): ?>
                <a href="<?php echo $link; ?>"
                    class="w-full inline-block bg-blue-600 text-white py-2 px-4 rounded text-sm font-medium hover:bg-blue-700 transition">
                    <?php esc_html_e('Select Options', 'woocommerce'); ?>
                </a>
            <?php elseif ($product->is_purchasable() && $product->is_in_stock()): ?>
                <button type="button"
                    data-quantity="1"
                    data-product_id="<?php echo esc_attr($product_id); ?>"
                    data-product_sku="<?php echo esc_attr($product->get_sku()); ?>"
                    class="instant-add-to-cart w-full bg-green-600 text-white py-2 px-4 rounded text-sm font-medium hover:bg-green-700 transition shadow-sm"
                    rel="nofollow">
                    <span class="button-text"><?php echo esc_html($product->add_to_cart_text()); ?></span>
                    <span class="loading-spinner hidden ml-2">
                        <svg class="animate-spin h-4 w-4 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10"
                                stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8v4l3-3-3-3v4a8 8 0 01-8 8z"></path>
                        </svg>
                    </span>
                </button>
            <?php else: ?>
                <span class="inline-block w-full bg-gray-400 text-white py-2 px-4 rounded text-sm font-medium text-center cursor-not-allowed">
                    <?php esc_html_e('Out of Stock', 'woocommerce'); ?>
                </span>
            <?php endif; ?>
        </div>
    </div>
</div>