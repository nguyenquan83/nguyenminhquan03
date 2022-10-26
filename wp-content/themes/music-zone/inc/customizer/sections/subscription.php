<?php
/**
 * Subscription Section options
 *
 * @package Theme Palace
 * @subpackage Music Zone Pro
 * @since Music Zone Pro 1.0.0
 */

// Add Subscription section
$wp_customize->add_section( 'music_zone_subscription_section', array(
	'title'             => esc_html__( 'Subscription','music-zone' ),
	'description'       => esc_html__( 'Note: To activate this section you need to install Jetpack Plugin and activate subscription module.', 'music-zone' ),
	'panel'             => 'music_zone_front_page_panel',
	'priority'			=> 90,
) );

// Subscription content enable control and setting
$wp_customize->add_setting( 'music_zone_theme_options[subscription_section_enable]', array(
	'default'			=> 	$options['subscription_section_enable'],
	'sanitize_callback' => 'music_zone_sanitize_switch_control',
) );

$wp_customize->add_control( new Music_Zone_Switch_Control( $wp_customize, 'music_zone_theme_options[subscription_section_enable]', array(
	'label'             => esc_html__( 'Subscription Section Enable', 'music-zone' ),
	'section'           => 'music_zone_subscription_section',
	'on_off_label' 		=> music_zone_switch_options(),
) ) );

if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'music_zone_theme_options[subscription_section_enable]', array(
		'selector'            => '.subscription-section .tooltiptext',
		'settings'            => 'music_zone_theme_options[subscription_section_enable]',
    ) );
}

// Subscription background image control and setting
$wp_customize->add_setting( 'music_zone_theme_options[subscription_bg_image]', array(
	'sanitize_callback' => 'music_zone_sanitize_image'
) );

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'music_zone_theme_options[subscription_bg_image]',
		array(
		'label'       		=> esc_html__( 'Bg Image', 'music-zone' ),
		'section'     		=> 'music_zone_subscription_section',
		'active_callback'	=> 'music_zone_is_subscription_section_enable',
) ) );


// subscription title setting and control
$wp_customize->add_setting( 'music_zone_theme_options[subscription_title]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=> $options['subscription_title'],
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'music_zone_theme_options[subscription_title]', array(
	'label'           	=> esc_html__( 'Title', 'music-zone' ),
	'section'        	=> 'music_zone_subscription_section',
	'active_callback' 	=> 'music_zone_is_subscription_section_enable',
	'type'				=> 'text',
) );

// subscription subtitle setting and control
$wp_customize->add_setting( 'music_zone_theme_options[subscription_subtitle]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=> $options['subscription_subtitle'],
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'music_zone_theme_options[subscription_subtitle]', array(
	'label'           	=> esc_html__( 'Sub Title', 'music-zone' ),
	'section'        	=> 'music_zone_subscription_section',
	'active_callback' 	=> 'music_zone_is_subscription_section_enable',
	'type'				=> 'text',
) );
