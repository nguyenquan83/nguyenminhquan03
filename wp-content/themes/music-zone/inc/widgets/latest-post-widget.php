<?php
/**
 * Recent Posts Widget
 *
 * @package Theme Palace
 * @subpackage Music Zone
 * @since Music Zone 1.0.0
 */

if ( ! class_exists( 'music_zone_Recent_Post' ) ) :

     
    class Music_Zone_Recent_Post extends WP_Widget {
        /**
         * Sets up the widgets name etc
         */
        public $default_title   = '';

        public function __construct() {
            $tp_widget_recent_post = array(
                'description' => esc_html__( 'Latest posts.', 'music-zone' ),
            );
            $this->default_title = __( 'Latest Posts &amp; Pages', 'music-zone' );

            parent::__construct( 'widget_latest_posts', esc_html__( 'TP : Latest Posts', 'music-zone' ), $tp_widget_recent_post );
        }



        function form( $instance ) {
            $instance = wp_parse_args( (array) $instance, $this->defaults() );
    
            if ( false === $instance['title'] ) {
                $instance['title'] = $this->default_title;
            }
            $title = stripslashes( $instance['title'] );
            $ordering = isset( $instance['ordering'] ) && array('name', 'date') ?  $instance['ordering'] : 'date' ;
    
            $count = isset( $instance['count'] ) ? (int) $instance['count'] : 10;
            if ( $count < 1 || 10 < $count ) {
                $count = 10;
            }
    
            $allowed_post_types =  get_post_types( array( 'public' => true ) ) ;
            unset( $allowed_post_types['attachment'] );
            $allowed_post_types = array_values($allowed_post_types);

            $types              = isset( $instance['types'] ) ? (array) $instance['types'] : 'post';
    
    
            ?>
            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'music-zone' ); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
            </p>
    
            <p>
                <label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php esc_html_e( 'Maximum number of posts to show (no more than 10):', 'music-zone' ); ?></label>
                <input id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" type="number" value="<?php echo (int) $count; ?>" min="1" max="20" />
            </p>
            <hr>
            <p>
                <label for="<?php echo $this->get_field_id( 'types' ); ?>"><?php esc_html_e( 'Types of content to display:', 'music-zone' ); ?></label>
                <ul>
                    <?php
                    foreach ( $allowed_post_types as $type ) {
                        // Get the Post Type name to display next to the checkbox
                        $post_type_object = get_post_type_object( $type );
                        $label            = $post_type_object->labels->name;
    
                        $checked = '';
                        if ( in_array( $type, $types ) ) {
                            $checked = 'checked="checked" ';
                        }
                        ?>
    
                        <li><label>
                            <input value="<?php echo esc_attr( $type ); ?>" name="<?php echo $this->get_field_name( 'types' ); ?>" id="<?php echo $this->get_field_id( 'types' ); ?>-<?php echo $type; ?>" type="radio" <?php echo $checked; ?> />
                            <?php echo esc_html( $label ); ?>
                        </label></li>
    
                    <?php } // End foreach ?>
                </ul>
            </p>
            <hr>
            <p>
                <label><?php esc_html_e( 'Sort By:', 'music-zone' ); ?></label>
                <ul>
                    <li>
                        <label>
                            <input id="<?php echo $this->get_field_id( 'ordering' ); ?>" name="<?php echo $this->get_field_name( 'ordering' ); ?>" type="radio" value="date" <?php checked( 'date', $ordering ); ?> /> 
                            <?php esc_html_e( 'Published Date', 'music-zone' ); ?>
                        </label>
                    </li>
                    <li>
                        <label>
                            <input id="<?php echo $this->get_field_id( 'ordering' ); ?>" name="<?php echo $this->get_field_name( 'ordering' ); ?>" type="radio" value="name" <?php checked( 'name', $ordering ); ?> /> 
                            <?php esc_html_e( 'Alphabetical ', 'music-zone' ); ?>
                        </label>
                    </li>
                </ul>
            </p>
            <?php
    
        }

        function widget( $args, $instance ) {
    
            $instance = wp_parse_args( (array) $instance, $this->defaults() );
    
            $title = isset( $instance['title'] ) ? $instance['title'] : false;
            if ( false === $title ) {
                $title = $this->default_title;
            }
            /** This filter is documented in core/src/wp-includes/default-widgets.php */
            $title = apply_filters( 'widget_title', $title );

            $count = isset( $instance['count'] ) ? (int) $instance['count'] : false;
            if ( $count < 1 || 20 < $count ) {
                $count = 20;
            }
            $ordering = isset( $instance['ordering'] ) && array('name', 'date') ?  $instance['ordering'] : 'date' ;

            /**
             * Control the number of displayed posts.
             *
             * @module widgets
             *
             * @since 3.3.0
             *
             * @param string $count Number of Posts displayed in the Top Posts widget. Default is 10.
             */
    
            $types = isset( $instance['types'] ) ? (array) $instance['types'] : array( 'post', 'page' );
    
            echo $args['before_widget'];
            if ( ! empty( $title ) ) {
                echo "<div class='widget-header'>". $args['before_title'] . $title . $args['after_title'] . "</div>";
            } 
            $post_args = array(
                'numberposts' => $count,
                'post_type'   => $types,
                'category'    => 0,
                'orderby'     => $ordering,
                'order'       => 'ASC',
              );           

              $posts = get_posts( $post_args ); ?>

                <ul class="widget_latest_posts">
                    <?php foreach($posts as $index=>$post) : ?>
                        <li>
                            <div class="featured-image">
                                <a href="<?php echo esc_url( get_permalink( $post->ID ) ); ?>">
                                    <img src="<?php echo has_post_thumbnail( $post->ID ) ? get_the_post_thumbnail_url( $post->ID, 'thumbnail') : get_template_directory_uri() .'/assets/uploads/no-featured-image-600x450.jpg'; ?>" alt="<?php echo esc_attr($post->post_title); ?>">
                                </a>
                            </div>
                            <div class="entry-container">
                                <?php music_zone_posted_on($post->ID);?>
                                <h2 class="entry-title"><a href="<?php echo esc_url( get_permalink($post->ID) );?>"><?php echo $post->post_title; ?></a></h2>
                            </div><!-- .entry-container -->
                        </li>
                    <?php endforeach; ?>
                </ul>
                <?php wp_reset_postdata(); ?>

            <?php echo $args['after_widget'];
        }
    
     
        function update( $new_instance, $old_instance ) {
            // processes widget options to be saved
            $instance          = array();
            $instance['title'] = wp_kses( $new_instance['title'], array() );
            if ( $instance['title'] === $this->default_title ) {
                $instance['title'] = false; // Store as false in case of language change
            }
    
            $instance['count'] = (int) $new_instance['count'];
            if ( $instance['count'] < 1 || 20 < $instance['count'] ) {
                $instance['count'] = 20;
            }

            if ( isset( $new_instance['ordering'] ) && in_array( $new_instance['ordering'], array( 'date', 'name' ) ) ) {
                $instance['ordering'] =  $new_instance['ordering'];
            }else{
                $instance['ordering'] =  'date';
            }

    
            $allowed_post_types =  get_post_types( array( 'public' => true ) );
            unset( $allowed_post_types['attachment'] );
            $allowed_post_types = array_values( $allowed_post_types );
            $instance['types']  = $new_instance['types'];
            foreach ( $new_instance['types'] as $key => $type ) {
                if ( ! in_array( $type, $allowed_post_types ) ) {
                    unset( $new_instance['types'][ $key ] );
                }
            }
            return $instance;
        } 
         
        public static function defaults() {
            return array(
                'title'    => esc_html__( 'Latest Posts', 'music-zone' ),
                'count'    => absint( 5 ),
                'types'    => 'post',
                'ordering' => 'date',
            );
        }
    
    }
endif;
