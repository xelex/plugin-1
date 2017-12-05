<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Retrieve plantator data from the database.
 *
 * @param int $id
 *
 * @return object
 */
function ac_get_plantator( $id = 0 ) {
    global $wpdb;

    return $wpdb->get_row( $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}plantators WHERE id = %d", $id ) );
}

/**
 * Retrieve plantators data from the database.
 *
 * @param int $per_page
 * @param int $page_number
 *
 * @return array
 */
function ac_get_plantators( $args = null ) {
    global $wpdb;

    $defaults = [
        'number'  => 20,
        'offset'  => 0,
        'orderby' => 'id',
        'order'   => 'DESC',
        'count'   => false,
    ];

    $args = wp_parse_args( $args, $defaults );

    if ( $args['count'] ) {
        $sql = "SELECT COUNT(*) FROM {$wpdb->prefix}plantators";
    } else {
        $sql = "SELECT * FROM {$wpdb->prefix}plantators";
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
    } else {
        $result = $wpdb->get_results( $sql);
    }

    return $result;
}

/**
 * Delete a plantator record.
 *
 * @param  int $id plantator id
 *
 * @return boolean
 */
function ac_delete_plantator( $id ) {
    global $wpdb;

    return $wpdb->delete(
        "{$wpdb->prefix}plantators",
        [ 'id' => $id ],
        [ '%d' ]
    );
}

/**
 * Insert a new plantators.
 *
 * @param boolean
 */
function ac_insert_plantator( $args = array() ) {
    global $wpdb;

    $defaults = array(
        'id' => null,
        'name' => '',
'when' => '',
'fb' => '',
'vk' => '',
'tw' => '',
'ig' => '',
'email' => '',
'phone' => '',
'description' => '',

    );

    $args       = wp_parse_args( $args, $defaults );
    $table_name = $wpdb->prefix . 'plantators';

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