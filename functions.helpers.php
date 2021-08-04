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