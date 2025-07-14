<?php

/**
 * Theme Functions
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 */

// ✅ Setup theme features & menu locations
function theme_setup()
{
    // Register navigation menus
    register_nav_menus([
        'main-menu'   => __('Main Menu', 'official'),
        'social-menu' => __('Social Menu', 'official'),
    ]);

    // Enable WooCommerce support
    add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'theme_setup');

function enqueue_swiper_scripts()
{
    // Swiper CSS
    wp_enqueue_style('swiper-css', 'https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css');

    // Swiper JS
    wp_enqueue_script('swiper-js', 'https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js', [], null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_swiper_scripts');

function enqueue_product_scripts()
{
    // Enqueue jQuery
    wp_enqueue_script('jquery');

    // Enqueue custom script in a separate file (recommended)
    wp_enqueue_script('product-tabs', get_template_directory_uri() . '/assets/js/product-tabs.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'enqueue_product_scripts');

function load_cart_data_ajax()
{
    if (!WC()->cart) WC()->initialize_cart();

    $items = WC()->cart->get_cart();
    ob_start();

    if (empty($items)) {
?>
        <div class="text-center p-8">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/empty-cart.png" alt="Empty Cart" class="mx-auto mb-4 w-24 h-24 opacity-30">
            <p class="text-gray-600 text-sm mb-4">No products in the cart.</p>
            <a href="/shop" class="bg-red-600 text-white font-bold text-xs py-2 px-4 rounded hover:bg-red-700 transition">
                RETURN TO SHOP
            </a>
        </div>
        <?php
    } else {
        foreach ($items as $item) {
            $product = $item['data'];
            $name = $product->get_name();
            $qty = $item['quantity'];
            $price = wc_price($product->get_price());
            $line_subtotal = wc_price($item['line_subtotal']);
            $product_image = wp_get_attachment_image_src($product->get_image_id(), 'thumbnail')[0];

        ?>
            <div class="flex items-start gap-4 border-b p-4">
                <img src="<?php echo esc_url($product_image); ?>" alt="<?php echo esc_attr($name); ?>" class="w-16 h-16 rounded border">
                <div class="flex-1">
                    <p class="font-semibold text-sm leading-tight"><?php echo esc_html($name); ?></p>
                    <div class="flex items-center mt-2">
                        <button class="px-2 py-1 bg-gray-200 text-xs">−</button>
                        <span class="px-3 text-sm"><?php echo $qty; ?></span>
                        <button class="px-2 py-1 bg-gray-200 text-xs">+</button>
                    </div>
                    <p class="text-green-600 text-sm mt-1"><?php echo $qty; ?> × <?php echo $price; ?></p>
                </div>
                <button class="text-gray-400 hover:text-red-500 text-sm font-bold">×</button>
            </div>
<?php
        }
    }

    $html = ob_get_clean();
    wp_send_json_success([
        'html' => $html,
        'total' => WC()->cart->get_cart_total()
    ]);
}
