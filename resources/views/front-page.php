<?php

/**
 * Header
 * Applies to the page defined as frontpage in wordpress backend
 *
 * Talented Monkeys/Monkey Theme
 */


/**
 * <head>
 */
get_template_part('resources/views/template-parts/head', get_post_type());


/**
 * Header
 */
get_template_part('resources/views/template-parts/header', get_post_type());


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
            ?>

            <div class="container">
                Main Theme
            </div>

        </main>

    </div>

</div>

<?php
/**
 * Footer
 */
get_template_part('resources/views/footer', get_post_type());
