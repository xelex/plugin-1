<?php
get_current_screen()->add_help_tab( array(
	'id'		=> 'tree-manager-types-1',
	'title'		=> __('Виды деревьев'),
	'content'	=>
		'<p>' . __('В данном разделе вы можете управлять доступными в системе видами деревьев.') . '</p>') );
//TODO: fix it
?>
<div class="wrap">
    <h2>
        <?php _e( 'Виды', 'vbh' ); ?> 
        <?php echo sprintf( '<a href="?page=%s&action=%s" class="add-new-h2 add-new-h2-right">Добавить</a>',  esc_attr( $_REQUEST['page'] ), 'new' ); ?>
    </h2>

    <form method="post">
        <input type="hidden" name="page" value="types">
        <?php
            $types_list_table = new Types_List_Table();
            $types_list_table->prepare_items();
            $types_list_table->search_box( __( 'Искать', 'vbh' ), 'types' );
            $types_list_table->display();
        ?>
    </form>
</div>