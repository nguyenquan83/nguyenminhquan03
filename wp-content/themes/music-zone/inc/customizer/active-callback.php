<?php
/**
 * Customizer active callbacks
 *
 * @package Theme Palace
 * @subpackage  Music Zone
 * @since  Music Zone 1.0.0
 */

if ( ! function_exists( 'music_zone_is_loader_enable' ) ) :
	/**
	 * Check if loader is enabled.
	 *
	 * @since  Music Zone 1.0.0
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function music_zone_is_loader_enable( $control ) {
		return $control->manager->get_setting( 'music_zone_theme_options[loader_enable]' )->value();
	}
endif;

if ( ! function_exists( 'music_zone_is_static_homepage_enable' ) ) :
	/**
	 * Check if static homepage is enabled.
	 *
	 * @since Music Zone 1.0.0
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function music_zone_is_static_homepage_enable( $control ) {
		return ( 'page' == $control->manager->get_setting( 'show_on_front' )->value() );
	}
endif;

if ( ! function_exists( 'music_zone_is_breadcrumb_enable' ) ) :
	/**
	 * Check if breadcrumb is enabled.
	 *
	 * @since  Music Zone 1.0.0
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function music_zone_is_breadcrumb_enable( $control ) {
		return $control->manager->get_setting( 'music_zone_theme_options[breadcrumb_enable]' )->value();
	}
endif;

if ( ! function_exists( 'music_zone_is_pagination_enable' ) ) :
	/**
	 * Check if pagination is enabled.
	 *
	 * @since  Music Zone 1.0.0
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function music_zone_is_pagination_enable( $control ) {
		return $control->manager->get_setting( 'music_zone_theme_options[pagination_enable]' )->value();
	}
endif;

/*==================Slider===============*/

/**
 * Check if slider section is enabled.
 *
 * @since  Music Zone 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function music_zone_is_slider_section_enable( $control ) {
	return ( $control->manager->get_setting( 'music_zone_theme_options[slider_section_enable]' )->value() );
}

/*==================Service===============*/

/**
 * Check if service section is enabled.
 *
 * @since  Medistore Pro 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function music_zone_is_service_section_enable( $control ) {
	return ( $control->manager->get_setting( 'music_zone_theme_options[service_section_enable]' )->value() );
}

/*==================Playlist===============*/

/**
 * Check if playlist section is enabled.
 *
 * @since  Music Zone 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function music_zone_is_playlist_section_enable( $control ) {
	return ( $control->manager->get_setting( 'music_zone_theme_options[playlist_section_enable]' )->value() );
}

/*==================Promotion===============*/

/**
 * Check if promotion section is enabled.
 *
 * @since Music Zone 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function music_zone_is_promotion_section_enable( $control ) {
	return ( $control->manager->get_setting( 'music_zone_theme_options[promotion_section_enable]' )->value() );
}

/*==================Recent Product===============*/

/**
 * Check if product section is enabled.
 *
 * @since Music Zone 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function music_zone_is_recent_product_section_enable( $control ) {
	return ( $control->manager->get_setting( 'music_zone_theme_options[recent_product_section_enable]' )->value() ) && class_exists( 'WooCommerce' );
}

/**
 * Check if product section content type is product.
 *
 * @since Music Zone 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function music_zone_is_recent_product_section_content_product_enable( $control ) {
	$content_type = $control->manager->get_setting( 'music_zone_theme_options[recent_product_content_type]' )->value();
	return music_zone_is_recent_product_section_enable( $control ) && ( 'product' == $content_type );
}

/**
 * Check if product section content type is product category.
 *
 * @since Music Zone 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function music_zone_is_recent_product_section_content_product_category_enable( $control ) {
	$content_type = $control->manager->get_setting( 'music_zone_theme_options[recent_product_content_type]' )->value();
	return music_zone_is_recent_product_section_enable( $control ) && ( 'product-category' == $content_type );
}

/*==================Latest Posts===============*/

/**
 * Check if latest posts section is enabled.
 *
 * @since Music Zone 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function music_zone_is_latest_posts_section_enable( $control ) {
	return ( $control->manager->get_setting( 'music_zone_theme_options[latest_posts_section_enable]' )->value() );
}

/**
 * Check if blog section content type is post.
 *
 * @since Music Zone 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function music_zone_is_latest_posts_section_content_post_enable( $control ) {
	$content_type = $control->manager->get_setting( 'music_zone_theme_options[latest_posts_content_type]' )->value();
	return music_zone_is_latest_posts_section_enable( $control ) && ( 'post' == $content_type );
}

/**
 * Check if blog section content type is category.
 *
 * @since Music Zone 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function music_zone_is_latest_posts_section_content_category_enable( $control ) {
	$content_type = $control->manager->get_setting( 'music_zone_theme_options[latest_posts_content_type]' )->value();
	return music_zone_is_latest_posts_section_enable( $control ) && ( 'category' == $content_type );
}

/*==================Subscription===============*/

/**
 * Check if subscription section is enabled.
 *
 * @since Music Zone 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function music_zone_is_subscription_section_enable( $control ) {
	return ( $control->manager->get_setting( 'music_zone_theme_options[subscription_section_enable]' )->value() ) && class_exists( 'Jetpack' );
}

/*==================Event===============*/

/**
 * Check if event section is enabled.
 *
 * @since Music Zone 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function music_zone_is_event_section_enable( $control ) {
	return ( $control->manager->get_setting( 'music_zone_theme_options[event_section_enable]' )->value() );
}

/*========================Contact===========================*/
/**
 * Check if contact section is enabled.
 *
 * @since  Music Zone 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function music_zone_is_contact_section_enable( $control ) {
	return ( $control->manager->get_setting( 'music_zone_theme_options[contact_section_enable]' )->value() );
}

/*========================Counter===========================*/
/**
 * Check if contact section is enabled.
 *
 * @since  Music Zone 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function music_zone_is_counter_section_enable( $control ) {
	return ( $control->manager->get_setting( 'music_zone_theme_options[counter_section_enable]' )->value() );
}