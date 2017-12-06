<?php
$item = ac_get_type( $id );
$count_tree = ac_get_type_trees_count( $id );
$count_act = ac_get_type_activities_count( $id );
?>
<div class="wrap">
    <h1><?php _e( 'Просмотр породы', 'vbh' ); ?></h1>
    <table class="form-table">
        <tbody>
            <tr class="row-name">
                <th scope="row">
                    <b><?php _e( 'Название', 'vbh' ); ?></b>
                </th>
                <td>
                    <?php echo esc_attr( $item->name ); ?>
                </td>
            </tr>
            <tr class="row-icon">
                <th scope="row">
                    <b><?php _e( 'Иконка', 'vbh' ); ?></b>
                </th>
                <td>
                    <img width=50 heigth=50 src="<?=ag_get_type_icon(esc_attr( $item->icon ))?>" style="margin-bottom: -20px"/>
                </td>
            </tr>
            <tr class="row">
                <th scope="row">
                    <b><?php _e( 'Использован в акциях', 'vbh' ); ?></b>
                </th>
                <td>
                    <?php echo $count_act->count ?>
                </td>
            </tr>
            <tr class="row">
                <th scope="row">
                    <b><?php _e( 'Посажено деревьев', 'vbh' ); ?></b>
                </th>
                <td>
                    <?php echo $count_tree->count ?>
                </td>
            </tr>
            <tr class="row-description">
                <th scope="row">
                    <b><?php _e( 'Описание', 'vbh' ); ?></b>
                </th>
                <td>
                    <textarea class="view-description" readonly="true">
                        <?php echo esc_attr( $item->description ); ?>
                    </textarea>
                </td>
            </tr>
        </tbody>
    </table>
</div>