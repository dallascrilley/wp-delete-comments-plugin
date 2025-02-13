<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// Check user capabilities before rendering.
if ( ! current_user_can( 'manage_options' ) ) {
    wp_die( __( 'You do not have sufficient permissions to access this page.', 'wp-delete-comments' ) );
}

// If the form is submitted, handle the deletion logic and optional "disable future comments."
if ( isset( $_POST['wp_delete_comments_action'] ) && check_admin_referer( 'wp_delete_comments_nonce' ) ) {
    // Load the deletion logic and any helper functions
    require_once plugin_dir_path( __FILE__ ) . '../includes/comment-deleter.php';

    // 1) Delete comments if a status is provided
    $selected_option = sanitize_text_field( $_POST['wp_delete_comments_selection'] ?? '' );
    $deleted_count   = wp_delete_comments_by_status( $selected_option );

    // 2) Disable (or enable) future comments if the checkbox is checked
    $disable_future_comments = ! empty( $_POST['disable_future_comments'] );
    wp_set_future_comments_status( $disable_future_comments );

    // Provide feedback to the user
    echo sprintf(
        '<div class="notice notice-success is-dismissible"><p>%d comments have been deleted for type: <strong>%s</strong>.</p></div>',
        $deleted_count,
        esc_html( $selected_option )
    );

    if ( $disable_future_comments ) {
        echo '<div class="notice notice-success is-dismissible"><p>All future comments have been disabled.</p></div>';
    } else {
        echo '<div class="notice notice-info is-dismissible"><p>Future comments remain enabled.</p></div>';
    }
}
?>

<div class="wrap">
    <h1><?php esc_html_e( 'WP Delete Comments', 'wp-delete-comments' ); ?></h1>
    <form method="POST">
        <?php wp_nonce_field( 'wp_delete_comments_nonce' ); ?>

        <h2><?php esc_html_e( 'Delete Existing Comments', 'wp-delete-comments' ); ?></h2>
        <p><?php esc_html_e( 'Select which comments to delete:', 'wp-delete-comments' ); ?></p>

        <label>
            <input type="radio" name="wp_delete_comments_selection" value="all" checked>
            <?php esc_html_e( 'All Comments', 'wp-delete-comments' ); ?>
        </label><br>

        <label>
            <input type="radio" name="wp_delete_comments_selection" value="moderation">
            <?php esc_html_e( 'Comments in Moderation', 'wp-delete-comments' ); ?>
        </label><br>

        <label>
            <input type="radio" name="wp_delete_comments_selection" value="approved">
            <?php esc_html_e( 'Approved Comments', 'wp-delete-comments' ); ?>
        </label><br>

        <label>
            <input type="radio" name="wp_delete_comments_selection" value="spam">
            <?php esc_html_e( 'Spam Comments', 'wp-delete-comments' ); ?>
        </label><br>

        <label>
            <input type="radio" name="wp_delete_comments_selection" value="trash">
            <?php esc_html_e( 'Trashed Comments', 'wp-delete-comments' ); ?>
        </label><br><br>

        <h2><?php esc_html_e( 'Disable Future Comments', 'wp-delete-comments' ); ?></h2>
        <label>
            <input type="checkbox" name="disable_future_comments" value="1" />
            <?php esc_html_e( 'Disable all future comments', 'wp-delete-comments' ); ?>
        </label>
        <p class="description"><?php esc_html_e( 'Check this box to turn off comments for all future posts.', 'wp-delete-comments' ); ?></p>

        <br><br>
        <input
            type="submit"
            name="wp_delete_comments_action"
            class="button button-primary"
            value="<?php esc_attr_e( 'Delete & Update Comments Settings', 'wp-delete-comments' ); ?>"
        />
    </form>
</div>