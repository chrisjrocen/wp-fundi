<?php
/**
 * WP-FUNDI Theme Functions
 *
 * @package WP-FUNDI
 * @since 1.0.0
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Theme version constant.
 */
define( 'WP_FUNDI_VERSION', '1.0.0' );

/**
 * Theme directory path.
 */
define( 'WP_FUNDI_DIR', get_template_directory() );

/**
 * Theme directory URL.
 */
define( 'WP_FUNDI_URL', get_template_directory_uri() );

/**
 * Main theme class.
 */
class WP_Fundi_Theme {

	/**
	 * Single instance of the class.
	 *
	 * @var WP_Fundi_Theme
	 */
	private static $instance = null;

	/**
	 * Get single instance of the class.
	 *
	 * @return WP_Fundi_Theme
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Constructor.
	 */
	private function __construct() {
		$this->init_hooks();
	}

	/**
	 * Initialize WordPress hooks.
	 */
	private function init_hooks() {
		add_action( 'after_setup_theme', array( $this, 'theme_setup' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'widgets_init', array( $this, 'register_widget_areas' ) );
		add_action( 'wp_head', array( $this, 'add_meta_tags' ) );
		add_filter( 'excerpt_length', array( $this, 'custom_excerpt_length' ) );
		add_filter( 'excerpt_more', array( $this, 'custom_excerpt_more' ) );
	}

	/**
	 * Theme setup.
	 */
	public function theme_setup() {
		// Add theme support for various features.
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 100,
				'width'       => 300,
				'flex-height' => true,
				'flex-width'  => true,
			)
		);
		add_theme_support( 'customize-selective-refresh-widgets' );
		add_theme_support( 'responsive-embeds' );
		add_theme_support( 'wp-block-styles' );
		add_theme_support( 'align-wide' );

		// Add custom image sizes.
		add_image_size( 'wp-fundi-featured', 800, 400, true );
		add_image_size( 'wp-fundi-thumbnail', 300, 200, true );

		// Register navigation menus.
		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary Menu', 'wp-fundi' ),
				'footer'  => esc_html__( 'Footer Menu', 'wp-fundi' ),
			)
		);

		// Load theme textdomain.
		load_theme_textdomain( 'wp-fundi', WP_FUNDI_DIR . '/languages' );
	}

	/**
	 * Enqueue scripts and styles.
	 */
	public function enqueue_scripts() {
		// Enqueue main stylesheet.
		wp_enqueue_style(
			'wp-fundi-style',
			WP_FUNDI_URL . '/style.css',
			array(),
			WP_FUNDI_VERSION
		);

		// Enqueue main JavaScript.
		wp_enqueue_script(
			'wp-fundi-script',
			WP_FUNDI_URL . '/js/main.js',
			array(),
			WP_FUNDI_VERSION,
			true
		);

		// Add comment reply script on singular posts with comments open.
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}

	/**
	 * Register widget areas.
	 */
	public function register_widget_areas() {
		register_sidebar(
			array(
				'name'          => esc_html__( 'Sidebar', 'wp-fundi' ),
				'id'            => 'sidebar-1',
				'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'wp-fundi' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);

		register_sidebar(
			array(
				'name'          => esc_html__( 'Footer Widget Area', 'wp-fundi' ),
				'id'            => 'footer-1',
				'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'wp-fundi' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);
	}

	/**
	 * Add meta tags to head.
	 */
	public function add_meta_tags() {
		echo '<meta name="viewport" content="width=device-width, initial-scale=1">' . "\n";
		echo '<meta name="theme-color" content="#ffffff">' . "\n";
	}

	/**
	 * Custom excerpt length.
	 *
	 * @param int $length Current excerpt length.
	 * @return int Modified excerpt length.
	 */
	public function custom_excerpt_length( $length ) {
		return 30;
	}

	/**
	 * Custom excerpt more text.
	 *
	 * @param string $more Current more text.
	 * @return string Modified more text.
	 */
	public function custom_excerpt_more( $more ) {
		return '...';
	}
}

/**
 * Initialize the theme.
 */
function wp_fundi_init() {
	return WP_Fundi_Theme::get_instance();
}

// Initialize the theme.
wp_fundi_init();

/**
 * Custom template tags for this theme.
 */
require_once WP_FUNDI_DIR . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require_once WP_FUNDI_DIR . '/inc/extras.php';

/**
 * Register custom blocks.
 */
require_once WP_FUNDI_DIR . '/blocks/fundi-hero/index.php';
