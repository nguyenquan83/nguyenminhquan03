<?php
/**
 * Event section
 *
 * This is the template for the content of event section
 *
 * @package Theme Palace
 * @subpackage Music Zone Pro
 * @since Music Zone Pro 1.0.0
 */
if ( ! function_exists( 'music_zone_add_event_section' ) ) :
    /**
    * Add event section
    *
    *@since Music Zone Pro 1.0.0
    */
    function music_zone_add_event_section() {
    	$options = music_zone_get_theme_options();
        // Check if event is enabled on frontpage
        $event_enable = apply_filters( 'music_zone_section_status', true, 'event_section_enable' );

        if ( true !== $event_enable ) {
            return false;
        }
        // Get event section details
        $section_details = array();
        $section_details = apply_filters( 'music_zone_filter_event_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        // Render event section now.
        music_zone_render_event_section( $section_details );
    }
endif;

if ( ! function_exists( 'music_zone_get_event_section_details' ) ) :
    /**
    * event section details.
    *
    * @since Music Zone Pro 1.0.0
    * @param array $input event section details.
    */
    function music_zone_get_event_section_details( $input ) {
        $options = music_zone_get_theme_options();

        $content  = array();
        $page_ids = array();

        for ( $i=1; $i <= 4; $i++ ) {
            if ( !empty( $options['event_content_page_' . $i ] ) ) {
                $page_ids[] = $options['event_content_page_' . $i];
            }
        }

        $args = array(
            'post_type'       => 'page',
            'post__in'        => ( array ) $page_ids,
            'posts_per_page'  => 4,
            'orderby'           => 'post__in',
        );

        // Run The Loop.
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) : 
            while ( $query->have_posts() ) : $query->the_post();
                $page_post['id']        = get_the_id();
                $page_post['title']     = get_the_title();
                $page_post['url']       = get_the_permalink();
                $page_post['excerpt']   = music_zone_trim_content( 5 );
                $page_post['image']     = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_id(), 'thumbnail' ) : get_template_directory_uri() . '/assets/uploads/no-featured-image-150x150.jpg';

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
// event section content details.
add_filter( 'music_zone_filter_event_section_details', 'music_zone_get_event_section_details' );


if ( ! function_exists( 'music_zone_render_event_section' ) ) :
  /**
   * Start event section
   *
   * @return string event content
   * @since Music Zone Pro 1.0.0
   *
   */
   function music_zone_render_event_section( $content_details = array() ) {
        $options = music_zone_get_theme_options();
        $readmore = ! empty( $options['event_readmore'] ) ? $options['event_readmore'] : esc_html__( 'Buy Ticket', 'music-zone' );
        $bg_image = !empty( $options['event_bg_image'] ) ? $options['event_bg_image'] : '';
        

        if ( empty( $content_details ) ) {
            return;
        } ?>
            <div id="music_zone_events_section" class="event-section relative page-section" style="background-image: url('<?php echo esc_url( $bg_image ) ?>');">
                <div class="overlay"></div>
                <div class="wrapper">
                    <?php if ( is_customize_preview()):
                    music_zone_section_tooltip( 'events-section-class' );
                    endif; ?>
                    <div class="section-header">
                        <?php if ( !empty( $options['event_subtitle'] ) ): ?>
                            <p class="section-subtitle"><?php echo esc_html( $options['event_subtitle'] ); ?></p>
                        <?php endif ?>
                        <?php if ( !empty( $options['event_title'] ) ): ?>
                            <h2 class="section-title"><?php echo esc_html( $options['event_title'] ); ?></h2>
                        <?php endif ?>
                        
                    </div><!-- .section-header -->

                    <div class="section-content col-2 clear">
                        <?php $i=1; foreach ( $content_details as $content ) : ?>
                        <article>
                            <div class="event-item clear">
                                <span class="posted-on">
                                    <a href="<?php echo esc_url( $content['url'] ); ?>" rel="bookmark">
                                        <time class="entry-date published updated" datetime="2018-04-06T11:33:16+00:00"><span><?php echo get_the_date( 'j', $content['id'] ); ?></span><?php echo esc_html( get_the_date( 'M', $content['id'] ) ); ?></time>
                                    </a>
                                </span><!-- .posted-on -->

                                <header class="entry-header">
                                    <h2 class="entry-title"><a href="<?php echo esc_url( $content['url'] ); ?>"><?php echo esc_html( $content['title'] ); ?></a></h2>
                                    <?php if ( !empty($options['event_location_'.$i]) ): ?>
                                        <p class="location"><?php echo esc_html( $options['event_location_'.$i] ); ?></p>
                                    <?php endif ?>  
                                </header>

                                <div class="buy-ticket">
                                    <a href="<?php echo esc_url( $content['url'] ); ?>" class="btn"><?php echo esc_html( $readmore ); ?></a>
                                </div><!-- .buy-ticket -->
                            </div><!-- .event-item -->
                        </article>
                        <?php $i++; endforeach; ?>
                    </div><!-- .section-content -->
                </div><!-- .wrapper -->
            </div><!-- #events-section -->
       
    <?php }
endif;