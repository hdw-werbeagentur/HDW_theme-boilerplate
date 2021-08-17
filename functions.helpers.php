<?php
/**
** ------------------------------------------------------------------------------
** Register and synchronize acf fields
** ------------------------------------------------------------------------------
**/

$register_acf_fields_source_directories = [
    '/resources/modules/**/acf-json/',
    '/config/theme/acf-json/',
    '/config/custom-post-types/acf-json/'
];

foreach ($register_acf_fields_source_directories as $register_acf_fields_source_directory) {
    foreach (glob(get_template_directory() . $register_acf_fields_source_directory . '*.json') as $filename) {
        // Load - includes the /acf-json folder in this plugin to the places to look for ACF Local JSON files
        add_filter('acf/settings/load_json', function($paths) use ( $filename ){
            $paths[] = pathinfo($filename)['dirname'];
            return $paths;
        }, 20);
    }
}

/**
** ------------------------------------------------------------------------------
** Helper functions
** ------------------------------------------------------------------------------
*/

// Allow svg image to be inline svg
function inlineSvg(int $attachmentId): string
{
    $type = get_post_mime_type($attachmentId);
    if ( 'image/svg+xml' != $type )
        return '';

    return file_get_contents(get_attached_file($attachmentId));
}

// Return boolean from "true" or "false" string
function getBoolFromString($test_var){
    $test_var = strtolower(trim($test_var)) == 'false' ? FALSE : $test_var;
    return (boolean) $test_var;
}


/**
** ------------------------------------------------------------------------------
** Get value from css custom properties
** ------------------------------------------------------------------------------
**/
function getCssCustomProp($prop){
    $lines_array = file(get_template_directory() . "/resources/scss/0-settings/_custom-properties.scss");
    foreach($lines_array as $line) {
        if(strpos($line, '--'.$prop.': #') !== false) {
            list(, $new_str) = explode(":", $line);
            // If you don't want the space before the word bong, uncomment the following line.
            //$new_str = trim($new_str);
        }
    }

    return str_replace(';', '', $new_str);
}

/**
** ------------------------------------------------------------------------------
** Shows debug information if debugging is active
** @param string $var
** @param mixed $val
**
** Will display content of an variable.
** Even objects and arrays would be displayed
** ------------------------------------------------------------------------------
**/
function themeDebug($var, $val){
    if( class_exists('ACF') ) {
        $debugEnabled = (get_field('hdw-theme-developer-setting__debug-info', 'option') ? get_field('hdw-theme-developer-setting__debug-info', 'option') : 'false');
    }
    else{
        $debugEnabled = 'false';
    }

    if( isset($_GET["debug"]) && getBoolFromString( $_GET["debug"] ) ){
        $debugEnabled = "true";
    }

    if( getBoolFromString($debugEnabled) ){
        echo '
            <div class="container">
                <div class="wp-block-columns are-vertically-aligned-top validation-message has-blue-color has-light-blue-background-color has-text-color has-background">
                    <div class="wp-block-column is-vertically-aligned-top validation-message__icon has-light-blue-color has-blue-background-color has-text-color has-background" style="flex-basis:3.25rem">
                        <p class="has-text-align-center">🚀</p>
                    </div>
                    <div class="wp-block-column is-vertically-aligned-top" style="flex-basis:66.66%">
                        Content of the variable <strong>'.$var.'</strong> ('.gettype($val).'):
                        <hr class="has-blue-background-color has-background" style="border: 0; height: 0.0625rem; margin: .5rem 0; width: 12.5rem">
        ';
                        if( is_array($val) || is_object($val) ){
                            if(is_countable($val)){
                                echo 'Size of '.$var.' is '.sizeof($val).'<br />';
                            }
                            echo '<pre>';
                            print_r($val);
                            echo '</pre>';
                        }
                        else{
                            echo $val;
                        }
        echo '
                    </div>
                </div>
            </div>
        ';
    }
}