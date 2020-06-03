<?php
/**
 * Single view template
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

            <?php
            the_post();
            get_template_part('resources/views/contents/content', get_post_type());
            ?>

        </main>

    </div>

</div>

<?php
/**
 * Footer
 */
get_template_part('resources/views/footer', get_post_type());
