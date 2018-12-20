<?php
  include('session.php');
  ini_set('error_reporting', E_ALL);
  ini_set('display_errors', 1);
  require_once "db.php";
  if (isset($_GET['id']) && isset($_GET['type'])) {
    $id = $_GET['id'];
    $type = $_GET['type'];
    $db = new DB();


    if ($type == 'A') {
      $query = "UPDATE record SET approved_status = 'T' where idrecord = $id";
      $result = $db->run_query($query);
    }

  }
  if (isset($_POST['data'])) {
    $id = $_POST['data']['id'];
    $reason = $_POST['data']['reason'];
    $db = new DB();
    $query = "INSERT INTO `rejection_record` (`idrecord`, `reason`) VALUES ('$id', '$reason');";
    $result = $db->run_query($query);
    $query = "UPDATE `record` SET `approved_status` = 'F' WHERE `idrecord` = '17';";
    
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

    <div class="pendingappr">
      <?php
        $i = 1;
        $db = new DB();
        $query = "SELECT * from users where username = '".$_SESSION['username']."'";
        $result = $db->run_query($query);
                $result = mysqli_fetch_row($result);
                $mis = $result[1];
                $query = "SELECT * from record where approved_by_mis = $mis and approved_status = 'NA'";
                $result = $db->run_query($query);
                if(mysqli_num_rows($result) == 0) {
                    echo "Nothing to show";
                }
                else {
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
                      echo '
                        <tr>
                          <td>'.$i.'</td>
                          <td><u><a href = "details.php?id='.$row['idrecord'].'">'.$row['title'].'</a></u></td>
                          <td>'.$row['date'].'</td>
                          <td>
                            <a href = "pending_approvals.php?id='.$row['idrecord'].'&type=A" class = "btn btn-success">Approve</a>
                            <a id='.$row['idrecord'].' class = "btn btn-danger reject_button">Reject</a>
                          </td>
                        </tr>
                      ';
                      $i++;
                    }


                }
      ?>
    </div>


  </body>
  <script type="text/javascript">
    $('.reject_button').click(function(){
      var thisid = $(this).attr('id');
      var reason = prompt("Please enter a rejection reason (max 1024 Characters)");
      if(reason == "" || reason == null) {
          //Let's do something for this
      } else {
        var data = {data: JSON.stringify({id:thisid, reason:reason})};
        console.log(data);
        $.ajax({
          url:"./pending_approvals.php",
          type:"POST",
          data:data,
          contentType:"application/json; charset=utf-8",
          dataType:"json",
          success: console.log(data);
        })
      }
    });
  </script>
</html>