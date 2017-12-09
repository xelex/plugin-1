<?php
    $geo_url = url_simplify(plugin_dir_url( __FILE__).'/../../map.php?filter='.$filter.'&filter_id='.$filter_id.'&area=%b');
?>
<script type="text/javascript">
    var icons = {
        '0': '<?php echo ag_get_type_icon(0) ?>',
        '1': '<?php echo ag_get_type_icon(1) ?>',
        '10': '<?php echo ag_get_type_icon(10) ?>',
        '11': '<?php echo ag_get_type_icon(11) ?>',
        '00': '<?php echo ag_get_type_icon("00") ?>',
        'cluster': '<?php echo ag_get_type_icon() ?>',
    };

    var geo_map;
    var gl;
    ymaps.ready(function(){
        jQuery('#yandex_map').html('');        
        geo_map = new ymaps.Map("yandex_map", {
            center: [55.00, 56.00],
            zoom: 5,
            type: 'yandex#map',
            controls: []
        }, {
            searchControlProvider: 'yandex#search'
        });

        var typeSelector = new ymaps.control.TypeSelector({
            options: {
                layout: 'round#listBoxLayout',
                itemLayout: 'round#listBoxItemLayout',
                itemSelectableLayout: 'round#listBoxItemSelectableLayout',
                float: 'none',
                position: {
                    bottom: '40px',
                    left: '10px'
                }
            }
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
        geo_map.controls.add(typeSelector);

        var objectManager = new ymaps.LoadingObjectManager('<?php echo $geo_url; ?>', {
            clusterize: true,
            clusterHasBaloon: false,
            clusterNumbers: [10, 100, 1000],
            clusterIcons: [{
                    href: icons['cluster'],
                    size: [42, 42],
                    offset: [-21, -21]
                }, {
                    href: icons['cluster'],
                    size: [54, 54],
                    offset: [-27, -27]
                }, {
                    href: icons['cluster'],
                    size: [66, 66],
                    offset: [-33, -33]
                }]
        });
        
        objectManager.objects.options.set({
            iconLayout: 'default#image',
            hideIconOnBalloonOpen: false
        });

        objectManager.objects.events.add('click', function (e) {
            var id = e.get('objectId');
            var obj = objectManager.objects.getById(id);

            jQuery.get('/?page_id=41&id='+id, function(data) {
                obj.properties.balloonContent = data;
                objectManager.objects.balloon.open(id);
            });
        });  

        geo_map.geoObjects.add(objectManager);
    });

    function customScale(name, size) {
        if (size === undefined || size <= 10) {
            return {
                iconImageHref: icons[name],
                iconImageSize: [42, 42],
                iconImageOffset: [-21, -21]
            };
        }
        if (size <= 100) {
            return {
                iconImageHref: icons[name],
                iconImageSize: [56, 56],
                iconImageOffset: [-28, -28]
            };
        }
        return {
            iconImageHref: icons[name],
            iconImageSize: [66, 66],
            iconImageOffset: [-33, -33]
        };
    }

    function customPreprocessor(raw) {
        if (raw.error != null) {
            return raw;
        }

        raw.data.features = jQuery.map(raw.data.f, function(r) {
            return {
                type: 'Feature',
                geometry: {
                    type: 'Point',
                    coordinates: r.c
                },
                id: r.i,
                options: customScale((r.a > 0 ? '1' : '') + (r.t == 0 ? '0': '1'), r.a)
            }
        });
        delete raw.data.f;
        return raw;
    }

    function loadBalloonData(id) {

    }
</script>
<?php
function geo_container() {
    return '<div id="yandex_map">Карта загружается...</div>';
}