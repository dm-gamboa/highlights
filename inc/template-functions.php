<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Highlights
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function highlights_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'highlights_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function highlights_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'highlights_pingback_header' );

// ----------------------------------------
//  # UTILITIES
// ----------------------------------------
if( !function_exists( 'highlights_htmlify' ) ){
	function highlights_htmlify( $string ){
		// Format string so that it ...
		// ... is in all lowercase
		$string = strtolower( $string );
		// ... has no trailing white space
		$string = trim( $string );
		// ... does not contain multiple spaces
		$string = preg_replace( '/\s+/', ' ', $string );
		// ... all the spaces are turned into dashes
		$string = str_replace( ' ', '-', $string );
		// ... it contains no special characters (except for dashes)
		$string = preg_replace( '/[^a-z0-9-]/i', '', $string);

		return $string;
	}
}

if( !function_exists( 'get_terms_in_subcategory' ) ){
    function highlights_get_terms_in_subcategory( $taxonomy, $subcategory, $subcategoryField = 'slug' ){
        // Get all the terms attached to the post
        $postTerms = get_the_terms( $post->ID, $taxonomy );
        foreach( $postTerms as $term ){
            // Get an array of all the post term names
            $postTermNames[] = $term->name;
        }

        // Get the subcategory as a WP term object
        // So we can grab the ID and pass it as an arg later
        $subcategory = get_term_by( $subcategoryField, $subcategory, $taxonomy );

        // Get all the terms under the subcategory
        $subcategoryChildren = get_terms( array( 
            'taxonomy' => $taxonomy,
            'parent' => $subcategory->term_id ) );
        
        // If the subcategory has child terms
        if( $subcategoryChildren ){
            // Loop through all the terms under subcategory
            foreach( $subcategoryChildren as $child ){
                // Get the subcategory terms that are also attached to the post
                if( in_array( $child->name, $postTermNames ) ){
                    $termsInSubcategory[] = $child->name;
                }
            }
            return $termsInSubcategory;
        }
        return;
    }
}

// ----------------------------------------
//  # ACF
// ----------------------------------------
/**
 * Add options page
 */
if( function_exists( 'acf_add_options_page' ) ) {
	acf_add_options_page();
}

/**
 * Rename options page to Extra Settings
 */
if ( function_exists( 'acf_set_options_page_menu' ) ){
    acf_set_options_page_menu( 'Extra Settings' );
}