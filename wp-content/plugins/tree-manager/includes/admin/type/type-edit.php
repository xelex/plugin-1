<div class="wrap">
    <h1><?php _e( 'Редактирвоание породы', 'vbh' ); ?></h1>

    <?php $item = ac_get_type( $id ); ?>

    <form action="" method="post">
        <table class="form-table">
            <tbody>
                <tr class="row-name">
                    <th scope="row">
                        <label for="name"><?php _e( 'Описание', 'vbh' ); ?></label>
                    </th>
                    <td>
                        <input type="text" name="name" id="name" class="regular-text" style="width: 100%" value="<?php echo esc_attr( $item->name ); ?>" required="required" />
                    </td>
                </tr>
                <tr class="row-icon">
                    <th scope="row">
                        <label for="icon"><?php _e( 'Иконка', 'vbh' ); ?></label>
                    </th>
                    <td>
                        <p>
                            <img width=50 heigth=50 src="<?=ag_get_type_icon(0)?>" style="margin-bottom: -20px"/>
                            <input type="radio" name="icon" value="0" id="icon-0" checked="<?php $item->icon === 0 ?>"/><label for="icon-0">Лиственное</label>
                        </p>
                        <p style="margin-top: 20px;">
                            <img width=50 heigth=50 src="<?=ag_get_type_icon(1)?>" style="margin-bottom: -20px"/>
                            <input type="radio" name="icon" value="1" id="icon-1" checked="<?php $item->icon === 1 ?>"/><label for="icon-1">Хвойное</label>
                        </p>
                    </td>
                </tr>
                <tr class="row-description">
                    <th scope="row">
                        <label for="description"><?php _e( 'Название', 'vbh' ); ?></label>
                    </th>
                    <td>
                        <textarea name="description" id="description"  rows="10" style="width: 100%" ><?php echo esc_attr( $item->description ); ?></textarea>
                    </td>
                </tr>
            </tbody>
        </table>

        <input type="hidden" name="field_id" value="<?php echo $item->id; ?>">

        <?php wp_nonce_field( 'ac_new_type' ); ?>
        <?php submit_button( __( 'Обновить породу', 'vbh' ), 'primary', 'submit_type' ); ?>
    </form>
</div>