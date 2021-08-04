<?php
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