<?php
/**
* @package personalPLugin
*/
if( !defined('WP_UNINSTALL_PLUGIN')){ // if uninstall.php is not called by WordPress, die
    die;
}
//conect to the database and do the query(delete the book table)
global $wpdb;
$wpdb->query( "DELETE FROM wp_posts WHERE post_type = 'book'" );
$wpdb->query( "DELETE FROM wp_postmeta WHERE post_id NOT IN (SELECT id FROM wp_posts)" );
$wpdb->query( "DELETE FROM wp_term_relationships WHERE object_id  NOT IN (SELECT id FROM wp_posts)" );
