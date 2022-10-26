<?php

function just_music_customize_register( $wp_customize ) {

class Just_Music_Customize_Control_Section_Style extends WP_Customize_Control {

  	public function render_content() { 
  		 if ( empty( $this->choices ) ){
	      return;
	    } ?>

	    <?php if ( !empty( $this->label ) ){ ?>
	      <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
	    <?php } ?>

	    <?php if ( !empty( $this->description ) ){ ?>
	      <span class="description customize-control-description"><?php echo esc_html($this->description); ?></span>
	    <?php } ?>

	    <?php

	    $choices = $this->choices;

		?>

		<li  class="customize-control customize-control-radio" style="display: block;">	
			<?php foreach ( $choices as $value ){  ?>				
				<a href="#" class="mag-palace-edit" data-jump="<?php echo esc_attr( $value['section_id'] ); ?>"><span class="section-span-style" ><input class="section-input-style" type="radio" value="setting" >
					<label ><?php echo esc_html( $value['name'] ); ?></label></span></a>
			<?php } ?>
		</li>
	
  	<?php
  	}
}


class Just_Music_Dropdown_Category_Control extends WP_Customize_Control {

	public $type = 'dropdown-categories';

	public $taxonomy = '';

	public function __construct( $manager, $id, $args = array() ) {

		$taxonomy = 'category';
		if ( isset( $args['taxonomy'] ) ) {
			$taxonomy_exist = taxonomy_exists( esc_attr( $args['taxonomy'] ) );
			if ( true === $taxonomy_exist ) {
				$taxonomy = esc_attr( $args['taxonomy'] );
			}
		}
		$args['taxonomy'] = $taxonomy;
		$this->taxonomy = esc_attr( $taxonomy );

		parent::__construct( $manager, $id, $args );
	}

	public function render_content() {

		$tax_args = array(
			'hierarchical' => 0,
			'taxonomy'     => $this->taxonomy,
		);
		$taxonomies = get_categories( $tax_args );

	?>
    <label>
      <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
      <?php if ( ! empty( $this->description ) ) : ?>
      	<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
      <?php endif; ?>
       <select <?php $this->link(); ?> multiple>
			<?php
			printf( '<option value="%s" %s>%s</option>', '', selected( $this->value(), '', false ), '--None--' );
			?>
			<?php if ( ! empty( $taxonomies ) ) :  ?>
            <?php foreach ( $taxonomies as $key => $tax ) :  ?>
				<?php
				printf( '<option value="%s" %s>%s</option>', esc_attr( $tax->term_id ), selected( $this->value(), $tax->term_id, false ), esc_html( $tax->name ) );
				?>
            <?php endforeach ?>
			<?php endif ?>
       </select>
    </label>
    <?php
	}
}

class Just_Music_Switch_Control extends WP_Customize_Control{

		public $type = 'switch';

		public $on_off_label = array();

		public function __construct( $manager, $id, $args = array() ){
	        $this->on_off_label = $args['on_off_label'];
	        parent::__construct( $manager, $id, $args );
	    }

		public function render_content(){
	    ?>
		    <span class="customize-control-title">
				<?php echo esc_html( $this->label ); ?>
			</span>

			<?php if( $this->description ){ ?>
				<span class="description customize-control-description">
				<?php echo wp_kses_post( $this->description ); ?>
				</span>
			<?php } ?>

			<?php
				$switch_class = ( $this->value() == 'true' ) ? 'switch-on' : '';
				$on_off_label = $this->on_off_label;
			?>
			<div class="onoffswitch <?php echo esc_attr( $switch_class ); ?>">
				<div class="onoffswitch-inner">
					<div class="onoffswitch-active">
						<div class="onoffswitch-switch"><?php echo esc_html( $on_off_label['on'] ) ?></div>
					</div>

					<div class="onoffswitch-inactive">
						<div class="onoffswitch-switch"><?php echo esc_html( $on_off_label['off'] ) ?></div>
					</div>
				</div>	
			</div>
			<input <?php $this->link(); ?> type="hidden" value="<?php echo esc_attr( $this->value() ); ?>"/>
			<?php
	    }
	}

	class Just_Music_Dropdown_Chooser extends WP_Customize_Control{

		public $type = 'dropdown_chooser';

		public function render_content(){
			if ( empty( $this->choices ) )
	                return;
			?>
	            <label>
	                <span class="customize-control-title">
	                	<?php echo esc_html( $this->label ); ?>
	                </span>

	                <?php if($this->description){ ?>
		            <span class="description customize-control-description">
		            	<?php echo wp_kses_post($this->description); ?>
		            </span>
		            <?php } ?>

	                <select class="mag-palace-chosen-select" <?php $this->link(); ?>>
	                    <?php
	                    foreach ( $this->choices as $value => $label )
	                        echo '<option value="' . esc_attr( $value ) . '"' . selected( $this->value(), $value, false ) . '>' . esc_html( $label ) . '</option>';
	                    ?>
	                </select>
	            </label>
			<?php
		}
	}

Class Just_Music_Customize_Horizontal_Line extends WP_Customize_Control {

	public $type = 'hr';

	public function render_content() {
		?>
		<div>
			<hr style="border: 1px dotted #72777c;" />
		</div>
		<?php
	}
}
	
	require get_theme_file_path() . '/inc/customizer/about.php';
	require get_theme_file_path() . '/inc/customizer/album.php';
	
}
add_action( 'customize_register', 'just_music_customize_register' );

/*=============Active Callback=====================*/

function just_music_is_about_section_enable( $control ) {
	return ( $control->manager->get_setting( 'about_section_enable' )->value() );
}

function juju_music_is_album_section_enable( $control ) {
	return ( $control->manager->get_setting( 'album_section_enable' )->value() );
}

/*=============Partial Refresh=====================*/

function music_zone_about_btn_label_partial() {
    return esc_html( get_theme_mod( 'about_btn_label' ) );
}
