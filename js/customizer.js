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

	// Body Font
	wp.customize( 'wp_fundi_body_font', function( value ) {
		value.bind( function( to ) {
			// Load the new Google Font
			if ( 'Inter' !== to ) {
				var fontUrl = 'https://fonts.googleapis.com/css2?family=' + to.replace(/\s+/g, '+') + ':300,400,500,600,700&display=swap';
				
				// Remove existing Google Font link
				$( 'link[href*="fonts.googleapis.com"]' ).remove();
				
				// Add new Google Font link
				$( '<link>' )
					.attr( 'rel', 'stylesheet' )
					.attr( 'href', fontUrl )
					.appendTo( 'head' );
			}
			
			// Apply the font family
			var fontFamily = 'Inter' === to ? 
				'Inter, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, sans-serif' :
				'\'' + to + '\', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, sans-serif';
			
			$( 'body' ).css( 'font-family', fontFamily );
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
