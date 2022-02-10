<?php
/**
** ------------------------------------------------------------------------------
** This code snippet will hide the users list and give 404 as the result
** ------------------------------------------------------------------------------
** Problem description
**
** @see https://ekiwi.de/index.php/1841/wordpress-ist-wp-json-wp-v2-users-eine-sicherheitsluecke-cve-2017-5487/
** @see https://wordpress.stackexchange.com/a/254251
** ------------------------------------------------------------------------------
*/

add_filter( 'rest_endpoints', function( $endpoints ){
    if ( isset( $endpoints['/wp/v2/users'] ) ) {
        unset( $endpoints['/wp/v2/users'] );
    }
    if ( isset( $endpoints['/wp/v2/users/(?P<id>[\d]+)'] ) ) {
        unset( $endpoints['/wp/v2/users/(?P<id>[\d]+)'] );
    }
    return $endpoints;
});