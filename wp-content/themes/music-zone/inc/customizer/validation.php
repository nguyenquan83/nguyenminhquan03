<?php
/**
* Customizer validation functions
*
* @package Theme Palace
* @subpackage  Music Zone
* @since  Music Zone 1.0.0
*/
if ( ! function_exists( 'music_zone_validate_long_excerpt' ) ) :
    function music_zone_validate_long_excerpt( $validity, $value ){
        $value = intval( $value );
        if ( empty( $value ) || ! is_numeric( $value ) ) {
            $validity->add( 'required', esc_html__( 'You must supply a valid number.', 'music-zone' ) );
        } elseif ( $value < 5 ) {
            $validity->add( 'min_no_of_words', esc_html__( 'Minimum no of words is 5', 'music-zone' ) );
        } elseif ( $value > 100 ) {
            $validity->add( 'max_no_of_words', esc_html__( 'Maximum no of words is 100', 'music-zone' ) );
        }
        return $validity;
    }
endif;

if ( ! function_exists( 'music_zone_validate_event_count' ) ) :
  function music_zone_validate_event_count( $validity, $value ){
         $value = intval( $value );
     if ( empty( $value ) || ! is_numeric( $value ) ) {
         $validity->add( 'required', esc_html__( 'You must supply a valid number.', 'music-zone' ) );
     } elseif ( $value < 1 ) {
         $validity->add( 'min_no_of_posts', esc_html__( 'Minimum no of posts is 1', 'music-zone' ) );
     } elseif ( $value > 12 ) {
         $validity->add( 'max_no_of_posts', esc_html__( 'Maximum no of posts is 12', 'music-zone' ) );
     }
     return $validity;
  }
endif;


