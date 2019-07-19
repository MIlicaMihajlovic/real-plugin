<?php
/**
 *
 * Plugin Name: Real Estate

 */

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
        'supports'           => array( 'title', 'image', 'author', 'thumbnail', 'revisions', 'custom-fields' )
    );

    register_post_type( 'real_estate', $args );
}

 add_action('init', 'create_real_cpt');