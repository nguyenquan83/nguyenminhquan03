<?php
/**
 * Excerpt options
 *
 * @package Theme Palace
 * @subpackage  Music Zone
 * @since  Music Zone 1.0.0
 */

// Add excerpt section
$wp_customize->add_section( 'music_zone_single_post_section',
	array(
		'title'             => esc_html__( 'Single Post','music-zone' ),
		'description'       => esc_html__( 'Options to change the single posts globally.', 'music-zone' ),
		'panel'             => 'music_zone_theme_options_panel',
	)
);

$wp_customize->add_setting( 'music_zone_theme_options[single_post_hide_banner]', array(
	'default'           => $options['single_post_hide_banner'],
	'sanitize_callback' => 'music_zone_sanitize_switch_control',
) );

$wp_customize->add_control( new Music_Zone_Switch_Control( $wp_customize, 'music_zone_theme_options[single_post_hide_banner]', array(
	'label'             => esc_html__( 'Hide Banner', 'music-zone' ),
	'section'           => 'music_zone_single_post_section',
	'on_off_label' 		=> music_zone_hide_options(),
) ) );

// Archive date meta setting and control.
$wp_customize->add_setting( 'music_zone_theme_options[single_post_hide_date]',
	array(
		'default'           => $options['single_post_hide_date'],
		'sanitize_callback' => 'music_zone_sanitize_switch_control',
	)
);

$wp_customize->add_control( new Music_Zone_Switch_Control( $wp_customize,
	'music_zone_theme_options[single_post_hide_date]',
		array(
			'label'             => esc_html__( 'Hide Date', 'music-zone' ),
			'section'           => 'music_zone_single_post_section',
			'on_off_label' 		=> music_zone_hide_options(),
		)
	)
);