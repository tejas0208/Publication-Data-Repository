<?php
  include('session.php');
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
			Dashboard | <?php echo $_SESSION['username'] ?>
		</title>
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/menu.css">
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


		<div class="wrapper">
			<!-- Sidebar Holder -->

			<!-- Page Content Holder -->
			<div id="content">
				<!-- if user is teacher or executive display these options -->
				<?php if($_SESSION['level'] != 'normal') : ?>
					<div class="row">
			        <div class="col-sm-6">
			    		  <a href="pending_approvals.php">
			    		    <div class="tile one">
								<h2 class="title">Pending approvals</h2>
						        <p>See pending approvals</p>
			    		    </div>
			    		  </a>
			    	  </div>

			        <div class="col-sm-6">
			      	  <a href="data_report.php">
			      	     <div class="tile two">
							 <h2 class="title">Data Report</h2>
						  <p>See Data Report</p>
			      	     </div>
			      	  </a>
			        </div>
			      </div>
			      <div class="row">
			        <div class="col-sm-6">
			    		  <a href="pending_applications.php">
			    		    <div class="tile one">
								<h2 class="title">Pending Applications</h2>
						        <p>See pending applications</p>
			    		    </div>
			    		  </a>
			    	  </div>

			        <div class="col-sm-6">
			      	  <a href="approvals.php">
			      	     <div class="tile two">
							 <h2 class="title">My approvals</h2>
						  <p>See the papers you have approved</p>
			      	     </div>
			      	  </a>
			        </div>
			      </div>	
				<?php endif; ?>


				<div class="row">
			        <div class="col-sm-6">
			    		  <a href="add_record.php">
			    		    <div class="tile one">
								<h2 class="title">New Record</h2>
						        <p>Add a new publication record</p>
			    		    </div>
			    		  </a>
			    	  </div>

			        <div class="col-sm-6">
			      	  <a href="application_base.php">
			      	     <div class="tile two">
							 <h2 class="title">New Application</h2>
						  <p>Add a new application request</p>
			      	     </div>
			      	  </a>
			        </div>
			      </div>
				  <div class="row">
  			        <div class="col-sm-6">
  			    		  <a href="submissions.php">
  			    		    <div class="tile three">
  								<h2 class="title">My Papers</h2>
  						        <p>View your publication history</p>
  			    		    </div>
  			    		  </a>
  			    	  </div>

  			        <div class="col-sm-6">
  			    		  <a href="user_account.php">
  			    		    <div class="tile four">
  		  				        <h2 class="title">My Account</h2>
  		  				        <p>Manage your profile details, privileges, etc</p>
  			    		    </div>
  			    		  </a>
  			        </div>
  			      </div>
  			      <div class="col-sm-6">
  			      	<a href="my_applications.php">
  			      		<div class="tile four">
  			      			<h2 class="title">My Applications</h2>
  			      			<p>Manage your Submitted Applications</p>
  			      		</div>
  			      	</a>
  			      </div>

			</div>
		</div>
	</body>
</html>
