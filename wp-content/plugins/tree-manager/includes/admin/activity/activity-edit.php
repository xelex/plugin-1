<?php 
    include($template = dirname( __FILE__ ) . '/../../map/geo-editor.php');
?>
<div class="wrap">
    <h1><?php _e( 'Редактировать акцию', 'vbh' ); ?></h1>

    <?php $item = ac_get_activity( $id ); ?>

    <form action="" method="post">

        <table class="form-table">
            <tbody>
                <tr class="row-name">
                    <th scope="row">
                        <label for="name"><?php _e( 'Название', 'vbh' ); ?></label>
                    </th>
                    <td>
                        <input type="text" name="name" id="name" class="regular-text" value="<?php echo esc_attr( $item->name ); ?>" required="required" />
                    </td>
                </tr>
                <tr class="row-lat">
                    <th scope="row">
                        <label for="lat"><?php _e( 'Место проведения', 'vbh' ); ?></label>
                    </th>
                    <td>
                    <p>
                    <input type="text" name="location" id="geo_editor_map_location" class="regular-text" value="<?php echo esc_attr( $item->location ); ?>"  />
                    </p>
                    <p>
                    <input type="text" name="lat" id="geo_editor_map_lat" readonly="true" class="geo-text" value="<?php echo esc_attr( $item->lat ); ?>"  />
                    <input type="text" name="lng" id="geo_editor_map_lng" readonly="true" class="geo-text" value="<?php echo esc_attr( $item->lng ); ?>"  />
                    </p>
                    <p>
                        <?php echo geo_container(); ?>
                    <p>
                    </td>
                </tr>
                <tr class="row-when">
                    <th scope="row">
                        <label for="when"><?php _e( 'Дата проведения', 'vbh' ); ?></label>
                    </th>
                    <td>
                        <input type="date" name="when" id="when" class="regular-text" value="<?php echo esc_attr( $item->when ); ?>"  />
                    </td>
                </tr>
                <tr class="row-when">
                    <th scope="row">
                        <label for="when"><?php _e( 'Порода дерева', 'vbh' ); ?></label>
                    </th>
                    <td>
                        <select name="type_id" class="regular-text">
                            <?php echo ac_types_selector($item->type_id); ?>
                        </select>
                    </td>
                </tr>
                <tr class="row-description">
                    <th scope="row">
                        <label for="description"><?php _e( 'Описание', 'vbh' ); ?></label>
                    </th>
                    <td>
                        <textarea name="description" id="description" class="view-description"><?php echo esc_attr( $item->description ); ?></textarea>
                    </td>
                </tr>
            </tbody>
        </table>

        <input type="hidden" name="field_id" value="<?php echo $item->id; ?>">

        <?php wp_nonce_field( 'ac_new_activity' ); ?>
        <?php submit_button( __( 'Обновить акцию', 'vbh' ), 'primary', 'submit_activity' ); ?>

    </form>
</div>