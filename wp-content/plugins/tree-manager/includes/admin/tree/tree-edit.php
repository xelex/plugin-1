<?php 
    include(dirname( __FILE__ ) . '/../../map/geo-editor.php');

    $item = ac_get_tree( $id );
?>
<div class="wrap">
    <h1><?php _e( 'Редактирвоание посадки', 'vbh' ); ?>: <?php echo esc_attr($id); ?></h1>
    <form action="" method="post">
        <table class="form-table">
            <tbody>
                <tr class="row-action_id">
                    <th scope="row">
                        <label for="type_id"><?php _e( 'Акция', 'vbh' ); ?></label>
                        <?php required(); ?>
                    </th>
                    <td>
                        <select name="action_id" class="regular-text" onchange="return confirm('Вы уверены, что хотите изменить акцию?');">
                            <?php echo ac_activities_selector($item->action_id); ?>
                        </select>
                    </td>
                </tr>
                <tr class="row-type_id">
                    <th scope="row">
                        <label for="type_id"><?php _e( 'Порода дерева', 'vbh' ); ?></label>
                        <?php required(); ?>
                    </th>
                    <td>
                        <select name="type_id" class="regular-text" onchange="return confirm('Вы уверены, что хотите изменить породу дерева?');">
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
                <?php if ($item->amount > 0) {?>
                
                <tr class="row-amount">
                    <th scope="row">
                        <label for="amount"><?php _e( 'Количество', 'vbh' ); ?></label>
                        <?php required(); ?>
                    </th>
                    <td>
                        <input type="number" name="amount" id="amount" class="regular-text" min=1 value="<?php echo esc_attr($item->amount); ?>" required=true />
                    </td>
                </tr>
                <tr class="row-description">
                    <th scope="row">
                        <label for="description"><?php _e( 'Описание', 'vbh' ); ?></label>
                    </th>
                    <td>
                        <?php wp_editor($item->description, 'description') ?>
                    </td>
                </tr>
                <?php } ?>
                <tr class="row-lat">
                    <th scope="row">
                        <label for="lat"><?php _e( 'Место посадки', 'vbh' ); ?></label>
                        <?php required(); ?>
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
            </tbody>
        </table>

        <?php // Hidden fields ?>
        <input type="hidden" name="approved" id="approved" value="1" <?php echo $item->approved == 1 ? 'checked' : ''; ?>>
        <input type="hidden" name="field_id" value="<?php echo $item->id; ?>">

        <?php wp_nonce_field( 'ac_new_tree' ); ?>
        <?php submit_button( __( 'Обновить', 'vbh' ), 'primary', 'submit_tree' ); ?>

    </form>
</div>