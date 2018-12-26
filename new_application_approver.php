
<?php if(!isset($_POST["submit"])) : ?>

<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<!-- Meta, title, CSS, favicons, etc. -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>
			Applications
		</title>
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/register.css">
		<link rel="stylesheet" href="css/menu.css">
		<link rel="stylesheet" href="css/newEnquiry.css">
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/jquery-1.12.0.min.js"></script>
		<script src="js/assign_approver.js"></script>
	</head>
	<body>
		<div class="navbar">
      		<div class="col-md-12">
						<a href="dashboard.php">Home</a>
				<div class = "logout">
	        		<a href="logout.php" class="btn btn-info btn-lg">
	        			<span class="glyphicon glyphicon-log-out"></span> Log out
	        		</a>
				</div>
        		<h1 class="navheader">
          			Publication Data Repository
        		</h1>
      		</div>
      		<?php

	include('session.php');
	require_once "db.php";
	$flag = true;
	//check if form data exists
	//https://stackoverflow.com/questions/32405077/show-second-dropdown-options-based-on-first-dropdown-selection-jquery
	
	//returns the max id and updates the id in the database

	function get_max_application_id($dbclient) {
		$query = 'SELECT * FROM `application_id_max` LIMIT 1';
		$result = $dbclient->run_query($query);
		$row = mysqli_fetch_row($result);
		$id = $row[0];
		$query = "DELETE FROM `application_id_max`";
		$dbclient->run_query($query);
		$query = "INSERT INTO `application_id_max` VALUES ('" . ($id+1) . "')";
		$dbclient->run_query($query);
		return $id;
	}

	function test_input($data) {
    	$data = trim($data);
    	$data = stripslashes($data);
    	$data = htmlspecialchars($data);
    	return $data;
  	}
/*		
		if(!isset($_SESSION['title'])) {
			header("location:new_application.php");
		}
*/
		$db = new DB();

		$id = $_SESSION['id'];
		$initial_paper = $_SESSION['initial_paper'];
		$finacial_aid = $_SESSION['finacial_aid'];
		unset($_SESSION['initial_paper']);
		unset($_SESSION['finacial_aid']);
		unset($_SESSION['id']);
		//fetch the row id
		$aid = get_max_application_id($db);

		if($initial_paper == '')
			$initial_paper = 'NULL';
		else
			$initial_paper = "'" . $initial_paper . "'";

		if($finacial_aid == '')
			$finacial_aid = 'NULL';
		else
			$finacial_aid = "'" . $finacial_aid . "'";

		$finacial_aid = test_input($finacial_aid);
		$initial_paper = test_input($initial_paper);
		$id = test_input($id);
		
		
		$query = "INSERT INTO `applications` (`aid`,`idrecord`, `initial_paper`, `fund_required`, `approved_level`) VALUES (".$aid.",".$id.",". $initial_paper.",".$finacial_aid.", 1);";
		if($db->run_query($query)) {
			
			echo "<br/><center><h2>Application Successfully Submitted....</h2></center>";

		}
		else {
			echo "<br/><center><h2>Some Error Occured....Please try again<center><h2>";
		}
	
?>

    	</div>	
	</body>
</html>
<?php endif; ?>					