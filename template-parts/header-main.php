<?php
/**
 * Template part for displaying the main header content
 *
 * @package WP-FUNDI
 * @since 1.0.0
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="site-branding">
	<?php
	if ( has_custom_logo() ) {
		the_custom_logo();
	} else {
		?>
		<div class="site-identity">
			<?php
			if ( is_front_page() && is_home() ) :
				?>
				<h1 class="site-title">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<?php bloginfo( 'name' ); ?>
					</a>
				</h1>
				<?php
			else :
				?>
				<p class="site-title">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<?php bloginfo( 'name' ); ?>
					</a>
				</p>
				<?php
			endif;

			$wp_fundi_description = get_bloginfo( 'description', 'display' );
			if ( $wp_fundi_description || is_customize_preview() ) :
				?>
				<p class="site-description"><?php echo $wp_fundi_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
				<?php
			endif;
			?>
		</div>
		<?php
	}
	?>

	<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'wp-fundi' ); ?>">
		<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
			<span class="screen-reader-text"><?php esc_html_e( 'Primary Menu', 'wp-fundi' ); ?></span>
			<span class="menu-icon">
				<span></span>
				<span></span>
				<span></span>
			</span>
		</button>
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'primary',
				'menu_id'        => 'primary-menu',
				'container'      => false,
				'fallback_cb'    => 'wp_fundi_default_menu',
			)
		);
		?>
	</nav><!-- #site-navigation -->
</div><!-- .site-branding -->
