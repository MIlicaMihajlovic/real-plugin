<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

//Save post
acf_form_head();

get_header(); ?>

    <div class="wrap">
        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">

				<?php
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

					get_template_part( 'template-parts/post/content', get_post_format() );
					?>

                    <!--Display data-->
                    <div class="title-post">
						<?php
						//display fields subtitle and image
						$acf_fields = get_fields();

						$subtitle = $acf_fields['subtitle'];

						$gallery = $acf_fields['gallery']['sizes']['thumbnail'];

						echo '<h3>' . $subtitle . '</h3>';
						echo '<img src="' . $gallery . '">';

						//display taxonomy-location and link to that taxonomy
						$location_term = get_term( $acf_fields['location'], 'location' );

						if ( $location_term instanceof WP_Term ) : ?>
                            <div class="js-location-terms-wrapper">
                                <a class="<?php echo $location_term->slug ?>"
                                   href="<?php echo get_term_link( $location_term ) ?>"><?php echo $location_term->name ?></a>
                            </div>
						<?php endif;

						//display taxonomy-type and link to that taxonomy
						$type_term = get_term( $acf_fields['type'], 'type' );
						if ( $type_term instanceof WP_Term ) : ?>
                            <div class="js-type-terms-wrapper">
                                <a class="<?php echo $type_term->slug ?>"
                                   href="<?php echo get_term_link( $type_term ) ?>"><?php echo $type_term->name ?></a>
                            </div>
						<?php endif; ?>
                    </div>

<!--                    --><?php //if ( get_current_user_id() == $post->post_author || current_user_can('update_core') ) : ?>

                        <!--Form for editing post-->
                        <div>
                            <h3>Edit your post</h3>
                            <!---->
                            <form class="cf" id="cf" data-post-id="<?php the_ID(); ?>">
                                <div>
                                    <label>Title</label>
                                    <input type="text" id="post_title" name="post_title" value="<?php the_title() ?>"/>
                                </div>
                                <div>
                                    <label>Subtitle</label>
                                    <input type="text" id="subtitle" name="subtitle"
                                           value="<?php the_field( 'subtitle' ); ?>"/>
                                </div>
                                <div class="taxonomy-location">
                                    <!--get_terms-->
                                    <label>Select location</label>
                                    <?php $loc_terms = get_terms( array(
                                        'taxonomy'   => 'location',
                                        'hide_empty' => false,
                                        'fields'     => 'all'
                                    ) ); ?>
                                    <select id="taxonomy-location">
                                        <?php foreach ( $loc_terms as $loc_term ) { ?>
                                            <option value="<?php echo $loc_term->term_id ?>" <?php echo $loc_term->term_id === $location_term->term_id ? 'selected' : '' ?>> <?php echo $loc_term->name; ?> </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="taxonomy-type">
                                    <label>Select type of Real Estate</label>
                                    <?php $typ_terms = get_terms( array(
                                        'taxonomy'   => 'type',
                                        'hide_empty' => false,
                                        'fields'     => 'all'
                                    ) ); ?>
                                    <select id="taxonomy-type">
                                        <?php foreach ( $typ_terms as $typ_term ) { ?>
                                            <option value="<?php echo $typ_term->term_id ?>" <?php echo $typ_term->term_id === $type_term->term_id ? 'selected' : '' ?>> <?php echo $typ_term->name; ?> </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div id="_wpnonce">
                                    <input type="hidden" name="sumbmitted" value="<?php echo get_current_user_id(); ?>">
                                    <!--call the function and create nonce-->
                                    <!--referer is on false because we are using ajax-->
                                    <?php wp_nonce_field( 'update-post_'. get_the_ID(), 'wpnonce', false ); ?>
                                    <button type="submit">Update</button>
                                </div>
                            </form>
                        </div>

<!--                    --><?php //endif; ?>

					<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

					the_post_navigation(
						array(
							'prev_text' => '<span class="screen-reader-text">' . __( 'Previous Post', 'twentyseventeen' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Previous', 'twentyseventeen' ) . '</span> <span class="nav-title"><span class="nav-title-icon-wrapper">' . twentyseventeen_get_svg( array( 'icon' => 'arrow-left' ) ) . '</span>%title</span>',
							'next_text' => '<span class="screen-reader-text">' . __( 'Next Post', 'twentyseventeen' ) . '</span><span aria-hidden="true" class="nav-subtitle">' . __( 'Next', 'twentyseventeen' ) . '</span> <span class="nav-title">%title<span class="nav-title-icon-wrapper">' . twentyseventeen_get_svg( array( 'icon' => 'arrow-right' ) ) . '</span></span>',
						)
					);

				endwhile; // End of the loop.
				?>

            </main><!-- #main -->
        </div><!-- #primary -->
		<?php get_sidebar(); ?>
    </div><!-- .wrap -->

<?php
get_footer();