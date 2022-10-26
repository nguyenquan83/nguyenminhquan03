<?php
/**
 * Excerpt options
 *
 * @package Theme Palace
 * @subpackage  Music Zone
 * @since  Music Zone 1.0.0
 */

// Add excerpt section
$wp_customize->add_section( 'music_zone_excerpt_section',
	array(
		'title'             => esc_html__( 'Excerpt','music-zone' ),
		'description'       => esc_html__( 'Excerpt section options.', 'music-zone' ),
		'panel'             => 'music_zone_theme_options_panel',
	)
);


// long Excerpt length setting and control.
$wp_customize->add_setting( 'music_zone_theme_options[long_excerpt_length]',
	array(
		'sanitize_callback' => 'music_zone_sanitize_number_range',
		'validate_callback' => 'music_zone_validate_long_excerpt',
		'default'			=> $options['long_excerpt_length'],
	)
);

$wp_customize->add_control( 'music_zone_theme_options[long_excerpt_length]',
	array(
		'label'       		=> esc_html__( 'Blog Page Excerpt Length', 'music-zone' ),
		'description' 		=> esc_html__( 'Total words to be displayed in archive page/search page.', 'music-zone' ),
		'section'     		=> 'music_zone_excerpt_section',
		'type'        		=> 'number',
		'input_attrs' 		=> array(
			'style'       => 'width: 80px;',
			'max'         => 100,
			'min'         => 5,
		),
	)
);
