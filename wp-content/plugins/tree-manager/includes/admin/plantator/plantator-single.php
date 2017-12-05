<?php
$item = ac_get_plantator( $id );
?>

<div class="wrap">
    <h1><?php _e( 'Учасник', 'vbh' ); ?></h1>
    <?php echo sprintf( '<a href="?page=%s&action=%s" class="add-new-h2">Добавить дерево</a>',  esc_attr( $_REQUEST['page'] ), 'new' ); ?>

    <table class="form-table">
        <tbody>
            TODO: просмотр "моих деревьев" + режим редактирования
            <?php var_dump($item); ?>
        </tbody>
    </table>
</div>