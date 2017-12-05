<?php
$item = ac_get_tree( $id );
?>

<div class="wrap">
    <h1><?php _e( 'Посадка', 'vbh' ); ?></h1>
    <table class="form-table">
        <tbody>
            <?php ac_geo_show_trees($item); ?>
        </tbody>
    </table>
</div>