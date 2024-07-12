<?php

/**
 *  Login view 
 */
class LoginView
{
	public function render()
	{
		$response = "<h1>User Login</h1>
		<form method=\"post\" action=\"\" >	  
			
		<div>
			    <label for=\"email\">Email:</label>
			    <input type=\"text\" id=\"email\" name=\"email\">
			</div>

			<div>
			    <label for=\"pass\">Password (8 characters minimum):</label>
			    <input type=\"password\" id=\"pass\" name=\"password\"
			           minlength=\"8\" required>
			</div>

			<input type=\"submit\" value=\"Sign in\">
		</form>";

		return $response;
	}
}