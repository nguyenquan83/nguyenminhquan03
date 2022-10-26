<?php

$wp_customize->add_section( 'music_zone_about_section', array(
	'title'             => esc_html__( 'About Us','just-music' ),
	'description'       => esc_html__( 'About Section options.', 'just-music' ),
	'panel'             => 'music_zone_front_page_panel',
	'priority'			=> 11,
) );


$wp_customize->add_setting( 'about_section_enable', array(
	'default'			=> 	false,
	'sanitize_callback' => 'music_zone_sanitize_switch_control',
) );

$wp_customize->add_control( new Just_Music_Switch_Control( $wp_customize, 'about_section_enable', array(
	'label'             => esc_html__( 'About Section Enable', 'just-music' ),
	'section'           => 'music_zone_about_section',
	'on_off_label' 		=> music_zone_switch_options(),
) ) );

if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'about_section_enable', array(
		'selector'      => '.about-section .tooltiptext',
		'settings'      => 'about_section_enable',
    ) );
}


$wp_customize->add_setting( 'about_subtitle', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=> '',
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'about_subtitle', array(
	'label'           	=> esc_html__( 'Sub Title', 'just-music' ),
	'section'        	=> 'music_zone_about_section',
	'active_callback' 	=> 'just_music_is_about_section_enable',
	'type'				=> 'text',
) );

if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'about_subtitle', array(
		'selector'            => '#music_zone_about_section p.section-subtitle',
		'settings'            => 'about_subtitle',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'music_zone_about_subtitle_partial',
    ) );
}

$wp_customize->add_setting( 'about_btn_label', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=> '',
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'about_btn_label', array(
	'label'           	=> esc_html__( 'Btn Label', 'just-music' ),
	'section'        	=> 'music_zone_about_section',
	'active_callback' 	=> 'just_music_is_about_section_enable',
	'type'				=> 'text',
) );

if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'about_btn_label', array(
		'selector'            => '#music_zone_about_section .read-more a',
		'settings'            => 'about_btn_label',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'music_zone_about_btn_label_partial',
    ) );
}

$wp_customize->add_setting( 'about_content_page', array(
	'sanitize_callback' => 'music_zone_sanitize_page',
) );

$wp_customize->add_control( new Just_Music_Dropdown_Chooser( $wp_customize, 'about_content_page', array(
	'label'             => esc_html__( 'Select Page', 'just-music' ),
	'section'           => 'music_zone_about_section',
	'choices'			=> music_zone_page_choices(),
	'active_callback'	=> 'just_music_is_about_section_enable',
) ) );

