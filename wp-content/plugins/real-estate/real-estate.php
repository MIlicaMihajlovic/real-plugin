<?php
/**
 *
 * Plugin Name: Real Estate
 */


//Without ACF you can't processed
//if ( ! function_exists( 'get_field' ) ) {
//
//
//    return;
//}

//error_reporting(E_ALL);
//ini_set("display_errors", 1);

//Register CPT Real Estate
function create_real_cpt() {
	$labels = array(
		'name'               => _x( 'Real Estate', 'post type general name', 'textdomain' ),
		'singular_name'      => _x( 'Real State', 'post type singular name', 'textdomain' ),
		'menu_name'          => _x( 'Real Estate', 'admin menu', 'textdomain' ),
		'name_admin_bar'     => _x( 'Real Estate', 'add new on admin bar', 'textdomain' ),
		'add_new'            => _x( 'Add New', 'real_estate', 'textdomain' ),
		'add_new_item'       => __( 'Add New Real Estate', 'textdomain' ),
		'new_item'           => __( 'New Real Estate', 'textdomain' ),
		'edit_item'          => __( 'Edit Real Estate', 'textdomain' ),
		'view_item'          => __( 'View Real Estate', 'textdomain' ),
		'all_items'          => __( 'All Real Estate', 'textdomain' ),
		'search_items'       => __( 'Search Real Estate', 'textdomain' ),
		'parent_item_colon'  => __( 'Parent Real Estate:', 'textdomain' ),
		'not_found'          => __( 'No real estate found.', 'textdomain' ),
		'not_found_in_trash' => __( 'No real estate found in Trash.', 'textdomain' )
	);

	$args = array(
		'label'              => __( 'real_estate' ),
		'labels'             => $labels,
		'description'        => __( 'Description.', 'textdomain' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'image', 'author', 'thumbnail', 'revisions', 'custom-fields' ),
		'taxonomies'         => array( 'location', 'type' ),
		'rewrite'            => true
	);

	register_post_type( 'real_estate', $args );
}

add_action( 'init', 'create_real_cpt' );

//Register custom taxonomies Location and Type, non-hierarchical
function create_real_taxonomies() {

	//Register taxonomy Location
	$labels = array(
		'name'                       => _x( 'Locations', 'taxonomy general name', 'textdomain' ),
		'singular_name'              => _x( 'Location', 'taxonomy singular name', 'textdomain' ),
		'search_items'               => __( 'Search Locations', 'textdomain' ),
		'popular_items'              => __( 'Popular Locations', 'textdomain' ),
		'all_items'                  => __( 'All Locations', 'textdomain' ),
		'parent_item'                => __( 'Parent Type' ),
		'parent_item_colon'          => __( 'Parent Type:' ),
		'edit_item'                  => __( 'Edit Location', 'textdomain' ),
		'update_item'                => __( 'Update Location', 'textdomain' ),
		'add_new_item'               => __( 'Add New Location', 'textdomain' ),
		'new_item_name'              => __( 'New Location Name', 'textdomain' ),
		'separate_items_with_commas' => __( 'Separate locations with commas', 'textdomain' ),
		'add_or_remove_items'        => __( 'Add or remove locations', 'textdomain' ),
		'not_found'                  => __( 'No locations found.', 'textdomain' ),
		'menu_name'                  => __( 'Locations', 'textdomain' ),
	);

	$args = array(
		'hierarchical'          => false,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'location', 'with_front' => false )
	);

	register_taxonomy( 'location', 'real_estate', $args );

	//Register taxonomy Type
	$labels = array(
		'name'                       => _x( 'Types', 'taxonomy general name', 'textdomain' ),
		'singular_name'              => _x( 'Type', 'taxonomy singular name', 'textdomain' ),
		'search_items'               => __( 'Search Types', 'textdomain' ),
		'popular_items'              => __( 'Popular Types', 'textdomain' ),
		'all_items'                  => __( 'All Types', 'textdomain' ),
		'parent_item'                => __( 'Parent Type' ),
		'parent_item_colon'          => __( 'Parent Type:' ),
		'edit_item'                  => __( 'Edit Type', 'textdomain' ),
		'update_item'                => __( 'Update Type', 'textdomain' ),
		'add_new_item'               => __( 'Add New Type', 'textdomain' ),
		'new_item_name'              => __( 'New Type Name', 'textdomain' ),
		'separate_items_with_commas' => __( 'Separate types with commas', 'textdomain' ),
		'add_or_remove_items'        => __( 'Add or remove types', 'textdomain' ),
		'not_found'                  => __( 'No types found.', 'textdomain' ),
		'menu_name'                  => __( 'Types', 'textdomain' ),
	);

	$args = array(
		'hierarchical'          => false,
		'labels'                => $labels,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'estates')
	);

	register_taxonomy( 'type', array( 'real_estate' ), $args );
}

add_action( 'init', 'create_real_taxonomies' );

//Rewrite rules for cpt/taxonomy/%cpt%
function estates_rewrite_rule( $wp_rewrite ) {

	$rules = array();
	$terms = get_terms( array(
		'taxonomy'   => 'type',
		'hide_empty' => false
	) );

	$post_type = 'real_estate';

	foreach ( $terms as $term ) {
		$rules[ 'estates/' . $term->slug . '/([a-zA-Z0-9-]+)/?$' ] = 'index.php?post_type=' . $post_type . '&name=$matches[1]';
	}

	//Add rules to class wp_rewrite
	$wp_rewrite->rules = $rules + $wp_rewrite->rules;
}

//Hook on filter to rewrite rules
add_filter( 'generate_rewrite_rules', 'estates_rewrite_rule' );

//Save new post with correct link
function change_link( $permalink, $post ) {

	if ( $post->post_type == 'real_estate' ) {

		$estates_terms = get_the_terms( $post->ID, 'type' );
		$term_slug     = '';

		if ( ! empty( $estates_terms ) ) {

			foreach ( $estates_terms as $term ) {

				if ( $term->slug == 'featured' ) {
					continue;
				}
				$term_slug = $term->slug;
				break;
			}
		}
		$permalink = get_home_url() . '/estates/' . $term_slug . '/' . $post->post_name;
	}

	return $permalink;
}

add_filter( 'post_type_link', 'change_link', 10, 2 );


//Add field for taxonomies
if ( function_exists( 'acf_add_local_field_group' ) ):

//Add custom fields through PHP and set taxonomies to single term and required
	acf_add_local_field_group( array(
		'key'                   => 'group_5d317fad8c61f',
		'title'                 => 'CPT:Real Estate',
		'fields'                => array(
			array(
				'key'               => 'field_5d317fc771368',
				'label'             => 'Subtitle',
				'name'              => 'subtitle',
				'type'              => 'text',
				'instructions'      => '',
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => array(
					'width' => '',
					'class' => '',
					'id'    => '',
				),
				'default_value'     => '',
				'placeholder'       => '',
				'prepend'           => '',
				'append'            => '',
				'maxlength'         => '',
			),
			array(
				'key'               => 'field_5d31801871369',
				'label'             => 'Gallery',
				'name'              => 'gallery',
				'type'              => 'image',
				'instructions'      => '',
				'required'          => 0,
				'conditional_logic' => 0,
				'wrapper'           => array(
					'width' => '',
					'class' => '',
					'id'    => '',
				),
				'return_format'     => 'array',
				'preview_size'      => 'medium',
				'library'           => 'all',
				'min_width'         => '',
				'min_height'        => '',
				'min_size'          => '',
				'max_width'         => '',
				'max_height'        => '',
				'max_size'          => '',
				'mime_types'        => '',
			),
			array(
				'key'               => 'field_5d3180487136a',
				'label'             => 'Location',
				'name'              => 'location',
				'type'              => 'taxonomy',
				'instructions'      => '',
				'required'          => 1,
				'conditional_logic' => 0,
				'wrapper'           => array(
					'width' => '',
					'class' => '',
					'id'    => '',
				),
				'taxonomy'          => 'location',
				'field_type'        => 'select',
				'allow_null'        => 0,
				'add_term'          => 1,
				'save_terms'        => 1,
				'load_terms'        => 0,
				'return_format'     => 'id',
				'multiple'          => 0,
			),
			array(
				'key'               => 'field_5d3180e67136b',
				'label'             => 'Type',
				'name'              => 'type',
				'type'              => 'taxonomy',
				'instructions'      => '',
				'required'          => 1,
				'conditional_logic' => 0,
				'wrapper'           => array(
					'width' => '',
					'class' => '',
					'id'    => '',
				),
				'taxonomy'          => 'type',
				'field_type'        => 'select',
				'allow_null'        => 0,
				'add_term'          => 1,
				'save_terms'        => 1,
				'load_terms'        => 0,
				'return_format'     => 'id',
				'multiple'          => 0,
			),
		),
		'location'              => array(
			array(
				array(
					'param'    => 'post_type',
					'operator' => '==',
					'value'    => 'real_estate',
				),
			),
		),
		'menu_order'            => 0,
		'position'              => 'normal',
		'style'                 => 'default',
		'label_placement'       => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen'        => '',
		'active'                => true,
		'description'           => '',
	) );

endif;

//Locate the template
function real_locate_template( $template_name, $default_path = '' ) {

	//Set default path
	if ( ! $default_path ) :
		$default_path = plugin_dir_path( __FILE__ ) . 'templates/';
	endif;
	// Search template file in folder.
	$template = locate_template( array(
		$template_name
	) );
	// Get plugins template file.
	if ( ! $template ) :
		$template = $default_path . $template_name;
	endif;

	return apply_filters( 'real_locate_template', $template, $template_name, $default_path );
}

//Template loader
function real_template_loader( $template ) {

	global $post;

	//If it's not real estate post type give back template
	if ( $post->post_type !== 'real_estate' ) {
		return $template;
	}

	$file = '';
	if ( is_singular() ):
		$file = 'content-real_estate.php';
	elseif ( is_tax() ):
		$file = 'archive-real_estate.php';
	elseif ( is_search() ):
		$file = 'search-real_estate.php';
	elseif ( get_page_template_slug() === 'custom-page-template.php' ):
		$file = 'page-custom-template.php';
	endif;

	if ( file_exists( real_locate_template( $file ) ) ) :
		$template = real_locate_template( $file );
	endif;

	return $template;
}

add_filter( 'template_include', 'real_template_loader' );

//Locate script
function real_estate_enqueue_scripts( $hook ) {

	// define script url to js
	$script_url = plugins_url( '/assets/js/real-estate.js', __FILE__ );

	// enqueue script
	wp_enqueue_script( 'real-estate', $script_url, array( 'jquery' ), false, true );

	//define script
	$script = array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) );

	//localize script
	wp_localize_script( 'real-estate', 'real_estate', $script );

}

add_action( 'wp_enqueue_scripts', 'real_estate_enqueue_scripts' );


//Handler function for ajax
function prefix_cf() {

		//Check if request validate
		$post_id = isset( $_REQUEST['post_id'] ) ? intval( $_REQUEST['post_id'] ) : false;

		// check nonce
		check_ajax_referer( 'update-post_' . $post_id );

		//current_user_can update post
		$userId = isset($_REQUEST['userId']) ? intval($_REQUEST['userId']) : false;

		//if it's not author and it's not administrator return
		//use user_can because of ajax
	    $post = get_post( $post_id );
		$author_id = $post->post_author;

		if( $userId != $author_id && ! user_can( $userId, 'update_core')) {
			wp_send_json_error( null, 400 );
		}

		$post_title = isset( $_REQUEST['post_title'] ) ? sanitize_text_field( $_REQUEST['post_title'] ) : false;

		$subtitle = isset( $_REQUEST['subtitle'] ) ? sanitize_text_field( $_REQUEST['subtitle'] ) : false;

		//Get request
		$location_id = isset( $_REQUEST['location'] ) ? intval( $_REQUEST['location'] ) : false;
		$type_id     = isset( $_REQUEST['type'] ) ? intval( $_REQUEST['type'] ) : false;

		//Get term id
		$location = get_term( $location_id, 'location' );
		$type     = get_term( $type_id, 'type' );

		//If is not true give back error, always pass arguments, check if taxonomy not instance
		if ( ! $post_id || ! $post_title || ! $location instanceof WP_Term || ! $type instanceof WP_Term ) {
			wp_send_json_error( null, 400 );
		}

		//Updating post
		$result = wp_update_post( [
			'ID'         => $post_id,
			'post_title' => $post_title,
			//Update meta field, acf
			'meta_input' => [
				'subtitle' => $subtitle,
				'location' => $location->term_id,
				'type'     => $type->term_id
			],
			//Update custom taxonomy term
			'tax_input'  => [
				'location' => [ $location->term_id ],
				'type'     => [ $type->term_id ]
			]
		] );


		//If result true send success, else error
		if ( $result ) {
			//using wp_send_json_success you don't need exit and parse response
			wp_send_json_success( [
				'post_title'    => $post_title,
				'subtitle'      => $subtitle,
				//Update link to taxonomy
				'location_link' => '<a class="' . $location->slug . '" href="' . get_term_link( $location->slug, 'location' ) . '">' . $location->name . '</a>',
				'type_link'     => '<a class="' . $type->slug . '" href="' . get_term_link( $type->slug, 'type' ) . '">' . $type->name . '</a>'
			] );
		} else {
			wp_send_json_error( null, 400 );
		}

}

//hook for un logged user
add_action( 'wp_ajax_nopriv_prefix_cf', 'prefix_cf' );
//hook for logged in user
add_action( 'wp_ajax_prefix_cf', 'prefix_cf' );


//Advanced search

/**
 * @param $query
 * @param WP_Query $wp_query
 *
 * @return mixed
 */
function customSearchClause($query, $wp_query)
{
	//if it's not query return, always has to return something
	if ( ! $wp_query->is_search() ) {
		return $query;
	}

	//talking to database
	global $wpdb;

	//search term
	$s = $wp_query->get('s');

	//join postmeta
	$query['join'] = " INNER JOIN {$wpdb->postmeta} ON ({$wpdb->posts}.ID = {$wpdb->postmeta}.post_id) ";

	//join terms for taxonomy search, concat with statement above
	$query['join'] .= " INNER JOIN {$wpdb->term_relationships} 
						ON {$wpdb->posts}.ID = {$wpdb->term_relationships}.object_id
						INNER JOIN {$wpdb->term_taxonomy}
						ON {$wpdb->term_relationships}.term_taxonomy_id = {$wpdb->term_taxonomy}.term_taxonomy_id
						INNER JOIN {$wpdb->terms}
						ON {$wpdb->term_taxonomy}.term_id = {$wpdb->terms}.term_id ";

	//where search term
	$query['where'] = $wpdb->prepare( " AND ({$wpdb->posts}.post_type = %s 
						AND	({$wpdb->posts}.post_title LIKE %s
							OR ({$wpdb->postmeta}.meta_key = 'subtitle' AND {$wpdb->postmeta}.meta_value LIKE %s)
							OR {$wpdb->terms}.name LIKE %s)) ",
		[
			"real_estate",
			"%$s%",
			"%$s%",
			"%$s%"
		]);

	//order by
	$query['orderby'] = " {$wpdb->posts}.post_date DESC ";

	//remove duplicates, group by post ID
	$query['groupby'] = "{$wpdb->posts}.ID";


	return $query;
}

add_filter('posts_clauses_request', 'customSearchClause', 10, 2);
