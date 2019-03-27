<?php

	include('session.php');
	//TODO avoid sql injection
	$title = $num_pages = $issueno = $volume = "";
	$citations = $date = "";
	$nat_journal = $int_journal = $nat_conf = $int_conf = "F";
	$national_journal_name = $international_journal_name = "";
	$national_conference_name = $international_conference_name = "";
	$f_tequip = $f_rsa = $f_isea = $f_aicte = $f_coep = $f_others = "F";
	$t_tequip = $t_rsa = $t_isea = $t_aicte = $t_coep = $t_others = "F";
	$faculty_mis= $ug_student_mis = $pg_student_mis = $external_names = [];

	if(isset($_POST["submit"])) {
		//title
		if(isset($_POST['title'])) {
			$title = $_POST['title'];
			//TODO ensure that title is unique

		}

		if(isset($_POST['date'])) {
			$date = $_POST['date'];
		}

		//pages
		if(isset($_POST['pages'])) {
			$num_pages = $_POST['pages'];
		}

		//issueno
		if(isset($_POST['issueno'])) {
			$issueno = $_POST['issueno'];
		}

		//volume
		if(isset($_POST['volume'])) {
			$volume = $_POST['volume'];
		}

		//citations
		if(isset($_POST['citations'])) {
			$citations = $_POST['citations'];
		}

		//journal_details
		if(isset($_POST['journal_details'])) {
			$journal_details = $_POST['journal_details'];
			if(in_array("national", $journal_details)) {
				$nat_journal = "T";
				if(isset($_POST['national_journal_name'])) {
					$national_journal_name = $_POST['national_journal_name'];
				}
				else {
					echo "Please enter journal name";
				}
			}
			if(in_array("international", $journal_details)) {
				$int_journal = "T";
				if(isset($_POST['international_journal_name'])) {
					$international_journal_name = $_POST['international_journal_name'];
				}
				else {
					echo "Please enter journal name";
				}
			}
		}

		//conference
		if(isset($_POST['conference_details'])) {
			$conference_details = $_POST['conference_details'];
			if(in_array("national", $conference_details)) {
				$nat_conf = "T";
				if(isset($_POST['national_conference_name'])) {
					$national_conference_name = $_POST['national_conference_name'];
				}
				else {
					echo "Please enter conference name";
				}
			}
			if(in_array("international", $conference_details)) {
				$int_conf = "T";
				if(in_array("national", $conference_details)) {
				$nat_conf = "T";
				if(isset($_POST['international_conference_name'])) {
					$international_conference_name = $_POST['international_conference_name'];
				}
				else {
					echo "Please enter conference name";
				}
			}
			}
		}

		//funded by
		if(isset($_POST['funded_by'])) {
			$funded_by = $_POST['funded_by'];

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
			header("location:add_record.php?sfun=1");
		}

		//sponsored by
		if(isset($_POST['sponsored_by'])) {
			$sponsored_by = $_POST['sponsored_by'];

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
			header("location:add_record.php?sfun=1");
		}

		//get list of faculty mis
		if(isset($_POST['add_facultymis'])) {
			$faculty_mis = $_POST['add_facultymis'];
		}

		if(isset($_POST['add_ug_studentmis'])) {
			$ug_student_mis = $_POST['add_ug_studentmis'];

		}

		if(isset($_POST['add_pg_studentmis'])) {
			$pg_student_mis = $_POST['add_pg_studentmis'];
		}

		if(isset($_POST['add_externalname'])) {
			$external_names = $_POST['add_externalname'];
		}

		if(isset($_FILES["pdffile"]["name"])) {
			$pdffilename = $_FILES["pdffile"]["name"];
			$target_dir = "uploads" . DIRECTORY_SEPARATOR;
			$destination_path = getcwd().DIRECTORY_SEPARATOR;
			$target_file = $destination_path . $target_dir . basename($_FILES["pdffile"]["name"]);
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
			$type = mime_content_type($_FILES["pdffile"]["tmp_name"]);


			if($type == "application/pdf") {
		        $uploadOk = 1;
		    } else {
		        header("location:add_record.php?typerr=1");
		        $uploadOk = 0;
		    }
		    // Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
			    header("location:add_record.php?typerr=1");
			    return;

			// if everything is ok, try to upload file
			} else {
			    if (move_uploaded_file($_FILES["pdffile"]["tmp_name"], $target_file)) {

			    } else {
			        header("location:add_record.php?uperr=1");
			        return;
			    }
			}

		} else {
			echo "Please Upload file";
			return;
		}
		//add all the variables to session

		$_SESSION['title'] = $title;
		$_SESSION['num_pages'] = $num_pages;
		$_SESSION['issueno'] = $issueno;
		$_SESSION['volume'] = $volume;
		$_SESSION['citations'] = $citations;
		$_SESSION['date'] = $date;

		$_SESSION['nat_journal'] = $nat_journal;
		$_SESSION['int_journal'] = $int_journal;
		$_SESSION['nat_conf'] = $nat_conf;
		$_SESSION['int_conf'] = $int_conf;
		$_SESSION['national_journal_name'] = $national_journal_name;
		$_SESSION['international_journal_name'] = $international_journal_name;
		$_SESSION['national_conference_name'] = $national_conference_name;
		$_SESSION['international_conference_name'] = $international_conference_name;

		$_SESSION['faculty_mis'] = $faculty_mis;
		$_SESSION['f_tequip'] = $f_tequip;
		$_SESSION['f_rsa'] = $f_rsa;
		$_SESSION['f_isea'] = $f_isea;
		$_SESSION['f_aicte'] = $f_aicte;
		$_SESSION['f_coep'] = $f_coep;
		$_SESSION['f_others'] = $f_others;
		$_SESSION['t_tequip'] = $t_tequip;
		$_SESSION['t_rsa'] = $t_rsa;
		$_SESSION['t_isea'] = $t_isea;
		$_SESSION['t_aicte'] = $t_aicte;
		$_SESSION['t_coep'] = $t_coep;
		$_SESSION['t_others'] = $t_others;
		$_SESSION['ug_student_mis'] = $ug_student_mis;
		$_SESSION['pg_student_mis'] = $pg_student_mis;
		$_SESSION['external_names'] = $external_names;
		$_SESSION['pdffilename'] = $pdffilename;
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
			Add Record
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
					Note: Co-authors should be registered on this portal to add them by MIS<br /><br />
				<?php
					if(isset($_GET["sfun"]))
						echo '<div id="genMsg" class="alert alert-danger">
								Select at least one each in Sponsored by and Funded by
							</div>';
					if(isset($_GET["typerr"]))
						echo '<div id="genMsg" class="alert alert-danger">
								Invalid file type
							</div>';
					if(isset($_GET["uperr"]))
						echo '<div id="genMsg" class="alert alert-danger">
								Error uploading file
							</div>';
				?>
		    	<form method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label for="title" class="control-label">Title*</label>
						<input type="text" class="form-control" id="title" name="title" placeholder="Enter Title" required>
					</div>

					<div class="form-group"> <!-- Street 1 -->
						<label for="date" class="control-label">Date*</label>
						<input type="date" class="form-control" id="date" name="date" placeholder="yyyy/mm/dd" required>
					</div>

					<div class="form-group"> <!-- Street 2 -->
						<label for="pages" class="control-label">Pages</label>
						<input type="text" class="form-control" id="pages" name="pages" placeholder="No. of pages"	>
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
						<label for="funded_by" class="control-label">Funded By*</label>
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
							<label><input type="checkbox" id = "funded_by" name = "funded_by[]" value="rps"> RPS</label>
						</div>
						<div class="checkbox">
							<label><input type="checkbox" id = "funded_by" name = "funded_by[]" value="aicte"> AICTE</label>
						</div>
						<div class="checkbox">
							<label><input type="checkbox" id = "funded_by" name = "funded_by[]" value="others"> Others</label>
						</div>
					</div>

					<div class="form-group">
						<label for="sponsored_by" class="control-label">Sponsored By*</label>
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

					Co-Authors:<br />
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
		</div>
    </body>
</html>
<?php endif; ?>
