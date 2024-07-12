<?php

/**
 *  Dashboard view 
 */
class DashboardView
{

	/**
	 * Resource view 
	 * @param array $content 
	 * @param string $service 	Service name e.g items, users etc 
	 * 
	 * @return string       
	 */
	public function render()
	{

		$response = "<h1>User Dashboard</h1>
					<hr>
					<li>
						<ul><a href=\"./items/\">Items</a></ul>
						<ul><a href=\"./users/\">Users</a></ul>						
					</li>
					";
	

		return $response;

	}

}