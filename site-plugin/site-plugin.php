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

// Creates a menu item that allows for scripts to be added in header/footer by pasting in wp back end
function admin_menu_option(){
	add_menu_page('Header & Footer Scripts', 'Site Scripts', 'manage_options', 'admin-menu', 'admin_page', '', 200);
	/*Args - Title, WP Menu item, role with access, slug, callback function, icon , left side display*/
}
add_action('admin_menu', 'admin_menu_option');

function admin_page(){
	if(array_key_exists('submit_scripts_update', $_POST)){
		update_option('db_header_scripts',$_POST['header_scripts']);
		update_option('db_footer_scripts',$_POST['footer_scripts']);

		?>
		<div id="setting-error-settings-updated" class="updated settings-error notice is-dismissible">
			<strong>Settings have been saved.</strong>
		</div>	
		<?php
	}

	$header_scripts = get_option('db_header_scripts', 'none');
	$footer_scripts = get_option('db_footer_scripts', 'none');

	?>
	<div class="wrap">
		<!-- default class for admin page wrapper -->
		<h2>Update Scripts</h2>
		<form method="post" action="">
			<label for="header_scripts">Header Scripts</label>
			<textarea name="header_scripts" class="large-text">
				<?php print $header_scripts; ?>
			</textarea>
			<label for="footer_scripts">Footer Scripts</label>
			<textarea name="footer_scripts" class="large-text">
				<?php print $footer_scripts; ?>
			</textarea>
			<input type="submit" name="submit_scripts_update" value="UPDATE SCRIPTS" class="button button-primary">
		</form>
	</div>
	<?php
}

function display_header_scripts(){
	$header_scripts = get_option('db_header_scripts', 'none');
	print $header_scripts;
}
add_action('wp_head', 'display_header_scripts');

function display_footer_scripts(){
	$footer_scripts = get_option('db_footer_scripts', 'none');
	print $footer_scripts;
}
add_action('wp_foot', 'display_footer_scripts');

function ohana_contactForm(){
	$content = '';

	$content .= '<form method="post" action="http://example.com/thank-you/">';
		$content .= '<input type="text" name="full_name" placeholder="Your Full Name" />';
		$content .= '<br />';

		$content .= '<input type="text" name="email_address" placeholder="Email Address" />';
		$content .= '<br />';

		$content .= '<input type="text" name="phone_number" placeholder="Phone Number" />';
		$content .= '<br />';

		$content .= '<textarea name="comments" placeholder="Give us your comments"></textarea>';
		$content .= '<br />';

		$content .= '<input type="submit" name="ohana_submit_form" value="SUBMIT FORM">';

	$content .= '</form>';
	return $content;
}
add_shortcode('ohana_contact_form','ohana_contactForm');