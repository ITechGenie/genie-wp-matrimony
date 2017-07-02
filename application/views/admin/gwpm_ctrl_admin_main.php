<?php 

if (!function_exists('is_admin')) {
	header('Status: 403 Forbidden');
	header('HTTP/1.1 403 Forbidden');
	exit ();
}

?>

<form name="gwpm_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>"><br />
	<input type="hidden" name="page_loaded" value="Y">
	<table class='widefat gwpm-search-result'><tr><td>
	<p><?php _e("Run Matrimonial Setup: " , 'genie-wp-matrimony'); ?></p></td><td>
	<select id="pluginSetup" name="pluginSetup" width="55px" >
		<option name='yes' value='yes' <?php echo $resultObj[0]; ?>><?php _e("Yes", 'genie-wp-matrimony'); ?></option>
		<option name='no' value='no' <?php echo $resultObj[1]; ?>><?php _e("No", 'genie-wp-matrimony'); ?></option>
	</select></td></tr>  <tr><td>
<!-- <p><?php _e("Plugin Purpose: " , 'genie-wp-matrimony' ); ?></p></td><td>
	<select id="displayTerm" name="displayTerm" width="55px" >
		<option value='matrimony' <?php echo $resultObj[2]; ?>>  <?php _e("Matrimony", 'genie-wp-matrimony'); ?> </option>
		<option value='dating' <?php echo $resultObj[3]; ?>>  <?php _e("Dating", 'genie-wp-matrimony'); ?> </option>
	</select></td></tr>  <tr><td>  -->
	<p><?php _e("User Login Preference: " , 'genie-wp-matrimony'); ?></p></td><td>	
	<input type="radio" name="loginPreferences" id="loginPreferences_1" value="1" <?php echo $resultObj[4]; ?> >
        	<label for="loginPreferences_1">
        			<?php _e("User should be registered and approved by Administrator", 'genie-wp-matrimony'); ?>
        	</label><br />
	<input type="radio" name="loginPreferences" id="loginPreferences_2" value="2" <?php echo $resultObj[5]; ?> ><label for="loginPreferences_2"><?php _e("User should be registered", 'genie-wp-matrimony'); ?></label><br />
	<input type="radio" name="loginPreferences" id="loginPreferences_3" value="3" <?php echo $resultObj[6]; ?> ><label for="loginPreferences_3"><?php _e("Anybody can view the profiles", 'genie-wp-matrimony'); ?></label>
	</td></tr> 
	<tr><td>
	<?php if(GWPM_ENABLE_DEBUGGING == true) {?>
	<p><?php _e("Developer mode enabled: ", 'genie-wp-matrimony'); ?></p></td><td>
		Logger Location: <?php echo  getLogDir(); ?>
	</td></tr>
	<?php } ?>
	<tr><td><p><?php _e("Frequently Asked Questions (FAQs)", 'genie-wp-matrimony'); ?></p></td><td>
	<ol>
	<li><?php _e("Register option not found?", 'genie-wp-matrimony'); ?><br /> <a target="_blank" href="<?php echo get_admin_url() . 'options-general.php#users_can_register' ?>"><?php _e("Click here to enable Registration", 'genie-wp-matrimony'); ?></a></li>
	<li><?php _e("Search result not displaying user picture?", 'genie-wp-matrimony'); ?><br /> <a target="_blank" href="<?php echo get_admin_url() . 'options-discussion.php#show_avatars' ?>"><?php _e("Click here to check Default Avatar Options", 'genie-wp-matrimony'); ?></a></li>
	<li><?php _e("Matrimonial menu not found?", 'genie-wp-matrimony'); ?><br /> <a target="_blank" href="<?php echo get_admin_url() . 'nav-menus.php' ?>"><?php _e("Click here to Manage your Menu items", 'genie-wp-matrimony'); ?></a></li>
	<li><?php 
	__("Matrimonial pages display data more than once?", 'genie-wp-matrimony'); 
	echo "<br /> "; 
	__("The problem might be because of the theme used. ", 'genie-wp-matrimony');
	__("Try to change the theme to Wordpress default and verify", 'genie-wp-matrimony'); 
	?> </li>
	</ol> </td></tr>
	</table>
	<?php
		if(isset($urlId)) {
			echo "<br /><br /><a href='" . get_site_url() . "?page_id=" . $urlId . "' target='_blank'>Click Here to go to Matrimonial Page.</a>";
		}
	?>
	<p class="submit">
	<input type="submit" name="SubmitForm" value="<?php _e('Update Options', 'genie-wp-matrimony' ) ?>" />
	</p>
</form>