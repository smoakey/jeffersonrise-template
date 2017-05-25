<!doctype html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(); ?>>
        <main class="no-padding">
            <div class="page-content container">
                <div class="row">
                    <div class="six columns">
                        <div class="title">Oops!</div>
                        <div class="description">We can't seem to find the page you were looking for.</div>
                        <div class="error-code">Error Code: 404</div>
                        <p>Here are some helpful links:</p>
                        <p><a href="/">Home</a></p>
                        <p><a href="/about-us">About Us</a></p>
                        <p><a href="/enrollment">Enrollment</a></p>
                        <p><a href="/careers">Careers</a></p>
                        <p><a href="/get-involved">Get Involved</a></p>
                        <p><a href="/enrollment/student-application/">Apply Now</a></p>
                    </div>
                </div>
            </div>
        </main>
        <?php wp_footer(); ?>
    </body>
</html>