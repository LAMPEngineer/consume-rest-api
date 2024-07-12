<?php

/**
 * controller interface
 */
interface ControllerInterface
{

	// setter & getter
	public function setToken($jwt_token);
	public function getToken();


	/**
	 * to get all resources by api call
	 * and list it in view template
	 * 
	 * @return string view HTML
	 */
	public function indexAction(): string;



	/**
	 * to get resource by id with api call
	 * and show it in view template
	 *
	 * @param  int  $resource_id
	 * 
	 * @return string view HTML
	 */
	public function getAction($resource_id): string;



    /**
	 * Edit resource by id. It pre populate data in view template
	 * once post, it goes to update action
	 *
	 * @param  int  $resource_id
	 * 
	 * @return string view HTML
	 */
	public function editAction($resource_id): string;


	/**
	 * after submit edited data, it comes here for update action
	 * and sends data through api handler
	 * 
	 * @return string view HTML
	 */
	public function updateAction(): string;



	/**
	 * to delete resource by id with api call	 
	 *
	 * @param  int  $resource_id
	 * 
	 * @return string response
	 */
	public function deleteAction($resource_id): string;




	/**
	 * to add a new resource 	 
	 * 
	 * @return string response
	 */
	public function addAction(): string;

}