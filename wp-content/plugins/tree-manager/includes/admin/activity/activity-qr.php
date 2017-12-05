<?php
$item = ac_get_activity( $id );

$enc = encode_qr_url($id, 1);

$page_url = menu_page_url( 'tree-manager', false );
$qr_gen_url = add_query_arg( array( 'action' => 'qrgen', 'preview' => 1, 'id' => $id, 'seed' => time() ), $page_url );
?>
<script type="text/javascript">
    var qr_canvas, qr_image = new Image;
    
    jQuery(document).ready(function() {
        var PIXEL_RATIO = (function () {
            var ctx = document.getElementById("qr_preview").getContext("2d"),
                dpr = window.devicePixelRatio || 1,
                bsr = ctx.webkitBackingStorePixelRatio ||
                    ctx.mozBackingStorePixelRatio ||
                    ctx.msBackingStorePixelRatio ||
                    ctx.oBackingStorePixelRatio ||
                    ctx.backingStorePixelRatio || 1;

            return dpr / bsr;
        })();

        qr_canvas = document.getElementById("qr_preview");

        var w = 400, h = 400;
        qr_canvas.width = w * PIXEL_RATIO;
        qr_canvas.height = h * PIXEL_RATIO;
        qr_canvas.style.width = w + "px";
        qr_canvas.style.height = h + "px";
        qr_canvas.getContext("2d").setTransform(PIXEL_RATIO, 0, 0, PIXEL_RATIO, 0, 0);

        qr_image.onload = function() {
            var ctx = qr_canvas.getContext("2d");
            ctx.clearRect(0, 0, qr_canvas.width, qr_canvas.height);
            ctx.drawImage(qr_image, 0, 0, 400, 400);
            ctx.tillText()
        }

        qr_image.src = "<?php echo $qr_gen_url; ?>";
        console.log(qr_image.src);
    });

</script>
<div class="wrap">
    <h1><?php _e( 'Генерация QR-кода', 'vbh' ); ?></h1>
    <form action="" method="">
        <table class="form-table">
            <tbody>
                <tr class="row-id">
                    <th scope="row">
                        <b><?php _e( 'Идентификатор', 'vbh' ); ?></b>
                    </th>
                    <td>
                        <?php echo esc_attr( $item->id ); ?>
                    </td>
                </tr>
                <tr class="row-name">
                    <th scope="row">
                        <b><?php _e( 'Название', 'vbh' ); ?></b>
                    </th>
                    <td>
                        <?php echo esc_attr( $item->name ); ?>
                    </td>
                </tr>
                <tr class="row-url">
                    <th scope="row">
                        <b><?php _e( 'URL', 'vbh' ); ?></b>
                    </th>
                    <td>
                        <?php echo $enc; ?>
                    </td>
                </tr>
                <tr class="row-view">
                    <th scope="row">
                        <b><?php _e( 'Предпросмотр', 'vbh' ); ?></b>
                    </th>
                    <td>
                        <canvas id="qr_preview" style="width: 400px; height: 400px; background: yellow;"></canvas>
                    </td>
                </tr>
                <tr class="row-count">
                    <th scope="row">
                        <b><?php _e( 'Количество', 'vbh' ); ?></b>
                    </th>
                    <td>
                        <input id="count" type="number" class="regular-text" value="1" />
                    </td>
                </tr>
            </tbody>
        </table>
        <?php submit_button( __( 'Генерировать', 'vbh' ), 'primary', 'qr_generate' ); ?>
    </form>
</div>