<?php

if (!function_exists('bridge_qode_child_theme_enqueue_scripts')) {

	function bridge_qode_child_theme_enqueue_scripts()
	{
		wp_register_style('bridge-childstyle', get_stylesheet_directory_uri() . '/style.css', array(), filemtime(get_stylesheet_directory() . '/style.css'));
		wp_enqueue_style('bridge-childstyle');
	}

	add_action('wp_enqueue_scripts', 'bridge_qode_child_theme_enqueue_scripts', 11);
}
//START hide captcha
function contactform_dequeue_scripts()
{
	if (is_singular()) {
		$post = get_post();

		if (!has_shortcode($post->post_content, 'contact-form-7')) {
			wp_dequeue_script('contact-form-7');
			wp_dequeue_script('google-recaptcha');
			wp_dequeue_script('wpcf7-recaptcha');
			wp_dequeue_style('wpcf7-recaptcha');
			wp_dequeue_style('contact-form-7');
		}
	}
}
add_action('wp_enqueue_scripts', 'contactform_dequeue_scripts', 99);
//END hide captcha

// Register styles for the shortcodes
wp_register_style('icon-with-text-style', get_stylesheet_directory_uri() . '/css/icon_with_text_style.css', array(), filemtime(get_stylesheet_directory() . '/css/icon_with_text_style.css'));

// include shortcodes
require_once(__DIR__ . '/shortcodes/icon_with_text_list.php');