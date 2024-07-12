<?php
/*
 *  Consume APIs
 *
 */
class ConsumeApi
{
	/**
	 * Function to execute cURL
	 * 
	 * @param  string 	$url 		API call url
	 * @param  string 	$method 	metho to use [POST, GET, PUT, PATCH etc]
	 * @param  array 	$data 		data to be pass (optionat)
	 * 
	 * @return array object    		response data in array
	 * 
	 * @throws Exception If cURL request fails.
	 */
	public function curlcall($url, $method, $data = false, $auth_token = false)
    {

    	// to send data in JSON
    	if($data) 
    		$data = json_encode($data);

 		// init curl
		 $client = curl_init($url);

		 switch ($method) 
		 {

		 	case 'POST':
		 		curl_setopt($client, CURLOPT_POST, 1);
		 		if($data){
		 		curl_setopt($client, CURLOPT_POSTFIELDS, $data);
		 		}
		 		
		 		break;

		 	case 'PUT':
		 		curl_setopt($client, CURLOPT_CUSTOMREQUEST, "PUT");
		 		if($data){
				curl_setopt($client, CURLOPT_POSTFIELDS, $data);
				}
		 		break;

		 	case 'PATCH':		 		
		 		curl_setopt($client, CURLOPT_CUSTOMREQUEST, "PATCH");
		 		if($data){
				curl_setopt($client, CURLOPT_POSTFIELDS, $data);
				}
		 		break;

		 	case 'DELETE':		 		
		 		curl_setopt($client, CURLOPT_CUSTOMREQUEST, "DELETE");
				break;

		 	default:
		 		if($data)
		 		 	$url = sprintf("%s?%s", $url, http_build_query($data));
		 		break;
		 }


		// Options
		curl_setopt($client, CURLOPT_URL, $url);

		curl_setopt($client, CURLOPT_HTTPHEADER, array(
			'Content-Type:application/json',
			'Authorization: '. $auth_token
		));

		curl_setopt($client,CURLOPT_RETURNTRANSFER,true);


		// execute curl
		$response = curl_exec($client);

		// throw exception if fails
		if(curl_errno($client)){

        	throw new Exception(curl_error($client));
    	}

		// close curl resource to free up system resources
		curl_close($client);
		

		// decode JSON responce into array
		 $result = json_decode($response);

		 // return response 
		 return $result;
    }

}