<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
require_once "db.php";

session_start();

if(isset($_POST['mis']) && isset($_POST['password'])){

    $mis = trim($_POST['mis']);
    $password = trim($_POST['password']);
    

    if ($mis == "111503071" && $password == "helloworld") {
        $_SESSION['mis'] = $mis;
        $_SESSION['level'] = "student";
        
        $db = new DB();
        $query = "SELECT * from users where username = '$mis'";
        $result = $db->run_query($query);
        if(mysqli_num_rows($result) == 0) {
          header("location:register.php");
        }
        else {
          header("location:dashboard.php");
        }

    }
    elseif ($mis == "abhijit.comp" && $password == "helloworld") {
        # code...
        $_SESSION['mis'] = $mis;
        $_SESSION['level'] = "executive";
        
        $db = new DB();
        $query = "SELECT * from users where username = '$mis'";
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
    
    
    // $ad = new adLDAP();
    // $entry = $ad->searchDn($mis);
    // if(!$entry) {
    //     die('Error in authentication');
    // }
    //     var_dump($entry);
    // $auth = $ad->authenticate($entry['dn'], $password);
    // if(!$auth) {
    //     die('Error in authentication'); 
    // }
    //else echo var_dump($auth);





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
    <label for="mis">MIS</label>
    <input type="text" name="mis" class="form-control" id="mis" aria-describedby="mis" placeholder="Enter MIS">
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
