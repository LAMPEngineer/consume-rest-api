<?php

/**
 *  Add view 
 */
class AddView
{
	public function render()
	{
		$response = "<h1>Add Item</h1>
		<form method=\"post\" action=\"\" >	  
			
				<div>
					<label>Name</label>
					<input type=\"text\" name=\"name\" value=\"\">
				</div>
				<div>
					<label>Description</label>
					<textarea rows = \"5\" cols = \"50\" name = \"description\" style=\"text-align:left\"></textarea>	
				</div>
				<div>
					<button type=\"submit\" name=\"\" >Create</button>
				</div>
		</form>";

		return $response;
	}
}