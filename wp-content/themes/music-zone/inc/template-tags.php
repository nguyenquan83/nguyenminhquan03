<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Theme Palace
 * @subpackage  Music Zone
 * @since  Music Zone 1.0.0
 */

if ( ! function_exists( 'music_zone_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function music_zone_posted_on( $id = '' ) {
		if ( false === music_zone_archive_meta_option( 'hide_date' ) ) {
			return;
		}

		$id = ! empty( $id ) ? $id : get_the_id();

		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U', $id ) !== get_the_modified_time( 'U', $id ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			get_the_date( DATE_W3C, $id ),
			get_the_date( '', $id ),
			get_the_modified_date( DATE_W3C, $id ),
			get_the_modified_date( '', $id )
		);
		
		$year   = get_the_date( 'Y' ,$id);
		$month  = get_the_date( 'm',$id );
        $day    = get_the_date( 'j',$id );


        // Wrap the time string in a link, and preface it with 'Posted on'.
		printf(
			/* translators: %s: post date */
			__( '<span class="posted-on"><span class="screen-reader-text">Posted on</span> %s', 'music-zone' ),
			'<a href="' . esc_url( get_day_link( $year, $month, $day ) ) . '" rel="bookmark">' . $time_string. '</a></span>'
		);
	}
endif;

if ( ! function_exists( 'music_zone_author' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function music_zone_author(  $post_id = '' ) {

		if ( false === music_zone_archive_meta_option( 'hide_author' ) ) {
			return;
		}
		$post_id = ! empty( $post_id ) ? $post_id : get_the_ID();
		$author_id = get_post_field('post_author', $post_id);

		// Get the author name; wrap it in a link.
		$byline = sprintf(
			/* translators: %s: post author */
			__( 'By: %s', 'music-zone' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( $author_id ) ) . '">' . get_the_author_meta('display_name', $author_id) . '</a></span>'
		);

		// Finally, let's write all of this to the page.
		return '<span class="byline"> ' . $byline . '</span>';
	}
endif;

if ( ! function_exists( 'music_zone_single_categories' ) ) :
	/**
	 * Prints HTML with meta information for the categories,
	 */
	function music_zone_single_categories() {
		$options = music_zone_get_theme_options();
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list(', ');
				if ( $categories_list && music_zone_categorized_blog() ) {
					printf( '<span class="cat-links"><span class="screen-reader-text">%1$s</span>%1$s%2$s' . '</span>',esc_html__('Categories : ','music-zone'), $categories_list ); // WPCS: XSS OK.
				}
		}

	}
endif;

if ( ! function_exists( 'music_zone_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the tags and comments.
	 */
	function music_zone_entry_footer() {
		$options = music_zone_get_theme_options();
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '',' ',' ');
				if ( $tags_list ) {
					printf( '<span class="tags-links">' . esc_html__( 'Tags: %1$s', 'music-zone' ) . '</span>', $tags_list ); // WPCS: XSS OK.
				}
		}

		edit_post_link(
			sprintf(
				/* translators: %s: Name of current post */
				esc_html__( 'Edit %s', 'music-zone' ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

/**
 * articles meta
 *  @param [id] $id post id
 *  @param [html] $authro author template
 */
function music_zone_article_footer_meta( $id = '' ) { 
	$id = ! empty( $id ) ? $id : get_the_id();
	if ( false === music_zone_archive_meta_option( 'hide_category' ) ) {
		return;
	}
	if ( 'post' !== get_post_type( $id ) ) { 
		return;
	}	
	$output = '';

	$categories_list = get_the_category_list( '', '', $id );
	if ( $categories_list && music_zone_categorized_blog() ) {
		$output .= sprintf( '<span class="cat-links"> %s</span>', $categories_list );
	}

    return $output;
}

/**
 * Checks to see if meta option is hide enabled in archive/blog
 */
function music_zone_archive_meta_option( $option = '' ) {
	$options = music_zone_get_theme_options();
	if ( is_archive() || is_search() || is_home() ) :
		if ( true === $options[$option] )
			return false;
		else
			return true;
	else :
		return true;
	endif;
}

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function music_zone_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'music_zone_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'music_zone_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so music_zone_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so music_zone_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in music_zone_categorized_blog.
 */
function music_zone_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'music_zone_categories' );
}
add_action( 'edit_category', 'music_zone_category_transient_flusher' );
add_action( 'save_post',     'music_zone_category_transient_flusher' );
