<?php get_header(); ?>

<main class="portfolio-archive container">
    <h1 class="portfolio-title"><?php post_type_archive_title(); ?></h1>

    <div class="portfolio-grid">
        <?php
        if (have_posts()):
            while (have_posts()): the_post();
                $project_url = get_post_meta(get_the_ID(), '_np_project_url', true);
        ?>
            <div class="portfolio-item">
                <?php the_post_thumbnail('medium'); ?>
                <h2><?php the_title(); ?></h2>
                <p><a href="<?php echo esc_url($project_url); ?>" target="_blank">View Project</a></p>
            </div>
        <?php endwhile; else: ?>
            <p>No portfolio items found.</p>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>
