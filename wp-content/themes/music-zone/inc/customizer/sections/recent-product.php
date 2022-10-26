<?php
/**
 * Product Section options
 *
 * @package Theme Palace
 * @subpackage Music Zone Pro
 * @since Music Zone Pro 1.0.0
 */

// Add Product section
$wp_customize->add_section( 'music_zone_recent_product_section', array(
	'title'             => esc_html__( 'Recent Product','music-zone' ),
	'description'       => esc_html__( 'Note: To activate this section you need to install WooCommerce Plugin.', 'music-zone' ),
	'panel'             => 'music_zone_front_page_panel',
	'priority'			=> 60,
) );

// Product content enable control and setting
$wp_customize->add_setting( 'music_zone_theme_options[recent_product_section_enable]', array(
	'default'			=> 	$options['recent_product_section_enable'],
	'sanitize_callback' => 'music_zone_sanitize_switch_control',
) );

$wp_customize->add_control( new Music_Zone_Switch_Control( $wp_customize, 'music_zone_theme_options[recent_product_section_enable]', array(
	'label'             => esc_html__( 'Product Section Enable', 'music-zone' ),
	'section'           => 'music_zone_recent_product_section',
	'on_off_label' 		=> music_zone_switch_options(),
) ) );

if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'music_zone_theme_options[recent_product_section_enable]', array(
		'selector'            => '#music_zone_recent_product_section .tooltiptext',
		'settings'            => 'music_zone_theme_options[recent_product_section_enable]',
    ) );
}


// product title setting and control
$wp_customize->add_setting( 'music_zone_theme_options[recent_product_title]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=> $options['recent_product_title'],
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'music_zone_theme_options[recent_product_title]', array(
	'label'           	=> esc_html__( 'Title', 'music-zone' ),
	'section'        	=> 'music_zone_recent_product_section',
	'active_callback' 	=> 'music_zone_is_recent_product_section_enable',
	'type'				=> 'text',
) );

if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'music_zone_theme_options[recent_product_title]', array(
		'selector'            => '#music_zone_recent_product_section .section-title',
		'settings'            => 'music_zone_theme_options[recent_product_title]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'music_zone_recent_product_title_partial',
    ) );
}


// product subtitle setting and control
$wp_customize->add_setting( 'music_zone_theme_options[recent_product_subtitle]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=> $options['recent_product_subtitle'],
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'music_zone_theme_options[recent_product_subtitle]', array(
	'label'           	=> esc_html__( 'Sub Title', 'music-zone' ),
	'section'        	=> 'music_zone_recent_product_section',
	'active_callback' 	=> 'music_zone_is_recent_product_section_enable',
	'type'				=> 'text',
) );

if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'music_zone_theme_options[recent_product_subtitle]', array(
		'selector'            => '#music_zone_recent_product_section .section-subtitle',
		'settings'            => 'music_zone_theme_options[recent_product_subtitle]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'music_zone_recent_product_subtitle_partial',
    ) );
}


// Product content type control and setting
$wp_customize->add_setting( 'music_zone_theme_options[recent_product_content_type]', array(
	'default'          	=> $options['recent_product_content_type'],
	'sanitize_callback' => 'music_zone_sanitize_select',
) );

$wp_customize->add_control( 'music_zone_theme_options[recent_product_content_type]', array(
	'label'             => esc_html__( 'Content Type', 'music-zone' ),
	'section'           => 'music_zone_recent_product_section',
	'type'				=> 'select',
	'active_callback' 	=> 'music_zone_is_recent_product_section_enable',
	'choices'			=> music_zone_product_content_type(),
) );

for ( $i = 1; $i <= 4; $i++ ) :

	// product posts drop down chooser control and setting
	$wp_customize->add_setting( 'music_zone_theme_options[recent_product_content_product_' . $i . ']', array(
		'sanitize_callback' => 'music_zone_sanitize_page',
	) );

	$wp_customize->add_control( new Music_Zone_Dropdown_Chooser( $wp_customize, 'music_zone_theme_options[recent_product_content_product_' . $i . ']', array(
		'label'             => sprintf( esc_html__( 'Select Product %d', 'music-zone' ), $i ),
		'section'           => 'music_zone_recent_product_section',
		'choices'			=> music_zone_product_choices(),
		'active_callback'	=> 'music_zone_is_recent_product_section_content_product_enable',
	) ) );

endfor;

// Add dropdown category setting and control.
$wp_customize->add_setting(  'music_zone_theme_options[recent_product_content_product_category]', array(
	'sanitize_callback' => 'absint',
) ) ;

$wp_customize->add_control( new Music_Zone_Dropdown_Taxonomies_Control( $wp_customize,'music_zone_theme_options[recent_product_content_product_category]', array(
	'label'             => esc_html__( 'Select Product Category', 'music-zone' ),
	'description'      	=> esc_html__( 'Note: Latest selected no of posts will be shown from selected category', 'music-zone' ),
	'section'           => 'music_zone_recent_product_section',
	'taxonomy'			=> 'product_cat',
	'type'              => 'dropdown-taxonomies',
	'active_callback'	=> 'music_zone_is_recent_product_section_content_product_category_enable'
) ) );
