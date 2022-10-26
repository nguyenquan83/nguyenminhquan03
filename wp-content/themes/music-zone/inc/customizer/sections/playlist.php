<?php
/**
 * Playlist Section options
 *
 * @package Theme Palace
 * @subpackage Music Zone Pro
 * @since Music Zone Pro 1.0.0
 */

// Add Playlist section
$wp_customize->add_section( 'music_zone_playlist_section', array(
	'title'             => esc_html__( 'Playlist','music-zone' ),
	'description'       => esc_html__( 'Playlist Section options.', 'music-zone' ),
	'panel'             => 'music_zone_front_page_panel',
	'priority'			=> 40,
) );

// Playlist content enable control and setting
$wp_customize->add_setting( 'music_zone_theme_options[playlist_section_enable]', array(
	'default'			=> 	$options['playlist_section_enable'],
	'sanitize_callback' => 'music_zone_sanitize_switch_control',
) );

$wp_customize->add_control( new Music_Zone_Switch_Control( $wp_customize, 'music_zone_theme_options[playlist_section_enable]', array(
	'label'             => esc_html__( 'Playlist Section Enable', 'music-zone' ),
	'section'           => 'music_zone_playlist_section',
	'on_off_label' 		=> music_zone_switch_options(),
) ) );

if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'music_zone_theme_options[playlist_section_enable]', array(
		'selector'            => '.playlist-section .tooltiptext',
		'settings'            => 'music_zone_theme_options[playlist_section_enable]',
    ) );
}


// playlist title setting and control
$wp_customize->add_setting( 'music_zone_theme_options[playlist_title]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=> $options['playlist_title'],
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'music_zone_theme_options[playlist_title]', array(
	'label'           	=> esc_html__( 'Title', 'music-zone' ),
	'section'        	=> 'music_zone_playlist_section',
	'active_callback' 	=> 'music_zone_is_playlist_section_enable',
	'type'				=> 'text',
) );

if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'music_zone_theme_options[playlist_title]', array(
		'selector'            => '#music_zone_playlist_section .section-header .section-title',
		'settings'            => 'music_zone_theme_options[playlist_title]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'music_zone_playlist_subtitle_partial',
    ) );
}


// playlist subtitle setting and control
$wp_customize->add_setting( 'music_zone_theme_options[playlist_subtitle]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=> $options['playlist_subtitle'],
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'music_zone_theme_options[playlist_subtitle]', array(
	'label'           	=> esc_html__( 'Sub Title', 'music-zone' ),
	'section'        	=> 'music_zone_playlist_section',
	'active_callback' 	=> 'music_zone_is_playlist_section_enable',
	'type'				=> 'text',
) );

if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'music_zone_theme_options[playlist_subtitle]', array(
		'selector'            => '#music_zone_playlist_section .section-header .section-subtitle',
		'settings'            => 'music_zone_theme_options[playlist_subtitle]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'music_zone_playlist_subtitle_partial',
    ) );
}

$wp_customize->add_setting( 'music_zone_theme_options[playlist_bg_image]', array(
	'sanitize_callback' => 'music_zone_sanitize_image'
) );

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'music_zone_theme_options[playlist_bg_image]',
		array(
		'label'       		=> esc_html__( 'Bg Image', 'music-zone' ),
		'section'     		=> 'music_zone_playlist_section',
		'active_callback'	=> 'music_zone_is_playlist_section_enable',
) ) );


// playlist image setting and control.
$wp_customize->add_setting( 'music_zone_theme_options[playlist_image]', array(
	'sanitize_callback' => 'music_zone_sanitize_image'
) );

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'music_zone_theme_options[playlist_image]',
		array(
		'label'       		=> esc_html__( 'Featured Image', 'music-zone' ),
		'section'     		=> 'music_zone_playlist_section',
		'active_callback'	=> 'music_zone_is_playlist_section_enable',
) ) );

// playlist posts drop down chooser control and setting
$wp_customize->add_setting( 'music_zone_theme_options[playlist_content]', array(
	'sanitize_callback' => 'music_zone_sanitize_array_int',
) );

$wp_customize->add_control( new Music_Zone_Multiple_Dropdown_Chooser( $wp_customize, 'music_zone_theme_options[playlist_content]', array(
	'label'             => esc_html__( 'Select Multiple Audios', 'music-zone' ),
	'section'           => 'music_zone_playlist_section',
	'choices'			=> music_zone_audio_choices(),
	'active_callback'	=> 'music_zone_is_playlist_section_enable',
) ) );
