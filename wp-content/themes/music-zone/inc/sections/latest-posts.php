<?php
/**
 * Blog section
 *
 * This is the template for the content of blog section
 *
 * @package Theme Palace
 * @subpackage Music Zone
 * @since Music Zone 1.0.0
 */
if ( ! function_exists( 'music_zone_add_latest_posts_section' ) ) :
    /**
    * Add blog section
    *
    *@since Music Zone 1.0.0
    */
    function music_zone_add_latest_posts_section() {
    	$options = music_zone_get_theme_options();
        // Check if blog is enabled on frontpage
        $latest_posts_enable = apply_filters( 'music_zone_section_status', true, 'latest_posts_section_enable' );

        if ( true !== $latest_posts_enable ) {
            return false;
        }
        // Get blog section details
        $section_details = array();
        $section_details = apply_filters( 'music_zone_filter_latest_posts_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        // Render blog section now.
        music_zone_render_latest_posts_section( $section_details );
    }
endif;

if ( ! function_exists( 'music_zone_get_latest_posts_section_details' ) ) :
    /**
    * blog section details.
    *
    * @since Music Zone 1.0.0
    * @param array $input blog section details.
    */
    function music_zone_get_latest_posts_section_details( $input ) {
        $options = music_zone_get_theme_options();

        // Content type.
        $latest_posts_content_type  = $options['latest_posts_content_type'];
        $latest_posts_count = ! empty( $options['latest_posts_count'] ) ? $options['latest_posts_count'] : 4;
        
        $content = array();
        switch ( $latest_posts_content_type ) {

            case 'post':
                $post_ids = array();

                for ( $i = 1; $i <= $latest_posts_count; $i++ ) {
                    if ( ! empty( $options['latest_posts_content_post_' . $i] ) )
                        $post_ids[] = $options['latest_posts_content_post_' . $i];
                }
                
                $args = array(
                    'post_type'         => 'post',
                    'post__in'          => ( array ) $post_ids,
                    'posts_per_page'    => absint( $latest_posts_count ),
                    'orderby'           => 'post__in',
                    'ignore_sticky_posts'   => true,
                    );                    
            break;

            case 'category':
                $cat_id = ! empty( $options['latest_posts_content_category'] ) ? $options['latest_posts_content_category'] : '';
                $args = array(
                    'post_type'         => 'post',
                    'posts_per_page'    => absint( $latest_posts_count ),
                    'cat'               => absint( $cat_id ),
                    'ignore_sticky_posts'   => true,
                    );                    
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
                $page_post['image']  	= has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_id(), 'post-thumbnail' ) : '';

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
// blog section content details.
add_filter( 'music_zone_filter_latest_posts_section_details', 'music_zone_get_latest_posts_section_details' );


if ( ! function_exists( 'music_zone_render_latest_posts_section' ) ) :
  /**
   * Start blog section
   *
   * @return string blog content
   * @since Music Zone 1.0.0
   *
   */
   function music_zone_render_latest_posts_section( $content_details = array() ) {
        $options = music_zone_get_theme_options();
        $latest_posts_content_type  = $options['latest_posts_content_type'];

        if ( empty( $content_details ) ) {
            return;
        } ?>
            <div id="music_zone_latest_posts_section"class="latest-posts-section relative page-section same-background">
                <div class="wrapper">
                    <?php if ( is_customize_preview()):
                    music_zone_section_tooltip( 'latest-posts-section-class' );
                    endif; ?>
                    <div class="section-header">
                        <?php if ( ! empty( $options['latest_posts_subtitle'] ) ) : ?>
                            <p class="section-subtitle"><?php echo esc_html( $options['latest_posts_subtitle'] ); ?></p>
                        <?php endif; ?>
                        <?php if ( ! empty( $options['latest_posts_title'] ) ) : ?>
                            <h2 class="section-title"><?php echo esc_html( $options['latest_posts_title'] ); ?></h2>
                        <?php endif; ?>                       
                    </div><!-- .section-header -->

                    <div class="archive-blog-wrapper col-3 clear">
                        <?php foreach ( $content_details as $content ) : ?>
                            <article>
                                <div class="post-wrapper">
                                    <div class="featured-image">
                                        <a href="<?php echo esc_url( $content['url'] ); ?>"><img src="<?php echo esc_url( $content['image'] ); ?>" alt="blog"></a>
                                    </div><!-- .featured-image -->

                                    <div class="entry-container">
                                    	<span class="posted-on">
                                    		<span class="screen-reader-text"><?php echo esc_html( 'Posted on', 'music-zone' ); ?></span> 
                                    		<a href="<?php echo esc_url( $content['url'] ); ?>" rel="bookmark">
                                    			<time class="entry-date published updated" datetime="2018-04-06T11:33:16+00:00"><?php echo get_the_date( 'M j, Y', $content['id'] ); ?>.</time>
                                    		</a>
                                    	</span><!-- .posted-on -->
                                        <header class="entry-header">
                                            <h2 class="entry-title"><a href="<?php echo esc_url( $content['url'] ); ?>"><?php echo esc_html( $content['title'] ); ?></a></h2>
                                        </header>
                                        <div class="entry-content">
                                            <p><?php echo esc_html( $content['excerpt'] ); ?></p>
                                        </div><!-- .entry-content -->
                                        
                                    </div><!-- .entry-container -->
                                </div><!-- .post-wrapper -->
                            </article>
                        <?php endforeach ; ?>
                    </div><!-- .archive-blog-wrapper -->
                </div><!-- .wrapper -->
            </div><!-- #latest-posts-section -->
        
    <?php }
endif;