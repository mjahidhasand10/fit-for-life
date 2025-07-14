<?php get_template_part('parts/header'); ?>

<main class="bg-gray-50">
    <div
        class="w-full h-72 bg-cover bg-center flex items-center justify-center text-white text-center relative overflow-hidden"
        style="background-image: url('<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>');">
        <div class="absolute inset-0 bg-black/70"></div>
        <h1 class="relative z-10 text-4xl md:text-5xl font-extrabold px-6 py-3 rounded-lg shadow-xl animate-fade-in-up">
            <?php the_title(); ?>
        </h1>
    </div>

    <div class="container mx-auto px-4 py-16 grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-16">

        <div class="lg:col-span-8">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <article <?php post_class('bg-white p-8 md:p-10 rounded-lg shadow-lg'); ?>>

                        <header class="mb-8 border-b border-gray-200 pb-6">
                            <h2 class="text-3xl md:text-4xl font-bold mb-3 leading-tight"><?php the_title(); ?></h2>
                            <p class="text-gray-600 text-sm flex items-center space-x-4">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                    </svg>
                                    By <span class="font-medium ml-1"><?php the_author(); ?></span>
                                </span>
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                    </svg>
                                    <time datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date(); ?></time>
                                </span>
                            </p>
                        </header>

                        <?php if (function_exists('lwptoc_shortcode')) : ?>
                            <div class="mb-8 p-5 bg-blue-50 border border-blue-200 rounded-lg shadow-sm">
                                <h3 class="text-xl font-semibold mb-3 text-blue-800 flex items-center">
                                    <svg class="w-6 h-6 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                                        <path fill-rule="evenodd" d="M4 5a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V7a2 2 0 00-2-2h-1.586a1 1 0 01-.707-.293l-1.121-1.121A2 2 0 0011.172 3H8.828a2 2 0 00-1.414.586L6.293 4.707A1 1 0 015.586 5H4zm6 9a1 1 0 100-2 1 1 0 000 2zm-3-1a1 1 0 11-2 0 1 1 0 012 0zm7-1a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path>
                                    </svg>
                                    Table of Contents
                                </h3>
                                <?php echo do_shortcode('[lwptoc]'); ?>
                            </div>
                        <?php endif; ?>

                        <div class="prose prose-lg max-w-none prose-headings:font-bold prose-headings:text-gray-800 prose-img:rounded-xl prose-img:shadow-md prose-a:text-blue-600 hover:prose-a:text-blue-800 prose-blockquote:border-l-4 prose-blockquote:border-blue-500 prose-blockquote:pl-4 prose-blockquote:italic prose-p:leading-relaxed">
                            <?php the_content(); ?>
                        </div>

                        <section class="mt-16 pt-8 border-t border-gray-200">
                            <h3 class="text-2xl md:text-3xl font-bold mb-8 text-gray-800">
                                Discover More Products
                            </h3>
                            <?php echo do_shortcode('[products limit="3" columns="3" orderby="rand" class="related-products-grid"]'); ?>
                        </section>

                    </article>
            <?php endwhile;
            endif; ?>
        </div>

        <aside class="lg:col-span-4 space-y-12">
            <section class="bg-white p-6 rounded-lg shadow-md latest-blog-">
                <h3 class="text-xl font-bold mb-6 border-b border-gray-200 pb-3 text-gray-800">Products</h3>
                <?php
                $args = [
                    'post_type'      => 'product',
                    'posts_per_page' => 5,
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                    'post_status'    => 'publish',
                    'meta_query'     => WC()->query->get_meta_query(),
                    'tax_query'      => WC()->query->get_tax_query(),
                ];

                $loop = new WP_Query($args);

                echo '<pre>';
                print_r($loop->posts); // 👈 Dump all fetched posts (array of WP_Post objects)
                echo '</pre>'; 
                ?>
            </section>

            <section class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-bold mb-6 border-b border-gray-200 pb-3 text-gray-800">Latest Posts</h3>
                <ul class="space-y-4">
                    <?php
                    $recent_posts = wp_get_recent_posts([
                        'numberposts' => 5,
                        'post_status' => 'publish',
                        'post_type'   => 'post', // Ensure only regular posts
                        'exclude'     => get_the_ID(), // Exclude current post
                    ]);
                    foreach ($recent_posts as $post) :
                    ?>
                        <li>
                            <a href="<?php echo get_permalink($post['ID']) ?>" class="group flex items-start text-blue-700 hover:text-blue-900 transition-colors duration-200">
                                <svg class="w-5 h-5 mt-1 mr-2 flex-shrink-0 text-blue-500 group-hover:text-blue-700 transition-colors duration-200" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="font-medium leading-tight group-hover:underline"><?php echo esc_html($post['post_title']); ?></span>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </section>

            <section class="bg-gradient-to-br from-purple-600 to-indigo-700 p-8 rounded-lg shadow-lg text-white text-center">
                <h3 class="text-2xl font-bold mb-4">Need a Custom Solution?</h3>
                <p class="text-purple-100 mb-6">
                    Let's build something amazing together. Contact us for a free consultation!
                </p>
                <a href="#" class="inline-block bg-white text-purple-700 font-semibold px-6 py-3 rounded-full shadow-md hover:bg-purple-100 transition duration-300">
                    Get in Touch
                </a>
            </section>

        </aside>
    </div>
</main>

<?php get_template_part('parts/footer'); ?>

<style>
    /* Custom animations for better UI */
    @keyframes fade-in-up {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in-up {
        animation: fade-in-up 0.6s ease-out forwards;
    }

    /* Ensure images within content are responsive and styled */
    .prose img {
        max-width: 100%;
        height: auto;
        display: block;
        /* Prevents extra space below image */
    }

    /* --- WooCommerce Product Card Styling (General) --- */

    /* Reset WooCommerce default list styling for product grids */
    /* This targets the <ul> element that wraps the products */
    ul.products {
        list-style: none;
        margin: 0;
        padding: 0;
        display: grid;
        /* Essential for grid layout */
    }

    /* Base styling for all individual product cards (li.product) */
    ul.products li.product {
        background-color: #fff;
        border: 1px solid #e2e8f0;
        /* gray-200 */
        border-radius: 12px;
        /* More pronounced rounding */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        display: flex;
        flex-direction: column;
        /* Stack image, title, price, button */
        text-align: center;
        /* Center content by default */
        overflow: hidden;
        /* Ensures rounded corners on image */
    }

    ul.products li.product:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    /* Product Image */
    ul.products li.product .woocommerce-loop-product__thumbnail img {
        width: 100%;
        height: 200px;
        /* Fixed height for consistency in grids */
        object-fit: cover;
        /* Cover ensures image fills the space */
        border-top-left-radius: 12px;
        /* Match card rounding */
        border-top-right-radius: 12px;
    }

    /* Product Title */
    ul.products li.product h2.woocommerce-loop-product__title {
        font-size: 1.15rem;
        /* Slightly larger title */
        font-weight: 600;
        /* Semi-bold */
        color: #2d3748;
        /* gray-800 */
        margin: 1rem 1rem 0.5rem;
        /* Top/bottom margin, side padding */
        line-height: 1.4;
        min-height: 3rem;
        /* Ensure consistent height for titles across cards */
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Price */
    ul.products li.product .price {
        font-size: 1.25rem;
        /* Larger price */
        font-weight: 700;
        /* Bold */
        color: #48bb78;
        /* green-500 */
        margin-bottom: 1rem;
    }

    ul.products li.product .price ins {
        background-color: transparent;
        /* Remove default Woocommerce highlight */
        text-decoration: none;
    }

    ul.products li.product .price del {
        color: #a0aec0;
        /* gray-400 */
        font-weight: 400;
        font-size: 0.9em;
        margin-right: 0.5rem;
    }

    /* Add to Cart Button */
    ul.products li.product .button {
        display: block;
        /* Make button full width */
        width: calc(100% - 2rem);
        /* Account for padding */
        margin: 0 1rem 1rem;
        /* Center and add bottom margin */
        background-color: #4c51bf;
        /* indigo-700 */
        color: #fff;
        padding: 0.75rem 1rem;
        border-radius: 8px;
        /* Slightly less rounded than card */
        font-weight: 600;
        text-decoration: none;
        transition: background-color 0.2s ease-in-out;
        border: none;
        /* Remove default button border */
        cursor: pointer;
    }

    ul.products li.product .button:hover {
        background-color: #5a67d8;
        /* indigo-600 */
    }

    /* --- Specific Styling for Related Products Grid (Main Content) --- */
    /* Target the specific ul.products for related products using its custom class */
    .related-products-grid.products {
        grid-template-columns: repeat(1, minmax(0, 1fr));
        /* 1 column by default (mobile) */
        gap: 2rem;
        /* Spacing between cards */
    }

    @media (min-width: 640px) {

        /* sm breakpoint */
        .related-products-grid.products {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            /* 2 columns on small screens */
        }
    }

    @media (min-width: 768px) {

        /* md breakpoint */
        .related-products-grid.products {
            grid-template-columns: repeat(3, minmax(0, 1fr));
            /* 3 columns on medium screens */
        }
    }


    /* --- Specific Styling for Sidebar Product List --- */
    /* Target the specific ul.products for sidebar products using its custom class */
    .sidebar-products-list.products {
        grid-template-columns: 1fr;
        /* Single column for sidebar */
        gap: 1rem;
        /* Spacing between sidebar items */
    }

    .sidebar-products-list li.product {
        flex-direction: row;
        /* Horizontal layout for sidebar items */
        text-align: left;
        /* Align text left */
        padding: 0.75rem;
        box-shadow: none;
        /* Remove shadow for a flatter look */
        border: none;
        /* Remove border from base .product */
        border-bottom: 1px solid #edf2f7;
        /* Light border between items */
        border-radius: 0;
        /* No rounding for list items */
        align-items: center;
        /* Vertically align items */
        transition: background-color 0.2s ease-in-out;
    }

    .sidebar-products-list li.product:hover {
        background-color: #f7fafc;
        /* gray-50 hover */
        transform: none;
        /* Remove hover transform */
        box-shadow: none;
        /* No shadow on hover */
    }

    .sidebar-products-list li.product:last-child {
        border-bottom: none;
        /* No border on the last item */
    }

    .sidebar-products-list li.product .woocommerce-loop-product__thumbnail {
        flex-shrink: 0;
        /* Don't shrink thumbnail */
        margin-right: 0.75rem;
        /* Space between image and text */
    }

    .sidebar-products-list li.product .woocommerce-loop-product__thumbnail img {
        width: 72px;
        /* Smaller thumbnail */
        height: 72px;
        object-fit: cover;
        border-radius: 8px;
        /* Slightly rounded for sidebar thumbs */
    }

    /* Ensure title and price align correctly */
    .sidebar-products-list li.product .price,
    .sidebar-products-list li.product h2.woocommerce-loop-product__title {
        margin: 0;
        /* Reset default margins */
    }

    .sidebar-products-list li.product h2.woocommerce-loop-product__title {
        font-size: 0.95rem;
        /* Smaller font for sidebar title */
        line-height: 1.3;
        min-height: auto;
        /* Allow title to wrap naturally */
        text-align: left;
        justify-content: flex-start;
        /* Align title left */
        flex-grow: 1;
        /* Allow title to take available space */
    }

    .sidebar-products-list li.product h2.woocommerce-loop-product__title a {
        display: block;
        /* Ensure link fills title area */
        color: #2b6cb0;
        /* blue-700 */
        text-decoration: none;
    }

    .sidebar-products-list li.product h2.woocommerce-loop-product__title a:hover {
        text-decoration: underline;
    }

    .sidebar-products-list li.product .price {
        font-size: 1rem;
        /* Smaller price for sidebar */
        text-align: left;
        color: #4a5568;
        /* gray-700 */
        white-space: nowrap;
        /* Prevent price from wrapping onto a new line */
        margin-left: 0.5rem;
        /* Space between title and price */
        font-weight: 600;
    }

    /* Hide add to cart button in sidebar to keep it compact */
    .sidebar-products-list li.product .button {
        display: none;
    }
</style>