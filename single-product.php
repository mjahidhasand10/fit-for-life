<?php
global $post, $product;

// Get WC_Product object safely
if (!is_a($product, 'WC_Product')) {
    $product = wc_get_product($post->ID);
}

// Safety check - exit if no product
if (!$product) {
    return;
}

$main_image_id = $product->get_image_id();
$gallery_image_ids = $product->get_gallery_image_ids();
?>

<?php get_template_part('parts/header'); ?>

<main class="product page">
    <div class="container mx-auto flex items-center justify-between py-4">
        <p class="text-sm text-gray-500">
            <a href="/" class="text-gray-500 hover:text-green-700">Home</a>
            <span class="text-gray-500 mx-1">/</span>
            <a href="/" class="text-gray-500 hover:text-green-700">গুড়</a>
            <span class="text-gray-500 mx-1">/</span>
            <strong class="font-semibold text-gray-900"><?php the_title(); ?></strong>
        </p>

        <nav class="flex items-center gap-2">
            <button type="button" aria-label="Previous product">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="text-green-700" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0" />
                </svg>
            </button>
            <button type="button" aria-label="Compare products">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="text-green-700">
                    <path d="M18.4923 2.33088L21.671 5.50966C22.5497 6.38834 22.5497 7.81296 21.671 8.69164L19.0866 11.2756C20.1696 11.438 21 12.3723 21 13.5006V18.7506C21 19.9932 19.9926 21.0006 18.75 21.0006H5.25C4.00736 21.0006 3 19.9932 3 18.7506V5.25055C3 4.00791 4.00736 3.00055 5.25 3.00055H10.5C11.6289 3.00055 12.5637 3.83201 12.7253 4.91596L15.3103 2.33088C16.189 1.45221 17.6136 1.45221 18.4923 2.33088ZM4.5 18.7506C4.5 19.1648 4.83579 19.5006 5.25 19.5006L11.249 19.4999L11.25 12.7506L4.5 12.7499V18.7506ZM12.749 19.4999L18.75 19.5006C19.1642 19.5006 19.5 19.1648 19.5 18.7506V13.5006C19.5 13.0863 19.1642 12.7506 18.75 12.7506L12.749 12.7499V19.4999ZM10.5 4.50055H5.25C4.83579 4.50055 4.5 4.83634 4.5 5.25055V11.2499H11.25V5.25055C11.25 4.83634 10.9142 4.50055 10.5 4.50055ZM12.75 9.30988V11.2506L14.69 11.2499L12.75 9.30988ZM16.3709 3.39154L13.1922 6.57032C12.8993 6.86321 12.8993 7.33808 13.1922 7.63098L16.3709 10.8097C16.6638 11.1026 17.1387 11.1026 17.4316 10.8097L20.6104 7.63098C20.9033 7.33808 20.9033 6.86321 20.6104 6.57032L17.4316 3.39154C17.1387 3.09865 16.6638 3.09865 16.3709 3.39154Z" />
                </svg>
            </button>
            <button type="button" aria-label="Next product">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="text-green-700" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708" />
                </svg>
            </button>
        </nav>
    </div>

    <div class="border-b border-gray-200">
        <div class="container mx-auto my-6 flex gap-6 flex-col md:flex-row">
            <!-- Product Image Section -->
            <div class="w-full">
                <?php if ($main_image_id): ?>
                    <div class="product-image-main mb-4">
                        <?php echo wp_get_attachment_image($main_image_id, 'woocommerce_single', false, array('class' => 'w-full h-auto rounded-lg transition-opacity duration-300')); ?>
                    </div>

                    <?php if ($gallery_image_ids): ?>
                        <div class="product-image-gallery grid grid-cols-4 gap-2">
                            <?php foreach ($gallery_image_ids as $image_id): ?>
                                <div class="gallery-thumbnail">
                                    <?php echo wp_get_attachment_image($image_id, 'woocommerce_gallery_thumbnail', false, array('class' => 'w-full h-auto rounded cursor-pointer hover:opacity-80')); ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                <?php else: ?>
                    <div class="no-image bg-gray-200 flex items-center justify-center h-96 rounded-lg">
                        <span class="text-gray-500">No image available</span>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Product Details Section -->
            <div class="w-full space-y-4">
                <h1 class="text-2xl font-extrabold text-gray-900"><?php the_title(); ?></h1>

                <div class="price-section">
                    <?php if ($product->is_on_sale()) : ?>
                        <span class="regular-price line-through text-gray-500 mr-2">
                            <?php echo wc_price($product->get_regular_price()); ?>
                        </span>
                        <span class="sale-price text-2xl font-bold text-green-700">
                            <?php echo wc_price($product->get_sale_price()); ?>
                        </span>
                    <?php else : ?>
                        <span class="current-price text-2xl font-bold text-green-700">
                            <?php echo wc_price($product->get_price()); ?>
                        </span>
                    <?php endif; ?>
                </div>

                <p class="text-sm text-gray-900">
                    <strong>☎️ Hotline</strong>: <strong class="text-green-700">09639-426742</strong>
                </p>

                <!-- Add to Cart Form -->
                <form class="cart" action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())); ?>" method="post" enctype='multipart/form-data'>
                    <div class="flex items-center gap-4">
                        <div class="inline-flex items-center border border-gray-300 rounded">
                            <button type="button" class="quantity-minus w-8 h-10 text-lg font-bold hover:bg-gray-100" onclick="changeQuantity(-1)">-</button>
                            <input type="number" name="quantity" value="1" min="1" class="quantity-input w-12 h-10 text-center border-x border-gray-300 focus:outline-none" />
                            <button type="button" class="quantity-plus w-8 h-10 text-lg font-bold hover:bg-gray-100" onclick="changeQuantity(1)">+</button>
                        </div>

                        <button type="submit" name="add-to-cart" value="<?php echo esc_attr($product->get_id()); ?>" class="single_add_to_cart_button button alt h-10 py-1.5 px-5 bg-red-600 hover:bg-red-700 text-white uppercase text-[13px] font-semibold shadow-inner transition-colors">
                            Add to cart
                        </button>

                        <button type="button" class="h-10 py-1.5 px-5 bg-red-600 hover:bg-red-700 text-white uppercase text-[13px] font-semibold shadow-inner transition-colors">
                            Buy Now
                        </button>
                    </div>
                </form>

                <hr class="border-gray-200">

                <div class="flex items-center gap-4">
                    <button type="button" class="text-sm text-gray-600 hover:text-green-700 transition-colors">
                        <span>Compare</span>
                    </button>
                    <button type="button" class="text-sm text-gray-600 hover:text-green-700 transition-colors">
                        <span>Add to wishlist</span>
                    </button>
                </div>

                <p class="text-sm">
                    <span class="font-medium">Categories:</span>
                    <span>
                        <?php echo wc_get_product_category_list($product->get_id(), ', ', '<span class="product-categories">', '</span>'); ?>
                    </span>
                </p>

                <div class="text-sm">
                    <span class="font-medium">Share:</span>
                    <div class="flex items-center gap-2 mt-2">
                        <button type="button" class="p-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition-colors" title="Share on Facebook">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                            </svg>
                        </button>
                        <button type="button" class="p-2 bg-blue-400 text-white rounded hover:bg-blue-500 transition-colors" title="Share on Twitter">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto space-y-6 py-6">
        <!-- Product Features -->
        <div class="space-y-2">
            <h4 class="py-1 px-3 bg-green-800 text-white font-semibold inline-block rounded">Top Brand Fit For Life</h4>
            <p class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="text-green-700">
                    <path d="M12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2ZM15.2197 8.96967L10.75 13.4393L8.78033 11.4697C8.48744 11.1768 8.01256 11.1768 7.71967 11.4697C7.42678 11.7626 7.42678 12.2374 7.71967 12.5303L10.2197 15.0303C10.5126 15.3232 10.9874 15.3232 11.2803 15.0303L16.2803 10.0303C16.5732 9.73744 16.5732 9.26256 16.2803 8.96967C15.9874 8.67678 15.5126 8.67678 15.2197 8.96967Z" />
                </svg>
                <span>95% Positive Ratings From 20K+ Customers</span>
            </p>
            <p class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="text-green-700">
                    <path d="M12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2ZM15.2197 8.96967L10.75 13.4393L8.78033 11.4697C8.48744 11.1768 8.01256 11.1768 7.71967 11.4697C7.42678 11.7626 7.42678 12.2374 7.71967 12.5303L10.2197 15.0303C10.5126 15.3232 10.9874 15.3232 11.2803 15.0303L16.2803 10.0303C16.5732 9.73744 16.5732 9.26256 16.2803 8.96967C15.9874 8.67678 15.5126 8.67678 15.2197 8.96967Z" />
                </svg>
                <span>5+ Years on Bangladesh</span>
            </p>
            <p class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="text-green-700">
                    <path d="M12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2ZM15.2197 8.96967L10.75 13.4393L8.78033 11.4697C8.48744 11.1768 8.01256 11.1768 7.71967 11.4697C7.42678 11.7626 7.42678 12.2374 7.71967 12.5303L10.2197 15.0303C10.5126 15.3232 10.9874 15.3232 11.2803 15.0303L16.2803 10.0303C16.5732 9.73744 16.5732 9.26256 16.2803 8.96967C15.9874 8.67678 15.5126 8.67678 15.2197 8.96967Z" />
                </svg>
                <span>100% Chemical Free</span>
            </p>
            <p class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="text-green-700">
                    <path d="M12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2ZM15.2197 8.96967L10.75 13.4393L8.78033 11.4697C8.48744 11.1768 8.01256 11.1768 7.71967 11.4697C7.42678 11.7626 7.42678 12.2374 7.71967 12.5303L10.2197 15.0303C10.5126 15.3232 10.9874 15.3232 11.2803 15.0303L16.2803 10.0303C16.5732 9.73744 16.5732 9.26256 16.2803 8.96967C15.9874 8.67678 15.5126 8.67678 15.2197 8.96967Z" />
                </svg>
                <span>BSTI Approved</span>
            </p>
        </div>

        <!-- Product Tabs -->
        <div class="tabs mt-8">
            <!-- Tab Headers -->
            <div class="flex border-b border-gray-300 text-sm font-semibold text-gray-500 justify-center gap-2">
                <button type="button" class="tab-btn px-4 py-2 -mb-px border-b-2 border-green-600 text-green-700 bg-teal-50 active" data-tab="description">Description</button>
                <button type="button" class="tab-btn px-4 py-2 -mb-px border-b-2 border-transparent hover:text-green-700 hover:border-green-600 bg-gray-50" data-tab="qa">Q & A</button>
                <button type="button" class="tab-btn px-4 py-2 -mb-px border-b-2 border-transparent hover:text-green-700 hover:border-green-600 bg-gray-50" data-tab="shipping">Shipping & Delivery</button>
            </div>

            <!-- Tab Contents -->
            <div class="tab-content mt-6 border border-gray-200 p-4 bg-gray-50" id="description">
                <div class="prose max-w-none leading-relaxed">
                    <?php the_content(); ?>
                    <?php if (empty(get_the_content())): ?>
                        <p>No description available for this product.</p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="tab-content mt-6 border border-gray-200 p-4 bg-gray-50 hidden" id="qa">
                <div class="space-y-4">
                    <div class="flex flex-wrap items-center gap-2">
                        <div class="relative flex-1">
                            <input type="text" placeholder="🔍 Search answers" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-1 focus:ring-green-600" />
                        </div>
                        <button type="button" class="bg-green-700 hover:bg-green-800 text-white px-5 py-2 text-sm rounded font-semibold transition-colors">
                            ASK A QUESTION
                        </button>
                    </div>
                    <div class="text-center text-sm text-gray-700 mt-10">
                        <p>There are no questions yet</p>
                    </div>
                </div>
            </div>

            <div class="tab-content mt-6 border border-gray-200 p-4 bg-gray-50 hidden" id="shipping">
                <ul class="space-y-2 text-[15px] leading-relaxed">
                    <li>🚚 <strong>Cash on Delivery:</strong> সারাদেশে হোম ডেলিভারি – ২-৪ কর্মদিবসের মধ্যে</li>
                    <li>📞 <strong>Hotline:</strong> +8801620858385 , +8801717426742</li>
                    <li>🏠 <strong>Home Delivery Partner:</strong> Steadfast</li>
                    <li>📦 <strong>কুরিয়ার সার্ভিস:</strong> জননী কুরিয়ার, সওদাগর কুরিয়ার, করতোয়া কুরিয়ার, Rainbow কুরিয়ার, AJR</li>
                </ul>
            </div>
        </div>

        <!-- Related Products Section -->
        <div class="my-10">
            <h2 class="text-xl font-bold mb-6 text-gray-900">Related Products</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6">
                <?php
                $related_ids = wc_get_related_products($product->get_id(), 4);

                if ($related_ids) :
                    foreach ($related_ids as $related_id) :
                        $related_product = wc_get_product($related_id);

                        if (!$related_product || !$related_product->is_visible()) continue;

                        $temp_product = $GLOBALS['product'];
                        $GLOBALS['product'] = $related_product;
                        setup_postdata(get_post($related_id));

                        get_template_part('parts/card', 'product');

                        $GLOBALS['product'] = $temp_product;
                    endforeach;
                    wp_reset_postdata();
                else :
                    echo '<p class="text-sm text-gray-500">No related products found.</p>';
                endif;
                ?>
            </div>
        </div>
    </div>
</main>

<?php get_template_part('parts/footer'); ?>