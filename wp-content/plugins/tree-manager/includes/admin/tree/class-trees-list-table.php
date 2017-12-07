<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'WP_List_table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}
/**
 * Trees_List_Table class
 */
class Trees_List_Table extends WP_List_Table {
    /**
     * Constructor.
     *
     * @param void
     */
    public function __construct() {
        parent::__construct( array(
            'singular' => __( 'Tree', 'vbh' ),
            'plural'   => __( 'Trees', 'vbh' ),
            'ajax'     => false
        ) );
    }

    /**
     * Message to be displayed when there are no items.
     *
     * @return void
     */
    public function no_items() {
        _e( 'Записей не найдено.', 'vbh' );
    }

    /**
     * Render a column when no column specific method exist.
     *
     * @param array  $item
     * @param string $column_name
     *
     * @return void
     */
    public function column_default( $item, $column_name ) {
        switch ( $column_name ) {
            case 'id':
            case 'lat':
            case 'lng':
            case 'owner_id':
            case 'url':
            case 'planted':
            case 'last':
                return $item->{$column_name};
            case 'action_id':
                return sprintf(
                    '<a href="?page=%s&action=%s&id=%d">'.($item->action_name ?: $item->action_id).'</a>',
                    'tree-manager',
                    'view',
                    absint( $item->action_id ));
            case 'type_id':
                return sprintf(
                    '<a href="?page=%s&action=%s&id=%d">'.($item->type_name ?: $item->type_id).'</a>',
                    'tree-manager-type',
                    'view',
                    absint( $item->type_id ));
            case 'approved':
                return $item->{$column_name} ? 'Да' : 'Нет';
            default:
                return print_r( $item, true );
        }
    }

    /**
     * Render the bulk edit checkbox.
     *
     * @param array $item
     *
     * @return string
     */
    function column_cb( $item ) {
        return sprintf(
            '<input type="checkbox" name="bulk-delete[]" value="%s" />', $item->id
        );
    }

    /**
     * Generates the columns for a single row of the table.
     *
     * @param array $item an array of DB data
     *
     * @return string
     */
    function column_id( $item ) {
        $delete_nonce = wp_create_nonce( 'ac_delete_tree' );

        $title = '<strong>' . $item->id . '</strong>';

        $actions = [];
        $actions['edit'] = sprintf( '<a href="?page=%s&action=%s&id=%d">Редактировать</a>',  esc_attr( $_REQUEST['page'] ), 'edit', absint( $item->id ) );
        if (intval($item->approved) != 1) {
            $actions['approve'] = sprintf( '<a href="?page=%s&action=%s&id=%d">Резрешить</a>',  esc_attr( $_REQUEST['page'] ), 'approve', absint( $item->id ) );
        }
        $actions['delete'] = sprintf( '<a href="?page=%s&action=%s&id=%d&_wpnonce=%s" onclick="return confirm(\'Вы уверены ?\');">Удалить</a>', esc_attr( $_REQUEST['page'] ), 'delete', absint( $item->id ), $delete_nonce );        
        return sprintf( '<a href="?page=%s&action=%s&id=%d">%s</a>',  esc_attr( $_REQUEST['page'] ), 'view', absint( $item->id ), $title ) . $this->row_actions( $actions );
    }

    /**
     *  Get a list of columns.
     *
     * @return array
     */
    function get_columns() {
        $columns = [
            'cb' => '<input type="checkbox" />',
            'id' => __( 'Номер', 'vbh' ),
            'approved' => __( 'Проверен', 'vbh' ),
            'action_id' => __( 'Акция', 'vbh' ),
            'owner_id' => __( 'Посадил', 'vbh' ),
            'type_id' => __( 'Вид', 'vbh' ),
#            'url' => __( 'Url', 'vbh' ),
#            'lat' => __( 'Lat', 'vbh' ),
#            'lng' => __( 'Lng', 'vbh' ),
            'planted' => __( 'Посажен', 'vbh' ),
            'last' => __( 'Обновлен', 'vbh' ),
        ];

        return $columns;
    }

    /**
     * Get a list of sortable columns.
     *
     * @return array
     */
    public function get_sortable_columns() {
        $sortable_columns = array(
            'id' => array( 'id', true ),
            'lat' => array( 'lat', true ),
            'lng' => array( 'lng', true ),
            'approved' => array( 'approved', true ),
            'action_id' => array( 'action_id', true ),
            'owner_id' => array( 'owner_id', true ),
            'type_id' => array( 'type_id', true ),
            'url' => array( 'url', true ),
            'planted' => array( 'planted', true ),
            'last' => array( 'last', true ),

        );

        return $sortable_columns;
    }

    /**
     * Returns an associative array containing the bulk action.
     *
     * @return array
     */
    public function get_bulk_actions() {
        $actions = [
            'bulk-delete' => 'Удалить',
            'bulk-delete' => 'Резрешить'
        ];

        return $actions;
    }

    /**
     * Prepares the list of items for displaying.
     *
     * @return void
     */
    public function prepare_items() {
        $columns  = $this->get_columns();
        $hidden   = [];
        $sortable = $this->get_sortable_columns();

        $this->_column_headers = array( $columns, $hidden, $sortable );

        // Query parameters
        $per_page     = 20;
        $current_page = $this->get_pagenum();
        $orderby      = ( ! empty( $_REQUEST['orderby'] ) ) ? $_REQUEST['orderby'] : 'id';
        $order        = ( ! empty( $_REQUEST['order'] ) ) ? $_REQUEST['order'] : 'DESC';
        $filter       = ( ! empty( $_REQUEST['filter'] ) ) ? $_REQUEST['filter'] : 'all';
        $offset       = ( $current_page - 1 ) * $per_page;

        $args = [
            'number'  => $per_page,
            'offset'  => $offset,
            'orderby' => $orderby,
            'order'   => $order,
            'filter'  => $filter,
            'count'   => true,
        ];

        $total_items  = ac_get_trees( $args );

        $this->set_pagination_args( [
            'total_items' => $total_items,
            'per_page'    => $per_page
        ] );

        unset( $args['count'] );

        $this->items = ac_get_trees( $args );
    }

    function get_views() {
        $views = array();
        $current = ( !empty($_REQUEST['filter']) ? $_REQUEST['filter'] : 'all');

        $class = ($current == 'all' ? ' class="current"' :'');
        $all_url = remove_query_arg('filter_id', remove_query_arg('filter'));
        $views['all'] = "<a href='{$all_url }' {$class} >Все</a>";

        $url = remove_query_arg('filter_id', add_query_arg('filter', 'unapproved'));
        $class = ($current == 'unapproved' ? ' class="current"' :'');
        $views['unapproved'] = "<a href='{$url}' {$class} >Непроверенные</a>";

        $url = remove_query_arg('filter_id', add_query_arg('filter', 'approved'));
        $class = ($current == 'approved' ? ' class="current"' :'');
        $views['approved'] = "<a href='{$url}' {$class} >Проверенные</a>";

        return $views;
    }
}