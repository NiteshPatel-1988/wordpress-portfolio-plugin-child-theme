<?php
// Enqueue parent and child theme styles
function twentytwentyfour_child_enqueue_styles() {
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('child-style', get_stylesheet_uri());

    // Portfolio styling
    wp_enqueue_style('portfolio-style', get_stylesheet_directory_uri() . '/assets/css/portfolio-style.css', [], '1.0');
}
add_action('wp_enqueue_scripts', 'twentytwentyfour_child_enqueue_styles');

// Register custom menu
function twentytwentyfour_child_register_menu() {
    register_nav_menu('custom-header-menu', __('Custom Header Menu', 'twentytwentyfour-child'));
}
add_action('after_setup_theme', 'twentytwentyfour_child_register_menu');
