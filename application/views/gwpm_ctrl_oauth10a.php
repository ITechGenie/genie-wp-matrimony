<?php
/*
 * Created on Apr 14, 2017
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
?>

<div class="wrap">
<?php

echo "<h2>" . __ ( 'Matrimonial Profile OAuth1.0a Config', 'genie_wp_matrimony' ) . "</h2>";

$adminModel = new GwpmAdminModel ();

$oauth10aUserConfig = get_user_option ('oauth_access_token') ; 

if (isset($oauth10aUserConfig)) {
	$userMsg = "User is already authorized for the APP !" ;
} else {

$oauth10aConfig = $adminModel->getGwpmOption(GWPM_OAUTH_10A_CONFIG);
appendLog ('Obtained oAuthDetails: ') ;
appendLog ($oauth10aConfig) ;
$auth = new OAuthWP($oauth10aConfig);

if(isset( $_REQUEST['oauth_token'] ) && isset( $_REQUEST['oauth_verifier'] )) {
	appendLog('Using existing token from request: ') ; 
	appendLog($_REQUEST) ;
	$temp_oauth_token =  $_REQUEST['oauth_token']  ;
	$request_data = array(
			'oauth_verifier' => $_REQUEST['oauth_verifier']
	);
	//$temp_secret = $auth->oauth_token_secret ;
	$temp_secret =  get_user_option( "oauth_temp_token_secret",  get_current_user_id() );
	appendLog('Calling access url ' . $auth->uri_access ) ;
	$access_token_string = $auth->oauthRequest($auth->uri_access,'POST', $temp_oauth_token, $temp_secret, $request_data);
	appendLog ( 'Obtained new tokens ' );
	appendLog($access_token_string) ;
	parse_str($access_token_string, $access_tokens);
	
	if(!isset($access_tokens['oauth_token'])){
		
		echo '<h3>ERROR: Failed to get access tokens</h3>';
		appendLog($access_tokens);
		echo '<hr>';
		appendLog($access_token_string);
	} else {
		$access_token = $access_tokens['oauth_token'];
		$access_token_secret = $access_tokens['oauth_token_secret'];
		
		$oauth10aConfig['gwpm_oauth10a_oauth_token'] =  $access_token;
		$oauth10aConfig['gwpm_oauth10a_oauth_token_secret'] =  $access_token_secret;
		
		/* setcookie("access_token", $access_token, time() + (3600 * 72), "/" );              
		setcookie("access_token_secret", $access_token_secret, time() + (3600 * 72), "/" ); 
		setcookie("oauth_token_secret", "", time() - 1, "/" );  */
		
		appendLog('New Keys tokens: ') ;
		appendLog($oauth10aConfig) ;
		
		// $adminModel->saveOAuth10aFields($oauth10aConfig) ;
		update_user_option( get_current_user_id(), "oauth_access_token", $oauth10aConfig, null );
		
		echo 'OAuth API token udpated !' ;
		
		delete_user_option( get_current_user_id(), "oauth_temp_token_secret" ) ;
	}
	
} else {
	if (isset($oauth10aConfig)) {
		appendLog ("Config found: " .  $oauth10aConfig['gwpm_oauth10a_client_key'] ) ;
		appendLog('Baseurl: ' . $auth->uri_request  ) ;
		$request_token_string = $auth->oauthRequest($auth->uri_request,'POST', null, null);
		appendLog ( $request_token_string ) ;
		parse_str($request_token_string, $request_parts);
		// setcookie("oauth_token_secret", $request_parts['oauth_token_secret'], time() + 60, "/" ); 
		
		update_user_option( get_current_user_id(), "oauth_temp_token_secret",$request_parts['oauth_token_secret'], null );
		
		echo '<h3><a href="'.$auth->uri_authorize.'?'.$request_token_string.'&oauth_callback='.urlencode($auth->oauth_callback).'">Click Here to Authorize Genie WP Matrimony</a></h3>';
	} else {
		$userMsg = "OAuth1.0a config not found. Please contact your Administrator !" ;
	}
}

}

?>

<div id="icon-themes" class="icon32"></div>

	<div class="current-theme-new">
	<?php 
	
	if (isset($userMsg)) {
		echo '<br /><h3>' ;
		gwpm_echo($userMsg) ;
		echo '</h3>';
	}
	?>
	</div>
	
</div>