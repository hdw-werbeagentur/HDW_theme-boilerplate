<?php
/*
*   Template Name: Image Credits
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

            echo '<div class="media-provider__wrapper">';
            // Get all image credits
            global $post;
            $args = array(
                'post_type'         => 'attachment',
                'post_status'       => 'inherit',
                'posts_per_page'    => '-1',
                'order'             => 'ASC',
                'orderby'           => 'meta_value',
                'meta_key'          => 'attachment_source',
                'meta_query'        => array(
                    'relation' => 'OR',
                    array(
                        'key' => 'attachment_source',
                        'value' => $mediaCreditsSources,
                        'compare' => 'IN'
                    ),
                    array(
                        'key' => 'attachment_source',
                        'value' => '-',
                        'compare' => 'NOT IN'
                    )
                )
            );

            $images = new WP_Query( $args );

            if( $images->have_posts() ){

                    $imageCreditThumbnail = "";
                    $imageCreditAuthor = "";
                    $imageCreditUrl = "";
                    $imageCreditName = "";
                    $imageCreditSourceTitle = '';

                    while( $images->have_posts() ): $images->the_post(); global $post;

                        $imageCreditSourceSlug = get_post_meta($post->ID, 'attachment_source')[0];
                        $imageCreditThumbnail = wp_get_attachment_image($post->ID);
                        $imageCreditAuthor = (get_post_meta($post->ID, 'attachment_author')[0] != '') ? get_post_meta($post->ID, 'attachment_author')[0] : __('Author', 'TEXTDOMAIN');
                        $imageCreditUrl = (get_post_meta($post->ID, 'attachment_url')[0] != '') ? get_post_meta($post->ID, 'attachment_url')[0] : '#';
                        $imageCreditName = (get_post_meta($post->ID, 'attachment_name')[0] != '') ? get_post_meta($post->ID, 'attachment_name')[0] : __('Attachment Name', 'TEXTDOMAIN');

                        if($imageCreditSourceTitle != $imageCreditSourceSlug) {

                            // close list | DO NOT REMOVE
                            if($imageCreditSourceTitle != '') {
                                echo '
                                        </ul>
                                    </section>
                                ';
                            }

                            // Start image list for new source
                            echo "
                                <section class='media-provider media-provider__$imageCreditSourceSlug'>
                                    <h2>$mediaCreditsSources[$imageCreditSourceSlug]</h2>
                            ";

                            // open list
                            echo '<ul class="media-provider__list">';

                            $imageCreditSourceTitle = $imageCreditSourceSlug;
                        }

                        // echo '<pre>'; print_r($post); echo '</pre>';
                        echo '
                            <li class="media-provider__item">
                                <figure class="media-provider__image">
                                    '.$imageCreditThumbnail.'
                                </figure>
                                <figcaption class="media-provider__description">
                                    <a href="'.$imageCreditUrl.'" target="_blank" rel="nofollow" class="media-provider__name">
                                        '.$imageCreditName.'
                                    </a>
                                    <small class="media-provider__author">
                                        by
                                        <a href="'.$imageCreditUrl.'" target="_blank" rel="nofollow" class="media-provider__author--link">
                                            '.$imageCreditAuthor.'
                                        </a>
                                    </small>
                                </figcaption>
                            </li>
                        ';

                    endwhile;

                    // close list | DO NOT REMOVE
                    echo '
                            </ul>
                        </section>
                    ';

                    wp_reset_query();

            }
            echo '</div>';
        ?>

        </main>

    </div>

</div>

<?php
/**
 * Footer
 */
get_template_part('resources/views/footer', get_post_type());