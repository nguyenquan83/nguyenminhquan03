<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Theme Palace
 * @subpackage  Music Zone
 * @since  Music Zone 1.0.0
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function music_zone_body_classes( $classes ) {
	$options = music_zone_get_theme_options();

	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	if ( $options['menu_sticky'] ) {
		$classes[] = 'menu-sticky';
	}
	
	if(is_404()) $classes[] = 'no-sidebar';

	// Add a class for sidebar
	$sidebar_position = music_zone_layout();
	$sidebar = 'sidebar-1';
	if ( is_singular() || is_home() ) {
		$id = ( is_home() && ! is_front_page() ) ? get_option( 'page_for_posts' ) : get_the_id();
	  	$sidebar = get_post_meta( $id, 'music-zone-selected-sidebar', true );
	  	$sidebar = ! empty( $sidebar ) ? $sidebar : 'sidebar-1';
	}
	
	if ( is_active_sidebar( $sidebar ) ) {
		$classes[] = esc_attr( $sidebar_position );
	} else {
		$classes[] = 'right-sidebar';
	}

	if ( class_exists( 'Woocommerce' ) ) {
		$classes[] = 'woocommerce';
	}

	if ( class_exists( 'WooCommerce' ) && ( is_shop() || is_product_category() || is_product_tag() || is_tax() || is_product() || is_cart() || is_checkout() ) && ! is_active_sidebar('woocommerce-sidebar') ) {
		$classes[] = 'no-sidebar';
	} elseif ( is_active_sidebar( $sidebar ) ) {
		$classes[] = esc_attr( $sidebar_position );
	} else {
		$classes[] = 'no-sidebar';
	}

	$theme_version  = ! empty ( $options['theme_version'] ) ? $options['theme_version'] : '' ;
	$classes[]		= esc_attr( $theme_version );

	if ( $options['single_post_hide_banner'] == true && is_singular() ) {
		$classes[]		= esc_attr('relative-header');
	}

	if ( $options['hide_banner'] == true && is_archive() ) {
		$classes[]		= esc_attr('relative-header');
	}
	
	return $classes;
}
add_filter( 'body_class', 'music_zone_body_classes' );