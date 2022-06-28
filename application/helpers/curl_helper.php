<?php
if(!function_exists('curl')){
    function curl($a,$data = array()){
    	$ch = curl_init();
    	curl_setopt($ch, CURLOPT_URL, $a);
		if(isset($data['post'])) curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data['post']));
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    	curl_setopt($ch, CURLOPT_HEADER, false);
    	if(isset($data['header'])) curl_setopt($ch, CURLOPT_HTTPHEADER, $data['header']);
    	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    	$isle = curl_exec($ch);
    	curl_close($ch);
    	return $isle;

    }
}

function bayi_request($uri,$data = array())
{
    $postData = (isset($data['post'])) ? $data['post'] : array();
    $access_token = '%7Fe~*F/,^6+v$E)';
    $baseuri = "https://bayi.alfemo.com.tr/dealers/api";
    $finaluri = $baseuri.'/'.$uri;
    $headers[] = 'Authorization: Bearer '.$access_token;
    
    $response = curl($finaluri,array('post' => $postData, 'header' => $headers));
    $response = json_decode($response);
    return $response;
}

function franchise_request($uri,$data = array())
{
    $postData = (isset($data['post'])) ? $data['post'] : array();
    $access_token = '%7Fe~*F/,^6+v$E)';
    $baseuri = "https://franchise.alfemo.com.tr/dealers/api";
    $finaluri = $baseuri.'/'.$uri;
    $headers[] = 'Authorization: Bearer '.$access_token;

    $response = curl($finaluri,array('post' => $postData, 'header' => $headers));
    $response = json_decode($response);
    return $response;
}

function api_update_dealers($uri)
{
    $response1 = bayi_request($uri,array('post' => $_POST));
    $response2 = franchise_request($uri,array('post' => $_POST));
    $result = array('bayi' => $response1, 'franchise' => $response2);
    return $result;
}

if(!function_exists('getAuthorizationHeader')) {
	function getAuthorizationHeader(){
        $headers = null;
        if (isset($_SERVER['Authorization'])) {
            $headers = trim($_SERVER["Authorization"]);
        }
        else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
            $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
        } elseif (function_exists('apache_request_headers')) {
            $requestHeaders = apache_request_headers();
            // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
            $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
            //print_r($requestHeaders);
            if (isset($requestHeaders['Authorization'])) {
                $headers = trim($requestHeaders['Authorization']);
            }
        }
        $headers = str_replace('Bearer ','',$headers);
        return $headers;
    }
}