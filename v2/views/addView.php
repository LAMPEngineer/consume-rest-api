<?php

/**
 *  Add view 
 * @param array $content    By default its null for add view
 * @param string $service 	Service name e.g items, users etc 
 * 
 * @return string   
*/
class AddView
{
	public function render($content=null, $service)
	{
		//formating
		$service_view = ucfirst($service);

		$response = "<h1>Add Resource</h1>
		<form method=\"post\" action=\"\" >	  
			
				<div>
					<label>Name</label>
					<input type=\"text\" name=\"name\" value=\"\">
				</div>";

				

	// view according to service
	switch ($service) {
		case 'items':
			$response .= "<div>
							<label>Description</label>
							<textarea rows = \"5\" cols = \"50\" name = \"description\" style=\"text-align:left\"></textarea>	
						</div>";
			break;

		case 'users':
			$response .="<div>
							<label>Email</label>
							<input type=\"text\" name=\"email\" value=\"\">				
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
					<button type=\"submit\" name=\"\" >Create</button>
				</div>
		</form>";

		return $response;
	}
}