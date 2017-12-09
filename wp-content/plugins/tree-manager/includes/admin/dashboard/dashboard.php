<?php
function tree_manager_add_dashboard_widget() {
    wp_add_dashboard_widget(
        'my_dashboard_widget', 
        'Статистика по посадкам', 
        'tree_manager_dashboard_widget'
    );
}

function tree_manager_dashboard_widget() {
    # get saved data
    if( !$widget_options = get_option( 'my_dashboard_widget_options' ) )
        $widget_options = array( );

    $total = ac_get_tree_total();
    $unapproved = ac_get_tree_total_unapproved();
    $denied = ac_get_tree_total_denied();
    $approved = $total - $unapproved - $denied;

    $page_url = menu_page_url( 'tree-manager-trees', false );

    # default output
    $output = sprintf(
        '<table id="dashboard_item" colspan=0 rowspan=0 cellpadding=0 cellspacing=0>'.
        '<tr><th style="width: 200px; text-align: right;">'.
            '%s:</th><td></td><td>'.
            '<a href="%s">%d</a></td></tr>'.
        '<tr><th style="width: 200px; text-align: right;">'.
            '%s:</th><td></td><td>'.
            '<a href="%s">%d</a></td></tr>'.
        '<tr><th style="width: 200px; text-align: right;">'.
            '%s:</th><td></td><td>'.
            '<a href="%s">%d</a></td></tr>'.
        '<tr><th style="border-top: 1px solid black; width: 200px; text-align: right;">'.
            '%s:</th><td style="width: 15px; border-top: 1px solid black;"></td><td style="border-top: 1px solid black;">'.
            '<a href="%s">%d</a></td></tr>'.
        '</table>',
        __( 'Посадок на карте' ),
        add_query_arg(array(filter => 'approved'), $page_url),
        $approved,
        __( 'Нуждается в проверке' ),
        add_query_arg(array(filter => 'unapproved'), $page_url),
        $unapproed,
        __( 'Отклонено' ),
        add_query_arg(array(filter => 'denied'), $page_url),
        $denied,
        __( 'Всего записей в БД' ),
        $page_url,
        $total
    );
    echo "<div class='feature_post_class_wrap'>
        <label style='background:#ccc;'>$output</label>
    </div>
    ";
}

function tree_manager_add_dashboard_bar( $wp_admin_bar ){
    $wp_admin_bar->add_menu(array(
        'href' => menu_page_url( 'tree-manager', false ), 
        'title' => 'Акцию', 
        'parent' => 'new-content'
    ));

    $wp_admin_bar->add_menu(array(
        'href' => menu_page_url( 'tree-manager-trees', false ), 
        'title' => 'Дерево', 
        'parent' => 'new-content'
    ));
}