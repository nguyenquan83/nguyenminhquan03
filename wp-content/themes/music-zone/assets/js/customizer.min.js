/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */
 ( function( $ ) {

	
 	const music_zone_section_lists = ['slider_section', 'about_section', 'album_section', 'service_section', 'playlist_section', 'promotion_section', 'recent_product_section', 'event_section', 'counter_section', 'subscription_section', 'latest_posts_section'] 
    music_zone_section_lists.forEach( music_zone_homepage_scroll_preview );

 	function music_zone_homepage_scroll_preview(item, index) {
		// Collect information from customize-controls.js about which panels are opening.
		wp.customize.bind( 'preview-ready', function() {

		// Initially hide the theme option placeholders on load.
		$( '.panel-placeholder' ).hide();
		wp.customize.preview.bind( item, function( data ) {
		// Only on the front page.
		if ( ! $( 'body' ).hasClass( 'home' ) ) {
			return;
		}

		// When the section is expanded, show and scroll to the content placeholders, exposing the edit links.
		if ( true === data.expanded ) {
			$('html, body').animate({
				'scrollTop' : $('#music_zone_'+item).position().top
			});
		} 
	});

	});
	}


	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
			}
		} );
	} );

	// Header title color.
	wp.customize( 'music_zone_theme_options[header_title_color]', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title a' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title a' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title a' ).css( {
					'color': to
				} );
			}
		} );
	} );

	// Header tagline color.
	wp.customize( 'music_zone_theme_options[header_tagline_color]', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-description' ).css( {
					'color': to
				} );
			}
		} );
	} );

	// Color scheme.
	wp.customize( 'music_zone_theme_options[colorscheme]', function( value ) {
		value.bind( function( to ) {

			// Update color body class.
			$( 'body' )
				.removeClass( 'colors-light colors-dark colors-custom' )
				.addClass( 'colors-' + to );
		});
	});

	// Custom color hue.
	wp.customize( 'music_zone_theme_options[colorscheme_hue]', function( value ) {
		value.bind( function( to ) {

			// Update custom color CSS
			var style = $( '#custom-theme-colors' ),
			    color = style.data( 'color' ),
			    css = style.html();
			css = css.split( color ).join( to );
			style.html( css )
			     .data( 'color', to );
		} );
	} );
} )( jQuery );
