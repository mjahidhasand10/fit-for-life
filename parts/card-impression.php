<?php
if (isset($custom_card_data) && is_array($custom_card_data)) {
    extract($custom_card_data);
} else {
    return;
}

$link        = isset($href) ? $href : '#';
$image_url   = isset($image) ? $image : get_template_directory_uri() . '/assets/images/placeholder.webp';

?>

<a href="<?php echo esc_url($link); ?>" class="flex-1 rounded hover:shadow group overflow-hidden">
    <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($title); ?>" class="rounded transition-transform duration-1000 ease-in-out group-hover:rotate-2 group-hover:scale-105">
</a>