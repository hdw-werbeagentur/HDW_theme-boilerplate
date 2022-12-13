<?php
//Disable automatic p tags for Contact Form 7
if(has_action('wpcf7_init')) {
    add_filter('wpcf7_autop_or_not', '__return_false');
}
