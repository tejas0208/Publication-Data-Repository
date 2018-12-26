<?php
	include('session.php');
			ini_set('error_reporting', E_ALL);
			ini_set('display_errors', 1);
			require_once "db.php";
			$db = new DB();
			$flag = 0;
				if(isset($_POST["submit"])) {
					$query = "SELECT * FROM record WHERE approved_status = 'T'";
					if($_POST["title"] != "") {
						$title = $_POST["title"];
						$query = $query . " AND title = '$title'";
					}
					if($_POST["date"] != "") {
						$date = $_POST["date"];
						$query = $query . " AND date = '$date'";
					}
					if($_POST["pages"] != "") {
						$pages = $_POST["pages"];
						$query = $query . " AND pages = '$pages'";
					}
/*					if($_POST["issueno"] != "") {
						$issueno = $_POST["issueno"];
						$query = $query . " AND issueno = '$issueno'";
					}*/
					if($_POST["volume"] != "") {
						$volume = $_POST["volume"];
						$query = $query . " AND volume_no = '$volume'";
					}
					if($_POST["citations"] != "") {
						$citations = $_POST["citations"];
						$query = $query . " AND citations = '$citations'";
					}
					if($_POST["department"] != "") { //Switch to dropdown maybe?
						$department = $_POST["department"];
						$query = $query . " AND department = '$department'";
					}
					if($_POST["fname"] != "") {
						$fname = $_POST["fname"];
						$query = $query . " AND filename = '$fname'";
					}
					if($_POST["approved_by_mis"] != "") {
						$approved_by_mis = $_POST["approved_by_mis"];
						$query = $query . " AND approved_by_mis = '$approved_by_mis'";
					}
					if($_POST["submitted_by_mis"] != "") {
						$submitted_by_mis = $_POST["submitted_by_mis"];
						$query = $query . " AND submitted_by_mis = '$submitted_by_mis'";
					}
					if(isset($_POST["funded_by"])) {
						foreach($_POST["funded_by"] as $fund) {
							if($fund == "isea")
								$query = $query . " AND f_isea = 'T'";

							if($fund == "tequip")
								$query = $query . " AND f_tequip = 'T'";

							if($fund == "coep")
								$query = $query . " AND f_coep = 'T'";

							if($fund == "rsa")
								$query = $query . " AND f_rsa = 'T'";

							if($fund == "aicte")
								$query = $query . " AND f_aicte = 'T'";

							if($fund == "others")
								$query = $query . " AND f_others = 'T'";
						}
					}
					if(isset($_POST["sponsored_by"])) {
						foreach($_POST["sponsored_by"] as $spons) {
							if($spons == "isea")
								$query = $query . " AND t_isea = 'T'";

							if($spons == "tequip")
								$query = $query . " AND t_tequip = 'T'";

							if($spons == "coep")
								$query = $query . " AND t_coep = 'T'";

							if($spons == "rsa") 
								$query = $query . " AND t_rsa = 'T'";

							if($spons == "aicte")
								$query = $query . " AND t_aicte = 'T'";

							if($spons == "others")
								$query = $query . " AND t_others = 'T'";

						}
					}

					if(isset($_POST["national_journal_details"])) {
						$natjournal = $_POST["national_journal_details"];
						$query = $query . " AND nat_journal = '$natjournal'";
					}

					if(isset($_POST["international_journal_details"])) {
						$intjournal = $_POST["international_journal_details"];
						$query = $query . " AND int_journal = '$intjournal'";
					}

					if(isset($_POST["national_conference_details"])) {
						$natconf = $_POST["national_conference_details"];
						$query = $query . " AND nat_conf = '$natconf'";
					}
					if(isset($_POST["international_conference_details"])) {
						$intconf = $_POST["international_conference_details"];
						$query = $query . " AND int_conf = '$intconf'";
					}

					$_SESSION["query"] = $query;
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
			Data Report
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
		    	<?php
					if(isset($_POST["submit"]) || isset($_POST["downpdf"])) {
					    $result = $db->run_query($_SESSION["query"]);
					    $rowCount = $result->num_rows;
					    if(!$rowCount) {
					    	$flag = 0;
					    	echo "<h4 style='text-align:center'>No Results</h2>";
					    }
					    else {
					    	$flag = 1;
						    if(isset($_POST["downpdf"])) 
						    	ob_start();
						    echo '<table style="color: black" class="table table-striped table-bordered table-condensed">';
							echo "<tr>
									<th>Title</th>
									<th>Date</th>
									<th>Approved By MIS</th>
									<th>Submitted By MIS</th>
									<th>Department</th>
								</tr>";
							while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
								echo "<tr>
											<td><a href='details.php?id=".$row['idrecord']."''>". $row['title']. "</a></td>
											<td>" . $row['date'] . "</td>
											<td>" . $row['approved_by_mis'] . "</td>
											<td>" . $row['submitted_by_mis'] . "</td>
											<td>" . $row['department'] . "</td>
										</tr>";
							}
						    echo '</table>';
						    if(isset($_POST["downpdf"])) {
						    	$t = time();
						    	$user = $_SESSION['username'];
							    $table = ob_get_clean();
							    require_once __DIR__ . '/vendor/autoload.php';
								$mpdf = new \Mpdf\Mpdf(['orientation' => 'L']);
								$mpdf->WriteHTML($table);
								$mpdf->Output("search_"."$user"."_"."$t".".pdf", "D");
								unset($_session['query']);
							}
						}
					}
				?>
				<form method = "POST">
					<div class="form-group">
						<label for="title" class="control-label">Title</label>
						<input type="text" class="form-control" id="title" name="title"
						<?php
							if(isset($_POST["title"]))
								echo 'value="'.$_POST["title"].'"';
						?> placeholder="Enter Title">
					</div>
					<div class="form-group">
						<label for="date" class="control-label">Date</label>
						<input type="text" class="form-control" id="date" name="date"
						<?php
							if(isset($_POST["date"]))
								echo 'value="'.$_POST["date"].'"';
						?> placeholder="yyyy/mm/dd">
					</div>
					<div class="form-group">
						<label for="pages" class="control-label">Pages</label>
						<input type="text" class="form-control" id="pages" name="pages"
						<?php
							if(isset($_POST["pages"]))
								echo 'value="'.$_POST["pages"].'"';
						?> placeholder="No. of pages">
					</div>
					<!--<div class="form-group">
						<label for="issueno" class="control-label">Issue no</label>
						<input type="text" class="form-control" id="issueno" name="issueno"
						<?php
							echo 'value="';
							if(isset($_POST["issueno"]))
								echo $_POST["issueno"];
							echo '"';
						?> placeholder="Enter issue no">
					</div>-->
					<div class="form-group">
						<label for="volume" class="control-label">Volume</label>
						<input type="text" class="form-control" id="volume" name="volume"
						<?php
							if(isset($_POST["volume"]))
								echo 'value="'.$_POST["volume"].'"';
						?> placeholder="Enter Volume">
					</div>
					<div class="form-group">
						<label for="citations" class="control-label">Citations</label>
						<input type="text" class="form-control" id="citations" name="citations"
						<?php
							if(isset($_POST["citations"]))
								echo 'value="'.$_POST["citations"].'"';
						?> placeholder="Citations">
					</div>
					<div class="form-group">
						<label for="citations" class="control-label">Department</label>
						<input type="text" class="form-control" id="department" name="department"
						<?php
							if(isset($_POST["department"]))
								echo 'value="'.$_POST["department"].'"';
						?> placeholder="Department">
					</div>
					<div class="form-group">
						<label for="funded_by" class="control-label">Funded By</label>
						<div class="checkbox">
							<label><input type="checkbox" id = "funded_by" name = "funded_by[]" value="isea"
						<?php
							if(isset($_POST["funded_by"]) AND in_array("isea", $_POST["funded_by"]))
								echo 'checked="checked"';
						?>> ISEA</label>
						</div>
						<div class="checkbox">
							<label><input type="checkbox" id = "funded_by" name = "funded_by[]" value="tequip"
						<?php
							if(isset($_POST["funded_by"]) AND in_array("tequip", $_POST["funded_by"]))
								echo 'checked="checked"';
						?>> TEQUIP</label>
						</div>
						<div class="checkbox">
							<label><input type="checkbox" id = "funded_by" name = "funded_by[]" value="coep"
						<?php
							if(isset($_POST["funded_by"]) AND in_array("coep", $_POST["funded_by"]))
								echo 'checked="checked"';
						?>> COEP</label>
						</div>
						<div class="checkbox">
							<label><input type="checkbox" id = "funded_by" name = "funded_by[]" value="rsa"
						<?php
							if(isset($_POST["funded_by"]) AND in_array("rsa", $_POST["funded_by"]))
								echo 'checked="checked"';
						?>> RSA</label>
						</div>
						<div class="checkbox">
							<label><input type="checkbox" id = "funded_by" name = "funded_by[]" value="aicte"
						<?php
							if(isset($_POST["funded_by"]) AND in_array("aicte", $_POST["funded_by"]))
								echo 'checked="checked"';
						?>a> AICTE</label>
						</div>
						<div class="checkbox">
							<label><input type="checkbox" id = "funded_by" name = "funded_by[]" value="others"
						<?php
							if(isset($_POST["funded_by"]) AND in_array("others", $_POST["funded_by"]))
								echo 'checked="checked"';
						?>> Others</label>
						</div>
					</div>
					<div class="form-group">
						<label for="sponsored_by" class="control-label">Sponsored By</label>
						<div class="checkbox">
							<label><input type="checkbox" id = "sponsored_by" name="sponsored_by[]" value="isea"
						<?php
							if(isset($_POST["sponsored_by"]) AND in_array("isea", $_POST["sponsored_by"]))
								echo 'checked="checked"';
						?>> ISEA</label>
						</div>
						<div class="checkbox">
							<label><input type="checkbox" id = "sponsored_by" name="sponsored_by[]" value="tequip"
						<?php
							if(isset($_POST["sponsored_by"]) AND in_array("tequip", $_POST["sponsored_by"]))
								echo 'checked="checked"';
						?>> TEQUIP</label>
						</div>
						<div class="checkbox">
							<label><input type="checkbox" id = "sponsored_by" name="sponsored_by[]" value="coep"
						<?php
							if(isset($_POST["sponsored_by"]) AND in_array("coep", $_POST["sponsored_by"]))
								echo 'checked="checked"';
						?>> COEP</label>
						</div>
						<div class="checkbox">
							<label><input type="checkbox" id = "sponsored_by" name="sponsored_by[]" value="rps"
						<?php
							if(isset($_POST["sponsored_by"]) AND in_array("rps", $_POST["sponsored_by"]))
								echo 'checked="checked"';
						?>> RPS</label>
						</div>
						<div class="checkbox">
							<label><input type="checkbox" id = "sponsored_by" name="sponsored_by[]" value="aicte"
						<?php
							if(isset($_POST["sponsored_by"]) AND in_array("aicte", $_POST["sponsored_by"]))
								echo 'checked="checked"';
						?>> AICTE</label>
						</div>
						<div class="checkbox">
							<label><input type="checkbox" id = "sponsored_by" name="sponsored_by[]" value="others"
						<?php
							if(isset($_POST["sponsored_by"]) AND in_array("others", $_POST["sponsored_by"]))
								echo 'checked="checked"';
						?>> Others</label>
						</div>
					</div>
					<div class="form-group">
						<label for="journal_details" class="control-label">Journal Details: </label>
						<div class="checkbox">
							<label><input type="checkbox" class = "journal_details" name="journal_details[]" value="national" 
						<?php
							if(isset($_POST["journal_details"]) AND in_array("national", $_POST["journal_details"]))
								echo 'checked="checked"';
						?>> National </label>
						</div>
						<div class="checkbox">
							<label><input type="checkbox" class = "journal_details" name="journal_details[]" value="international"
						<?php
							if(isset($_POST["journal_details"]) AND in_array("international", $_POST["journal_details"]))
								echo 'checked="checked"';
						?>> International</label>
						</div>
					</div>
					<div class="form-group">
						<label for="conference_details" class="control-label">Conference Details: </label>
						<div class="checkbox">
							<label><input type="checkbox" class = "conference_details" name="conference_details[]" value="national"
						<?php
							if(isset($_POST["conference_details"]) AND in_array("national", $_POST["conference_details"]))
								echo 'checked="checked"';
						?>> National</label>
						</div>
						<div class="checkbox">
							<label><input type="checkbox" class = "conference_details" name="conference_details[]" value="international"
						<?php
							if(isset($_POST["conference_details"]) AND in_array("international", $_POST["conference_details"]))
								echo 'checked="checked"';
						?>> International</label>
						</div>
					</div>
					<div class="form-group">
						<label for="citations" class="control-label">File Name</label>
						<input type="text" class="form-control" id="fname" name="fname"
						<?php
							if(isset($_POST["fname"]))
								echo 'value="'.$_POST["fname"].'"';
						?> placeholder="File Name">
					</div>
					<div class="form-group">
						<label for="title" class="control-label">Approved By</label>
						<input type="text" class="form-control" id="approved_by_mis" name="approved_by_mis"
						<?php
							if(isset($_POST["approved_by_mis"]))
								echo 'value="'.$_POST["approved_by_mis"].'"';
						?> placeholder="MIS">
					</div>
					<div class="form-group">
						<label for="title" class="control-label">Submitted By</label>
						<input type="text" class="form-control" id="submitted_by_mis" name="submitted_by_mis"
						<?php
							if(isset($_POST["submitted_by_mis"]))
								echo 'value="'.$_POST["submitted_by_mis"].'"';
						?> placeholder="MIS">
					</div>
					<div class="form-group">
						<input type="submit" class="btn btn-primary" id="submit" name="submit" value="Search">
					</div>
					<?php
						if($flag)
							echo '<div class="form-group">
						<input type="submit" class="btn btn-primary" id="downpdf" name="downpdf" value="Download as PDF">
					</div>';
					?>
				</form>
			</div>
		</div>
		</div>
	</div>
	</body>
</html>