/**
 * Customizer Live Preview
 *
 * @package WP-FUNDI
 * @since 1.0.0
 */

(function( $ ) {
	'use strict';

	// Background Color
	wp.customize( 'wp_fundi_background_color', function( value ) {
		value.bind( function( to ) {
			$( 'body' ).css( 'background-color', to );
		} );
	} );

	// Heading Color
	wp.customize( 'wp_fundi_heading_color', function( value ) {
		value.bind( function( to ) {
			$( 'h1, h2, h3, h4, h5, h6' ).css( 'color', to );
			$( '.site-title a' ).css( 'color', to );
			$( '.widget-title' ).css( 'color', to );
		} );
	} );

	// Link Hover Color
	wp.customize( 'wp_fundi_link_hover_color', function( value ) {
		value.bind( function( to ) {
			$( 'a' ).css( '--hover-color', to );
			$( '.entry-title a' ).css( '--hover-color', to );
			$( '.main-navigation a' ).css( '--hover-color', to );
		} );
	} );

	// Font Size
	wp.customize( 'wp_fundi_font_size', function( value ) {
		value.bind( function( to ) {
			$( 'html' ).css( 'font-size', to + 'px' );
		} );
	} );

	// Line Height
	wp.customize( 'wp_fundi_line_height', function( value ) {
		value.bind( function( to ) {
			$( 'body' ).css( 'line-height', to );
		} );
	} );

	// Site Title
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );

	// Site Description
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Header Text Color
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title a, .site-description' ).css( 'color', to );
			}
		} );
	} );

})( jQuery );
