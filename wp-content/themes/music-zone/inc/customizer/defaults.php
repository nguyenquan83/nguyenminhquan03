<?php
/**
 * Customizer default options
 *
 * @package Theme Palace
 * @subpackage  Music Zone
 * @since  Music Zone 1.0.0
 * @return array An array of default values
 */

function music_zone_get_default_theme_options() {
	$theme_data = wp_get_theme();
	$music_zone_default_options = array(
		// Color Options
		'header_title_color'			    => '#fff',
		'header_tagline_color'			    => '#fff',
		'header_txt_logo_extra'			    => 'show-all',
		'colorscheme_hue'				    => '#d87b4d',
		'colorscheme'					    => 'default',
		'theme_version'						=> 'dark-version',

		// typography Options
		'theme_typography' 				    => 'default',
		'body_theme_typography' 		    => 'default',
		
		// loader
		'loader_enable'         		    => (bool) false,
		'loader_icon'         			    => 'default',

		// breadcrumb
		'breadcrumb_enable'				    => (bool) true,
		'breadcrumb_separator'			    => '/',

		// homepage options
		'enable_frontpage_content' 			=> false,

		// layout 
		'site_layout'         			    => 'wide',
		'sidebar_position'         		    => 'right-sidebar',
		'post_sidebar_position' 		    => 'right-sidebar',
		'page_sidebar_position' 		    => 'right-sidebar',
		'menu_sticky'					    => (bool) false,
		'search_icon_in_primary_menu_enable'=> (bool) true,
		'enable_cart_button'                => (bool) true,
		'enable_advertisement'              => (bool) false,

		// excerpt options
		'long_excerpt_length'               => 25,

		// pagination options
		'pagination_enable'         	    => (bool) true,
		'pagination_type'         		    => 'default',

		// footer options
		'copyright_text'           		    => sprintf( esc_html_x( 'Copyright &copy; %1$s %2$s. ', '1: Year, 2: Site Title with home URL', 'music-zone' ), '[the-year]', '[site-link]' ),
		'scroll_top_visible'        	    => (bool) true,

		// reset options
		'reset_options'      			    => (bool) false,

		// homepage sections sortable
		'sortable' 							=> 'slider,music_player,service,playlist,promotion,recent_product,event,counter,subscription,latest_posts',
		
		// blog/archive options,counter
		'your_latest_posts_title' 		    => esc_html__( 'Blogs', 'music-zone' ),
		'read_more_text' 				    => esc_html__( 'Learn More', 'music-zone' ),
		'blog_column'					    => 'col-2',
		'hide_banner'					    => false,


		// single post theme options
		'single_post_hide_banner'		    => (bool) false,
		'single_post_hide_date' 		    => (bool) false,

		/* Front Page */

		// Slider
		'slider_section_enable'				=> (bool) false,
		'slider_content_type'				=> 'page',
		'slider_count'						=> 3,
		'slider_autoplay_enable'			=> (bool) false,
		'slider_excerpt_length'				=> 25,
		'slider_btn_txt'                    => esc_html__('Purchase','music-zone'),
		'slider_btn_alt_txt'                => esc_html__('View More','music-zone'),

		//service
		'service_section_enable'		    => (bool) false,
		'service_section_title'			    => esc_html__( 'What We Do', 'music-zone' ),
		'service_section_sub_title'			=> esc_html__( 'Services', 'music-zone' ),
		'service_posts_count'			    => 3,
		'service_excerpt_length'			=> 20,
		
		// Playlist
		'music_player_section_enable'		=> (bool) false,
        'playlist_section_enable'		    => (bool) false,
        'playlist_title'				    => esc_html__( 'Audio Tracks', 'music-zone' ),
        'playlist_subtitle'				    => esc_html__( 'Playlist', 'music-zone' ),

		// promotion
	   'promotion_section_enable'			=> false,
	   'promotion_title'					=> esc_html__( 'Maroon 6 Live Show', 'music-zone' ),
	   'promotion_subtitle'				    => esc_html__( 'Music is a world within itself', 'music-zone' ),
	   'promotion_description'				=> esc_html__( 'DJ Beat$’s life has been a tale of excess and indulgence. Beat$ dominated the 2000s producing hits for artists like Beyoncé, 50 Cent and Lil’ Kim. Despite his hardships, Beat$ had one of the most prolific runs of any hip-hop produce.', 'music-zone' ),

		// Recent Product
		'recent_product_section_enable'		=> false,
		'recent_product_content_type'		=> 'product-category',
		'recent_product_count'				=> 4,
		'recent_product_title'				=> esc_html__( 'Shop Our Products', 'music-zone' ),
		'recent_product_subtitle'			=> esc_html__( 'Discover our latest products', 'music-zone' ),

		// Event
		'event_section_enable'			    => false,
		'event_count'					    => 3,
		'event_title'					    => esc_html__( 'Upcoming Events', 'music-zone' ),
		'event_subtitle'				    => esc_html__( 'Amazing shows around 2019', 'music-zone' ),
		'event_readmore'				    => esc_html__( 'Buy Ticket', 'music-zone' ),
		'event_btn_title'				    => esc_html__( 'View All Events', 'music-zone' ),

		//counter 
		'counter_section_enable'			=> false,
		'counter_count'						=> 4,

		// Subscription
		'subscription_section_enable'	    => false,
		'subscription_title'			    => esc_html__( 'Don’t miss any updates, grab our monthly newsletter', 'music-zone' ),
		'subscription_subtitle'			    => esc_html__( 'Subscribe now and stay tuned', 'music-zone' ),

		// latest posts
		'latest_posts_section_enable'	    => false,
		'latest_posts_content_type'		    => 'category',
		'latest_posts_count'			    => 3,
		'latest_posts_title'			    => esc_html__( 'Our Latest Posts', 'music-zone' ),
		'latest_posts_subtitle'			    => esc_html__( 'Check our latest posts, resources and more', 'music-zone' ),
		'latest_posts_btn_title'		    => esc_html__( 'Learn More', 'music-zone' ),
	);

$output = apply_filters( 'music_zone_default_theme_options', $music_zone_default_options );

	// Sort array in ascending order, according to the key:
if ( ! empty( $output ) ) {
	ksort( $output );
}

return $output;
}