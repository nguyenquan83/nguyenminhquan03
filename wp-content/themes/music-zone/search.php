<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Theme Palace
 * @subpackage Music Zone
 * @since Music Zone 1.0.0
 */

get_header(); 
$options = music_zone_get_theme_options();
$col_layout = $options['sidebar_position'] == 'no-sidebar' ? 'col-3' : 'col-2';
?>

<div id="inner-content-wrapper" class="wrapper page-section">
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <div class="archive-blog-wrapper <?php echo $col_layout ; ?> clear">
				<?php
				if ( have_posts() ) : ?>

					<?php
					/* Start the Loop */
					while ( have_posts() ) : the_post();

						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'template-parts/content', get_post_format() );

					endwhile;

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif; ?>
			</div>
			<?php  
			/**
			* Hook - music_zone_action_pagination.
			*
			* @hooked music_zone_pagination 
			*/
			do_action( 'music_zone_action_pagination' ); 

			/**
			* Hook - music_zone_infinite_loader_spinner_action.
			*
			* @hooked music_zone_infinite_loader_spinner 
			*/
			do_action( 'music_zone_infinite_loader_spinner_action' );
			?>
		</main><!-- #main -->
	</div><!-- #primary -->

	<?php  
	if ( music_zone_is_sidebar_enable() ) {
		get_sidebar();
	}
	?>
</div><!-- .wrapper -->

<?php
get_footer();
