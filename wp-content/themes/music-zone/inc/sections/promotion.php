<?php
/**
 * Promotion section
 *
 * This is the template for the content of promotion section
 *
 * @package Theme Palace
 * @subpackage Music Zone
 * @since Music Zone 1.0.0
 */
if ( ! function_exists( 'music_zone_add_promotion_section' ) ) :
    /**
    * Add promotion section
    *
    *@since Music Zone 1.0.0
    */
    function music_zone_add_promotion_section() {
        $options = music_zone_get_theme_options();
        // Check if promotion is enabled on frontpage
        $promotion_enable = apply_filters( 'music_zone_section_status', true, 'promotion_section_enable' );

        if ( true !== $promotion_enable ) {
            return false;
        }
        // Get promotion section details
        $section_details = array();
        $section_details = apply_filters( 'music_zone_filter_promotion_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        // Render promotion section now.
        music_zone_render_promotion_section( $section_details );
    }
endif;

if ( ! function_exists( 'music_zone_get_promotion_section_details' ) ) :
    /**
    * promotion section details.
    *
    * @since Music Zone 1.0.0
    * @param array $input promotion section details.
    */
    function music_zone_get_promotion_section_details( $input ) {
        $options = music_zone_get_theme_options();
        
        $content  = array();
        $page_id = ! empty( $options['promotion_content_page'] ) ? $options['promotion_content_page'] : '';
        
        $args = array(
            'post_type'         => 'page',
            'page_id'           => $page_id,
            'posts_per_page'    => 1,
        );
        // Run The Loop.
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) : 
            while ( $query->have_posts() ) : $query->the_post();
                $page_post['title']     = get_the_title();
                $page_post['url']       = get_the_permalink();
                $page_post['excerpt']   = music_zone_trim_content( 25 );
                $page_post['image']     = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_id(), 'full' ) : get_template_directory_uri() . '/assets/uploads/no-featured-image-600x450.jpg';

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
// promotion section content details.
add_filter( 'music_zone_filter_promotion_section_details', 'music_zone_get_promotion_section_details' );


if ( ! function_exists( 'music_zone_render_promotion_section' ) ) :
  /**
   * Start promotion section
   *
   * @return string promotion content
   * @since Music Zone 1.0.0
   *
   */
   function music_zone_render_promotion_section( $content_details = array() ) {
    $options  = music_zone_get_theme_options();
    $readmore = ! empty( $options['promotion_btn_title'] ) ? $options['promotion_btn_title'] : esc_html__( 'Read More', 'music-zone' );

    if ( empty( $content_details ) ) {
        return;
    } 

    foreach ( $content_details as $content ) : ?>
        <div id="music_zone_promotion_section" class="promotion-section relative page-section" style="background-image: url('<?php echo esc_url( $content['image'] ); ?>');">
            <div class="overlay"></div>
            <div class="wrapper">
                <?php if ( is_customize_preview()):
                    music_zone_section_tooltip( 'promotion-section-class' );
                endif; ?>
                <header class="entry-header">
                    <h2 class="entry-title"><?php echo esc_html( $content['title'] ); ?></h2>
                </header>

                <div class="entry-content">
                    <p><?php echo wp_kses_post( $content['excerpt'] ); ?></p>
                </div><!-- .entry-content -->

                <?php
                if ( !empty ( $readmore ) ) {
                    ?>
                    <div class="read-more">
                        <a href="<?php echo esc_url( $content['url'] ); ?>" class="btn"><?php echo esc_html( $readmore ); ?></a>
                    </div><!-- .read-more -->
                    <?php
                }
                ?>
            </div><!-- .wrapper -->
        </div><!-- #promotion-section -->
    <?php endforeach; 
    }
endif;
