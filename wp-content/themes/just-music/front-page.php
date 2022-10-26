<?php
/**
 * The template for displaying al pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Theme Palace
 * @subpackage  Just Music
 * @since  Just Music 1.0.0
 */

get_header(); 
	// Call home if Homepage setting is set to latest posts.

	if ( music_zone_is_latest_posts() ) {
		get_template_part( 'template-parts/content', 'home' );

	} elseif ( music_zone_is_frontpage() ) {
		
		$options = music_zone_get_theme_options();

    	$sorted = explode( ',' , 'slider,about,album,playlist,recent_product,promotion,event,latest_posts' );

		foreach ( $sorted as $section ) {
			if ( in_array( $section, array( 'about', 'album' ) ) ) {
				add_action( 'music_zone_primary_content', 'just_music_add_'. $section .'_section' );
			}else{
				add_action( 'music_zone_primary_content', 'music_zone_add_'. $section .'_section' );
			}
			
		}
		do_action( 'music_zone_primary_content' );
		if ( $options['music_player_section_enable'] == true ): ?>
			<div id="music-player" class="relative">
	            <div class="wrapper">
	                <?php 
	                $args = array
				        (
				            'post_type' => 'attachment',
				            'post_mime_type' => 'audio',
				            'numberposts' => -1
				        );
				        $audiofiles = get_posts($args);
				        for ($i=0; $i < count( $audiofiles ) ; $i++) { 
				           $media_lists[$i] = $audiofiles[$i]->ID;
				       }

				    $play_list = implode(',', $media_lists    );
	                
	               
	                $playlist_shortcode = '[playlist type="audio" ids="' . $play_list . '" style="light"]';
	                echo do_shortcode( wp_kses_post( $playlist_shortcode ) );  
	                ?>
	            </div>
	        </div>
		<?php endif;
		if (true === apply_filters( 'music_zone_filter_frontpage_content_enable', true ) ) {
			get_template_part( 'page' );
		}
	}
get_footer();