<footer class="footer">

    <div class="footer__navigation container">

        <?php
            wp_nav_menu(array(
                'theme_location'    => 'footer',
                'container'         => 'nav',
                'container_class'   => 'footer__navigation--wrapper',
                'container_id'      => 'footer-navigation',
                'menu_class'        => '',
                'menu_id'           => '',
                'before'            => '',
                'fallback_cb'       => '',
            ));
        ?>

    </div>

	<div class="footer__container container">

    <?php
        $socialMediaIcons = array();

        if (get_field('hdw-theme-setting__company-data--social-media', 'options'))  $socialMediaIcons = get_field('hdw-theme-setting__company-data--social-media', 'options');

        if (count($socialMediaIcons) > 0) { ?>
            <div class="footer__container--social-media">

                <nav class="social-media-icon-navigation">

                    <ul>

                        <?php
                        foreach ($socialMediaIcons as $socialMediaIcon) {

                            $cssClass = str_replace(' ', '', strtolower($socialMediaIcon['name']));
                            $url = $socialMediaIcon['link']['url'];
                            $target = $socialMediaIcon['link']['target'];
                            $title = $socialMediaIcon['link']['title'];
                            $icon =  wp_get_attachment_image($socialMediaIcon['icon']['ID']);
                            echo
                            '<li class="social-media__icon--' . $cssClass . '">
                                    <a href="' . $url . '" target="' . $target . '" title="' . $title . '">'
                                . $icon .
                                '</a>
                                </li>';
                        }
                        ?>

                    </ul>

                </nav>

            </div>
        <?php } ?> 

	    <div class="footer__container--logo">
			<img src="<?php echo get_theme_mod('footer-logo') ?>" />
	    </div>

	    <div class="footer__container--copyright">

			<small class="copyright">
                <?= __('Copyright ©', 'TEXTDOMAIN'); ?>
                <?= date("Y").' '.get_theme_mod('footer-company'); ?>
            </small>

	    </div>

	</div>

</footer>
