<?php
include('session.php');
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
require_once "db.php";
$db   = new DB();
$flag = 0;
function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
	$query = "SELECT * FROM record WHERE approved_status = 'T'";
	
	if ($_POST["title"] != "") {
		$title = test_input($_POST["title"]);
		$query = $query . " AND title LIKE '%$title%'";
		echo $query;                                            //Only for debugging purposes
	}
	if ($_POST["sdate"] != "" || $_POST["edate"] != "") {
		if($_POST["edate"] == "") {
			$sdate = test_input($_POST["sdate"]);
			$query = $query . " AND date = '$sdate'";
		}
		else if($_POST["sdate"] == "") {
			$edate = test_input($_POST["edate"]);
			$query = $query . " AND date = '$edate'";
		}
		else {
			$sdate = test_input($_POST["sdate"]);
			$edate = test_input($_POST["edate"]);
			$query = $query . " AND date BETWEEN '$sdate' AND '$edate'";
		}
	}
	if ($_POST["pages"] != "") {
		$pages = test_input($_POST["pages"]);
		$query = $query . " AND pages = '$pages'";
	}
	if ($_POST["issueno"] != "") {
		$issueno = $_POST["issueno"];
		$query   = $query . " AND issueno = '$issueno'";
	}
	if ($_POST["volume"] != "") {
		$volume = test_input($_POST["volume"]);
		$query  = $query . " AND volume_no = '$volume'";
	}
	if ($_POST["citations"] != "") {
		$citations = test_input($_POST["citations"]);
		$query     = $query . " AND citations = '$citations'";
	}
	if (isset($_POST["department"]) AND $_POST["department"] != "") { 
		$department = test_input($_POST["department"]);
		$query      = $query . " AND department = '$department'";
	}
	if ($_POST["fname"] != "") {
		$fname = test_input($_POST["fname"]);
		$query = $query . " AND filename LIKE '%$fname%'";
	}
	if ($_POST["approved_by_mis"] != "") {
		$approved_by_mis = test_input($_POST["approved_by_mis"]);
		$query           = $query . " AND approved_by_mis = '$approved_by_mis'";
	}
	if ($_POST["approved_by_name"] != "") {
		$approved_by_name = test_input($_POST["approved_by_name"]);
		$midquery = "SELECT mis FROM users WHERE name LIKE '%$approved_by_name%'";
		$abMIS = $db->run_query($midquery);
		$rowCount = $abMIS->num_rows;
		if($rowCount) {
			$row = mysqli_fetch_array($abMIS, MYSQLI_ASSOC);
			$abMIS = $row["mis"];
			$query           = $query . " AND approved_by_mis = '$abMIS'";
		}
	}
	if ($_POST["submitted_by_mis"] != "") {
		$submitted_by_mis = test_input($_POST["submitted_by_mis"]);
		$query            = $query . " AND submitted_by_mis = '$submitted_by_mis'";
	}
	if ($_POST["submitted_by_name"] != "") {
		$submitted_by_name = test_input($_POST["submitted_by_name"]);
		$midquery = "SELECT mis FROM users WHERE name LIKE '%$submitted_by_name%'";
		$sbMIS = $db->run_query($midquery);
		$rowCount = $sbMIS->num_rows;
		if($rowCount) {
			$row = mysqli_fetch_array($sbMIS, MYSQLI_ASSOC);
			$sbMIS = $row["mis"];
			$query           = $query . " AND submitted_by_mis = '$sbMIS'";
		}
	}
	if (isset($_POST["funded_by"])) {
		foreach ($_POST["funded_by"] as $fund) {
			if ($fund == "isea")
				$query = $query . " AND f_isea = 'T'";
			
			if ($fund == "tequip")
				$query = $query . " AND f_tequip = 'T'";
			
			if ($fund == "coep")
				$query = $query . " AND f_coep = 'T'";
			
			if ($fund == "rsa")
				$query = $query . " AND f_rsa = 'T'";
			
			if ($fund == "aicte")
				$query = $query . " AND f_aicte = 'T'";
			
			if ($fund == "others")
				$query = $query . " AND f_others = 'T'";
		}
	}
	if (isset($_POST["sponsored_by"])) {
		foreach ($_POST["sponsored_by"] as $spons) {
			if ($spons == "isea")
				$query = $query . " AND t_isea = 'T'";
			
			if ($spons == "tequip")
				$query = $query . " AND t_tequip = 'T'";
			
			if ($spons == "coep")
				$query = $query . " AND t_coep = 'T'";
			
			if ($spons == "rsa")
				$query = $query . " AND t_rsa = 'T'";
			
			if ($spons == "aicte")
				$query = $query . " AND t_aicte = 'T'";
			
			if ($spons == "others")
				$query = $query . " AND t_others = 'T'";
			
		}
	}
	
	if(isset($_POST["journal_details"]) AND in_array("national", $_POST["journal_details"])) {
		$natjournal 	= test_input($_POST["national_journal_name"]);		//DOES NOT WORK
		if($natjournal == "")
			$query 		= $query . "AND nat_journal IS NOT NULL";
		else
			$query      = $query . " AND nat_journal = '$natjournal'";
	}
	
	if(isset($_POST["journal_details"]) AND in_array("international", $_POST["journal_details"])) {
		$intjournal = test_input($_POST["international_journal_name"]);			//DOES NOT WORK
		if($intjournal == "")
			$query 		= $query . "AND int_journal IS NOT NULL";
		else
			$query      = $query . " AND int_journal = '$intjournal'";
	}
	
	if(isset($_POST["conference_details"]) AND in_array("national", $_POST["conference_details"])) {
		$natconf = test_input($_POST["national_conference_name"]);			//DOES NOT WORK
		if($natconf == "")
			$query 		= $query . "AND nat_conf IS NOT NULL";
		else
			$query      = $query . " AND nat_conf = '$nat_conf'";
	}
	if(isset($_POST["conference_details"]) AND in_array("international", $_POST["conference_details"])) {
		$intconf = test_input($_POST["international_conference_name"]);			//DOES NOT WORK
		if($intconf == "")
			$query 		= $query . "AND int_conf IS NOT NULL";
		else
			$query      = $query . " AND int_conf = '$int_conf'";
	}
	
	$_SESSION["query"] = $query;
	error_log($query);
    $result = $db->run_query($_SESSION["query"]);
    $rowCount = $result->num_rows;
    if(!$rowCount) {
        $flag = 0;
        echo "<h4 style='text-align:center'>No Results</h2>";
    }
    else {
        $flag = 1;
        $sno = 0;
        echo '<form method = "POST">';
        echo "<b>Hits: " . $rowCount . '</b>';
        echo '<table id="Result-'. $_POST["title"]. date('Y') .'" style="color: black" class="table table-striped table-bordered table-condensed">';
        echo "<tr>
                <th>Title</th>
                <th>Date</th>
                <th>Approved By MIS</th>
                <th>Submitted By MIS</th>
                <th>Department</th>
                <th>Select</th>
            </tr><br>";
        $files = array();
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            echo "<tr>
                    <td>";
                echo "<a href='details.php?id=".$row['idrecord']."'' target='_blank'>". $row['title']. "</a>";
            echo "</td>
                        <td>" . $row['date'] . "</td>
                        <td>" . $row['approved_by_mis'] . "</td>
                        <td>" . $row['submitted_by_mis'] . "</td>
                        <td>" . $row['department'] . "</td>";
                echo "<td><center><input type='checkbox' name = 'sel_$sno' id = 'sel_$sno'></center></td>";
                $sno++;
            echo "</tr>";
        }
        echo '</table>';
    }
echo '<script> TableExport(document.getElementsByTagName("table")); </script>';
// echo '<script> TableExport(document.getElementsByTagName("table"), {
// 	bootstrap: true,
// 	ignoreCols: 5,
// 	position: "bottom"
// }); </script>';
?>