<?php

//Add js script for load more
function news_load_more() {

	global $wp_query;

	wp_enqueue_script( 'news',get_stylesheet_directory_uri() . '/assets/js/news.js', array( 'jquery' ) );

	wp_localize_script( 'news', 'news_loadmore_params', array(
		'ajaxurl'      => admin_url( 'admin-ajax.php' ),
	) );

}

add_action( 'wp_enqueue_scripts', 'news_load_more' );

//Ajax handler function for load more
function loadmore_news( $current_posts = -1, $page = -1, $posts_per_page = -1 ) {

	//returns boolean when the page is loaded via ajax
	if ( is_ajax() ) {
		//
		$current_posts = intval( $_REQUEST['current_posts'] ?? -1 );
		$page = intval( $_REQUEST['page'] ?? -1 );
		$posts_per_page = intval( $_REQUEST['posts_per_page'] ?? -1 );
	}

	if ( $current_posts === -1 || $page === -1 || $posts_per_page === -1 ) {
		is_ajax() && wp_send_json_error();

		return false;
	}

	// arguments for the query
	$query = new WP_Query( [
		'post_type' => 'post',
		'offset' => $current_posts,
		'posts_per_page' => $posts_per_page
	] );

	ob_start();

	while( $query->have_posts() ) {
		$query->the_post();

		get_template_part( 'template-parts/content-post' );
	}

	$html = ob_get_clean();

	$has_more = ( $current_posts + $query->post_count ) < $query->found_posts;

	is_ajax() && wp_send_json_success( [
		'has_more' => $has_more,
		'html' => $html
	] );

	return [
		'has_more' => $has_more,
		'html' => $html
	];
}

add_action( 'wp_ajax_loadmore_news_ajax', 'loadmore_news' );
add_action( 'wp_ajax_nopriv_loadmore_news_ajax', 'loadmore_news' );
