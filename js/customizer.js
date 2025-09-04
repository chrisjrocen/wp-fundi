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
			$( ':root' ).css( '--color-background', to );
			$( 'body' ).css( 'background-color', to );
		} );
	} );

	// Heading Color
	wp.customize( 'wp_fundi_heading_color', function( value ) {
		value.bind( function( to ) {
			$( ':root' ).css( '--color-heading', to );
			$( 'h1, h2, h3, h4, h5, h6' ).css( 'color', to );
			$( '.site-title a' ).css( 'color', to );
			$( '.widget-title' ).css( 'color', to );
		} );
	} );

	// Link Hover Color
	wp.customize( 'wp_fundi_link_hover_color', function( value ) {
		value.bind( function( to ) {
			$( ':root' ).css( '--color-link-hover', to );
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

	// Export/Import functionality
	wp.customize.bind( 'ready', function() {
		// Export settings
		$( '#export-settings' ).on( 'click', function( e ) {
			e.preventDefault();
			
			// Get current customizer settings
			var settings = {};
			var wpFundiSettings = [
				'wp_fundi_background_color',
				'wp_fundi_heading_color', 
				'wp_fundi_link_hover_color',
				'wp_fundi_font_size',
				'wp_fundi_line_height',
				'wp_fundi_body_font'
			];
			
			wpFundiSettings.forEach( function( setting ) {
				var control = wp.customize.control( setting );
				if ( control ) {
					settings[ setting ] = control.setting.get();
				}
			} );
			
			// Create export data
			var exportData = {
				version: '1.0.0',
				theme: wp.customize.theme.stylesheet,
				exported_at: new Date().toISOString(),
				site_url: wp.customize.url.home,
				settings: settings
			};
			
			// Create and download file
			var dataStr = JSON.stringify( exportData, null, 2 );
			var dataBlob = new Blob( [ dataStr ], { type: 'application/json' } );
			var url = URL.createObjectURL( dataBlob );
			
			var link = document.createElement( 'a' );
			link.href = url;
			link.download = 'wp-fundi-customizer-settings-' + new Date().toISOString().slice( 0, 19 ).replace( /:/g, '-' ) + '.json';
			document.body.appendChild( link );
			link.click();
			document.body.removeChild( link );
			URL.revokeObjectURL( url );
			
			showNotice( 'Settings exported successfully!', 'success' );
		} );
		
		// Import settings
		$( '#import-settings' ).on( 'click', function( e ) {
			e.preventDefault();
			$( '#import-file' ).click();
		} );
		
		$( '#import-file' ).on( 'change', function( e ) {
			var file = e.target.files[0];
			if ( ! file ) {
				return;
			}
			
			// Validate file type
			if ( file.type !== 'application/json' && ! file.name.endsWith( '.json' ) ) {
				showNotice( 'Please select a valid JSON file.', 'error' );
				return;
			}
			
			// Validate file size (max 1MB)
			if ( file.size > 1024 * 1024 ) {
				showNotice( 'File size must be less than 1MB.', 'error' );
				return;
			}
			
			var reader = new FileReader();
			reader.onload = function( e ) {
				try {
					var importData = JSON.parse( e.target.result );
					
					// Validate import data
					if ( ! importData.settings || typeof importData.settings !== 'object' ) {
						showNotice( 'Invalid settings file format.', 'error' );
						return;
					}
					
					// Import settings
					var importedCount = 0;
					Object.keys( importData.settings ).forEach( function( setting ) {
						var control = wp.customize.control( setting );
						if ( control ) {
							control.setting.set( importData.settings[ setting ] );
							importedCount++;
						}
					} );
					
					showNotice( 'Successfully imported ' + importedCount + ' settings!', 'success' );
					
				} catch ( error ) {
					showNotice( 'Invalid JSON file.', 'error' );
				}
			};
			
			reader.readAsText( file );
			$( '#import-file' ).val( '' );
		} );
		
		// Show notice function
		function showNotice( message, type ) {
			var notice = $( '#export-import-notice' );
			var noticeClass = type === 'success' ? 'notice-success' : 'notice-error';
			
			notice.removeClass( 'notice-success notice-error' )
				  .addClass( noticeClass )
				  .find( 'p' )
				  .text( message )
				  .end()
				  .show();
			
			// Auto-hide after 5 seconds
			setTimeout( function() {
				notice.fadeOut();
			}, 5000 );
		}
	} );

})( jQuery );
