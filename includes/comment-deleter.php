<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Delete comments based on the provided status.
 *
 * @param string $status The comment status to delete. Possible values:
 *                       'all', 'moderation', 'approved', 'spam', 'trash'.
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

    // Default to 'all' if something unexpected is passed
    $wp_status = $status_map[$status] ?? 'all';

    // Retrieve all comments matching the chosen status
    $args = [
        'status' => $wp_status,
        'number' => 0, // 0 = no limit
    ];

    // For 'all', WordPress might skip spam/trash. Use 'any' to be absolutely certain:
    if ( $wp_status === 'all' ) {
        $args['status'] = 'any';
    }

    $comments = get_comments( $args );
    $deleted_count = 0;

    foreach ( $comments as $comment ) {
        // The second parameter "true" means force deletion without trashing
        $result = wp_delete_comment( $comment->comment_ID, true );
        if ( $result ) {
            $deleted_count++;
        }
    }

    return $deleted_count;
}