<?php
/********************************/
// Enable development subpage for theme options
/********************************/


if( function_exists('acf_add_options_page') ) {

    acf_add_options_sub_page(array(
        'page_title' 	=> __('Development Settings', 'TEXTDOMAIN'),
        'menu_title'	=> __('Development', 'TEXTDOMAIN'),
        'parent_slug'	=> 'hdw-theme-settings',
    ));

    /********************************/
    // Save and load plugin specific ACF field groups via the /acf-json folder.
    /********************************/

    // Save
    function theme_settings_development_acf_json_saving($group) {
        // list of field groups that should be saved to my-plugin/acf-json
        $groups = array('group_61059de46f50e');

        if (in_array($group['key'], $groups)) {
            add_filter('acf/settings/save_json', function() {
                return dirname(__FILE__) . '/acf-json';
            });
        }
    }

    add_action('acf/update_field_group', 'theme_settings_development_acf_json_saving', 1, 1);

}

/********************************/
// Adding environment class to body
/********************************/
function theme_environment_body_class( $classes ) {
    $classes[] = 'environment-'.WP_ENV;
    return $classes;
}
add_filter( 'body_class','theme_environment_body_class' );