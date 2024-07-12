<?php
/**
 *  Index view 
 */
class IndexView
{

	/**
	 * Resource list view 
	 * @param array $content 
	 * @param string $service 	Service name e.g items, users etc 
	 * 
	 * @return string       
	 */
	public function render($content, $service)
	{
		//formating
		$service_view = ucfirst($service);

		$response = "<h1>". $service_view ." List</h1>
					<table>
						<thead>
							<tr>
								<th><u>#</u></th>
								<th><u>". $service_view ."</u></th>
								<th><u>Action 1</u></th>
								<th><u>Action 2</u></th>
								<th><u>Action 3</u></th>
							</tr>
						</thead>
						<tbody>";
							$i=0;
							foreach ($content as $resource) {
								
				   $response .= "<tr>
				   					<td>".++$i."</td>
									<td>".$resource->name."</td>
									<td>				
										<a href='/ConsumeRESTfulAPIs/v2/". $service."/get/".$resource->id."'>Show</a>
									</td>
									<td>				
										<a href='/ConsumeRESTfulAPIs/v2/". $service ."/edit/".$resource->id."'>Edit</a>
									</td>
									<td>				
										<a href='/ConsumeRESTfulAPIs/v2/" .$service. "/delete/".$resource->id."'>Delete</a>
									</td>
								</tr>";
							}
							

			$response .= "</tbody>
					</table>";

	
		$response .= "<br/><br/><a href=./". $service."/add>Add An Resource</a>";

		return $response;
	}
}