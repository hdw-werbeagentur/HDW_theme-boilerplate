<?php

/*
* Theme functions
*/

if ((defined('WP_SMTP_HOST') && WP_SMTP_HOST != "localhost") && WP_SMTP_USERNAME && WP_SMTP_PASSWORD){ 
    // Enable SMTP mailing via external smtp server
	include get_template_directory() . '/config/wordpress/mail-configuration.functions.php';
}