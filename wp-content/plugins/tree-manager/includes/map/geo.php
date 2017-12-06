<script type="text/javascript">
    var geo_map, geo_point;

    ymaps.ready(function(){
        jQuery('#map').html('');
        var coords = initialAddress();
        
        if (coords) {
            geo_map = new ymaps.Map("map", {
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
        }

    });
</script>
<?php
function geo_container() {
    return '<div id="map">Карта загружается...</div>';
}