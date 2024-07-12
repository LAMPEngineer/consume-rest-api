<?php

/**
 *  Get view 
 */
class GetView
{

	/**
	 * Resource view 
	 * @param  array $content 
	 * @return string       
	 */
	public function render($content)
	{
		$response = "<h1>".$content->name."</h1>
						<p>".$content->description."</p>
						<hr>
						<p>Created at : ".$content->created_at."</p>
						<p>Updated at : ".$content->updated_at."</p>
					";

		$response .= "<br/><br/><a href=./../../items>Go Back</a>";

		return $response;

	}

}