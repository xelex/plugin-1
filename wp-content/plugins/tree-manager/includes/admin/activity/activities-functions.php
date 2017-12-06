<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Retrieve activity data from the database.
 *
 * @param int $id
 *
 * @return object
 */
function ac_get_activity( $id = 0 ) {
    global $wpdb;

    $result = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}activities WHERE id = %d", $id ) );
    
    # Apply hooks
    
    $result->{'when'} = explode(' ', $result->when)[0];
    return $result;
}

/**
 * Retrieve activity counters from the database.
 *
 * @param int $id
 *
 * @return array
 */
function ac_get_activity_trees_count( $id ) {
    global $wpdb;
    if (is_array($id)) {
        return $wpdb->get_results(
            "SELECT count(*) as count, action_id FROM {$wpdb->prefix}trees WHERE action_id in (".implode(', ', $id).") group by action_id"
        );
    }
    return $wpdb->get_row( $wpdb->prepare( "SELECT count(*) as count FROM {$wpdb->prefix}trees WHERE action_id = %d", $id ) );
}

/**
 * Get all activities as a map
 *
 * @return map
 */
function ac_get_activities_map() {
    global $wpdb;
    
    return $wpdb->get_results(" SELECT id, name FROM {$wpdb->prefix}activities");
}

/**
 * Retrieve activities data from the database.
 *
 * @param int $per_page
 * @param int $page_number
 *
 * @return array
 */
function ac_get_activities( $args = null ) {
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
        $sql = "SELECT COUNT(*) FROM {$wpdb->prefix}activities";
    } else {
        $sql = "SELECT * FROM {$wpdb->prefix}activities";
    }

    if ( ! empty( $args['s'] ) ) {
        $sql .= ' WHERE name LIKE "%' . esc_sql( $args['s'] ) . '%"' ;
    }

    if ( ! empty( $args['orderby'] ) ) {
        $sql .= ' ORDER BY `' . esc_sql( $args['orderby'] ) . '`';
        $sql .= ! empty( $args['order'] ) ? ' ' . esc_sql( $args['order'] ) : ' ASC';
    }

    if ( $args['number'] != '-1' && ! $args['count'] ) {
        $sql .= ' LIMIT ' . $args['number'];
        $sql .= ' OFFSET ' . $args['offset'];
    }

    if ( $args['count'] ) {
        $result = $wpdb->get_var( $sql );
        return $result;
    }
    $result = $wpdb->get_results( $sql);

    # Apply hooks
    if ($args['hooks']) {
        $all_ativities = array_map(function($v){return $v->id;}, $result);
        $counters = array_reduce(
            ac_get_activity_trees_count($all_ativities),
            function(&$result, $item){
                $result[$item->action_id] = $item->count;
                return $result;
            },
            array());

        foreach($result as $act) {
            $act->{'planted'} = $counters[$act->id];
            $act->{'when'} = explode(' ', $act->when)[0];
        }
    }

    return $result;
}

/**
 * Delete a activity record.
 *
 * @param  int $id activity id
 *
 * @return boolean
 */
function ac_delete_activity( $id ) {
    global $wpdb;

    return $wpdb->delete(
        "{$wpdb->prefix}activities",
        [ 'id' => $id ],
        [ '%d' ]
    );
}

/**
 * Insert a new activities.
 *
 * @param boolean
 */
function ac_insert_activity( $args = array() ) {
    global $wpdb;

    $defaults = array(
        'id' => null,
        'name' => '',
        'total' => '',
        'lat' => '',
        'lng' => '',
        'location' => '',
        'when' => '',
        'description' => '',
    );

    $args       = wp_parse_args( $args, $defaults );
    $table_name = $wpdb->prefix . 'activities';

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