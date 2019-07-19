<?php
/**
 *
 * Plugin Name: Real Estate

 */

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
        'supports'           => array( 'title', 'image', 'author', 'thumbnail', 'revisions', 'custom-fields' )
    );

    register_post_type( 'real_estate', $args );
}

 add_action('init', 'create_real_cpt');

//Register custom taxonomies Location and Type non-hierarchical
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
        'query_var'             => true
    );

    register_taxonomy('location', 'real_estate', $args);

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
        'query_var'             => true
    );

    register_taxonomy('type', 'real_estate', $args);
}

add_action('init', 'create_real_taxonomies');

//Add field for taxonomies
if( function_exists('acf_add_local_field_group') ):

//Add custom fields through PHP
    acf_add_local_field_group(array(
        'key' => 'group_5d317fad8c61f',
        'title' => 'CPT:Real Estate',
        'fields' => array(
            array(
                'key' => 'field_5d317fc771368',
                'label' => 'Subtitle',
                'name' => 'subtitle',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ),
            array(
                'key' => 'field_5d31801871369',
                'label' => 'Gallery',
                'name' => 'gallery',
                'type' => 'image',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'return_format' => 'array',
                'preview_size' => 'medium',
                'library' => 'all',
                'min_width' => '',
                'min_height' => '',
                'min_size' => '',
                'max_width' => '',
                'max_height' => '',
                'max_size' => '',
                'mime_types' => '',
            ),
            array(
                'key' => 'field_5d3180487136a',
                'label' => 'Location',
                'name' => 'location',
                'type' => 'taxonomy',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'taxonomy' => 'location',
                'field_type' => 'select',
                'allow_null' => 0,
                'add_term' => 1,
                'save_terms' => 1,
                'load_terms' => 0,
                'return_format' => 'id',
                'multiple' => 0,
            ),
            array(
                'key' => 'field_5d3180e67136b',
                'label' => 'Type',
                'name' => 'type',
                'type' => 'taxonomy',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'taxonomy' => 'type',
                'field_type' => 'select',
                'allow_null' => 0,
                'add_term' => 1,
                'save_terms' => 1,
                'load_terms' => 0,
                'return_format' => 'id',
                'multiple' => 0,
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'real_estate',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
    ));

endif;
