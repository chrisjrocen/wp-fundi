<?php

/**
 * Theme setup.
 */
public function theme_setup() {
    // Add RSS feed links to <head>
    add_theme_support( 'automatic-feed-links' );

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

    // Add theme support for block templates.
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
 * Theme setup.
 */
public function theme_setup() {
    // Add RSS feed links to <head>
    add_theme_support( 'automatic-feed-links' );

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

    // Add theme support for block templates.
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
