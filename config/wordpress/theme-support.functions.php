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
                'name' => __('Primary', 'saar-technology'),
                'slug' => 'primary',
                'color' => getCssCustomProp('color__primary'),
            ],
            [
                'name' => __('Scondary', 'saar-technology'),
                'slug' => 'secondary',
                'color' => getCssCustomProp('color__secondary'),
            ],
            [
                'name' => __('Tertiary', 'saar-technology'),
                'slug' => 'tertiary',
                'color' => getCssCustomProp('color__tertiary'),
            ],
            [
                'name' => __('Accent', 'saar-technology'),
                'slug' => 'accent',
                'color' => getCssCustomProp('color__accent'),
            ],
            [
                'name' => __('White', 'saar-technology'),
                'slug' => 'white',
                'color' => getCssCustomProp('color__white'),
            ],
            [
                'name' => __('Black', 'saar-technology'),
                'slug' => 'black',
                'color' => getCssCustomProp('color__black'),
            ],
        ]
    );
    add_theme_support('editor-font-sizes', [
        [
            'name' => __('Klein', 'TEXTDOMAIN'),
            'size' => 12,
            'slug' => 'small'
        ],
        [
            'name' => __('Normal', 'TEXTDOMAIN'),
            'size' => 16,
            'slug' => 'normal'
        ],
        [
            'name' => __('Groß', 'TEXTDOMAIN'),
            'size' => 32,
            'slug' => 'large'
        ],
    ]);
    add_theme_support('editor-styles');