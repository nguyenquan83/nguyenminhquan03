<?php

if ( ! function_exists( 'just_music_add_about_section' ) ) :

    function just_music_add_about_section() {

        $about_enable = get_theme_mod( 'about_section_enable', false );

        if ( true !== $about_enable ) {
            return false;
        }

        $section_details = array();
        $section_details = apply_filters( 'just_music_filter_about_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        just_music_render_about_section( $section_details );
    }
endif;

if ( ! function_exists( 'just_music_get_about_section_details' ) ) :

    function just_music_get_about_section_details( $input ) {

        $content = array();

        $page_id = ! empty( get_theme_mod( 'about_content_page', '' ) ) ? get_theme_mod( 'about_content_page', '' ) : '';
        $args = array(
            'post_type'         => 'page',
            'page_id'           => $page_id,
            'posts_per_page'    => 1,
            );                    
          

        $query = new WP_Query( $args );
        if ( $query->have_posts() ) : 
            while ( $query->have_posts() ) : $query->the_post();
                $page_post['title']     = get_the_title();
                $page_post['url']       = get_the_permalink();
                $page_post['excerpt']   = music_zone_trim_content( 50 );
                $page_post['image']     = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_id(), 'post-thumbnail' ) : '';

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

add_filter( 'just_music_filter_about_section_details', 'just_music_get_about_section_details' );


if ( ! function_exists( 'just_music_render_about_section' ) ) :

function just_music_render_about_section( $content_details = array() ) {
    $readmore = ! empty( get_theme_mod( 'about_btn_label', '' ) ) ? get_theme_mod( 'about_btn_label', '' ) : esc_html__( 'Read More', 'just-music' );

    if ( empty( $content_details ) ) {
        return;
    } ?>
        <div id="music_zone_about_section" class="about-section relative page-section same-background">
            <div class="wrapper">
                <?php if ( is_customize_preview()):
                    music_Zone_section_tooltip( 'about-section-class' );
                    endif; ?>
                <?php foreach ($content_details as $content ): ?>
                    <article class="has-post-thumbnail">
                        <?php if ( !empty( $content['image'] ) ): ?>
                            <div class="featured-image">
                                <a href="<?php echo esc_url( $content['url'] ); ?>"><img src="<?php echo esc_url( $content['image'] ); ?>" alt="about"></a>
                            </div>
                        <?php endif ?>                        

                        <div class="entry-container">
                            <div class="section-header">
                                <?php if ( !empty( get_theme_mod( 'about_subtitle', '' ) ) ): ?>
                                    <p class="section-subtitle"><?php echo esc_html( get_theme_mod( 'about_subtitle', '' ) ); ?></p>
                                <?php endif ?>
                                
                                <h2 class="section-title"><a href="<?php echo esc_url( $content['url'] ); ?>"><?php echo esc_html( $content['title'] ); ?></a></h2>
                            </div>

                            <div class="entry-content">
                                <?php echo wp_kses_post( $content['excerpt'] ); ?>
                            </div>

                            <div class="read-more">
                                <a href="<?php echo esc_url( $content['url'] ); ?>" class="btn"><?php echo esc_html( $readmore ); ?></a>
                            </div>
                        </div>
                    </article>
                <?php endforeach ?>           
            </div>
        </div>
    <?php }
endif;
