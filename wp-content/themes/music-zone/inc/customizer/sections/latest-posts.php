<?php
/**
 * Latest Posts Section options
 *
 * @package Theme Palace
 * @subpackage Music Zone Pro
 * @since Music Zone Pro 1.0.0
 */

// Add Latest Posts section
$wp_customize->add_section( 'music_zone_latest_posts_section', array(
	'title'             => esc_html__( 'Latest Posts','music-zone' ),
	'description'       => esc_html__( 'Latest Posts Section options.', 'music-zone' ),
	'panel'             => 'music_zone_front_page_panel',
	'priority'			=> 100,
) );

// Latest Posts content enable control and setting
$wp_customize->add_setting( 'music_zone_theme_options[latest_posts_section_enable]', array(
	'default'			=> 	$options['latest_posts_section_enable'],
	'sanitize_callback' => 'music_zone_sanitize_switch_control',
) );

$wp_customize->add_control( new Music_Zone_Switch_Control( $wp_customize, 'music_zone_theme_options[latest_posts_section_enable]', array(
	'label'             => esc_html__( 'Latest Posts Section Enable', 'music-zone' ),
	'section'           => 'music_zone_latest_posts_section',
	'on_off_label' 		=> music_zone_switch_options(),
) ) );

if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'music_zone_theme_options[latest_posts_section_enable]', array(
		'selector'      => '.latest-posts-section .tooltiptext',
		'settings'      => 'music_zone_theme_options[latest_posts_section_enable]',
    ) );
}


// latest posts title setting and control
$wp_customize->add_setting( 'music_zone_theme_options[latest_posts_title]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=> $options['latest_posts_title'],
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'music_zone_theme_options[latest_posts_title]', array(
	'label'           	=> esc_html__( 'Title', 'music-zone' ),
	'section'        	=> 'music_zone_latest_posts_section',
	'active_callback' 	=> 'music_zone_is_latest_posts_section_enable',
	'type'				=> 'text',
) );

if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'music_zone_theme_options[latest_posts_title]', array(
		'selector'      => '#music_zone_latest_posts_section .section-header .section-title',
		'settings'      => 'music_zone_theme_options[latest_posts_title]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'music_zone_latest_posts_title_partial',
    ) );
}


// latest posts subtitle setting and control
$wp_customize->add_setting( 'music_zone_theme_options[latest_posts_subtitle]', array(
	'sanitize_callback' => 'sanitize_text_field',
	'default'			=> $options['latest_posts_subtitle'],
	'transport'			=> 'postMessage',
) );

$wp_customize->add_control( 'music_zone_theme_options[latest_posts_subtitle]', array(
	'label'           	=> esc_html__( 'Sub Title', 'music-zone' ),
	'section'        	=> 'music_zone_latest_posts_section',
	'active_callback' 	=> 'music_zone_is_latest_posts_section_enable',
	'type'				=> 'text',
) );

if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'music_zone_theme_options[latest_posts_subtitle]', array(
		'selector'      => '#music_zone_latest_posts_section .section-header .section-subtitle',
		'settings'      => 'music_zone_theme_options[latest_posts_subtitle]',
		'container_inclusive' => false,
		'fallback_refresh'    => true,
		'render_callback'     => 'music_zone_latest_posts_subtitle_partial',
    ) );
}


// Latest Posts content type control and setting
$wp_customize->add_setting( 'music_zone_theme_options[latest_posts_content_type]', array(
	'default'          	=> $options['latest_posts_content_type'],
	'sanitize_callback' => 'music_zone_sanitize_select',
) );

$wp_customize->add_control( 'music_zone_theme_options[latest_posts_content_type]', array(
	'label'             => esc_html__( 'Content Type', 'music-zone' ),
	'section'           => 'music_zone_latest_posts_section',
	'type'				=> 'select',
	'active_callback' 	=> 'music_zone_is_latest_posts_section_enable',
	'choices'			=> array( 
		'post' 		=> esc_html__( 'Post', 'music-zone' ),
		'category' 	=> esc_html__( 'Category', 'music-zone' ),
	),
) );


for ( $i = 1; $i <= 3; $i++ ) :

	// latest posts drop down chooser control and setting
	$wp_customize->add_setting( 'music_zone_theme_options[latest_posts_content_post_' . $i . ']', array(
		'sanitize_callback' => 'music_zone_sanitize_page',
	) );

	$wp_customize->add_control( new Music_Zone_Dropdown_Chooser( $wp_customize, 'music_zone_theme_options[latest_posts_content_post_' . $i . ']', array(
		'label'             => sprintf( esc_html__( 'Select Post %d', 'music-zone' ), $i ),
		'section'           => 'music_zone_latest_posts_section',
		'choices'			=> music_zone_post_choices(),
		'active_callback'	=> 'music_zone_is_latest_posts_section_content_post_enable',
	) ) );
endfor;

// Add dropdown category setting and control.
$wp_customize->add_setting(  'music_zone_theme_options[latest_posts_content_category]', array(
	'sanitize_callback' => 'music_zone_sanitize_single_category',
) ) ;

$wp_customize->add_control( new Music_Zone_Dropdown_Taxonomies_Control( $wp_customize,'music_zone_theme_options[latest_posts_content_category]', array(
	'label'             => esc_html__( 'Select Category', 'music-zone' ),
	'description'      	=> esc_html__( 'Note: Latest selected no of posts will be shown from selected category', 'music-zone' ),
	'section'           => 'music_zone_latest_posts_section',
	'type'              => 'dropdown-taxonomies',
	'active_callback'	=> 'music_zone_is_latest_posts_section_content_category_enable'
) ) );