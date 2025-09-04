<?php
/**
 * Template part for displaying portfolio items
 *
 * @package WP-FUNDI
 * @since 1.0.0
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'portfolio-item' ); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<div class="portfolio-thumbnail">
			<a href="<?php the_permalink(); ?>" class="portfolio-link">
				<?php the_post_thumbnail( 'wp-fundi-featured' ); ?>
				<div class="portfolio-overlay">
					<span class="portfolio-icon">
						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M15 3H9V1H15V3ZM11 14H13V8H11V14ZM12 17C12.55 17 13 16.55 13 16C13 15.45 12.55 15 12 15C11.45 15 11 15.45 11 16C11 16.55 11.45 17 12 17ZM12 2C6.48 2 2 6.48 2 12S6.48 22 12 22 22 17.52 22 12 17.52 2 12 2ZM12 20C7.59 20 4 16.41 4 12S7.59 4 12 4 20 7.59 20 12 16.41 20 12 20Z" fill="currentColor"/>
						</svg>
					</span>
				</div>
			</a>
		</div>
	<?php endif; ?>

	<div class="portfolio-content">
		<header class="portfolio-header">
			<?php
			if ( is_singular() ) :
				the_title( '<h1 class="portfolio-title">', '</h1>' );
			else :
				the_title( '<h2 class="portfolio-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif;
			?>

			<?php if ( 'portfolio' === get_post_type() ) : ?>
				<div class="portfolio-meta">
					<?php
					// Display portfolio categories.
					$portfolio_categories = get_the_terms( get_the_ID(), 'portfolio_category' );
					if ( $portfolio_categories && ! is_wp_error( $portfolio_categories ) ) :
						?>
						<div class="portfolio-categories">
							<?php
							foreach ( $portfolio_categories as $category ) :
								?>
								<span class="portfolio-category">
									<a href="<?php echo esc_url( get_term_link( $category ) ); ?>">
										<?php echo esc_html( $category->name ); ?>
									</a>
								</span>
								<?php
							endforeach;
							?>
						</div>
						<?php
					endif;

					// Display portfolio tags.
					$portfolio_tags = get_the_terms( get_the_ID(), 'portfolio_tag' );
					if ( $portfolio_tags && ! is_wp_error( $portfolio_tags ) ) :
						?>
						<div class="portfolio-tags">
							<?php
							foreach ( $portfolio_tags as $tag ) :
								?>
								<span class="portfolio-tag">
									<a href="<?php echo esc_url( get_term_link( $tag ) ); ?>">
										<?php echo esc_html( $tag->name ); ?>
									</a>
								</span>
								<?php
							endforeach;
							?>
						</div>
						<?php
					endif;
					?>
				</div>
			<?php endif; ?>
		</header>

		<div class="portfolio-excerpt">
			<?php
			if ( is_singular() ) {
				the_content(
					sprintf(
						wp_kses(
							/* translators: %s: Name of current portfolio item. Only visible to screen readers */
							__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'wp-fundi' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						get_the_title()
					)
				);

				wp_link_pages(
					array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'wp-fundi' ),
						'after'  => '</div>',
					)
				);
			} else {
				the_excerpt();
				?>
				<p class="read-more">
					<a href="<?php the_permalink(); ?>" class="more-link">
						<?php esc_html_e( 'View Project', 'wp-fundi' ); ?>
					</a>
				</p>
				<?php
			}
			?>
		</div>

		<?php if ( is_singular() ) : ?>
			<footer class="portfolio-footer">
				<?php
				// Display custom fields if they exist.
				$project_url  = get_post_meta( get_the_ID(), '_portfolio_project_url', true );
				$client_name  = get_post_meta( get_the_ID(), '_portfolio_client', true );
				$project_date = get_post_meta( get_the_ID(), '_portfolio_date', true );

				if ( $project_url || $client_name || $project_date ) :
					?>
					<div class="portfolio-details">
						<?php if ( $client_name ) : ?>
							<div class="portfolio-detail">
								<strong><?php esc_html_e( 'Client:', 'wp-fundi' ); ?></strong>
								<span><?php echo esc_html( $client_name ); ?></span>
							</div>
						<?php endif; ?>

						<?php if ( $project_date ) : ?>
							<div class="portfolio-detail">
								<strong><?php esc_html_e( 'Date:', 'wp-fundi' ); ?></strong>
								<span><?php echo esc_html( $project_date ); ?></span>
							</div>
						<?php endif; ?>

						<?php if ( $project_url ) : ?>
							<div class="portfolio-detail">
								<strong><?php esc_html_e( 'Project URL:', 'wp-fundi' ); ?></strong>
								<a href="<?php echo esc_url( $project_url ); ?>" target="_blank" rel="noopener noreferrer">
									<?php esc_html_e( 'Visit Project', 'wp-fundi' ); ?>
								</a>
							</div>
						<?php endif; ?>
					</div>
					<?php
				endif;

				// Display edit link for logged-in users.
				if ( get_edit_post_link() ) :
					edit_post_link(
						sprintf(
							wp_kses(
								/* translators: %s: Name of current portfolio item. Only visible to screen readers */
								__( 'Edit <span class="screen-reader-text">%s</span>', 'wp-fundi' ),
								array(
									'span' => array(
										'class' => array(),
									),
								)
							),
							get_the_title()
						),
						'<span class="edit-link">',
						'</span>'
					);
				endif;
				?>
			</footer>
		<?php endif; ?>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
