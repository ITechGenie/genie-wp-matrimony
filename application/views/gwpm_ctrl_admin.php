<div class="wrap">
<?php
if (!function_exists('is_admin')) {
	header('Status: 403 Forbidden');
	header('HTTP/1.1 403 Forbidden');
	exit ();
}

global $wpdb;
global $matrimonyPostId;
screen_icon();
echo "<h2>" . __('Genie WP Matrimony Configuration', 'genie-wp-matrimony') . "</h2>";

if( isset( $_GET[ 'tab' ] ) ) {
	$active_tab = $_GET[ 'tab' ];  
	if ($active_tab != 'main_options' && $active_tab != 'dyna_options' 
	        && $active_tab != 'oauth10a_options' && $active_tab != 'stat_to_dyna_options' ) {
		$active_tab = "main_options" ;
	}
} else {
	$active_tab = "main_options" ;
}

$dynaTabUrl = "?page=gwpma&tab=dyna_options" ;
$statToDynaUrl = "?page=gwpma&tab=stat_to_dyna_options" ;
$mobileTabUrl = "?page=gwpma&tab=oauth10a_options" ;

if($active_tab == "main_options") {
	$gwpmSetupModel = new GwpmSetupModel();
	$urlId = $gwpmSetupModel->getMatrimonialId();
	
	if (isset($_POST['pluginSetup']) && $_POST['pluginSetup'] == 'yes') {
		$userPref = $_POST['loginPreferences'] ;
		$init_request[GWPM_USER_LOGIN_PREF] = $userPref ;
		$gwpmSetupModel->setupGWPMDetails($init_request);
		$setupStatus = true;
	} elseif (isset($_POST['pluginSetup']) && $_POST['pluginSetup'] == 'no') {		
		$gwpmSetupModel->removeGWPMDetails();
		$setupStatus = false;
	} else {
		$setupStatus = $gwpmSetupModel->checkSetupStatus();
	}
	
	appendLog("admin ctrl page: setupStatus " . $setupStatus) ;
	
	$resultObj[0] = "";
	$resultObj[1] = "";
	$resultObj[2] = "";
	$resultObj[3] = "";
	$resultObj[4] = "";
	$resultObj[5] = "";
	$resultObj[6] = "";
	
	if ($setupStatus) {
	    $resultObj[0] = "selected";
		$resultObj[1] = "";
		$resultObj[2] = "selected";
		$resultObj[4] = "checked='checked'";
		$user_pref = get_option(GWPM_USER_LOGIN_PREF) ;
		appendLog("admin ctrl page user_pref: " . $user_pref) ;
		if (!isset($user_pref)) {
			update_option (GWPM_USER_LOGIN_PREF, 1) ;
		} else {
			$user_pref = (int) $user_pref ;
			$resultObj[$user_pref + 3] = "checked='checked'";
		}
	} else {
		$resultObj[0] = "";
		$resultObj[1] = "selected";
		$dynaTabUrl = "#" ;
	}
}

?>
<div id="icon-themes" class="icon32"></div>
<h2 class="nav-tab-wrapper">  
	<a href="?page=gwpma&tab=main_options" class="nav-tab <?php echo $active_tab == 'main_options' ? 'nav-tab-active' : ''; ?>" >General Options</a>  
	<a href="<?php echo $dynaTabUrl ; ?>" class="nav-tab <?php echo $active_tab == 'dyna_options' ? 'nav-tab-active' : ''; ?>" >Dynamic Fields</a> 
	<a href="<?php echo $statToDynaUrl; ?>" class="nav-tab <?php echo $active_tab == 'stat_to_dyna_options' ? 'nav-tab-active' : ''; ?>" >Static to Dynamic Fields</a>
<!--	<a href="<?php echo $mobileTabUrl ; ?>" class="nav-tab <?php echo $active_tab == 'oauth10a_options' ? 'nav-tab-active' : ''; ?>" >Mobile Integration</a>   -->
</h2>

<div class="current-theme-new">

<button type="button" id="gwpm-faq-expander-id" class="gwpm-expander-header" >
					<span class="dashicons-before dashicons-editor-help">Frequently Asked Questions (FAQs)</span>
				<span id="gwpm-arrow-holder-id" class="dashicons dashicons-arrow-down"></span>
			</button>
			<div class="gwpm-seperator"> 
				<div id="gwpm-faqs-container-id" class="gwpm-faqs-container hidden">
				 <ol>
	<li><strong><?php _e("Register option not found?", 'genie-wp-matrimony'); ?></strong><br /> <a target="_blank" href="<?php echo get_admin_url() . 'options-general.php#users_can_register' ?>"><?php _e("Click here to enable Registration", 'genie-wp-matrimony'); ?></a></li>
	<li><strong><?php _e("Search result not displaying user picture?", 'genie-wp-matrimony'); ?></strong><br /> <a target="_blank" href="<?php echo get_admin_url() . 'options-discussion.php#show_avatars' ?>"><?php _e("Click here to check Default Avatar Options", 'genie-wp-matrimony'); ?></a></li>
	<li><strong><?php _e("Matrimonial menu not found?", 'genie-wp-matrimony'); ?></strong><br /> <a target="_blank" href="<?php echo get_admin_url() . 'nav-menus.php' ?>"><?php _e("Click here to Manage your Menu items", 'genie-wp-matrimony'); ?></a></li>
	<li><strong><?php _e("How to approve users?", 'genie-wp-matrimony'); ?></strong><br /> <a target="_blank" href="<?php echo get_admin_url() . 'admin.php?page=gpwmp_admin' ?>"><?php _e("Click here to Manage users", 'genie-wp-matrimony'); ?></a></li>
	<li><strong><?php _e("How to change file upload size?", 'genie-wp-matrimony'); ?></strong><br /><?php _e("File upload size is defaulted based on the php.ini settings", 'genie-wp-matrimony'); ?></li>
	<li><strong><?php _e("User not found in search?", 'genie-wp-matrimony'); ?></strong><br /> 
	<?php 
	_e("Administrators wont be shown in search results");
	echo "<br /> "; 
	_e("Create a new profile with Role 'Matrimony User' and try searching.", 'genie-wp-matrimony'); ?>
	</li>
	<li><strong><?php 
	_e("Matrimonial pages display data more than once?", 'genie-wp-matrimony'); 
	echo "</strong><br /> "; 
	_e("The problem might be because of the theme used or a conflicting plugin", 'genie-wp-matrimony');
	echo "<br /> "; 
	_e("Try to change the theme to Wordpress default or disable other plugins and test", 'genie-wp-matrimony'); 
	echo "<br /> "; 
	_e("Please report back with the incompatible theme/plugin for fixes if any", 'genie-wp-matrimony'); 
	?> </li>
	<li><strong><?php _e("Have more clarifications?", 'genie-wp-matrimony'); ?></strong><br /> <a target="_blank" href="http://itechgenie.com/myblog/genie-wp-matrimony/"><?php _e("Get Support", 'genie-wp-matrimony'); ?></a></li>
	</ol>
			</div> </div>

<?php 

if($active_tab == "main_options") {
	require_once 'admin/gwpm_ctrl_admin_main.php';
} elseif($active_tab == "dyna_options") {
	require_once 'admin/gwpm_ctrl_admin_dyna_fields.php';
} elseif($active_tab == "oauth10a_options") {
	require_once 'admin/gwpm_ctrl_admin_oauth10a.php';
} elseif($active_tab == "stat_to_dyna_options") {
    require_once 'admin/gwpm_ctrl_admin_statdyna.php';
}
?>
</div>

<script type="text/javascript">

	var isExpanded = false ;
             
	 jQuery(document).ready(function() {
		jQuery("#gwpm-faq-expander-id").live("click", function(obj){
			if (isExpanded) {
				jQuery("#gwpm-arrow-holder-id").removeClass("dashicons-arrow-up");
				jQuery("#gwpm-arrow-holder-id").addClass("dashicons-arrow-down");
				isExpanded = false ;
				jQuery("#gwpm-faqs-container-id").slideUp() ;
			} else {
				jQuery("#gwpm-arrow-holder-id").removeClass("dashicons-arrow-down");
				jQuery("#gwpm-arrow-holder-id").addClass("dashicons-arrow-up");
				isExpanded = true ;
				jQuery("#gwpm-faqs-container-id").slideDown() ;
			} 
		}) ;
	 });
			  
</script>

</div>