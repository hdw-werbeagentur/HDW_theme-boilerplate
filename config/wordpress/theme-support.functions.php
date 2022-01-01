<?php
/**
 * ------------------------------------------------------------------------------
 * Setup theme support features
 *
 * @see https://developer.wordpress.org/block-editor/developers/themes/theme-support/
 * @see https://developer.wordpress.org/reference/functions/add_theme_support/
 * ------------------------------------------------------------------------------
 */
    add_theme_support('custom-logo');
    add_theme_support('html5', ['comment-list', 'comment-form', 'search-form', 'gallery', 'caption']);
    add_theme_support('post-thumbnails');
    add_theme_support('responsive-embeds');
    add_theme_support('title-tag');
    add_theme_support('custom-logo');
    add_theme_support('align-wide');
    add_theme_support('disable-custom-colors');
    add_theme_support('disable-custom-font-sizes');
    add_theme_support(
        'editor-color-palette',
        [
            [
                'name' => __('Primary', 'TEXTDOMAIN'),
                'slug' => 'primary',
                'color' => getCssCustomProp('color__primary'),
            ],
            [
                'name' => __('Scondary', 'TEXTDOMAIN'),
                'slug' => 'secondary',
                'color' => getCssCustomProp('color__secondary'),
            ],
            [
                'name' => __('Tertiary', 'TEXTDOMAIN'),
                'slug' => 'tertiary',
                'color' => getCssCustomProp('color__tertiary'),
            ],
            [
                'name' => __('Accent', 'TEXTDOMAIN'),
                'slug' => 'accent',
                'color' => getCssCustomProp('color__accent'),
            ],
            [
                'name' => __('White', 'TEXTDOMAIN'),
                'slug' => 'white',
                'color' => getCssCustomProp('color__white'),
            ],
            [
                'name' => __('Black', 'TEXTDOMAIN'),
                'slug' => 'black',
                'color' => getCssCustomProp('color__black'),
            ],
            [
                'name' => __('Grey', 'TEXTDOMAIN'),
                'slug' => 'grey',
                'color' => getCssCustomProp('color__grey'),
            ],
            [
                'name' => __('Red', 'TEXTDOMAIN'),
                'slug' => 'red',
                'color' => getCssCustomProp('color__red'),
            ],
            [
                'name' => __('Light red', 'TEXTDOMAIN'),
                'slug' => 'light-red',
                'color' => getCssCustomProp('color__red--light'),
            ],
            [
                'name' => __('Yellow', 'TEXTDOMAIN'),
                'slug' => 'yellow',
                'color' => getCssCustomProp('color__yellow'),
            ],
            [
                'name' => __('Light yellow', 'TEXTDOMAIN'),
                'slug' => 'light-yellow',
                'color' => getCssCustomProp('color__yellow--light'),
            ],
            [
                'name' => __('Blue', 'TEXTDOMAIN'),
                'slug' => 'blue',
                'color' => getCssCustomProp('color__blue'),
            ],
            [
                'name' => __('Light blue', 'TEXTDOMAIN'),
                'slug' => 'light-blue',
                'color' => getCssCustomProp('color__blue--light'),
            ],
            [
                'name' => __('Green', 'TEXTDOMAIN'),
                'slug' => 'green',
                'color' => getCssCustomProp('color__green'),
            ],
            [
                'name' => __('Light green', 'TEXTDOMAIN'),
                'slug' => 'light-green',
                'color' => getCssCustomProp('color__green--light'),
            ],
        ]
    );
    add_theme_support('editor-font-sizes', [
        // [
        //     'name' => __('Klein', 'TEXTDOMAIN'),
        //     'size' => 12,
        //     'slug' => 'small'
        // ],
    ]);
    add_theme_support('editor-styles');

/**
 * ------------------------------------------------------------------------------
 * Acf color picker pa
 *
 * Define color picker palette based on the theme colors
 * ------------------------------------------------------------------------------
 */
    function hdw_setting_acf_color_picker_palette() { ?>

    <script type="text/javascript">
        (function($) {
            acf.add_filter('color_picker_args', function( args, $field ){
                args.palettes = [
                    '<?= preg_replace("/\s+/","",getCssCustomProp('color__primary')) ?>',
                    '<?= preg_replace("/\s+/","",getCssCustomProp('color__secondary')) ?>',
                    '<?= preg_replace("/\s+/","",getCssCustomProp('color__tertiary')) ?>',
                    '<?= preg_replace("/\s+/","",getCssCustomProp('color__accent')) ?>',
                    '<?= preg_replace("/\s+/","",getCssCustomProp('color__red')) ?>',
                    '<?= preg_replace("/\s+/","",getCssCustomProp('color__red--light')) ?>',
                    '<?= preg_replace("/\s+/","",getCssCustomProp('color__yellow')) ?>',
                    '<?= preg_replace("/\s+/","",getCssCustomProp('color__yellow--light')) ?>',
                    '<?= preg_replace("/\s+/","",getCssCustomProp('color__blue')) ?>',
                    '<?= preg_replace("/\s+/","",getCssCustomProp('color__blue--light')) ?>',
                    '<?= preg_replace("/\s+/","",getCssCustomProp('color__green')) ?>',
                    '<?= preg_replace("/\s+/","",getCssCustomProp('color__green--light')) ?>'
                ];

                return args;
            });
        })(jQuery);
    </script>

    <style>
        .iris-border {
            max-width: 10rem;
            height: auto !important;
            padding: 0.625rem !important;
        }
       .iris-picker.iris-border .iris-picker-inner,
       .iris-picker.iris-border .iris-palette-container{
            position: static !important;
        }
        .iris-border .iris-picker-inner {
            display: grid;
            grid-template-columns: 83% 10%;
            grid-gap: 0.625rem;
        }
        .iris-border .iris-picker-inner .iris-square {
            width: 100% !important;
            margin-right: 0rem !important;
            float: none !important;
        }
        .iris-border .iris-picker-inner .iris-slider.iris-strip {
            height: 100% !important;
            width: 100% !important;
            float: none !important;
        }
        .iris-border .iris-palette-container {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            grid-gap: 0.3125rem;
            margin-top: 0.625rem;
        }
        .iris-border .iris-palette-container .iris-palette {
            float: none !important;
            width: 100% !important;
            height: 1.25rem !important;
            margin: 0 !important;
        }
    </style>

    <?php }

    add_action('acf/input/admin_footer', 'hdw_setting_acf_color_picker_palette');
