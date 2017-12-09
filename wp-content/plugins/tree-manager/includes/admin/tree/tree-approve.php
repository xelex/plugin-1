<?php 
    include(dirname( __FILE__ ) . '/../../map/geo-view.php');

    $item = ac_get_tree( $id );
?>
<div class="wrap">
    <h1><?php _e( 'Верификация посадки', 'vbh' ); ?>: <?php echo esc_attr($id); ?></h1>
    <form action="" method="post">
        <table class="form-table">
            <tbody>
                <tr class="row-action_id">
                    <th scope="row">
                        <label for="type_id"><?php _e( 'Акция', 'vbh' ); ?></label>
                    </th>
                    <td>
                        <select name="action_id" class="regular-text" disabled=true>
                            <?php echo ac_activities_selector($item->action_id); ?>
                        </select>
                    </td>
                </tr>
                <tr class="row-type_id">
                    <th scope="row">
                        <label for="type_id"><?php _e( 'Порода дерева', 'vbh' ); ?></label>
                    </th>
                    <td>
                        <select name="type_id" class="regular-text" disabled=true>
                            <?php echo ac_types_selector($item->type_id); ?>
                        </select>
                    </td>
                </tr>
                <tr class="row-planted">
                    <th scope="row">
                        <label for="planted"><?php _e( 'Дата посадки', 'vbh' ); ?></label>
                    </th>
                    <td>
                        <input type="date" name="planted" id="planted" class="regular-text" value="<?php echo esc_attr( $item->planted ); ?>" disabled=true />
                    </td>
                </tr>
                <?php if ($item->amount > 0) {?>
                
                <tr class="row-amount">
                    <th scope="row">
                        <label for="amount"><?php _e( 'Количество', 'vbh' ); ?></label>
                    </th>
                    <td>
                        <input type="number" name="amount" id="amount" class="regular-text" min=1 value="<?php echo esc_attr($item->amount); ?>" disabled=true />
                    </td>
                </tr>
                <tr class="row-description">
                    <th scope="row">
                        <label for="description"><?php _e( 'Описание', 'vbh' ); ?></label>
                    </th>
                    <td>
                        <?php echo $item->description; ?>
                    </td>
                </tr>
                <?php } ?>
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
                <tr class="row-images">
                    <th scope="row">
                        <label for="images"><?php _e( 'Фотографии', 'vbh' ); ?></label>
                    </th>
                    <td>
                        Здесь будут фотографии (их можно будет удалить)
                        <?php echo $item->description; ?>
                    </td>
                </tr>
            </tbody>
        </table>

        <?php // Hidden fields ?>
        <input type="hidden" name="approved" id="approved" value="1" <?php echo $item->approved == 1 ? 'checked' : ''; ?>>
        <input type="hidden" name="field_id" value="<?php echo $item->id; ?>">

        <?php wp_nonce_field( 'ac_approve_tree' ); ?>

        <p class="submit">
            <input type="submit" name="allow_tree" id="allow_tree" class="button button-primary" value="Резрешить к показу на публичной карте"  />
            <input type="submit" name="disallow_tree" id="disallow_tree" class="button submit-button-rigth deny-button-color" value="Запретить к показу на публичной карте" onclick="return confirm('Вы уверены?');" />
        </p>
    </form>
</div>