<?php
/********************************/
// Adding debug class to body
/********************************/

$debugEnabled = false;

function enable_theme_debug_body_class( $classes ) {
    $classes[] = 'enable-debug';
    return $classes;
}

if( class_exists('ACF') ) {
    $debugOption = (get_field('hdw-theme-developer-setting__debug-info', 'option') ? get_field('hdw-theme-developer-setting__debug-info', 'option') : false);
}
else{
    $debugOption = false;
}

if($debugOption == "true"){
    $debugEnabled = true;
}

if( $debugOption == "dev" &&  WP_ENV == "local"  ){
    $debugEnabled = true;
}

if( isset($_GET["debug"]) && $_GET["debug"] == "true" ){
    $debugEnabled = true;
}

if($debugEnabled){
    add_filter( 'body_class','enable_theme_debug_body_class' );
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
    global $debugEnabled;

    if(isset($_GET["debug"]) && ($_GET["debug"] == "false")){
        return;
    }

    if( $debugEnabled ){
        echo '
            <div class="container" style="margin: 1.25rem 0;">
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
