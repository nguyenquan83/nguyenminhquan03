<?php
/**
 * recent product section
 *
 * This is the template for the content of recent product section
 *
 * @package Theme Palace
 * @subpackage Music Zone
 * @since Music Zone 1.0s.0
 */
if ( ! function_exists( 'music_zone_add_recent_product_section' ) ) :
    /**
    * Add recent product section
    *
    *@since Music Zone 1.0.0
    */
    function music_zone_add_recent_product_section() {
        $options = music_zone_get_theme_options();
        // Check if product is enabled on frontpage
        $product_enable = apply_filters( 'music_zone_section_status', true, 'recent_product_section_enable' );

        if ( true !== $product_enable ) {
            return false;
        }
        // Get recent product section details
        $section_details = array();
        $section_details = apply_filters( 'music_zone_filter_recent_product_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }
        if ( !class_exists('WooCommerce') ) {
            return;
        }
        // Render recent product section now.
        music_zone_render_recent_product_section( $section_details );
    }
endif;

if ( ! function_exists( 'music_zone_get_recent_product_section_details' ) ) :
    /**
    * recent product section details.
    *
    * @since Music Zone 1.0.0
    * @param array $input recent product section details.
    */
    function music_zone_get_recent_product_section_details( $input ) {
        $options = music_zone_get_theme_options();

        // Content type.
        $product_content_type  = $options['recent_product_content_type'];     
        $product_count = ! empty( $options['recent_product_count'] ) ? $options['recent_product_count'] : 3;

        // $product_event_count = ! empty( $options['product_event_count'] ) ? $options['product_event_count'] : 3;

        $content = array();
        switch ( $product_content_type ) {

            case 'product':
                $page_ids = array();

                for ( $i = 1; $i <= $product_count; $i++ ) {
                    if ( ! empty( $options['recent_product_content_product_' . $i] ) )
                        $page_ids[] = $options['recent_product_content_product_' . $i];
                }
                
                $args = array(
                    'post_type'         => 'product',
                    'post__in'          => ( array ) $page_ids,
                    'posts_per_page'    => count( $page_ids ),
                    'orderby'           => 'post__in',
                    );
            break;


            case 'product-category':
                $cat_id = ! empty( $options['recent_product_content_product_category'] ) ? $options['recent_product_content_product_category'] : '';

                $args = array(
                'post_type'         => 'product',
                'posts_per_page'    => absint( $product_count ),
                'tax_query'         => array(
                    array(
                        'taxonomy'  => 'product_cat',
                        'field'     => 'id',
                        'terms'     => $cat_id
                    )
                ) );
            break;

            default:
            break;
        }


        // Run The Loop.
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) : 
            while ( $query->have_posts() ) : $query->the_post();
                $page_post['id']        = get_the_id();
                $page_post['title']     = get_the_title();
                $page_post['url']       = get_the_permalink();
                $page_post['excerpt']   = music_zone_trim_content( 20 );
                $page_post['image']     = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_id(), 'large' ) : '';

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
// recent product section content details.
add_filter( 'music_zone_filter_recent_product_section_details', 'music_zone_get_recent_product_section_details' );


if ( ! function_exists( 'music_zone_render_recent_product_section' ) ) :
  /**
   * Start recent product section
   *
   * @return string product content
   * @since Music Zone 1.0.0
   *
   */
   function music_zone_render_recent_product_section( $content_details = array() ) {
        $options = music_zone_get_theme_options();

        if ( empty( $content_details ) ) {
            return;
        } ?>
            <div id="music_zone_recent_product_section" class="ecent-product-section relative page-section same-background">
                <div class="wrapper">
                    <?php if ( is_customize_preview()):
                        music_zone_section_tooltip( 'recent-product-section-class' );
                    endif; ?>
                    <div class="section-header">
                         <?php if ( ! empty( $options['recent_product_subtitle'] ) ) : ?>
                            <p class="section-subtitle"><?php echo esc_html( $options['recent_product_subtitle'] ); ?></p>
                        <?php endif; ?>
                        <?php if ( ! empty( $options['recent_product_title'] ) ) : ?>
                            <h2 class="section-title"><?php echo esc_html( $options['recent_product_title'] ); ?></h2>
                        <?php endif; ?>                       
                    </div><!-- .section-header -->

                    <div class="section-content">
                        <ul class="products">
                            <?php foreach ( $content_details as $content ):
                            $image = $content['image'] == '' ? get_template_directory_uri().'/assets/uploads/no-featured-image-590x650.jpg' : $content['image'] ;
                            ?>
                                <li class="product sale featured-products">
                                    <a href="<?php echo esc_url( $content['url'] ) ; ?>" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">
                                        <?php 
                                            $product = new WC_Product( $content['id'] );
                                            if ( $product->get_sale_price() ): 
                                        ?>
                                        <span class="onsale">
                                            <?php esc_html_e('Sale!', 'music-zone'); ?>
                                        </span>
                                        <?php endif ?>
                                        <img width="330" height="400" src="<?php echo esc_url($image); ?>">
                                        </a>
                                        <div class="product_meta">
                                            <?php 
                                            $terms = get_the_terms ( $content['id'], 'product_cat' );
                                            foreach ( $terms as $term ) { ?>
                                                <span class="posted_in">
                                                    <a href="<?php echo esc_url( get_term_link( $term->term_id, 'product_cat' ) ) ?>"><?php echo esc_html( $term->name) ; ?></a>
                                                </span><!-- .posted_in -->
                                                
                                            <?php }
                                            ?>
                                        </div><!-- .product-meta -->
                                        <h2 class="woocommerce-loop-product__title"><?php echo esc_html( $content['title'] ) ?></h2>
                                        <span class="price">
                                             <?php 
                                                $product = new WC_Product( $content['id'] );
                                                echo $product->get_price_html();
                                            ?>
                                        </span>
                                    
                                    <a href="<?php echo do_shortcode( '[add_to_cart_url id="' . absint( $content['id'] ) . '"]' ); ?>" class="button product_type_simple add_to_cart_button ajax_add_to_cart"> 
                                        <?php esc_html_e('Add to cart', 'music-zone') ?>
                                            
                                    </a>
                                </li>
                            <?php endforeach ?>
                        </ul><!-- .product-slider -->
                    </div><!-- .section-content -->
                </div><!-- .wrapper -->
            </div>
       
    <?php }
endif;