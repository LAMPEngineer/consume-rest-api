<?php

/*
 *  Items controller to have actions for items
 */
class ItemsController extends MyController
{

	/**
	 * to get all items by api call
	 * and list it in view template
	 * 
	 * @return string view HTML
	 */
	public function indexAction(): string
	{

		$url = $this->config::ITEM_API_URL;			
		$method = 'GET';
		
		// api call
		$content = $this->apihandler->callAPI($url, $method);

		// get view and render
		$response = $this->getView('index', $content);
	
		return $response;

	}

	/**
	 * to get item by api call
	 * and show it in view template
	 *
	 * @param  int  $resource_id
	 * 
	 * @return string view HTML
	 */
	public function getAction($resource_id)
	{
		$url = $this->config::ITEM_API_URL;	
		$url .= '/'.$resource_id;		
		$method = 'GET';
		
		// api call
		$content = $this->apihandler->callAPI($url, $method);

		// get view and render
		$response = (is_object($content))? $this->getView('get', $content) : $content;
	
		return $response;
	}

	/**
	 * to edit item by id. it pre populate data it in view template
	 * once post, it goes to update action
	 *
	 * @param  int  $resource_id
	 * 
	 * @return string view HTML
	 */
	public function editAction($resource_id): string
	{
		$url = $this->config::ITEM_API_URL.'/'.$resource_id;	
		$method = 'GET';
		
		// api call
		$content = $this->apihandler->callAPI($url, $method);

		// get view and render
		$response = $this->getView('edit', $content);

		return $response;
	}


	/**
	 * after submit edited data comes here for update action
	 * it sends data through api handler
	 * 
	 * @return string view HTML
	 */
	public function updateAction(): string
	{
		if(!empty($_POST)){

			// collect POST data and make data array
			$itemid = (int)$_POST['id'];
			$data['id'] = $itemid;
			$data['name'] = htmlspecialchars(strip_tags($_POST['name']));
			$data['description'] = htmlspecialchars(strip_tags($_POST['description']));

			// HTTP method
			$method = 'PATCH';

			// URL to api call
			$url = $this->config::ITEM_API_URL.'/'.$itemid;

			// api call
			$response = $this->apihandler->callAPI($url, $method, $data);

		}

		$response .= "<br/><br/><a href=./../items/get/".$itemid.">Show updated item</a>";

		return $response;
	}

	/**
	 * to delete item by api call	 
	 *
	 * @param  int  $resource_id
	 * 
	 * @return string response
	 */
	public function deleteAction($resource_id): string
	{
		$url = $this->config::ITEM_API_URL.'/'.$resource_id;	
		$method = 'DELETE';
		
		// api call
		$response = $this->apihandler->callAPI($url, $method);

		$response .= "<br/><br/><a href=./../../items>Go Back</a>";

		return $response;
	}

	/**
	 * to add a new item 	 
	 * 
	 * @return string response
	 */
	public function addAction(): string
	{
		// get view and render
		$response = $this->getView('add');

		if(!empty($_POST)){

			$data['name'] = htmlspecialchars(strip_tags($_POST['name']));
			$data['description'] = htmlspecialchars(strip_tags($_POST['description']));

			// HTTP method
			$method = 'POST';

			// URL to api call
			$url = $this->config::ITEM_API_URL;

			// api call
			$response = $this->apihandler->callAPI($url, $method, $data);

			$response .= "<br/><br/><a href=./../items>Go Back</a>";

		}

		return $response;
	}

}