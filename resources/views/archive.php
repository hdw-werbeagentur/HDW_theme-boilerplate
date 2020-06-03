<?php
/**
 * Overview template
 * Related to Custom Post Types
 *
 * Talented Monkeys/Monkey Theme
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

            <?php the_archive_title('<h1 class="archive__title">', '</h1>') ?>

            <div class="posts">

                <?php
                while (have_posts()) :
                    the_post();
                    get_template_part('resources/views/contents/content-archive', get_post_type());
                endwhile;
                ?>

            </div>

            <?php the_posts_pagination(); ?>

        </main>

    </div>

</div>

<?php
/**
 * Footer
 */
get_template_part('resources/views/footer', get_post_type());
