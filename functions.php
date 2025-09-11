<?php
/**
 * WP-FUNDI functions and definitions
 *
 * @package WP-FUNDI
 */

if ( ! defined( 'WP_FUND_VERSION' ) ) {
	define( 'WP_FUND_VERSION', '1.0.0' );
}

if ( ! function_exists( 'wpfundi_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 */
	function wpfundi_setup() {

		// Make theme available for translation.
		load_theme_textdomain( 'wp-fundi', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );

		// Register navigation menus.
		register_nav_menus(
			array(
				'primary' => __( 'Primary Menu', 'wp-fundi' ),
				'footer'  => __( 'Footer Menu', 'wp-fundi' ),
			)
		);

		// Switch default core markup to output valid HTML5.
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'script',
				'style',
			)
		);

		// Support for custom logo.
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 100,
				'width'       => 400,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		// Support for custom background.
		add_theme_support(
			'custom-background',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		);

		// Support for custom header.
		add_theme_support(
			'custom-header',
			array(
				'width'       => 1600,
				'height'      => 400,
				'flex-width'  => true,
				'flex-height' => true,
				'uploads'     => true,
			)
		);

		// Enable support for selective refresh in Customizer.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for responsive embeds.
		add_theme_support( 'responsive-embeds' );

		// Add support for editor styles.
		add_editor_style( 'style.css' );
	}
endif;
add_action( 'after_setup_theme', 'wpfundi_setup' );

/**
 * Set the content width in pixels.
 */
function wpfundi_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'wpfundi_content_width', 800 );
}
add_action( 'after_setup_theme', 'wpfundi_content_width', 0 );

/**
 * Register widget areas.
 */
function wpfundi_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Sidebar', 'wp-fundi' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here.', 'wp-fundi' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer', 'wp-fundi' ),
			'id'            => 'footer-1',
			'description'   => __( 'Add footer widgets here.', 'wp-fundi' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'wpfundi_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function wpfundi_scripts() {
	wp_enqueue_style( 'wp-fundi-style', get_stylesheet_uri(), array(), WP_FUND_VERSION );

	wp_enqueue_script(
		'wp-fundi-scripts',
		get_template_directory_uri() . '/js/main.js',
		array( 'jquery' ),
		WP_FUND_VERSION,
		true
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'wpfundi_scripts' );
