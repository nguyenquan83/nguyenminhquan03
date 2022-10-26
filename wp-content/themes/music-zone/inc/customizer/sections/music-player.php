<?php
/**
 * Playlist Section options
 *
 * @package Theme Palace
 * @subpackage Music Zone Pro
 * @since Music Zone Pro 1.0.0
 */

// Add Playlist section
$wp_customize->add_section( 'music_zone_music_player_section', array(
	'title'             => esc_html__( 'Music Player','music-zone' ),
	'description'       => esc_html__( 'Music Player options.', 'music-zone' ),
	'panel'             => 'music_zone_front_page_panel',
	'priority'			=> 20,
) );

// Playlist content enable control and setting
$wp_customize->add_setting( 'music_zone_theme_options[music_player_section_enable]', array(
	'default'			=> 	$options['music_player_section_enable'],
	'sanitize_callback' => 'music_zone_sanitize_switch_control',
) );

$wp_customize->add_control( new Music_Zone_Switch_Control( $wp_customize, 'music_zone_theme_options[music_player_section_enable]', array(
	'label'             => esc_html__( 'Music Player Enable', 'music-zone' ),
	'section'           => 'music_zone_music_player_section',
	'on_off_label' 		=> music_zone_switch_options(),
) ) );