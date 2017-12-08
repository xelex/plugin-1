<?php
    $filter = $_REQUEST['filter'];
    $filter_id = $_REQUEST['filter_id'];
    if ($id > 0) {
        $filter = 'all';
        $filter_id = $id;
    }
    include(dirname( __FILE__ ) . '/../../map/geo.php');
?>
<div class="wrap">
    <h1>
        <?php
        switch($filter) {
            case 'action':
                _e( 'Посадки для акции: ', 'vbh');
                $filter_id = esc_attr($_REQUEST['filter_id']);
                $activity = ac_get_activity($filter_id);
                printf( '<a href="?page=%s&action=%s&id=%d">'.esc_attr($activity->name).'</a>',  'tree-manager', 'view', absint( $activity->id ) );
                break;
            case 'type':
                _e( 'Посадки породы: ', 'vbh' );
                $filter_id = esc_attr($_REQUEST['filter_id']);
                $type = ac_get_type($filter_id);
                printf( '<a href="?page=%s&action=%s&id=%d">'.esc_attr($type->name).'</a>',  'tree-manager-types', 'view', absint( $type->id ) );
                break;
            case 'approved':
                _e( 'Просмотр проверенных посадок', 'vbh' );
                break;
            case 'unapproved':
                _e( 'Просмотр непроверенных посадок', 'vbh' );
                break;
            case 'all':
            default:
                _e( 'Все посадки', 'vbh' );
                break;
        }
        ?>
        <?php echo '<a href="'.remove_query_arg('action').'" class="add-new-h2">Показать списком</a>'; ?>
    </h1>
    <?php echo geo_container(); ?>
</div>