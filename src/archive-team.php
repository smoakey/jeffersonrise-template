<?php
$wp_query = new WP_Query([
    'post_type' => 'team',
    'posts_per_page' => team_posts_per_page,
    'order' => 'ASC'
]);
?>

<?php get_header(); ?>
    <main>
        <header class="page-header">
            <h2 class="container">
                <a href="/careers" class="button button-solid-blue pull-right">
                    Open Positions
                </a>
                Team
            </h2>
        </header>
        <div class="page-content container team-members">
            <div class="row">
                <?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
                    <?php $position = $wp_query->current_post + 1; ?>
                    <div class="four columns">
                        <a href="<?php the_permalink(); ?>" class="team-member text-center">
                            <div class="team-member-photo">
                                <img src="<?php the_field('photo'); ?>" alt="<?php the_field('name'); ?>" />
                            </div>
                            <h5 class="team-member-name no-margin"><?php the_field('name'); ?></h5>
                            <h6 class="text-red "><?php the_field('role'); ?></h6>
                        </a>
                    </div>

                    <?php if ($position % 3 == 0) : ?>
                        </div>
                        <div class="row">
                    <?php endif; ?>
                <?php endwhile; ?>
            </div>
        </div>
    </main>

<?php get_footer(); ?>