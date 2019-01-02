<?php
  include('session.php');
  ini_set('error_reporting', E_ALL);
  ini_set('display_errors', 1);
  require_once "db.php";

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
      My Applications
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
        <h1 class="navheader">Publication Data Repository</h1>
      </div>
    </div>
    <div class="myappl">
      <?php
        $i      = 1;
        $db     = new DB();
        $query  = "SELECT * from users where username = '" . $_SESSION['username'] . "'";
        $result = $db->run_query($query);
        $result = mysqli_fetch_row($result);
        $mis    = $result[1];
        $query  = "select * from applications where idrecord in (select idrecord from record where submitted_by_mis = $mis)";
        //$query  = "SELECT * from record where submitted_by_mis = $mis";
        $result = $db->run_query($query);
        if (mysqli_num_rows($result) == 0) {
            echo "Nothing to show";
        } else {
            echo '<table class="table table-striped table-bordered table-condensed">
              <thead>
                <tr>
                  <th>Sr.No.</th>
                  <th>Title</th>
                  <th>Date</th>
                  <th>Fund Required</th>
                  <th>Status</th>
                  <th>Comments</th>
                </tr>
              </thead>
              <tbody>';

            while ($row = mysqli_fetch_array($result)) {
                $aid    = $row['aid'];
                $rid    = $row['idrecord'];
                $fund   = $row['fund_required'];
                $status = $row['approved_level'];
                $date   = $row['date'];

                $query_for_title = "SELECT title from record where idrecord = $rid";
                $title = $db->run_query($query_for_title);
                $title = mysqli_fetch_row($title);
                $title = $title[0];

                if($status == 1) {
                  $color = "black";
                  $message = "Pending";
                  $reason = "Pending for approval by HOD";
                } else if ($status == 2) {
                  $color = "black";
                  $message = "Pending";
                  $reason = "Pending for approval by Dean";
                } else if ($status == 3) {
                  $color = "red";
                  $message = "Rejected by HOD";
                  $reason = $row["Comment"];
                } else if ($status == 4) {
                  $color = "black";
                  $message = "Pending";
                  $reason = "Pending for approval by Director";
                } else if ($status == 5) {
                  $color = "red";
                  $message = "Rejected by Dean";
                  $reason = $row["Comment"];
                } else if ($status == 8) {
                  $color = "green";
                  $message = "Approved";
                  $reason = "Approved by Director";
                } else {
                  $color = "red";
                  $message = "Rejected by Director";
                  $reason = $row["Comment"];
                }
                echo '
              <tr>
                <td>' . $i . '</td>
                <td><u><a href = "details.php?id=' . $rid . '" target="_blank">' . $title . '</a></u></td>
                <td>' . $date . '</td>
                <td>'. $fund .'</td>
                <td style="color:' . $color . ';">' . $message . '</td>
                <td>'.$reason.'</td>
              </tr>
            ';
                $i++;
            }


        }
        ?>
      </tbody>
      </table>
    </div>
  </body>
</html>
