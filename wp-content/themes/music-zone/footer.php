<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Theme Palace
 * @subpackage  Music Zone
 * @since  Music Zone 1.0.0
 */

/**
 * music_zone_footer_primary_content hook
 *
 * @hooked music_zone_add_subscribe_section -  10
 *
 */
do_action( 'music_zone_footer_primary_content' );

/**
 * music_zone_content_end_action hook
 *
 * @hooked music_zone_content_end -  10
 *
 */
do_action( 'music_zone_content_end_action' );

/**
 * music_zone_content_end_action hook
 *
 * @hooked music_zone_footer_start -  10
 * @hooked music_zone_Footer_Widgets->add_footer_widgets -  20
 * @hooked music_zone_footer_site_info -  40
 * @hooked music_zone_footer_end -  100
 *
 */
do_action( 'music_zone_footer' );

/**
 * music_zone_page_end_action hook
 *
 * @hooked music_zone_page_end -  10
 *
 */
do_action( 'music_zone_page_end_action' ); 

?>

<?php wp_footer(); ?>

</body>
</html>
