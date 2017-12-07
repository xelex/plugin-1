<?php
    $geo_url = url_simplify(plugin_dir_url( __FILE__).'/../../map.php?filter='.$filter.'&filter_id='.$filter_id.'&area=%b');
    $icon_cluster = ag_get_type_icon();
?>
<script type="text/javascript">
    var geo_map;
    var gl;
    ymaps.ready(function(){
        jQuery('#yandex_map').html('');        
        geo_map = new ymaps.Map("yandex_map", {
            center: [55.76, 37.64],
            zoom: 9,
            type: 'yandex#map',
            controls: []
        }, {
            searchControlProvider: 'yandex#search'
        });

        var zoomControl = new ymaps.control.ZoomControl({
            options: {
                layout: 'round#zoomLayout',
                position: {
                    right: 10,
                    bottom: 100
                }
            }
        });

        var geolocationControl = new ymaps.control.GeolocationControl({
            options: {
                layout: 'round#buttonLayout',
                position: {
                    right: 10,
                    top: 10
                }
             }
        });

        geo_map.controls.add(zoomControl);
        geo_map.controls.add(geolocationControl);

        var objectManager = new ymaps.LoadingObjectManager('<?php echo $geo_url; ?>', {
            clusterize: true,
            clusterHasBaloon: false,
            clusterNumbers: [10, 100, 1000],
            clusterIcons: [{
                    href: '<?php echo $icon_cluster; ?>',
                    size: [42, 42],
                    offset: [-21, -21]
                }, {
                    href: '<?php echo $icon_cluster; ?>',
                    size: [54, 54],
                    offset: [-27, -27]
                }, {
                    href: '<?php echo $icon_cluster; ?>',
                    size: [66, 66],
                    offset: [-33, -33]
                }
            ]
        });
        objectManager.objects.options.set( {
            iconLayout: 'default#image',
            iconImageSize: [42, 42],
            iconImageOffset: [-21, -21]
        });

        geo_map.geoObjects.add(objectManager);        
    });
</script>
<?php
function geo_container() {
    return '<div id="yandex_map">Карта загружается...</div>';
}