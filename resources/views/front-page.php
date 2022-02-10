<?php

/**
 * Header
 * Applies to the page defined as frontpage in wordpress backend
 *
 * Talented Monkeys/Monkey Theme
 */


/**
 * Header
 */
get_template_part('resources/views/header', 'front-page');

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
                get_template_part('resources/views/contents/content', 'front-page');
            endwhile;
            ?>

        </main>

    </div>

</div>

<?php
/**
 * Footer
 */
get_template_part('resources/views/footer', 'front-page');
