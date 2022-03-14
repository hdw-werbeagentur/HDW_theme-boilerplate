<?php
function color_overwrites_css_inline_css() {
    $colors = [
        // -> Main theme colors
        'color__primary' => 'primary',
        'color__secondary' => 'secondary',
        'color__tertiary' => 'tertiary',
        'color__accent' => 'accent',

        // -> Formatting colors
        'color__site-background' => 'site-background',
        'color__links' => 'links',
        'color__links--hover' => 'links--hover',

        // -> Validation colors
        'color__error' => 'error',
        'color__error--light' => 'error--light',
        'color__error--dark' => 'error--dark',
        'color__error--accent' => 'error--accent',
        'color__warning' => 'warning',
        'color__warning--light' => 'warning--light',
        'color__warning--dark' => 'warning--dark',
        'color__warning--accent' => 'warning--accent',
        'color__success' => 'success',
        'color__success--light' => 'success--light',
        'color__success--dark' => 'success--dark',
        'color__success--accent' => 'success--accent',
        'color__notice' => 'notice',
        'color__notice--light' => 'notice--light',
        'color__notice--dark' => 'notice--dark',
        'color__notice--accent' => 'notice--accent',
    ];

    $color_overwrites_css = "<style>";
    $color_overwrites_css .= "body {". PHP_EOL;

    foreach ($colors as $selector => $color) {
        if( class_exists('ACF') ) {
            $colorValue = get_field('hdw-theme-setting__color-'.$color, 'option');
            if( $colorValue != "" ){
                $color_overwrites_css .= "--".$selector.": ".$colorValue.";". PHP_EOL;
            }
        }
    }

    $color_overwrites_css .= "}";
    $color_overwrites_css .= "</style>";

    echo $color_overwrites_css;
}

add_action( 'wp_footer', 'color_overwrites_css_inline_css', 100 );