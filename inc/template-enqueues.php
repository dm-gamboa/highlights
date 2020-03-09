<?php

/**
 * Enqueue scripts and styles.
 */
function highlights_scripts() {
	wp_enqueue_style( 'highlights-style', get_stylesheet_uri() );

	wp_enqueue_script( 'highlights-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'highlights-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'highlights_scripts' );