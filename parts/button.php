<?php

/**
 * Simple Reusable Button
 *
 * Required: $product_id (int)
 * Optional: $text (string) — button label
 */

if (!isset($product_id)) return;

$button_text = isset($text) && !empty($text) ? esc_html($text) : esc_html__('Add to Cart', 'woocommerce');
?>

<button type="button"
    data-quantity="1"
    data-product_id="<?php echo esc_attr($product_id); ?>"
    class="btn-product-action w-full bg-green-600 text-white py-3 px-4 rounded-lg uppercase font-semibold text-sm hover:bg-green-700 transition-colors duration-200 text-center instant-add-to-cart shadow-md"
    rel="nofollow">
    <?php echo $button_text; ?>
</button>