<?php
// Load parent header for structure
get_template_part( 'header' );

// Add custom navigation
?>
<nav class="custom-header-nav">
    <?php
        wp_nav_menu([
            'theme_location' => 'custom-header-menu',
            'container' => false,
            'menu_class' => 'custom-nav-menu',
        ]);
    ?>
</nav>
