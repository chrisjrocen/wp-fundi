<?php
/**
 * Customizer additions
 *
 * @package WP-FUNDI
 * @since 1.0.0
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function wp_fundi_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'wp_fundi_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'wp_fundi_customize_partial_blogdescription',
			)
		);
	}

	// Add Fundi Styles panel.
	$wp_customize->add_panel(
		'wp_fundi_styles',
		array(
			'title'       => esc_html__( 'Fundi Styles', 'wp-fundi' ),
			'description' => esc_html__( 'Customize the appearance of your site with these style options.', 'wp-fundi' ),
			'priority'    => 30,
		)
	);

	// Add Colors section.
	$wp_customize->add_section(
		'wp_fundi_colors',
		array(
			'title' => esc_html__( 'Colors', 'wp-fundi' ),
			'panel' => 'wp_fundi_styles',
		)
	);

	// Background Color setting.
	$wp_customize->add_setting(
		'wp_fundi_background_color',
		array(
			'default'           => '#ffffff',
			'sanitize_callback' => 'wp_fundi_sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'wp_fundi_background_color',
			array(
				'label'       => esc_html__( 'Background Color', 'wp-fundi' ),
				'description' => esc_html__( 'Choose the background color for your site.', 'wp-fundi' ),
				'section'     => 'wp_fundi_colors',
				'settings'    => 'wp_fundi_background_color',
			)
		)
	);

	// Heading Color setting.
	$wp_customize->add_setting(
		'wp_fundi_heading_color',
		array(
			'default'           => '#333333',
			'sanitize_callback' => 'wp_fundi_sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'wp_fundi_heading_color',
			array(
				'label'       => esc_html__( 'Heading Color', 'wp-fundi' ),
				'description' => esc_html__( 'Choose the color for headings (h1, h2, h3, etc.).', 'wp-fundi' ),
				'section'     => 'wp_fundi_colors',
				'settings'    => 'wp_fundi_heading_color',
			)
		)
	);

	// Link Hover Color setting.
	$wp_customize->add_setting(
		'wp_fundi_link_hover_color',
		array(
			'default'           => '#005177',
			'sanitize_callback' => 'wp_fundi_sanitize_hex_color',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'wp_fundi_link_hover_color',
			array(
				'label'       => esc_html__( 'Link Hover Color', 'wp-fundi' ),
				'description' => esc_html__( 'Choose the color for links when hovered.', 'wp-fundi' ),
				'section'     => 'wp_fundi_colors',
				'settings'    => 'wp_fundi_link_hover_color',
			)
		)
	);

	// Add Typography section.
	$wp_customize->add_section(
		'wp_fundi_typography',
		array(
			'title' => esc_html__( 'Typography', 'wp-fundi' ),
			'panel' => 'wp_fundi_styles',
		)
	);

	// Font Size setting.
	$wp_customize->add_setting(
		'wp_fundi_font_size',
		array(
			'default'           => '16',
			'sanitize_callback' => 'wp_fundi_sanitize_font_size',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'wp_fundi_font_size',
		array(
			'type'        => 'range',
			'label'       => esc_html__( 'Base Font Size', 'wp-fundi' ),
			'description' => esc_html__( 'Adjust the base font size for your site.', 'wp-fundi' ),
			'section'     => 'wp_fundi_typography',
			'input_attrs' => array(
				'min'  => 12,
				'max'  => 24,
				'step' => 1,
			),
		)
	);

	// Line Height setting.
	$wp_customize->add_setting(
		'wp_fundi_line_height',
		array(
			'default'           => '1.6',
			'sanitize_callback' => 'wp_fundi_sanitize_line_height',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'wp_fundi_line_height',
		array(
			'type'        => 'range',
			'label'       => esc_html__( 'Line Height', 'wp-fundi' ),
			'description' => esc_html__( 'Adjust the line height for better readability.', 'wp-fundi' ),
			'section'     => 'wp_fundi_typography',
			'input_attrs' => array(
				'min'  => 1.2,
				'max'  => 2.0,
				'step' => 0.1,
			),
		)
	);

	// Body Font setting.
	$wp_customize->add_setting(
		'wp_fundi_body_font',
		array(
			'default'           => 'Inter',
			'sanitize_callback' => 'wp_fundi_sanitize_google_font',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'wp_fundi_body_font',
		array(
			'type'        => 'select',
			'label'       => esc_html__( 'Body Font', 'wp-fundi' ),
			'description' => esc_html__( 'Choose a Google Font for your site body text.', 'wp-fundi' ),
			'section'     => 'wp_fundi_typography',
			'choices'     => wp_fundi_get_google_fonts(),
		)
	);
}
add_action( 'customize_register', 'wp_fundi_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function wp_fundi_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function wp_fundi_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function wp_fundi_customize_preview_js() {
	wp_enqueue_script(
		'wp-fundi-customizer',
		WP_FUNDI_URL . '/js/customizer.js',
		array( 'customize-preview' ),
		WP_FUNDI_VERSION,
		true
	);
}
add_action( 'customize_preview_init', 'wp_fundi_customize_preview_js' );

/**
 * Sanitize hex color.
 *
 * @param string $color Color to sanitize.
 * @return string Sanitized color.
 */
function wp_fundi_sanitize_hex_color( $color ) {
	if ( '' === $color ) {
		return '';
	}

	// 3 or 6 hex digits, or the empty string.
	if ( preg_match( '|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) ) {
		return $color;
	}

	return '';
}

/**
 * Sanitize font size.
 *
 * @param mixed $value Value to sanitize.
 * @return int Sanitized font size.
 */
function wp_fundi_sanitize_font_size( $value ) {
	$value = absint( $value );
	if ( $value < 12 ) {
		return 12;
	}
	if ( $value > 24 ) {
		return 24;
	}
	return $value;
}

/**
 * Sanitize line height.
 *
 * @param mixed $value Value to sanitize.
 * @return float Sanitized line height.
 */
function wp_fundi_sanitize_line_height( $value ) {
	$value = floatval( $value );
	if ( $value < 1.2 ) {
		return 1.2;
	}
	if ( $value > 2.0 ) {
		return 2.0;
	}
	return $value;
}

/**
 * Sanitize Google Font selection.
 *
 * @param string $value Font name to sanitize.
 * @return string Sanitized font name.
 */
function wp_fundi_sanitize_google_font( $value ) {
	$google_fonts = wp_fundi_get_google_fonts();
	if ( array_key_exists( $value, $google_fonts ) ) {
		return $value;
	}
	return 'Inter'; // Default fallback.
}

/**
 * Get list of available Google Fonts.
 *
 * @return array Array of Google Fonts.
 */
function wp_fundi_get_google_fonts() {
	return array(
		'Inter'             => 'Inter',
		'Roboto'            => 'Roboto',
		'Lato'              => 'Lato',
		'Montserrat'        => 'Montserrat',
		'Open Sans'         => 'Open Sans',
		'Poppins'           => 'Poppins',
		'Source Sans Pro'   => 'Source Sans Pro',
		'Nunito'            => 'Nunito',
		'Raleway'           => 'Raleway',
		'Ubuntu'            => 'Ubuntu',
		'Playfair Display'  => 'Playfair Display',
		'Merriweather'      => 'Merriweather',
		'PT Sans'           => 'PT Sans',
		'Lora'              => 'Lora',
		'Crimson Text'      => 'Crimson Text',
		'Libre Baskerville' => 'Libre Baskerville',
		'Droid Sans'        => 'Droid Sans',
		'Droid Serif'       => 'Droid Serif',
		'PT Serif'          => 'PT Serif',
		'Cabin'             => 'Cabin',
		'Fira Sans'         => 'Fira Sans',
		'Work Sans'         => 'Work Sans',
		'Karla'             => 'Karla',
		'Rubik'             => 'Rubik',
		'Quicksand'         => 'Quicksand',
		'Source Code Pro'   => 'Source Code Pro',
		'Inconsolata'       => 'Inconsolata',
		'Fira Code'         => 'Fira Code',
		'JetBrains Mono'    => 'JetBrains Mono',
	);
}

/**
 * Output customizer CSS.
 */
function wp_fundi_customizer_css() {
	$background_color = get_theme_mod( 'wp_fundi_background_color', '#ffffff' );
	$heading_color    = get_theme_mod( 'wp_fundi_heading_color', '#333333' );
	$link_hover_color = get_theme_mod( 'wp_fundi_link_hover_color', '#005177' );
	$font_size        = get_theme_mod( 'wp_fundi_font_size', '16' );
	$line_height      = get_theme_mod( 'wp_fundi_line_height', '1.6' );
	$body_font        = get_theme_mod( 'wp_fundi_body_font', 'Inter' );

	$css = '';

	if ( '#ffffff' !== $background_color ) {
		$css .= "body { background-color: {$background_color}; }\n";
	}

	if ( '#333333' !== $heading_color ) {
		$css .= "h1, h2, h3, h4, h5, h6 { color: {$heading_color}; }\n";
		$css .= ".site-title a { color: {$heading_color}; }\n";
		$css .= ".widget-title { color: {$heading_color}; }\n";
	}

	if ( '#005177' !== $link_hover_color ) {
		$css .= "a:hover, a:focus { color: {$link_hover_color}; }\n";
		$css .= ".entry-title a:hover, .entry-title a:focus { color: {$link_hover_color}; }\n";
		$css .= ".main-navigation a:hover, .main-navigation a:focus { color: {$link_hover_color}; }\n";
	}

	if ( '16' !== $font_size ) {
		$css .= "html { font-size: {$font_size}px; }\n";
	}

	if ( '1.6' !== $line_height ) {
		$css .= "body { line-height: {$line_height}; }\n";
	}

	if ( 'Inter' !== $body_font ) {
		$css .= "body { font-family: '{$body_font}', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif; }\n";
	}

	if ( ! empty( $css ) ) {
		echo '<style type="text/css" id="wp-fundi-customizer-css">' . $css . '</style>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}
add_action( 'wp_head', 'wp_fundi_customizer_css' );
