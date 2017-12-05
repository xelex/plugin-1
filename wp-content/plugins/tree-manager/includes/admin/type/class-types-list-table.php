<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

if ( ! class_exists( 'WP_List_table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}
/**
 * Types_List_Table class
 */
class Types_List_Table extends WP_List_Table {
    /**
     * Constructor.
     *
     * @param void
     */
    public function __construct() {
        parent::__construct( array(
            'singular' => __( 'Type', 'vbh' ),
            'plural'   => __( 'Types', 'vbh' ),
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
            case 'name':
            case 'icon':
            case 'description':
                return $item->{$column_name};
            case 'planted':
                return "0";
            default:
                return print_r( $item, true );
        }
    }

    /**
     * Renderer for icon cells
     */
     public function column_icon($item) {
         return '<img heigth=40 width=40 alt="'.$item->icon.'"src="'.ag_get_type_icon($item->icon).'" />';
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
    function column_name( $item ) {
        $delete_nonce = wp_create_nonce( 'ac_delete_type' );

        $title = '<strong>' . $item->name . '</strong>';

        $actions = [
            'edit'   => sprintf( '<a href="?page=%s&action=%s&id=%d">Редактировать</a>',  esc_attr( $_REQUEST['page'] ), 'edit', absint( $item->id ) ),
            'delete' => sprintf( '<a href="?page=%s&action=%s&id=%d&_wpnonce=%s">Удалить</a>', esc_attr( $_REQUEST['page'] ), 'delete', absint( $item->id ), $delete_nonce )
        ];

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
            'name' => __( 'Название', 'vbh' ),
            'icon' => __( 'Иконка', 'vbh' ),
            'planted' => __( 'Посадок', 'vbh' ),
#            'description' => __( 'Description', 'vbh' ),
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
            'name' => array( 'name', true ),
            'icon' => array( 'icon', true ),
            'planted' => array( 'planted', true ),
            'description' => array( 'description', true ),
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
            'bulk-delete' => 'Удалить'
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
        $s            = ( ! empty( $_REQUEST['s'] ) ) ? $_REQUEST['s'] : '';
        $offset       = ( $current_page - 1 ) * $per_page;

        $args = [
            'number'  => $per_page,
            'offset'  => $offset,
            'orderby' => $orderby,
            'order'   => $order,
            'count'   => true,
            's'       => $s,
        ];

        $total_items  = ac_get_types( $args );

        $this->set_pagination_args( [
            'total_items' => $total_items,
            'per_page'    => $per_page
        ] );

        unset( $args['count'] );

        $this->items = ac_get_types( $args );
    }
}