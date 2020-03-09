<?php
if ( ! function_exists('highlights_custom_post_types') ) {

    // # Custom Post Types
    function highlights_custom_post_types() {
        
        // ## Web Projects
        $labels = array(
            'name'                  => 'Web Projects',
            'singular_name'         => 'Web Project',
            'menu_name'             => 'Web Projects',
            'name_admin_bar'        => 'Web Project',
            'archives'              => 'Web Project Archives',
            'attributes'            => 'Web Project Attributes',
            'parent_item_colon'     => 'Web Project',
            'all_items'             => 'All Web Projects',
            'add_new_item'          => 'Add New Web Project',
            'add_new'               => 'Add New',
            'new_item'              => 'New Web Project',
            'edit_item'             => 'Edit Web Project',
            'update_item'           => 'Update Web Project',
            'view_item'             => 'View Web Project',
            'view_items'            => 'View Web Projects',
            'search_items'          => 'Search Web Project',
            'not_found'             => 'Not found',
            'not_found_in_trash'    => 'Not found in Trash',
            'featured_image'        => 'Featured Image',
            'set_featured_image'    => 'Set featured image',
            'remove_featured_image' => 'Remove featured image',
            'use_featured_image'    => 'Use as featured image',
            'insert_into_item'      => 'Insert into Web Project',
            'uploaded_to_this_item' => 'Uploaded to this Web Project',
            'items_list'            => 'Web Projects list',
            'items_list_navigation' => 'Web Projects list navigation',
            'filter_items_list'     => 'Filter Web Projects list',
        );
        $args = array(
            'label'                 => 'Web Project',
            'description'           => 'CPT for Web Projects.',
            'labels'                => $labels,
            'supports'              => array( 'title', 'thumbnail' ),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_icon'             => 'dashicons-portfolio',
            'menu_position'         => 5,
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'page',
        );
        register_post_type( 'projects-web', $args );
    
    }

    add_action( 'init', 'highlights_custom_post_types', 0 );
}

if ( !function_exists( 'highlights_rewrite_flush' ) ){
    function highlights_rewrite_flush() {
        highlights_custom_post_types();
        flush_rewrite_rules();
    }
    add_action( 'after_switch_theme', 'highlights_rewrite_flush' );
}

