=== Delete All Comments from Wordpress Posts ===
Contributors: dallascrilley
Tags: comments, moderation, spam, trash, disable comments
Requires at least: 5.0
Tested up to: 6.7.2
Stable tag: 1.1
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Delete all or specific types of comments from your WordPress website, and optionally disable future comments with one click.

== Description ==
This plugin provides a page under Tools -> "WP Delete Comments" that:
1. Lets you delete all or specific types of existing comments (Approved, Pending, Spam, Trash).
2. Optionally disable future comments (so new posts won’t accept comments).

== Installation ==
1. Upload the `wp-delete-comments-plugin` folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Navigate to Tools > WP Delete Comments to remove existing comments and/or disable future ones.

== Frequently Asked Questions ==
= Does this permanently delete comments? =
Yes. The plugin uses `wp_delete_comment($comment_id, true)`, which permanently removes comments from the database.

= How do I re-enable future comments? =
Simply uncheck the "Disable all future comments" box and submit again.

== Changelog ==
= 1.1 =
* Feature: Option to disable all future comments from the same admin page.

= 1.0 =
* Initial Release