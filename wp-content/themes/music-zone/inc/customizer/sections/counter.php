<?php
/**
 * Counter Section options
 *
 * @package Theme Palace
 * @subpackage Music Zone Pro
 * @since Music Zone Pro 1.0.0
 */
$options = music_zone_get_theme_options();
// Add Counter section
$wp_customize->add_section( 'music_zone_counter_section', array(
	'title'             => esc_html__( 'Counters','music-zone' ),
	'description'       => esc_html__( 'Counters Section options.', 'music-zone' ),
	'panel'             => 'music_zone_front_page_panel',
	'priority'			=> 80,
) );

// Counter content enable control and setting
$wp_customize->add_setting( 'music_zone_theme_options[counter_section_enable]', array(
	'default'			=> 	$options['counter_section_enable'],
	'sanitize_callback' => 'music_zone_sanitize_switch_control',
) );

$wp_customize->add_control( new Music_Zone_Switch_Control( $wp_customize, 'music_zone_theme_options[counter_section_enable]', array(
	'label'             => esc_html__( 'Counter Section Enable', 'music-zone' ),
	'section'           => 'music_zone_counter_section',
	'on_off_label' 		=> music_zone_switch_options(),
) ) );

if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'music_zone_theme_options[counter_section_enable]', array(
		'selector'       => '.counter-section .tooltiptext',
		'settings'       => 'music_zone_theme_options[counter_section_enable]',
    ) );
}


// Counter image control and setting
$wp_customize->add_setting( 'music_zone_theme_options[counter_image]', array(
	'sanitize_callback' => 'music_zone_sanitize_image',
) );

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'music_zone_theme_options[counter_image]',
		array(
		'label'         => esc_html__( 'Image', 'music-zone' ),
		'description'   => sprintf( esc_html__( 'Recommended size: %1$dpx x %2$dpx ', 'music-zone' ), 1350, 385 ),
		'section'       => 'music_zone_counter_section',
		'active_callback'	=> 'music_zone_is_counter_section_enable',
) ) );

for ( $i = 1; $i <= 4; $i++ ) :

	// counter note control and setting
	$wp_customize->add_setting( 'music_zone_theme_options[counter_content_icon_' . $i . ']', array(
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( new Music_Zone_Icon_Picker( $wp_customize, 'music_zone_theme_options[counter_content_icon_' . $i . ']', array(
		'label'    => sprintf( esc_html__( 'Select Icon %d', 'music-zone' ), $i ),
		'section'  => 'music_zone_counter_section',
		'active_callback'	=> 'music_zone_is_counter_section_enable',
	) ) );

	if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'music_zone_theme_options[counter_content_icon_' . $i . ']', array(
		'selector'  => '#music_zone_counter_section .counter_content_icon_'.$i,
		'settings'  => 'music_zone_theme_options[counter_content_icon_' . $i . ']',
    ) );
}

	// counter title setting and control
	$wp_customize->add_setting( 'music_zone_theme_options[counter_title_' . $i . ']', array(
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'music_zone_theme_options[counter_title_' . $i . ']', array(
		'label'       => sprintf( esc_html__( 'Counter Title %d', 'music-zone' ), $i ),
		'section'     => 'music_zone_counter_section',
		'type'        => 'text',
		'active_callback'	=> 'music_zone_is_counter_section_enable',
	) );

	if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'music_zone_theme_options[counter_title_' . $i . ']', array(
		'selector'    => '#music_zone_counter_section .counter_title_'.$i,
		'settings'    => 'music_zone_theme_options[counter_title_' . $i . ']',
    ) );
}

	// counter title setting and control
	$wp_customize->add_setting( 'music_zone_theme_options[counter_number_' . $i . ']', array(
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'music_zone_theme_options[counter_number_' . $i . ']', array(
		'label'      => sprintf( esc_html__( 'Counter Count %d', 'music-zone' ), $i ),
		'section'    => 'music_zone_counter_section',
		'type'       => 'text',
		'active_callback'	=> 'music_zone_is_counter_section_enable',
	) );

	if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'music_zone_theme_options[counter_number_' . $i . ']', array(
		'selector'  => '#music_zone_counter_section .counter_number_'.$i,
		'settings'  => 'music_zone_theme_options[counter_number_' . $i . ']',
    ) );
}

	// counter hr setting and control
	$wp_customize->add_setting( 'music_zone_theme_options[counter_hr_'. $i .']', array(
		'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_control( new Music_Zone_Customize_Horizontal_Line( $wp_customize, 'music_zone_theme_options[counter_hr_'. $i .']',
		array(
			'section' => 'music_zone_counter_section',
			'type'    => 'hr',
			'active_callback'	=> 'music_zone_is_counter_section_enable',
	) ) );
endfor;

