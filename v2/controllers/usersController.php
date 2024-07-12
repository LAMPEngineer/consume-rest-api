<?php

/*
 *  Users controller to have actions for users
 */
class UsersController extends MyController implements ControllerInterface
{

	/**
	 * initialize config 
	 */
	public function __construct()
	{
		parent::__construct();
		$this->api_url = $this->config::USER_API_URL_V2;
		$this->microservice = 'users';
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
			$resource_id		= (int)$_POST['id'];
			$data['id']			= $resource_id;
			$data['name']		= htmlspecialchars(strip_tags($_POST['name']));
			$data['email']		= htmlspecialchars(strip_tags($_POST['email']));
			$data['password']	= htmlspecialchars(strip_tags($_POST['password']));
			
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
			$data['name']		= htmlspecialchars(strip_tags($_POST['name']));
			$data['email'] 		= htmlspecialchars(strip_tags($_POST['email']));
			$data['password']	= htmlspecialchars(strip_tags($_POST['password']));

			$this->data = $data;

			$response = parent::addAction();	
		}

		return $response;
	}


}