<?php
/*
*   Template Name: Imprint
*/

/**
 * Header
 */
get_template_part('resources/views/header', get_post_type());

/**
 * Content
 */
?>
<div class="content">

    <div class="container">

        <main class="main">

            <?php
                while (have_posts()) :
                    the_post();
                    get_template_part('resources/views/contents/content', get_post_type());
                endwhile;

                if ( defined('ENABLE_HDW_LEGAL') && ENABLE_HDW_LEGAL ){
                    $enableDefaultImprint = false;
                    $imprintViewFile = WP_PLUGIN_DIR.'/hdw-legal/resources/views/imprint.view.php';
                    if( class_exists('ACF') ) {
                        $enableDefaultImprint = (get_field('hdw-theme-setting__hdw-legal__enable-default-imprint', 'option') ? get_field('hdw-theme-setting__hdw-legal__enable-default-imprint', 'option') : false);
                    }

                    if($enableDefaultImprint && file_exists($imprintViewFile)){

                        echo '<article class="hdw-legal entry">';
                            include($imprintViewFile);
                        echo '</article>';
                    }
                }
            ?>

        </main>

    </div>

</div>

<?php
/**
 * Footer
 */
get_template_part('resources/views/footer', get_post_type());