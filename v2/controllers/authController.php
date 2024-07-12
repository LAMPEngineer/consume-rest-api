<?php

/*
 *  Auth controller to have actions for authentication
 */
class AuthController extends MyController
{

	private $token;


	
	// setter & getter
	public function setToken($token){$this->token = $token; }
	public function getToken(){ return $this->token; }




	/**
	 * Auth index - to login into the system
	 * with email & passward. 
	 * 
	 * On success:
	 * i.  it gets jwt token
	 * ii. store token in the cookie for further uses
	 * 
	 * @return string shows view login screen
	 */
	public function indexAction(): string
	{
		$response = (!empty($this->token)) ? $this->dashboardAction() : $this->getView('login');
		// get view and render
		//$response = $this->getView('login');

		if(!empty($_POST)){

			$data['email']    = htmlspecialchars(strip_tags($_POST['email']));
			$data['password'] = htmlspecialchars(strip_tags($_POST['password']));
			
			$url = $this->config::AUTH_LOGIN_URL_V2;			
			$method = 'POST';

			// api call
			$api_response = $this->apihandler->callAPI($url, $method, $data);

			if(is_object($api_response)){
			$this->token = $api_response->jwt;

			// route to dashboard
			$response = $this->dashboardAction();

			
			/**
			 * Set JWT token to cookie
			 * 
			 * we can change the 15 in setcookie() to amount of days the cookie will expire in.
			 * The "/" in setcookie is important, because it ensures the cookies will be available on every page the user visits on our website.
			 * 
			 */
			setcookie('jwtaccesstoken',$this->token, time()+(3600 * 24 * 15),"/");

			}

		}

		return $response;
	}




	/**
	 * Process requests:
	 * i.  if user not login or system don't have jwt token - route to login
	 * ii. if jwt token available - route to respective microservices 
	 *
	 * 
	 * @param  string $action      controller's action to be routed
	 * @param  int    $resource_id resource id
	 * @param  object $controller  object of microservice to be use
	 * 
	 * @return string              respective views
	 */
	public function processRequest($action, $resource_id, $controller=null): string
	{
		if(!empty($controller)){

			if(!empty($_COOKIE['jwtaccesstoken'])){
				// get jwt token from cookie		
				$jwt_token = $_COOKIE['jwtaccesstoken'];
				$controller->setToken($jwt_token);

				// route to microservices => controller action 
				$response = $controller->$action($resource_id);
				if ($response == 'Expired token') {

					// 'Expired token' - route to logout
					$response = $this->logoutAction($response);
					return $response;
				}

			} else {
				// "JWT token not set!" - route to login
				$response = $this->indexAction();
				}			
		}else{
			// route to login
			$response = $this->$action();
		}

		return $response;
	}




	/**
	 * Dasbosrd action - on successful login - user's landing
	 * 
	 * @return string       Dashboard view
	 */
	public function dashboardAction(): string
	{
		// get view and render
		$response = $this->getView('dashboard');
		$response .= "<br/><br/><a href=auth/logout>Logout</a>";

		return $response;
	}




	/**
	 *  Actions to logout:
	 *  i.   unset jwt token from global variable - $_COOKIE
	 *  ii.  remove jwt token from browser's cookie
	 *  iii. set auth controller token variable to null
	 *
	 * 
	 * @param  string $content    to be display on logout page
	 * 
	 * @return string             logout view
	 */
	public function logoutAction($content): string
	{
		// unset jwt token from system		
		if (isset($_COOKIE['jwtaccesstoken'])) {
			    unset($_COOKIE['jwtaccesstoken']);
			    setcookie('jwtaccesstoken', '', time() - 3600, '/'); // empty value and old timestamp			    
			}
		$this->setToken(null);
		
		// get view and render
		$response = $this->getView('logout', $content);
		return $response;
	}
	
}