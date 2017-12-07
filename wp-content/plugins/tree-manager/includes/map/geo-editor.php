<script type="text/javascript">
    var geo_map, geo_point;

    ymaps.ready(function(){
        jQuery('#geo_editor_map').html('');
        var coords = initialAddress();
        
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
        if (coords) {
            geo_point = createPlacemark(coords);
            geo_map.geoObjects.add(geo_point);
            geo_point.events.add('dragend', function () {
                getAddress(geo_point.geometry.getCoordinates());
            });
            getAddress(coords);
        }
        
        geo_map.events.add('click', function (e) {
            var coords = e.get('coords');

            if (geo_point) {
                geo_point.geometry.setCoordinates(coords);
            } else {
                geo_point = createPlacemark(coords);
                geo_map.geoObjects.add(geo_point);
                geo_point.events.add('dragend', function () {
                    getAddress(geo_point.geometry.getCoordinates());
                });
            }
            getAddress(coords);
        });

        function createPlacemark(coords) {
            return new ymaps.Placemark(coords, {
                iconCaption: 'Поиск...'
            }, {
                preset: 'islands#violetDotIconWithCaption',
                draggable: true
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

        function getAddress(coords) {
            jQuery("#geo_editor_map_lat").val(coords[0]);
            jQuery("#geo_editor_map_lng").val(coords[1]);
            geo_point.properties.set('iconCaption', 'поиск...');
            ymaps.geocode(coords).then(function (res) {
                var firstGeoObject = res.geoObjects.get(0);

                if (firstGeoObject.getAddressLine().length > 0) {
                    jQuery('#geo_editor_map_location').val(firstGeoObject.getAddressLine());
                }

                geo_point.properties
                    .set({
                        iconCaption: [
                            firstGeoObject.getLocalities().length ? firstGeoObject.getLocalities() : firstGeoObject.getAdministrativeAreas(),
                            firstGeoObject.getThoroughfare() || firstGeoObject.getPremise()
                        ].filter(Boolean).join(', ')
                    });
            });
        }
    });
</script>
<?php
function geo_container() {
    return '<div id="geo_editor_map">Карта загружается...</div>';
}