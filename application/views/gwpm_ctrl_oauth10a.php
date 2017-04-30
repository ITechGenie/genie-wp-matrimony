<?php
/*
 * Created on Apr 14, 2017
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
?>

<div class="wrap">
	<script type="text/javascript">
	var showCanvasForQR = false;
</script>
<?php

echo "<h2>" . __('Matrimonial Profile OAuth1.0a Config', 'genie_wp_matrimony') .
         "</h2>";

$removeConfig = $_GET['removeToken'];
$testToken = $_GET['testToken'];

if (isset($testToken) && $testToken== true) {
    
    $oauth10aUserConfig = get_user_option('oauth_access_token');
    appendLog($oauth10aUserConfig) ;
    $auth = new OAuthWP($oauth10aUserConfig);
    appendLog('Using new tokens: ' . $oauth10aUserConfig['gwpm_oauth10a_oauth_token_secret'] . ', ' . $oauth10aUserConfig['gwpm_oauth10a_oauth_token']) ;
    $respObject = $auth->oauthRequest( get_site_url() .  $oauth10aUserConfig['gwpm_oauth10a_api_url'] . '/users/me','GET', $oauth10aUserConfig['gwpm_oauth10a_oauth_token'], $oauth10aUserConfig['gwpm_oauth10a_oauth_token_secret']);
    appendLog ($current_user_object) ;
    echo ('<strong>User Info API Response: </strong><pre>' . json_encode(json_decode($respObject),  JSON_PRETTY_PRINT) . '</pre>');
    
} elseif (isset($removeConfig) && $removeConfig == true) {
    
    $confirmVal = $_GET['confirm'];
    
    if (isset($confirmVal) && $confirmVal== true) {
        delete_user_option(get_current_user_id(),
                "oauth_access_token");
        echo ("<h4>OAuth1.0a Token Config Remvoed !");
        echo '<h4/>';
    } else {
        
        echo ("<h4>Remove current config Token ? ");
        echo '<h4/>';
        echo 'Note: This does not mean your Generated Token is invalidated. The tokens can still be used by the authorized applications.<br />';
        echo "Click <a href='" . get_admin_url() .
                 "profile.php#admin_bar_front'>HERE</a> to Revoke access and generate new Token from Authorized Applications.";
        echo "<br /><br />";
        echo ("<a href='" . get_admin_url() .
                 "admin.php?page=gpwmp_oauth10a&removeToken=true&confirm=true'><button type='button'
            class='button button-primary' >Yes</button></a> &nbsp;&nbsp; <a href='" .
                 get_admin_url() . "admin.php?page=gpwmp_oauth10a'><button type='button'
            class='button button-primary' >Cancel</button></a><br />");
    }
} else {
    
    $adminModel = new GwpmAdminModel();
    
    $oauth10aUserConfig = get_user_option('oauth_access_token');
    
    appendLog ('first fetch of configs !!') ;
    appendLog($oauth10aUserConfig) ;
    
    if (isset($oauth10aUserConfig) && $oauth10aUserConfig != null) {
        
        gwpm_echo("<strong>User is authorized for the APP !");
        echo '<br /><br />';
        gwpm_echo(
                "<a href='" . get_admin_url() .
                         "admin.php?page=gpwmp_oauth10a&testToken=true'><button type='button'
            class='button button-primary' >Test Token</button></a>&nbsp;&nbsp;&nbsp;<a href='" . get_admin_url() .
                         "admin.php?page=gpwmp_oauth10a&removeToken=true'><button type='button'
            class='button button-primary' >Remove OAuth1.0a config</button></a>");
        echo '<br /><br />Note: This does not mean your Generated Token is invalidated. The tokens can still be used by the authorized applications. ';
        gwpm_echo(
                "Click <a href='" . get_admin_url() .
                         "profile.php#admin_bar_front'>HERE</a> to Revoke access and generate new Token from Authorized Applications.");
        echo '<br />';
        echo '<br /><hr />';
        gwpm_echo(
                "Scan below code to configure Genie WP Matrimony mobile application.</strong>");
        echo '<br />';
        
        /**
         * Generating QRCode *
         */
        appendLog('Printing QR Codes ');
        appendLog($oauth10aUserConfig);
        
        $svgCode = $adminModel->getQRinSVG($oauth10aUserConfig);
        
        echo $svgCode;
        echo '<br />';
        echo "<script>showCanvasForQR=true;</script>";
    
    /**
     * QR Code Generator ends *
     */
    } else {
        
        $oauth10aConfig = $adminModel->getGwpmOption(GWPM_OAUTH_10A_CONFIG);
        appendLog('Obtained oAuthDetails: ');
        appendLog($oauth10aConfig);
        $auth = new OAuthWP($oauth10aConfig);
        
        if (isset($_REQUEST['oauth_token']) && isset(
                $_REQUEST['oauth_verifier'])) {
            appendLog('Using existing token from request: ');
            appendLog($_REQUEST);
            $temp_oauth_token = $_REQUEST['oauth_token'];
            $oauthVerifier = $_REQUEST['oauth_verifier'] ;
            $request_data = array(
                    'oauth_verifier' => $oauthVerifier
            );
            // $temp_secret = $auth->oauth_token_secret ;
            $temp_secret = get_user_option("oauth_temp_token_secret", 
                    get_current_user_id());
            appendLog('Calling access url ' . $auth->uri_access);
            $access_token_string = $auth->oauthRequest($auth->uri_access, 
                    'POST', $temp_oauth_token, $temp_secret, $request_data);
            appendLog('Obtained new tokens ');
            appendLog($access_token_string);
            parse_str($access_token_string, $access_tokens);
            
            if (! isset($access_tokens['oauth_token'])) {
                
                echo '<h3>ERROR: Failed to get access tokens</h3>';
                appendLog($access_tokens);
                echo '<hr>';
                appendLog($access_token_string);
            } else {
                $access_token = $access_tokens['oauth_token'];
                $access_token_secret = $access_tokens['oauth_token_secret'];
                
                $oauth10aConfig['gwpm_oauth10a_oauth_token'] = $access_token;
                $oauth10aConfig['gwpm_oauth10a_oauth_token_secret'] = $access_token_secret;
                $oauth10aConfig['gwpm_oauth10a_oauth_verifier'] = $oauthVerifier;
                
                appendLog('New Keys tokens: ');
                appendLog($oauth10aConfig);
                
                update_user_option(get_current_user_id(), "oauth_access_token", 
                        $oauth10aConfig, null);
                
                echo '<strong>OAuth API token udpated, Please wait while loading QR code !</strong>';
                
                echo "<meta http-equiv='refresh' content='2;URL=\"" . get_admin_url() .
                 "admin.php?page=gpwmp_oauth10a\" />    ";
                
                delete_user_option(get_current_user_id(), 
                        "oauth_temp_token_secret");
            }
        } else {
            if (isset($oauth10aConfig)) {
                appendLog(
                        "Config found: " .
                                 $oauth10aConfig['gwpm_oauth10a_client_key']);
                appendLog('Baseurl: ' . $auth->uri_request);
                $request_token_string = $auth->oauthRequest($auth->uri_request, 
                        'POST', null, null);
                appendLog($request_token_string);
                parse_str($request_token_string, $request_parts);
                
                update_user_option(get_current_user_id(), 
                        "oauth_temp_token_secret", 
                        $request_parts['oauth_token_secret'], null);
                
                echo '<h3><a href="' . $auth->uri_authorize . '?' .
                         $request_token_string . '&oauth_callback=' .
                         urlencode($auth->oauth_callback) .
                         '">Click Here to Authorize Genie WP Matrimony</a></h3>';
                
            } else {
                $userMsg = "OAuth1.0a config not found. Please contact your Administrator !";
            }
        }
    }
}

?>

<div id="icon-themes" class="icon32"></div>

	<div class="current-theme-new">
	<?php

if (isset($userMsg)) {
    echo '<br /><h3>';
    gwpm_echo($userMsg);
    echo '</h3>';
}

?>

<div id="canvasForQRImageID" style="display: none;">
			<canvas id="qr_code_canvas_id" height="250px"></canvas>
			<br /> <br /> <a id="download" download="image.png"><button
					type="button" class="button button-primary" onClick="download()">Download
					Image</button></a>
		</div>
	</div>

	<script type="text/javascript">

	var svgObject = null ;
	var canvasObject = null ;
	var canvasContainerObject = null ;

	function download(){
        var download = document.getElementById("download");
        var image = canvasObject.toDataURL("image/png")
                    .replace("image/png", "image/octet-stream");
        download.setAttribute("href", image);
    }
    
	function paintSvgToCanvas(uSvg, uCanvas) {

        var pbx = new Image(); // document.createElement('img');
        var ctx = uCanvas.getContext('2d') ;
    
        pbx.style.width  = uSvg.style.width;
        pbx.style.height = uSvg.style.height;

        console.log (uSvg.outerHTML) ;
    
        pbx.src = 'data:image/svg+xml;base64,' + window.btoa(uSvg.outerHTML);
        console.log ( pbx.src ) ;
        
        pbx.onload = function() {
            // after this, Canvas’ origin-clean is DIRTY
            ctx.drawImage(pbx, 0, 0);
        }
        
	}

    jQuery(document).ready(function() {
        if ( showCanvasForQR ) {
            svgObject = document.getElementById('gwpm_user_config_id') ;
            canvasObject = document.getElementById('qr_code_canvas_id') ;
            canvasContainerObject = document.getElementById('canvasForQRImageID') ;
            	
            paintSvgToCanvas(svgObject, canvasObject);
            svgObject.style.display = "none";
            canvasContainerObject.style.display = "block";
        } else {
        	canvasContainerObject.style.display = "none";
        }
    });

	</script>

</div>