<?php
/**
 * pagination options
 *
 * @package Theme Palace
 * @subpackage  Music Zone
 * @since  Music Zone 1.0.0
 */

// Add sidebar section
$wp_customize->add_section( 'music_zone_pagination',
	array(
		'title'               	=> esc_html__('Pagination','music-zone'),
		'description'         	=> esc_html__( 'Pagination section options.', 'music-zone' ),
		'panel'               	=> 'music_zone_theme_options_panel',
	)
);

// Sidebar position setting and control.
$wp_customize->add_setting( 'music_zone_theme_options[pagination_enable]',
	array(
		'sanitize_callback' 	=> 'music_zone_sanitize_switch_control',
		'default'             	=> $options['pagination_enable'],
	)
);

$wp_customize->add_control( new  music_zone_Switch_Control( $wp_customize,
	'music_zone_theme_options[pagination_enable]',
		array(
			'label'               	=> esc_html__( 'Pagination Enable', 'music-zone' ),
			'section'             	=> 'music_zone_pagination',
			'on_off_label' 			=> music_zone_switch_options(),
		)
	)
);

// Site layout setting and control.
$wp_customize->add_setting( 'music_zone_theme_options[pagination_type]',
	array(
		'sanitize_callback'   	=> 'music_zone_sanitize_select',
		'default'             	=> $options['pagination_type'],
	)
);

$wp_customize->add_control( 'music_zone_theme_options[pagination_type]',
	array(
		'label'               	=> esc_html__( 'Pagination Type', 'music-zone' ),
		'section'             	=> 'music_zone_pagination',
		'type'                	=> 'select',
		'choices'			  	=> music_zone_pagination_options(),
		'active_callback'	  	=> 'music_zone_is_pagination_enable',
	)
);
