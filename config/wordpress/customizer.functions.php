<?php
    use \Horttcore\Customizer\Customize;

    /**
     * ------------------------------------------------------------------------------
     * Customizer
     *
     * @see https://github.com/Horttcore/wp-customizer
     * ------------------------------------------------------------------------------
     */
    (new Customize)
        ->panel(__('Einstellungen', 'TEXTDOMAIN'))
            ->section(__('Kontakt', 'TEXTDOMAIN'))
                ->text('company', __('Unternehmen', 'TEXTDOMAIN'))
                ->text('street', __('Straße', 'TEXTDOMAIN'))
                ->text('street-number', __('Hausnummer', 'TEXTDOMAIN'))
                ->text('zip', __('PLZ', 'TEXTDOMAIN'))
                ->text('city', __('Ort', 'TEXTDOMAIN'))
                ->text('phone', __('Telefon', 'TEXTDOMAIN'))
                ->text('fax', __('Fax', 'TEXTDOMAIN'))
                ->text('mobile', __('Mobil', 'TEXTDOMAIN'))
                ->text('email', __('E-Mail', 'TEXTDOMAIN'))
                ->url('website', __('Webseite', 'TEXTDOMAIN'))
                ->url('map', __('Karte', 'TEXTDOMAIN'))
            ->section(__('Social Media', 'TEXTDOMAIN'))
                ->url('facebook', __('Facebook', 'TEXTDOMAIN'))
                ->url('twitter', __('Twitter', 'TEXTDOMAIN'))
                ->url('instagram', __('Instagram', 'TEXTDOMAIN'))
            ->section(__('Tracking Codes', 'TEXTDOMAIN'))
                ->textarea('google-tag-manager', __('Google Tag Manager', 'TEXTDOMAIN'))
        ->panel(__('Social Media', 'TEXTDOMAIN'))
	        ->section(__('Social Media URLs', 'TEXTDOMAIN'))
		        ->url('social-media-facebook', __('Facebook', 'TEXTDOMAIN'))
		        ->url('social-media-twitter', __('Twitter', 'TEXTDOMAIN'))
		        ->url('social-media-linkedin', __('LinkedIn', 'TEXTDOMAIN'))
				->url('social-media-google', __('Google', 'TEXTDOMAIN'))
				->url('social-media-xing', __('Xing', 'TEXTDOMAIN'))
		        ->url('social-media-instagram', __('Instagram', 'TEXTDOMAIN'))
        ->register();