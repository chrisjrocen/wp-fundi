<?php
/**
 * The sidebar containing the main widget area
 *
 * @package WP-FUNDI
 * @since 1.0.0
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<aside id="secondary" class="widget-area">
	<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	<?php else : ?>
		<div class="widget-placeholder">
			<h2 class="widget-title"><?php esc_html_e( 'Sidebar', 'wp-fundi' ); ?></h2>
			<p><?php esc_html_e( 'Add widgets to this area in Appearance > Widgets > Sidebar', 'wp-fundi' ); ?></p>
		</div>
	<?php endif; ?>
</aside><!-- #secondary -->
