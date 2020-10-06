<?php
function my_filter_acf_pro_license_option($pre)
{
	if (!defined('ACF_PRO_KEY') || empty(ACF_PRO_KEY)) {
		return $pre;
	}

	$data = array(
		'key' => ACF_PRO_KEY,
		'url' => home_url(),
	);

	return base64_encode(serialize($data));
}
add_filter('pre_option_acf_pro_license', 'my_filter_acf_pro_license_option');