<?php
$setGridOverlay = false;
$gridOverlaySetting = false;

if( class_exists('ACF') ) {
    $gridOverlaySetting = (get_field('hdw-theme-developer-setting__grid-overlay', 'option') ? get_field('hdw-theme-developer-setting__grid-overlay', 'option') : 'false');
}

if( $gridOverlaySetting == "true" ){
    $setGridOverlay = true;
}

if( isset($_GET["grid-overlay"]) && getBoolFromString( $_GET["grid-overlay"] ) ){
    $setGridOverlay = true;
}

if( $gridOverlaySetting == "dev" && WP_ENV == "local" ){
    $setGridOverlay = true;
}

function enable_grid_overlay_body_class( $classes ) {
    $classes[] = 'enable-grid-overlay';
    return $classes;
}

function grid_overlay_css()
{
 echo "
    <style>
        body.enable-grid-overlay{
            position: relative;
            --grid__overlay--repeating-width: calc(100% / var(--grid__columns));
            --grid__overlay--column-width: calc((100% / var(--grid__columns)) - var(--grid__gap));
            --grid__overlay--background-width: calc(100% + var(--grid__gap));
            --grid__overlay--background-columns: repeating-linear-gradient(
                to right,
                var(--grid__overlay--color),
                var(--grid__overlay--color) var(--grid__overlay--column-width),
                transparent var(--grid__overlay--column-width),
                transparent var(--grid__overlay--repeating-width)
            );
        }

        body.enable-grid-overlay::before{
            position: absolute;
            top: 0; right: var(--container-padding); bottom: 0; left: var(--container-padding);
            margin-right: auto;
            margin-left: auto;
            max-width: var(--content-width);
            min-height: 100vh;
            content: '';
            background-image: var(--grid__overlay--background-columns);
            background-size: var(--grid__overlay--background-width) 100%;
            background-position: 0 var(--baseline-shift);
            z-index: 1000;
            pointer-events: none;
            opacity: 0.125;
        }
    </style>
 ";
}

if($setGridOverlay){
    if(isset($_GET["grid-overlay"]) && ($_GET["grid-overlay"] == "false")){
        return;
    }

    add_filter( 'body_class','enable_grid_overlay_body_class' );
    add_action( 'wp_footer', 'grid_overlay_css', 100 );
}

