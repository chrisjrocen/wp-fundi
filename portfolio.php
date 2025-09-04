<?php
/**
 * The template for displaying portfolio items
 *
 * @package WP-FUNDI
 * @since 1.0.0
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="primary" class="site-main">
	<div class="container">
		<div class="content-area">
			<div class="content-wrapper">
				<?php
				if ( have_posts() ) :

					// Portfolio archive header.
					if ( is_post_type_archive( 'portfolio' ) ) :
						?>
						<header class="page-header">
							<h1 class="page-title"><?php post_type_archive_title(); ?></h1>
							<?php
							$portfolio_description = get_the_archive_description();
							if ( $portfolio_description ) :
								?>
								<div class="archive-description">
									<?php echo $portfolio_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
								</div>
								<?php
							endif;
							?>
						</header>
						<?php
					endif;

					// Portfolio grid.
					?>
					<div class="portfolio-grid">
						<?php
						// Start the Loop.
						while ( have_posts() ) :
							the_post();

							/*
							 * Include the portfolio template for the content.
							 */
							get_template_part( 'template-parts/content', 'portfolio' );

						endwhile;
						?>
					</div><!-- .portfolio-grid -->

					<?php
					// Posts pagination.
					the_posts_pagination(
						array(
							'mid_size'  => 2,
							'prev_text' => esc_html__( 'Previous', 'wp-fundi' ),
							'next_text' => esc_html__( 'Next', 'wp-fundi' ),
						)
					);

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif;
				?>
			</div><!-- .content-wrapper -->

			<?php get_sidebar(); ?>
		</div><!-- .content-area -->
	</div><!-- .container -->
</main><!-- #primary -->

<?php
get_footer();
