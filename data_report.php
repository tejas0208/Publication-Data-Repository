<?php
	include('session.php');
	ini_set('error_reporting', E_ALL);
	ini_set('display_errors', 1);
	require_once "db.php";
	$db = new DB();
	function setsearch($search) {
		$printTable = 1;
		if(!strcmp($search, "SB"))
			$SBTitle = 1;
	}
	if(isset($SBTitle)) {
		echo "test2";
		$query = "SELECT * FROM record WHERE approved_status = 'T' ORDER BY title";
		$result = $db->run_query($query);
	}
	if(isset($SBDate)) {
		$query = "SELECT * FROM record WHERE approved_status = 'T' ORDER BY date";
		$result = $db->run_query($query);
	}
	if(isset($SBSMIS)) {
		$query = "SELECT * FROM record WHERE approved_status = 'T' ORDER BY submitted_by_mis";
		$result = $db->run_query($query);
	}
	if(isset($SBAMIS)) {
		$query = "SELECT * FROM record WHERE approved_status = 'T' ORDER BY approved_by_mis";
		$result = $db->run_query($query);
	}
	if(isset($SBDept)) {
		$query = "SELECT * FROM record WHERE approved_status = 'T' ORDER BY department";
		$result = $db->run_query($query);
	}
	if(isset($SBID)) {
		$query = "SELECT * FROM record WHERE approved_status = 'T' ORDER BY idrecord";
		$result = $db->run_query($query);
	}
?>
<button onclick="document.write('<?php setsearch("SB"); ?>')">SBTitle</button>

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
        <table class="table table-striped table-bordered table-condensed">
	<?php
		if(isset($printTable)) {
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
		}
	?>
      </table>
    </div>
</div>