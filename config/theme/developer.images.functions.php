<?php

function theme_svg ( $svg_mime ){
    $svg_mime['svg'] = 'image/svg+xml';
    return $svg_mime;
}

add_filter( 'upload_mimes', 'theme_svg' );

function theme_ignore_upload_ext($checked, $file, $filename, $mimes){

    if(!$checked['type']){
    $wp_filetype = wp_check_filetype( $filename, $mimes );
    $ext = $wp_filetype['ext'];
    $type = $wp_filetype['type'];
    $proper_filename = $filename;

    if($type && 0 === strpos($type, 'image/') && $ext !== 'svg'){
    $ext = $type = false;
    }

    $checked = compact('ext','type','proper_filename');
    }

    return $checked;
   }

   add_filter('wp_check_filetype_and_ext', 'theme_ignore_upload_ext', 10, 4);