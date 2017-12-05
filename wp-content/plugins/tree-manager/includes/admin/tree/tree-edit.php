<div class="wrap">
    <h1><?php _e( 'Редактирвоание посадки', 'vbh' ); ?></h1>

    <?php $item = ac_get_tree( $id ); ?>

    <form action="" method="post">

        <table class="form-table">
            <tbody>
                        <tr class="row-lat">
                            <th scope="row">
                                <label for="lat"><?php _e( 'Lat', 'vbh' ); ?></label>
                            </th>
                            <td>
                                <input type="text" name="lat" id="lat" class="regular-text" value="<?php echo esc_attr( $item->lat ); ?>" required="required" />
                            </td>
                        </tr>
                        <tr class="row-lng">
                            <th scope="row">
                                <label for="lng"><?php _e( 'Lng', 'vbh' ); ?></label>
                            </th>
                            <td>
                            <input type="number" name="lng" id="lng" class="regular-text" value="<?php echo esc_attr( $item->lng ); ?>" required="required" />
                            </td>
                        </tr>                        <tr class="row-approved">
                            <th scope="row">
                                <label for="approved"><?php _e( 'Approved', 'vbh' ); ?></label>
                            </th>
                            <td>
                                <label for="approved">
                                    <input name="approved" type="checkbox" id="approved" value="1">
                                    Confirm
                                </label>
                            </td>
                        </tr>
                        <tr class="row-action_id">
                            <th scope="row">
                                <label for="action_id"><?php _e( 'Action Id', 'vbh' ); ?></label>
                            </th>
                            <td>
                            <input type="number" name="action_id" id="action_id" class="regular-text" value="<?php echo esc_attr( $item->action_id ); ?>"  />
                            </td>
                        </tr>
                        <tr class="row-owner_id">
                            <th scope="row">
                                <label for="owner_id"><?php _e( 'Owner Id', 'vbh' ); ?></label>
                            </th>
                            <td>
                            <input type="number" name="owner_id" id="owner_id" class="regular-text" value="<?php echo esc_attr( $item->owner_id ); ?>"  />
                            </td>
                        </tr>
                        <tr class="row-type_id">
                            <th scope="row">
                                <label for="type_id"><?php _e( 'Type Id', 'vbh' ); ?></label>
                            </th>
                            <td>
                            <input type="number" name="type_id" id="type_id" class="regular-text" value="<?php echo esc_attr( $item->type_id ); ?>"  />
                            </td>
                        </tr>
                        <tr class="row-url">
                            <th scope="row">
                                <label for="url"><?php _e( 'Url', 'vbh' ); ?></label>
                            </th>
                            <td>
                                <input type="text" name="url" id="url" class="regular-text" value="<?php echo esc_attr( $item->url ); ?>"  />
                            </td>
                        </tr>
                        <tr class="row-planted">
                            <th scope="row">
                                <label for="planted"><?php _e( 'Planted', 'vbh' ); ?></label>
                            </th>
                            <td>
                                <input type="text" name="planted" id="planted" class="regular-text" value="<?php echo esc_attr( $item->planted ); ?>"  />
                            </td>
                        </tr>
                        <tr class="row-last">
                            <th scope="row">
                                <label for="last"><?php _e( 'Last', 'vbh' ); ?></label>
                            </th>
                            <td>
                                <input type="text" name="last" id="last" class="regular-text" value="<?php echo esc_attr( $item->last ); ?>"  />
                            </td>
                        </tr>
            </tbody>
        </table>

        <input type="hidden" name="field_id" value="<?php echo $item->id; ?>">

        <?php wp_nonce_field( 'ac_new_tree' ); ?>
        <?php submit_button( __( 'Обновить Tree', 'vbh' ), 'primary', 'submit_tree' ); ?>

    </form>
</div>