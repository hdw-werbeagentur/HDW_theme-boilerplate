<?php
/**
 * Blog overview template
 * Applies to the page which is defined as posts page
 *
 * Talented Monkeys/Monkey Theme 
 */


/**
 *
 * <head>
 *
 */
get_template_part('resources/views/header', 'blog');


/**
 *
 * Content loop
 *
 */
?>
<div class="content">

    <div class="container">

        <main class="main">

            <h1 class="archive-title"><?php echo single_cat_title() ?></h1>

            <?php get_template_part('resources/views/template-parts/loop', 'blog') ?>

        </main><!-- .main -->

    </div><!-- .container -->

</div><!-- .content -->


<?php
/**
 *
 * Footer
 *
 */
get_template_part('resources/views/footer', 'blog');
