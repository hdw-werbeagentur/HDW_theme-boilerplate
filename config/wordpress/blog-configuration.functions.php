<?php

/*
* Disable comments on wordpress
*/

add_action( 'admin_menu', 'remove_admin_menus' );
add_action( 'wp_before_admin_bar_render', 'remove_toolbar_menus' );
add_action( 'wp_dashboard_setup', 'remove_dashboard_widgets' );

function remove_admin_menus() {
    remove_menu_page( 'edit.php' );
}

function remove_toolbar_menus() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu( 'new-post' );
}

function remove_dashboard_widgets() {
    global $wp_meta_boxes;
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
}