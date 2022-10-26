<?php

$wp_customize->add_section( 'music_zone_album_section', array(
	'title'             => esc_html__( 'Recent Album','just-music' ),
	'description'       => esc_html__( 'Recent Album Section options.', 'just-music' ),
	'panel'             => 'music_zone_front_page_panel',
	'priority'			=> 12,
) );

$wp_customize->add_setting( 'album_section_enable', array(
	'default'			=>  false,
	'sanitize_callback' => 'music_zone_sanitize_switch_control',
) );

$wp_customize->add_control( new Just_Music_Switch_Control( $wp_customize, 'album_section_enable', array(
	'label'             => esc_html__( 'Recent Album Section Enable', 'just-music' ),
	'section'           => 'music_zone_album_section',
	'on_off_label' 		=> music_zone_switch_options(),
) ) );

if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'album_section_enable', array(
		'selector'      => '.album-section .tooltiptext',
		'settings'      => 'album_section_enable',
    ) );
}

$wp_customize->add_setting( 'album_title', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=> '',
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'album_title', array(
	'label'           	=> esc_html__( 'Title', 'just-music' ),
	'section'        	=> 'music_zone_album_section',
	'active_callback' 	=> 'juju_music_is_album_section_enable',
	'type'				=> 'text',
) );

if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'album_title', array(
		'selector'      => '#music_zone_album_section .section-header .section-title',
		'settings'      => 'album_title',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'music_zone_album_title_partial',
    ) );
}

$wp_customize->add_setting( 'album_subtitle', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=>'',
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'album_subtitle', array(
	'label'           	=> esc_html__( 'Sub Title', 'just-music' ),
	'section'        	=> 'music_zone_album_section',
	'active_callback' 	=> 'juju_music_is_album_section_enable',
	'type'				=> 'text',
) );

if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'album_subtitle', array(
		'selector'      => '#music_zone_album_section .section-header .section-subtitle',
		'settings'      => 'album_subtitle',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'music_zone_album_subtitle_partial',
    ) );
}

$wp_customize->add_setting( 'album_btn_title', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=> '',
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'album_btn_title', array(
	'label'           	=> esc_html__( 'Button Label', 'just-music' ),
	'section'        	=> 'music_zone_album_section',
	'active_callback' 	=> 'juju_music_is_album_section_enable',
	'type'				=> 'text',
) );

$wp_customize->add_setting( 'album_hr', array(
	'sanitize_callback' => 'sanitize_text_field',
) );

$wp_customize->add_control( new Just_Music_Customize_Horizontal_Line( $wp_customize, 'album_hr', array(
	'type'				=> 'hr',
	'section'           => 'music_zone_album_section',
	'active_callback'	=> 'juju_music_is_album_section_enable',
) ) );

for ( $i = 1; $i <= 3; $i++ ) :

	$wp_customize->add_setting( 'album_content_product_' . $i, array(
		'sanitize_callback' => 'music_zone_sanitize_page',
	) );

	$wp_customize->add_control( new Just_Music_Dropdown_Chooser( $wp_customize, 'album_content_product_' . $i, array(
		'label'             => sprintf( esc_html__( 'Select Product %d', 'just-music' ), $i ),
		'section'           => 'music_zone_album_section',
		'choices'			=> music_zone_product_choices(),
		'active_callback'	=> 'juju_music_is_album_section_enable',
	) ) );

	$wp_customize->add_setting( 'album_post_subtitle_' . $i, array(
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'album_post_subtitle_' . $i, array(
		'label'           	=> sprintf( esc_html__( 'Sub Title %d', 'just-music' ), $i ),
		'section'        	=> 'music_zone_album_section',
		'active_callback' 	=> 'juju_music_is_album_section_enable',
		'type'				=> 'text',
	) );

endfor;
