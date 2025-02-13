<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Delete comments based on the provided status.
 *
 * @param string $status The comment status to delete: 'all', 'moderation', 'approved', 'spam', 'trash'.
 * @return int           The number of comments deleted.
 */
function wp_delete_comments_by_status( string $status ): int {
    // Map user-friendly selection to WP recognized statuses
    // WordPress get_comments() uses:
    //  - 'hold' (pending/moderation)
    //  - 'approve' (approved)
    //  - 'spam'
    //  - 'trash'
    //  - 'all' or 'any' to get everything
    $status_map = [
        'moderation' => 'hold',
        'approved'   => 'approve',
        'spam'       => 'spam',
        'trash'      => 'trash',
        'all'        => 'all',
    ];

    // Default to 'all' if something unexpected is passed.
    $wp_status = $status_map[$status] ?? 'all';

    // Use 'any' to get absolutely everything when user picks 'all'
    $args = [
        'status' => ( $wp_status === 'all' ) ? 'any' : $wp_status,
        'number' => 0, // 0 = no limit
    ];

    $comments       = get_comments( $args );
    $deleted_count  = 0;

    foreach ( $comments as $comment ) {
        // The second param "true" force-deletes without trashing
        if ( wp_delete_comment( $comment->comment_ID, true ) ) {
            $deleted_count++;
        }
    }

    return $deleted_count;
}

/**
 * Enable or disable all future comments.
 *
 * @param bool $disable Set to true to disable future comments; false to enable.
 */
function wp_set_future_comments_status( bool $disable ): void {
    if ( $disable ) {
        update_option( 'default_comment_status', 'closed' );
        update_option( 'default_ping_status', 'closed' );
    } else {
        update_option( 'default_comment_status', 'open' );
        update_option( 'default_ping_status', 'open' );
    }
}