<?php

function ac_tree_manager_map_data_approved() {
    $sql = "SELECT id, lat, lng, type_id where approved = 1";
    print_r($_REQUEST);
}

function ac_tree_manager_map_data_unapproved() {
    $sql = "SELECT id, lat, lng, type_id where approved = 0";
    print_r($_REQUEST);
}

function ac_tree_manager_map_data_for_activity($id) {
    $sql = "SELECT id, lat, lng, type_id where approved = 1 AND action_id = ".intval($id);
    print_r($_REQUEST);
}

function ac_tree_manager_map_data_for_type($id) {
    $sql = "SELECT id, lat, lng, type_id where approved = 1 AND type_id = ".intval($id);
    print_r($_REQUEST);
}

function ac_tree_manager_map_data_for_plantator($id) {
    $sql = "SELECT id, lat, lng, type_id where approved = 1 AND owner_id = ".intval($id);
    print_r($_REQUEST);
}

function ac_tree_manager_map_data_for_tree($id) {
    $sql = "SELECT id, lat, lng, type_id where id = ".intval($id);
    print_r($_REQUEST);
}
