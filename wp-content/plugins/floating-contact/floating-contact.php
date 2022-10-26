<?php
/*
Plugin Name: Floating Contact Button
Description: Integrates a floating contact button and opens an modal with your favorite contact form.
Version: 2.6
Author: Christoph Nagel
Author URI: https://www.cms-geek.de
Text Domain: floating-contact
Domain Path: /languages
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Floating Contact Button is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
Floating Contact Button is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with Floating Contact Button. If not, see License URI: https://www.gnu.org/licenses/gpl-2.0.html.
*/

defined( 'ABSPATH' ) or die( 'Are you ok?' );

function fcb_files() {
   wp_enqueue_style( 'custom', plugin_dir_url(__FILE__) . 'assets/css/style.min.css', array(), 1.0, 'screen' );
}
add_action( 'wp_enqueue_scripts', 'fcb_files');

function fcb_load_dashicons(){
   wp_enqueue_style('dashicons');
}
add_action('wp_enqueue_scripts', 'fcb_load_dashicons', 999);

add_action('plugins_loaded', 'fcb_load_textdomain');
function fcb_load_textdomain() {
   load_plugin_textdomain( 'floating-contact', false, dirname( plugin_basename(__FILE__) ) . '/languages/' );
}

function fcb_styles_method() {
	wp_enqueue_style('custom-style', plugin_dir_url(__FILE__) . 'assets/css/style.min.css');
	$options = get_option( 'fcb_options' );
	if ( ! empty( $options['fcb_field_rotate'] ) ) {
    		$rotate = "none";
	} else {
    		$rotate = "rotate(90deg)";}
        $color = get_option( 'fcb_options' )['fcb_field_bgcolor'];
        $custom_css = "
        i.fcb-icons {
            background: {$color} !important;
		    border-color: {$color} !important;
        }
		i.fcb-icons:hover {
		    color: {$color} !important;
		}
		i.fcb-icons:after {
		    border-color: {$color} !important;	
		}
		i.fcb-icons:hover {
		    transform: {$rotate} !important;
		}
		#fcb-modal input[type=\"submit\"]:hover {
		    border: 1px solid {$color} !important;
	        background-color: {$color} !important;
		}";
        wp_add_inline_style( 'custom-style', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'fcb_styles_method' );

function fcb_settings_init() {

 register_setting( 'floating-contact', 'fcb_options' );
 add_settings_section('fcb_section_developers',__( 'Plugin Settings', 'floating-contact' ),'fcb_section_developers_cb','floating-contact');
 
 add_settings_field('floating-contact_field_shortcode',__( 'Insert here your shortcode:', 'floating-contact' ),'fcb_field_shortcode_cb','floating-contact','fcb_section_developers',
 [
 'label_for' => 'fcb_field_shortcode',
 'class' => 'fcb_row',
 'fcb_custom_data' => 'custom',
 ]
 );

 add_settings_field('floating-contact_field_bgcolor',__( 'Button color (optional):', 'floating-contact' ),'fcb_field_bgcolor_cb','floating-contact','fcb_section_developers',
 [
 'label_for' => 'fcb_field_bgcolor',
 'class' => 'fcb_row',
 'fcb_custom_data' => 'custom',
 ]
 );

 add_settings_field('floating-contact_field_rotate',__( 'Disable rotation:', 'floating-contact' ),'fcb_field_rotate_cb','floating-contact','fcb_section_developers',
 [
 'label_for' => 'fcb_field_rotate',
 'class' => 'fcb_row',
 'fcb_custom_data' => 'custom',
 ]
 );
}
add_action( 'admin_init', 'fcb_settings_init' );
 
function fcb_section_developers_cb( $args ) {
 ?>
<p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( '1. Install your favorite contact form plugin. Tested with Contact Form 7, Ninja Forms & Caldera Forms.', 'floating-contact' ); ?></p>
<p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( '2. Generate a form and entering the shortcode into the field. This form will shown in the modal, when the Floating Contact Button is clicked.', 'floating-contact' ); ?></p>
<p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( '3. Change the main color of the button (default value: #ff0000).', 'floating-contact' ); ?></p>
<?php
}
 
function fcb_field_shortcode_cb( $args ) {
 $options = get_option( 'fcb_options' );
 ?>
 <input type="text" name="fcb_options[fcb_field_shortcode]" value="<?php echo str_replace('"', '&quot;', $options['fcb_field_shortcode']); ?>" style="width: 450px;">
 <?php
}

function fcb_field_bgcolor_cb( $args ) {
 $options = get_option( 'fcb_options' );
 ?>
<input type="text" name="fcb_options[fcb_field_bgcolor]" value="<?php echo str_replace('"', '&quot;', $options['fcb_field_bgcolor']); ?>" style="width: 80px;">
 <?php
}

function fcb_field_rotate_cb() {
    $options = get_option( 'fcb_options' );    
    if( !isset( $options['fcb_field_rotate'] ) ) $options['fcb_field_rotate'] = 0;
    $html = '<input type="checkbox" name="fcb_options[fcb_field_rotate]" value="1"' . checked( 1, $options['fcb_field_rotate'], false ) . '/>';
    echo $html;
}

function fcb_options_page() {
 add_menu_page('Floating Contact Button','Floating Contact','manage_options','floating-contact','fcb_options_page_html','dashicons-format-chat', 99);
}

add_action( 'admin_menu', 'fcb_options_page' );
 
function fcb_options_page_html() {
 if ( ! current_user_can( 'manage_options' ) ) {
 return;
 }
 
 if ( isset( $_GET['settings-updated'] ) ) {
 add_settings_error( 'fcb_messages', 'fcb_message', __( 'Settings Saved', 'floating-contact' ), 'updated' );
 }
 
 settings_errors( 'fcb_messages' );
 ?>
 <div class="wrap">
 <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
 <form action="options.php" method="post">
 <?php
 settings_fields( 'floating-contact' );
 do_settings_sections( 'floating-contact' );
 submit_button(__( 'Save Settings', 'floating-contact' ));
 ?>
 </form>
 </div>
 <?php
}

add_action('wp_footer', 'fcb_body_code');
function fcb_body_code() {

$fcb_shortcode = get_option( 'fcb_options' )['fcb_field_shortcode']; 

  echo ' <a href="#fcb-modal" class="fcb-link-button"><i class="fcb-icons"><span class="dashicons dashicons-format-chat"></span></i></a>';
  echo ' <div id="fcb-modal">';
  echo ' <div class="fcb-header"><a href="#" class="close-fcb-modal"><div class="fcb-header-close"><span class="fcb-close">X</span></div></a></div>';
  echo ' <div class="fcb-modal-content"> ';
  echo ' <p>'.do_shortcode($fcb_shortcode).'</p>';
  echo ' </div>';
  echo ' <div class="overlay"></div>';
  echo ' </div>';
}
?>