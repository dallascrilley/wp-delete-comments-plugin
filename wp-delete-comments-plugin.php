<?php
/**
 * Plugin Name: Delete All Comments from Wordpress Posts
 * Plugin URI: https://dallascrilley.com
 * Description: Plugin to delete all or specific types of comments from a Wordpress website and optionally disable all future comments.
 * Author: Dallas Crilley
 * Version: 1.1
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
        'tools.php',                     // Parent slug
        'WP Delete Comments',            // Page title
        'WP Delete Comments',            // Menu title
        'manage_options',                // Required capability
        'wp_delete_comments_plugin',     // Menu slug
        'wp_delete_comments_plugin_page' // Callback function
    );
}
add_action( 'admin_menu', 'wp_delete_comments_plugin_menu' );

/**
 * Callback that renders the plugin's admin page
 */
function wp_delete_comments_plugin_page(): void {
    require_once plugin_dir_path( __FILE__ ) . 'admin/admin-page.php';
}