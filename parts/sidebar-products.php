<section class="bg-white p-6 rounded-lg shadow-md">
  <h3 class="text-xl font-bold mb-6 border-b border-gray-200 pb-3 text-gray-800">Latest Products</h3>
  <div class="sidebar-products-list">
    <?php echo do_shortcode('[products limit="5" columns="1" orderby="date"]'); ?>
  </div>
</section>