<?php
/**
 * Promotion Section options
 *
 * @package Theme Palace
 * @subpackage Music Zone Pro
 * @since Music Zone Pro 1.0.0
 */

// Add Promotion section
$wp_customize->add_section( 'music_zone_promotion_section', array(
	'title'             => esc_html__( 'Promotion','music-zone' ),
	'description'       => esc_html__( 'Promotion Section options.', 'music-zone' ),
	'panel'             => 'music_zone_front_page_panel',
	'priority'			=> 50,
) );

// Promotion content enable control and setting
$wp_customize->add_setting( 'music_zone_theme_options[promotion_section_enable]', array(
	'default'			=> 	$options['promotion_section_enable'],
	'sanitize_callback' => 'music_zone_sanitize_switch_control',
) );

$wp_customize->add_control( new Music_Zone_Switch_Control( $wp_customize, 'music_zone_theme_options[promotion_section_enable]', array(
	'label'             => esc_html__( 'Promotion Section Enable', 'music-zone' ),
	'section'           => 'music_zone_promotion_section',
	'on_off_label' 		=> music_zone_switch_options(),
) ) );

if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'music_zone_theme_options[promotion_section_enable]', array(
		'selector'            => '.promotion-section .tooltiptext',
		'settings'            => 'music_zone_theme_options[promotion_section_enable]',
    ) );
}

// promotion pages drop down chooser control and setting
$wp_customize->add_setting( 'music_zone_theme_options[promotion_content_page]', array(
	'sanitize_callback' => 'music_zone_sanitize_page',
) );

$wp_customize->add_control( new Music_Zone_Dropdown_Chooser( $wp_customize, 'music_zone_theme_options[promotion_content_page]', array(
	'label'             => esc_html__( 'Select Page', 'music-zone' ),
	'section'           => 'music_zone_promotion_section',
	'choices'			=> music_zone_page_choices(),
	'active_callback'	=> 'music_zone_is_promotion_section_enable',
) ) );

// promotion btn title setting and control
$wp_customize->add_setting( 'music_zone_theme_options[promotion_btn_title]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'music_zone_theme_options[promotion_btn_title]', array(
	'label'           	=> esc_html__( 'Button Label', 'music-zone' ),
	'section'        	=> 'music_zone_promotion_section',
	'type'				=> 'text',
	'active_callback' 	=>  'music_zone_is_promotion_section_enable',
) );

if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'music_zone_theme_options[promotion_btn_title]', array(
		'selector'      => '#music_zone_promotion_section .read-more .btn',
		'settings'      => 'music_zone_theme_options[promotion_btn_title]',
    ) );
}