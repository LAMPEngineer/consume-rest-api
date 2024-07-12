<?php
/**
 *  Call the request handler that route request to right place 
 *  and return back response in right format as requested.
 *  
 */

//autoload 
include __DIR__ . '/autoload.php';

use RequestController as Request;

// request object
$request = new Request();

?>
<!DOCTYPE html>
<html>
	<head>
		<title>ConsumeRESTfulAPIs</title>
		<link rel="stylesheet" type="text/css" href="./public/mystyle.css">
	</head>
	<body>
		<?php // get result
			echo $request->requestRoute();
		?>
	</body>
</html>



