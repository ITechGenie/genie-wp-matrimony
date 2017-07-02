<?php

$login_url = wp_login_url($_SERVER['REQUEST_URI']);
$signup_url = get_option('siteurl') . '/wp-login.php?action=register';

?>
<p>
<?php 
echo __("You are either unauthorized or the page you requested is not available. ", 'genie-wp-matrimony') ;
printf(__('Why don\'t you %s and try again.', 'genie-wp-matrimony'), '<a href="'. $login_url . '">' . __('login', '') . '</a>'); ?>
<?php if(get_option('users_can_register')) {
	?>
	<br /> <br />
	<?php echo getBulletImg() ; ?>
	<?php _e('Don\'t have a Login?', 'genie-wp-matrimony'); ?>
	<a href="<?php echo $signup_url; ?>"><?php _e('Register for an Account.', 'genie-wp-matrimony'); ?>
	</a>
<?php } ?>
<br />
<?php

	global $genieWPMatrimonyController;
	$userPref = $genieWPMatrimonyController->getUserLoginPreference() ;

	if ($userPref == 1) {
		global $gwpm_setup_model ;
		gwpm_echo( getBulletImg() . "If you have already registered, Click <a href='" .
		get_option( 'siteurl' ) . "/wp-admin/profile.php'>Here</a> to update your profile or click <a href='" .
		get_option('siteurl') . '/?page_id=' . $gwpm_setup_model->getMatrimonialId() .  '&page=subscribe' . "'>Here</a> to get approval from Admin") ;
	}
?>
<br /> <br /> <br /> <br /> <br />