<?php
/**
 * Template part for displaying front page imtroduction.
 *
 * @package Moral
 */


function music_zone_add_counter_section(){
    $options = music_zone_get_theme_options();
    // Check if counter is enabled on frontpage
    $counter_enable = apply_filters( 'music_zone_section_status', true, 'counter_section_enable' );

    $bg_image = !empty( $options['counter_image'] ) ? $options['counter_image'] : '';

    if ( true !== $counter_enable ) {
        return false;
    }

?>
    <div id="music_zone_counter_section" class="counter-section relative page-section" style="background-image: url('<?php echo esc_url( $bg_image ) ?>');">
        <div class="overlay"></div>
        <div class="wrapper">
            <?php if ( is_customize_preview()):
                    music_zone_section_tooltip( 'counter-section-class' );
                    endif; ?>
            <div class="section-content col-4 clear">
                 <?php for ($i=1; $i <= 4; $i++) : ?>
                    <article>
                        <div class="counter-item">
                            <?php if ( !empty( $options['counter_content_icon_'.$i] ) ): ?>
                                <div class="counter-icon">
                                    <i class="fa <?php echo esc_attr( $options['counter_content_icon_'.$i] ) ?> <?php echo esc_attr( 'counter_content_icon_' . $i ); ?>"></i>
                                </div><!-- .counter-icon -->
                            <?php endif ?>
                            <?php if ( !empty( $options['counter_number_'.$i] ) ): ?>
                                <h3 class="counter-value <?php echo esc_attr( 'counter_number_' . $i ); ?>"><?php echo esc_html( $options['counter_number_'.$i] ) ?></h3>                                
                            <?php endif ?>
                            <?php if ( !empty( $options['counter_title_'.$i] ) ): ?>
                                <h2 class="counter-title <?php echo esc_attr( 'counter_title_' . $i ); ?>"><?php echo esc_html( $options['counter_title_'.$i] ) ?></h2>
                            <?php endif ?>                            
                        </div>
                    </article>
                <?php endfor; ?>
               
            </div><!-- .section-content -->
        </div><!-- .wrapper -->
    </div><!-- #counter-section -->

<?php }