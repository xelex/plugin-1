<div class="wrap">
    <h2>
        <?php _e( 'Посадки', 'vbh' ); ?> 
    </h2>

    <form method="post">
        <input type="hidden" name="page" value="trees">
        <?php
            $trees_list_table = new Trees_List_Table();
            $trees_list_table->prepare_items();
            $trees_list_table->search_box( __( 'Искать', 'vbh' ), 'trees' );
            $trees_list_table->display();
        ?>
    </form>
</div>