<aside class="sidebar-menu-container">
    <?php
    if (has_nav_menu('sidebar-menu')) {
        wp_nav_menu(array(
            'theme_location' => 'sidebar-menu',
            'menu_class'     => 'sidebar-nav',
            'container'      => false,
        ));
    } else {
        echo '<p>Please assign a menu to the Sidebar Menu location.</p>';
    }
    ?>
</aside>