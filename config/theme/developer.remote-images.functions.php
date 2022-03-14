<?php
 $enableRemoteImages = false;

if(env('WP_ENV') == 'local') {
    if( class_exists('ACF') ) {
        $enableRemoteImages = (get_field('hdw-theme-developer-setting__remote-images', 'option') ? get_field('hdw-theme-developer-setting__remote-images', 'option') : false);
        $remoteImagesUrl = (get_field('hdw-theme-developer-setting__remote-images-url', 'option') ? get_field('hdw-theme-developer-setting__remote-images-url', 'option') : '');
    }

    function hdw_replace_img_src_with_other_environment($url){
        global $remoteImagesUrl;

        $urlDetail = parse_url($url);

        if(file_exists(str_replace('/wp/', '', ABSPATH) . $urlDetail['path'])){
            return $url;
        }

        return str_replace(WP_HOME, $remoteImagesUrl, $url);
    }

    function hdw_replace_img_ssetrc_with_other_environment($sources){
        global $remoteImagesUrl;

        foreach($sources as &$source)        {
            $urlDetail = parse_url($source['url']);

            if(!file_exists(str_replace('/wp/', '', ABSPATH) . $urlDetail['path'])) {
                $source['url'] = str_replace(WP_HOME, $remoteImagesUrl, $source['url']);
            }
        }
        return $sources;
    };

    function hdw_replace_block_img_src_with_other_environment($block_content, $block){
        global $remoteImagesUrl;

        // Check if Gutenberg block is image - if not skip
        if ( 'core/image' !== $block['blockName'] &&
             'core/cover' !== $block['blockName'] &&
             'core/media-text' !== $block['blockName']
        ) return $block_content;

        if( 'core/image' == $block['blockName'] || 'core/media-text' == $block['blockName'] ){
            // Get src from image
            preg_match( '@src="([^"]+)"@' , $block_content, $imgSrc );
            $src = array_pop($imgSrc);
            $imgUrlDetail = parse_url($src);

            // Check if image source exists on local project - if yes return it
            if( file_exists(str_replace('/wp/', '', ABSPATH) . $imgUrlDetail['path']) ){
                return $block_content;
            }
        }

        if( 'core/cover' == $block['blockName'] ){
            // Get src from background-image
            $backgroundUrlDetail = parse_url($block['attrs']['url']);

            // Check if image source exists on local project - if yes return it
            if( file_exists(str_replace('/wp/', '', ABSPATH) . $backgroundUrlDetail['path']) ){
                return $block_content;
            }
        }

        // Return img src from remote
        return str_replace(WP_HOME, $remoteImagesUrl, $block_content);
    }

    if($enableRemoteImages && $remoteImagesUrl != ''){
        add_filter('render_block', 'hdw_replace_block_img_src_with_other_environment', 10, 2);
        add_filter('wp_get_attachment_url', 'hdw_replace_img_src_with_other_environment', 10, 2);
        add_filter('wp_calculate_image_srcset', 'hdw_replace_img_srcset_with_other_environment', 10, 2);
    }
}
