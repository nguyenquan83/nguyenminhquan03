<?php
/**
 * Theme Palace widgets inclusion
 *
 * This is the template that includes all custom widgets of Music Zone
 *
 * @package Theme Palace
 * @subpackage Music Zone
 * @since Music Zone 1.0.0
 */

/*

/*
 * Add popular post widget
 */
require get_template_directory() . '/inc/widgets/social-link-widget.php';
/*

/*
 * Add popular post widget
 */
require get_template_directory() . '/inc/widgets/latest-post-widget.php';
/*
 * Add popular post widget
 */
require get_template_directory() . '/inc/widgets/contact-info-widget.php';
/*

/**
 * Register widgets
 */
function music_zone_register_widgets() {

	register_widget( 'music_zone_Social_Link' );
	register_widget( 'music_zone_Recent_Post' );
	register_widget( 'music_zone_Contact_Info' );

}
add_action( 'widgets_init', 'music_zone_register_widgets' );