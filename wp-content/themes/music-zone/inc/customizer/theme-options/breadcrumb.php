<?php
/**
 * Breadcrumb options
 *
 * @package Theme Palace
 * @subpackage  Music Zone
 * @since  Music Zone 1.0.0
 */

$wp_customize->add_section( 'music_zone_breadcrumb',
	array(
		'title'             => esc_html__( 'Breadcrumb','music-zone' ),
		'description'       => esc_html__( 'Breadcrumb section options.', 'music-zone' ),
		'panel'             => 'music_zone_theme_options_panel',
	)
);

// Breadcrumb enable setting and control.
$wp_customize->add_setting( 'music_zone_theme_options[breadcrumb_enable]',
	array(
		'sanitize_callback' => 'music_zone_sanitize_switch_control',
		'default'          	=> $options['breadcrumb_enable'],
	)
);

$wp_customize->add_control( new  music_zone_Switch_Control( $wp_customize,
	'music_zone_theme_options[breadcrumb_enable]',
		array(
			'label'            	=> esc_html__( 'Enable Breadcrumb', 'music-zone' ),
			'section'          	=> 'music_zone_breadcrumb',
			'on_off_label' 		=> music_zone_switch_options(),
		)
	)
);

// Breadcrumb separator setting and control.
$wp_customize->add_setting( 'music_zone_theme_options[breadcrumb_separator]',
	array(
		'sanitize_callback'	=> 'sanitize_text_field',
		'default'          	=> $options['breadcrumb_separator'],
	)
);

$wp_customize->add_control( 'music_zone_theme_options[breadcrumb_separator]',
	array(
		'label'            	=> esc_html__( 'Separator', 'music-zone' ),
		'active_callback' 	=> 'music_zone_is_breadcrumb_enable',
		'section'          	=> 'music_zone_breadcrumb',
	)
);
