<?php
/**
 * Slider Section options
 *
 * @package Theme Palace
 * @subpackage  Music Zone
 * @since  Music Zone 1.0.0
 */

// Add Slider section
$wp_customize->add_section( 'music_zone_slider_section',
	array(
		'title'             => esc_html__( 'Slider','music-zone' ),
		'description'       => esc_html__( 'Slider Section options.', 'music-zone' ),
		'panel'             => 'music_zone_front_page_panel',
		'priority'			=> 10,
	)
);

// Slider content enable control and setting
$wp_customize->add_setting( 'music_zone_theme_options[slider_section_enable]', 
	array(
		'default'			=> 	$options['slider_section_enable'],
		'sanitize_callback' => 'music_zone_sanitize_switch_control',
	) 
);

$wp_customize->add_control( new  music_zone_Switch_Control( $wp_customize,
	'music_zone_theme_options[slider_section_enable]',
		array(
			'label'             => esc_html__( 'Slider Section Enable', 'music-zone' ),
			'section'           => 'music_zone_slider_section',
			'on_off_label' 		=> music_zone_switch_options(),
		)
	)
);

if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'music_zone_theme_options[slider_section_enable]', array(
		'selector'            => '.slider-section .tooltiptext',
		'settings'            => 'music_zone_theme_options[slider_section_enable]',
    ) );
}


// Slider autoplay enable control and setting
$wp_customize->add_setting( 'music_zone_theme_options[slider_autoplay_enable]',
	array(
		'default'			=> 	$options['slider_autoplay_enable'],
		'sanitize_callback' => 'music_zone_sanitize_switch_control',

	)
);

$wp_customize->add_control( new  music_zone_Switch_Control( $wp_customize,
	'music_zone_theme_options[slider_autoplay_enable]',
		array(
			'label'             => esc_html__( 'Slider Autoplay Enable', 'music-zone' ),
			'section'           => 'music_zone_slider_section',
			'active_callback'   => 'music_zone_is_slider_section_enable',
			'on_off_label' 		=> music_zone_switch_options(),
		)
	)
);

for ( $i = 1; $i <= 3; $i++ ) :

	// slider pages drop down chooser control and setting
	$wp_customize->add_setting( 'music_zone_theme_options[slider_content_page_'. $i .']', 
		array(
			'sanitize_callback' => 'music_zone_sanitize_page',
		)
	);

	$wp_customize->add_control( new  music_zone_Dropdown_Chooser( $wp_customize,
		'music_zone_theme_options[slider_content_page_'. $i .']', 
			array(
				'label'             => sprintf(esc_html__( 'Select Page: %d', 'music-zone'), $i ),
				'section'           => 'music_zone_slider_section',
				'choices'			=> music_zone_page_choices(),
				'active_callback'	=> 'music_zone_is_slider_section_enable',
			)
		)
	);

endfor; 

//slider_btn_txt
$wp_customize->add_setting('music_zone_theme_options[slider_btn_txt]',
    array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'			=> 'postMessage',
        'default'           => $options['slider_btn_txt'],
    )
);

$wp_customize->add_control('music_zone_theme_options[slider_btn_txt]',
    array(
        'section'			=> 'music_zone_slider_section',
        'label'				=> esc_html__( 'Button Text:', 'music-zone' ),
        'type'          	=>'text',
        'active_callback' 	=> 'music_zone_is_slider_section_enable'
    )
);

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'music_zone_theme_options[slider_btn_txt]',
		array(
			'selector'            => '#music_zone_slider_section .read-more .first',
			'settings'            => 'music_zone_theme_options[slider_btn_txt]',
			'fallback_refresh'    => true,
			'container_inclusive' => false,
			'render_callback'     => 'music_zone_slider_btn_txt_partial',
		) 
	);
}

//slider_btn_alt_txt
$wp_customize->add_setting('music_zone_theme_options[slider_btn_alt_txt]',
    array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'			=> 'postMessage',
        'default'           => $options['slider_btn_alt_txt'],
    )
);

$wp_customize->add_control('music_zone_theme_options[slider_btn_alt_txt]',
    array(
        'section'			=> 'music_zone_slider_section',
        'label'				=> esc_html__( 'Button Alt Text:', 'music-zone' ),
        'type'          	=>'text',
        'active_callback' 	=> 'music_zone_is_slider_section_enable'
    )
);

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'music_zone_theme_options[slider_btn_alt_txt]',
		array(
			'selector'            => '#music_zone_slider_section .read-more .second',
			'settings'            => 'music_zone_theme_options[slider_btn_alt_txt]',
			'fallback_refresh'    => true,
			'container_inclusive' => false,
			'render_callback'     => 'music_zone_slider_btn_alt_txt_partial',
		) 
	);
}

$wp_customize->add_setting( 'music_zone_theme_options[slider_btn_alt_url]',
    array(
        'sanitize_callback' => 'esc_url_raw',
    )
);

$wp_customize->add_control( 'music_zone_theme_options[slider_btn_alt_url]',
    array(
        'label'           	=> esc_html__( 'Button Alt URL', 'music-zone' ),
        'section'        	=> 'music_zone_slider_section',
        'active_callback' 	=> 'music_zone_is_slider_section_enable',
        'type'				=> 'url',
    ) 
);
