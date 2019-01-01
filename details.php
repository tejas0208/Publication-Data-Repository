<?php
  include('session.php');
  ini_set('error_reporting', E_ALL);
  ini_set('display_errors', 1);
  require_once "db.php";
  if (isset($_GET['id'])) {
    $ID = $_GET['id'];
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
			Details | <?php echo $_SESSION['username'] ?>
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
        <h1 class="navheader">
          Publication Data Repository
        </h1>
      </div>
    </div>
    <div class="submissions">
      <?php
        if(isset($_GET['success']))
          echo '<div class="alert alert-success" role="alert">
          Record successfully added!
        </div>';
        if(isset($_GET['app']))
          echo '<div class="alert alert-success" role="alert">
          Applicated received!
        </div>';
      ?>
      <table class="table table-striped table-bordered table-condensed">
  		    <tbody>
            <?php
              $db = new DB();
              $query = "SELECT * from record where idrecord='$ID'";
              $result = $db->run_query($query);
              $result = mysqli_fetch_row($result);
              echo '<tr>
                  <td>Title</td><td>'.$result[2].'</td>
                </tr>
                <tr>
                    <td>Date</td><td>'.$result[1].'</td>
                </tr>
                <tr>
                    <td>Funded:TEQUIP</td><td>'.$result[3].'</td>
                </tr>
                <tr>
                    <td>Funded:RPS</td><td>'.$result[4].'</td>
                </tr>
                <tr>
                    <td>Funded:ISEA</td><td>'.$result[5].'</td>
                </tr>
                <tr>
                    <td>Funded:AICTE</td><td>'.$result[6].'</td>
                </tr>
                <tr>
                    <td>Funded:COEP</td><td>'.$result[7].'</td>
                </tr>
                <tr>
                    <td>Funded:Others</td><td>'.$result[8].'</td>
                </tr>
                <tr>
                    <td>Travel:TEQUIP</td><td>'.$result[9].'</td>
                </tr>
                <tr>
                    <td>Travel:RPS</td><td>'.$result[10].'</td>
                </tr>
                <tr>
                    <td>Travel:ISEA</td><td>'.$result[11].'</td>
                </tr>
                <tr>
                    <td>Travel:AICTE</td><td>'.$result[12].'</td>
                </tr>
                <tr>
                    <td>Travel:COEP</td><td>'.$result[13].'</td>
                </tr>
                <tr>
                    <td>Travel:Others</td><td>'.$result[14].'</td>
                </tr>
                <tr>
                    <td>National Journal</td><td>'.$result[15].'</td>
                </tr>
                <tr>
                    <td>International Journal</td><td>'.$result[16].'</td>
                </tr>
                <tr>
                    <td>National Conference</td><td>'.$result[17].'</td>
                </tr>
                <tr>
                    <td>International Conference</td><td>'.$result[18].'</td>
                </tr>
                <tr>
                    <td>Volume No</td><td>'.$result[19].'</td>
                </tr>
                <tr>
                    <td>Pages</td><td>'.$result[20].'</td>
                </tr>
                <tr>
                    <td>Citations</td><td>'.$result[21].'</td>
                </tr>
                <tr>
                    <td>Approved Status</td><td>'.$result[22].'</td>
                </tr>
                <tr>
                    <td>Approved By MIS</td><td>'.$result[23].'</td>
                </tr>
                <tr>
                    <td>Submitted By MIS</td><td>'.$result[24].'</td>
                </tr>
                <tr>
                    <td>Department</td><td>'.$result[25].'</td>
                </tr>
                <tr>
                    <td>Filename</a></td><td><u><a href = "uploads/'.$result[26].'">'.$result[26].'</a></u></td>
                </tr>
                ';
          		?>
          </tbody>
      </table>
    </div>
  </body>
  </html>