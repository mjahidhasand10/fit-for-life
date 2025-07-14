<script>
    document.addEventListener("DOMContentLoaded", function() {
        const tabButtons = document.querySelectorAll(".tab-btn");
        const tabContents = document.querySelectorAll(".tab-content");

        tabButtons.forEach(btn => {
            btn.addEventListener("click", () => {
                const target = btn.getAttribute("data-tab");

                // Remove all active states
                tabButtons.forEach(b => {
                    b.classList.remove("border-green-600", "text-green-700");
                    b.classList.add("border-transparent", "text-gray-500");
                });

                tabContents.forEach(tc => tc.classList.add("hidden"));

                // Set active
                btn.classList.remove("border-transparent", "text-gray-500");
                btn.classList.add("border-green-600", "text-green-700");
                document.getElementById(target).classList.remove("hidden");
            });
        });
    });
</script>

<footer class=" bg-gray-900 text-gray-300 text-sm border-t border-gray-300">
    <div class="container mx-auto px-4 py-12 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">

        <!-- Column 1: Logo + Contact -->
        <div>
            <a href="/" class="logo-link max-w-48"> <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.webp" alt="Logo" class="w-full">
            </a>
            <p class="my-2">80 Eskandar Ali Road, Narayanpur, Pabna Sadar, Pabna</p>
            <p class="flex items-center gap-2 mb-1"><span class="text-green-400">📞</span> 01717426742</p>
            <p class="flex items-center gap-2 mb-1"><span class="text-green-400">📞</span> 01620858385</p>
            <p class="flex items-center gap-2"><span class="text-green-400">✉️</span> info@fitforlifebd.com</p>

            <div class="flex items-center space-x-4 mt-4 text-lg">
                <a href="#" class="hover:text-white"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="hover:text-white"><i class="fab fa-instagram"></i></a>
                <a href="#" class="hover:text-white"><i class="fab fa-youtube"></i></a>
                <a href="#" class="hover:text-white"><i class="fab fa-whatsapp"></i></a>
                <a href="#" class="hover:text-white"><i class="fab fa-tiktok"></i></a>
            </div>
        </div>

        <!-- Column 2: Useful Links -->
        <div>
            <h4 class="font-semibold mb-4">USEFUL LINKS</h4>
            <ul class="space-y-2">
                <li><a href="#" class="hover:text-white">About us</a></li>
                <li><a href="#" class="hover:text-white">Contact us</a></li>
                <li><a href="#" class="hover:text-white">Returns and Refunds Policy</a></li>
                <li><a href="#" class="hover:text-white">Terms and Conditions</a></li>
                <li><a href="#" class="hover:text-white">FAQ</a></li>
            </ul>
        </div>

        <!-- Column 3: Categories -->
        <div>
            <h4 class="font-semibold mb-4">CATEGORIES</h4>
            <ul class="space-y-2">
                <li><a href="#" class="hover:text-white">Honey</a></li>
                <li><a href="#" class="hover:text-white">Herbs</a></li>
                <li><a href="#" class="hover:text-white">Seeds</a></li>
            </ul>
        </div>

        <!-- Column 4: Quick Links -->
        <div>
            <h4 class="font-semibold mb-4">QUICK LINKS</h4>
            <ul class="space-y-2">
                <li><a href="#" class="hover:text-white">Affiliate Program</a></li>
                <li><a href="#" class="hover:text-white">Corporate</a></li>
                <li><a href="#" class="hover:text-white">Reseller</a></li>
                <li><a href="#" class="hover:text-white">Dealership</a></li>
                <li><a href="#" class="hover:text-white">Career</a></li>
            </ul>
        </div>

    </div>

    <div class="border-t border-gray-700 text-center py-4 text-xs text-gray-400">
        © 2019 - 2025 <strong class="text-green-600">Fit for Life</strong> - All Rights Reserved.
    </div>
</footer>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const toggleBtn = document.getElementById('menu-toggle-button');
        const menu = document.getElementById('mobile-menu-aside');
        const overlay = document.getElementById('mobile-menu-overlay');
        const closeBtn = document.getElementById('close-menu-button');

        toggleBtn.addEventListener('click', () => {
            overlay.classList.remove('hidden');
            menu.classList.remove('-translate-x-full');
            menu.classList.add('translate-x-0');
        });

        const closeMenu = () => {
            menu.classList.remove('translate-x-0');
            menu.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        };

        closeBtn?.addEventListener('click', closeMenu);
        overlay?.addEventListener('click', closeMenu);
    });
</script>

<script>
  document.addEventListener("DOMContentLoaded", () => {
    const cartToggle = document.getElementById("cart-toggle-button");
    const cartDrawer = document.getElementById("cart-drawer");
    const cartOverlay = document.getElementById("cart-overlay");
    const cartClose = document.getElementById("close-cart-button");

    cartToggle.addEventListener("click", () => {
      cartDrawer.classList.remove("translate-x-full");
      cartDrawer.classList.add("translate-x-0");
      cartOverlay.classList.remove("hidden");
    });

    const closeCart = () => {
      cartDrawer.classList.remove("translate-x-0");
      cartDrawer.classList.add("translate-x-full");
      cartOverlay.classList.add("hidden");
    };

    cartClose.addEventListener("click", closeCart);
    cartOverlay.addEventListener("click", closeCart);
  });
</script>

</body>

</html>