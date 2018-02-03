<?php

	include('session.php');

	//check if form data exists
	//https://stackoverflow.com/questions/32405077/show-second-dropdown-options-based-on-first-dropdown-selection-jquery
	//maths physics meta prod
	if(isset($_SESSION['title'])) {
		$title = $_SESSION['title'];
	}
	else {
		header("location:add_record.php");
	}

	if(isset($_POST['submit'])) {
		echo "Successfully submitted";
	}
	

?>

<?php if(!isset($_POST["submit"])) : ?>

<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<!-- Meta, title, CSS, favicons, etc. -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>
			Department Store New Purchase
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
				Welcome, <?php echo $_SESSION['mis'] ?>
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
	    <div class="register">
	    	<form method="POST">
	    		<div class="form-group"> <!-- State Button -->
		      		<label for="dept_id" class="control-label">Select Department of Approver</label>
		      		<select class="form-control" id="appr_dept_id">
		      			<option value="appsci">Department of Applied Science</option>
		      			<option value="civil">Department of Civil Engineering</option>
		      			<option value="compit">Department of Computer Engineering & IT</option>
		      			<option value="elec">Department of Electrical Engineering</option>
		      			<option value="entc">Department of Electronics and Telecommunication Engineering</option>    		
		      			<option value="instru">Department of Instrumentation and Control Engineering</option>
		      			<option value="maths">Department of Mathematics</option>
		      			<option value="mech">Department of Mechanical Engineering</option>
		      			<option value="meta">Department of Metallurgy and Materials Science</option>
		      			<option value="phy">Department of Physics</option>
		      		</select>
		      	</div>

				<div class="form-group">
					<label for="select approver" class="control-label">Select Approver</label>
					<select class="form-control" id="approver_name">
		      			<option value="abhijit">Abhijit</option>
		      			<option value="tarun">Tarun</option>
		      		</select>
				</div>

				<div class="form-group btn"> <!-- Submit Button -->
					<button class="btn" name="submit">Next</button>
				</div>	
			</form>
		</div>
	</body>
</html>
<?php endif; ?>					