<?php
/**
 * Reset options
 *
 * @package Theme Palace
 * @subpackage  Music Zone
 * @since  Music Zone 1.0.0
 */

/**
* Reset section
*/
// Add reset enable section
$wp_customize->add_section( 'music_zone_reset_section',
	array(
		'title'             => esc_html__('Reset all settings','music-zone'),
		'description'       => esc_html__( 'Caution: All settings will be reset to default. Refresh the page after clicking Save & Publish.', 'music-zone' ),
	)
);

// Add reset enable setting and control.
$wp_customize->add_setting( 'music_zone_theme_options[reset_options]',
	array(
		'default'           => $options['reset_options'],
		'sanitize_callback' => 'music_zone_sanitize_checkbox',
		'transport'			=> 'postMessage',
	)
);

$wp_customize->add_control( 'music_zone_theme_options[reset_options]',
	array(
		'label'             => esc_html__( 'Check to reset all settings', 'music-zone' ),
		'section'           => 'music_zone_reset_section',
		'type'              => 'checkbox',
	)
);
