<?php

/**
 * Template Name: Blog
 */

get_template_part(slug: 'parts/header');
?>

<main>
    <!-- Hero section -->
    <div class="bg-green-50 py-16 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-2">Blog</h1>
        <p class="text-sm">
            <a href="/" class="text-black hover:text-green-700">Home</a>
            <span class="textblack mx-1">/</span>
            <strong class="font-semibold text-gray-900"><?php the_title(); ?></strong>
        </p>
    </div>

    <!-- Blog content section -->
    <div class="container my-8 flex gap-8">
        <div class="w-full md:w-2/3 space-y-10">
            <?php
            $blog_query = new WP_Query([
                'post_type' => 'post',
                'posts_per_page' => 6,
                'paged' => get_query_var('paged') ?: 1
            ]);

            if ($blog_query->have_posts()) :
                while ($blog_query->have_posts()) :
                    $blog_query->the_post();

                    // Load single card template
                    get_template_part('parts/card', 'blog');

                endwhile;

                the_posts_pagination([
                    'prev_text' => __('« Previous'),
                    'next_text' => __('Next »'),
                ]);

                wp_reset_postdata();
            else :
                echo '<p>No posts found.</p>';
            endif;
            ?>
        </div>

        <div class="w-1/3 hidden md:block">
            <div class="flex flex-col gap-4">
                <h4 class="uppercase font-bold text-xl mb-4">Products</h4>
                <?php
                $product_query = new WP_Query([
                    'post_type' => 'product',
                    'posts_per_page' => 5,
                    'meta_key' => 'total_sales',
                    'orderby' => 'meta_value_num',
                    'order' => 'DESC',
                ]);

                if ($product_query->have_posts()) :
                    while ($product_query->have_posts()) :
                        $product_query->the_post();
                        get_template_part('parts/card', 'small-product');
                    endwhile;
                    wp_reset_postdata();
                else :
                    echo '<p>No products found.</p>';
                endif;
                ?>
            </div>

            <div class="mt-12 flex flex-col gap-4">
                <h4 class="uppercase font-bold text-xl">Categories</h4>
                <ul class="space-y-1">
                    <?php
                    $terms = get_terms(['taxonomy' => 'product_cat', 'hide_empty' => false]);
                    foreach ($terms as $term) {
                        echo '<li><a href="' . get_term_link($term) . '" class="text-sm text-[#767676] hover:text-green-700">' . $term->name . '</a></li>';
                    }
                    ?>
                </ul>
            </div>

            <div class="mt-12 flex flex-col gap-4">
                <h4 class="uppercase font-bold text-xl">Recent Post</h4>
                <?php
                $recent_posts = new WP_Query([
                    'post_type'      => 'post',
                    'posts_per_page' => 5,
                    'post_status'    => 'publish',
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                ]);

                if ($recent_posts->have_posts()) :
                    while ($recent_posts->have_posts()) :
                        $recent_posts->the_post();
                        get_template_part('parts/card', 'small-blog');
                    endwhile;
                    wp_reset_postdata();
                else :
                    echo '<p class="text-sm text-gray-500">No recent posts found.</p>';
                endif;
                ?>
            </div>

        </div>
    </div>
</main>

<?php get_template_part(slug: 'parts/footer'); ?>