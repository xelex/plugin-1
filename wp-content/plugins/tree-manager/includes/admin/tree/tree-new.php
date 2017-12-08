<?php 
    include(dirname( __FILE__ ) . '/../../map/geo-editor.php');

    $item = ac_get_tree( $id );
?>
<div class="wrap">
    <h1><?php _e( 'Создание групповой посадки', 'vbh' ); ?></h1>
    <form action="" method="post">
        <table class="form-table">
            <tbody>
                <tr class="row-lat">
                    <th scope="row">
                        <label for="lat"><?php _e( 'Место посадки', 'vbh' ); ?></label>
                    </th>
                    <td>
                    <p>
                    <input type="hidden" name="location" id="geo_editor_map_location" class="regular-text" value="" />
                    <input type="text" name="lat" id="geo_editor_map_lat" readonly="true" class="geo-text" value="<?php echo esc_attr( $item->lat ); ?>" />
                    <input type="text" name="lng" id="geo_editor_map_lng" readonly="true" class="geo-text" value="<?php echo esc_attr( $item->lng ); ?>" />
                    </p>
                    <p>
                        <?php echo geo_container(); ?>
                    <p>
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
                        <label for="type_id"><?php _e( 'Акция', 'vbh' ); ?></label>
                    </th>
                    <td>
                        <select name="action_id" class="regular-text">
                            <?php echo ac_activities_selector($item->action_id); ?>
                        </select>
                    </td>
                </tr>
                <tr class="row-type_is">
                    <th scope="row">
                        <label for="type_id"><?php _e( 'Порода дерева', 'vbh' ); ?></label>
                    </th>
                    <td>
                        <select name="type_id" class="regular-text">
                            <?php echo ac_types_selector($item->type_id); ?>
                        </select>
                    </td>
                </tr>
                <tr class="row-planted">
                    <th scope="row">
                        <label for="planted"><?php _e( 'Дата посадки', 'vbh' ); ?></label>
                    </th>
                    <td>
                        <input type="date" name="planted" id="planted" class="regular-text" value="<?php echo esc_attr( $item->planted ); ?>"  />
                    </td>
                </tr>
            </tbody>
        </table>

        <input type="hidden" name="field_id" value="<?php echo $item->id; ?>">

        <?php wp_nonce_field( 'ac_new_tree' ); ?>
        <?php submit_button( __( 'Обновить', 'vbh' ), 'primary', 'submit_tree' ); ?>

    </form>
</div>