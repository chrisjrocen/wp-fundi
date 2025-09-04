<?php
/**
 * The template for displaying single portfolio items
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
				while ( have_posts() ) :
					the_post();

					/*
					 * Include the portfolio template for the content.
					 */
					get_template_part( 'template-parts/content', 'portfolio' );

					// Portfolio navigation.
					the_post_navigation(
						array(
							'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'wp-fundi' ) . '</span> <span class="nav-title">%title</span>',
							'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'wp-fundi' ) . '</span> <span class="nav-title">%title</span>',
						)
					);

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

				endwhile; // End of the loop.
				?>
			</div><!-- .content-wrapper -->

			<?php get_sidebar(); ?>
		</div><!-- .content-area -->
	</div><!-- .container -->
</main><!-- #primary -->

<?php
get_footer();
