<?php

/**
 *  Logout view 
 */
class LogoutView
{

	/**
	 * Resource view 
	 * @param array $content 
	 * @param string $service 	Service name e.g items, users etc 
	 * 
	 * @return string       
	 */
	public function render($content)
	{

		$response = $content;

		$response .= "<br/><br/><a href=/ConsumeRESTfulAPIs/v2>Go To Home</a>";

		return $response;

	}

}