<?php
error_reporting(E_ALL ^ E_NOTICE); // hide site wide notices

/**
 * Malware Alert
 * A simple tool that checks the "malware" status of a domain in the Google safebrowsing API
 * 
 *  __  __       _                             _    _           _   
 * |  \/  | __ _| __      ____ _ _ __ ___     / \  | | ___ _ __| |_ 
 * | |\/| |/ _` | \ \ /\ / / _` | '__/ _ \   / _ \ | |/ _ | '__| __|
 * | |  | | (_| | |\ V  V | (_| | | |  __/  / ___ \| |  __| |  | |_ 
 * |_|  |_|\__,_|_| \_/\_/ \__,_|_|  \___| /_/   \_|_|\___|_|   \__|    
 *
 *
 * @author     Nick Peplow
 * @version    1
 * @package    malware-alert
 * @link       https://github.com/ekkamai/malware-alert
 */

/** @apikey you need to register for a google api key and update it below */

	$api_key = "AIzaSyAh3Po5slsBi7P-piZTxnHCIkkfd9ddH0k"; // e.g. XXXXXXXXXXXXXX-XXXXXXXXXXXX

/** @checks are the variables set correctly? */

	// grab the URL to check from the uri path
		$chk_url = $_GET['url'];

	// was the url set?
		if (empty($chk_url)) {
			exit("<h2>Domain not included in URL</h2>You must include it as a paramater in the url e.g. /check.php?url=ianfette.org");
		}
		
	// was the api key set?
		if (empty($api_key)) {
			exit("<h2>API key has not been set</h2>You must include it as a paramater in the url e.g. /check.php?url=ianfette.org");
		}

/** @sendpostdata the primary function that queries the api, along with the request content */
	
	// set the google api query url
	$api_url ="https://safebrowsing.googleapis.com/v4/threatMatches:find?key=".$api_key."";

	function sendPostData($api_url, $api_data){
	//curl the safebrowsing api
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $api_url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", 'Content-Length: ' . strlen($api_data)));
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $api_data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
	
	// return the result
		return $result;
	}
	
	// compose our request
	$api_data = "{
	  'client': {
	    'clientId': 'TestClient',
	    'clientVersion': '1.0'
	  },
	  'threatInfo': {
	    'threatTypes':      ['MALWARE', 'SOCIAL_ENGINEERING'],
	    'platformTypes':    ['WINDOWS'],
	    'threatEntryTypes': ['URL'],
	    'threatEntries': [
	      {'url': 'http://$chk_url'}
	    ]
	  }
	}";

/** @sendPostData primary function that queries */

	//run the API query
		$api_result = sendPostData($api_url, $api_data);
		
	//decode the json response
		$responseData = json_decode($api_result, TRUE);
		
	//find threat type
		$threat = $responseData["matches"][0]["threatType"];
		
		//was a threat type returned
		if (isset($threat))
			{
			// did it match a threat type?
			if ($threat == 'MALWARE') //malware?
				{
				$status = "STATUS:MALWARE";
				}
			elseif ($threat == 'SOCIAL_ENGINEERING') //social engineering?
				{
				$status = "STATUS:SOCIAL_ENGINEERING";
				}
			}
		  else
			{
			$status = "STATUS:CLEAN"; //didnt return with a threat, so lets assume its clean
			}  
		
		//echo out the status	
		echo $status;	
		
/** @logs primary function that queries */		
	
	//compose our log file contents
	$log  = "Domain: ".$chk_url.PHP_EOL.
			"Time: ".date("F j, Y, g:i a").PHP_EOL.
	        "Result: ".$status.PHP_EOL.
	        "-------------------------".PHP_EOL;
	//Save results to log
	file_put_contents('logs/log_'.date("j.n.Y").'.txt', $log, FILE_APPEND);
	
/** @debug fark, lets figure out what's going wrong. displays the full repsonse from google */


	
	// display the JSON dump
		//	echo "<pre>";
		//	var_dump($responseData);
		//	echo "</pre>";
	
?>