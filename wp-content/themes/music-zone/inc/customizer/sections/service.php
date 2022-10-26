<?php
/**
 * Service Section options
 *
 * @package Theme Palace
 * @subpackage  Music Zone Pro
 * @since  Music Zone Pro 1.0.0
 */

// Add Service section
$wp_customize->add_section( 'music_zone_service_section', 
	array(
		'title'             => esc_html__( 'Services','music-zone' ),
		'description'       => esc_html__( 'Services Section options.', 'music-zone' ),
		'panel'             => 'music_zone_front_page_panel',
		'priority'			=> 30,
	) 
);

// Service content enable control and setting
$wp_customize->add_setting( 'music_zone_theme_options[service_section_enable]', 
	array(
		'default'			=> 	$options['service_section_enable'],
		'sanitize_callback' => 'music_zone_sanitize_switch_control',
	) 
);

$wp_customize->add_control( new  music_zone_Switch_Control( $wp_customize,
	'music_zone_theme_options[service_section_enable]', 
		array(
			'label'             => esc_html__( 'Service Section Enable', 'music-zone' ),
			'section'           => 'music_zone_service_section',
			'on_off_label' 		=> music_zone_switch_options(),
		) 
	)
);

if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'music_zone_theme_options[service_section_enable]', array(
		'selector' => '.service-section .tooltiptext',
		'settings' => 'music_zone_theme_options[service_section_enable]',
    ) );
}

$wp_customize->add_setting( 'music_zone_theme_options[service_section_sub_title]',
	array(
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
		'default'           => $options['service_section_sub_title'],
	)

);

$wp_customize->add_control( 'music_zone_theme_options[service_section_sub_title]',
	array(
		'label'           => esc_html__( 'Section Sub Title', 'music-zone' ),
		'section'         => 'music_zone_service_section',
		'type'            => 'text',
		'active_callback' => 'music_zone_is_service_section_enable',
	)

);

if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'music_zone_theme_options[service_section_sub_title]', array(
		'selector'            => '#music_zone_service_section p.section-subtitle',
		'settings'            => 'music_zone_theme_options[service_section_sub_title]',
		'fallback_refresh'    => true,
		'container_inclusive' => false,
		'validate_callback'   => 'music_zone_service_section_sub_title_partial',
    ) );
}


$wp_customize->add_setting( 'music_zone_theme_options[service_section_title]',
	array(
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
		'default'           => $options['service_section_title'],
	)
);

$wp_customize->add_control( 'music_zone_theme_options[service_section_title]',
	array(
		'label'           => esc_html__( 'Section Title', 'music-zone' ),
		'section'         => 'music_zone_service_section',
		'type'            => 'text',
		'active_callback' => 'music_zone_is_service_section_enable',
	)
);

if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'music_zone_theme_options[service_section_title]', array(
		'selector'            => '#music_zone_service_section h2.section-title',
		'settings'            => 'music_zone_theme_options[service_section_title]',
		'fallback_refresh'    => true,
		'container_inclusive' => false,
		'validate_callback'   => 'music_zone_service_section_title_partial',
    ) );
}

for ($i = 1; $i <= 3; $i++ ):

	// service note control and setting
	$wp_customize->add_setting( 'music_zone_theme_options[service_content_icon_' . $i . ']', array(
		'sanitize_callback' => 'sanitize_text_field',
		) );

$wp_customize->add_control( new Music_Zone_Icon_Picker( $wp_customize, 'music_zone_theme_options[service_content_icon_' . $i . ']', array(
	'label'             => sprintf( esc_html__( 'Select Icon %d', 'music-zone' ), $i ),
	'section'           => 'music_zone_service_section',
	'active_callback'	=> 'music_zone_is_service_section_enable',
	) ) );

    // service pages drop down chooser control and setting
	$wp_customize->add_setting( 'music_zone_theme_options[service_content_page_'.$i.']',
		array(
			'sanitize_callback' => 'music_zone_sanitize_page',
		) 
	);

	$wp_customize->add_control( new  music_zone_Dropdown_Chooser( $wp_customize,
		'music_zone_theme_options[service_content_page_'.$i.']',
			array(
				'label'             => sprintf(esc_html__( 'Select Page : %d', 'music-zone'), $i ),
				'section'           => 'music_zone_service_section',
				'choices'			=> music_zone_page_choices(),
				'active_callback'	=> 'music_zone_is_service_section_enable',
			) 
		)
	);

endfor;