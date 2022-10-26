<?php

if ( ! function_exists( 'just_music_enqueue_styles' ) ) :

	function just_music_enqueue_styles() {
		wp_enqueue_style( 'just-music-style-parent', get_template_directory_uri() . '/style.css' );

		wp_enqueue_style( 'just-music-style', get_stylesheet_directory_uri() . '/style.css', array( 'just-music-style-parent' ), '1.0.0' );
	}

endif;

add_action( 'wp_enqueue_scripts', 'just_music_enqueue_styles', 99 );

function just_music_customize_control_style() {

	wp_enqueue_style( 'just-music-customize-controls', get_theme_file_uri() . '/customizer-control.css' );

}
add_action( 'customize_controls_enqueue_scripts', 'just_music_customize_control_style' );

require get_theme_file_path() . '/inc/customizer.php';

require get_theme_file_path() . '/inc/front-sections/album.php';

require get_theme_file_path() . '/inc/front-sections/about.php';