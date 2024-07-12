<?php
/*
 *  API handler
 *
 */
class HandleApi
{

	/**
	 * $url to call API
	 * 
	 * @var string
	 */
	private $url='';


	/**
	 * method to be use for api call
	 * POST, GET, PUT etc
	 * 
	 * @var string
	 */
	private $method='';

	/**
	 * This is optional, if data need to 
	 * pass with api call
	 * 
	 * @var array
	 */
	private $data = [];


	/**
	 * Call API with url. This uses cURL to call api.
	 * 
	 * @return array 	data on success 	 i.e 1
	 *         string 	message on unsuccess i.e 0
	 *         
	 * @catch exception if fails.
	 */
	public function callAPI($url, $method, $data = false)
    {

		$this->url = $url;

		$this->method = $method;

		$this->data = $data;

    	// curl client class
    	$consumeapi = new ConsumeApi();
    	
    	try{
			$response = $consumeapi->curlcall($this->url, $this->method, $this->data);

			} catch(\Exception $e){

			echo $e->getMessage();
			}

    	//if success i.e 1
    	if($response->status){
    		//data
    		$return = (!empty($response->data))?$response->data:$response->message;
    		return $return;

    	} else {
    			//error message
    		return $response->message;
    	}


    }



}