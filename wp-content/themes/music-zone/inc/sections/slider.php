<?php
/**
 * Banner section
 *
 * This is the template for the content of slider section
 *
 * @package Theme Palace
 * @subpackage  Music Zone
 * @since  Music Zone 1.0.0
 */
if ( ! function_exists( 'music_zone_add_slider_section' ) ) :
    /**
    * Add slider section
    *
    *@since  Music Zone 1.0.0
    */
    function music_zone_add_slider_section() {
    	$options = music_zone_get_theme_options();
        // Check if slider is enabled on frontpage
        $slider_enable = apply_filters( 'music_zone_section_status', true, 'slider_section_enable' );

        if ( true !== $slider_enable ) {
            return false;
        }
        // Get slider section details
        $section_details = array();
        $section_details = apply_filters( 'music_zone_filter_slider_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }
        // Render slider section now.
        music_zone_render_slider_section( $section_details );
}

endif;

if ( ! function_exists( 'music_zone_get_slider_section_details' ) ) :
    /**
    * slider section details.
    *
    * @since  Music Zone 1.0.0
    * @param array $input slider section details.
    */
    function music_zone_get_slider_section_details( $input ) {
        $options = music_zone_get_theme_options();

        // Content type.
        $slider_content_type    = $options['slider_content_type'];
        
        $content  = array();
        $page_ids = array();

        for ( $i = 1; $i <= 3; $i++ ) {
            if ( ! empty( $options['slider_content_page_' . $i] ) )
                $page_ids[] = $options['slider_content_page_' . $i];
        }

        $args = array(
            'post_type'         => 'page',
            'post__in'          => ( array ) $page_ids,
            'posts_per_page'    => 3,
            'orderby'           => 'post__in',
        );

        // Run The Loop.
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) : 
            $i = 1;
            while ( $query->have_posts() ) : $query->the_post();
                $page_post['id']        = get_the_id();
                $page_post['title']     = get_the_title();
                $page_post['url']       = get_the_permalink();
                $page_post['excerpt']   = music_zone_trim_content($options['slider_excerpt_length']);
                $page_post['image']     = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_id(), 'large' ) : '';

                // Push to the main array.
                array_push( $content, $page_post );
            endwhile;
            $i++;
        endif;
        wp_reset_postdata();

        if ( ! empty( $content ) ) {
            $input = $content;
        }
        return $input;
    }
endif;
// slider section content details.
add_filter( 'music_zone_filter_slider_section_details', 'music_zone_get_slider_section_details' );


if ( ! function_exists( 'music_zone_render_slider_section' ) ) :
  /**
   * Start slider section
   *
   * @return string slider content
   * @since  Music Zone 1.0.0
   *
   */
   function music_zone_render_slider_section( $content_details = array() ) {
        $options = music_zone_get_theme_options();
        $slider_btn_alt_url = (!empty($options['slider_btn_alt_url'])) ? $options['slider_btn_alt_url'] : '';
        $slider_auto_play   = $options['slider_autoplay_enable'] ? 'true' : 'false';
        if ( empty( $content_details ) ) {
            return;
        } ?>
        <div id="music_zone_slider_section" class="slider-section">
            <div class="featured-slider" data-slick='{"slidesToShow": 1, "slidesToScroll": 1, "infinite": true, "speed": 800, "dots": true, "arrows": false, "autoplay": <?php echo esc_attr( $slider_auto_play ); ?>, "draggable": true, "fade": false }'>
                <?php foreach ( $content_details as $content ) : ?>

                <article style="background-image:url('<?php echo esc_url($content['image']); ?>');">
                    <div class="overlay"></div> 
                        <div class="wrapper">
                            <div class="featured-content-wrapper">
                                <div class="entry-container">
                                <header class="entry-header">
                                    <h2 class="entry-title"><a href="<?php echo esc_url( $content['url'] ); ?>"><?php echo esc_html( $content['title'] ); ?></a></h2>
                                </header>

                                <div class="entry-content">
                                   <?php if ( is_customize_preview()):
                                    music_zone_section_tooltip( 'slider-section-class' );
                                endif; ?>
                                    <p><?php echo wp_kses_post($content['excerpt']); ?></p>
                                </div><!-- .entry-content-->

                                <?php if(!empty($options['slider_btn_txt']) && !empty($options['slider_btn_alt_txt'])): ?>

                                    <div class="read-more">
                                        <?php if(!empty($options['slider_btn_txt'])): ?>
                                            <a href="<?php echo esc_url($content['url']); ?>" class="btn first"><?php echo esc_html($options['slider_btn_txt']); ?></a>
                                        <?php endif; ?>

                                        <?php if(!empty($options['slider_btn_alt_txt']) && !empty($slider_btn_alt_url)): ?>
                                            <a href="<?php echo esc_url($slider_btn_alt_url); ?>" class="btn second"><?php echo esc_html($options['slider_btn_alt_txt']); ?></a>
                                        <?php endif; ?>
                                    </div><!-- .read-more -->
                                <?php endif; ?>
                                </div><!-- .entry-container -->
                            </div><!-- .featured-content-wrapper -->
                        </div><!-- .wrapper -->
                    </article>

                <?php endforeach; ?>

            </div><!-- #featured-slider -->
        </div><!-- #music_zone_pro_slider_section -->

    <?php
    }    
endif;