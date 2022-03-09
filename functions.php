<?php
/**
 * ------------------------------------------------------------------------------
 * Theme configuration
 *
 * - Composer autoloader
 * - Adding theme support for features
 * - Register assets
 * - Register menus
 * - Register image sizes
 * - Register customizer fields
 * - Optimize WordPress output
 * - Register new directory for WordPress template files
 * ------------------------------------------------------------------------------
 */
use \RalfHortt\Assets\Script;
use \RalfHortt\Assets\Style;
use \RalfHortt\Assets\AdminStyle;
use \RalfHortt\Assets\AdminScript;
use \RalfHortt\ContentWidth\ContentWidth;
use \RalfHortt\TemplateLoader\TemplateLocator;

/**
 * ------------------------------------------------------------------------------
 * Load composer autoloader file
 * ------------------------------------------------------------------------------
 */

$autoloader = __DIR__ . '/vendor/autoload.php';

if (is_readable($autoloader)) :
    include $autoloader;
endif;

if (!defined('WPINC')) :
    die;
endif;

/**
 * ------------------------------------------------------------------------------
 * Setup theme
 * ------------------------------------------------------------------------------
 */
add_action('after_setup_theme', function () {
    /**
     * ------------------------------------------------------------------------------
     * Setup theme support features
     *
     * @see https://developer.wordpress.org/block-editor/developers/themes/theme-support/
     * @see https://developer.wordpress.org/reference/functions/add_theme_support/
     * ------------------------------------------------------------------------------
     */
    include get_template_directory() . '/config/wordpress/theme-support.functions.php';

    /**
     * ------------------------------------------------------------------------------
     * Set content width
     *
     * @see https://codex.wordpress.org/Content_Width
     * ------------------------------------------------------------------------------
     */
    $contentWidth = 1440;
    if( class_exists('ACF') ) {
        $contentWidth = (get_field('hdw-theme-developer-setting__content-width', 'option') ? get_field('hdw-theme-developer-setting__content-width', 'option') : 980);
    }

    (new ContentWidth($contentWidth))->register();


    /**
     * ------------------------------------------------------------------------------
     * Assets management
     *
     * @see https://github.com/Horttcore/wp-assets
     * ------------------------------------------------------------------------------
     */
    (new Script('theme', get_template_directory_uri() . '/dist/js/app.min.js', ['jquery'], true, true))->register();
    (new Style('sanitize-css', get_template_directory_uri() . '/dist/vendor/sanitize-css/sanitize.css'))->register();
    (new Style('theme', get_template_directory_uri() . '/dist/css/app.min.css', ['sanitize-css']))->register();

    //Embla Slider - uncomment the lines below to implement the slider and plugins
    //(new Script('embla-slider', get_template_directory_uri() . '/dist/vendor/embla-carousel/packages/embla-carousel/embla-carousel.umd.js', ['jquery'], true, true))->register();
    //(new Script('embla-slider-autoplay', get_template_directory_uri() . '/dist/vendor/embla-carousel/packages/embla-carousel-autoplay/embla-carousel-autoplay.umd.js', ['jquery'], true, true))->register();
    //(new Script('embla-slider-class-names', get_template_directory_uri() . '/dist/vendor/embla-carousel/packages/embla-carousel-class-names/embla-carousel-class-names.umd.js', ['jquery'], true, true))->register();

    //  add_editor_style('dist/css/editor-styles.css');

    (new AdminStyle('editor-styles-admin', get_template_directory_uri() . '/dist/css/editor-styles.min.css', [], false, true))->register();


    /**
     * ------------------------------------------------------------------------------
     * Register menu location
     *
     * @see https://developer.wordpress.org/reference/functions/register_nav_menus/
     * ------------------------------------------------------------------------------
     */
    register_nav_menus(
        [
            'meta' => __('Meta navigation', 'TEXTDOMAIN'),
            'main' => __('Main navigation', 'TEXTDOMAIN'),
            'footer' => __('Footer navigation', 'TEXTDOMAIN'),
        ]
    );

    /**
     * ------------------------------------------------------------------------------
     * Define custom image sizes
     * ------------------------------------------------------------------------------
     */
    include get_template_directory() . '/config/wordpress/image-sizes.functions.php';


    /**
     * ------------------------------------------------------------------------------
     * Optimizations
     * Remove obsolete wordpress stuff with "remove_action"
     * ------------------------------------------------------------------------------
     */
    include get_template_directory() . '/config/wordpress/remove-obsolete-wordpress-stuff.functions.php';

    /**
     * ------------------------------------------------------------------------------
     * Customizer
     *
     * @see https://github.com/Horttcore/wp-customizer
     * ------------------------------------------------------------------------------
     */
    include get_template_directory() . '/config/wordpress/customizer.functions.php';

    /**
     * ------------------------------------------------------------------------------
     * Template loader
     * ------------------------------------------------------------------------------
     */
    (new TemplateLocator('resources/views'))->register();
});


/*
* Theme functions
* Fixed settings
*/

// Enable SMTP mailing via external smtp server
include get_template_directory() . '/config/wordpress/attachments-credits.functions.php';

// Enable some Wordpress security settings
include get_template_directory() . '/config/wordpress/wordpress-security.functions.php';

// Enable cache configuration to avoid caching on development & local environments
include get_template_directory() . '/config/wordpress/cache-config.functions.php';


/*
* Configurable settings
*/
if ((defined('WP_SMTP_HOST') && WP_SMTP_HOST != "localhost") && WP_SMTP_USERNAME && WP_SMTP_PASSWORD){
    // Enable SMTP mailing via external smtp server
	include get_template_directory() . '/config/wordpress/mail-configuration.functions.php';
}

if ( defined('WP_COMMENTS') && WP_COMMENTS == false ){
    // Disable wordpress comment to avoid spam
	include get_template_directory() . '/config/wordpress/comments-configuration.functions.php';
}

if ( defined('WP_BLOG') && WP_BLOG == false ){
    // Disable wordpress blog environment
	include get_template_directory() . '/config/wordpress/blog-configuration.functions.php';
}

if (defined('ACF_PRO_KEY') && ACF_PRO_KEY != '') {
    // Activate ACF Pro
    include get_template_directory() . '/config/wordpress/acf-pro-activation.functions.php';
}

/**
 * ------------------------------------------------------------------------------
 * Register theme configuration files
 * ------------------------------------------------------------------------------
 */
foreach (glob(get_template_directory() . '/config/theme/*.php') as $filename) {
    include $filename;
}

/**
 * ------------------------------------------------------------------------------
 * Register custom post types
 * ------------------------------------------------------------------------------
 */
foreach (glob(get_template_directory() . '/config/custom-post-types/*.php') as $filename) {
    include $filename;
}

/**
 * ------------------------------------------------------------------------------
 * Register gutenberg configurations files
 * ------------------------------------------------------------------------------
 */
foreach (glob(get_template_directory() . '/config/gutenberg/*.php') as $filename) {
    include $filename;
}

/**
 * ------------------------------------------------------------------------------
 * Put project specific code in functions.custom.php
 * ------------------------------------------------------------------------------
 */
