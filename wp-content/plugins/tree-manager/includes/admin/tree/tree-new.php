<div class="wrap">
    <h1><?php _e( 'Добавить новую посадку', 'vbh' ); ?></h1>

    <form action="" method="post">
        <table class="form-table">
            <tbody>
                <tr class="row-lat">
                    <th scope="row">
                        <label for="lat"><?php _e( 'Координаты', 'vbh' ); ?></label>
                    </th>
                    <td>
                        <input type="number" name="lat" id="lat" class="regular-text" readOnly="true" value="0" required="required" style="width: 120px" />
                        <input type="number" name="lng" id="lng" class="regular-text" readOnly="true" value="0" required="required" style="width: 120px" />
                    </td>
                </tr>
                <tr class="row-approved">
                    <th scope="row">
                        <label for="approved"><?php _e( 'Проверено', 'vbh' ); ?></label>
                    </th>
                    <td>
                        <label for="approved">
                            <input name="approved" type="checkbox" id="approved" value="1">
                        </label>
                    </td>
                </tr>
                <tr class="row-action_id">
                    <th scope="row">
                        <label for="action_id"><?php _e( 'Акция', 'vbh' ); ?></label>
                    </th>
                    <td>
                        <input type="number" name="action_id" id="action_id" class="regular-text" value=""  />
                    </td>
                </tr>
                <tr class="row-owner_id">
                    <th scope="row">
                        <label for="owner_id"><?php _e( 'Владелец', 'vbh' ); ?></label>
                    </th>
                    <td>
                        <input type="number" name="owner_id" id="owner_id" class="regular-text" value=""  />
                    </td>
                </tr>
                <tr class="row-type_id">
                    <th scope="row">
                        <label for="type_id"><?php _e( 'Сорт', 'vbh' ); ?></label>
                    </th>
                    <td>
                        <input type="number" name="type_id" id="type_id" class="regular-text" value=""  />
                    </td>
                </tr>
            </tbody>
        </table>

        <input type="hidden" name="field_id" value="0">

        <?php wp_nonce_field( 'ac_new_tree' ); ?>
        <?php submit_button( __( 'Создать Tree', 'vbh' ), 'primary', 'submit_tree' ); ?>
    </form>
</div>