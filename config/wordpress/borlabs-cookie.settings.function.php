<?php
use BorlabsCookie\Cookie\Config;

if ( is_admin() && is_plugin_active( 'borlabs-cookie/borlabs-cookie.php' ) ) {

    $borlabsCookie = new Config();
    $borlabsCookieConfig = $borlabsCookie->getConfig();

    if ( defined('WP_ENV') && WP_ENV == 'production' ){
        $borlabsCookieConfig['testEnvironment'] = 0;
    }
    else{
        $borlabsCookieConfig['testEnvironment'] = 1;
    }

    $borlabsCookie->saveConfig($borlabsCookieConfig);
}

