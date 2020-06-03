<?php
/**
 * 404 template
 * Error Template if page is not found
 *
 * Talented Monkeys/Monkey Theme
 */
 

/**
 * Header
 */
get_template_part('resources/views/header', '404');


/**
 * Content
 */
?>
<div class="content">

    <div class="container">

        <main class="main">

            <?php get_template_part('resources/views/contents/content', '404') ?>

        </main>

    </div>

</div>

<?php
/**
 * Footer
 */
get_template_part('resources/views/footer', '404');
