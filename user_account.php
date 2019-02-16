<?php
  include('session.php');
  ini_set('error_reporting', E_ALL);
  ini_set('display_errors', 1);
  require_once "db.php";
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<!-- Meta, title, CSS, favicons, etc. -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>
      User Account
		</title>
		<link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" media="screen and (max-width: 600px)" href="css/menu_small.css">
    <link rel="stylesheet" media="screen and (min-width: 900px)" href="css/menu.css">
    <link rel="stylesheet" media="screen and (max-width: 600px)" href="css/register_small.css">
    <link rel="stylesheet" media="screen and (min-width: 900px)" href="css/register.css">
		<script src="js/bootstrap.min.js"></script>
		<script src="js/jquery-3.2.1.slim.min.js"></script>
		<script src="js/jquery.min.js"></script>
	</head>
	<body>


		<div class="navbar">
      <div class="col-md-12">
        <a href="dashboard.php">Welcome, <?php echo $_SESSION['username'] ?></a>
				<div class = "logout">
	        <a href="logout.php" class="btn btn-info btn-lg">
	        	<span class="glyphicon glyphicon-log-out"></span> Log out
	        </a>
				</div>
        <h1 class="navheader">
          Publication Data Repository
        </h1>
      </div>
    </div>
    <div class="submissions">

      <table class="table table-striped table-bordered table-condensed">
  		    <tbody>
            <?php
              $db = new DB();
              $query = "SELECT * from users where username = ".$_SESSION['username'];
              $result = $db->run_query($query);
              $result = mysqli_fetch_row($result);
              echo '
                <tr>
                    <td>Username</td><td>'.$result[0].'</td>
                </tr>

                <tr>
                    <td>MIS</td><td>'.$result[1].'</td>
                </tr>
                <tr>
                    <td>Name</td><td>'.$result[2].'</td>
                </tr>
                <tr>
                    <td>Email</td><td>'.$result[3].'</td>
                </tr>
                <tr>
                    <td>Role</td><td>'.$result[4].'</td>
                </tr>
                <tr>
                    <td>Branch</td><td>'.$result[5].'</td>
                </tr>
                <tr>
                    <td>Year</td><td>'.$result[6].'</td>
                </tr>
                <tr>
                    <td>Level</td><td>'.$result[7].'</td>
                </tr>
                <tr>
                    <td>Department</td><td>'.$result[8].'</td>
                </tr>
                ';
          		?>
          </tbody>
      </table>
    </div>
  </body>
  </html>