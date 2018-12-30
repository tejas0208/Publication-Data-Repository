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
      Dashboard | <?php echo $_SESSION['username'] ?>
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
    <div class="submissions">
      <?php
        $i      = 1;
        $db     = new DB();
        $query  = "SELECT * from users where username = '" . $_SESSION['username'] . "'";
        $result = $db->run_query($query);
        $result = mysqli_fetch_row($result);
        $mis    = $result[1];
        $query  = "SELECT * from record where submitted_by_mis = $mis";
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
                  <th>Status</th>
                  <th>Reason for rejection(where applicable)</th>
                </tr>
              </thead>
              <tbody>';
            
            while ($row = mysqli_fetch_array($result)) {
                $id    = $row['idrecord'];
                $title = $row['title'];
                $date  = $row['date'];
                
                if ($row['approved_status'] == 'T') {
                    $color   = "green";
                    $message = "Approved";
                    $reason  = " ";
                } else if ($row['approved_status'] == 'F') {
                    $color   = "red";
                    $message = "Rejected";
                    $query2  = "SELECT reason from rejection_record where idrecord = '" . $id . "'";
                    $reason  = $db->run_query($query2);
                    $reason  = mysqli_fetch_array($result);
                } else {
                    $color   = "black";
                    $message = "Pending";
                    $reason  = " ";
                }
                echo '
              <tr>
                <td>' . $i . '</td>
                <td><u><a href = "details.php?id=' . $id . '">' . $title . '</a></u></td>
                <td>' . $date . '</td>
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