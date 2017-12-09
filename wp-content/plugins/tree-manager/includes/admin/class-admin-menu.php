<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Admin Menu
 */
class Admin_Menu {
    /**`
     * Constructor.
     *
     * @param void
     */
    public function __construct() {
        add_action( 'admin_menu', array( $this, 'plugin_menu' ) );

        include dirname( __FILE__ ) . '/../admin/type/class-types-list-table.php';
        include dirname( __FILE__ ) . '/../admin/tree/class-trees-list-table.php';
        include dirname( __FILE__ ) . '/../admin/activity/class-activities-list-table.php';
        include dirname( __FILE__ ) . '/../admin/plantator//class-plantators-list-table.php';

        include dirname( __FILE__ ) . '/class-form-handler.php';

        new Form_Handler();
    }

    /**
     * Registering plugin menu.
     *
     * @return void
     */
    public function plugin_menu() {
        $hook = add_menu_page(
            'Акции',
            'Акции',
            'manage_options',
            'tree-manager',
            array( $this, 'plugin_page_activities' ),
            'dashicons-admin-site', null
        );

        add_submenu_page(
            'tree-manager',
            'Посадки',
            'Посадки',
            'manage_options',
            'tree-manager-trees',
            array( $this, 'plugin_page_trees' )
        );

        add_submenu_page(
            'tree-manager',
            'Породы',
            'Породы',
            'manage_options',
            'tree-manager-types',
            array( $this, 'plugin_page_types' )
        );
/*
        add_submenu_page(
            'tree-manager',
            'Люди',
            'Люди',
            'manage_options',
            'tree-manager-plantators',
            array( $this, 'plugin_page_plantators' )
        );
*/
    }

    public function plugin_settings_page() {
        plugin_page_activities();
    }

    /**
     * Plugin types page.
     *
     * @return void
     */
    public function plugin_page_types() {
        $action     = isset( $_GET['action'] ) ? $_GET['action'] : 'list';
        $id         = isset( $_GET['id'] ) ? intval( $_GET['id'] ) : 0;
        $template   = '';

        switch ($action) {
            case 'view':
                $template = dirname( __FILE__ ) . '/type/type-single.php';
                break;

            case 'edit':
                $template = dirname( __FILE__ ) . '/type/type-edit.php';
                break;

            case 'new':
                $template = dirname( __FILE__ ) . '/type/type-new.php';
                break;

            default:
                $template = dirname( __FILE__ ) . '/type/types.php';
                break;
        }

        if ( file_exists( $template ) ) {
            include( $template );
        }
    }

    /**
     * Plugin plantators page.
     *
     * @return void
     */
    public function plugin_page_plantators() {
        $action     = isset( $_GET['action'] ) ? $_GET['action'] : 'list';
        $id         = isset( $_GET['id'] ) ? intval( $_GET['id'] ) : 0;
        $template   = '';

        switch ($action) {
            case 'view':
                $template = dirname( __FILE__ ) . '/plantator/plantator-single.php';
                break;

            case 'edit':
                $template = dirname( __FILE__ ) . '/plantator/plantator-edit.php';
                break;

            case 'new':
                $template = dirname( __FILE__ ) . '/plantator/plantator-new.php';
                break;

            default:
                $template = dirname( __FILE__ ) . '/plantator/plantators.php';
                break;
        }

        if ( file_exists( $template ) ) {
            include( $template );
        }
    }

    /**
     * Plugin tree page.
     *
     * @return void
     */
    public function plugin_page_trees() {
        $action     = isset( $_GET['action'] ) ? $_GET['action'] : 'list';
        $id         = isset( $_GET['id'] ) ? intval( $_GET['id'] ) : 0;
        $template   = '';

        switch ($action) {
            case 'view':
                $template = dirname( __FILE__ ) . '/tree/tree-single.php';
                break;

            case 'edit':
                $template = dirname( __FILE__ ) . '/tree/tree-edit.php';
                break;

            case 'new':
                $template = dirname( __FILE__ ) . '/tree/tree-new.php';
                break;

            case 'group':
                $template = dirname( __FILE__ ) . '/tree/tree-group.php';
                break;

            case 'approve':
                ac_set_tree_in_progress( $id );
                $template = dirname( __FILE__ ) . '/tree/tree-approve.php';
                break;

            default:
                $template = dirname( __FILE__ ) . '/tree/trees.php';
                break;
        }

        if ( file_exists( $template ) ) {
            include( $template );
        }
    }

    /**
     * Plugin activities page.
     *
     * @return void
     */
    public function plugin_page_activities() {
        $action     = isset( $_GET['action'] ) ? $_GET['action'] : 'list';
        $id         = isset( $_GET['id'] ) ? intval( $_GET['id'] ) : 0;
        $template   = '';

        switch ($action) {
            case 'view':
                $template = dirname( __FILE__ ) . '/activity/activity-single.php';
                break;

            case 'edit':
                $template = dirname( __FILE__ ) . '/activity/activity-edit.php';
                break;

            case 'new':
                $template = dirname( __FILE__ ) . '/activity/activity-new.php';
                break;

            case 'qr':
                $template = dirname( __FILE__ ) . '/activity/activity-qr.php';
                break;

            default:
                $template = dirname( __FILE__ ) . '/activity/activities.php';
                break;
        }

        if ( file_exists( $template ) ) {
            include( $template );
        }
    }
}