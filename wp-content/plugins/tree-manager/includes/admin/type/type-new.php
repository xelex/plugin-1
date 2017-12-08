<div class="wrap">
    <h1><?php _e( 'Новая порода', 'vbh' ); ?></h1>

    <form action="" method="post">
        <table class="form-table">
            <tbody>
                <tr class="row-name">
                    <th scope="row">
                        <label for="name"><?php _e( 'Описание', 'vbh' ); ?></label>
                    </th>
                    <td>
                        <input type="text" name="name" id="name" class="regular-text" style="width: 100%" value="" required="required" />
                    </td>
                </tr>
                <tr class="row-icon">
                    <th scope="row">
                        <label for="icon"><?php _e( 'Иконка', 'vbh' ); ?></label>
                    </th>
                    <td>
                        <p>
                            <img width=50 heigth=50 src="<?=ag_get_type_icon(0)?>" style="margin-bottom: -20px"/>
                            <input type="radio" name="icon" value="0" id="icon-0" checked="1"/><label for="icon-0">Лиственное</label>
                        </p>
                        <p style="margin-top: 20px;">
                            <img width=50 heigth=50 src="<?=ag_get_type_icon(1)?>" style="margin-bottom: -20px"/>
                            <input type="radio" name="icon" value="1" id="icon-1"/><label for="icon-1">Хвойное</label>
                        </p>
                    </td>
                </tr>
                <tr class="row-description">
                    <th scope="row">
                        <label for="description"><?php _e( 'Название', 'vbh' ); ?></label>
                    </th>
                    <td>
                        <?php wp_editor('', 'description') ?>
                    </td>
                </tr>
            </tbody>
        </table>

        <input type="hidden" name="field_id" value="0">

        <?php wp_nonce_field( 'ac_new_type' ); ?>
        <?php submit_button( __( 'Создать породу', 'vbh' ), 'primary', 'submit_type' ); ?>
    </form>
</div>