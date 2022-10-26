<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Theme Palace
 * @subpackage  Music Zone
 * @since  Music Zone 1.0.0
 */

$options = music_zone_get_theme_options();
$read_more = ! empty( $options['read_more_text'] ) ? $options['read_more_text'] : esc_html__( 'Read Full Article', 'music-zone' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="post-wrapper">
            <?php if ( has_post_thumbnail() ) : ?>
                <div class="featured-image">
                    <a href="<?php the_permalink(); ?>"><img src="<?php the_post_thumbnail_url( 'large' ) ?>" alt="<?php the_title(); ?>"></a>
                </div><!-- .featured-image -->
            <?php endif; ?>

        <div class="entry-container">       
            <header class="entry-header">
                <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            </header>

            <div class="entry-content">
                <?php the_excerpt(); ?>
            </div><!-- .entry-content -->
        </div><!-- .entry-container -->
    </div><!-- .post-wrapper -->
</article>