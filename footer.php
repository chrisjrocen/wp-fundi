<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @package WP-FUNDI
 * @since 1.0.0
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="container">
			<?php if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) ) : ?>
				<div class="footer-widgets">
					<div class="footer-widgets-grid">
						<div class="footer-widget-area footer-widget-area-1">
							<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
								<?php dynamic_sidebar( 'footer-1' ); ?>
							<?php else : ?>
								<div class="widget-placeholder">
									<h3 class="widget-title"><?php esc_html_e( 'Footer One', 'wp-fundi' ); ?></h3>
									<p><?php esc_html_e( 'Add widgets to this area in Appearance > Widgets > Footer One', 'wp-fundi' ); ?></p>
								</div>
							<?php endif; ?>
						</div>

						<div class="footer-widget-area footer-widget-area-2">
							<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
								<?php dynamic_sidebar( 'footer-2' ); ?>
							<?php else : ?>
								<div class="widget-placeholder">
									<h3 class="widget-title"><?php esc_html_e( 'Footer Two', 'wp-fundi' ); ?></h3>
									<p><?php esc_html_e( 'Add widgets to this area in Appearance > Widgets > Footer Two', 'wp-fundi' ); ?></p>
								</div>
							<?php endif; ?>
						</div>
					</div><!-- .footer-widgets-grid -->
				</div><!-- .footer-widgets -->
			<?php endif; ?>

			<div class="site-info">
				<?php
				$footer_text = sprintf(
					/* translators: 1: Current year, 2: Site name */
					esc_html__( '&copy; %1$s %2$s. All rights reserved.', 'wp-fundi' ),
					gmdate( 'Y' ),
					get_bloginfo( 'name' )
				);
				echo $footer_text; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				?>

				<?php
				// Display footer menu if it exists.
				if ( has_nav_menu( 'footer' ) ) :
					?>
					<nav class="footer-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Footer Menu', 'wp-fundi' ); ?>">
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'footer',
								'menu_class'     => 'footer-menu',
								'container'      => false,
								'depth'          => 1,
							)
						);
						?>
					</nav><!-- .footer-navigation -->
					<?php
				endif;
				?>

				<?php
				// Display theme credit.
				$theme_credit = sprintf(
					/* translators: 1: Theme name, 2: Theme author */
					esc_html__( 'Theme: %1$s by %2$s', 'wp-fundi' ),
					'WP-FUNDI',
					'WP-FUNDI Team'
				);
				?>
				<p class="theme-credit">
					<?php echo $theme_credit; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</p>
			</div><!-- .site-info -->
		</div><!-- .container -->
	</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
