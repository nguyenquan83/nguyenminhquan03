<?php


function music_zone_ctdi_plugin_page_setup( $default_settings ) {
    $default_settings['menu_title']  = esc_html__( 'Theme Palace Demo Import' , 'music-zone' );

    return $default_settings;
}
add_filter( 'cp-ctdi/plugin_page_setup', 'music_zone_ctdi_plugin_page_setup' );

function  music_zone_ctdi_plugin_intro_text( $default_text ) {
    $default_text .= sprintf( '<p class="about-description">%1$s <a href="%2$s">%3$s</a></p>', esc_html__( 'Demo content files for music zone pro Theme.', 'music-zone' ),
    esc_url( 'https://themepalace.com/instructions/themes/music-zone/' ), esc_html__( 'Click here for Demo File download', 'music-zone' ) );
    return $default_text;
}
add_filter( 'cp-ctdi/plugin_intro_text', 'music_zone_ctdi_plugin_intro_text' );
