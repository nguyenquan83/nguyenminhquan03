<?php
/**
 * Layout options
 *
 * @package Theme Palace
 * @subpackage  Music Zone
 * @since  Music Zone 1.0.0
 */

// Add sidebar section
$wp_customize->add_section( 'music_zone_layout',
	array(
		'title'               => esc_html__('Layout','music-zone'),
		'description'         => esc_html__( 'Layout section options.', 'music-zone' ),
		'panel'               => 'music_zone_theme_options_panel',
	)
);

// Site layout setting and control.
$wp_customize->add_setting( 'music_zone_theme_options[site_layout]',
	array(
		'sanitize_callback'   => 'music_zone_sanitize_select',
		'default'             => $options['site_layout'],
	)
);

$wp_customize->add_control(  new Music_Zone_Custom_Radio_Image_Control ( $wp_customize,
	'music_zone_theme_options[site_layout]',
		array(
			'label'               => esc_html__( 'Site Layout', 'music-zone' ),
			'section'             => 'music_zone_layout',
			'choices'			  => music_zone_site_layout(),
		)
	)
);

// Sidebar position setting and control.
$wp_customize->add_setting( 'music_zone_theme_options[sidebar_position]',
	array(
		'sanitize_callback'   => 'music_zone_sanitize_select',
		'default'             => $options['sidebar_position'],
	)
);

$wp_customize->add_control(  new Music_Zone_Custom_Radio_Image_Control ( $wp_customize,
	'music_zone_theme_options[sidebar_position]',
		array(
			'label'               => esc_html__( 'Global Sidebar Position', 'music-zone' ),
			'section'             => 'music_zone_layout',
			'choices'			  => music_zone_global_sidebar_position(),
		)
	)
);

// Post sidebar position setting and control.
$wp_customize->add_setting( 'music_zone_theme_options[post_sidebar_position]',
	array(
		'sanitize_callback'   => 'music_zone_sanitize_select',
		'default'             => $options['post_sidebar_position'],
	)
);

$wp_customize->add_control(  new Music_Zone_Custom_Radio_Image_Control ( $wp_customize,
	'music_zone_theme_options[post_sidebar_position]',
		array(
			'label'               => esc_html__( 'Posts Sidebar Position', 'music-zone' ),
			'section'             => 'music_zone_layout',
			'choices'			  => music_zone_sidebar_position(),
		)
	)
);

// Post sidebar position setting and control.
$wp_customize->add_setting( 'music_zone_theme_options[page_sidebar_position]',
	array(
		'sanitize_callback'   => 'music_zone_sanitize_select',
		'default'             => $options['page_sidebar_position'],
	)
);

$wp_customize->add_control( new Music_Zone_Custom_Radio_Image_Control( $wp_customize,
	'music_zone_theme_options[page_sidebar_position]',
		array(
			'label'               => esc_html__( 'Pages Sidebar Position', 'music-zone' ),
			'section'             => 'music_zone_layout',
			'choices'			  => music_zone_sidebar_position(),
		)
	)
);