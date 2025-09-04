<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package WP-FUNDI
 * @since 1.0.0
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function wp_fundi_body_classes( $classes ) {
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
add_filter( 'body_class', 'wp_fundi_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function wp_fundi_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'wp_fundi_pingback_header' );

/**
 * Customize the read more link.
 *
 * @param string $more The current more link.
 * @return string Modified more link.
 */
function wp_fundi_excerpt_more( $more ) {
	if ( ! is_admin() ) {
		global $post;
		return '... <a class="more-link" href="' . esc_url( get_permalink( $post->ID ) ) . '">' . esc_html__( 'Read More', 'wp-fundi' ) . '</a>';
	}
	return $more;
}
add_filter( 'excerpt_more', 'wp_fundi_excerpt_more' );

/**
 * Customize the excerpt length.
 *
 * @param int $length The current excerpt length.
 * @return int Modified excerpt length.
 */
function wp_fundi_excerpt_length( $length ) {
	if ( ! is_admin() ) {
		return 30;
	}
	return $length;
}
add_filter( 'excerpt_length', 'wp_fundi_excerpt_length' );

/**
 * Add custom CSS for the customizer.
 */
function wp_fundi_customizer_css() {
	?>
	<style type="text/css">
		.custom-logo {
			max-height: 100px;
			width: auto;
		}
	</style>
	<?php
}
add_action( 'wp_head', 'wp_fundi_customizer_css' );
