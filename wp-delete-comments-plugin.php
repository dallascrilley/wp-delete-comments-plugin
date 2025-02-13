<?php
/**
 * Plugin Name: Delete All Comments from Wordpress Posts
 * Plugin URI: https://dallascrilley.com
 * Description: Plugin to delete all or specific types of comments from a Wordpress website.
 * Author: Dallas Crilley
 * Version: 1.0
 * Author URI: https://dallascrilley.com
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Register the submenu under Tools
 */
function wp_delete_comments_plugin_menu(): void {
    add_submenu_page(
        'tools.php',                     // Parent slug: Tools
        'WP Delete Comments',            // Page title
        'WP Delete Comments',            // Menu title
        'manage_options',                // Capability required
        'wp_delete_comments_plugin',     // Menu slug
        'wp_delete_comments_plugin_page' // Callback to render the page
    );
}
add_action( 'admin_menu', 'wp_delete_comments_plugin_menu' );

/**
 * Callback that renders the plugin's admin page
 */
function wp_delete_comments_plugin_page(): void {
    // Include the admin page markup (form, etc.).
    require_once plugin_dir_path( __FILE__ ) . 'admin/admin-page.php';
}