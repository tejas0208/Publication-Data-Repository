<?php
	
	include('session.php');
	//var_dump($_POST);

	//TODO avoid sql injection
	$id = $_GET['id'];
	$initial_paper = $finacial_aid= "";
	if(isset($_POST["submit"])) {
		//initial paper
		if(isset($_POST['initial_paper'])) {
			$initial_paper = $_POST['initial_paper'];
		}else {
			echo "";
		}

		//finacial aid required
		if(isset($_POST['finacial_aid'])) {
			$finacial_aid = $_POST['finacial_aid'];
		}else {
			echo "";
		}
		$_SESSION['initial_paper'] = $initial_paper;
		$_SESSION['finacial_aid'] = $finacial_aid;	//financial aid required
		header("location:new_application_approver.php");
		
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
			Add Application
		</title>
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/register.css">
		<link rel="stylesheet" href="css/menu.css">
		<link rel="stylesheet" href="css/newEnquiry.css">
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/jquery-1.12.0.min.js"></script>
		<script src="js/helpers.js"></script>
		<script>
			jQuery(document).ready(function() {
				jQuery('.tabs .tab-links a').on('click', function(e)  {
					
					var currentAttrValue = jQuery(this).attr('href');
					// Show/Hide Tabs
					jQuery('.tabs ' + currentAttrValue).siblings().slideUp(400);
					jQuery('.tabs ' + currentAttrValue).delay(400).slideDown(400);
					// Change/remove current tab to active
					jQuery(this).parent('li').addClass('active').siblings().removeClass('active');
					e.preventDefault();
				});
			});
		</script>
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
		    	<form method="POST" action="new_application.php">
					<div class="form-group">
						<label for="title" class="control-label">Initial Paper</label>
						<input type="text" class="form-control" id="initial_paper" name="initial_paper" placeholder="Enter Initial Paper" >
					</div>					
											
					<div class="form-group"> <!-- Street 2 -->
						<label for="pages" class="control-label">Financial Aid Required In Rupees</label>
						<input type="text" class="form-control" id="finacial_aid" name="finacial_aid" placeholder="Financial Aid">
					</div>	

					
					<div class="form-group"> <!-- Submit Button -->
						<button class="btn btn-primary" name="submit">Next</button>
					</div>     
					<?php
							$_SESSION['id'] = $GLOBALS['id'];
					  ?>
				</form>
			</div>
		</div>	
    </body>
</html>

<?php endif; ?>