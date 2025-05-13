<?php
/*
 * Plugin Name:       Site Plugin
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       Handle the basics with this plugin.
 * Version:           1.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            John Smith
 * Author URI:        https://author.example.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 */

 // Load custom CSS & JS files
function jksn_load_plugin_scripts(){
	$plugin_url = plugin_dir_url(_FILE_);
	
	// CSS
	wp_enqueue_style(
		'custom-css',
		$plugin_url . 'custom.css',
		array(),
		filemtime(plugin_dir_path(_FILE_) . 'custom.css')
	);
	
	// JS
	wp_enqueue_script(
		'custom-js',
		$plugin_url . 'custom.js',
		array('jquery'),
		filemtime(plugin_dir_path(_FILE_) . 'custom.js'),
		true
	);
}
add_action('wp_enqueue_scripts', 'jksn_load_plugin_scripts');

// Year Shortcode
function jksn_year_shortcode(){
	$year = date('Y');
	return $year;
}
add_shortcode('year', 'jksn_year_shortcode');

// Following Joshua Herbison's Tutorial
function example_content_function(){
	$content = "<p>Oh boy! Example content.</p>";
	return $content;
	/* Return ensures content will load right at the shortcode location */
}
add_shortcode('example', 'example_content_function');

function admin_menu_option(){
	add_menu_page('Header & Footer Scripts', 'Site Scripts', 'manage_options', 'admin-menu', 'admin_page', '', 200);
	/*Args - Title, WP Menu item, role with access, slug, callback function, icon , left side display*/
}
add_action('admin_menu', 'admin_menu_option');