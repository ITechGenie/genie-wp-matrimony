<?php
if (! function_exists ( 'is_admin' )) {
	header ( 'Status: 403 Forbidden' );
	header ( 'HTTP/1.1 403 Forbidden' );
	exit ();
}

echo "<h3>" . __( 'Application OAuth 1.0a Credentials', 'genie-wp-matrimony' ) . "</h3>";

$formSubmitted = $_POST ['formSubmitted'];
if ($formSubmitted != null) {
	$gwpmOauth10aClientKey = $_POST ['oauth10aClientKey'];
	$gwpmOauth10aClientSecret = $_POST ['oauth10aClientSecret'];
	$oauth10aDomain= $_POST ['oauth10aDomain'];
	$oauth10aRestApiPath= $_POST ['oauth10aRestApiPath'];
	$oauth10aTokenRequestAPI= $_POST ['oauth10aTokenRequestAPI'];
	$oauth10aTokenAccessAPI= $_POST ['oauth10aTokenAccessAPI'];
	$oauth10aTokenAuthorizeAPI= $_POST ['oauth10aTokenAuthorizeAPI'];
	$oauth10aCallBackURI= $_POST ['oauth10aCallBackURI'];
	
	$save_options = null ;
	
	$save_options['gwpm_oauth10a_client_key'] =  $gwpmOauth10aClientKey ;
	$save_options['gwpm_oauth10a_client_secret'] =  $gwpmOauth10aClientSecret;
	$save_options['gwpm_oauth10a_domain'] =  $oauth10aDomain;
	$save_options['gwpm_oauth10a_api_url'] =  $oauth10aRestApiPath;
	$save_options['gwpm_oauth10a_token_request'] =  $oauth10aTokenRequestAPI;
	$save_options['gwpm_oauth10a_token_access'] =  $oauth10aTokenAccessAPI;
	$save_options['gwpm_oauth10a_token_authorize'] =  $oauth10aTokenAuthorizeAPI;
	$save_options['gwpm_oauth10a_callback_url'] =  $oauth10aCallBackURI;
	
	if (isset( $save_options )) {
		appendLog ( print_r ( $save_options, true ) );
		$adminModel = new GwpmAdminModel ();
		$resultVal = $adminModel->saveOAuth10aFields( $save_options);
		if ($resultVal> 0)
			$result = "Config updated !" ;
		else 
			$result= "Config Not Updated !" ; 
	} else {
		$result= "Invalid input, Please try again !" ; 
	}
}

$existingRecords = get_option ( GWPM_OAUTH_10A_CONFIG );
if (isset ( $existingRecords )) {
	$gwpmOauth10aClientKey = $existingRecords ['gwpm_oauth10a_client_key'];
	$gwpmOauth10aClientSecret = $existingRecords ['gwpm_oauth10a_client_secret'];
}

?>

<form name="gwpm_form" method="post"
	action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
	<input type="hidden" name="formSubmitted" value="Y">
	<table class='widefat gwpm-search-result'>
		<tr>
			<td width="260px;">
				<p><?php _e("Steps to obtain OAuth1.0a Credentials: " , 'genie-wp-matrimony'); ?></p>
			</td>
			<td>
			<p>
				1. Install the <a href="https://wordpress.org/plugins/rest-api-oauth1/">WordPress REST API - OAuth 1.0a Server</a> Plugin from Wordpress Plugins<br />
				2. Activate the plugin after installations <br />
				3. Go to Wordpress Admin Dashboard -> Users -> Applications <br />
				4. Add "New Application" with Consumer Name "Genie WP Matrimony Authorizer", provide your own Description <br />
				5. Please enter the callback as this: <strong><?php echo get_admin_url() . 'admin.php?page=gpwmp_oauth10a' ?></strong> <br />
				6. Click "Add Customer" and submit the form <br />
				7. Copy and paste the "Client Key" and "Client Secret" values as it is in the below fields <br />
				8. Please leave the other values untoched, unless there are changes in the config <br />
				9. Click "Update Options" to save the config<br />
			</p>			
			</td>
		</tr>
		<tr>
			<td>
				<p><?php _e("Client Key: ", 'genie-wp-matrimony'); ?></p>
			</td>
			<td><input type="text" name="oauth10aClientKey" style="width: 200px;"
				value="<?php echo $gwpmOauth10aClientKey; ?>" /></td>
		</tr>
		<tr>
			<td>
				<p><?php _e("Client Secret: ", 'genie-wp-matrimony'); ?></p>
			</td>
			<td ><input type="text" name="oauth10aClientSecret"style="width: 200px;"
				value="<?php echo $gwpmOauth10aClientSecret; ?>" /></td>
		</tr>
		<tr>
			<td>
				<p><?php _e("Rest API Domain: ", 'genie-wp-matrimony'); ?></p>
			</td>
			<td><input type="text" name="oauth10aDomain" style="width: 200px;"
				value="<?php echo get_site_url(); ?>"   /></td>
		</tr>
		<tr>
			<td>
				<p><?php _e("Rest API Path: ", 'genie-wp-matrimony'); ?></p>
			</td>
			<td><input type="text" name="oauth10aRestApiPath" style="width: 200px;"
				value="/wp-json/wp/v2"   /></td>
		</tr>
		<tr>
			<td>
				<p><?php _e("Temp Token Request API: ", 'genie-wp-matrimony'); ?></p>
			</td>
			<td><input type="text" name="oauth10aTokenRequestAPI" style="width: 300px;"
				value="<?php echo get_site_url() . '/oauth1/request' ; ?>"  /></td>
		</tr>
		<tr>
			<td>
				<p><?php _e("Temp Token Authorize API: ", 'genie-wp-matrimony'); ?></p>
			</td>
			<td><input type="text" name="oauth10aTokenAuthorizeAPI" style="width: 300px;"
				value="<?php echo get_site_url() . '/oauth1/authorize' ; ?>"   /></td>
		</tr>
		<tr>
			<td>
				<p><?php _e("Temp Token Access API: ", 'genie-wp-matrimony'); ?></p>
			</td>
			<td><input type="text" name="oauth10aTokenAccessAPI" style="width: 300px;"
				value="<?php echo get_site_url() . '/oauth1/access' ; ?>"   /></td>
		</tr>
		<tr>
			<td>
				<p><?php _e("Callback URL: ", 'genie-wp-matrimony'); ?></p>
			</td>
			<td><input type="text" name="oauth10aCallBackURI" style="width: 300px;"
				value="<?php echo get_admin_url() . 'admin.php?page=gpwmp_oauth10a'; ?>"   /></td>
		</tr>
	</table>
	<p class="submit">
		<input type="submit" name="SubmitForm"
			value="<?php _e('Update Options', 'genie-wp-matrimony' ) ?>" />
			<?php 
			if (isset($result)) {
				_e($result, 'genie-wp-matrimony');
			}
			?>
	</p>
</form>