<?php

/**
 * Fired when the plugin is uninstalled.
 *
 * When populating this file, consider the following flow
 * of control:
 *
 * - This method should be static
 * - Check if the $_REQUEST content actually is the plugin name
 * - Run an admin referrer check to make sure it goes through authentication
 * - Verify the output of $_GET makes sense
 * - Repeat with other user roles. Best directly by using the links/query string parameters.
 * - Repeat things for multisite. Once for a single site in the network, once sitewide.
 *
 * This file may be updated more in future version of the Boilerplate; however, this is the
 * general skeleton and outline for how the file should work.
 *
 *
 */


// if uninstall.php is not called by WordPress, die
if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}
delete_option( 'rhi_show_banner_title');
delete_option( 'rhi_show_banner_text');
delete_option( 'rhi_show_banner_button');
delete_option( 'rhi_width');
delete_option( 'rhi_height');
delete_option( 'rhi_opacity');
delete_option( 'rhi_title_font_style');
delete_option( 'rhi_banner_text_font_style');
delete_option( 'rhi_button_color');
delete_option( 'rhi_button_text_color');
delete_option( 'rhi_title_font_color');
delete_option( 'rhi_banner_text_font_color');
delete_option( 'rhi_time_interval');
delete_option( 'rhi_banner_text_align');

global $wpdb;
// Delete all the Custom Post Types
$post_type = 'hero_image';
$items = get_posts( array( 'post_type' =>'hero_image', 'post_status' => 'any', 'numberposts' => -1, 'fields' => 'ids' ) );
	
if( $items ) {
    foreach( $items as $item ) {
        wp_delete_post( $item, true );
    }
}
$terms = $wpdb->get_results( $wpdb->prepare( "SELECT t.name, t.term_id FROM $wpdb->terms AS t INNER JOIN $wpdb->term_taxonomy AS tt ON t.term_id = tt.term_id WHERE tt.taxonomy = 'wsxhi_categories'"));
foreach ($terms as $term) {
 wp_delete_term( $term->term_id, 'wsxhi_categories' );
}
?>