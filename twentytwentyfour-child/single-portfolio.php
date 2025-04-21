<?php get_header(); ?>

<main class="single-portfolio container">
    <?php
        if (have_posts()): while (have_posts()): the_post();
            $desc = get_post_meta(get_the_ID(), '_np_description', true);
            $url = get_post_meta(get_the_ID(), '_np_project_url', true);
    ?>
        <h1><?php the_title(); ?></h1>
        <?php the_post_thumbnail('large'); ?>
        <div class="portfolio-desc"><?php echo wp_kses_post($desc); ?></div>
        <p><a href="<?php echo esc_url($url); ?>" class="btn" target="_blank">Visit Project</a></p>
    <?php endwhile; endif; ?>
</main>

<?php get_footer(); ?>
