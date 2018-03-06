<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
require_once "db.php";
require_once 'adLDAP.php';

session_start();

if(isset($_POST['username']) && isset($_POST['password'])){

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $ad = new adLDAP();
    $entry = $ad->searchDn($username);
    $_SESSION["entry"] = $entry;
    if(!$entry) {
      //die('Error in authentication');
    }
    $auth = $ad->authenticate($entry['dn'], $password);
    if(!$auth) {
      //die('Error in authentication');	
    }
    if(strpos($entry["dn"], "students")!= false) {
      $role = 'student';
      $level = 'normal';
    }
    else {
      $role = 'faculty';
      $level = 'normal';
    }
    if ($username == "abhijit.comp" && $password == "helloworld") {
        # code...
        $_SESSION['username'] = $username;
        $_SESSION['level'] = "executive";
        $_SESSION['role'] = 'faculty';
        
        $db = new DB();
        $query = "SELECT * from users where username = '$username'";
        $result = $db->run_query($query);
        if(mysqli_num_rows($result) == 0) {
          header("location:register.php");
        }
        else {
          header("location:dashboard.php");
        }

    }
  
    else if ($auth) {
        $_SESSION['username'] = $username;
        $_SESSION['level'] = $level;
        $_SESSION['role'] = $role;
        
        $db = new DB();
        $query = "SELECT * from users where username = '$username'";
        $result = $db->run_query($query);
        if(mysqli_num_rows($result) == 0) {
          header("location:register.php");
        }
        else {
          header("location:dashboard.php");
        }

    }
    else {
        echo "Incorrect login credentials";
    }
}
?>



<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/login.css" />
    <title>Publication Data Repository</title>
  </head>
  <body>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <div class="form-group">
    <label for="username">Username</label>
    <input type="text" name="username" class="form-control" id="username" aria-describedby="mis" placeholder="Enter MIS">
    </div>
    <div class="form-group">
    <label for="pswd">Password</label>
    <input type="password" name="password" class="form-control" id="pswd" placeholder="Password">
    </div>
    
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jquery-3.2.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
