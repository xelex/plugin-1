<script type="text/javascript">
    var geo_map, geo_point;

    ymaps.ready(function(){
        jQuery('#geo_editor_map').html('');
        var coords = initialAddress();
        
        if (coords) {
            geo_map = new ymaps.Map("geo_editor_map", {
                center: coords ? coords : [55.76, 37.64],
                zoom: 9,
                type: 'yandex#map',
                controls: [] //'geolocationControl', 'zoomControl']
            }, {
                searchControlProvider: 'yandex#search'
            });

            var zoomControl = new ymaps.control.ZoomControl({
                options: {
                    layout: 'round#zoomLayout'
                }
            });        
            geo_map.controls.add(zoomControl);

            var geolocationControl = new ymaps.control.GeolocationControl({
                options: {
                    layout: 'round#buttonLayout'
                }
            });
            geo_map.controls.add(geolocationControl);

            var searchControl = new ymaps.control.SearchControl({
                options: {
                    float: 'right',
                    floatIndex: 100,
                    noPlacemark: true
                }
            });
            geo_map.controls.add(searchControl);

            // Initial state
            geo_point = createPlacemark(coords);
            geo_map.geoObjects.add(geo_point);
        }

        function createPlacemark(coords) {
            return new ymaps.Placemark(coords, {}, {
                preset: 'islands#violetDotIconWithCaption',
                draggable: false
            }); 
        }

        function initialAddress() {
            var lat = jQuery("#geo_editor_map_lat").val();
            var lng = jQuery("#geo_editor_map_lng").val();
            if (lat && lng && lat.length > 0 && lng.length > 0) {
                return [parseFloat(lat), parseFloat(lng)];
            } else {
                return false;
            }
        }
    });
</script>
<?php
function geo_container() {
    return '<div id="geo_editor_map">Карта загружается...</div>';
}