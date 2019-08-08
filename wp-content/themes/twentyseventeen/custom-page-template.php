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
                    <div class="row">
	                    <?php the_field('test1'); ?>
                    </div>
                    <div class="row"></br>
	                    <?php
	                    $acf_fields = get_fields();
                        $number = $acf_fields['test2']; ?>
                        <label>Selected number is:</label>
                        <input type="number" value="<?php echo $number; ?>">
                    </div>
                    <div class="row"></br>
						<?php $range = $acf_fields['test3']; ?>
                        <Label>Range: <?php echo $range ?></Label>
                        <input type="range" value="<?php echo $range; ?>">
                    </div>
                    <div class="row">
						<?php the_field('test4'); ?>
                    </div>
                    <div class="row"></br>
						<?php $url = $acf_fields['test5']; ?>
                        <a href="<?php echo $url; ?>">https://www.advancedcustomfields.com/resources/#field-types</a>
                    </div>
                    <div class="row">
                        <?php $password = $acf_fields['test6']; ?>
                        <input type="password" value="<?php echo $password; ?>"> </br>
                    </div>
                    <div class="row">
						<?php $image = $acf_fields['test7']['sizes']['thumbnail']; ?>
                        <img src="<?php echo $image; ?>">
                    </div>
                    <div class="row"> </br>
                        <?php $file = $acf_fields['test8']['url'] ?>
                        <a href="<?php echo $file; ?>">Download file</a>
                    </div>
                    <div class="row"> </br>
                        <!--Wysiwyg Editor-->
                        <?php the_field('test9'); ?>
                    </div>
                    <div class="row">
                        <!--oEmbed-->
<!--						--><?php //the_field('test10'); ?>
                    </div>
                    <div class="row">
                        <!--Gallery-->
                        <?php $images = $acf_fields['test11'];
                              $size = 'thumbnail';
                            if($images): ?>
                                <ul style="list-style-type:none">
                                    <?php foreach($images as $image): ?>
                                        <li><img src="<?php echo $image['sizes']['thumbnail'] ?>" alt=""></li>
                                    <?php endforeach; ?>
                                </ul>
                        <?php endif; ?>
                    </div>
                    <div class="row">
                        <p>Selected value: <?php echo $acf_fields['test12']; ?></p>
                    </div>
                    <div class="row">
                        <p>Checkbox value: <?php the_field('test13'); ?></p>
                    </div>
                    <div class="row">
                        <p>Radio button value: <?php the_field('test14'); ?></p>
                    </div>
                    <div class="row">
                        <p>Button group value: <?php the_field('test15'); ?></p>
                    </div>
                    <div class="row">
	                    <?php if( get_field('test16') ): ?>
                            <p>It is checked.</p>
	                    <?php endif; ?>
                    </div>
                    <div class="row">
	                    <?php
	                    $link = $acf_fields['test17'];

	                    if( $link ):
		                    $link_url = $link['url'];
		                    $link_title = $link['title'];
		                    $link_target = $link['target'] ? $link['target'] : '_self';
		                    ?>
                            <a class="button" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
	                    <?php endif; ?>
                    </div>
                    <div class="row">
	                    <?php
	                    $post_object = $acf_fields['test18'];

	                    if( $post_object ):
		                    $post = $post_object;
	                        //Expecting $post and override global post object
		                    setup_postdata( $post );
		                    ?>
                            <div>
                                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            </div>
		                    <?php wp_reset_postdata(); // Reset the $post object ?>
	                    <?php endif; ?>
                    </div>
                    <div class="row"></br>
                        <!--Page Link-->
                        <a href="<?php the_field('test19'); ?>">Read this!</a>
                    </div>
                    <div class="row"></br>
                        <!--Relationship-->
	                    <?php
	                    $posts = $acf_fields['test20'];
	                    if( $posts ): ?>
                            <ul>
			                    <?php foreach( $posts as $post): ?>
				                    <?php setup_postdata($post); ?>
                                    <li>
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </li>
			                    <?php endforeach; ?>
                            </ul>
		                    <?php wp_reset_postdata(); ?>
	                    <?php endif; ?>
                    </div>
                    <div class="row">
                        <!--Taxonomy-->
	                    <?php
	                    $term = $acf_fields['test21'];;
	                    if( $term ): ?>
                            <h2><?php echo $term->name; ?></h2>
	                    <?php endif; ?>
                    </div>
                    <div class="row">
                        <?php $user = $acf_fields['test22']; ?>
                        <h2><?php echo $user['display_name']; ?></h2>
                    </div>
                    <!--Google Map-->
					<?php
					$location = $acf_fields['test23'];
					if ( ! empty( $location ) ):
						?>
                        <div class="acf-map">
                            <div class="marker" data-lat="<?php echo $location['lat']; ?>"
                                 data-lng="<?php echo $location['lng']; ?>"></div>
                        </div>
					<?php endif; ?>

                    <div class="row">
                        <p>Event Date: <?php the_field('test24'); ?></p>
                    </div>
                    <div class="row">
                        <p>Event Date and Time: <?php the_field('test25'); ?></p>
                    </div>
                    <div class="row">
                        <p>Event Time: <?php the_field('test26'); ?></p>
                    </div>
                    <div style="background-color:<?php the_field('test27'); ?>">
                        Selected color
                    </div>
                    <div class="row"></br>
						<?php
						$group = $acf_fields['test31'];
						if ( $group ): ?>
                            <div>
                                <img src="<?php echo $group['image']['sizes']['thumbnail']; ?>"/>
                                <p><?php echo $group['textarea']; ?></p>
                            </div>
						<?php endif; ?>
                    </div>
                    <div class="row">
					<?php if ( have_rows( 'test32' ) ): ?>
                    <ul class="slides">
						<?php while ( have_rows( 'test32' ) ): the_row();
							// vars
							$image   = get_sub_field( 'image' );
							$content = get_sub_field( 'textarea' );
							?>
                            <li class="slide">
                                <img src="<?php echo $image['sizes']['thumbnail']; ?>"/>
                                <?php echo $content; ?>
                            </li>
						<?php endwhile; ?>
                    </ul>
                    </div>
                    <div class="row">
						<?php
						// check if the flexible content field has rows of data
						if ( have_rows( 'test33' ) ):

							// loop through the rows of data
							while ( have_rows( 'test33' ) ) : the_row();
								if ( get_row_layout() == 'text' ):
                                    the_sub_field( 'text' );
									$image = get_sub_field( 'image' ); ?>
                                    <img src="<?php echo $image['sizes']['thumbnail']; ?>"/></br>
								<?php
                                elseif ( get_row_layout() == 'image' ):
									$gallery = get_sub_field( 'gallery' );
									the_sub_field( 'textarea' );
									$size = 'thumbnail';
									if ( $gallery ): ?>
                                        <ul style="list-style-type:none">
											<?php foreach ( $gallery as $image ): ?>
                                                <li><img src="<?php echo $image['sizes']['thumbnail'] ?>" alt=""></li>
											<?php endforeach; ?>
                                        </ul>
									<?php endif;
								endif;
							endwhile;
						else :
							// no layouts found
						endif; ?>
                    </div>
                    <div class="row">
                        <?php $clone = $acf_fields['test34'];
                             $range = $clone['test3'];
                             $color = $clone['test27'];
                        ?>
                        <p><?php echo $range; ?></p>
                        <div style="background-color:<?php echo $color; ?>">
                            Selected color
                        </div>
                    </div>

				<?php endif; ?>
				<?php endwhile; // End of the loop.
				?>

            </main><!-- #main -->
        </div><!-- #primary -->
    </div><!-- .wrap -->

<?php
get_footer();
?>


<style>
    .acf-map {
        width: 100%;
        height: 400px;
        border: #ccc solid 1px;
        margin: 20px 0;
    }

    /* fixes potential theme css conflict */
    .acf-map img {
        max-width: inherit !important;
    }
</style>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAuRmPJXwqsBDeoK9d_prSysffhYZir5lQ"></script>
<script type="text/javascript">
    (function($) {

        /*
		*  new_map
		*
		*  This function will render a Google Map onto the selected jQuery element
		*
		*  @type	function
		*  @date	8/11/2013
		*  @since	4.3.0
		*
		*  @param	$el (jQuery element)
		*  @return	n/a
		*/

        function new_map( $el ) {

            // var
            var $markers = $el.find('.marker');


            // vars
            var args = {
                zoom		: 16,
                center		: new google.maps.LatLng(0, 0),
                mapTypeId	: google.maps.MapTypeId.ROADMAP
            };


            // create map
            var map = new google.maps.Map( $el[0], args);


            // add a markers reference
            map.markers = [];


            // add markers
            $markers.each(function(){

                add_marker( $(this), map );

            });


            // center map
            center_map( map );


            // return
            return map;

        }

        /*
		*  add_marker
		*
		*  This function will add a marker to the selected Google Map
		*
		*  @type	function
		*  @date	8/11/2013
		*  @since	4.3.0
		*
		*  @param	$marker (jQuery element)
		*  @param	map (Google Map object)
		*  @return	n/a
		*/

        function add_marker( $marker, map ) {

            // var
            var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );

            // create marker
            var marker = new google.maps.Marker({
                position	: latlng,
                map			: map
            });

            // add to array
            map.markers.push( marker );

            // if marker contains HTML, add it to an infoWindow
            if( $marker.html() )
            {
                // create info window
                var infowindow = new google.maps.InfoWindow({
                    content		: $marker.html()
                });

                // show info window when marker is clicked
                google.maps.event.addListener(marker, 'click', function() {

                    infowindow.open( map, marker );

                });
            }

        }

        /*
		*  center_map
		*
		*  This function will center the map, showing all markers attached to this map
		*
		*  @type	function
		*  @date	8/11/2013
		*  @since	4.3.0
		*
		*  @param	map (Google Map object)
		*  @return	n/a
		*/

        function center_map( map ) {

            // vars
            var bounds = new google.maps.LatLngBounds();

            // loop through all markers and create bounds
            $.each( map.markers, function( i, marker ){

                var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );

                bounds.extend( latlng );

            });

            // only 1 marker?
            if( map.markers.length == 1 )
            {
                // set center of map
                map.setCenter( bounds.getCenter() );
                map.setZoom( 16 );
            }
            else
            {
                // fit to bounds
                map.fitBounds( bounds );
            }

        }

        /*
		*  document ready
		*
		*  This function will render each map when the document is ready (page has loaded)
		*
		*  @type	function
		*  @date	8/11/2013
		*  @since	5.0.0
		*
		*  @param	n/a
		*  @return	n/a
		*/
// global var
        var map = null;

        $(document).ready(function(){

            $('.acf-map').each(function(){

                // create map
                map = new_map( $(this) );

            });

        });

    })(jQuery);
</script>
