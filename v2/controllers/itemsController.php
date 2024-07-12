<?php

/*
 *  Items controller to have actions for items
 */
class ItemsController extends MyController implements ControllerInterface
{

	/**
	 * initialize config 
	 */
	public function __construct()
	{
		parent::__construct();
		$this->api_url = $this->config::ITEM_API_URL_V2;
		$this->microservice = 'items';
	}



	/**
	 * after submit edited data, it comes here for update action
	 * and sends data through api handler
	 * 
	 * @return string view HTML
	 */
	public function updateAction(): string
	{
		if(!empty($_POST)){

			// collect POST data and make data array
			$resource_id			= (int)$_POST['id'];
			$data['id']				= $resource_id;
			$data['name']			= htmlspecialchars(strip_tags($_POST['name']));
			$data['description']	= htmlspecialchars(strip_tags($_POST['description']));
			
			$this->data = $data;
			$response = parent::updateAction();
			
		}
		
		return $response;		
	}



	/**
	 * to add a new resource 	 
	 * 
	 * @return string response
	 */
	public function addAction(): string
	{
		// get view and render
		$response = $this->getView('add');

		if(!empty($_POST)){
			$data['name']			= htmlspecialchars(strip_tags($_POST['name']));
			$data['description']	= htmlspecialchars(strip_tags($_POST['description']));
			$this->data = $data;

			$response = parent::addAction();	

		}

		return $response;
	}


}