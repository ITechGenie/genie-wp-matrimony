<?php

/*
 
Author      : @kosso

Tested with Wordpress 4.7.1
WordPress REST API - OAuth 1.0a Server v.0.3.0 - https://en-gb.wordpress.org/plugins/rest-api-oauth1/

Description : Simple PHP test to obtain access_token and access_token_secret (Access tokens) from a Wordpress with WP-API and WP-OAuth plugins (and WP-CLI for OAuth consumer/app creation) installed.

*/

class OAuthWP
{
	function OAuthWP($config)
	{
		$this->key = $config['gwpm_oauth10a_client_key'];
		$this->secret = $config['gwpm_oauth10a_client_secret'];
		$this->uri_request = $config['gwpm_oauth10a_token_request'];
		$this->uri_authorize = $config['gwpm_oauth10a_token_authorize'];
		$this->uri_access = $config['gwpm_oauth10a_token_access'];
		$this->oauth_callback = $config['gwpm_oauth10a_callback_url'];
	}
	
	function queryStringFromData($data, $queryParams = false, $prevKey = '')
	{
		
		if ($initial = (false === $queryParams)) {
			$queryParams = array();
		}
		foreach ($data as $key => $value) {
			if ($prevKey) {
				$key = $prevKey.'['.$key.']'; // Handle multi-dimensional array
			}
			$queryParams[] = $this->_urlencode_rfc3986($key.'='.$value); // join with equals sign
		}
		if ($initial) {
			return implode('%26', $queryParams); // join with ampersand
		}
		return $queryParams;
	}
	
	function oauthRequest($url, $method, $oauth_access_token, $oauth_access_token_secret, $post_params=null, $post_json=false){
		
		$params = array(
				"oauth_version" => "1.0",
				"oauth_nonce" => md5(time().rand()),
				"oauth_timestamp" => time(),
				"oauth_consumer_key" => $this->key,
				"oauth_signature_method" => "HMAC-SHA1",
				"oauth_token" => $oauth_access_token
		);
		// Filter out empty params.
		$params = array_filter($params);
		
		// ## BUILD OAUTH SIGNATURE
		
		// Add extra params if present and not JSON
		if($post_params!=null && $post_json === false ){
			foreach ($post_params as $k => $v){
				
				if(is_array($v)){
					$iii = 0;
					appendLog('***** ARRAY ');
					foreach ($v as $kk => $vv){
						
						$params[$k][$iii] = $vv;
						$iii++;
					}
					
				} else {
					$params[$k] = $v;
				}
			}
			// Remove 'file' param from signature base string. Since the server will have nothing to compare it to. Also potentially exposes paths.
			unset($params['file']);
			ksort($params);
		}
		
		// Deal query with any query params in the request_uri
		$request_query = parse_url($url, PHP_URL_QUERY);
		$request_uri_parts = parse_url($url);
		
		$request_base_uri = $request_uri_parts['scheme'].'://'.$request_uri_parts['host'].$request_uri_parts['path'];
		
		$joiner = '?'; // used for final url concatenation down below
		if(!empty($request_query)){
			$joiner = '&';
			parse_str($request_query, $query_params);
			$params = array_merge($query_params, $params);
			ksort($params);
			
		}
		// Encode params keys, values, join and then sort.
		$keys = $this->_urlencode_rfc3986(array_keys($params));
		$values = $this->_urlencode_rfc3986(array_values($params));
		$params = array_combine($keys, $values);
		ksort($params);
		// Convert params to string
		foreach ($params as $k => $v) {
			$pairs[] = $this->_urlencode_rfc3986($k).'='.$this->_urlencode_rfc3986($v);
		}
		$concatenatedParams = implode('&', $pairs);
		$concatenatedParams = str_replace('=', '%3D', $concatenatedParams);
		$concatenatedParams = str_replace('&', '%26', $concatenatedParams);
		// Form base string (first key)
		// echo '<h4>concatenated params</h4><pre>'.$concatenatedParams.'</pre>';
		// base string should never use the '?' even if it has one in a GET query
		// See : https://developers.google.com/accounts/docs/OAuth_ref#SigningOAuth
		$baseString= $method."&".urlencode($request_base_uri)."&".$concatenatedParams;
		// Form secret (second key)
		$secret = urlencode($this->secret)."&".$oauth_access_token_secret; // concatentate the oauth_token_secret (null when doing initial '1st leg' request token)
		// Make signature and append to params
		appendLog('base : '.$baseString);
		
		appendLog('signature key : '.$secret);
		
		$params['oauth_signature'] = rawurlencode(base64_encode(hash_hmac('sha1', $baseString, $secret, TRUE)));
		// Re-sort params
		ksort($params);
		// Remove any added GET query parameters from the params to rebuild the string without duplication ..
		if(isset($query_params)){
			foreach ($query_params as $key => $value) {
				if(isset($params[$key])){
					unset($params[$key]);
				}
			}
			ksort($params);
		}
		// Remove any POST params so they get sent as POST data and not in the query string.
		if($post_params!=null && $post_json === false ){
			foreach ($post_params as $key => $value) {
				if(isset($params[$key])){
					unset($params[$key]);
				}
			}
			ksort($params);
		}
		// Build OAuth Authorization header from oauth_* parameters only.
		$post_headers = $this->buildAuthorizationHeader($params);
		// Convert params to string
		foreach ($params as $k => $v) {
			$urlPairs[] = $k."=".$v;
		}
		$concatenatedUrlParams = implode('&', $urlPairs);
		// The final url can use the ? query params....
		$final_url = $url; // original url. OAuth data will be set in the Authorization Header of the request, regardless of _GET or _POST (or _FILE)
		appendLog('Finalurl obtianed: ' . $final_url) ;
		// Request using cURL
		$json_response = $this->_http($final_url, $method, $post_params, $post_headers, $post_json);
		appendLog('Response obtained: ' ) ;
		appendLog ($json_response) ;
		// Result JSON
		return $json_response;
		
	}
	
	// Send Authorised Request Using Curl ///////////////////////////
	function _http($url, $method, $post_data = null, $oauth_headers = null, $post_json=false)
	{
		$ch = curl_init();
		
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		
		if($method=='POST')
		{
			curl_setopt($ch, CURLOPT_POST, 1);
			appendLog('POST');
			appendLog($post_data);
			
			if(isset($post_data['file'])){
				// Media upload
				$header[] = 'Content-Type: multipart/form-data';
				
				if(isset($oauth_headers)){
					array_push($header, $oauth_headers);
				}
				curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
			} else {
				
				if(isset($oauth_headers)){
					if($post_json===true){
						$header[] = 'Content-Type: application/json';
						array_push($header, $oauth_headers);
					} else {
						$header[] = $oauth_headers;
					}
					
					curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
				}
				
				
				if($post_json===true){
					curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
				} else {
					curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data); // application/x-www-form-urlencoded
				}
				
			}
			
		} else {
			
			// Not being used yet.
			if(isset($oauth_headers))
			{
				$header[] = $oauth_headers;
				curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
			}
		}
		
		$response = curl_exec($ch);
		$this->http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE); // 201 = 'Created'
		$this->last_api_call = $url;
		$this->response = $response;
		
		// echo "<br>status: ".$this->http_status."<br>";
		
		// appendLog('this');
		//  appendLog($this);
		
		curl_close($ch);
		
		return $response;
	}
	
	
	function _urlencode_rfc3986($input)
	{
		if (is_array($input)) {
			return array_map(array('OAuthWP', '_urlencode_rfc3986'), $input);
		}
		else if (is_scalar($input)) {
			return str_replace('+',' ',str_replace('%7E', '~', rawurlencode($input)));
		}
		else{
			return '';
		}
	}
	
	private function buildAuthorizationHeader($oauth){
		$r = 'Authorization: OAuth ';
		$values = array();
		foreach($oauth as $key => $value){
			$values[] = $key . '="' . rawurlencode($value) . '"';
		}
		$r .= implode(', ', $values);
		return $r;
	}
	
	
}