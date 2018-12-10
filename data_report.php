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
				<input type="text" class="form-control" id="title" name="title" placeholder="Enter Title" required>
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
				<input type="submit" class="btn btn-primary" id="submit" name="submit">
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
						else
							$query = $query . " WHERE date = '$date'";
					}
					if($_GET["pages"] != "") {
						$pages = $_GET["pages"];
						if($flag)
							$query = $query . " AND pages = '$pages'";
						else
							$query = $query . " WHERE pages = '$pages'";
					}
					if($_GET["issueno"] != "") {
						$issueno = $_GET["issueno"];
						if($flag)
							$query = $query . " AND issueno = '$issueno'";
						else
							$query = $query . " WHERE issueno = '$issueno'";
					}
					if($_GET["volume"] != "") {
						$volume = $_GET["volume"];
						if($flag)
							$query = $query . " AND volume = '$volume'";
						else
							$query = $query . " WHERE volume = '$volume'";
					}
					if($_GET["citations"] != "") {
						$issueno = $_GET["citations"];
						if($flag)
							$query = $query . " AND citations = '$citations'";
						else
							$query = $query . " WHERE citations = '$citations'";
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