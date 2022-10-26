<?php
/**
 * Playlist section
 *
 * This is the template for the content of playlist section
 *
 * @package Theme Palace
 * @subpackage Music Zone
 * @since Music Zone 1.0.0
 */
if ( ! function_exists( 'music_zone_add_playlist_section' ) ) :
    /**
    * Add playlist section
    *
    *@since Music Zone 1.0.0
    */
    function music_zone_add_playlist_section() {
    	$options = music_zone_get_theme_options();
        // Check if playlist is enabled on frontpage
        $playlist_enable = apply_filters( 'music_zone_section_status', true, 'playlist_section_enable' );

        if ( true !== $playlist_enable ) {
            return false;
        }

        // Render playlist section now.
        music_zone_render_playlist_section();
    }
endif;

if ( ! function_exists( 'music_zone_render_playlist_section' ) ) :
  /**
   * Start playlist section
   *
   * @return string playlist content
   * @since Music Zone 1.0.0
   *
   */
   function music_zone_render_playlist_section() {
        $options = music_zone_get_theme_options();
        $playlist = ! empty( $options['playlist_content'] ) ? $options['playlist_content'] : array();
        $bg_image = !empty( $options['playlist_bg_image'] ) ? $options['playlist_bg_image'] : '';
        if ( empty( $playlist ) )
            return;

       ?>

        <div id="music_zone_playlist_section" class="relative page-section" style="background-image: url('<?php echo esc_url( $bg_image ); ?>');">
            <div class="overlay"></div>
            <div class="wrapper">
                <div class="section-header">
                    <?php if ( !empty( $options['playlist_subtitle'] ) ): ?>
                        <p class="section-subtitle"><?php echo esc_html( $options['playlist_subtitle'] ); ?></p>
                    <?php endif ?>
                    <?php if ( !empty( $options['playlist_title'] ) ): ?>
                        <h2 class="section-title"><?php echo esc_html( $options['playlist_title'] ); ?></h2>
                    <?php endif ?>
                </div><!-- .section-header -->
                <?php if ( ! empty( $playlist ) ) :
                    $playlist = implode(',', $playlist); ?>
                    <div class="playlist"> 
                        <div class="wp-playlist-tracks">
                            <?php 
                            $playlist_shortcode = '[playlist type="audio" ids="' . $playlist . '" style="light"]';
                            echo do_shortcode( wp_kses_post( $playlist_shortcode ) );  
                            ?>
                        </div><!-- .wp-playlist-tracks -->
                        <?php if ( !empty( $options['playlist_image'] ) ): ?>

                            <div class="featured-image">
                                <img src="<?php echo esc_url( $options['playlist_image'] ); ?>" alt="03">
                            </div><!-- .featured-image -->
                        <?php endif ?>
                    </div><!-- .playlist -->
                <?php endif; ?>
            </div><!-- .wrapper -->
        </div><!-- #music_zone_pro_playlist_section -->      
    <?php }
endif;