<?php
/**
 *  parent controller
 *  it gets config properties 
 */
class MyController
{
	/**
	 * config variable
	 * 
	 * @var string
	 */
	protected $config='';

	/**
	 * to hold object of Handle API
	 * 
	 * @var object
	 */
	protected $apihandler;

	/**
	 * to hold api url
	 * 
	 * @var string
	 */
	protected $api_url;

	/**
	 * to hold jwt token
	 * 
	 * @var string
	 */
	protected $jwt_token;

	/**
	 * to hold microservice name
	 * i.e items, users, etc.
	 * 
	 * @var string
	 */
	protected $microservice;

	/**
	 * to hold data array to be post with
	 * api call
	 * 
	 * @var array
	 */
	protected $data;


	/**
	 * initialize config 
	 */
	public function __construct()
	{
		// config 		
		$this->config = ucfirst('property') . 'Config';

		$this->apiHandle();

		$this->api_url = $this->config::ITEM_API_URL_V2;

	}

	// setter & getter
	public function setToken($jwt_token){$this->jwt_token = $jwt_token; }
	public function getToken(){ return $this->jwt_token; }




	/**
	 * to get all resources by api call
	 * and list it in view template
	 * 
	 * @return string view HTML
	 */
	public function indexAction(): string
	{
		$url = $this->api_url;			
		$method = 'GET';

		// api call		
		$content = $this->apihandler->callAPI($url, $method, false, $this->jwt_token);

		$response  = (is_array($content)) ? $this->getView('index', $content) : $content;
		
		return $response;
	}



	/**
	 * to get resource by id with api call
	 * and show it in view template
	 *
	 * @param  int  $resource_id
	 * 
	 * @return string view HTML
	 */
	public function getAction($resource_id): string
	{

		$url = $this->api_url;	
		$url .= '/'.$resource_id;		
		$method = 'GET';
		
		// api call
		$content = $this->apihandler->callAPI($url, $method, false, $this->jwt_token);

		// get view and render
		$response = (is_object($content))? $this->getView('get', $content) : $content;		
			
		return $response;
	}


    /**
	 * Edit resource by id. It pre populate data in view template
	 * once post, it goes to update action
	 *
	 * @param  int  $resource_id
	 * 
	 * @return string view HTML
	 */
	public function editAction($resource_id): string
	{
		$url = $this->api_url;	
		$url .= '/'.$resource_id;		
		$method = 'GET';
		
		// api call
		$content = $this->apihandler->callAPI($url, $method, false, $this->jwt_token);

		// get view and render
		$response = (is_object($content))? $this->getView('get', $content) : $content;
		// get view and render
		$response = $this->getView('edit', $content);
			
		return $response;
	}



	/**
	 * after submit edited data, it comes here for update action
	 * and sends data through api handler
	 * 
	 * @return string view HTML
	 */
	public function updateAction(): string
	{

		$url = $this->api_url;	
		$url .= '/'.$this->data['id'];
		// HTTP method
		$method = 'PATCH';

		// api call
		$content = $this->apihandler->callAPI($url, $method, $this->data, $this->jwt_token);

		// responce
		$response = (is_object($content))? $content : $content;
		
		$response .= "<br/><br/><a href=./../". $this->microservice ."/get/".$this->data['id'].">Show updation</a>";


		return $response;
	}



	/**
	 * to delete resource by id with api call	 
	 *
	 * @param  int  $resource_id
	 * 
	 * @return string response
	 */
	public function deleteAction($resource_id): string
	{
		$url = $this->api_url;	
		$url .= '/'.$resource_id;
		$method = 'DELETE';

		// api call
		$response = $this->apihandler->callAPI($url, $method, false, $this->jwt_token);
		$response .= "<br/><br/><a href=./../../". $this->microservice .">Go Back</a>";
		
		return $response;
	}



	/**
	 * to add a new resource 	 
	 * 
	 * @return string response
	 */
	public function addAction(): string
	{
		$url = $this->api_url;	
		// HTTP method
		$method = 'POST';

		// api call
		$response = $this->apihandler->callAPI($url, $method, $this->data, $this->jwt_token);

		$response .= "<br/><br/><a href=./../". $this->microservice .">Go Back</a>";	

		return $response;
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

		$response = $view->render($content, $this->microservice);

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