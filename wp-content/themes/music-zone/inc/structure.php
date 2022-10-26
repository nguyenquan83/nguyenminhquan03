<?php
/**
 * Theme Palace basic theme structure hooks
 *
 * This file contains structural hooks.
 *
 * @package Theme Palace
 * @subpackage  Music Zone
 * @since  Music Zone 1.0.0
 */

$options = music_zone_get_theme_options();  


if ( ! function_exists( 'music_zone_doctype' ) ) :
	/**
	 * Doctype Declaration.
	 *
	 * @since  Music Zone 1.0.0
	 */
	function music_zone_doctype() {
	?>
		<!DOCTYPE html>
			<html <?php language_attributes(); ?>>
	<?php
	}
endif;
add_action( 'music_zone_doctype', 'music_zone_doctype', 10 );


if ( ! function_exists( 'music_zone_head' ) ) :
	/**
	 * Header Codes
	 *
	 * @since  Music Zone 1.0.0
	 *
	 */
	function music_zone_head() {
		?>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="https://gmpg.org/xfn/11">
		<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
			<link rel="pingback" href="<?php echo esc_url( get_bloginfo( 'pingback_url' ) ); ?>">
		<?php endif;
	}
endif;
add_action( 'music_zone_before_wp_head', 'music_zone_head', 10 );

if ( ! function_exists( 'music_zone_page_start' ) ) :
	/**
	 * Page starts html codes
	 *
	 * @since  Music Zone 1.0.0
	 *
	 */
	function music_zone_page_start() {
		?>
		<div id="page" class="site">
			<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'music-zone' ); ?></a>
		<?php
	}
endif;
add_action( 'music_zone_page_start_action', 'music_zone_page_start', 10 );

if ( ! function_exists( 'music_zone_page_end' ) ) :
	/**
	 * Page end html codes
	 *
	 * @since  Music Zone 1.0.0
	 *
	 */
	function music_zone_page_end() {
		?>
		</div><!-- #page -->
		<?php
	}
endif;
add_action( 'music_zone_page_end_action', 'music_zone_page_end', 10 );

if ( ! function_exists( 'music_zone_site_branding' ) ) :
	/**
	 * Site branding codes
	 *
	 * @since  Music Zone 1.0.0
	 *
	 */
	function music_zone_site_branding() {
		$options  = music_zone_get_theme_options();
		$header_txt_logo_extra = $options['header_txt_logo_extra'];
		?>
		<div class="menu-overlay"></div>
		<header id="masthead" class="site-header" role="banner">
			<div class="wrapper">
				<div class="site-branding">
					<?php if ( in_array( $header_txt_logo_extra, array( 'show-all', 'logo-title', 'logo-tagline' ) ) && has_custom_logo()  ) : ?>
						<div class="site-logo">
							<?php the_custom_logo(); ?>
						</div>
					<?php endif; 

					if ( in_array( $header_txt_logo_extra, array( 'show-all', 'title-only', 'logo-title', 'show-all', 'tagline-only', 'logo-tagline' ) ) ) : ?>
						<div id="site-identity">
							<?php
							if( in_array( $header_txt_logo_extra, array( 'show-all', 'title-only', 'logo-title' ) )  ) {
								if ( music_zone_is_latest_posts() || music_zone_is_frontpage() ) : ?>
									<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
								<?php else : ?>
									<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
								<?php
								endif;
							}
							if ( in_array( $header_txt_logo_extra, array( 'show-all', 'tagline-only', 'logo-tagline' ) ) ) {
								$description = get_bloginfo( 'description', 'display' );
								if ( $description || is_customize_preview() ) : ?>
									<p class="site-description"><?php echo esc_html( $description ); /* WPCS: xss ok. */ ?></p>
									<?php
								endif; 
							} 
							?>
						</div>
					<?php endif; ?>
				</div><!-- .site-branding -->
                <nav id="site-navigation" class="main-navigation" role="navigation" aria-label="Primary Menu">
                    <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                    	<?php
                    	echo music_zone_get_svg( array( 'icon' => 'menu', 'class' => 'icon-menu' ) );
                    	echo music_zone_get_svg( array( 'icon' => 'close', 'class' => 'icon-menu' ) );
                    	?>	
                        <span class="menu-label"><?php esc_html_e('Menu', 'music-zone')?></span>
                    </button>

                    <?php  
						$search_html= null;
						if($options['search_icon_in_primary_menu_enable']){
							$search_html = sprintf(
											'<li class="search-menu"><a href="#" title="%1$s">%2$s%3$s</a><div id="search">%4$s</div>',
											esc_attr__('Search','music-zone'),
											music_zone_get_svg( array( 'icon' => 'search' ) ), 
											music_zone_get_svg( array( 'icon' => 'close' ) ), 
											get_search_form( $echo = false )
										);
							
						}else{
							$search_html = '';
						}

						wp_nav_menu( array(
							'theme_location' => 'primary',
							'container' => 'div',
							'menu_class' => 'menu nav-menu',
							'menu_id' => 'primary-menu',
							'echo' => true,
							'fallback_cb' => 'music_zone_menu_fallback_cb',
							'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s'.$search_html.'</ul>',
						) );
						
						
					?>
				</nav><!-- #site-navigation -->
        </header><!-- #masthead -->
		<?php 
	}
endif;
add_action( 'music_zone_header_action', 'music_zone_site_branding', 10 );

if ( ! function_exists( 'music_zone_content_start' ) ) :
	/**
	 * Site content codes
	 *
	 * @since  Music Zone 1.0.0
	 *
	 */
	function music_zone_content_start() {
		?>
		<div id="content" class="site-content">
		<?php
	}
endif;
add_action( 'music_zone_content_start_action', 'music_zone_content_start', 10 );

if ( ! function_exists( 'music_zone_header_image' ) ) :
    /**
     * Header Image codes
     *
     * @since  Music Zone 1.0.0
     *
     */
    function music_zone_header_image() {
		$options  = music_zone_get_theme_options();
        if ( music_zone_is_frontpage() )
            return;
        $header_image = get_header_image();
        ?>

    	<?php if ( is_singular() && $options['single_post_hide_banner'] == false ): ?>
    		<div id="page-site-header" class="relative" style="background-image: url('<?php echo esc_url( $header_image ); ?>');">
	    		
	            <div class="overlay"></div>
		            <div class="wrapper">
		                <header class="page-header">
		                    <?php music_zone_custom_header_banner_title(); ?>
		                </header>

		                <?php music_zone_add_breadcrumb(); ?>
		            </div><!-- .wrapper -->
	        </div><!-- #page-site-header -->
    	<?php endif ?>
    	<?php if (is_singular() && $options['single_post_hide_banner'] == true): ?>
    		<div class="header-wrapper wrapper">
                <header class="page-header">
                    <?php music_zone_custom_header_banner_title(); ?>
                </header>

                <?php music_zone_add_breadcrumb(); ?>
            </div><!-- .header-wrapper -->
    	<?php endif ?>

    	<?php if ( ( is_archive() || is_home() ) && $options['hide_banner'] == false ): ?>
    		<div id="page-site-header" class="relative" style="background-image: url('<?php echo esc_url( $header_image ); ?>');">
	    		
	            <div class="overlay"></div>
		            <div class="wrapper">
		                <header class="page-header">
		                    <?php music_zone_custom_header_banner_title(); ?>
		                </header>

		                <?php music_zone_add_breadcrumb(); ?>
		            </div><!-- .wrapper -->
	        </div><!-- #page-site-header -->
    	<?php endif ?>
    	<?php if ( ( is_archive() || is_home() ) && $options['hide_banner'] == true): ?>
    		<div class="header-wrapper wrapper">
                <header class="page-header">
                    <?php music_zone_custom_header_banner_title(); ?>
                </header>

                <?php music_zone_add_breadcrumb(); ?>
            </div><!-- .header-wrapper -->
    	<?php endif ?>
        <?php
    }
endif;
add_action( 'music_zone_header_image_action', 'music_zone_header_image', 10 );

if ( ! function_exists( 'music_zone_add_breadcrumb' ) ) :
	/**
	 * Add breadcrumb.
	 *
	 * @since  Music Zone 1.0.0
	 */
	function music_zone_add_breadcrumb() {
		$options = music_zone_get_theme_options();

		// Bail if Breadcrumb disabled.
		$breadcrumb = $options['breadcrumb_enable'];
		if ( false === $breadcrumb ) {
			return;
		}
		
		// Bail if Home Page.
		if ( music_zone_is_frontpage() ) {
			return;
		}

		echo '<div id="breadcrumb-list" >';
				/**
				 * music_zone_simple_breadcrumb hook
				 *
				 * @hooked music_zone_simple_breadcrumb -  10
				 *
				 */
				do_action( 'music_zone_simple_breadcrumb' );
		echo '</div><!-- #breadcrumb-list -->';
	}
endif;

if ( ! function_exists( 'music_zone_content_end' ) ) :
	/**
	 * Site content codes
	 *
	 * @since  Music Zone 1.0.0
	 *
	 */
	function music_zone_content_end() {
		?>
        </div><!-- #content -->
		<?php
	}
endif;
add_action( 'music_zone_content_end_action', 'music_zone_content_end', 10 );

if ( ! function_exists( 'music_zone_footer_start' ) ) :
	/**
	 * Footer starts
	 *
	 * @since  Music Zone 1.0.0
	 *
	 */
	function music_zone_footer_start() {
		?>
		<footer id="colophon" class="site-footer" role="contentinfo">
		<?php
	}
endif;
add_action( 'music_zone_footer', 'music_zone_footer_start', 10 );

if ( ! function_exists( 'music_zone_footer_site_info' ) ) :
	/**
	 * Footer starts
	 *
	 * @since  Music Zone 1.0.0
	 *
	 */
	function music_zone_footer_site_info() {
		$options = music_zone_get_theme_options();
		$search = array( '[the-year]', '[site-link]' );
		$theme_data = wp_get_theme();
        $replace = array( date( 'Y' ), '<a href="'. esc_url( home_url( '/' ) ) .'">'. esc_attr( get_bloginfo( 'name', 'display' ) ) . '</a>' );
        $options['copyright_text'] = str_replace( $search, $replace, $options['copyright_text'] );
		$copyright_text = $options['copyright_text'];
		?>
		<div class="site-info">
                <div class="wrapper">
                    <span>
                    <?php 
	                	echo music_zone_santize_allow_tag( $copyright_text ); 
	                	if ( function_exists( 'the_privacy_policy_link' ) ) {
							the_privacy_policy_link( ' | ' );
						}
                	?>
                	
					<?php echo esc_html__( ' | All Rights Reserved | ', 'music-zone' ) . esc_html( $theme_data->get( 'Name') ) . '&nbsp;' . esc_html__( 'by', 'music-zone' ). '&nbsp;<a target="_blank" href="'. esc_url( $theme_data->get( 'AuthorURI' ) ) .'">'. esc_html( ucwords( $theme_data->get( 'Author' ) ) ) .'</a>' ?>
                	</span>
                </div><!-- .wrapper -->    
            </div><!-- .site-info -->

		<?php
	}
endif;
add_action( 'music_zone_footer', 'music_zone_footer_site_info', 40 );

if ( ! function_exists( 'music_zone_footer_scroll_to_top' ) ) :
	/**
	 * Footer starts
	 *
	 * @since  Music Zone 1.0.0
	 *
	 */
	function music_zone_footer_scroll_to_top() {
		$options  = music_zone_get_theme_options();
		if ( true === $options['scroll_top_visible'] ) : ?>
			<div class="backtotop"><?php echo music_zone_get_svg( array( 'icon' => 'up' ) ); ?></div>
		<?php endif;
	}
endif;
add_action( 'music_zone_footer', 'music_zone_footer_scroll_to_top', 40 );


if ( ! function_exists( 'music_zone_loader' ) ) :
	/**
	 * Start div id #loader
	 *
	 * @since  Music Zone 1.0.0
	 *
	 */
	function music_zone_loader() {
		$options = music_zone_get_theme_options();
		if ( $options['loader_enable'] ) { ?>

			<div id="loader">
	            <div class="loader-container">
	            	<?php if ( 'default' == $options['loader_icon'] ) : ?>
		                <div id="preloader">
		                    <span></span>
		                    <span></span>
		                    <span></span>
		                    <span></span>
		                    <span></span>
		                </div>
		            <?php else :
		            	echo music_zone_get_svg( array( 'icon' => esc_attr( $options['loader_icon'] ) ) );
		            endif; ?>
	            </div>
	        </div><!-- #loader -->
		<?php }
	}
endif;
add_action( 'music_zone_before_header', 'music_zone_loader', 10 );


if ( ! function_exists( 'music_zone_infinite_loader_spinner' ) ) :
	/**
	 *
	 * @since  Music Zone 1.0.0
	 *
	 */
	function music_zone_infinite_loader_spinner() { 
		global $post;
		$options = music_zone_get_theme_options();
		if ( $options['pagination_type'] == 'infinite' ) :			
			echo '<div class="blog-loader">' . music_zone_get_svg( array( 'icon' => 'spinner-umbrella' ) ) . '</div>';			
		endif;
	}
endif;
add_action( 'music_zone_infinite_loader_spinner_action', 'music_zone_infinite_loader_spinner', 10 );
