<?php

	require_once "db.php";

	if(isset($_GET['dept'])) {
		$dept = $_GET['dept'];
		$query = "SELECT mis, name FROM users WHERE (level='executive' OR level='approver') AND department='" . $dept . "'";
		$db = new DB();
		$result = $db->run_query($query);
		
		$i = 0;
		echo "{";
		while ($row=mysqli_fetch_row($result)) {
			if($i == $result->num_rows-1) {
				echo '"' . $row[0] . '":"' . $row[1] . '"';
			}
			else {
				echo '"' . $row[0] . '":"' . $row[1] . '",';
			}
			$i++;	
		}
		echo "}";
	}

?>

<?php if(!isset($_GET['dept'])) : ?>
	<form method="get">
		<input type="text" name="dept">
		<button type="submit" value="submit">
	</form>
<?php endif; ?>