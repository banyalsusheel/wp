<?php
/*
Plugin Name: Comment Form Validation
Plugin URI:  https://wordpress.org/plugins/comment-form-validation/
Description: This plugin use for wordpress comments validation to the comment form. only need to activate the plugin.
Version:     1.1
Author:      Abhay Yadav
Author URI:  http://abhayyadav.com
License:     GPL2
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

function cf_validation() {
	wp_enqueue_style( 'abcommentvalidation', WP_PLUGIN_URL . '/comment-form-validation/css/comment-validation.css');
	wp_enqueue_script('validate', WP_PLUGIN_URL . '/comment-form-validation/js/jquery-validation.js', array('jquery'));
	wp_enqueue_script('abcommentvalidation', WP_PLUGIN_URL . '/comment-form-validation/js/comment-validation.js', array('jquery','validate'));
}
add_action('init', 'cf_validation');

?>