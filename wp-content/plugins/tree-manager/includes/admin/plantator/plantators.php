<div class="wrap">
    <h2>
        <?php _e( 'Люди', 'vbh' ); ?> 
        <?php echo sprintf( '<a href="?page=%s&action=%s" class="add-new-h2 add-new-h2-right">Добавить</a>',  esc_attr( $_REQUEST['page'] ), 'new' ); ?>
    </h2>

    <form method="post">
        <input type="hidden" name="page" value="plantators">
        <?php
            $plantators_list_table = new Plantators_List_Table();
            $plantators_list_table->prepare_items();
            $plantators_list_table->search_box( __( 'Искать', 'vbh' ), 'plantators' );
            $plantators_list_table->display();
        ?>
    </form>
</div>