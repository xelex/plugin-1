<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * Admin Form Handler.
 *
 * Handle all form's submissions
 */
class Form_Handler {
    /**
     * Constructor.
     */
    public function __construct() {
        $hooks = array(
            'handle_types_form_submit', 'handle_types_bulk_action',
            'handle_trees_form_submit', 'handle_trees_bulk_action',
            'handle_plantators_form_submit', 'handle_plantators_bulk_action',
            'handle_activities_form_submit', 'handle_activities_bulk_action',
            'handle_qrgen');

        foreach ($hooks as $hook) {
            add_action( 'admin_init', [ $this, $hook ] );
        }
    }

    /**
     * Handles form data when submitted.
     *
     * @return void
     */
    public function handle_trees_form_submit() {
        if ( ! isset( $_POST['submit_tree'] ) ) {
            return;
        }

        if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'ac_new_tree' ) ) {
            return;
        }

        if ( ! current_user_can( 'read' ) ) {
            wp_die( __( 'Permission Denied!', 'vbh' ) );
        }

        $errors   = array();
        $page_url = menu_page_url( 'tree-manager', false );
        $field_id = isset( $_POST['field_id'] ) ? absint( $_POST['field_id'] ) : 0;

        $lat = isset( $_POST['lat'] ) ? sanitize_text_field( $_POST['lat'] ) : '';
        $lng = isset( $_POST['lng'] ) ? sanitize_text_field( $_POST['lng'] ) : '';
        $approved = isset( $_POST['approved'] ) ? sanitize_text_field( $_POST['approved'] ) : '';
        $action_id = isset( $_POST['action_id'] ) ? sanitize_text_field( $_POST['action_id'] ) : '';
        $owner_id = isset( $_POST['owner_id'] ) ? sanitize_text_field( $_POST['owner_id'] ) : '';
        $type_id = isset( $_POST['type_id'] ) ? sanitize_text_field( $_POST['type_id'] ) : '';
        $url = isset( $_POST['url'] ) ? sanitize_text_field( $_POST['url'] ) : '';
        $planted = isset( $_POST['planted'] ) ? sanitize_text_field( $_POST['planted'] ) : '';
        $last = isset( $_POST['last'] ) ? sanitize_text_field( $_POST['last'] ) : '';


        $fields = array(
            'lat' => $lat,
            'lng' => $lng,
            'approved' => $approved,
            'action_id' => $action_id,
            'owner_id' => $owner_id,
            'type_id' => $type_id,
            'url' => $url,
            'planted' => $planted,
            'last' => $last,
        );

        // New or edit?
        if ( ! $field_id ) {
            $insert_id = ac_insert_tree( $fields );
        } else {
            $fields['id'] = $field_id;

            $insert_id = ac_insert_tree( $fields );
        }

        if ( is_wp_error( $insert_id ) ) {
            $redirect_to = add_query_arg( array( 'message' => 'error' ), $page_url );
        } else {
            $redirect_to = add_query_arg( array( 'message' => 'success' ), $page_url );
        }

        // Redirect
//        wp_redirect( $redirect_to );
        exit;
    }

    /**
     * Handles form data when submitted.
     *
     * @return void
     */
    public function handle_types_form_submit() {
        if ( ! isset( $_POST['submit_type'] ) ) {
            return;
        }

        if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'ac_new_type' ) ) {
            return;
        }

        if ( ! current_user_can( 'read' ) ) {
            wp_die( __( 'Permission Denied!', 'vbh' ) );
        }

        $errors   = array();
        $page_url = menu_page_url( 'tree-manager-types', false );
        $field_id = isset( $_POST['field_id'] ) ? absint( $_POST['field_id'] ) : 0;

        $name = isset( $_POST['name'] ) ? sanitize_text_field( $_POST['name'] ) : '';
        $icon = isset( $_POST['icon'] ) ? sanitize_text_field( $_POST['icon'] ) : '';
        $description = isset( $_POST['description'] ) ? wp_kses_post( $_POST['description'] ) : '';

        $fields = array(
            'name' => $name,
            'icon' => $icon,
            'description' => $description,
        );

        // New or edit?
        if ( ! $field_id ) {
            $insert_id = ac_insert_type( $fields );
        } else {
            $fields['id'] = $field_id;

            $insert_id = ac_insert_type( $fields );
        }

        if ( is_wp_error( $insert_id ) ) {
            $redirect_to = add_query_arg( array( 'message' => 'error' ), $page_url );
        } else {
            $redirect_to = add_query_arg( array( 'message' => 'success' ), $page_url );
        }

        // Redirect
//        wp_redirect( $redirect_to );
        exit;
    }

    /**
     * Handles form data when submitted.
     *
     * @return void
     */
    public function handle_plantators_form_submit() {
        if ( ! isset( $_POST['submit_plantator'] ) ) {
            return;
        }

        if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'ac_new_plantator' ) ) {
            return;
        }

        if ( ! current_user_can( 'read' ) ) {
            wp_die( __( 'Permission Denied!', 'vbh' ) );
        }

        $errors   = array();
        $page_url = menu_page_url( 'tree-manager-plantators', false );
        $field_id = isset( $_POST['field_id'] ) ? absint( $_POST['field_id'] ) : 0;

        $name = isset( $_POST['name'] ) ? sanitize_text_field( $_POST['name'] ) : '';
        $when = isset( $_POST['when'] ) ? sanitize_text_field( $_POST['when'] ) : '';
        $fb = isset( $_POST['fb'] ) ? sanitize_text_field( $_POST['fb'] ) : '';
        $vk = isset( $_POST['vk'] ) ? sanitize_text_field( $_POST['vk'] ) : '';
        $tw = isset( $_POST['tw'] ) ? sanitize_text_field( $_POST['tw'] ) : '';
        $ig = isset( $_POST['ig'] ) ? sanitize_text_field( $_POST['ig'] ) : '';
        $email = isset( $_POST['email'] ) ? sanitize_text_field( $_POST['email'] ) : '';
        $phone = isset( $_POST['phone'] ) ? sanitize_text_field( $_POST['phone'] ) : '';
        $description = isset( $_POST['description'] ) ? wp_kses_post( $_POST['description'] ) : '';


        $fields = array(
            'name' => $name,
            'when' => $when,
            'fb' => $fb,
            'vk' => $vk,
            'tw' => $tw,
            'ig' => $ig,
            'email' => $email,
            'phone' => $phone,
            'description' => $description,
        );

        // New or edit?
        if ( ! $field_id ) {
            $insert_id = ac_insert_plantator( $fields );
        } else {
            $fields['id'] = $field_id;

            $insert_id = ac_insert_plantator( $fields );
        }

        if ( is_wp_error( $insert_id ) ) {
            $redirect_to = add_query_arg( array( 'message' => 'error' ), $page_url );
        } else {
            $redirect_to = add_query_arg( array( 'message' => 'success' ), $page_url );
        }

        // Redirect
//        wp_redirect( $redirect_to );
        exit;
    }

    /**
     * Handles form data when submitted.
     *
     * @return void
     */
    public function handle_activities_form_submit() {
        if ( ! isset( $_POST['submit_activity'] ) ) {
            return;
        }

        if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'ac_new_activity' ) ) {
            return;
        }

        if ( ! current_user_can( 'read' ) ) {
            wp_die( __( 'Permission Denied!', 'vbh' ) );
        }

        $errors   = array();
        $page_url = menu_page_url( 'tree-manager', false );
        $field_id = isset( $_POST['field_id'] ) ? absint( $_POST['field_id'] ) : 0;

        $name = isset( $_POST['name'] ) ? sanitize_text_field( $_POST['name'] ) : '';
        $total = intval(isset( $_POST['total'] ) ? sanitize_text_field( $_POST['total'] ) : 0);
        $type_id = intval(isset( $_POST['type_id'] ) ? sanitize_text_field( $_POST['type_id'] ) : 0);
        $lat = doubleval(isset( $_POST['lat'] ) ? sanitize_text_field( $_POST['lat'] ) : 0);
        $lng = doubleval(isset( $_POST['lng'] ) ? sanitize_text_field( $_POST['lng'] ) : 0);
        $when = isset( $_POST['when'] ) ? sanitize_text_field( $_POST['when'] ) : '';
        $location = isset( $_POST['location'] ) ? sanitize_text_field( $_POST['location'] ) : '';
        $description = isset( $_POST['description'] ) ? wp_kses_post( $_POST['description'] ) : '';


        $fields = array(
            'name' => $name,
            'total' => $total,
            'type_id' => $type_id,
            'lat' => $lat,
            'lng' => $lng,
            'when' => $when,
            'location' => $location,
            'description' => $description,
        );

        // New or edit?
        if ( ! $field_id ) {
            $insert_id = ac_insert_activity( $fields );
        } else {
            $fields['id'] = $field_id;

            $insert_id = ac_insert_activity( $fields );
        }

        if ( is_wp_error( $insert_id ) ) {
            $redirect_to = add_query_arg( array( 'message' => 'error' ), $page_url );
        } else {
            $redirect_to = add_query_arg( array( 'message' => 'success' ), $page_url );
        }

        // Redirect
        wp_redirect( $redirect_to );
        exit;
    }

    /**
     * Bulk operation handlers
     */
    public function handle_activities_bulk_action() {
        $this->handle_bulk_action('tree-manager-activities', 'ac_delete_activity', 'ac_delete_activity');
    }

    public function handle_plantators_bulk_action() {
        $this->handle_bulk_action('tree-manager-plantators', 'ac_delete_plantator', 'ac_delete_plantator');
    }

    public function handle_types_bulk_action() {
        $this->handle_bulk_action('tree-manager-planttypesators', 'ac_delete_type', 'ac_delete_type');
    }

    public function handle_trees_bulk_action() {
        $this->handle_bulk_action('tree-manager', 'ac_delete_tree', 'ac_delete_tree');
    }

    private function handle_bulk_action($page, $nonce_name, $function) {
        $page_url = menu_page_url( $page, false );

        // Detect when a bulk action is being triggered...
        if ( isset( $_REQUEST['action'] ) && $_REQUEST['action'] == 'delete' ) {
            // In our file that handles the request, verify the nonce.
            $nonce = esc_attr( $_REQUEST['_wpnonce'] );

            if ( ! wp_verify_nonce( $nonce, $nonce_name ) ) {
                return;
            } else {
                call_user_func( $function, absint( $_REQUEST['id'] ) );

                // Redirect
                $query = array( 'message' => 'deleted');
                $redirect_to = add_query_arg( $query, $page_url );
                wp_redirect( $redirect_to );
                exit;
            }
        }

        // If the delete bulk action is triggered
        if ( ( isset( $_REQUEST['action'] ) && $_REQUEST['action'] == 'bulk-delete' )
             || ( isset( $_REQUEST['action2'] ) && $_REQUEST['action2'] == 'bulk-delete' )
        ) {
            $delete_ids = esc_sql( $_REQUEST['bulk-delete'] );

            // loop over the array of record ids and delete them
            foreach ( $delete_ids as $id ) {
                call_user_func( $function, $id );
            }

            // Redirect
            $query = array( 'message' => 'deleted');
            $redirect_to = add_query_arg( $query, $page_url );
            wp_redirect( $redirect_to );
            exit;
        }
    }

    /**
     * QR generator
     */
    public function handle_qrgen() {
        if ( ! isset( $_POST['submit_activity_qrgen'] ) ) {
            return;
        }
        
        // Generate full QR gen

    }
}