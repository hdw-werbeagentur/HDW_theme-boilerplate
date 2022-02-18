<?php
    $enableNotificationMessage = false;

    if( class_exists('ACF') ) {
        $enableLanguageSelect = (get_field('hdw-theme-setting__wmprof--country-select', 'option') ? get_field('hdw-theme-setting__wmprof--country-select', 'option') : false);
        $enableNotificationMessage = (get_field('hdw-theme-setting__general--notification-message', 'option') ? get_field('hdw-theme-setting__general--notification-message', 'option') : false);
        $notificationMessage = (get_field('hdw-theme-setting__general--notification-message-text', 'option') ? get_field('hdw-theme-setting__general--notification-message-text', 'option') : '');
    }

    if( $enableNotificationMessage && $notificationMessage != '' ) :
        $notificationBorderColor = (get_field('hdw-theme-setting__general--notification-message-border-color', 'option') ? get_field('hdw-theme-setting__general--notification-message-border-color', 'option') : 'var(--color__notice--dark)');
        $notificationBackgroundColor = (get_field('hdw-theme-setting__general--notification-message-background-color', 'option') ? get_field('hdw-theme-setting__general--notification-message-background-color', 'option') : 'var(--color__notice--light)');
        $notificationTextColor = (get_field('hdw-theme-setting__general--notification-message-text-color', 'option') ? get_field('hdw-theme-setting__general--notification-message-text-color', 'option') : 'var(--color__notice)');
        $notificationIcon = (get_field('hdw-theme-setting__general--notification-message-icon', 'option') ? get_field('hdw-theme-setting__general--notification-message-icon', 'option') : false);
?>

<div class="notification-message">
	<div class="notification-message__inner-container container">
		<div class="notification-message__wrapper" style="background: <?= $notificationBackgroundColor?>; color: <?= $notificationTextColor?>; border-color: <?= $notificationBorderColor?>;">
            <?php
                if (is_array($notificationIcon) ) {
                    echo '<div class="notification-message__icon-wrapper">';
                        if( $notificationIcon['mime_type'] == 'image/svg+xml' ){
                            echo inlineSvg( $notificationIcon['ID'] );
                        }
                        else{
                            echo '
                                <img src="'.$notificationIcon['url'].'" height="'.$notificationIcon['sizes']['thumbnail-height'].'" width="'.$notificationIcon['sizes']['thumbnail-width'].'" class="notification-message__icon">
                            ';
                        }
                    echo '</div>';
                }
            ?>
            <div class="notification-message__text">
			    <?= $notificationMessage ?>
            </div>
		</div>
	</div>
</div>

<?php endif; ?>