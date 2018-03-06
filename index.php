<?php
require_once 'adLDAP.php';
require_once "db.php";
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
session_start();

if(isset($_POST['username']) && isset($_POST['password'])){

	$username = trim($_POST['username']);
	$password = trim($_POST['password']);
	
	
	$ad = new adLDAP();
	$entry = $ad->searchDn($username);
	if(!$entry) {
		die('Error in authentication');
	}
	function pvd($var) {
		echo "<pre style='font-size:16px;'>";
		var_dump($var);
		echo "</pre>";
	}
	$auth = $ad->authenticate($entry['dn'], $password);
	if(!$auth) {
		die('Error in authentication');	
	}
	//else echo var_dump($auth);
}


?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <title>Publication Data Repository</title>
  </head>
  <body>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	  <div class="form-group">
		<label for="mis">MIS</label>
		<input type="text" name="mis" class="form-control" id="mis" aria-describedby="mis" placeholder="Enter MIS">
	  </div>
	  <div class="form-group">
		<label for="pswd">Password</label>
		<input type="password" name="password" class="form-control" id="pswd" placeholder="Password">
	  </div>
	  
	  <button type="submit" class="btn btn-primary">Submit</button>
	</form>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jquery-3.2.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>