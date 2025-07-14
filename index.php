<?php
// front-page.php

get_template_part('parts/header');
?>

<main>
    <!-- Hero Image -->
    <figure>
        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/hero.webp'); ?>" alt="Hero Image">
    </figure>

    <!-- Impression Cards Section -->
    <section class="container my-6 flex flex-col md:flex-row gap-3">
        <?php
        $all_custom_cards_data = array(
            array(
                'href'  => home_url('/products/honey/'),
                'image' => get_template_directory_uri() . '/assets/images/lachcha-shemai.webp',
            ),
            array(
                'href'  => home_url('/products/grains/'),
                'image' => get_template_directory_uri() . '/assets/images/fermented_garlic_honey.webp',
            ),
            array(
                'href'  => home_url('/products/oils/'),
                'image' => get_template_directory_uri() . '/assets/images/coconut_oil.webp',
            ),
            array(
                'href'  => home_url('/products/dairy/'),
                'image' => get_template_directory_uri() . '/assets/images/ghee.webp',
            ),
        );

        foreach ($all_custom_cards_data as $single_card_data) {
            $template_path = locate_template('parts/card-impression.php');
            if ($template_path) {
                $custom_card_data = $single_card_data;
                include($template_path);
            }
        }
        ?>
    </section>

    <!-- WooCommerce Product Grid -->
    <section class="container mx-auto my-10 px-4">
        <h2 class="text-3xl font-bold uppercase text-center mb-6">best selling products</h2>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <?php
            // Fetch products in specific WooCommerce categories
            $args = array(
                'post_type'      => 'product',
                'posts_per_page' => 8,
                'orderby'        => 'date',
                'order'          => 'DESC',
                'tax_query'      => array(
                    array(
                        'taxonomy' => 'product_cat',
                        'field'    => 'slug',
                        'terms'    => array('combo-pack'), // <-- Use your actual category slugs here
                        'operator' => 'IN',
                    ),
                ),
                'meta_query'     => WC()->query->get_meta_query(),
            );

            $query = new WP_Query($args);

            if ($query->have_posts()) :
                while ($query->have_posts()) :
                    $query->the_post();
                    global $product;

                    $template_path = locate_template('parts/card-product.php');
                    if ($template_path) {
                        include($template_path);
                    }
                endwhile;
                wp_reset_postdata();
            else :
                echo '<p class="text-center col-span-full text-gray-500">No products found in selected categories.</p>';
            endif;
            ?>
        </div>
    </section>
</main>

<?php get_template_part('parts/footer'); ?>