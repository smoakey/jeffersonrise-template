<?php get_header(); ?>

    <main>
        <header class="page-header">
            <h2 class="container">
                <a href="/team" class="button button-white button-solid-white-hover pull-right">
                    All Team Members
                </a>
                <a href="/careers" class="button button-solid-blue pull-right">
                    Open Positions
                </a>
                Team Members
            </h2>
        </header>
        <div class="page-content container team-member">
            <div class="row">
                <div class="four columns">
                    <div class="team-member-photo">
                        <img src="<?php the_field('photo'); ?>" />
                    </div>
                </div>
                <div class="eight columns">
                    <h3 class="no-margin"><?php the_field('name'); ?></h3>
                    <h6 class="text-red "><?php the_field('role'); ?></h6>
                    <div class="content">
                        <?php the_field('bio'); ?>
                    </div>
                </div>
            </div>
        </div>
    </main>

<?php get_footer(); ?>