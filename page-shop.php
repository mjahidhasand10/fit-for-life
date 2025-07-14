<?php

/**
 * Template Name: All Products
 * Description: A custom template for the All Products page with a unique layout.
 *
 * @package official
 */

get_template_part(slug: 'parts/header');
?>

<main>
    <!-- Hero section -->
    <div class="bg-green-50 py-16 text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-2">Shop</h1>
    </div>

    <div class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Sidebar -->
            <aside class="lg:col-span-1">
                <!-- Price Filter Widget -->
                <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm mb-6">
                    <h3 class="text-lg font-semibold mb-4 text-gray-800 uppercase tracking-wide">Filter by Price</h3>

                    <div class="price-range-container mb-6">
                        <div class="range-slider relative h-2 bg-gray-200 rounded-full">
                            <div class="range-track absolute h-full bg-green-500 rounded-full transition-all duration-300"></div>
                            <input type="range" class="range-input absolute top-0 w-full h-2 bg-transparent appearance-none pointer-events-none"
                                id="minRange" min="0" max="10000" value="<?php echo isset($_GET['min_price']) ? intval($_GET['min_price']) : 100; ?>" step="50">
                            <input type="range" class="range-input absolute top-0 w-full h-2 bg-transparent appearance-none pointer-events-none"
                                id="maxRange" min="0" max="10000" value="<?php echo isset($_GET['max_price']) ? intval($_GET['max_price']) : 9000; ?>" step="50">
                        </div>
                    </div>

                    <div class="price-inputs flex items-center gap-2 mb-6 text-sm text-gray-600">
                        <span>Price:</span>
                        <span class="font-semibold text-gray-800" id="minPrice">
                            <?php echo isset($_GET['min_price']) ? number_format(intval($_GET['min_price'])) . '৳' : '100৳'; ?>
                        </span>
                        <span>—</span>
                        <span class="font-semibold text-gray-800" id="maxPrice">
                            <?php echo isset($_GET['max_price']) ? number_format(intval($_GET['max_price'])) . '৳' : '9,000৳'; ?>
                        </span>
                    </div>

                    <form method="GET" id="priceFilterForm">
                        <?php
                        // Preserve other GET parameters
                        foreach ($_GET as $key => $value) {
                            if (!in_array($key, ['min_price', 'max_price'])) {
                                echo '<input type="hidden" name="' . esc_attr($key) . '" value="' . esc_attr($value) . '">';
                            }
                        }
                        ?>
                        <input type="hidden" name="min_price" id="minPriceInput" value="<?php echo isset($_GET['min_price']) ? intval($_GET['min_price']) : 100; ?>">
                        <input type="hidden" name="max_price" id="maxPriceInput" value="<?php echo isset($_GET['max_price']) ? intval($_GET['max_price']) : 9000; ?>">
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-lg uppercase tracking-wide text-sm transition-all duration-300 hover:shadow-lg">
                            Filter
                        </button>
                    </form>
                </div>

                <!-- Category Filter -->
                <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm mb-6">
                    <h3 class="text-lg font-semibold mb-4 text-gray-800 uppercase tracking-wide">Categories</h3>
                    <?php
                    $categories = get_terms([
                        'taxonomy' => 'product_cat',
                        'hide_empty' => true,
                    ]);

                    if (!empty($categories)) :
                        foreach ($categories as $category) :
                            $is_selected = isset($_GET['product_cat']) && $_GET['product_cat'] === $category->slug;
                    ?>
                            <div class="mb-2">
                                <label class="flex items-center cursor-pointer">
                                    <input type="checkbox"
                                        class="category-filter mr-3 rounded border-gray-300 text-green-500 focus:ring-green-500"
                                        value="<?php echo esc_attr($category->slug); ?>"
                                        <?php checked($is_selected); ?>>
                                    <span class="text-gray-700 hover:text-green-600 transition-colors">
                                        <?php echo esc_html($category->name); ?>
                                        <span class="text-gray-500 text-sm">(<?php echo $category->count; ?>)</span>
                                    </span>
                                </label>
                            </div>
                    <?php
                        endforeach;
                    endif;
                    ?>
                </div>

                <!-- Clear Filters -->
                <?php if (!empty($_GET['min_price']) || !empty($_GET['max_price']) || !empty($_GET['product_cat'])) : ?>
                    <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-sm">
                        <a href="<?php echo get_permalink(); ?>"
                            class="block w-full text-center bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium py-2 px-4 rounded-lg transition-colors">
                            Clear All Filters
                        </a>
                    </div>
                <?php endif; ?>
            </aside>

            <!-- Products Grid -->
            <div class="lg:col-span-3">
                <div class="flex justify-between items-center mb-6">
                    <p class="text-gray-600">
                        <?php
                        $args = array(
                            'post_type' => 'product',
                            'posts_per_page' => -1,
                            'post_status' => 'publish'
                        );

                        // Add price filter
                        if (isset($_GET['min_price']) || isset($_GET['max_price'])) {
                            $args['meta_query'] = array();

                            if (isset($_GET['min_price'])) {
                                $args['meta_query'][] = array(
                                    'key' => '_price',
                                    'value' => intval($_GET['min_price']),
                                    'compare' => '>='
                                );
                            }

                            if (isset($_GET['max_price'])) {
                                $args['meta_query'][] = array(
                                    'key' => '_price',
                                    'value' => intval($_GET['max_price']),
                                    'compare' => '<='
                                );
                            }
                        }

                        // Add category filter
                        if (isset($_GET['product_cat'])) {
                            $args['tax_query'] = array(
                                array(
                                    'taxonomy' => 'product_cat',
                                    'field' => 'slug',
                                    'terms' => $_GET['product_cat']
                                )
                            );
                        }

                        $products = new WP_Query($args);
                        echo 'Showing ' . $products->found_posts . ' products';
                        ?>
                    </p>

                    <select class="border border-gray-300 rounded-lg px-3 py-2 text-sm" id="sortProducts">
                        <option value="">Sort by</option>
                        <option value="price_low">Price: Low to High</option>
                        <option value="price_high">Price: High to Low</option>
                        <option value="name">Name: A to Z</option>
                        <option value="date">Newest First</option>
                    </select>
                </div>

                <!-- Products Display -->
                <?php if ($products->have_posts()) : ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <?php while ($products->have_posts()) : $products->the_post(); ?>
                            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow duration-300">
                                <div class="aspect-square bg-gray-100">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>"
                                            alt="<?php echo get_the_title(); ?>"
                                            class="w-full h-full object-cover">
                                    <?php else : ?>
                                        <div class="w-full h-full flex items-center justify-center text-gray-400">
                                            <span>No Image</span>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="p-4">
                                    <h3 class="font-semibold text-lg mb-2 text-gray-800">
                                        <a href="<?php the_permalink(); ?>" class="hover:text-green-600 transition-colors">
                                            <?php the_title(); ?>
                                        </a>
                                    </h3>

                                    <div class="flex items-center justify-between">
                                        <span class="text-2xl font-bold text-green-600">
                                            <?php echo get_post_meta(get_the_ID(), '_price', true) ? number_format(get_post_meta(get_the_ID(), '_price', true)) . '৳' : 'Price not set'; ?>
                                        </span>

                                        <a href="<?php the_permalink(); ?>"
                                            class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                                            View Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-12 flex justify-center">
                        <?php
                        echo paginate_links(array(
                            'total' => $products->max_num_pages,
                            'prev_text' => '← Previous',
                            'next_text' => 'Next →',
                            'mid_size' => 2,
                            'class' => 'pagination'
                        ));
                        ?>
                    </div>

                <?php else : ?>
                    <div class="text-center py-12">
                        <p class="text-gray-600 text-lg">No products found matching your criteria.</p>
                        <a href="<?php echo get_permalink(); ?>"
                            class="inline-block mt-4 bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-lg transition-colors">
                            View All Products
                        </a>
                    </div>
                <?php endif; ?>

                <?php wp_reset_postdata(); ?>
            </div>
        </div>
    </div>
</main>

<style>
    /* Price Range Slider Styles */
    .range-input {
        -webkit-appearance: none;
        appearance: none;
        background: transparent;
        cursor: pointer;
    }

    .range-input::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 20px;
        height: 20px;
        background: #10b981;
        border: 2px solid white;
        border-radius: 50%;
        cursor: pointer;
        pointer-events: all;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
    }

    .range-input::-webkit-slider-thumb:hover {
        background: #059669;
        transform: scale(1.1);
    }

    .range-input::-moz-range-thumb {
        width: 20px;
        height: 20px;
        background: #10b981;
        border: 2px solid white;
        border-radius: 50%;
        cursor: pointer;
        pointer-events: all;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
    }

    .range-input::-moz-range-thumb:hover {
        background: #059669;
        transform: scale(1.1);
    }

    .range-track {
        background: #10b981;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Price Range Slider
        const minRange = document.getElementById('minRange');
        const maxRange = document.getElementById('maxRange');
        const minPrice = document.getElementById('minPrice');
        const maxPrice = document.getElementById('maxPrice');
        const minPriceInput = document.getElementById('minPriceInput');
        const maxPriceInput = document.getElementById('maxPriceInput');
        const rangeTrack = document.querySelector('.range-track');

        function updatePriceDisplay() {
            const minVal = parseInt(minRange.value);
            const maxVal = parseInt(maxRange.value);

            minPrice.textContent = minVal.toLocaleString() + '৳';
            maxPrice.textContent = maxVal.toLocaleString() + '৳';

            minPriceInput.value = minVal;
            maxPriceInput.value = maxVal;
        }

        function updateRangeTrack() {
            const min = parseInt(minRange.min);
            const max = parseInt(minRange.max);
            const minVal = parseInt(minRange.value);
            const maxVal = parseInt(maxRange.value);

            const leftPercent = ((minVal - min) / (max - min)) * 100;
            const rightPercent = ((maxVal - min) / (max - min)) * 100;

            rangeTrack.style.left = leftPercent + '%';
            rangeTrack.style.width = (rightPercent - leftPercent) + '%';
        }

        minRange.addEventListener('input', function() {
            if (parseInt(minRange.value) >= parseInt(maxRange.value)) {
                minRange.value = parseInt(maxRange.value) - 50;
            }
            updatePriceDisplay();
            updateRangeTrack();
        });

        maxRange.addEventListener('input', function() {
            if (parseInt(maxRange.value) <= parseInt(minRange.value)) {
                maxRange.value = parseInt(minRange.value) + 50;
            }
            updatePriceDisplay();
            updateRangeTrack();
        });

        // Initialize display
        updatePriceDisplay();
        updateRangeTrack();

        // Category Filter
        const categoryFilters = document.querySelectorAll('.category-filter');
        categoryFilters.forEach(filter => {
            filter.addEventListener('change', function() {
                const url = new URL(window.location);
                if (this.checked) {
                    url.searchParams.set('product_cat', this.value);
                } else {
                    url.searchParams.delete('product_cat');
                }
                window.location.href = url.toString();
            });
        });

        // Sort Products
        const sortSelect = document.getElementById('sortProducts');
        sortSelect.addEventListener('change', function() {
            const url = new URL(window.location);
            if (this.value) {
                url.searchParams.set('orderby', this.value);
            } else {
                url.searchParams.delete('orderby');
            }
            window.location.href = url.toString();
        });
    });
</script>

<?php get_template_part('parts/footer'); ?>