<?php

/*
* Enable SMTP mailing via external smtp server
*/

add_action( 'phpmailer_init', 'send_smtp_email' );

function send_smtp_email( $phpmailer ) {
    $phpmailer->isSMTP();
    $phpmailer->Host       = WP_SMTP_HOST;
    $phpmailer->SMTPAuth   = WP_SMTP_AUTH;
    $phpmailer->Port       = WP_SMTP_PORT;
    $phpmailer->Username   = WP_SMTP_USERNAME;
    $phpmailer->Password   = WP_SMTP_PASSWORD;
    $phpmailer->SMTPSecure = WP_SMTP_PROTOCOL;
    $phpmailer->From       = WP_SMTP_FORCEFROM;
    $phpmailer->FromName   = WP_SMTP_FORCEFROMNAME; 
} 