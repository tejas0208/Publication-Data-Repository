<?php
	$invalid_data = 0;
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		return $data;
	}
	include('session.php');
	//var_dump($_POST);
	//TODO avoid sql injection
	if(!isset($_GET['id'])) {
		header("location:application_base.php");
	} else {
		$_SESSION['id_of_application'] = $_GET['id'];
	}

	$id = $_SESSION['id_of_application'];
	$initial_paper = $financial_aid= "";


	if(isset($_POST["submit"])) {
		//initial paper
		$initial_paper = test_input($_POST['initial_paper']);
		$financial_aid = test_input($_POST['financial_aid']);

		if($initial_paper != "" AND $financial_aid != "" ) {
			$_SESSION['initial_paper'] = $initial_paper;
			$_SESSION['financial_aid'] = $financial_aid;	//financial aid required
			header("location:new_application_approver.php");
		}
		else {
			$invalid_data = 1;
		}

	}

?>
	<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<!-- Meta, title, CSS, favicons, etc. -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>
			Add Application
		</title>
		<link rel="stylesheet" href="css/bootstrap.min.css">
   		<link rel="stylesheet" media="screen and (max-width: 600px)" href="css/menu_small.css">
    	<link rel="stylesheet" media="screen and (min-width: 900px)" href="css/menu.css">
    	<link rel="stylesheet" media="screen and (max-width: 600px)" href="css/register_small.css">
    	<link rel="stylesheet" media="screen and (min-width: 900px)" href="css/register.css">
		<link rel="stylesheet" href="css/newEnquiry.css">
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/jquery-1.12.0.min.js"></script>
		<script src="js/helpers.js"></script>
	</head>
	<body>
		<div class="navbar">
      		<div class="col-md-12">
						<a href="dashboard.php">Welcome, <?php echo $_SESSION['username'] ?></a>
	        		<a href="logout.php" class="btn btn-info btn-lg">
	        			<span class="glyphicon glyphicon-log-out"></span> Log out
	        		</a>
        		<h1 class="navheader">
          			Publication Data Repository
        		</h1>
      		</div>
    	</div>
    	<div class="wrapper">
		    <div class="register">
		    	<form method="POST">
		    		<?php
		    			if ($invalid_data == 1) {
			    						echo '<div class="alert alert-danger alert-dismissible fade show">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Enter valid data</strong>
			</div>';
					}
		    		?>
					<div class="form-group">
						<label for="initial_paper" class="control-label">Initial Paper</label>
						<input type="text" class="form-control" id="initial_paper" name="initial_paper" placeholder="Enter Initial Paper" >
					</div>

					<div class="form-group"> <!-- Street 2 -->
						<label for="financial_aid" class="control-label">Financial Aid Required In Rupees</label>
						<input type="text" class="form-control" id="financial_aid" name="financial_aid" placeholder="Financial Aid">
					</div>


					<div class="form-group"> <!-- Submit Button -->
						<button class="btn btn-primary" type="submit"  name="submit">Next</button>
					</div>
				</form>
			</div>
		</div>
    </body>
</html>
