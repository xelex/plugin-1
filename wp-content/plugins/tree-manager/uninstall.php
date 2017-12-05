<?php
// Exit if not defined uninstall
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) )
    exit();

function uninstall_tree_manager() {
    uninstall_tree_manager_do("trees");
    uninstall_tree_manager_do("plantators");
    uninstall_tree_manager_do("activities");
    uninstall_tree_manager_do("types");
}

function uninstall_tree_manager_do($name) {
    global $wpdb;

    $table_name = $wpdb->prefix.$name;
    $wpdb->query("DROP TABLE IF EXISTS $table_name");
}
uninstall_tree_manager();
