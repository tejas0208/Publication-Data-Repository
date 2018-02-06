<?php

	include('session.php');
	require_once "db.php";

	//check if form data exists
	//https://stackoverflow.com/questions/32405077/show-second-dropdown-options-based-on-first-dropdown-selection-jquery
	
	//returns the max id and updates the id in the database
	function get_max_record_id($dbclient) {
		$query = 'SELECT * FROM `record_id_max` LIMIT 1';
		$result = $dbclient->run_query($query);
		$row = mysqli_fetch_row($result);
		$id = $row[0];
		$query = "DELETE FROM `record_id_max`";
		$dbclient->run_query($query);
		$query = "INSERT INTO `record_id_max` VALUES ('" . ($id+1) . "')";
		$dbclient->run_query($query);
		return $id;
	}

	function test_input($data) {
    	$data = trim($data);
    	$data = stripslashes($data);
    	$data = htmlspecialchars($data);
    	return $data;
  	}

	if(isset($_POST['submit']) and isset($_POST['branch']) and isset($_POST['approver'])) {
		
		if(!isset($_SESSION['title'])) {
			header("location:add_record.php");
		}

		$db = new DB();

		$branch = $_POST['branch'];
		$approver = $_POST['approver'];

		$title = $_SESSION['title'];
		$num_pages = $_SESSION['num_pages'];
		$issueno = $_SESSION['issueno'];
		$volume = $_SESSION['volume'];
		$citations = $_SESSION['citations'];
		$nat_journal = $_SESSION['nat_journal'];
		$int_journal = $_SESSION['int_journal'];
		$nat_conf = $_SESSION['nat_conf'];
		$int_conf = $_SESSION['int_conf'];
		$national_journal_name = $_SESSION['national_journal_name'];
		$international_journal_name = $_SESSION['international_journal_name'];
		$national_conference_name = $_SESSION['national_conference_name'];
		$international_conference_name = $_SESSION['international_conference_name'];
		$f_tequip = $_SESSION['f_tequip'];
		$f_rsa = $_SESSION['f_rsa'];
		$f_isea = $_SESSION['f_isea'];
		$f_aicte = $_SESSION['f_aicte'];
		$f_coep = $_SESSION['f_coep'];
		$f_others = $_SESSION['f_others'];
		$t_tequip = $_SESSION['t_tequip'];
		$t_rsa = $_SESSION['t_rsa'];
		$t_isea = $_SESSION['t_isea'];
		$t_aicte = $_SESSION['t_aicte'];
		$t_coep = $_SESSION['t_coep'];
		$t_others = $_SESSION['t_others'];
		$faculty_mis = $_SESSION['faculty_mis'];
		$ug_student_mis = $_SESSION['ug_student_mis'];
		$pg_student_mis = $_SESSION['pg_student_mis'];
		$external_names = $_SESSION['external_names'];
		$pdffilename = $_SESSION['pdffilename'];
		$date = $_SESSION['date'];

		// unset($_SESSION['title']);
		// unset($_SESSION['num_pages']);
		// unset($_SESSION['issueno']);
		// unset($_SESSION['volume']);
		// unset($_SESSION['citations']);
		// unset($_SESSION['nat_journal']);
		// unset($_SESSION['int_journal']);
		// unset($_SESSION['nat_conf']);
		// unset($_SESSION['int_conf']);
		// unset($_SESSION['national_journal_name']);
		// unset($_SESSION['international_journal_name']);
		// unset($_SESSION['national_conference_name']);
		// unset($_SESSION['international_conference_name']);
		// unset($_SESSION['f_tequip']);
		// unset($_SESSION['f_rsa']);
		// unset($_SESSION['f_isea']);
		// unset($_SESSION['f_aicte']);
		// unset($_SESSION['f_coep']);
		// unset($_SESSION['f_others']);
		// unset($_SESSION['t_tequip']);
		// unset($_SESSION['t_rsa']);
		// unset($_SESSION['t_isea']);
		// unset($_SESSION['t_aicte']);
		// unset($_SESSION['t_coep']);
		// unset($_SESSION['t_others']);
		// unset($_SESSION['faculty_mis']);
		// unset($_SESSION['ug_student_mis']);
		// unset($_SESSION['pg_student_mis']);
		// unset($_SESSION['external_names']);
		// unset($_SESSION['pdffilename']);
		// unset($_SESSION['date']);


		if($title == '')
			$title = 'NULL';
		else
			$title = "'" . $title . "'";

		if($date == '')
			$date = 'NULL';
		else
			$date = "'" . $date . "'";

		if($num_pages == '')
			$num_pages = 'NULL';
		else
			$num_pages = "'" . $num_pages . "'";

		if($issueno == '')
			$issueno = 'NULL';
		else
			$issueno = "'" . $issueno . "'";

		if($volume == '')
			$volume = 'NULL';
		else
			$volume = "'" . $volume . "'";

		if($citations == '')
			$citations = 'NULL';
		else
			$citations = "'" . $citations . "'";

		if($national_journal_name == '')
			$national_journal_name = 'NULL';
		else
			$national_journal_name = "'" . $national_journal_name . "'";
		
		if($international_journal_name == '')
			$international_journal_name = 'NULL';
		else
			$international_journal_name = "'" . $international_journal_name . "'";
		
		if($national_conference_name == '')
			$national_conference_name = 'NULL';
		else
			$national_conference_name = "'" . $national_conference_name . "'";
		
		if($international_conference_name == '')
			$international_conference_name = 'NULL';
		else
			$international_conference_name = "'" . $international_conference_name . "'";
		
		if($f_tequip == '')
			$f_tequip = 'NULL';
		else
			$f_tequip = "'" . $f_tequip . "'";
		
		if($f_rsa == '')
			$f_rsa = 'NULL';
		else
			$f_rsa = "'" . $f_rsa . "'";
		
		if($f_isea == '')
			$f_isea = 'NULL';
		else
			$f_isea = "'" . $f_isea . "'";
		
		if($f_aicte == '')
			$f_aicte = 'NULL';
		else
			$f_aicte = "'" . $f_aicte . "'";
		
		if($f_coep == '')
			$f_coep = 'NULL';
		else
			$f_coep = "'" . $f_coep . "'";
		
		if($f_others == '')
			$f_others = 'NULL';
		else
			$f_others = "'" . $f_others . "'";
		
		if($t_tequip == '')
			$t_tequip = 'NULL';
		else
			$t_tequip = "'" . $t_tequip . "'";
		
		if($t_rsa == '')
			$t_rsa = 'NULL';
		else
			$t_rsa = "'" . $t_rsa . "'";
		
		if($t_isea == '')
			$t_isea = 'NULL';
		else
			$t_isea = "'" . $t_isea . "'";
		
		if($t_aicte == '')
			$t_aicte = 'NULL';
		else
			$t_aicte = "'" . $t_aicte . "'";
		
		if($t_coep == '')
			$t_coep = 'NULL';
		else
			$t_coep = "'" . $t_coep . "'";
		
		if($t_others == '')
			$t_others = 'NULL';
		else
			$t_others = "'" . $t_others . "'";

		if($pdffilename == '')
			$pdffilename = 'NULL';
		else
			$pdffilename = "'" . $pdffilename . "'";
		

		$title = test_input($title);
		$num_pages = test_input($num_pages);
		$issueno = test_input($issueno);
		$volume = test_input($volume);
		$citations = test_input($citations);
		$national_journal_name = test_input($national_journal_name);
		$international_journal_name = test_input($international_journal_name);
		$national_conference_name = test_input($national_conference_name);
		$international_conference_name = test_input($international_conference_name);
		$f_tequip = test_input($f_tequip);
		$f_rsa = test_input($f_rsa);
		$f_isea = test_input($f_isea);
		$f_aicte = test_input($f_aicte);
		$f_coep = test_input($f_coep);
		$f_others = test_input($f_others);
		$t_tequip = test_input($t_tequip);
		$t_rsa = test_input($t_rsa);
		$t_isea = test_input($t_isea);
		$t_aicte = test_input($t_aicte);
		$t_coep = test_input($t_coep);
		$t_others = test_input($t_others);
		$pdffilename = test_input($pdffilename);
		$date = test_input($date);
		
		

		//fetch the row id
		$id = get_max_record_id($db);

		//TODO 
		//APPROVED STATUS
		$approved_status = "'F'";
		$approved_by_mis = "'" . $approver . "'";
		$submitted_by_mis = "'" . $_SESSION['mis'] . "'";
		$department = "'" . $branch . "'";
		
		$query = "INSERT INTO `record` (`idrecord`, `date`, `title`, `f_tequip`, `f_rsa`, `f_isea`, `f_aicte`, `f_coep`, `f_others`, `t_tequip`, `t_isea`, `t_rsa`, `t_aicte`, `t_coep`, `t_others`, `nat_journal`, `int_journal`, `nat_conf`, `int_conf`, `volume_no`, `pages`, `citations`, `approved_status`, `approved_by_mis`, `submitted_by_mis`, `department`, `filename`) VALUES ('$id', $date, $title, $f_tequip, $f_rsa, $f_isea, $f_aicte, $f_coep, $f_others, $t_tequip, $t_isea, $t_rsa, $t_aicte, $t_coep, $t_others, $national_journal_name, $international_journal_name, $national_conference_name, $international_conference_name, $volume, $num_pages, $citations, $approved_status, $approved_by_mis, $submitted_by_mis, $department, $pdffilename)";
		
		echo $query;
		if($db->run_query($query)) {
			//add faculty mis to table
			$length = count($faculty_mis);
			for ($i=0; $i < $length; $i++) { 
				$mis = $faculty_mis[$i];
				$mis = test_input($mis);
				$query = "INSERT INTO `authors` (`idrecord`, `mis`) VALUES ('$id', '$mis')";
				db->run_query(query);
			}

			//add ug student mis to table
			$length = count($ug_student_mis);
			for ($i=0; $i < $length; $i++) { 
				$mis = $ug_student_mis[$i];
				$mis = test_input($mis);
				$query = "INSERT INTO `authors` (`idrecord`, `mis`) VALUES ('$id', '$mis')";
				db->run_query(query);
			}

			//add pg student mis to table
			$length = count($pg_student_mis);
			for ($i=0; $i < $length; $i++) { 
				$mis = $pg_student_mis[$i];
				$mis = test_input($mis);
				$query = "INSERT INTO `authors` (`idrecord`, `mis`) VALUES ('$id', '$mis')";
				db->run_query(query);
			}

			//add external student name to table
			$length = count($external_names);
			for ($i=0; $i < $length; $i++) { 
				$name = $external_names[$i];
				$name = test_input($name);
				$query = "INSERT INTO `external` (`record_id`, `name`) VALUES ('$id', '$name');";
				db->run_query(query);
			}

		}
		else {
			echo "Some Error Occured....Please try again";
			return;
		}
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
    	<div class="wrapper">
		    <div class="register">
		    	<form method="POST">
		    		<div class="form-group"> <!-- State Button -->
			      		<label for="dept_id" class="control-label">Select Department of Approver</label>
			      		<select class="form-control" id="appr_dept_id" name="branch" required>
			      			<option value="Applied Science">Department of Applied Science</option>
			            	<option value="Civil Engineering ">Department of Civil Engineering</option>
			            	<option value="Computer Engineering and Information Technology">Department of Computer Engineering & IT</option>
			            	<option value="Electrical Engineering ">Department of Electrical Engineering</option>
			            	<option value="Electronics and Telecommunication Engineering ">Department of Electronics and Telecommunication Engineering</option>
			            	<option value="Instrumentation and Control Engineering ">Department of Instrumentation and Control Engineering</option>
			            	<option value="maths">Department of Mathematics</option>
			            	<option value="Mechanical Engineering ">Department of Mechanical Engineering</option>
			            	<option value="Metallurgy and Material Science ">Department of Metallurgy and Materials Science</option>
			            	<option value="phy">Department of Physics</option>
			            	<option value = "Planning ">B.Tech Planning</option>
			            	<option value = "Production Engineering and Industrial Management">Department of Production Engineering and Industrial Management</option>
			      		</select>
			      	</div>

					<div class="form-group">
						<label for="select approver" class="control-label">Select Approver</label>
						<select class="form-control" id="approver_name" name="approver" required="">
			      	
			      		</select>
					</div>

					<div class="form-group btn"> <!-- Submit Button -->
						<button class="btn" name="submit">Next</button>
					</div>	
				</form>
			</div>
		</div>	
	</body>
</html>
<?php endif; ?>					