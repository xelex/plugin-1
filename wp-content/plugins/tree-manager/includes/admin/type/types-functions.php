<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Retrieve type data from the database.
 *
 * @param int $id
 *
 * @return object
 */
function ag_get_type_icon( $icon_id = -1 ) {
    $result = $tmp.'all_30.png';

    $tmp = plugin_dir_url( __FILE__).'/../../../img/icon_';
    if ($icon_id == 0 or $icon_id == 1) {
        $result = $tmp.$icon_id.'_30.png';
    }

    return url_simplify($result);
}

/**
 * Retrieve type counters from the database.
 *
 * @param int $id
 *
 * @return object
 */
function ac_get_type_trees_count( $id ) {
    global $wpdb;
    if (is_array($id)) {
        return $wpdb->get_results(
            "SELECT count(*) as count, type_id FROM {$wpdb->prefix}trees WHERE type_id in (".implode(', ', $id).") group by type_id"
        );
    }
    return $wpdb->get_row( $wpdb->prepare( "SELECT count(*) as count FROM {$wpdb->prefix}trees WHERE type_id = %d", $id ) );
}

/**
 * Retrieve type counters from the database.
 *
 * @param int $id
 *
 * @return object
 */
function ac_get_type_activities_count( $id ) {
    global $wpdb;

    return $wpdb->get_row( $wpdb->prepare( "SELECT count(*) as count FROM {$wpdb->prefix}activities WHERE type_id = %d", $id ) );
}

/**
 * Retrieve type data from the database.
 *
 * @param int $id
 *
 * @return object
 */
function ac_get_type( $id = 0 ) {
    global $wpdb;

    return $wpdb->get_row( $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}types WHERE id = %d", $id ) );
}

/**
 * Get all types as a map
 *
 * @return map
 */
function ac_get_types_map() {
    global $wpdb;
    
    return $wpdb->get_results(" SELECT id, name FROM {$wpdb->prefix}types");
}

/**
 * Retrieve types data from the database.
 *
 * @param int $per_page
 * @param int $page_number
 *
 * @return array
 */
function ac_get_types( $args = null ) {
    global $wpdb;

    $defaults = [
        'number'  => 20,
        'offset'  => 0,
        'orderby' => 'id',
        'order'   => 'DESC',
        'count'   => false,
        'hooks'   => true
    ];

    $args = wp_parse_args( $args, $defaults );

    if ( $args['count'] ) {
        $sql = "SELECT COUNT(*) FROM {$wpdb->prefix}types";
    } else {
        $sql = "SELECT * FROM {$wpdb->prefix}types";
    }

    if ( ! empty( $args['s'] ) ) {
        $sql .= ' WHERE name LIKE "%' . esc_sql( $args['s'] ) . '%"' ;
    }

    if ( ! empty( $args['orderby'] ) ) {
        $sql .= ' ORDER BY ' . esc_sql( $args['orderby'] );
        $sql .= ! empty( $args['order'] ) ? ' ' . esc_sql( $args['order'] ) : ' ASC';
    }

    if ( $args['number'] != '-1' && ! $args['count'] ) {
        $sql .= ' LIMIT ' . $args['number'];
        $sql .= ' OFFSET ' . $args['offset'];
    }

    if ( $args['count'] ) {
        $result = $wpdb->get_var( $sql );
        return $result;
    } else {
        $result = $wpdb->get_results( $sql);
    }

    # Apply hooks
    if ($args['hooks']) {
        $all_types = array_map(function($v){return $v->id;}, $result);
        $counters = array_reduce(
            ac_get_type_trees_count($all_types),
            function(&$result, $item){
                $result[$item->type_id] = $item->count;
                return $result;
            },
            array());

        foreach($result as $type) {
            $type->{'planted'} = $counters[$type->id];
        }
    }
    return $result;
}

/**
 * Delete a type record.
 *
 * @param  int $id type id
 *
 * @return boolean
 */
function ac_delete_type( $id ) {
    global $wpdb;

    return $wpdb->delete(
        "{$wpdb->prefix}types",
        [ 'id' => $id ],
        [ '%d' ]
    );
}

/**
 * Insert a new types.
 *
 * @param boolean
 */
function ac_insert_type( $args = array() ) {
    global $wpdb;

    $defaults = array(
        'id' => null,
        'name' => '',
        'icon' => '',
        'description' => ''
    );

    $args       = wp_parse_args( $args, $defaults );
    $table_name = $wpdb->prefix . 'types';

    // remove row id to determine if new or update
    $row_id = (int) $args['id'];
    unset( $args['id'] );

    if ( ! $row_id ) {
        $args['date'] = current_time( 'mysql' );

        // insert a new
        if ( $wpdb->insert( $table_name, $args ) ) {
            return $wpdb->insert_id;
        }
    } else {
        // do update method here
        if ( $wpdb->update( $table_name, $args, array( 'id' => $row_id ) ) ) {
            return $row_id;
        }
    }

    return false;
}