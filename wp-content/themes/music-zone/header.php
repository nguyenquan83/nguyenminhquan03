<?php
	/**
	 * The header for our theme.
	 *
	 * This is the template that displays all of the <head> section and everything up until <div id="content">
	 *
	 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
	 *
	 * @package Theme Palace
	 * @subpackage  Music Zone
	 * @since  Music Zone 1.0.0
	 */

	/**
	 * music_zone_doctype hook
	 *
	 * @hooked music_zone_doctype -  10
	 *
	 */
	do_action( 'music_zone_doctype' );

?>
<head>
<?php
	/**
	 * music_zone_before_wp_head hook
	 *
	 * @hooked music_zone_head -  10
	 *
	 */
	do_action( 'music_zone_before_wp_head' );

	wp_head(); 
?>
</head>

<body <?php body_class(); ?>>

<?php do_action( 'wp_body_open' ); ?>
<?php
	/**
	 * music_zone_page_start_action hook
	 *
	 * @hooked music_zone_page_start -  10
	 *
	 */
	do_action( 'music_zone_page_start_action' ); 

	/**
	 * music_zone_loader_action hook
	 *
	 * @hooked music_zone_loader -  10
	 *
	 */
	do_action( 'music_zone_before_header' );

	/**
	 * music_zone_header_action hook
	 *
	 * @hooked music_zone_site_branding -  10
	 * @hooked music_zone_header_start -  20
	 * @hooked music_zone_site_navigation -  30
	 * @hooked music_zone_header_end -  50
	 *
	 */
	do_action( 'music_zone_header_action' );

	/**
	 * music_zone_content_start_action hook
	 *
	 * @hooked music_zone_content_start -  10
	 *
	 */
	do_action( 'music_zone_content_start_action' );

    /**
     * music_zone_header_image_action hook
     *
     * @hooked music_zone_header_image -  10
     *
     */
    do_action( 'music_zone_header_image_action' );
