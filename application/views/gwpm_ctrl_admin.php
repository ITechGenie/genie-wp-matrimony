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
	
	if ($setupStatus) {
		$resultObj[1] = "";
		$resultObj[0] = "selected";
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
	<a href="<?php echo $mobileTabUrl ; ?>" class="nav-tab <?php echo $active_tab == 'oauth10a_options' ? 'nav-tab-active' : ''; ?>" >Mobile Integration</a>
</h2>

<div class="current-theme-new">

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

</div>