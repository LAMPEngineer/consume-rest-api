<?php

/**
 *  Request handler that route request to right place.
 *  It calls action of the controller and return back
 *  response in right format as requested.
 *  
 */
class RequestController
{
	/**
	 * request url elements
	 * @var string
	 */
	public $url_elements;


	/**
	 * controller name
	 * @var string
	 */
	public $controller_name;

	/**
	 * action name
	 * @var string
	 */
	public $action_name;

	/**
	 * resource id if available else null
	 * 
	 * @var integer
	 */
	public $resource_id;

	/**
	 * result of request
	 * @var string
	 */
	public $result;



	/**
	 * constructor to get incoming request
	 */
	public function __construct()
	{
		//get the request URI
		$this->url_elements = explode('/', $_SERVER['REQUEST_URI']);
		array_shift($this->url_elements); // remove first value as it's empty
		array_shift($this->url_elements); // remove second value as it's empty

		if($this->parseUri()){
		// to route the request
		$this->result = $this->requestRoute();	

		}
	}

	/**
	 *  to parse requsted URI and get controller, action and resource ID
	 *  
	 * @return boolean 
	 */
	private function parseUri(): bool
	{
		// parse URI and get the controller, action and resource ID
		$this->controller_name = ucfirst($this->url_elements[1]) . 'Controller';

		$this->action_name = (!empty($this->url_elements[2]))?$this->url_elements[2]:'index';

		$this->resource_id = (!empty($this->url_elements[3]))?$this->url_elements[3]:null;
		return true;
	}

	/**
	 * route the request to the right place
	 * 
	 * @return string  to view as output
	 */
	private function requestRoute()
	{
		// check if controller exists
		if(class_exists($this->controller_name)){
	
			$controller = new $this->controller_name();

			// get action
			$action_name = strtolower($this->action_name);

			$action = $action_name.'Action';

			// call action
			$result = $controller->$action($this->resource_id);	

			return $result;

		}
	}

}