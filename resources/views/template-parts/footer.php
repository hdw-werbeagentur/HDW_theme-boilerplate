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

		if(get_theme_mod('social-media-facebook') != "") $socialMediaIcons["facebook"] = get_theme_mod('social-media-facebook'); 
		if(get_theme_mod('social-media-twitter') != "") $socialMediaIcons["twitter"] = get_theme_mod('social-media-twitter');
		if(get_theme_mod('social-media-linkedin') != "") $socialMediaIcons["linkedin"] = get_theme_mod('social-media-linkedin');
		if(get_theme_mod('social-media-google') != "") $socialMediaIcons["google"] = get_theme_mod('social-media-google');
		if(get_theme_mod('social-media-xing') != "") $socialMediaIcons["xing"] = get_theme_mod('social-media-xing');
		if(get_theme_mod('social-media-instagram') != "") $socialMediaIcons["instagram"] = get_theme_mod('social-media-instagram'); 

		if(count($socialMediaIcons) > 0) { ?>
			<div class="footer__container--social-media">

				<nav class="social-media-icon-navigation">

					<ul>

						<?php
                        foreach ($socialMediaIcons as $socialMediaIcon => $value) {

                            if($value != "") {
                                echo
                                '<li class="social-media__icon--'.$socialMediaIcon.'">
                                    <a href="'.$value.'" target="_blank">'
                                        .$socialMediaIcon.
                                    '</a>
                                </li>';
                            }
                             
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
