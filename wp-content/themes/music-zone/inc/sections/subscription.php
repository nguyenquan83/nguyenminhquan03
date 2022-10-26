<?php
/**
 * Subscription section
 *
 * This is the template for the content of subscription section
 *
 * @package Theme Palace
 * @subpackage Music Zone
 * @since Music Zone 1.0.0
 */
if ( ! function_exists( 'music_zone_add_subscription_section' ) ) :
    /**
    * Add subscription section
    *
    *@since Music Zone 1.0.0
    */
    function music_zone_add_subscription_section() {
    	$options = music_zone_get_theme_options();
        // Check if subscription is enabled on frontpage
        $subscription_enable = apply_filters( 'music_zone_section_status', true, 'subscription_section_enable' );

        if ( true !== $subscription_enable ) {
            return false;
        }

        // Render subscription section now.
        music_zone_render_subscription_section();
    }
endif;


if ( ! function_exists( 'music_zone_render_subscription_section' ) ) :
  /**
   * Start subscription section
   *
   * @return string subscription content
   * @since Music Zone 1.0.0
   *
   */
   function music_zone_render_subscription_section() {
        $options = music_zone_get_theme_options();
        $bg_image = !empty( $options['subscription_bg_image'] ) ? $options['subscription_bg_image'] : '';

        ?>
        <div id="music_zone_subscription_section" class="subscription-section relative page-section" style="background-image: url('<?php echo esc_url( $bg_image ) ?>');">
            <div class="overlay"></div>
            <div class="wrapper">
                <?php if ( is_customize_preview()):
                music_zone_section_tooltip( 'subscription-section-class' );
                endif; ?>
                <div class="section-header">
                    <?php if ( ! empty( $options['subscription_subtitle'] ) ) : ?>
                        <p class="section-subtitle"><?php echo esc_html( $options['subscription_subtitle'] ); ?></p>
                    <?php endif; ?>
                   <?php if ( ! empty( $options['subscription_title'] ) ) : ?>
                        <h2 class="section-title"><?php echo esc_html( $options['subscription_title'] ); ?></h2>
                    <?php endif; ?>                    
                </div><!-- .section-header -->

                <div class="subscribe-form-wrapper">
                    <?php  
                        $subscription_shortcode = '[jetpack_subscription_form title="" subscribe_text="" subscribe_button="' . esc_html__( 'Subscribe', 'music-zone' ) . '" show_subscribers_total="0"]';
                        echo do_shortcode( wp_kses_post( $subscription_shortcode ) ); 
                    ?>
                </div><!-- .subscribe-form-wrapper -->
            </div><!-- .wrapper -->
        </div><!-- #subscribe-now -->        

    <?php }
endif;