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
		<?php
			include('session.php');
			ini_set('error_reporting', E_ALL);
			ini_set('display_errors', 1);
			require_once "db.php";
			$db = new DB();
		?>
		<form method = "GET">
			<div class="form-group">
				<label for="title" class="control-label">Title</label>
				<input type="text" class="form-control" id="title" name="title" placeholder="Enter Title">
			</div>
			<div class="form-group">
				<label for="date" class="control-label">Date</label>
				<input type="text" class="form-control" id="date" name="date" placeholder="yyyy/mm/dd">
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
				<label for="citations" class="control-label">Department</label>
				<input type="text" class="form-control" id="department" name="department" placeholder="Department">
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
				<label for="citations" class="control-label">File Name</label>
				<input type="text" class="form-control" id="fname" name="fname" placeholder="File Name">
			</div>
			<div class="checkbox">
				<label><input type="checkbox" id = "approved" name="approved" value="approved"> Approved</label>
			</div>
			<div class="form-group">
				<label for="title" class="control-label">Approved By</label>
				<input type="text" class="form-control" id="approved_by_mis" name="approved_by_mis" placeholder="MIS">
			</div>
			<div class="form-group">
				<label for="title" class="control-label">Submitted By</label>
				<input type="text" class="form-control" id="submitted_by_mis" name="submitted_by_mis" placeholder="MIS">
			</div>
			<div class="form-group">
				<input type="submit" class="btn btn-primary" id="submit" name="submit" value="Search">
			</div>
		</form>
			<?php
				if(isset($_GET["submit"])) {
					$query = "SELECT * FROM record";
					$flag = 0;
					if($_GET["title"] != "") {
						$title = $_GET["title"];
						$query = $query . " WHERE title = '$title'";
						$flag = 1;
					}
					if($_GET["date"] != "") {
						$date = $_GET["date"];
						if($flag) 
							$query = $query . " AND date = '$date'";
						else {
							$query = $query . " WHERE date = '$date'";
							$flag = 1;
						}
					}
					if($_GET["pages"] != "") {
						$pages = $_GET["pages"];
						if($flag)
							$query = $query . " AND pages = '$pages'";
						else {
							$query = $query . " WHERE pages = '$pages'";
							$flag = 1;
						}
					}
					if($_GET["issueno"] != "") {
						$issueno = $_GET["issueno"];
						if($flag)
							$query = $query . " AND issueno = '$issueno'";
						else {
							$query = $query . " WHERE issueno = '$issueno'";
							$flag = 1;
						}
					}
					if($_GET["volume"] != "") {
						$volume = $_GET["volume"];
						if($flag)
							$query = $query . " AND volume_no = '$volume'";
						else {
							$query = $query . " WHERE volume_no = '$volume'";
							$flag = 1;
						}
					}
					if($_GET["citations"] != "") {
						$issueno = $_GET["citations"];
						if($flag)
							$query = $query . " AND citations = '$citations'";
						else {
							$query = $query . " WHERE citations = '$citations'";
							$flag = 1;
						}
					}
					if($_GET["department"] != "") { //Switch to dropdown
						$department = $_GET["department"];
						if($flag)
							$query = $query . " AND department = '$department'";
						else {
							$query = $query . " WHERE department = '$department'";
							$flag = 1;
						}
					}
					if($_GET["fname"] != "") {
						$fname = $_GET["fname"];
						if($flag)
							$query = $query . " AND filename = '$fname'";
						else {
							$query = $query . " WHERE filename = '$fname'";
							$flag = 1;
						}
					}
					if(isset($_GET["approved"])) {
						$approved = $_GET["approved"];
						if($flag)
							$query = $query . " AND approved_status = 'T'";
						else {
							$query = $query . " WHERE approved_status = 'T'";
							$flag = 1;
						}
					}
					if($_GET["approved_by_mis"] != "") {
						$approved_by_mis = $_GET["approved_by_mis"];
						if($flag)
							$query = $query . " AND approved_by_mis = '$approved_by_mis'";
						else {
							$query = $query . " WHERE approved_by_mis = '$approved_by_mis'";
							$flag = 1;
						}
					}
					if($_GET["submitted_by_mis"] != "") {
						$submitted_by_mis = $_GET["submitted_by_mis"];
						if($flag)
							$query = $query . " AND submitted_by_mis = '$submitted_by_mis'";
						else {
							$query = $query . " WHERE submitted_by_mis = '$submitted_by_mis'";
							$flag = 1;
						}
					}
					if(isset($_GET["funded_by"])) {
						foreach($_GET["funded_by"] as $fund) {
							if($fund == "isea") {
								if($flag)
									$query = $query . " AND f_isea = 'T'";
								else {
									$query = $query . " WHERE f_isea = 'T'";
									$flag = 1;
								}
							}
							if($fund == "tequip") {
								if($flag)
									$query = $query . " AND f_tequip = 'T'";
								else {
									$query = $query . " WHERE f_tequip = 'T'";
									$flag = 1;
								}
							}
							if($fund == "coep") {
								if($flag)
									$query = $query . " AND f_coep = 'T'";
								else {
									$query = $query . " WHERE f_coep = 'T'";
									$flag = 1;
								}
							}
							if($fund == "rsa") {
								if($flag)
									$query = $query . " AND f_rsa = 'T'";
								else {
									$query = $query . " WHERE f_rsa = 'T'";
									$flag = 1;
								}
							}
							if($fund == "aicte") {
								if($flag)
									$query = $query . " AND f_aicte = 'T'";
								else {
									$query = $query . " WHERE f_aicte = 'T'";
									$flag = 1;
								}
							}
							if($fund == "others") {
								if($flag)
									$query = $query . " AND f_others = 'T'";
								else {
									$query = $query . " WHERE f_others = 'T'";
									$flag = 1;
								}
							}
						}
					}
					if(isset($_GET["sponsored_by"])) {
						foreach($_GET["sponsored_by"] as $spons) {
							if($spons == "isea") {
								if($flag)
									$query = $query . " AND t_isea = 'T'";
								else {
									$query = $query . " WHERE t_isea = 'T'";
									$flag = 1;
								}
							}
							if($spons == "tequip") {
								if($flag)
									$query = $query . " AND t_tequip = 'T'";
								else {
									$query = $query . " WHERE t_tequip = 'T'";
									$flag = 1;
								}
							}
							if($spons == "coep") {
								if($flag)
									$query = $query . " AND t_coep = 'T'";
								else {
									$query = $query . " WHERE t_coep = 'T'";
									$flag = 1;
								}
							}
							if($spons == "rsa") {
								if($flag)
									$query = $query . " AND t_rsa = 'T'";
								else {
									$query = $query . " WHERE t_rsa = 'T'";
									$flag = 1;
								}
							}
							if($spons == "aicte") {
								if($flag)
									$query = $query . " AND t_aicte = 'T'";
								else {
									$query = $query . " WHERE t_aicte = 'T'";
									$flag = 1;
								}
							}
							if($spons == "others") {
								if($flag)
									$query = $query . " AND t_others = 'T'";
								else {
									$query = $query . " WHERE t_others = 'T'";
									$flag = 1;
								}
							}
						}
					}

					echo $query;
		            $result = $db->run_query($query);
			        echo '<table class="table table-striped table-bordered table-condensed">';
						echo "<tr>
								<th>Title</th>
								<th>Date</th>
								<th>Approved By MIS</th>
								<th>Submitted By MIS</th>
								<th>Department</th>
							</tr>
							";
						while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
							echo "<tr>
									<td>". $row['title']. "</td>
									<td>" . $row['date'] . "</td>
									<td>" . $row['approved_by_mis'] . "</td>
									<td>" . $row['submitted_by_mis'] . "</td>
									<td>" . $row['department'] . "</td>
								</tr>";
						}
			    	echo '</table>';
			    }
		    ?>
		    </div>
		</div>
	</body>
</html>