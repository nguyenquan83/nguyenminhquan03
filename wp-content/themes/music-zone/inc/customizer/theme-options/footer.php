<?php
/**
 * Footer options
 *
 * @package Theme Palace
 * @subpackage  Music Zone
 * @since  Music Zone 1.0.0
 */

// Footer Section
$wp_customize->add_section( 'music_zone_section_footer',
	array(
		'title'      			=> esc_html__( 'Footer Options', 'music-zone' ),
		'priority'   			=> 900,
		'panel'      			=> 'music_zone_theme_options_panel',
	)
);

// footer text
$wp_customize->add_setting( 'music_zone_theme_options[copyright_text]',
	array(
		'default'       		=> $options['copyright_text'],
		'sanitize_callback'		=> 'music_zone_santize_allow_tag',
		'transport'				=> 'postMessage',
	)
);

$wp_customize->add_control( 'music_zone_theme_options[copyright_text]',
    array(
		'label'      			=> esc_html__( 'Copyright Text', 'music-zone' ),
		'section'    			=> 'music_zone_section_footer',
		'type'		 			=> 'textarea',
    )
);

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'music_zone_theme_options[copyright_text]',
		array(
			'selector'            => '.site-info .wrapper',
			'settings'            => 'music_zone_theme_options[copyright_text]',
			'container_inclusive' => false,
			'fallback_refresh'    => true,
			'render_callback'     => 'music_zone_copyright_text_partial',
		)
	);
}

// scroll top visible
$wp_customize->add_setting( 'music_zone_theme_options[scroll_top_visible]',
	array(
		'default'       	=> $options['scroll_top_visible'],
		'sanitize_callback' => 'music_zone_sanitize_switch_control',
	)
);

$wp_customize->add_control( new  music_zone_Switch_Control( $wp_customize,
	'music_zone_theme_options[scroll_top_visible]',
		array(
			'label'      		=> esc_html__( 'Display Scroll Top Button', 'music-zone' ),
			'section'    		=> 'music_zone_section_footer',
			'on_off_label' 		=> music_zone_switch_options(),
		)
	)
);
