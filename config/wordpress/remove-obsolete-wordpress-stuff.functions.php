<?php 
    remove_action('admin_print_styles', 'print_emoji_styles'); // Emoji
    remove_action('wp_head', 'print_emoji_detection_script', 7); // Emoji
    remove_action('admin_print_scripts', 'print_emoji_detection_script'); // Emoji
    remove_action('wp_print_styles', 'print_emoji_styles'); // Emoji
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email'); // Emoji
    remove_filter('the_content_feed', 'wp_staticize_emoji'); // Emoji
    remove_filter('comment_text_rss', 'wp_staticize_emoji'); // Emoji
    remove_action('wp_head', 'wp_generator'); // Remove WordPress generator meta tag
    remove_action('wp_head', 'rsd_link'); // Remove RSD link meta tag
    remove_action('wp_head', 'wlwmanifest_link'); // Remove WLW manifest link meta tag
    remove_action('wp_head', 'wp_shortlink_wp_head'); // Remove shortlink meta tag
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head'); // Remove adjacent posts link meta tags
    remove_action('wp_head', 'rest_output_link_wp_head'); // Remove REST output link meta tag
    add_filter('the_generator', '__return_null'); // Remove generator output
    add_filter('login_headerurl', 'home_url'); // Replace the login logo link with home url

    // Remove obsolete wordpress stylings and add add required styles
    add_action('enqueue_block_editor_assets', function () {
        // Removes editor styles
        wp_deregister_style('wp-reset-editor-styles');
        // Add back key styles, there may be more
        // change the path as needed
        wp_enqueue_style('wp-block-editor-styles', '../../../wp/wp-includes/css/dist/block-editor/style.css', false);
        wp_enqueue_style('wp-edit-post-styles', '../../../wp/wp-includes/css/dist/edit-post/style.css', false);
    }, 102);
