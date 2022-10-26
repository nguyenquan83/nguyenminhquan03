<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Theme Palace
 * @subpackage Musicsong Pro
 * @since Musicsong Pro 1.0.0
 */

get_header(); 
?>

<div id="inner-content-wrapper" class="wrapper page-section">
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
			<?php
			while ( have_posts() ) : the_post();?>

				<p class="tp-education-meta entry-meta">
					<?php  
					// event date
					tp_event_date();

					// event start time
					tp_event_start_time();

					// event end time
					tp_event_end_time();

					// event location
					tp_event_location();
					?>
				</p><!-- .tp-education-meta -->

				<?php 
				get_template_part( 'template-parts/content', 'single' );

				/**
				* Hook music_zone_action_post_pagination
				*  
				* @hooked music_zone_post_pagination 
				*/
				do_action( 'music_zone_action_post_pagination' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>
		</main><!-- #main -->
	</div><!-- #primary -->

	<?php  
	if ( music_zone_is_sidebar_enable() ) {
		get_sidebar();
	}
	?>
</div><!-- .page-section -->
<?php
get_footer();
