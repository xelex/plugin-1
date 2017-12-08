<?php
    include(dirname( __FILE__ ) . '/../../map/geo-view.php');
    $item = ac_get_activity( $id );
    $type = ac_get_type($item->type_id);
?>

<div class="wrap">
    <h1><?php _e( 'Акция', 'vbh' ); ?></h1>
    <table class="form-table">
        <tbody>
            <tr class="row-name">
                <th scope="row">
                    <b><?php _e( 'Название', 'vbh' ); ?></b>
                </th>
                <td>
                    <?php echo esc_attr( $item->name ); ?>
                </td>
            </tr>
            <tr class="row-lat">
                <th scope="row">
                    <b><?php _e( 'Место проведения', 'vbh' ); ?></b>
                </th>
                <td>
                <p>
                <input type="text" name="location" id="geo_editor_map_location" readonly="true" class="regular-text" value="<?php echo esc_attr( $item->location ); ?>"  />
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
            <tr class="row-global">
                <th scope="row">
                    <label for="global"><?php _e( 'Федеральная акция', 'vbh' ); ?></label>
                </th>
                <td>
                    <b><?php echo $item->global == 1 ? 'Да' : 'Нет' ?></b>
                </td>
            </tr>
            <tr class="row-when">
                <th scope="row">
                    <b><?php _e( 'Дата проведения', 'vbh' ); ?></b>
                </th>
                <td>
                    <?php echo esc_attr( $item->when ); ?>
                </td>
            </tr>
            <tr class="row-when">
                <th scope="row">
                    <b><?php _e( 'Порода дерева', 'vbh' ); ?></b>
                </th>
                <td>
                    <?php echo esc_attr( $type->name ); ?>
                </td>
            </tr>
            <tr class="row-description">
                <th scope="row">
                    <label for="description"><?php _e( 'Описание', 'vbh' ); ?></b>
                </th>
                <td>
                    <?php echo $item->description; ?>
                </td>
            </tr>
        </tbody>
    </table>
</div>
