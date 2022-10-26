<?php

if ( ! function_exists( 'just_music_add_album_section' ) ) :

    function just_music_add_album_section() {

        $album_enable = get_theme_mod( 'album_section_enable', false );

        if ( true !== $album_enable ) {
            return false;
        }

        $section_details = array();
        $section_details = apply_filters( 'just_music_filter_album_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        just_music_render_album_section( $section_details );
    }
endif;

if ( ! function_exists( 'just_music_get_album_section_details' ) ) :

    function just_music_get_album_section_details( $input ) {
        
        $content = array();

        $page_ids = array();

        for ( $i = 1; $i <= 3; $i++ ) {
            if ( ! empty( get_theme_mod('album_content_product_' . $i) ) ) {
                $page_ids[] = get_theme_mod('album_content_product_' . $i);
            }
        }
        
        $args = array(
            'post_type'         => 'product',
            'post__in'          => ( array ) $page_ids,
            'posts_per_page'    => 3,
            'orderby'           => 'post__in',
        );                    
           
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) : 
            while ( $query->have_posts() ) : $query->the_post();
                $page_post['id']        = get_the_id();
                $page_post['title']     = get_the_title();
                $page_post['url']       = get_the_permalink();
                $page_post['image']     = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_id(), 'post-thumbnail' ) : get_theme_file_uri() . '/assets/uploads/no-featured-image-600x450.jpg';
               
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

add_filter( 'just_music_filter_album_section_details', 'just_music_get_album_section_details' );


if ( ! function_exists( 'just_music_render_album_section' ) ) :

   function just_music_render_album_section( $content_details = array() ) {

        if ( empty( $content_details ) ) {
            return;
        } ?>
        <div id="music_zone_album_section" class="album-section relative page-section same-background">
            <div class="wrapper">
                <?php if ( is_customize_preview()):
                    music_zone_section_tooltip( 'album-section-class' );
                endif; ?>
                <div class="section-header">
                    <?php if ( !empty( get_theme_mod('album_subtitle', '') ) ): ?>
                        <p class="section-subtitle"><?php echo esc_html( get_theme_mod('album_subtitle', '') ); ?></p>
                    <?php endif ?>
                    <?php if ( !empty( get_theme_mod('album_title') ) ): ?>
                        <h2 class="section-title"><?php echo esc_html( get_theme_mod('album_title', '') ); ?></h2>
                    <?php endif ?>                    
                </div>

                <div class="section-content col-3 clear">
                    <?php $i=1; foreach ( $content_details as $content ) : ?>
                    <article>
                        <div class="album-item">
                            <div class="featured-image" style="background-image: url('<?php echo esc_url( $content['image'] ); ?>');">
                                <a href="<?php echo esc_url( $content['url'] ); ?>"></a>
                            </div>

                            <div class="entry-container">
                                <header class="entry-header">
                                    <h2 class="entry-title"><a href="<?php echo esc_url( $content['url'] ); ?>"><?php echo esc_html( $content['title'] ); ?></a></h2>
                                </header>

                                <?php if ( !empty(get_theme_mod('album_post_subtitle_' . $i, '')) ): ?>
                                    <div class="entry-content">
                                        <p><?php echo esc_html( get_theme_mod('album_post_subtitle_' . $i, '') ); ?></p>
                                    </div>
                                <?php endif ?>                            
                            </div>
                        </div>
                    </article>
                    <?php $i++; endforeach; ?>
                </div>
            </div>
        </div>
        
    <?php }
endif;