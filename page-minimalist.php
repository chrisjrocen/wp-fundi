<?php
/**
 * Template Name: Minimalist
 *
 * A clean, minimal page template with focused content layout.
 *
 * @package WP-FUNDI
 * @since 1.0.0
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header(); ?>

<main id="primary" class="site-main minimalist-template">
	<div class="minimalist-container">
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'minimalist-content' ); ?>>
				<header class="minimalist-header">
					<?php
					if ( has_post_thumbnail() ) :
						?>
						<div class="minimalist-featured-image">
							<?php the_post_thumbnail( 'large', array( 'class' => 'minimalist-image' ) ); ?>
						</div>
						<?php
					endif;
					?>
					
					<div class="minimalist-title-wrapper">
						<?php the_title( '<h1 class="minimalist-title">', '</h1>' ); ?>
						
						<?php if ( get_the_excerpt() ) : ?>
							<div class="minimalist-excerpt">
								<?php the_excerpt(); ?>
							</div>
						<?php endif; ?>
					</div>
				</header>

				<div class="minimalist-body">
					<div class="minimalist-content-wrapper">
						<?php
						the_content();

						wp_link_pages(
							array(
								'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'wp-fundi' ),
								'after'  => '</div>',
							)
						);
						?>
					</div>
				</div>

				<?php if ( get_edit_post_link() ) : ?>
					<footer class="minimalist-footer">
						<?php
						edit_post_link(
							sprintf(
								wp_kses(
									/* translators: %s: Name of current post. Only visible to screen readers */
									__( 'Edit <span class="screen-reader-text">%s</span>', 'wp-fundi' ),
									array(
										'span' => array(
											'class' => array(),
										),
									)
								),
								wp_kses_post( get_the_title() )
							),
							'<span class="edit-link">',
							'</span>'
						);
						?>
					</footer>
				<?php endif; ?>
			</article>
			<?php
		endwhile;
		?>
	</div>
</main>

<?php
get_footer();
