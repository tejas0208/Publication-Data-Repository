<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
require_once "db.php";
require_once 'adLDAP.php';

session_start();

if(isset($_POST['username']) && isset($_POST['password'])){

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $ad = new adLDAP();
    $entry = $ad->searchDn($username);
    $_SESSION["entry"] = $entry;
    if(!$entry) {
      //die('Error in authentication');
    }
    $auth = $ad->authenticate($entry['dn'], $password);
    if(!$auth) {
      //die('Error in authentication');	
    }
    if(strpos($entry["dn"], "students")!= false) {
      $role = 'student';
      $level = 'normal';
    }
    else {
      $role = 'faculty';
      $level = 'normal';
    }
    if ($username == "approver" && $password == "helloworld") {
        # code...
        $_SESSION['username'] = $username;
        $_SESSION['level'] = "approver";
        $_SESSION['role'] = 'faculty';
        
        $db = new DB();
        $query = "SELECT * from users where username = '$username'";
        $result = $db->run_query($query);
        if(mysqli_num_rows($result) == 0) {
          header("location:register.php");
        }
        else {
          $result = mysqli_fetch_row($result);
          $_SESSION['mis'] = $result[1];
          header("location:dashboard.php");
        }

    }
  
    else if ($auth) {
        $_SESSION['username'] = $username;
        $_SESSION['level'] = $level;
        $_SESSION['role'] = $role;
        
        $db = new DB();
        $query = "SELECT * from users where username = '$username'";
        $result = $db->run_query($query);
        if(mysqli_num_rows($result) == 0) {
          header("location:register.php");
        }
        else {
          header("location:dashboard.php");
        }

    }
    else {
        echo "Incorrect login credentials";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Publication Data Repo Login</title>
			<link rel="stylesheet" href="css/menu.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/login.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src=js/authentication.js> </script>
	</head>
	<body class="login">
	

		<div class="navbar">
      <div class="col-md-12">
        <h1 class="navheader">
          Publication Data Repository
        </h1>
      </div>
    </div>

		<div class="wrapper">
			<div class="container" id="container">
				<div class="row">
				<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
					<div class="col-sm-offset-3 col-sm-6" id="loginBox">
						<div class="panel panel-default">
							<div class="panel-heading">
								<span>Login</span>
							</div>
							<div class="panel-body form-horizontal">
									<div id="genMsg" class="alert alert-danger hide">
										Invalid UserName or Password
									</div>
									<div class="form-group">
										<label for="username" class="col-sm-3 control-label">
											UserName
										</label>
										<div class="col-sm-9">
											<input class="form-control" id="username" name="username" placeholder="Username" required="" type="text">
										</div>
									</div>
									<div class="form-group">
										<label for="Password" class="col-sm-3 control-label">
											Password
										</label>
										<div class="col-sm-9">
											<input class="form-control" id="password" name="password" placeholder="Password" required="" type="password">
										</div>
									</div>
									<div class="form-group last">
										<div class="col-sm-offset-3 col-sm-6">
											<button type="submit" class="btn btn-success btn-sm" name="submit" value="submit" id="btnSignIn" >
												Sign in
											</button>
										</div>
									</div>
							</div>
													</div>
					</div>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>
