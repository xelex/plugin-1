<?php

function ac_tree_manager_map_query_base() {
    global $wpdb;
    return "SELECT a.id, a.lat, a.lng, b.icon, a.amount FROM {$wpdb->prefix}trees as a, {$wpdb->prefix}types as b WHERE a.type_id = b.id ";
}

function ac_tree_manager_map_query_geo($lat_1, $lng_1, $lat_2, $lng_2) {
    return " AND lat >= $lat_1 AND lat <= $lat_2 AND lng >= $lng_1 AND lng <= $lng_2;";
}

function ac_tree_manager_map_data($lat_1, $lng_1, $lat_2, $lng_2) {
    global $wpdb;
    $sql = ac_tree_manager_map_query_base().ac_tree_manager_map_query_geo($lat_1, $lng_1, $lat_2, $lng_2);
    return $wpdb->get_results($sql);
}

function ac_tree_manager_map_data_approved($lat_1, $lng_1, $lat_2, $lng_2) {
    global $wpdb;
    $sql = ac_tree_manager_map_query_base()."AND approved = 1".ac_tree_manager_map_query_geo($lat_1, $lng_1, $lat_2, $lng_2);
    return $wpdb->get_results($sql);
}

function ac_tree_manager_map_data_unapproved($lat_1, $lng_1, $lat_2, $lng_2) {
    global $wpdb;
    $sql = ac_tree_manager_map_query_base()."AND approved NOT IN (-1, 1) ".ac_tree_manager_map_query_geo($lat_1, $lng_1, $lat_2, $lng_2);
    return $wpdb->get_results($sql);
}

function ac_tree_manager_map_data_denied($lat_1, $lng_1, $lat_2, $lng_2) {
    global $wpdb;
    $sql = ac_tree_manager_map_query_base()."AND approved = -1 ".ac_tree_manager_map_query_geo($lat_1, $lng_1, $lat_2, $lng_2);
    return $wpdb->get_results($sql);
}

function ac_tree_manager_map_data_for_activity($id, $lat_1, $lng_1, $lat_2, $lng_2) {
    global $wpdb;
    $sql = ac_tree_manager_map_query_base()."AND approved = 1 AND action_id = $id".ac_tree_manager_map_query_geo($lat_1, $lng_1, $lat_2, $lng_2);
    return $wpdb->get_results($sql);
}

function ac_tree_manager_map_data_for_type($id, $lat_1, $lng_1, $lat_2, $lng_2) {
    global $wpdb;
    $sql = ac_tree_manager_map_query_base()."AND approved = 1 AND type_id = $id".ac_tree_manager_map_query_geo($lat_1, $lng_1, $lat_2, $lng_2);
    return $wpdb->get_results($sql);
}

function ac_tree_manager_map_data_for_plantator($id) {
    global $wpdb;
    $sql = ac_tree_manager_map_query_base()." AND owner_id = $id";
    return $wpdb->get_results($sql);
}

function ac_tree_manager_map_data_for_tree($id) {
    global $wpdb;
    $sql = ac_tree_manager_map_query_base()." AND a.id = $id";
    return $wpdb->get_results($sql);
}
