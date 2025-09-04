<?php
/**
 * Fundi Hero Block
 *
 * @package WP-FUNDI
 * @since 1.0.0
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register the Fundi Hero block.
 */
function wp_fundi_register_fundi_hero_block() {
	register_block_type( __DIR__ );
}
add_action( 'init', 'wp_fundi_register_fundi_hero_block' );
