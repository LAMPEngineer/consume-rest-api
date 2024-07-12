<?php
/**
 *  parent controller
 *  it gets config properties 
 */
class MyController
{
	/**
	 * config variable
	 * @var string
	 */
	public $config='';

	/**
	 * to hold object of Handle API
	 * 
	 * @var object
	 */
	public $apihandler;

	/**
	 * initialize config 
	 */
	public function __construct()
	{
		// config 		
		$this->config = ucfirst('property') . 'Config';

		$this->apiHandle();

	}

	/**
	 * to get view object
	 * 
	 * @param  string $view_name 
	 * @param  array  $content
	 * @return string HTML       
	 */
	public function getView(string $view_name, $content=null): string
	{
		// view 
		$view_name = ucfirst($view_name) . 'View';

		if(class_exists($view_name)){

			$view = new $view_name();	
		}

		$response = $view->render($content);

		return $response;

	}

	/**
	 * create object of api handler 
	 * 
	 * @return void
	 */
	public function apiHandle(): void
	{
		$api_handler = ucfirst('Handle') . 'Api';
		
		if(class_exists($api_handler)){
			// get api handler
			$this->apihandler = new $api_handler();
		} 
	}

}