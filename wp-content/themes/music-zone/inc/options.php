<?php
/**
 * Theme Palace options
 *
 * @package Theme Palace
 * @subpackage  Music Zone
 * @since  Music Zone 1.0.0
 */


/**
 * List of posts for post choices.
 * @return Array Array of post ids and name.
 */
function music_zone_post_choices() {
    $posts = get_posts( array( 'numberposts' => -1 ) );
    $choices = array();
    $choices[0] = esc_html__( '--Select--', 'music-zone' );
    foreach ( $posts as $post ) {
        $choices[ $post->ID ] = $post->post_title;
    }
    wp_reset_postdata();
    return  $choices;
}

/**
 * List of trips for post choices.
 * @return Array Array of post ids and name.
 */
function music_zone_trip_choices() {
    $posts = get_posts( array( 'post_type' => 'itineraries', 'numberposts' => -1 ) );
    $choices = array();
    $choices[0] = esc_html__( '--Select--', 'music-zone' );
    foreach ( $posts as $post ) {
        $choices[ $post->ID ] = $post->post_title;
    }
    return  $choices;
}

/**
 * List of products for post choices.
 * @return Array Array of post ids and name.
 */
function music_zone_product_choices() {
    $posts = get_posts( array( 'numberposts' => -1, 'post_type' => 'product' ) );
    $choices = array();
    $choices[0] = esc_html__( '--Select--', 'music-zone' );
    foreach ( $posts as $post ) {
        $choices[ $post->ID ] = $post->post_title;
    }
    return  $choices;
}

/**
 * List of category for category choices.
 * @return Array Array of post ids and name.
 */
function music_zone_category_choices() {
    $tax_args = array(
        'hierarchical' => 0,
        'taxonomy'     => 'category',
    );
    $taxonomies = get_categories( $tax_args );
    $choices = array();
    $choices[0] = esc_html__( '--Select--', 'music-zone' );
    foreach ( $taxonomies as $tax ) {
        $choices[ $tax->term_id ] = $tax->name;
    }
    return  $choices;
}

/**
 * List of category for category choices.
 * @return Array Array of post ids and name.
 */
function music_zone_product_category_choices() {
    $tax_args = array(
        'hierarchical' => 0,
        'taxonomy'     => 'product_cat',
    );
    $taxonomies = get_categories( $tax_args );
    $choices = array();
    $choices[0] = esc_html__( '--Select--', 'music-zone' );
    foreach ( $taxonomies as $tax ) {
        $choices[ $tax->term_id ] = $tax->name;
    }
    return  $choices;
}

/**
 * List of audio for post choices.
 * @return Array Array of post ids and name.
 */
function music_zone_audio_choices() {
    $posts = get_posts( array( 'numberposts' => -1, 'post_type' => 'attachment', 'post_mime_type' => 'audio' ) );
    $choices = array();
    $choices[0] = esc_html__( '--None--', 'music-zone' );
    foreach ( $posts as $post ) {
        $choices[ $post->ID ] = $post->post_title;
    }
    return  $choices;
}




if ( ! function_exists( 'music_zone_site_layout' ) ) :
    /**
     * Site Layout
     * @return array site layout options
     */
    function music_zone_site_layout() {
        $music_zone_site_layout = array(
            'wide'          => esc_url( get_template_directory_uri() . '/assets/images/full.png' ),
            'boxed-layout'  => esc_url( get_template_directory_uri() . '/assets/images/boxed.png' ),
        );

        $output = apply_filters( 'music_zone_site_layout', $music_zone_site_layout );
        return $output;
    }
endif;

if ( ! function_exists( 'music_zone_selected_sidebar' ) ) :
    /**
     * Sidebars options
     * @return array Sidbar positions
     */
    function music_zone_selected_sidebar() {
        $music_zone_selected_sidebar = array(
            'sidebar-1'             => esc_html__( 'Default Sidebar', 'music-zone' ),
            'optional-sidebar'      => esc_html__( 'Optional Sidebar 1', 'music-zone' ),
            'optional-sidebar-2'    => esc_html__( 'Optional Sidebar 2', 'music-zone' ),
            'optional-sidebar-3'    => esc_html__( 'Optional Sidebar 3', 'music-zone' ),
            'optional-sidebar-4'    => esc_html__( 'Optional Sidebar 4', 'music-zone' ),
        );

        $output = apply_filters( 'music_zone_selected_sidebar', $music_zone_selected_sidebar );

        return $output;
    }
endif;


if ( ! function_exists( 'music_zone_global_sidebar_position' ) ) :
    /**
     * Global Sidebar position
     * @return array Global Sidebar positions
     */
    function music_zone_global_sidebar_position() {
        $music_zone_global_sidebar_position = array(
            'right-sidebar' => esc_url( get_template_directory_uri() . '/assets/images/right.png' ),
            'left-sidebar'  => esc_url( get_template_directory_uri() . '/assets/images/left.png' ),
        );

        $output = apply_filters( 'music_zone_global_sidebar_position', $music_zone_global_sidebar_position );

        return $output;
    }
endif;


if ( ! function_exists( 'music_zone_sidebar_position' ) ) :
    /**
     * Sidebar position
     * @return array Sidbar positions
     */
    function music_zone_sidebar_position() {
        $music_zone_sidebar_position = array(
            'right-sidebar'         => esc_url( get_template_directory_uri() . '/assets/images/right.png' ),
            'no-sidebar'          => esc_url( get_template_directory_uri() . '/assets/images/full.png' ),
        );

        $output = apply_filters( 'music_zone_sidebar_position', $music_zone_sidebar_position );

        return $output;
    }
endif;

if ( ! function_exists( 'music_zone_pagination_options' ) ) :
    /**
     * Pagination
     * @return array site pagination options
     */
    function music_zone_pagination_options() {
        $music_zone_pagination_options = array(
            'numeric'   => esc_html__( 'Numeric', 'music-zone' ),
            'default'   => esc_html__( 'Default(Older/Newer)', 'music-zone' ),
        );

        $output = apply_filters( 'music_zone_pagination_options', $music_zone_pagination_options );

        return $output;
    }
endif;

if ( ! function_exists( 'music_zone_get_spinner_list' ) ) :
    /**
     * List of spinner icons options.
     * @return array List of all spinner icon options.
     */
    function music_zone_get_spinner_list() {
        $arr = array(
            'default'               => esc_html__( 'Default', 'music-zone' ),
            'spinner-wheel'         => esc_html__( 'Wheel', 'music-zone' ),
            'spinner-double-circle' => esc_html__( 'Double Circle', 'music-zone' ),
            'spinner-two-way'       => esc_html__( 'Two Way', 'music-zone' ),
            'spinner-umbrella'      => esc_html__( 'Umbrella', 'music-zone' ),
            'spinner-dots'          => esc_html__( 'Dots', 'music-zone' ),
            'spinner-one-way'       => esc_html__( 'One Way', 'music-zone' ),
            'spinner-fidget'        => esc_html__( 'Fidget', 'music-zone' ),
        );
        return apply_filters( 'music_zone_spinner_list', $arr );
    }
endif;

if ( ! function_exists( 'music_zone_switch_options' ) ) :
    /**
     * List of custom Switch Control options
     * @return array List of switch control options.
     */
    function music_zone_switch_options() {
        $arr = array(
            'on'        => esc_html__( 'Enable', 'music-zone' ),
            'off'       => esc_html__( 'Disable', 'music-zone' )
        );
        return apply_filters( 'music_zone_switch_options', $arr );
    }
endif;

if ( ! function_exists( 'music_zone_hide_options' ) ) :
    /**
     * List of custom Switch Control options
     * @return array List of switch control options.
     */
    function music_zone_hide_options() {
        $arr = array(
            'on'        => esc_html__( 'Yes', 'music-zone' ),
            'off'       => esc_html__( 'No', 'music-zone' )
        );
        return apply_filters( 'music_zone_hide_options', $arr );
    }
endif;


/**
 * List of events for post choices.
 * @return Array Array of post ids and name.
 */
function music_zone_event_choices() {
    $posts = get_posts( array( 'numberposts' => -1, 'post_type' => 'tp-event' ) );
    $choices = array();
    $choices[0] = esc_html__( '--Select--', 'music-zone' );
    foreach ( $posts as $post ) {
        $choices[ $post->ID ] = $post->post_title;
    }
    return  $choices;
}

/**
 * List of pages for page choices.
 * @return Array Array of page ids and name.
 */
function music_zone_page_choices() {
    $pages = get_pages();
    $choices = array();
    $choices[0] = esc_html__( '--Select--', 'music-zone' );
    foreach ( $pages as $page ) {
        $choices[ $page->ID ] = $page->post_title;
    }
    return  $choices;
}

if ( ! function_exists( 'music_zone_product_content_type' ) ) :
    /**
     * Product Options
     * @return array site product options
     */
    function music_zone_product_content_type() {
        $music_zone_product_content_type = '';

        if ( class_exists( 'Woocommerce' ) ) {
            $music_zone_product_content_type = array(
                'product'   => esc_html__( 'Product', 'music-zone' ),
                'product-category'   => esc_html__( 'Product Category', 'music-zone' ),
            );
        }

        $output = apply_filters( 'music_zone_product_content_type', $music_zone_product_content_type );

        return $output;
    }
endif;