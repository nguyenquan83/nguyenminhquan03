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
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'clear' ); ?>>
	<div class="featured-image">
		<a href="<?php the_permalink(); ?>"><img src="<?php the_post_thumbnail_url( 'large' ) ?>" alt="<?php the_title(); ?>"></a>
	</div>
	<div class="entry-container">
		<div class="entry-content">
			<?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'music-zone' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'music-zone' ),
				'after'  => '</div>',
			) );
			?>
		</div><!-- .entry-content -->
	</div><!-- .entry-container -->


	<div class="entry-meta">
		<?php 
			echo music_zone_author();
			
		if (! $options['single_post_hide_date'] ) :
			music_zone_posted_on();
		endif; 

		music_zone_single_categories();
		music_zone_entry_footer(); ?>
	</div>

</article><!-- #post-## -->
