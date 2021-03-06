<?php
include('session.php');
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
require_once "db.php";
$no_reason_flag = 0;
$rejected_flag  = 0;
$accepted_flag  = 0;
$db             = new DB();
$query          = "SELECT *  from users where username = '" . $_SESSION['username'] . "'";
$result         = $db->run_query($query);
$result         = mysqli_fetch_row($result);
$mis            = $result[1];
$query          = "SELECT * from record where approved_by_mis = $mis and approved_status = 'NA'";
$result         = $db->run_query($query);

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (mysqli_num_rows($result) != 0) {
    while ($row = mysqli_fetch_array($result)) {
        $id = $row['idrecord'];
        $A  = "A" . $id;
        $R  = "R" . $id;
        if (isset($_POST[$R])) {
            // The record is rejected, need to be added in the table
            // Check if there is a reason given
            $reason = test_input($_POST["rejection_comment"]);
            if ($reason != "" || strlen($reason) > 1024) {
                $query         = "UPDATE record set approved_status = 'F' where idrecord = '$id'";
                $result        = $db->run_query($query);
                $query         = "INSERT INTO `rejection_record` (`idrecord`, `reason`) VALUES ('$id', '$reason')";
                $result        = $db->run_query($query);
                $rejected_flag = 1;
            } else {
                $no_reason_flag = 1;
            }

        }
        if (isset($_POST[$A])) {
            $query         = "UPDATE record set approved_status = 'T' where idrecord = '$id'";
            $result        = $db->run_query($query);
            $accepted_flag = 1;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
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
    <form action="pending_approvals.php" method="POST">
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
          $i = 1;
          $query = "SELECT * from users where username = '".$_SESSION['username']."'";
          $result = $db->run_query($query);
          $result = mysqli_fetch_row($result);
          $mis = $result[1];
          $query = "SELECT * from record where approved_by_mis = $mis and approved_status = 'NA'";
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
          <th>Approve / Reject</th>
                      </tr>
                    </thead>
                    <tbody>';

                while ($row = mysqli_fetch_array($result)) {
                  $rid = $row['idrecord'];
                  $title = $row['title'];
                  $date = $row['date'];
                  echo '
                    <tr>
                      <td>'.$i.'</td>
                      <td><u><a href = "details.php?id='.$rid.'" target="_blank">'.$title.'</a></u></td>
                      <td>'.$date.'</td>
                      <td>
                        <textarea class="form-control" rows="5" name="rejection_comment" placeholder="max 1024 chars"></textarea>
                        <button class = "btn btn-success" name = "A'.$rid.'">Approve</a>
                        <button class = "btn btn-danger" name = "R'.$rid.'">Reject</a>
                      </td>
                    </tr>
                  ';
                  $i++;
                }
                echo '</tbody></table>';


          }
        ?>
      </div>
    </form>

  </body>
</html>
