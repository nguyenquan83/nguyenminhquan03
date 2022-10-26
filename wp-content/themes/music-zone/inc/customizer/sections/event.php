<?php
/**
 * Event Section options
 *
 * @package Theme Palace
 * @subpackage Music Zone Pro
 * @since Music Zone Pro 1.0.0
 */

// Add Event section
$wp_customize->add_section( 'music_zone_event_section', array(
	'title'             => esc_html__( 'Event','music-zone' ),
	'description'       => esc_html__( 'Event Section options.', 'music-zone' ),
	'panel'             => 'music_zone_front_page_panel',
	'priority'			=> 70,
) );

// Event content enable control and setting
$wp_customize->add_setting( 'music_zone_theme_options[event_section_enable]', array(
	'default'			=> 	$options['event_section_enable'],
	'sanitize_callback' => 'music_zone_sanitize_switch_control',
) );

$wp_customize->add_control( new Music_Zone_Switch_Control( $wp_customize, 'music_zone_theme_options[event_section_enable]', array(
	'label'             => esc_html__( 'Event Section Enable', 'music-zone' ),
	'section'           => 'music_zone_event_section',
	'on_off_label' 		=> music_zone_switch_options(),
) ) );

if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'music_zone_theme_options[event_section_enable]', array(
		'selector'      => '#music_zone_event_section .tooltiptext',
		'settings'      => 'music_zone_theme_options[event_section_enable]',
    ) );
}

// Event background image control and setting
$wp_customize->add_setting( 'music_zone_theme_options[event_bg_image]', array(
	'sanitize_callback' => 'music_zone_sanitize_image'
) );

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'music_zone_theme_options[event_bg_image]',
		array(
		'label'       		=> esc_html__( 'Bg Image', 'music-zone' ),
		'section'     		=> 'music_zone_event_section',
		'active_callback'	=> 'music_zone_is_event_section_enable',
) ) );


// event title setting and control
$wp_customize->add_setting( 'music_zone_theme_options[event_title]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=> $options['event_title'],
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'music_zone_theme_options[event_title]', array(
	'label'           	=> esc_html__( 'Title', 'music-zone' ),
	'section'        	=> 'music_zone_event_section',
	'active_callback' 	=> 'music_zone_is_event_section_enable',
	'type'				=> 'text',
) );

if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'music_zone_theme_options[event_title]', array(
		'selector'            => '#music_zone_event_section .section-title',
		'settings'            => 'music_zone_theme_options[event_title]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'music_zone_event_title_partial',
    ) );
}


// event subtitle setting and control
$wp_customize->add_setting( 'music_zone_theme_options[event_subtitle]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=> $options['event_subtitle'],
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'music_zone_theme_options[event_subtitle]', array(
	'label'           	=> esc_html__( 'Sub Title', 'music-zone' ),
	'section'        	=> 'music_zone_event_section',
	'active_callback' 	=> 'music_zone_is_event_section_enable',
	'type'				=> 'text',
) );

if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'music_zone_theme_options[event_subtitle]', array(
		'selector'            => '#music_zone_event_section .section-subtitle',
		'settings'            => 'music_zone_theme_options[event_subtitle]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'music_zone_event_subtitle_partial',
    ) );
}

// event readmore setting and control
$wp_customize->add_setting( 'music_zone_theme_options[event_readmore]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=> $options['event_readmore'],
) );

$wp_customize->add_control( 'music_zone_theme_options[event_readmore]', array(
	'label'           	=> esc_html__( 'Read More Label', 'music-zone' ),
	'section'        	=> 'music_zone_event_section',
	'active_callback' 	=> 'music_zone_is_event_section_enable',
	'type'				=> 'text',
) );

for ( $i = 1; $i <= 4; $i++ ) :

	// event posts drop down chooser control and setting
	$wp_customize->add_setting( 'music_zone_theme_options[event_content_page_' . $i . ']', array(
		'sanitize_callback' => 'music_zone_sanitize_page',
	) );

	$wp_customize->add_control( new Music_Zone_Dropdown_Chooser( $wp_customize, 'music_zone_theme_options[event_content_page_' . $i . ']', array(
		'label'             => sprintf( esc_html__( 'Select Page %d', 'music-zone' ), $i ),
		'section'           => 'music_zone_event_section',
		'choices'			=> music_zone_page_choices(),
		'active_callback'	=> 'music_zone_is_event_section_enable',
	) ) );

		// album subtitle setting and control
	$wp_customize->add_setting( 'music_zone_theme_options[event_location_' . $i . ']', array(
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'music_zone_theme_options[event_location_' . $i . ']', array(
		'label'           	=> sprintf( esc_html__( 'Event Location %d', 'music-zone' ), $i ),
		'section'        	=> 'music_zone_event_section',
		'active_callback' 	=> 'music_zone_is_event_section_enable',
		'type'				=> 'text',
	) );

endfor;

