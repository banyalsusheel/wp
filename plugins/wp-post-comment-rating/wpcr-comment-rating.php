<?php
/**
* Plugin Name: Custom Post Rating by Visitarian
* Plugin URI: http://visitarians.com
* Description: A plugin for adding rating functionality to WordPress Post with comments.
* Version: 1.0.0
* Author: Visitarian
*/

add_action('admin_init', 'wpcr_register_options');  // register options for the form
add_action('admin_menu', 'wpcr_admin_links');  // register admin menu hyperlinks

//include necessary files
		
	include_once(  plugin_dir_path( __FILE__ ) . 'inc/setting.php');	
	include_once(  plugin_dir_path( __FILE__ ) . 'inc/function.php');	
	
/////// admin enqueue scripts ///////
function wpcr_admin_enqueue() {
	wp_enqueue_style( 'wpcr_custom_style', plugin_dir_url( __FILE__ ) . 'css/adminstyle.css' );
	wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'wpcr-script-handle', plugin_dir_url( __FILE__ ).'js/admin-script.js', array( 'wp-color-picker' ), false, true );
}
add_action( 'admin_enqueue_scripts', 'wpcr_admin_enqueue' );

////// wp enqueue scripts //////
function wpcr_enqueue_style() {

	wp_enqueue_script( 'wpcr_js', plugin_dir_url( __FILE__ ) . 'js/custom.js', array('jquery'),'1.0' , true );
    wp_enqueue_style( 'wpcr_font-awesome', plugin_dir_url( __FILE__ ) . 'css/font-awesome.css' );
	wp_enqueue_style( 'wpcr_style', plugin_dir_url( __FILE__ ) . 'css/style.css' );
}
add_action( 'wp_enqueue_scripts', 'wpcr_enqueue_style' );

///// Function to register form fields //////
function wpcr_register_options(){
    register_setting('wpcr_options_group', 'wpcr_settings', 'wpcr_validate');
}

///// Function to add hyperlinks to the admin menus using hooks and filters //////
function wpcr_admin_links() {
  add_options_page('Rating Setup', 'Post Rating', 'manage_options', 'commentrating', 'wpcr_admin_page' );  // add link to settings page
}

///// Validate User Input ///////
function wpcr_validate($input) {
  return array_map('wp_filter_nohtml_kses', (array)$input);
}

function wpcr_admin_page() { ?>
<div class="wpcsr_wrapper">
  <h2><?php _e('Setting');?></h2>
  <div class="left-area">
  <form method="post" action="options.php">
  <?php
  settings_fields('wpcr_options_group');
  $wpcr_options = get_option('wpcr_settings');
  ?>
  
  <div class="row-outer">
  <div class="col-1">
  <span><?php _e('Enable rating with comment form');?></span>
  </div>
  <div class="col-2">
  <input type="checkbox" name="wpcr_settings[checkbox1]" value="yes" <?php checked('yes', $wpcr_options['checkbox1']); ?> />
  </div>
  </div>
  
  <div class="row-outer">
  <div class="col-1">
  <span><?php _e('Show average rating after post title');?></span>
  </div>
  <div class="col-2">
  <input type="checkbox" name="wpcr_settings[checkbox2]" value="yes" <?php checked('yes', $wpcr_options['checkbox2']); ?> />
  <span class="averagerating_info"><?php _e('Add "the_tags()" function after title if average rating is not shown.');?></span>
  </div>
  </div>
  
  <div class="row-outer">
  <div class="col-1">
  <span><?php _e('Rating label');?></span>
  </div>
  <div class="col-2">
  <input type="text" name="wpcr_settings[rtlabel]" placeholder="Please rate" value="<?php echo esc_attr( $wpcr_options['rtlabel']); ?>"  />
  </div>
  </div>
  
  <div class="row-outer">
  <div class="col-1">
  <span><?php _e('Ratings Image');?></span>
  </div>
  <div class="col-2">
  <div class="imgrow">
  <input type="radio" name="wpcr_settings[rateimage]" value="grateimg" <?php checked('grateimg', $wpcr_options['rateimage']); ?>  />
  <span class="enable_grateimg"><img src="<?php echo plugin_dir_url( __FILE__ ) . 'images/star1.png'?>" alt=""/></span>
  </div>
  <div class="imgrow">
  <input type="radio" name="wpcr_settings[rateimage]" value="orateimg" <?php checked('orateimg', $wpcr_options['rateimage']); ?>  />
  <span class="enable_orateimg"><img src="<?php echo plugin_dir_url( __FILE__ ) . 'images/star2.png'?>" alt=""/></span>
  </div>
  </div>
  </div>
  
  <div class="row-outer">
  <div class="col-1">
  <span><?php _e('Text Color');?></span>
  </div>
  <div class="col-2">
  <input type="text" class="wpcrcolor-field" name="wpcr_settings[txtcolor]" value="<?php echo sanitize_hex_color( $wpcr_options['txtcolor'])?>" data-default-color="#ccc" />
  </div>
  </div>
 
  <?php submit_button(); ?>
  </form>
  <div class="donate-message" style="float:right;">
	<?php include (  plugin_dir_path( __FILE__ ) . 'inc/message.php');	?>
  </div>
  </div>
  
</div>
<?php } 
