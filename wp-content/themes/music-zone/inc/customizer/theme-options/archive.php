<?php
/**
 * Archive options
 *
 * @package Theme Palace
 * @subpackage  Music Zone
 * @since  Music Zone 1.0.0
 */

// Add archive section
$wp_customize->add_section( 'music_zone_archive_section',
	array(
		'title'             => esc_html__( 'Blog/Archive','music-zone' ),
		'description'       => esc_html__( 'Archive section options.', 'music-zone' ),
		'panel'             => 'music_zone_theme_options_panel',
	)
);

// Your latest posts title setting and control.
$wp_customize->add_setting( 'music_zone_theme_options[your_latest_posts_title]',
	array(
		'default'           => $options['your_latest_posts_title'],
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control( 'music_zone_theme_options[your_latest_posts_title]',
	array(
		'label'             => esc_html__( 'Your Latest Posts Title', 'music-zone' ),
		'description'       => esc_html__( 'This option only works if Static Front Page is set to "Your latest posts."', 'music-zone' ),
		'section'           => 'music_zone_archive_section',
		'type'				=> 'text',
		'active_callback'   => 'music_zone_is_latest_posts'
	)
);

// features content type control and setting
$wp_customize->add_setting( 'music_zone_theme_options[blog_column]',
	array(
		'default'          	=> $options['blog_column'],
		'sanitize_callback' => 'music_zone_sanitize_select',
	)
);

$wp_customize->add_control( 'music_zone_theme_options[blog_column]',
	array(
		'label'             => esc_html__( 'Column Layout', 'music-zone' ),
		'section'           => 'music_zone_archive_section',
		'type'				=> 'select',
		'choices'			=> array( 
			'col-1'		=> esc_html__( 'One Column', 'music-zone' ),
			'col-2'		=> esc_html__( 'Two Column', 'music-zone' ),
			'col-3'		=> esc_html__( 'Three Column', 'music-zone' ),
		),
	)
);

// hide banner control and setting
$wp_customize->add_setting( 'music_zone_theme_options[hide_banner]', array(
	'default'           => $options['hide_banner'],
	'sanitize_callback' => 'music_zone_sanitize_switch_control',
) );

$wp_customize->add_control( new Music_Zone_Switch_Control( $wp_customize, 'music_zone_theme_options[hide_banner]', array(
	'label'             => esc_html__( 'Hide Banner', 'music-zone' ),
	'section'           => 'music_zone_archive_section',
	'on_off_label' 		=> music_zone_hide_options(),
) ) );