<?php

/**
 *  Get view 
 */
class EditView
{

	/**
	 * edit view 
	 * @param  array $content 
	 * @return string       
	 */
	public function render($content)
	{
		$response =  "<h1>Edit Item</h1>
		<form method=\"post\" action=\"./../update\" >	  
			<input type=\"hidden\" name=\"id\" value=\"$content->id\">
				<div>
					<label>Name</label>
					<input type=\"text\" name=\"name\" value=\"$content->name\">
				</div>
				<div>
					<label>Description</label>
					<textarea rows = \"5\" cols = \"50\" name = \"description\" style=\"text-align:left\">$content->description</textarea>				
				</div>
				<div>
					<button type=\"submit\" name=\"\" >Update</button>
				</div>
		</form>";

		return $response;

	}

}