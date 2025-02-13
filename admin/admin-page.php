<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// Check user capabilities before rendering (optional, but recommended).
if ( ! current_user_can( 'manage_options' ) ) {
    wp_die( __( 'You do not have sufficient permissions to access this page.', 'wp-delete-comments' ) );
}

// If the form is submitted, handle the deletion logic.
if ( isset( $_POST['wp_delete_comments_action'] ) && check_admin_referer( 'wp_delete_comments_nonce' ) ) {
    // Retrieve the chosen comment status from the form.
    $selected_option = sanitize_text_field( $_POST['wp_delete_comments_selection'] ?? '' );

    // Require the file that contains our deletion logic.
    require_once plugin_dir_path( __FILE__ ) . '../includes/comment-deleter.php';

    // Delete comments based on the selected status.
    $deleted_count = wp_delete_comments_by_status( $selected_option );

    // Provide feedback to the user.
    echo sprintf(
        '<div class="notice notice-success is-dismissible"><p>%d comments have been deleted for type: <strong>%s</strong>.</p></div>',
        $deleted_count,
        esc_html( $selected_option )
    );
}
?>

<div class="wrap">
    <h1><?php esc_html_e( 'WP Delete Comments', 'wp-delete-comments' ); ?></h1>
    <form method="POST">
        <?php wp_nonce_field( 'wp_delete_comments_nonce' ); ?>

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

        <input
            type="submit"
            name="wp_delete_comments_action"
            class="button button-primary"
            value="<?php esc_attr_e( 'Delete Comments', 'wp-delete-comments' ); ?>"
        />
    </form>
</div>