<?php
/**
 * Template Name: Creative
 *
 * A dynamic, creative page template with enhanced visual elements.
 *
 * @package WP-FUNDI
 * @since 1.0.0
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header(); ?>

<main id="primary" class="site-main creative-template">
	<div class="creative-container">
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'creative-content' ); ?>>
				<header class="creative-header">
					<?php if ( has_post_thumbnail() ) : ?>
						<div class="creative-hero">
							<div class="creative-featured-image">
								<?php the_post_thumbnail( 'full', array( 'class' => 'creative-image' ) ); ?>
								<div class="creative-overlay"></div>
							</div>
						</div>
					<?php endif; ?>
					
					<div class="creative-title-section">
						<div class="creative-title-wrapper">
							<?php the_title( '<h1 class="creative-title">', '</h1>' ); ?>
							
							<?php if ( get_the_excerpt() ) : ?>
								<div class="creative-excerpt">
									<?php the_excerpt(); ?>
								</div>
							<?php endif; ?>
							
							<div class="creative-meta">
								<span class="creative-date">
									<?php echo esc_html( get_the_date() ); ?>
								</span>
								<?php if ( get_the_author() ) : ?>
									<span class="creative-author">
										<?php esc_html_e( 'by ', 'wp-fundi' ); ?>
										<?php the_author(); ?>
									</span>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</header>

				<div class="creative-body">
					<div class="creative-content-wrapper">
						<div class="creative-main-content">
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
						
						<?php if ( get_edit_post_link() ) : ?>
							<aside class="creative-sidebar">
								<div class="creative-actions">
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
										'<span class="edit-link creative-edit">',
										'</span>'
									);
									?>
								</div>
								
								<div class="creative-share">
									<h3><?php esc_html_e( 'Share this page', 'wp-fundi' ); ?></h3>
									<div class="share-buttons">
										<a href="https://twitter.com/intent/tweet?url=<?php echo esc_url( get_permalink() ); ?>&text=<?php echo esc_attr( get_the_title() ); ?>" 
											target="_blank" rel="noopener" class="share-twitter">
											<?php esc_html_e( 'Twitter', 'wp-fundi' ); ?>
										</a>
										<a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url( get_permalink() ); ?>" 
											target="_blank" rel="noopener" class="share-facebook">
											<?php esc_html_e( 'Facebook', 'wp-fundi' ); ?>
										</a>
										<a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo esc_url( get_permalink() ); ?>" 
											target="_blank" rel="noopener" class="share-linkedin">
											<?php esc_html_e( 'LinkedIn', 'wp-fundi' ); ?>
										</a>
									</div>
								</div>
							</aside>
						<?php endif; ?>
					</div>
				</div>

				<footer class="creative-footer">
					<div class="creative-navigation">
						<?php
						the_post_navigation(
							array(
								'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'wp-fundi' ) . '</span> <span class="nav-title">%title</span>',
								'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'wp-fundi' ) . '</span> <span class="nav-title">%title</span>',
							)
						);
						?>
					</div>
				</footer>
			</article>
			<?php
		endwhile;
		?>
	</div>
</main>

<?php
get_footer();
