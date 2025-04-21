<?php
/**
 * Plugin Name: WP Portfolio
 * Description: Adds a Portfolio custom post type with custom fields and a shortcode for front-end display.
 * Version: 1.0
 * Author: Nitesh Patel
 * Text Domain: wp-portfolio
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class NP_Custom_Portfolio {
    public function __construct() {
        add_action('init', [$this, 'register_portfolio_cpt']);
        add_action('add_meta_boxes', [$this, 'add_custom_meta_boxes']);
        add_action('save_post', [$this, 'save_meta_fields']);
        add_shortcode('portfolio', [$this, 'portfolio_shortcode']);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_styles']);
    }

    public function register_portfolio_cpt() {
        $labels = [
            'name' => 'Portfolios',
            'singular_name' => 'Portfolio',
            'add_new' => 'Add New',
            'add_new_item' => 'Add New Portfolio',
            'edit_item' => 'Edit Portfolio',
            'new_item' => 'New Portfolio',
            'view_item' => 'View Portfolio',
            'search_items' => 'Search Portfolios',
            'not_found' => 'No portfolios found',
            'not_found_in_trash' => 'No portfolios found in Trash',
        ];

        $args = [
            'labels' => $labels,
            'public' => true,
            'menu_icon' => 'dashicons-portfolio',
            'supports' => ['title', 'thumbnail'],
            'has_archive' => true,
            'rewrite' => ['slug' => 'portfolio'],
        ];

        register_post_type('portfolio', $args);
    }

    public function add_custom_meta_boxes() {
        add_meta_box('portfolio_meta_box', 'Project Details', [$this, 'render_meta_box'], 'portfolio', 'normal', 'high');
    }

    public function render_meta_box($post) {
        wp_nonce_field('portfolio_meta_box_nonce', 'portfolio_meta_box_nonce_field');

        $project_name = get_post_meta($post->ID, '_np_project_name', true);
        $completion_date = get_post_meta($post->ID, '_np_completion_date', true);
        $project_url = get_post_meta($post->ID, '_np_project_url', true);
        $description = get_post_meta($post->ID, '_np_description', true);

        ?>
        <p>
            <label for="np_project_name">Project Name:</label><br>
            <input type="text" name="np_project_name" id="np_project_name" value="<?php echo esc_attr($project_name); ?>" style="width: 100%;">
        </p>
        <p>
            <label for="np_completion_date">Completion Date:</label><br>
            <input type="date" name="np_completion_date" id="np_completion_date" value="<?php echo esc_attr($completion_date); ?>" style="width: 100%;">
        </p>
        <p>
            <label for="np_project_url">Project URL:</label><br>
            <input type="url" name="np_project_url" id="np_project_url" value="<?php echo esc_attr($project_url); ?>" style="width: 100%;">
        </p>
        <p><strong>Description:</strong></p>
        <?php
            $settings = [
                'textarea_name' => 'np_description',
                'media_buttons' => false,
                'textarea_rows' => 5,
                'editor_class' => 'np-description-editor',
            ];
            wp_editor(wp_kses_post($description), 'np_description', $settings);
        ?>
        <?php
    }

    public function save_meta_fields($post_id) {
        if (!isset($_POST['portfolio_meta_box_nonce_field']) || !wp_verify_nonce($_POST['portfolio_meta_box_nonce_field'], 'portfolio_meta_box_nonce')) {
            return;
        }

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

        if (!current_user_can('edit_post', $post_id)) return;

        $fields = [
            'np_project_name' => sanitize_text_field($_POST['np_project_name'] ?? ''),
            'np_completion_date' => sanitize_text_field($_POST['np_completion_date'] ?? ''),
            'np_project_url' => esc_url_raw($_POST['np_project_url'] ?? ''),
            'np_description' => wp_kses_post($_POST['np_description'] ?? ''),
        ];

        foreach ($fields as $key => $value) {
            update_post_meta($post_id, '_' . $key, $value);
        }
    }

    public function enqueue_styles() {
        wp_enqueue_style('np-portfolio-style', plugin_dir_url(__FILE__) . 'css/style.css');
    }

    public function portfolio_shortcode($atts) {
        ob_start();

        $query = new WP_Query([
            'post_type' => 'portfolio',
            'posts_per_page' => -1,
        ]);

        if ($query->have_posts()) {
            echo '<div class="np-portfolio-grid">';
            while ($query->have_posts()) {
                $query->the_post();
                $project_name = get_post_meta(get_the_ID(), '_np_project_name', true);
                $completion_date = get_post_meta(get_the_ID(), '_np_completion_date', true);
                $project_url = get_post_meta(get_the_ID(), '_np_project_url', true);
                $description = get_post_meta(get_the_ID(), '_np_description', true);
                ?>
                <div class="np-portfolio-item">
                    <?php if (has_post_thumbnail()) {
                        the_post_thumbnail('medium');
                    } ?>
                    <h3><?php echo esc_html($project_name); ?></h3>
                    <p><strong>Completed:</strong> <?php echo esc_html($completion_date); ?></p>
                    <p><strong>Description:</strong> <?php echo esc_html($description); ?></p>
                    <?php if (!empty($project_url)): ?>
                        <p><a href="<?php echo esc_url($project_url); ?>" target="_blank" rel="noopener">View Project</a></p>
                    <?php endif; ?>
                </div>
                <?php
            }
            echo '</div>';
        } else {
            echo '<p>No portfolio items found.</p>';
        }

        wp_reset_postdata();
        return ob_get_clean();
    }
}

new NP_Custom_Portfolio();
