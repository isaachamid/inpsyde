<?php
/*
 * Trigger this file on plugin uninstall
 *
 * @package PluginTemplate
 */

// if uninstall.php is not called by WordPress, die =================================================================
defined('WP_UNINSTALL_PLUGIN') or die('Hi there!  I\'m just a plugin, not much I can do when called directly.');

// Clear Database ===================================================================================================

// Solution 1
//$books = get_posts(array('post_type' => 'book', 'numberposts' => -1));
//
//foreach ($books as $book) {
//    wp_delete_post($book->ID, true);
//}

// Solution 2
global $wpdb;

$wpdb->query("DELETE FROM wp_posts WHERE post_type = 'book'");
$wpdb->query("DELETE FROM wp_postmeta WHERE post_id NOT IN (SELECT id FROM wp_posts)");
$wpdb->query("DELETE FROM wp_term_relationships WHERE object_id NOT IN (SELECT id FROM wp_posts)");