<?php 
    include(dirname( __FILE__ ) . '/../../map/geo-editor.php');
?>
<div class="wrap">
    <h1><?php _e( 'Новая акция', 'vbh' ); ?></h1>
    <form action="" method="post">

        <table class="form-table">
            <tbody>
                <tr class="row-name">
                    <th scope="row">
                        <label for="name"><?php _e( 'Название', 'vbh' ); ?></label>
                        <?php required(); ?>
                    </th>
                    <td>
                        <input type="text" name="name" id="name" class="regular-text" value="" required="required" />
                    </td>
                </tr>
                <tr class="row-lat">
                    <th scope="row">
                        <label for="lat"><?php _e( 'Место проведения', 'vbh' ); ?></label>
                    </th>
                    <td>
                    <p>
                    <input type="text" name="location" id="geo_editor_map_location" class="regular-text" value=""  />
                    </p>
                    <p>
                    <input type="text" name="lat" id="geo_editor_map_lat" readonly="true" class="geo-text" value=""  />
                    <input type="text" name="lng" id="geo_editor_map_lng" readonly="true" class="geo-text" value=""  />
                    </p>
                    <p>
                        <?php echo geo_container(); ?>
                    <p>
                    </td>
                </tr>
                <tr class="row-global">
                    <th scope="row">
                        <label for="global"><?php _e( 'Федеральная акция', 'vbh' ); ?></label>
                    </th>
                    <td>
                        <input name="global" type="checkbox" id="global" value="1">
                    </td>
                </tr>
                <tr class="row-when">
                    <th scope="row">
                        <label for="when"><?php _e( 'Дата проведения', 'vbh' ); ?></label>
                    </th>
                    <td>
                        <input type="date" name="when" id="when" class="regular-text" value=""  />
                    </td>
                </tr>
                <tr class="row-when">
                    <th scope="row">
                        <label for="when"><?php _e( 'Порода дерева', 'vbh' ); ?></label>
                    </th>
                    <td>
                        <select name="type_id" class="regular-text">
                            <?php echo ac_types_selector(); ?>
                        </select>
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

        <?php wp_nonce_field( 'ac_new_activity' ); ?>
        <?php submit_button( __( 'Создать акцию', 'vbh' ), 'primary', 'submit_activity' ); ?>

    </form>
</div>