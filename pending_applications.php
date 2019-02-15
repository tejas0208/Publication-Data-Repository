<?php
	include('session.php');
	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', 1);
	require_once "db.php";
	//Flags
	$is_faculty      = 0;
	$required_status = 0;
	$no_reason_flag  = 0;
	$rejected_flag   = 0;
	$accepted_flag   = 0;
	$db              = new DB();
	$query           = "SELECT *  from users where username = '" . $_SESSION['username'] . "'";
	$result          = $db->run_query($query);
	$result          = mysqli_fetch_row($result);
	$role            = $result[4];

	if ($role == "faculty")
		$is_faculty = 1;
	else {
		$dept_of_user = $result[8];
		if ($role == "hod") {
			$required_status = 1;
			$query           = "select a.aid, a.idrecord, a.initial_paper, a.fund_required, r.date, r.title from applications a left join record r on a.idrecord = r.idrecord where r.department = '" . $dept_of_user . "' and a.approved_level = $required_status";
		} else {
			if ($role == "dean")
				$required_status = 2;
			if ($role == "director")
				$required_status = 4;
			$query = "select a.aid, a.idrecord, a.initial_paper, a.fund_required, r.date, r.title from applications a left join record r on a.idrecord = r.idrecord where a.approved_level = $required_status";
		}
		$result = $db->run_query($query);
	}

	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	if (mysqli_num_rows($result) != 0) {
		while ($row = mysqli_fetch_array($result)) {
			$id = $row['aid'];
			$A  = "A" . $id;
			$R  = "R" . $id;
			if (isset($_POST[$R])) {
				if ($required_status == 1)
					$status = 3;
				else if ($required_status == 2)
					$status = 5;
				else
					$status = 9;
				// The record is rejected, need to be added in the table
				// Check if there is a reason given
				$reason = test_input($_POST["rejection_comment"]);
				if ($reason != "" && strlen($reason) < 1024) {
					$query         = "UPDATE applications set approved_level = '" . $status . "' where aid = '$id'";
					$result        $db->run_query($query);
					$query         = "UPDATE applications set Comment = '" . $reason . "' where aid = '$id'";
					$result        = $db->run_query($query);
					$rejected_flag = 1;
				} else {
					$no_reason_flag = 1;
				}

			}
			if (isset($_POST[$A])) {
				$status        = $required_status * 2;
				$query         = "UPDATE applications set approved_level = '" . $status . "' where aid = '$id'";
				$result        = $db->run_query($query);
				$accepted_flag = 1;
			}
		}
	}
	?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<!-- Meta, title, CSS, favicons, etc. -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>
			Pending Approvals
		</title>
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/menu.css">
		<link rel="stylesheet" href="css/register.css">
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
				<h1 class="navheader"> Publication Data Repository </h1>
			</div>
		</div>
		<form action="pending_applications.php" method="POST">
			<div class="pendingappr">
				<?php
					if ($no_reason_flag == 1) {
					   	echo '<br>
					<div class="alert alert-danger alert-dismissible fade show">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Please enter a valid rejection reason.</strong>
					</div>';
					 }
					 if($rejected_flag == 1) {
					   	echo '<br>
					<div class="alert alert-danger alert-dismissible fade show">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Record updated!</strong>
					</div>';
					 }
					 if($accepted_flag == 1) {
					   	echo '<br>
					<div class="alert alert-success alert-dismissible fade show">
					<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Record updated!</strong>
					</div>';
					}

					if($is_faculty == 1) {
					    	echo "Nothing to show";
					} else {
					    	$i = 1;
					    	$result = $db->run_query($query);
					    	if(mysqli_num_rows($result) == 0) {
					    		echo "Nothing to show";
					    	} else {
					    		echo '<table class="table table-striped table-bordered table-condensed">
					            <thead>
					              <tr>
					                <th>Sr.No.</th>
					                <th>Title</th>
					                <th>Date</th>
													<th>Fund Required</th>
					  							<th>Approve / Reject</th>
					              </tr>
					            </thead>
					            <tbody>';

					            while ($row = mysqli_fetch_array($result)) {
												$rid = $row['idrecord'];
												$aid = $row['aid'];
												$title = $row['title'];
												$date = $row['date'];
												$fund = $row['fund_required'];
					            	echo '
					            <tr>
					              <td>'.$i.'</td>
					              <td><u><a href = "details.php?id='.$rid.'" target="_blank">'.$title.'</a></u></td>
					              <td>'.$date.'</td>
												<td>'.$fund.'</td>
					              <td>
					                <textarea class="form-control" rows="5" name="rejection_comment" placeholder="max 1024 chars"></textarea>
					                <button class = "btn btn-success" name = "A'.$aid.'">Approve</a>
					                <button class = "btn btn-danger" name = "R'.$aid.'">Reject</a>
					              </td>
					            </tr>
					          ';
					          $i++;
					          }
					         echo '</tbody></table>';
					    }
					}
			  ?>
			</div>
		</form>
		</div>
	</body>
</html>
