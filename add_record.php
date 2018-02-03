<?php
	
	include('session.php');
	//var_dump($_POST);

	//TODO avoid sql injection
	if(isset($_POST["submit"])) {
		//title
		if(isset($_POST['title'])) {
			$title = $_POST['title'];
			//TODO ensure that title is unique
		}else {
			echo "";
		}

		//pages
		if(isset($_POST['pages'])) {
			$num_pages = $_POST['num_pages'];
		}else {
			echo "";
		}

		//issueno
		if(isset($_POST['issueno'])) {
			$issueno = $_POST['issueno'];
		}else {
			echo "";
		}

		//volume
		if(isset($_POST['volume'])) {
			$volume = $_POST['volume'];
		}else {
			echo "";
		}

		//citations
		if(isset($_POST['citations'])) {
			$citations = $_POST['citations'];
		}else {
			echo "";
		}

		//journal_details
		if(isset($_POST['journal_details'])) {
			$journal_details = $_POST['journal_details'];
			$nat_journal = "F";
			$int_journal = "F";
			if(in_array("national", $journal_details)) {
				$nat_journal = "T";
			}
			if(in_array("international", $journal_details)) {
				$int_journal = "T";
			}
		} else {
			echo "";
		}

		//conference
		if(isset($_POST['conference_details'])) {
			$conference_details = $_POST['conference_details'];
			$nat_journal = "F";
			$int_journal = "F";
			if(in_array("national", $conference_details)) {
				$nat_conf = "T";
			}
			if(in_array("international", $conference_details)) {
				$int_conf = "T";
			}
		} else {
			echo "";
		}	

		//funded by
		if(isset($_POST['funded_by'])) {
			$funded_by = $_POST['funded_by'];
			$f_tequip = "F";
			$f_rsa = "F";
			$f_isea = "F";
			$f_aicte = "F";
			$f_coep = "F";
			$f_others = "F";
			if(in_array("tequip", $funded_by)) {
				$f_tequip = "T";
			}
			if(in_array("rsa", $funded_by)) {
				$f_rsa = "T";
			}
			if(in_array("isea", $funded_by)) {
				$f_isea = "T";
			}
			if(in_array("coep", $funded_by)) {
				$f_coep = "T";
			}
			if(in_array("aicte", $funded_by)) {
				$f_aicte = "T";
			}
			if(in_array("others", $funded_by)) {
				$f_others = "T";
			}
		}else {
			echo "NO funded by";
		}

		//sponsored by
		if(isset($_POST['sponsored_by'])) {
			$sponsored_by = $_POST['sponsored_by'];
			$t_tequip = "F";
			$t_rsa = "F";
			$t_isea = "F";
			$t_aicte = "F";
			$t_coep = "F";
			$t_others = "F";
			if(in_array("tequip", $sponsored_by)) {
				$t_tequip = "T";
			}
			if(in_array("rsa", $sponsored_by)) {
				$t_rsa = "T";
			}
			if(in_array("isea", $sponsored_by)) {
				$t_isea = "T";
			}
			if(in_array("coep", $sponsored_by)) {
				$t_coep = "T";
			}
			if(in_array("aicte", $sponsored_by)) {
				$t_aicte = "T";
			}
			if(in_array("others", $sponsored_by)) {
				$t_others = "T";
			}
		}else {
			echo "NO sponsored by";
		}

		//pages
		if(isset($_POST['add_facultymis']) and isset($_POST['add_facultyname'])) {
			$faculty_mis = $_POST['add_facultymis'];
			$faculty_name = $_POST['add_facultyname'];
			foreach (array_combine($faculty_mis, $faculty_name) as $mis => $name) {
				//TODO add mis
			}
		}else {
			echo "";
		}

		if(isset($_FILES["pdffile"]["name"])) {

			$target_dir = "uploads" . DIRECTORY_SEPARATOR;
			$destination_path = getcwd().DIRECTORY_SEPARATOR;
			$target_file = $destination_path . $target_dir . basename($_FILES["pdffile"]["name"]);
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			$type = mime_content_type($_FILES["pdffile"]["tmp_name"]);
			

			if($type == "application/pdf") {
		        $uploadOk = 1;
		    } else {
		        echo "File is not an pdf.";
		        $uploadOk = 0;
		    }
		    
		    // Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
			    echo "Sorry, your file was not uploaded.";
			
			// if everything is ok, try to upload file
			} else {
			    if (move_uploaded_file($_FILES["pdffile"]["tmp_name"], $target_file)) {
			        
			    } else {
			        echo "Sorry, there was an error uploading your file.";
			    }
			}
			
		} else {
			echo "Please Upload file";
		}

		//TODO ask for assigner
		//add all the variables to session
		$_SESSION['title'] = $title;
		header("location:assign_approver.php");

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
	    	<form method="POST" enctype="multipart/form-data">
				<div class="form-group">
					<label for="title" class="control-label">Title</label>
					<input type="text" class="form-control" id="title" name="title" placeholder="Enter Title" required>
				</div>	

				<div class="form-group"> <!-- Street 1 -->
					<label for="date" class="control-label">Date</label>
					<input type="text" class="form-control" id="date" name="date" placeholder="dd/mm/yyyy">
				</div>					
										
				<div class="form-group"> <!-- Street 2 -->
					<label for="pages" class="control-label">Pages</label>
					<input type="text" class="form-control" id="pages" name="pages" placeholder="No. of pages">
				</div>	

				<div class="form-group"> <!-- City-->
					<label for="issueno" class="control-label">Issue no</label>
					<input type="text" class="form-control" id="issueno" name="issueno" placeholder="Enter issue no">
				</div>

				<div class="form-group"> <!-- City-->
					<label for="volume" class="control-label">Volume</label>
					<input type="text" class="form-control" id="volume" name="volume" placeholder="Enter Volume">
				</div>

				<div class="form-group"> <!-- City-->
					<label for="citations" class="control-label">Citations</label>
					<input type="text" class="form-control" id="citations" name="citations" placeholder="Citations">
				</div>
				<div class="form-group">
					<label for="journal_details" class="control-label">Journal Details: </label>
					<div class="checkbox">
						<label><input type="checkbox" id = "journal_details" name="journal_details[]" value="national"> National </label>
						<input type="text" class="form-control" name="national_journal_name" placeholder="Journal name">
					</div>
					<div class="checkbox">
						<label><input type="checkbox" id = "journal_details" name="journal_details[]" value="international"> International</label>
					</div>
				</div>
				<div class="form-group">
					<label for="conference_details" class="control-label">Conference Details: </label>
					<div class="checkbox">
						<label><input type="checkbox" id = "conference_details" name="conference_details[]" value="national"> National</label>
					</div>
					<div class="checkbox">
						<label><input type="checkbox" id = "conference_details" name="conference_details[]" value="international"> International</label>
					</div>
				</div>

				<div class="form-group">
					<label for="funded_by" class="control-label">Funded By</label>
					<div class="checkbox">
						<label><input type="checkbox" id = "funded_by" name = "funded_ by[]" value="isea"> ISEA</label>
					</div>
					<div class="checkbox">
						<label><input type="checkbox" id = "funded_by" name = "funded_ by[]" value="tequip"> TEQUIP</label>
					</div>
					<div class="checkbox">
						<label><input type="checkbox" id = "funded_by" name = "funded_ by[]" value="coep"> COEP</label>
					</div>
					<div class="checkbox">
						<label><input type="checkbox" id = "funded_by" name = "funded_ by[]" value="rps"> RPS</label>
					</div>
					<div class="checkbox">
						<label><input type="checkbox" id = "funded_by" name = "funded_ by[]" value="aicte"> AICTE</label>
					</div>
					<div class="checkbox">
						<label><input type="checkbox" id = "funded_by" name = "funded_ by[]" value="others"> Others</label>
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


				<!-- Don't change class and id of this -->
				<div class="input_fields_wrap form-group">
				    <button class="add_field_button btn" id="add_faculty">Add Faculty</button>
				</div>

				<!-- Don't change class and id of this -->
				<div class="input_fields_wrap form-group">
				    <button class="add_field_button btn" id="add_ug_student">Add UG Student</button>
				</div>

				<!-- Don't change class and id of this -->
				<div class="input_fields_wrap form-group">
				    <button class="add_field_button btn" id="add_pg_student">Add PG Student</button>
				</div>

				<div class="input_fields_wrap form-group">
				    <button class="add_field_button btn" id="add_external">Add External/Industry Student</button>
				</div>

				<div class="form-group">
					<input id="fileupload" type="file" name="pdffile">
				</div>

				<div class="form-group"> <!-- Submit Button -->
					<button class="btn btn-primary" name="submit">Next</button>
				</div>     
		
			</form>
		</div>
    </body>
</html>
<?php endif; ?>