<?php
$item = ac_get_activity( $id );
?>

<div class="wrap">
    <h1><?php _e( 'Акция', 'vbh' ); ?></h1>
    <table class="form-table">
        <tbody>
            <?php var_dump($item); ?>
        </tbody>
    </table>
</div>