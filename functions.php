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
		add_action( 'init', array( $this, 'register_page_templates' ) );
	}

	/**
	 * Theme setup.
	 */
	public function theme_setup() {
		// Add theme support for various features.
		add_theme_support( 'automatic-feed-links' );
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
		add_theme_support( 'block-templates' );
		add_theme_support( 'block-template-parts' );

		// Add theme support for editor color palette.
		add_theme_support(
			'editor-color-palette',
			$this->get_color_palette()
		);

		// Add theme support for editor gradient presets.
		add_theme_support(
			'editor-gradient-presets',
			$this->get_gradient_presets()
		);

		// Add theme support for editor font sizes.
		add_theme_support(
			'editor-font-sizes',
			$this->get_font_sizes()
		);

		// Add theme support for custom font families.
		add_theme_support(
			'editor-font-families',
			$this->get_font_families()
		);

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
		// Enqueue Google Fonts.
		$this->enqueue_google_fonts();

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
		// Sidebar widget area
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

		// Footer One widget area
		register_sidebar(
			array(
				'name'          => esc_html__( 'Footer One', 'wp-fundi' ),
				'id'            => 'footer-1',
				'description'   => esc_html__( 'Add widgets here to appear in the first footer column.', 'wp-fundi' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);

		// Footer Two widget area
		register_sidebar(
			array(
				'name'          => esc_html__( 'Footer Two', 'wp-fundi' ),
				'id'            => 'footer-2',
				'description'   => esc_html__( 'Add widgets here to appear in the second footer column.', 'wp-fundi' ),
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

	/**
	 * Get theme color palette.
	 *
	 * @return array Color palette configuration.
	 */
	private function get_color_palette() {
		return array(
			array(
				'name'  => esc_html__( 'Primary', 'wp-fundi' ),
				'slug'  => 'primary',
				'color' => '#0073aa',
			),
			array(
				'name'  => esc_html__( 'Secondary', 'wp-fundi' ),
				'slug'  => 'secondary',
				'color' => '#005177',
			),
			array(
				'name'  => esc_html__( 'Accent', 'wp-fundi' ),
				'slug'  => 'accent',
				'color' => '#00a0d2',
			),
			array(
				'name'  => esc_html__( 'Background', 'wp-fundi' ),
				'slug'  => 'background',
				'color' => '#ffffff',
			),
			array(
				'name'  => esc_html__( 'Dark Gray', 'wp-fundi' ),
				'slug'  => 'dark-gray',
				'color' => '#333333',
			),
			array(
				'name'  => esc_html__( 'Medium Gray', 'wp-fundi' ),
				'slug'  => 'medium-gray',
				'color' => '#666666',
			),
			array(
				'name'  => esc_html__( 'Light Gray', 'wp-fundi' ),
				'slug'  => 'light-gray',
				'color' => '#f8f9fa',
			),
			array(
				'name'  => esc_html__( 'Success', 'wp-fundi' ),
				'slug'  => 'success',
				'color' => '#28a745',
			),
			array(
				'name'  => esc_html__( 'Warning', 'wp-fundi' ),
				'slug'  => 'warning',
				'color' => '#ffc107',
			),
			array(
				'name'  => esc_html__( 'Error', 'wp-fundi' ),
				'slug'  => 'error',
				'color' => '#dc3545',
			),
		);
	}

	/**
	 * Get theme gradient presets.
	 *
	 * @return array Gradient presets configuration.
	 */
	private function get_gradient_presets() {
		return array(
			array(
				'name'     => esc_html__( 'Primary to Secondary', 'wp-fundi' ),
				'gradient' => 'linear-gradient(135deg, #0073aa 0%, #005177 100%)',
				'slug'     => 'primary-to-secondary',
			),
			array(
				'name'     => esc_html__( 'Primary to Accent', 'wp-fundi' ),
				'gradient' => 'linear-gradient(135deg, #0073aa 0%, #00a0d2 100%)',
				'slug'     => 'primary-to-accent',
			),
			array(
				'name'     => esc_html__( 'Warm Gradient', 'wp-fundi' ),
				'gradient' => 'linear-gradient(135deg, #ff6b6b 0%, #ffa500 100%)',
				'slug'     => 'warm-gradient',
			),
			array(
				'name'     => esc_html__( 'Cool Gradient', 'wp-fundi' ),
				'gradient' => 'linear-gradient(135deg, #4ecdc4 0%, #44a08d 100%)',
				'slug'     => 'cool-gradient',
			),
			array(
				'name'     => esc_html__( 'Dark Gradient', 'wp-fundi' ),
				'gradient' => 'linear-gradient(135deg, #2c3e50 0%, #34495e 100%)',
				'slug'     => 'dark-gradient',
			),
		);
	}

	/**
	 * Get theme font sizes.
	 *
	 * @return array Font sizes configuration.
	 */
	private function get_font_sizes() {
		return array(
			array(
				'name' => esc_html__( 'Small', 'wp-fundi' ),
				'size' => 14,
				'slug' => 'small',
			),
			array(
				'name' => esc_html__( 'Regular', 'wp-fundi' ),
				'size' => 16,
				'slug' => 'regular',
			),
			array(
				'name' => esc_html__( 'Medium', 'wp-fundi' ),
				'size' => 18,
				'slug' => 'medium',
			),
			array(
				'name' => esc_html__( 'Large', 'wp-fundi' ),
				'size' => 24,
				'slug' => 'large',
			),
			array(
				'name' => esc_html__( 'Extra Large', 'wp-fundi' ),
				'size' => 32,
				'slug' => 'extra-large',
			),
			array(
				'name' => esc_html__( 'Huge', 'wp-fundi' ),
				'size' => 48,
				'slug' => 'huge',
			),
		);
	}

	/**
	 * Get theme font families.
	 *
	 * @return array Font families configuration.
	 */
	private function get_font_families() {
		return array(
			array(
				'fontFamily' => 'Inter, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, sans-serif',
				'name'       => esc_html__( 'Inter (System Fonts)', 'wp-fundi' ),
				'slug'       => 'inter-system',
			),
			array(
				'fontFamily' => 'Poppins, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, sans-serif',
				'name'       => esc_html__( 'Poppins', 'wp-fundi' ),
				'slug'       => 'poppins',
			),
			array(
				'fontFamily' => 'Open Sans, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, sans-serif',
				'name'       => esc_html__( 'Open Sans', 'wp-fundi' ),
				'slug'       => 'open-sans',
			),
			array(
				'fontFamily' => 'Lato, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, sans-serif',
				'name'       => esc_html__( 'Lato', 'wp-fundi' ),
				'slug'       => 'lato',
			),
			array(
				'fontFamily' => 'Merriweather, Georgia, "Times New Roman", Times, serif',
				'name'       => esc_html__( 'Merriweather (Serif)', 'wp-fundi' ),
				'slug'       => 'merriweather-serif',
			),
			array(
				'fontFamily' => '"Source Code Pro", Monaco, Consolas, "Liberation Mono", "Courier New", monospace',
				'name'       => esc_html__( 'Source Code Pro (Monospace)', 'wp-fundi' ),
				'slug'       => 'source-code-pro-mono',
			),
		);
	}

	/**
	 * Enqueue Google Fonts based on customizer selection.
	 */
	private function enqueue_google_fonts() {
		$selected_font = get_theme_mod( 'wp_fundi_body_font', 'Inter' );

		// Skip if Inter is selected (already loaded via system fonts).
		if ( 'Inter' === $selected_font ) {
			return;
		}

		// Convert font name to Google Fonts URL format.
		$font_url = $this->get_google_font_url( $selected_font );
		if ( $font_url ) {
			wp_enqueue_style(
				'wp-fundi-google-fonts',
				$font_url,
				array(),
				WP_FUNDI_VERSION
			);
		}
	}

	/**
	 * Get Google Fonts URL for the selected font.
	 *
	 * @param string $font_name Font name.
	 * @return string|false Google Fonts URL or false if not found.
	 */
	private function get_google_font_url( $font_name ) {
		$google_fonts = array(
			'Roboto'            => 'Roboto:300,400,500,700',
			'Lato'              => 'Lato:300,400,700,900',
			'Montserrat'        => 'Montserrat:300,400,500,600,700',
			'Open Sans'         => 'Open+Sans:300,400,600,700,800',
			'Poppins'           => 'Poppins:300,400,500,600,700',
			'Source Sans Pro'   => 'Source+Sans+Pro:300,400,600,700,900',
			'Nunito'            => 'Nunito:300,400,600,700,800,900',
			'Raleway'           => 'Raleway:300,400,500,600,700,800,900',
			'Ubuntu'            => 'Ubuntu:300,400,500,700',
			'Playfair Display'  => 'Playfair+Display:400,700,900',
			'Merriweather'      => 'Merriweather:300,400,700,900',
			'PT Sans'           => 'PT+Sans:400,700',
			'Lora'              => 'Lora:400,700',
			'Crimson Text'      => 'Crimson+Text:400,600,700',
			'Libre Baskerville' => 'Libre+Baskerville:400,700',
			'Droid Sans'        => 'Droid+Sans:400,700',
			'Droid Serif'       => 'Droid+Serif:400,700',
			'PT Serif'          => 'PT+Serif:400,700',
			'Cabin'             => 'Cabin:400,500,600,700',
			'Fira Sans'         => 'Fira+Sans:300,400,500,600,700',
			'Work Sans'         => 'Work+Sans:300,400,500,600,700,800,900',
			'Karla'             => 'Karla:300,400,500,600,700',
			'Rubik'             => 'Rubik:300,400,500,600,700,800,900',
			'Quicksand'         => 'Quicksand:300,400,500,700',
		);

		if ( isset( $google_fonts[ $font_name ] ) ) {
			return 'https://fonts.googleapis.com/css2?family=' . $google_fonts[ $font_name ] . '&display=swap';
		}

		return false;
	}

	/**
	 * Register custom page templates.
	 */
	public function register_page_templates() {
		// Future custom templates can be registered here.
	}
}

// Initialize theme.
WP_Fundi_Theme::get_instance();
