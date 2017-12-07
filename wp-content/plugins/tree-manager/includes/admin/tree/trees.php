<?php 
    $action = esc_attr($_REQUEST['action']);
    $filter = esc_attr($_REQUEST['filter']);
?>
<div class="wrap">
    <h2>
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
        <?php echo '<a href="'.add_query_arg('action', 'view').'" class="add-new-h2">Показать на карте</a>'; ?>
    </h2>
    <form method="post">
        <input type="hidden" name="page" value="trees">
        <?php
            $trees_list_table = new Trees_List_Table();
            $trees_list_table->views();
            $trees_list_table->prepare_items();
            $trees_list_table->display();
        ?>
    </form>
</div>