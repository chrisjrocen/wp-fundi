<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
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

					if ( is_home() && ! is_front_page() ) :
						?>
						<header class="page-header">
							<h1 class="page-title"><?php single_post_title(); ?></h1>
						</header>
						<?php
					endif;

					// Start the Loop.
					while ( have_posts() ) :
						the_post();

						/*
						 * Include the Post-Type-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
						 */
						get_template_part( 'template-parts/content', get_post_type() );

					endwhile;

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
