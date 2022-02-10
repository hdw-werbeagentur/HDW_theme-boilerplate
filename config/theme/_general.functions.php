<?php

if( function_exists('acf_add_options_page') ) {

    acf_add_options_page(array(
        'page_title' 	=> __('Theme General Settings', 'TEXTDOMAIN'),
        'menu_title'	=> __('Theme Settings', 'TEXTDOMAIN'),
        'menu_slug' 	=> 'hdw-theme-settings',
        'capability'	=> 'edit_posts',
        'position'      => '99.0',
        'icon_url'      => '',
        'redirect'		=> false
    ));

    /********************************/
    // Save and load plugin specific ACF field groups via the /acf-json folder.
    /********************************/

    // Save
    function theme_settings_acf_json_saving($group) {
        // list of field groups that should be saved to my-plugin/acf-json
        $groups = array('group_610b72a9387b6');

        if (in_array($group['key'], $groups)) {
            add_filter('acf/settings/save_json', function() {
                return dirname(__FILE__) . '/acf-json';
            });
        }
    }

    add_action('acf/update_field_group', 'theme_settings_acf_json_saving', 1, 1);

    function add_theme_options_page_stylings() {
       echo '
            <style>
                body.wp-admin #adminmenu #toplevel_page_hdw-theme-settings .wp-menu-image::before{
                    content: url("data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4KPCEtLSBHZW5lcmF0b3I6IEFkb2JlIElsbHVzdHJhdG9yIDI1LjQuMCwgU1ZHIEV4cG9ydCBQbHVnLUluIC4gU1ZHIFZlcnNpb246IDYuMDAgQnVpbGQgMCkgIC0tPgo8c3ZnIHZlcnNpb249IjEuMSIgaWQ9IkViZW5lXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4IgoJIHZpZXdCb3g9IjAgMCAxNiAxNiIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgMTYgMTY7IiB4bWw6c3BhY2U9InByZXNlcnZlIj4KPHN0eWxlIHR5cGU9InRleHQvY3NzIj4KCS5zdDB7ZmlsbDojRkZGRkZGO30KPC9zdHlsZT4KPGc+Cgk8cGF0aCBjbGFzcz0ic3QwIiBkPSJNOCwwQzMuNiwwLDAsMy42LDAsOGMwLDQuNCwzLjYsOCw4LDhjNC40LDAsOC0zLjYsOC04QzE2LDMuNiwxMi40LDAsOCwweiBNNSwxMy4zYy0wLjUsMC0wLjktMC40LTAuOS0wLjkKCQljMC0wLjUsMC40LTAuOSwwLjktMC45YzAuNSwwLDAuOSwwLjQsMC45LDAuOUM1LjgsMTIuOSw1LjQsMTMuMyw1LDEzLjN6IE01LjEsMTAuNWMwLDAuMS0wLjEsMC4xLTAuMiwwLjFjLTAuMSwwLTAuMiwwLTAuMi0wLjEKCQljMCwwLTEuMi02LjQtMS4yLTYuOGMwLTAuNywwLjYtMS4zLDEuMy0xLjNTNi4yLDMsNi4yLDMuN0M2LjIsNC4xLDUuMSwxMC41LDUuMSwxMC41eiBNOCwxMy4zYy0wLjUsMC0wLjktMC40LTAuOS0wLjkKCQljMC0wLjUsMC40LTAuOSwwLjktMC45czAuOSwwLjQsMC45LDAuOUM4LjksMTIuOSw4LjUsMTMuMyw4LDEzLjN6IE04LjksOS43YzAsMCwwLDAuMSwwLDAuMWMwLDAuNS0wLjQsMC45LTAuOSwwLjkKCQlzLTAuOS0wLjQtMC45LTAuOWMwLDAsMC0wLjEsMC0wLjFWMy40YzAtMC41LDAuNC0xLDAuOS0xYzAuNSwwLDAuOSwwLjUsMC45LDFWOS43eiBNMTIsMTMuMmgtMS43di0xLjZIMTJWMTMuMnogTTEyLDEwLjVoLTEuN1YyLjUKCQlIMTJWMTAuNXoiLz4KPC9nPgo8L3N2Zz4K");
                }

                .acf-field-message .acf-label{
                    margin-top: 20px;
                    font-size: 20px;
                    line-height: 1.2;
                }

                .acf-field-message .acf-input p:last-child{
                    margin-bottom: 0;
                }

                span.color-preview{
                    display: inline-block;
                    height: 20px;
                    width: 20px;
                    margin: 0 2px;
                    border: 1px solid #f0f0f0;
                    position: relative;
                    top: 6px;
                }
            </style>
        ';
    }

    add_action('admin_head', 'add_theme_options_page_stylings');
}