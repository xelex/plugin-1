<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Retrieve tree data from the database.
 *
 * @param int $id
 *
 * @return object
 */
function ac_get_tree( $id = 0 ) {
    global $wpdb;

    return $wpdb->get_row( $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}trees WHERE id = %d", $id ) );
}

/**
 * Retrieve trees data from the database.
 *
 * @param int $per_page
 * @param int $page_number
 *
 * @return array
 */
function ac_get_trees( $args = null ) {
    global $wpdb;

    $defaults = [
        'number'  => 20,
        'offset'  => 0,
        'orderby' => 'id',
        'order'   => 'DESC',
        'filter'  => 'all',
        'count'   => false,
        'hooks'   => true
    ];

    $args = wp_parse_args( $args, $defaults );

    if ( $args['count'] ) {
        $sql = "SELECT COUNT(*) FROM {$wpdb->prefix}trees";
    } else {
        $sql = "SELECT * FROM {$wpdb->prefix}trees";
    }

    $filters = array();
    if (! empty( $args['s'] ) ) {
        array_push($filters, ' name LIKE "%' . esc_sql( $args['s'] ) . '%" ');
    }

    if (! empty( $args['filter'] ) ) {
        switch($args['filter']) {
            case 'unapproved':
                array_push($filters, ' approved = 0 ');
                break;
            case 'approved':
                array_push($filters, ' NOT approved = 0 ');
                break;
            case 'all':
            default:
        }
    }

    if (count($filters) > 0) { 
        $sql .= ' WHERE '.implode(' AND ', $filters);
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
        return $wpdb->get_var( $sql );
    } else {
        $result = $wpdb->get_results( $sql);
    }

    # Apply hooks
    if ($args['hooks']) {
        $all_activities = array_reduce(
            ac_get_activities_map(),
            function(&$r, $item){
                $r[$item->id] = $item->name;
                return $r;
            },
            array());

        $all_types = array_reduce(
            ac_get_types_map(),
            function(&$r, $item){
                $r[$item->id] = $item->name;
                return $r;
            },
            array());

        foreach($result as $tree) {
            $tree->{'action_name'} = $all_activities[$tree->action_id];
            $tree->{'type_name'} = $all_types[$tree->type_id];
        }
    }

    return $result;
}

/**
 * Delete a tree record.
 *
 * @param  int $id tree id
 *
 * @return boolean
 */
function ac_delete_tree( $id ) {
    global $wpdb;

    return $wpdb->delete(
        "{$wpdb->prefix}trees",
        [ 'id' => $id ],
        [ '%d' ]
    );
}

/**
 * Insert a new trees.
 *
 * @param boolean
 */
function ac_insert_tree( $args = array() ) {
    global $wpdb;

    $defaults = array(
        'id' => null,
        'lat' => '',
        'lng' => '',
        'approved' => 0,
        'action_id' => 0,
        'owner_id' => 0,
        'type_id' => 0,
        'approved' => 0,
        'url' => '',
        'planted' => ''
    );

    $args       = wp_parse_args( $args, $defaults );
    $table_name = $wpdb->prefix . 'trees';

    // Remove feels we do not want to update
    unset( $args['last'] );

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