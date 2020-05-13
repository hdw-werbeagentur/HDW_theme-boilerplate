<?php

// Add media provider as source
// order should be alphabetically
$mediaCreditsSources = array(
    '-'             => __('Please choose', 'monkey-theme'),
    'miscellaneous' => __('Miscellaneous', 'monkey-theme'),
    '123rf'         => '123RF',
    'adobestock'    => 'Adobe Stock',
    'depositphotos' => 'Depositphotos',
    'dreamstime'    => 'Dreamstime',
    'fotolia'       => 'Fotolia',
    'freepik'       => 'Freepik',
    'istockphoto'   => 'iStockPhoto',
    'pexels'        => 'Pexels',
    'picjumbo'      => 'Picjumbo',
    'pixabay'       => 'Pixabay',
    'shutterstock'  => 'Shutterstock',
    'unsplash'      => 'Unsplash',
    'wikipedia'     => 'Wikipedia',
);
    
function attachments_credits_fields( $form_fields, $post) {
    global $mediaCreditsSources;

    $form_fields['attachment-source'] = array(
        'label' => __('Media Source', 'monkey-theme'),
        'input' => 'html',
        'helps' => __('Choose media provider - will be ordered by this', 'monkey-theme'),
    );
    
    $form_fields['attachment-name'] = array(
        'label' => __('Media Name', 'monkey-theme'),
        'input' => 'text',
        'value' => get_post_meta( $post->ID, 'attachment_name', true ),
        'helps' => __('Define attachment name for media credits', 'monkey-theme'),
    );
    
    $form_fields['attachment-author'] = array(
        'label' => __('Media Author', 'monkey-theme'),
        'input' => 'text',
        'value' => get_post_meta( $post->ID, 'attachment_author', true ),
        'helps' => __('Define author information for media credits', 'monkey-theme'),
    );

    $form_fields['attachment-url'] = array(
        'label' => __('Media URL', 'monkey-theme'),
        'input' => 'text',
        'value' => get_post_meta( $post->ID, 'attachment_url', true ),
        'helps' => __('Add a url to attachment source to thank the author', 'monkey-theme'),
    );

    $form_fields['attachment-source']['html'] = "<select name='attachments[{$post->ID}][attachment-source].'>";

    foreach ($mediaCreditsSources as $key => $value) {
        $selected = "";
        if(get_post_meta( $post->ID, 'attachment_source', true ) !== null && get_post_meta( $post->ID, 'attachment_source', true ) == $key) {
            $selected = 'selected="selected"';
        }
        $form_fields['attachment-source']['html'] .= '<option value="' . $key . '" '.$selected.'>'.$value.'</option>';
    }
    
    $form_fields['attachment-source']['html'] .= '</select>'; 

    return $form_fields;
}

add_filter( 'attachment_fields_to_edit', 'attachments_credits_fields', 10, 2 );

/**
 * Save values of Photographer Name and URL in media uploader
 *
 * @param $post array, the post data for database
 * @param $attachment array, attachment fields from $_POST form
 * @return $post array, modified post data
 */

function attachments_credits_field_save( $post, $attachment ) {
    
    if( isset( $attachment['attachment-source'] ) )
        update_post_meta( $post['ID'], 'attachment_source', $attachment['attachment-source'] );

    if( isset( $attachment['attachment-name'] ) )
        update_post_meta( $post['ID'], 'attachment_name', $attachment['attachment-name'] );

    if( isset( $attachment['attachment-author'] ) )
        update_post_meta( $post['ID'], 'attachment_author', $attachment['attachment-author'] );

    if( isset( $attachment['attachment-url'] ) )
        update_post_meta( $post['ID'], 'attachment_url', $attachment['attachment-url'] );

    return $post;
}

add_filter( 'attachment_fields_to_save', 'attachments_credits_field_save', 10, 2 );