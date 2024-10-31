<?php
/*
 * @package           Rotating_Hero_Image
 * @link              https://www.webstix.com
 * @since             1.0.0
 * 
 * @wordpress-plugin
 * Plugin Name:       Rotating Hero Image
 * Plugin URI:        https://www.webstix.com/wordpress-plugin-development
 * Description:       Display a hero banner on a page or wherever you want. Use this shortcode: <strong>[wsx_hero_image]</strong>
 * Version:           1.0.7 
 * Author:            Webstix
 * Author URI:        https://www.webstix.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt

This plugin is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

This plugin is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with This plugin. If not, see {URI to Plugin License}.
*/
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
} 
// Name of the plugin
if( ! defined( 'RHI_PLUGIN_NAME' ) ) {
    define( 'RHI_PLUGIN_NAME', 'Rotating Hero Image' );
}
// Unique identifier for the plugin. Used as Text Domain
if( ! defined( 'RHI_PLUGIN_SLUG' ) ) {
    define( 'RHI_PLUGIN_SLUG', 'rotating_hero_image' );
}
// Path to the plugin directory
if ( ! defined( 'RHI_PLUGIN_DIR' ) ) {
    define( 'RHI_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
}
// URL of the plugin
if( ! defined( 'RHI_PLUGIN_URL' ) ) {
    define( 'RHI_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
}
// The actuall plugin version
if( ! defined( 'RHI_PLUGIN_VERSION' ) ) {
    define( 'RHI_PLUGIN_VERSION', '1.0.0' );
}
/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
 /**
 * The core plugin class that is used to define internationalization,
 * dashboard-specific hooks, and public-facing site hooks.
 */
require_once plugin_dir_path( __FILE__ ) . 'admin/rotating-hero-image-admin.php';
require_once plugin_dir_path( __FILE__ ) . 'public/rotating-hero-image-public.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_RotatingHeroImage() {

	$plugin = new rotating_hero_image();
}

register_activation_hook(__FILE__,  'RHI_cal_on_activation'  );
register_deactivation_hook(__FILE__, 'RHI_cal_on_deactivation' );

/**
 * The code that runs during plugin activation.
 */
function RHI_cal_on_activation(){
   flush_rewrite_rules();
}
/**
 * The code that runs during plugin deactivation.
 */
function RHI_cal_on_deactivation(){
    flush_rewrite_rules();
}

function RHI_hero_image_shortcode($atts){
  ob_start();
  new display_rotating_hero_image($atts);
  return ob_get_clean();
}
add_shortcode('wsx_hero_image', 'RHI_hero_image_shortcode');

run_RotatingHeroImage();
/* Settings link on the plugins page
 */ 
add_filter('plugin_action_links_' . plugin_basename(__FILE__) , 'RHI_plugin_settings_link');
function RHI_plugin_settings_link($wsx_rhi_link)
{
    $wsx_rhi_link[] = '<a href="' . esc_url(get_admin_url(null, 'edit.php?post_type=hero_image&page=options')) . '">' . __('Settings', 'Rotating Hero Image') . '</a>';
    return $wsx_rhi_link;
}
?>
