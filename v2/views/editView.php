<?php

/**
 *  Get view 
 */
class EditView
{

	/**
	 * edit view 
	 * @param  array $content 
	 * @param string $service 	Service name e.g items, users etc 
	 * 
	 * @return string       
	 */
	public function render($content, $service)
	{
		//formating
		$service_view = ucfirst($service);

		$response =  "<h1>Edit ". $service_view ."</h1>
		<form method=\"post\" action=\"./../update\" >	  
			<input type=\"hidden\" name=\"id\" value=\"$content->id\">
				<div>
					<label>Name</label>
					<input type=\"text\" name=\"name\" value=\"$content->name\">
				</div>";

	// view according to service
	switch ($service) {
		case 'items':
			$response .= "<div>
						<label>Description</label>
						<textarea rows = \"5\" cols = \"50\" name = \"description\" style=\"text-align:left\">$content->description</textarea>				
					</div>";
			break;

		case 'users':
			$response .= "<div>
							<label>Email</label>
							<input type=\"text\" name=\"email\" value=\"$content->email\">				
						</div>
						<div>
							<label>Password</label>
							<input type=\"text\" name=\"password\" value=\"\">				
						</div>";	
		default:
			# code...
			break;
	}

				

		$response .="<div>
					<button type=\"submit\" name=\"\" >Update</button>
				</div>
		</form>";

		return $response;

	}

}