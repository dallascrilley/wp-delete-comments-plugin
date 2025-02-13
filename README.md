# Delete All Comments from WordPress Posts

**Contributors:** dallascrilley  
**Tags:** comments, moderation, spam, trash, disable comments
**Requires at least:** 5.0  
**Tested up to:** 6.7.2  
**Stable tag:** 1.1.0
**License:** GPLv2 or later  
**License URI:** [https://www.gnu.org/licenses/gpl-2.0.html](https://www.gnu.org/licenses/gpl-2.0.html)

## Description

Delete all or specific types of comments from your WordPress website via a simple admin page.

This plugin adds a page under **Tools > WP Delete Comments** to enable deleting:

1. Delete all or specific types of comments:
- All comments
- Moderation/Pending comments
- Approved comments
- Spam comments
- Trashed comments

2. Optionally disable future comments (so new posts won’t accept comments).

## Installation

1. Upload the `wp-delete-comments-plugin` folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the **Plugins** menu in WordPress.
3. Navigate to **Tools > WP Delete Comments** to remove unwanted comments.

## Frequently Asked Questions

### Will this permanently delete comments?
Yes. The plugin calls `wp_delete_comment(..., true)`, which removes comments permanently from the database.

### Is there any confirmation prompt?
Currently, there's no separate confirmation prompt. Please use at your own risk and test on a staging site.

### How do I re-enable future comments?
Simply uncheck the "Disable all future comments" box and submit again.

## Changelog

### 1.1
- Feature: Option to disable all future comments from the same admin page

### 1.0
- Initial Release
