<?php
/**
 * Services section
 *
 * This is the template for the content of service section
 *
 * @package Theme Palace
 * @subpackage  Music Zone
 * @since  Music Zone 1.0.0
 */
if ( ! function_exists( 'music_zone_add_service_section' ) ) :
    /**
    * Add service section
    *
    *@since  Music Zone 1.0.0
    */
    function music_zone_add_service_section() {
    	$options = music_zone_get_theme_options();
        // Check if service is enabled on frontpage
        $service_enable = apply_filters( 'music_zone_section_status', true, 'service_section_enable' );

        if ( true !== $service_enable ) {
            return false;
        }
        // Get service section details
        $section_details = array();
        $section_details = apply_filters( 'music_zone_filter_service_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        // Render service section now.
        music_zone_render_service_section( $section_details );
    }
endif;

if ( ! function_exists( 'music_zone_get_service_section_details' ) ) :
    /**
    * service section details.
    *
    * @since  Music Zone 1.0.0
    * @param array $input service section details.
    */
    function music_zone_get_service_section_details( $input ) {
        $options = music_zone_get_theme_options();
        
        $content  = array();
        $page_ids = array();

        for ( $i=1; $i <= 3; $i++ ) {
            if ( !empty ( $options['service_content_page_' . $i] ) ) {
                $page_ids[] = $options['service_content_page_' . $i];
            }
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
            while ( $query->have_posts() ) : $query->the_post();
                $page_post['id']        = get_the_id();
                $page_post['title']     = get_the_title();
                $page_post['content']   = music_zone_trim_content($options['service_excerpt_length']);
                $page_post['url']       = get_the_permalink();
                $page_post['image']     = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_id(), 'post-thumbnail' ) : get_template_directory_uri() . '/assets/uploads/no-featured-image-600x450.jpg';

                // Push to the main array.
                array_push( $content, $page_post );
            endwhile;
        endif;
        wp_reset_postdata();

        if ( ! empty( $content ) ) {
            $input = $content;
        }
        return $input;
    }
endif;
// service section content details.
add_filter( 'music_zone_filter_service_section_details', 'music_zone_get_service_section_details' );


if ( ! function_exists( 'music_zone_render_service_section' ) ) :
  /**
   * Start service section
   *
   * @return string service content
   * @since  Music Zone 1.0.0
   *
   */
   function music_zone_render_service_section( $content_details = array() ) {
        $options    = music_zone_get_theme_options();
        $service_sub_title  = $options['service_section_sub_title'];
        $service_title      = isset($options['service_section_title']) ? $options['service_section_title']: '';
        $service_btn_url = (!empty($options['service_btn_url'])) ? $options['service_btn_url'] : '';

        if ( empty( $content_details ) ) {
            return;
        } ?>
            <div id="music_zone_service_section" class="service-section relative page-section same-background">
                <div class="wrapper">
                    <?php if ( is_customize_preview()):
                    music_zone_section_tooltip( 'service-section-class' );
                    endif; ?>
                    <div class="section-header">
                        <p class="section-subtitle"><?php echo esc_html($service_sub_title); ?></p>
                        <h2 class="section-title"><?php echo esc_html($service_title); ?></h2>
                    </div><!-- .section-header -->

                     <div class="section-content col-3 clear">
                    <?php $i = 1; foreach ( $content_details as $content ) : ?>
                        
                        <article>
                            <div class="service-item">
                                <div class="entry-container">
                                     <div class="icon-container">
                                        <a href="<?php echo esc_url( $content['url'] ); ?>"><i class="fa <?php echo ! empty( $options['service_content_icon_' . $i] ) ? esc_attr( $options['service_content_icon_' . $i] ) : 'fa-desktop'; ?>"></i></a>
                                    </div><!-- .icon-container -->
                                    <header class="entry-header">
                                        <h2 class="entry-title"><a href="<?php echo esc_url($content['url']); ?>"><?php echo esc_html($content['title']); ?></a></h2>
                                    </header>

                                    <div class="entry-content">
                                        <p><?php echo wp_kses_post($content['content']); ?></p>
                                    </div><!-- .entry-content -->
                                </div><!-- .entry-container -->
                            </div>
                        </article>
                        <?php $i++; endforeach; ?>

                    </div><!-- .section-content -->
                </div><!-- .wrapper -->
            </div><!-- #our-services --> 

    <?php
    }    
endif;