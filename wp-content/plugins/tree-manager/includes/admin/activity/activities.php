<div class="wrap">
    <h2>
        <?php _e( 'Акции', 'vbh' ); ?> 
        <?php echo sprintf( '<a href="?page=%s&action=%s" class="add-new-h2 add-new-h2-right">Добавить</a>',  esc_attr( $_REQUEST['page'] ), 'new' ); ?>
    </h2>

    <form method="post">
        <input type="hidden" name="page" value="activities">
        <?php
            $activities_list_table = new Activities_List_Table();
            $activities_list_table->prepare_items();
            $activities_list_table->search_box( __( 'Искать', 'vbh' ), 'activities' );
            $activities_list_table->display();
        ?>
    </form>
</div>