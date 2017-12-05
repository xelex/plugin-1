<div class="wrap">
    <h1><?php _e( 'Новый учасник', 'vbh' ); ?></h1>

    <form action="" method="post">
        <table class="form-table">
            <tbody>
                                        <tr class="row-name">
                            <th scope="row">
                                <label for="name"><?php _e( 'Name', 'vbh' ); ?></label>
                            </th>
                            <td>
                                <input type="text" name="name" id="name" class="regular-text" value="" required="required" />
                            </td>
                        </tr>                        <tr class="row-when">
                            <th scope="row">
                                <label for="when"><?php _e( 'When', 'vbh' ); ?></label>
                            </th>
                            <td>
                                <input type="text" name="when" id="when" class="regular-text" value="" required="required" />
                            </td>
                        </tr>                        <tr class="row-fb">
                            <th scope="row">
                                <label for="fb"><?php _e( 'Fb', 'vbh' ); ?></label>
                            </th>
                            <td>
                                <input type="text" name="fb" id="fb" class="regular-text" value=""  />
                            </td>
                        </tr>                        <tr class="row-vk">
                            <th scope="row">
                                <label for="vk"><?php _e( 'Vk', 'vbh' ); ?></label>
                            </th>
                            <td>
                                <input type="text" name="vk" id="vk" class="regular-text" value=""  />
                            </td>
                        </tr>                        <tr class="row-tw">
                            <th scope="row">
                                <label for="tw"><?php _e( 'Tw', 'vbh' ); ?></label>
                            </th>
                            <td>
                                <input type="text" name="tw" id="tw" class="regular-text" value=""  />
                            </td>
                        </tr>                        <tr class="row-ig">
                            <th scope="row">
                                <label for="ig"><?php _e( 'Ig', 'vbh' ); ?></label>
                            </th>
                            <td>
                                <input type="text" name="ig" id="ig" class="regular-text" value=""  />
                            </td>
                        </tr>                        <tr class="row-email">
                            <th scope="row">
                                <label for="email"><?php _e( 'Email', 'vbh' ); ?></label>
                            </th>
                            <td>
                                <input type="text" name="email" id="email" class="regular-text" value=""  />
                            </td>
                        </tr>                        <tr class="row-phone">
                            <th scope="row">
                                <label for="phone"><?php _e( 'Phone', 'vbh' ); ?></label>
                            </th>
                            <td>
                                <input type="text" name="phone" id="phone" class="regular-text" value=""  />
                            </td>
                        </tr>                        <tr class="row-description">
                            <th scope="row">
                                <label for="description"><?php _e( 'Description', 'vbh' ); ?></label>
                            </th>
                            <td>
                                <textarea name="description" id="description"  rows="5" cols="30" ></textarea>
                            </td>
                        </tr>
            </tbody>
        </table>

        <input type="hidden" name="field_id" value="0">

        <?php wp_nonce_field( 'ac_new_plantator' ); ?>
        <?php submit_button( __( 'Создать Plantator', 'vbh' ), 'primary', 'submit_plantator' ); ?>
    </form>
</div>