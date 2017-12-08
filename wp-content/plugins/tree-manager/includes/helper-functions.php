<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

function ag_get_type_icon( $icon_id = -1 ) {
    $result = $tmp.'all_30.png';

    $tmp = plugin_dir_url( __FILE__).'/../img/';
    if ($icon_id == 0 or $icon_id == 1) {
        $result = $tmp.'icon_'.$icon_id.'.svg';
    } else {
        $result = $tmp.'cluster.svg';
    }

    return url_simplify($result);
}

function url_simplify($path) {
    $prefix = '';
    if (strpos($path, 'http://') !== false) {
        $prefix = 'http://';
        $path = str_replace($prefix, '', $path);
    }
    if (strpos($path, 'https://') !== false) {
        $prefix = 'https://';
        $path = str_replace($prefix, '', $path);
    }

    $r = array();
    foreach(explode('/', $path) as $p) {
        if($p == '..') {
            array_pop($r);
        } else if($p != '.' && strlen($p)) {
            $r[] = $p;
        }
    }
    $r = implode('/', $r);
    if($path[0] == '/') {
        $r = "/$r";
    }
    return $prefix.$r;
}

function encode_qr_url($id, $num) {
    //TODO: make it configurable
   $LINK_PREFIX = 'http://япосадилдерево.рф/reg';
    //$LINK_PREFIX = 'http://япд.рф/';
    $suffix = base_convert($id, 10, 36).'-'.base_convert($num, 10, 36);
    return $LINK_PREFIX.'?'.$suffix;
}

function ac_types_selector($selected = false) {
    $result = "<option value=\"\"></option>";
    $args = [
        'number'  => -1,
        'offset'  => 0,
        'orderby' => 'icon',
        'hoos'    => false,
        's'       => $s
    ];

    $types = ac_get_types($args);
    
    $result = $result."<optgroup label=\"Лиственные\">";
    foreach($types as $tmp) {
        if ($tmp->icon == '0') {
            if ($selected === $tmp->id) {
                $result = $result."<option value=\"".$tmp->id."\" selected=1>".$tmp->name."</option>";
            } else {
                $result = $result."<option value=\"".$tmp->id."\">".$tmp->name."</option>";
            }
        }
    }
    $result = $result."</optgroup>";
    $result = $result."<optgroup label=\"Хвойные\">";
    foreach($types as $tmp) {
        if ($tmp->icon == '1') {
            if ($selected === $tmp->id) {
                $result = $result."<option value=\"".$tmp->id."\" selected=1>".$tmp->name."</option>";
            } else {
                $result = $result."<option value=\"".$tmp->id."\">".$tmp->name."</option>";
            }
        }
    }
    $result = $result."</optgroup>";
    return $result;
}

function ac_activities_selector($selected = false) {
    $args = [
        'number'  => -1,
        'offset'  => 0,
        'orderby' => 'icon',
        'hooks'    => false,
        's'       => $s
    ];

    $act = ac_get_activities_map($args);
    
    $result = "<optgroup label=\"Федеральные\">";
    foreach($act as $tmp) {
        if ($tmp->global > 0) {
            if ($selected === $tmp->id) {
                $result = $result."<option value=\"".$tmp->id."\" selected=1>".$tmp->name."</option>";
            } else {
                $result = $result."<option value=\"".$tmp->id."\">".$tmp->name."</option>";
            }
        }
    }
    $result = $result."</optgroup>";
    $result = $result."<optgroup label=\"Региональные\">";
    foreach($act as $tmp) {
        if ($tmp->global == 0) {
            if ($selected === $tmp->id) {
                $result = $result."<option value=\"".$tmp->id."\" selected=1>".$tmp->name."</option>";
            } else {
                $result = $result."<option value=\"".$tmp->id."\">".$tmp->name."</option>";
            }
        }
    }
    $result = $result."</optgroup>";
    return $result;
}
