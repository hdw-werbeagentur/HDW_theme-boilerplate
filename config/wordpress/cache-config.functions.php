<?php
/**
** ------------------------------------------------------------------------------
** This code snippet will deactivate wp rocket on local and development environment by code
** ------------------------------------------------------------------------------
** Problem description
**
** @see https://www.webnots.com/how-to-bypass-wp-rocket-caching-in-wordpress/
** @see https://github.com/wp-media/wp-rocket-helpers/blob/master/cache/wp-rocket-no-cache/wp-rocket-no-cache.php
** ------------------------------------------------------------------------------
*/

if ( defined('WP_ENV') && WP_ENV != "production" && WP_ENV != "staging" ){
    // namespace WP_Rocket\Helpers\cache\no_cache;

    // Standard plugin security, keep this line in place.
    defined( 'ABSPATH' ) or die();

    /**
    * Disable page caching in WP Rocket.
    *
    * @link http://docs.wp-rocket.me/article/61-disable-page-caching
    */
    add_filter( 'do_rocket_generate_caching_files', '__return_false' );

    /**
    * Cleans entire cache folder on activation.
    *
    * @author Arun Basil Lal
    */
    function clean_wp_rocket_cache() {

        if ( ! function_exists( 'rocket_clean_domain' ) ) {
            return false;
        }

        // Purge entire WP Rocket cache.
        rocket_clean_domain();
    }
    register_activation_hook( __FILE__, __NAMESPACE__ . '\clean_wp_rocket_cache' );
}