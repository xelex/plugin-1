<?php
    define( 'SHORTINIT', true );
    require_once dirname( __FILE__ ) . '/../../../wp-load.php';
    require_once dirname( __FILE__ ) . '/includes/map/map-functions.php';
    $filter = $_REQUEST['filter'];
    $filter_id = intval($_REQUEST['filter_id']);
    $callback = $_REQUEST['callback'];
    $area = array_map('floatval', explode(",", $_REQUEST['area']));
    if (count($area) != 4 or strlen($callback) <= 1 or (in_array($filter, array('type', 'action', 'plantator')) AND $filter_id <= 0)) {
        echo 'jsonp_callback({error: "REQUEST DATA ERROR", data: null});';
        exit;
    }

    // Load points
    $points = array();
    switch($filter) {
        case 'approved':
            $points = ac_tree_manager_map_data_approved($area[0], $area[1], $area[2], $area[3]);
            break;
        case 'unapproved':
            $points = ac_tree_manager_map_data_unapproved($area[0], $area[1], $area[2], $area[3]);
            break;
        case 'type':
            $points = ac_tree_manager_map_data_for_type($filter_id, $area[0], $area[1], $area[2], $area[3]);
            break;
        case 'action':
            $points = ac_tree_manager_map_data_for_activity($filter_id, $area[0], $area[1], $area[2], $area[3]);
            break;
        case 'plantator':
            $points = ac_tree_manager_map_data_for_plantator($filter_id);
            break;
        case 'all':
            $points = ac_tree_manager_map_data($area[0], $area[1], $area[2], $area[3]);                
            break;
        default:
            if ($filter_id > 0) {
                $points = ac_tree_manager_map_data_for_tree($filter_id);
            } else {
                $points = ac_tree_manager_map_data_approved($area[0], $area[1], $area[2], $area[3]);
            }
            break;
    }

    function get_icon($item) {
        if ($item->amount <=  0) {
            if (intval($point->icon) == 0) {
                return "/wp-content/plugins/tree-manager/img/icon_0.svg";
            } else {
                return "/wp-content/plugins/tree-manager/img/icon_1.svg";
            }
        }
        return "/wp-content/plugins/tree-manager/img/icon_all.svg";
    }
?>
<?php echo $callback; ?>({
    error: null,
    data: {
        type: 'FeatureCollection',
        features: [
        <?php foreach($points as $point) {?>
            {
                type: 'Feature',
                geometry: {
                    type: 'Point',
                    coordinates: [<?php echo $point->lat; ?>, <?php echo $point->lng; ?>]
                },
                id: <?php echo $point->id ?>,
                properties: {
                    balloonContent: '<?php echo $point->id ?>'
                },
                options: {
                    iconImageHref: '<?php echo get_icon($point); ?>'
                }
            },
        <?php } ?>
        ]
    }
});
