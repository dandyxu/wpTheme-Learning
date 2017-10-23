<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Dandyscores
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function dandyscores_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';

		$classes[] = 'archive-view';

	}

	// Add a class telling us if the sidebar is in use
	if ( is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'has-sidebar';
	}else {
		$classes[] = 'no-sidebar';
	}

	// Add a class telling us if the page sidebar is in use
	if ( is_active_sidebar( 'sidebar-2' )) {
		$classes[] = 'has-page-sidebar';
	}
	return $classes;
}
add_filter( 'body_class', 'dandyscores_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function dandyscores_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'dandyscores_pingback_header' );
