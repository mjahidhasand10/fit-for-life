<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php bloginfo('name'); ?></title>

    <!-- Import Hind Siliguri from Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/styles/output.css">
    <?php include get_template_directory() . '/speculation-rules.php'; ?>
</head>

<body>
    <header>
        <div class="top-bar">
            <div class="container">
                <span>Office Time : 08:00 AM - 12:00 AM | Hotline : +8809639426742</span>
                <nav>
                    <a href="">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/facebook.svg" alt="Facebook" class="w-4 h-4">
                    </a>
                    <a href="">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/instagram.svg" alt="Instagram" class="w-4 h-4">
                    </a>
                    <a href="">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/threads.svg" alt="Threads" class="w-4 h-4">
                    </a>
                    <a href="">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/whatsapp.svg" alt="WhatsApp" class="w-4 h-4">
                    </a>
                    <a href="">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/tiktok.svg" alt="Tiktok" class="w-4 h-4">
                    </a>
                    <a href="">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/telegram.svg" alt="Facebook" class="w-4 h-4">
                    </a>
                </nav>
            </div>
        </div>

        <div class="container bottom-bar">
            <div class="mobile-tablet">
                <button id="menu-toggle-button" class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#000000">
                        <path d="M3 17H21C21.5523 17 22 17.4477 22 18C22 18.5128 21.614 18.9355 21.1166 18.9933L21 19H3C2.44772 19 2 18.5523 2 18C2 17.4872 2.38604 17.0645 2.88338 17.0067L3 17H21H3ZM2.99988 11L20.9999 10.9978C21.5522 10.9978 22 11.4454 22 11.9977C22 12.5105 21.6141 12.9333 21.1167 12.9911L21.0001 12.9978L3.00012 13C2.44784 13.0001 2 12.5524 2 12.0001C2 11.4873 2.38594 11.0646 2.88326 11.0067L2.99988 11L20.9999 10.9978L2.99988 11ZM3 5H21C21.5523 5 22 5.44772 22 6C22 6.51284 21.614 6.93551 21.1166 6.99327L21 7H3C2.44772 7 2 6.55228 2 6C2 5.48716 2.38604 5.06449 2.88338 5.00673L3 5H21H3Z" fill="#000000" />
                    </svg>
                    <span class="font-semibold">Menu</span>
                </button>

                <aside id="mobile-menu-aside"></aside>

            </div>

            <a href="/" class="logo-link"> <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.webp" alt="Logo">
            </a>

            <nav>
                <a href="/" class="<?php echo (is_front_page() ? 'active' : ''); ?>">Home</a>
                <a href="/shop" class="<?php echo (strpos($_SERVER['REQUEST_URI'], '/shop') === 0 ? 'active' : ''); ?>">All Products</a>
                <a href="/about-us" class="<?php echo (strpos($_SERVER['REQUEST_URI'], '/about-us') === 0 ? 'active' : ''); ?>">About Us</a>
                <a href="/blog" class="<?php echo (strpos($_SERVER['REQUEST_URI'], '/blog') === 0 ? 'active' : ''); ?>">Blog</a>
                <a href="/contact-us" class="<?php echo (strpos($_SERVER['REQUEST_URI'], '/contact-us') === 0 ? 'active' : ''); ?>">Contact us</a>
            </nav>


            <div>
                <button>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#000000">
                        <path d="M14.8432 16.3679C13.4988 17.392 11.8204 18 10 18C5.58172 18 2 14.4183 2 10C2 5.58172 5.58172 2 10 2C14.4183 2 18 5.58172 18 10C18 11.8768 17.3537 13.6027 16.2715 14.9672L20.6982 19.2841C21.0936 19.6697 21.1015 20.3028 20.7159 20.6982C20.3303 21.0936 19.6972 21.1015 19.3018 20.7159L14.8432 16.3679ZM16 10C16 6.68629 13.3137 4 10 4C6.68629 4 4 6.68629 4 10C4 13.3137 6.68629 16 10 16C13.3137 16 16 13.3137 16 10Z" fill="#000000" />
                    </svg>
                </button>

                <?php if (is_user_logged_in()) : ?>
                    <a href="/my-account" class="hidden lg:block text-sm font-bold">My Account</a>
                <?php else : ?>
                    <a href="/sign-in" class="hidden lg:block text-sm font-bold">Login / Register</a>
                <?php endif; ?>

                <a href="/wishlist" class="hidden lg:block">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#000000">
                        <path d="M12.8199 5.57912L11.9992 6.40163L11.1759 5.57838C9.07688 3.47931 5.67361 3.47931 3.57455 5.57838C1.47548 7.67744 1.47548 11.0807 3.57455 13.1798L11.4699 21.0751C11.7628 21.368 12.2377 21.368 12.5306 21.0751L20.432 13.1783C22.5264 11.0723 22.53 7.67857 20.4306 5.57912C18.3277 3.47623 14.9228 3.47623 12.8199 5.57912ZM19.3684 12.1206L12.0002 19.4842L4.63521 12.1191C3.12192 10.6058 3.12192 8.15232 4.63521 6.63904C6.14849 5.12575 8.602 5.12575 10.1153 6.63904L11.4727 7.99648C11.7706 8.29435 12.2553 8.28854 12.5459 7.98363L13.8806 6.63978C15.3977 5.12268 17.8528 5.12268 19.3699 6.63978C20.8836 8.15343 20.881 10.5997 19.3684 12.1206Z" fill="#000000" />
                    </svg>
                </a>
                <button id="cart-toggle-button" class="relative">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#000000">
                        <path d="M2.5 4.25C2.5 3.83579 2.83579 3.5 3.25 3.5H3.80826C4.75873 3.5 5.32782 4.13899 5.65325 4.73299C5.87016 5.12894 6.02708 5.58818 6.14982 6.00395C6.18306 6.00134 6.21674 6 6.2508 6H18.7481C19.5783 6 20.1778 6.79442 19.9502 7.5928L18.1224 14.0019C17.7856 15.1832 16.7062 15.9978 15.4779 15.9978H9.52977C8.29128 15.9978 7.2056 15.1699 6.87783 13.9756L6.11734 11.2045L4.85874 6.95578L4.8567 6.94834C4.701 6.38051 4.55487 5.85005 4.33773 5.4537C4.12686 5.0688 3.95877 5 3.80826 5H3.25C2.83579 5 2.5 4.66421 2.5 4.25ZM9 21C10.1046 21 11 20.1046 11 19C11 17.8954 10.1046 17 9 17C7.89543 17 7 17.8954 7 19C7 20.1046 7.89543 21 9 21ZM16 21C17.1046 21 18 20.1046 18 19C18 17.8954 17.1046 17 16 17C14.8954 17 14 17.8954 14 19C14 20.1046 14.8954 21 16 21Z" fill="#000000" />
                    </svg>
                    <span class="text-sm font-bold">0.00৳</span>
                </button>
            </div>
        </div>
    </header>

    <!-- Mobile Menu -->
    <div id="mobile-menu-overlay" class="fixed inset-0 bg-black/50 z-40 hidden"></div>

    <aside id="mobile-menu-aside" class="fixed top-0 left-0 w-72 h-full bg-white shadow-lg z-50 transform -translate-x-full transition-transform duration-300 ease-in-out">
        <div class="flex items-center justify-between p-4 border-b">
            <span class="font-semibold text-lg">Menu</span>
            <button id="close-menu-button" class="text-gray-600 hover:text-black">
                ✕
            </button>
        </div>
        <nav class="flex flex-col gap-4 p-4">
            <a href="/" class="text-sm font-medium text-gray-800 hover:text-purple-600">Home</a>
            <a href="/shop" class="text-sm font-medium text-gray-800 hover:text-purple-600">All Products</a>
            <a href="/about-us" class="text-sm font-medium text-gray-800 hover:text-purple-600">About Us</a>
            <a href="/blog" class="text-sm font-medium text-gray-800 hover:text-purple-600">Blog</a>
            <a href="/contact-us" class="text-sm font-medium text-gray-800 hover:text-purple-600">Contact Us</a>
            <?php if (is_user_logged_in()) : ?>
                <a href="/my-account" class="text-sm font-medium text-gray-800 hover:text-purple-600">My Account</a>
            <?php else : ?>
                <a href="/sign-in" class="text-sm font-medium text-gray-800 hover:text-purple-600">Login / Register</a>
            <?php endif; ?>
        </nav>
    </aside>

    <!-- Cart Overlay -->
    <div id="cart-overlay" class="fixed inset-0 bg-black/50 z-40 hidden"></div>

    <!-- Cart Drawer -->
    <aside id="cart-drawer"
        class="fixed top-0 right-0 w-80 max-w-full h-full bg-white z-50 transform translate-x-full transition-transform duration-300 ease-in-out shadow-xl">
        <div class="flex items-center justify-between p-4 border-b">
            <span class="text-lg font-semibold">Your Cart</span>
            <button id="close-cart-button" class="text-gray-600 hover:text-black text-xl font-bold">×</button>
        </div>
        <div class="p-4 space-y-4 overflow-y-auto h-[calc(100%-64px)]">
            <!-- Replace with dynamic cart items -->
            <div class="flex justify-between items-center border-b pb-2">
                <div>
                    <p class="text-sm font-medium">Product Name</p>
                    <p class="text-xs text-gray-500">1 × 450৳</p>
                </div>
                <span class="text-sm font-bold">450৳</span>
            </div>
            <div class="flex justify-between items-center border-b pb-2">
                <div>
                    <p class="text-sm font-medium">Another Item</p>
                    <p class="text-xs text-gray-500">2 × 250৳</p>
                </div>
                <span class="text-sm font-bold">500৳</span>
            </div>
            <!-- End dummy items -->
        </div>
        <div class="p-4 border-t">
            <button class="w-full bg-purple-700 text-white text-sm font-semibold py-2 rounded hover:bg-purple-800">
                Proceed to Checkout
            </button>
        </div>
    </aside>