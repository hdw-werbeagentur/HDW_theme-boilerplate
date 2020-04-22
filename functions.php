<?php

/*
* Theme functions
*/

if ((defined('WP_SMTP_HOST') && WP_SMTP_HOST != "localhost") && WP_SMTP_USERNAME && WP_SMTP_PASSWORD){ 
    // Enable SMTP mailing via external smtp server
	include get_template_directory() . '/config/wordpress/mail-configuration.functions.php';
}

if ( defined('WP_COMMENTS') && WP_COMMENTS == false ){ 
    // Disable wordpress comment to avoid spam
	include get_template_directory() . '/config/wordpress/comments-configuration.functions.php';
}