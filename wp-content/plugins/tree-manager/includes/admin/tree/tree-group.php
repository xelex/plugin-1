<?php 
    include(dirname( __FILE__ ) . '/../../map/geo-editor.php');
?>
<div class="wrap">
    <h1><?php _e( 'Создание групповой посадки', 'vbh' ); ?></h1>
    <form action="" method="post">
        <table class="form-table">
            <tbody>
                <tr class="row-lat">
                    <th scope="row">
                        <label for="lat"><?php _e( 'Место посадки', 'vbh' ); ?></label>
                        <?php required(); ?>
                    </th>
                    <td>
                    <p>
                    <input type="hidden" name="location" id="geo_editor_map_location" class="regular-text" value="" />
                    <input type="text" name="lat" id="geo_editor_map_lat" readonly="true" class="geo-text" value="" />
                    <input type="text" name="lng" id="geo_editor_map_lng" readonly="true" class="geo-text" value="" />
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
                            <input name="approved" type="checkbox" id="approved" value="1" checked=true disabled=true>
                        </label>
                    </td>
                </tr>
                <tr class="row-action_id">
                    <th scope="row">
                        <label for="type_id"><?php _e( 'Акция', 'vbh' ); ?></label>
                        <?php required(); ?>
                    </th>
                    <td>
                        <select name="action_id" class="regular-text" required=true>
                            <?php echo ac_activities_selector(); ?>
                        </select>
                    </td>
                </tr>
                <tr class="row-type_is">
                    <th scope="row">
                        <label for="type_id"><?php _e( 'Порода дерева', 'vbh' ); ?></label>
                        <?php required(); ?>
                    </th>
                    <td>
                        <select name="type_id" class="regular-text" required=true>
                            <?php echo ac_types_selector(); ?>
                        </select>
                    </td>
                </tr>
                <tr class="row-planted">
                    <th scope="row">
                        <label for="planted"><?php _e( 'Дата посадки', 'vbh' ); ?></label>
                    </th>
                    <td>
                        <input type="date" name="planted" id="planted" class="regular-text" value=""  />
                    </td>
                </tr>
                <tr class="row-amount">
                    <th scope="row">
                        <label for="amount"><?php _e( 'Количество', 'vbh' ); ?></label>
                        <?php required(); ?>
                    </th>
                    <td>
                        <input type="number" name="amount" id="amount" class="regular-text" min=1 value="1" required=true />
                    </td>
                </tr>
                <tr class="row-description">
                    <th scope="row">
                        <label for="description"><?php _e( 'Описание', 'vbh' ); ?></label>
                    </th>
                    <td>
                        <?php wp_editor('', 'description') ?>
                    </td>
                </tr>
            </tbody>
        </table>

        <input type="hidden" name="field_id" value="0">

        <?php wp_nonce_field( 'ac_new_treegroup' ); ?>
        <?php submit_button( __( 'Добавить группу', 'vbh' ), 'primary', 'submit_treegroup' ); ?>

    </form>
</div>