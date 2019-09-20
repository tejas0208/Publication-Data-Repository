<?php
include('session.php');
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
require_once "db.php";
?>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<!-- Meta, title, CSS, favicons, etc. -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>
			Data Report
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
		<script src="js/FileSaver.js"></script>
		<script src="js/data_report.js"></script>
		<script src="js/tableexport.js"></script>
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
				<form id="formdata" method = "POST">
					<div class="form-group">
						<input type="submit" class="hidden" id="submit" name="submit" value="submit">
						<br><br><br><label for="title" class="control-label">Title</label>
						<input type="text" class="form-control" id="title" name="title" placeholder="Enter Title">
					</div>
					<div class="form-group">
						<label for="sdate" class="control-label">Start Date</label>
						<input type="date" class="form-control" id="sdate" name="sdate" placeholder="yyyy/mm/dd">
					</div>
					<div class="form-group">
						<label for="edate" class="control-label">End Date</label>
						<input type="date" class="form-control" id="edate" name="edate" placeholder="yyyy/mm/dd">
					</div>
					<div class="form-group">
						<label for="pages" class="control-label">Pages</label>
						<input type="text" class="form-control" id="pages" name="pages" placeholder="No. of pages">
					</div>
					<div class="form-group">
						<label for="issueno" class="control-label">Issue no</label>
						<input type="text" class="form-control" id="issueno" name="issueno" placeholder="Enter issue no">
					</div>
					<div class="form-group">
						<label for="volume" class="control-label">Volume</label>
						<input type="text" class="form-control" id="volume" name="volume" placeholder="Enter Volume">
					</div>
					<div class="form-group">
						<label for="citations" class="control-label">Citations</label>
						<input type="text" class="form-control" id="citations" name="citations" placeholder="Citations">
					</div>
					<div class="form-group">
						<label for="department" class="control-label">Select Department of Approver</label>
			      		<select class="form-control" id="department" name="department">
			      			<option disabled selected value>Departments</option>
			      			<option value="Applied Science">Department of Applied Science</option>
			            	<option value="Civil Engineering">Department of Civil Engineering</option>
			            	<option value="Computer Engineering and Information Technology">Department of Computer Engineering & IT</option>
			            	<option value="Electrical Engineering">Department of Electrical Engineering</option>
			            	<option value="Electronics and Telecommunication Engineering">Department of Electronics and Telecommunication Engineering</option>
			            	<option value="Instrumentation and Control Engineering">Department of Instrumentation and Control Engineering</option>
			            	<option value="Department of Mathematics">Department of Mathematics</option>
			            	<option value="Mechanical Engineering">Department of Mechanical Engineering</option>
			            	<option value="Metallurgy and Material Science">Department of Metallurgy and Materials Science</option>
			            	<option value="Department of Physics">Department of Physics</option>
			            	<option value = "Planning">B.Tech Planning</option>
			            	<option value = "Production Engineering and Industrial Management">Department of Production Engineering and Industrial Management</option>
			      		</select>
					</div>
					<div class="form-group">
						<label for="funded_by" class="control-label">Funded By</label>
						<div class="checkbox">
							<label><input type="checkbox" id = "funded_by" name = "funded_by[]" value="isea"> ISEA</label>
						</div>
						<div class="checkbox">
							<label><input type="checkbox" id = "funded_by" name = "funded_by[]" value="tequip"> TEQUIP</label>
						</div>
						<div class="checkbox">
							<label><input type="checkbox" id = "funded_by" name = "funded_by[]" value="coep"> COEP</label>
						</div>
						<div class="checkbox">
							<label><input type="checkbox" id = "funded_by" name = "funded_by[]" value="rsa"> RSA</label>
						</div>
						<div class="checkbox">
							<label><input type="checkbox" id = "funded_by" name = "funded_by[]" value="aicte"> AICTE</label>
						</div>
						<div class="checkbox">
							<label><input type="checkbox" id = "funded_by" name = "funded_by[]" value="others"> Others</label>
						</div>
					</div>
					<div class="form-group">
						<label for="sponsored_by" class="control-label">Sponsored By</label>
						<div class="checkbox">
							<label><input type="checkbox" id = "sponsored_by" name="sponsored_by[]" value="isea"> ISEA</label>
						</div>
						<div class="checkbox">
							<label><input type="checkbox" id = "sponsored_by" name="sponsored_by[]" value="tequip"> TEQUIP</label>
						</div>
						<div class="checkbox">
							<label><input type="checkbox" id = "sponsored_by" name="sponsored_by[]" value="coep"> COEP</label>
						</div>
						<div class="checkbox">
							<label><input type="checkbox" id = "sponsored_by" name="sponsored_by[]" value="rps"> RPS</label>
						</div>
						<div class="checkbox">
							<label><input type="checkbox" id = "sponsored_by" name="sponsored_by[]" value="aicte"> AICTE</label>
						</div>
						<div class="checkbox">
							<label><input type="checkbox" id = "sponsored_by" name="sponsored_by[]" value="others"> Others</label>
						</div>
					</div>
					<div class="form-group">
						<label for="journal_details" class="control-label">Journal Details: </label>
						<div class="checkbox">
							<label><input type="checkbox" class = "journal_details" name="journal_details[]" value="national"> National </label>
						</div>
						<div class="checkbox">
							<label><input type="checkbox" class = "journal_details" name="journal_details[]" value="international"> International</label>
						</div>
					</div>
					<div class="form-group">
						<label for="conference_details" class="control-label">Conference Details: </label>
						<div class="checkbox">
							<label><input type="checkbox" class = "conference_details" name="conference_details[]" value="national"> National</label>
						</div>
						<div class="checkbox">
							<label><input type="checkbox" class = "conference_details" name="conference_details[]" value="international"> International</label>
						</div>
					</div>
					<div class="form-group">
						<label for="citations" class="control-label">File Name</label>
						<input type="text" class="form-control" id="fname" name="fname" placeholder="File Name">
					</div>
					<div class="form-group">
						<label for="title" class="control-label">Approved By (MIS)</label>
						<input type="text" class="form-control" id="approved_by_mis" name="approved_by_mis" placeholder="MIS">
					</div>
					<div class="form-group">
						<label for="title" class="control-label">Approved By (Name)</label>
						<input type="text" class="form-control" id="approved_by_name" name="approved_by_name" placeholder="Name">
					</div>
					<div class="form-group">
						<label for="title" class="control-label">Submitted By (MIS)</label>
						<input type="text" class="form-control" id="submitted_by_mis" name="submitted_by_mis" placeholder="MIS">
					</div>
					<div class="form-group">
						<label for="title" class="control-label">Submitted By (Name)</label>
						<input type="text" class="form-control" id="submitted_by_name" name="submitted_by_name" placeholder="Name">
					</div>
					<div class="form-group">
						<input type="submit" class="btn btn-primary" id="submit" name="submit" value="Search">
					</div>
			</form>
			<div id="output">
		</div>
			</div>
		</div>
		</div>
	</div>
	</body>
</html>