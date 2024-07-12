<?php

/**
 *  Get view 
 */
class GetView
{

	/**
	 * Resource view 
	 * @param array $content 
	 * @param string $service 	Service name e.g items, users etc 
	 * 
	 * @return string       
	 */
	public function render($content, $service)
	{
		//formating
		$service_view = ucfirst($service);

		$response = "<h1>".$content->name."</h1>";

// view according to service			
switch ($service) {

	case 'items':
		$response .= "<p>". $content->description ."</p>
						<hr>
						<p>Created by : ". $content->created_by ."</p>
						<p>Updated by : ". $content->updated_by ."</p>";
		break;

	case 'users':
		$response .= "<p>Email: ". $content->email ."</p>";
		break;

	default:
		# code...
		break;
}

		$response .="<hr>
						<p>Created at : ". $content->created_at ."</p>
						<p>Updated at : ". $content->updated_at ."</p>
					";

		$response .= "<br/><br/><a href=./../../". $service .">Go Back</a>";

		return $response;

	}

}