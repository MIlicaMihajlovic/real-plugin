<?php
/**
 * Template Name: Page Custom Template
 */

get_header(); ?>

    <div class="wrap">
        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">
				<?php
				while ( have_posts() ) :
					the_post(); ?>
                    <div class="row">
                        <?php the_field('test'); ?>
                    </div>
				<?php endwhile; // End of the loop.
				?>

            </main><!-- #main -->
        </div><!-- #primary -->
    </div><!-- .wrap -->

<?php
get_footer();