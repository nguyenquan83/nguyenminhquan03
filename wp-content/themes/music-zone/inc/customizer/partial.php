<?php
/**
* Partial functions
*
* @package Theme Palace
* @subpackage  Music Zone
* @since  Music Zone 1.0.0
*/

// blog btn title
if ( ! function_exists( 'music_zone_copyright_text_partial' ) ) :
    function music_zone_copyright_text_partial() {
        $options = music_zone_get_theme_options();
        return esc_html( $options['copyright_text'] );
    }
endif;

/*=============Slider Section==============*/

// slider_btn_txt
if ( ! function_exists( 'music_zone_slider_btn_txt_partial' ) ) :
    function music_zone_slider_btn_txt_partial() {
        $options = music_zone_get_theme_options();
        return esc_html( $options['slider_btn_txt'] );
    }
endif;

// slider_btn_alt_txt
if ( ! function_exists( 'music_zone_slider_btn_alt_txt_partial' ) ) :
    function music_zone_slider_btn_alt_txt_partial() {
        $options = music_zone_get_theme_options();
        return esc_html( $options['slider_btn_alt_txt'] );
    }
endif;


/*=============Contact Section==============*/

// contact_section_subtitle selective refresh
if ( ! function_exists( 'music_zone_contact_section_subtitle_partial' ) ) :
    function music_zone_contact_section_subtitle_partial() {
        $options = music_zone_get_theme_options();
        return esc_html( $options['contact_section_subtitle'] );
    }
endif;

// contact_section_title selective refresh
if ( ! function_exists( 'music_zone_contact_section_title_partial' ) ) :
    function music_zone_contact_section_title_partial() {
        $options = music_zone_get_theme_options();
        return esc_html( $options['contact_section_title'] );
    }
endif;

/*=============Service Section==============*/

if ( ! function_exists( 'music_zone_service_section_sub_title_partial' ) ) :
    // service_section_sub_title
    function music_zone_service_section_sub_title_partial() {
        $options = music_zone_get_theme_options();
        return esc_html( $options['service_section_sub_title'] );
    }
endif;

if ( ! function_exists( 'music_zone_service_section_title_partial' ) ) :
    // service_section_title
    function music_zone_service_section_title_partial() {
        $options = music_zone_get_theme_options();
        return esc_html( $options['service_section_title'] );
    }
endif;

/*=============Latest Posts Section==============*/

if ( ! function_exists( 'music_zone_latest_posts_title_partial' ) ) :
    // about_sub_title
    function music_zone_latest_posts_title_partial() {
        $options = music_zone_get_theme_options();
        return esc_html( $options['latest_posts_title'] );
    }
endif;

if ( ! function_exists( 'music_zone_latest_posts_subtitle_partial' ) ) :
    // about_sub_title
    function music_zone_latest_posts_subtitle_partial() {
        $options = music_zone_get_theme_options();
        return esc_html( $options['latest_posts_subtitle'] );
    }
endif;

/*=============Contact Section==============*/

if ( ! function_exists( 'music_zone_contact_section_title_partial' ) ) :
    // about_sub_title
    function music_zone_contact_section_title_partial() {
        $options = music_zone_get_theme_options();
        return esc_html( $options['contact_section_title'] );
    }
endif;

if ( ! function_exists( 'music_zone_contact_section_subtitle_partial' ) ) :
    // about_sub_title
    function music_zone_contact_section_title_partial() {
        $options = music_zone_get_theme_options();
        return esc_html( $options['contact_section_subtitle'] );
    }
endif;

/*=============Event Section==============*/

if ( ! function_exists( 'music_zone_event_subtitle_partial' ) ) :
    // about_sub_title
    function music_zone_event_subtitle_partial() {
        $options = music_zone_get_theme_options();
        return esc_html( $options['event_subtitle'] );
    }
endif;

if ( ! function_exists( 'music_zone_event_title_partial' ) ) :
    // about_sub_title
    function music_zone_event_title_partial() {
        $options = music_zone_get_theme_options();
        return esc_html( $options['event_title'] );
    }
endif;

/*=============Playlist Section==============*/

if ( ! function_exists( 'music_zone_playlist_subtitle_partial' ) ) :
    // about_sub_title
    function music_zone_playlist_subtitle_partial() {
        $options = music_zone_get_theme_options();
        return esc_html( $options['playlist_subtitle'] );
    }
endif;

if ( ! function_exists( 'music_zone_playlist_title_partial' ) ) :
    // about_sub_title
    function music_zone_playlist_title_partial() {
        $options = music_zone_get_theme_options();
        return esc_html( $options['playlist_title'] );
    }
endif;

/*=============Recent Product Section==============*/

if ( ! function_exists( 'music_zone_recent_product_subtitle_partial' ) ) :
    // recent_product_sub_title
    function music_zone_recent_product_subtitle_partial() {
        $options = music_zone_get_theme_options();
        return esc_html( $options['recent_product_subtitle'] );
    }
endif;

if ( ! function_exists( 'music_zone_recent_product_title_partial' ) ) :
    // recent_product_title
    function music_zone_recent_product_title_partial() {
        $options = music_zone_get_theme_options();
        return esc_html( $options['recent_product_title'] );
    }
endif;



