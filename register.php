<?php
  require_once 'session.php';
  ini_set('error_reporting', E_ALL);
  ini_set('display_errors', 1);
  require_once "db.php";

  function pvd($var) {
    echo "<pre style='font-size:16px;'>";
    var_dump($var);
    echo "</pre>";
  }
  $file = 'tmp/file';
  $entry = json_decode(file_get_contents($file), TRUE);
  pvd($entry);
  // define variables and set to empty values
  $username = $role_submitted = $mis = $full_name = $email =  "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = test_input($_POST["username"]);
    $role_submitted = test_input($_POST["role"]);
    $mis = test_input($_POST["mis"]);
    $full_name = test_input($_POST["full_name"]);
    $email = test_input($_POST["email"]);
    $dept = test_input($_POST["dept"]);
    $branch = test_input($_POST["branch"]);
    $year = test_input($_POST["year"]);
    $level = "normal";
    $db = new DB();
    $query = "INSERT INTO users VALUES ('".$username."','".$mis."','".$full_name."','".$email."','".$role_submitted."','".$branch."','".$year."','".$level."','".$dept."')";
    $result = $db->run_query($query);
    if($result == 1) {
      header("location:dashboard.php");
    }
  }

  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  
  

?>
<html>
  <head>
    <title>Registration</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/register.css">
    <link rel="stylesheet" href="css/menu.css">
		<script src="js/bootstrap.min.js"></script>
		<script src="js/jquery-3.2.1.slim.min.js"></script>
    <script src="js/register.js"></script>
    <script src="js/jquery.min.js"></script>
  </head>
  <body>
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
      </div>
    </div>
    <div class="wrapper">
      <div class = "register">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
          <div class="form-group"> 
            <label for="username_id" class="control-label">Username</label>
            <input type="text" class="form-control" id="username_id" name="username" value = "<?php echo $entry["cn"][0]; ?>" readonly>
          </div>
          <?php if(strpos($entry["dn"], "students")!= false) {
                  $role = 'student';
                }
                else {
                  $role = 'faculty';
                }
          ?>
            <div class="form-group">
              <label for="role_id" class="control-label">Role</label>
              <input type="text" class="form-control" id="role_id" name="role" value = "<?php echo $role; ?>" readonly>
            </div>

          <div class="form-group">
            <label for="mis_id" class="control-label">MIS</label>
            <input type="text" class="form-control" id="mis_id" name="mis" placeholder="Enter Your MIS" required>
          </div>

          
          <div class="form-group"> 
            <label for="full_name_id" class="control-label">Full Name</label>
            <input type="text" class="form-control" id="full_name_id" name="full_name" placeholder="Enter Your Name" required>
          </div>

          <div class="form-group"> 
            <label for="email_id" class="control-label">E-mail</label>
            <input type="text" class="form-control" id="email_id" name="email" placeholder="Enter Your E-mail ID" required>
          </div>

          <div class="form-group"> 
            <label for="dept_id" class="control-label">Department</label>
            <select class="form-control" id="dept_id" name = "dept" required>
              <option disabled selected value> -- select an option -- </option>
              <option value="Applied Science">Department of Applied Science</option>
              <option value="Civil Engineering ">Department of Civil Engineering</option>
              <option value="Computer Engineering and Information Technology">Department of Computer Engineering & IT</option>
              <option value="Electrical Engineering ">Department of Electrical Engineering</option>
              <option value="Electronics and Telecommunication Engineering ">Department of Electronics and Telecommunication Engineering</option>
              <option value="Instrumentation and Control Engineering ">Department of Instrumentation and Control Engineering</option>
              <option value="maths">Department of Mathematics</option>
              <option value="Mechanical Engineering ">Department of Mechanical Engineering</option>
              <option value="Metallurgy and Material Science ">Department of Metallurgy and Materials Science</option>
              <option value="phy">Department of Physics</option>
              <option value = "Planning ">B.Tech Planning</option>
              <option value = "Production Engineering and Industrial Management">Department of Production Engineering and Industrial Management</option>
            </select>
          </div>

          <div class="form-group" > 
            <label for="branch_id" class="control-label">Branch</label>
            <select class="form-control" id="branch_id" name = "branch"required>
              <option disabled selected value> -- select an option -- </option>
              <option value="Applied Science">Applied Science</option>
              <option value="Civil Engineering">Civil Engineering</option>
              <option value="Computer Engineering">Computer Engineering</option>
              <option value="Information Technology ">Information Technology </option>
              <option value="Electrical Engineering">Electrical Engineering</option>
              <option value="Electronics and Telecommunication Engineering ">Electronics and Telecommunication Engineering </option>
              <option value="Instrumentation and Control Engineering ">Instrumentation and Control Engineering </option>
              <option value="maths">Department of Mathematics</option>
              <option value="Mechanical Engineering">Mechanical Engineering</option>
              <option value="Metallurgical Engineering">Metallurgical Engineering</option>
              <option value="phy">Department of Physics</option>
              <option value = "Planning">Planning</option>
              <option value = "Production Engineering (Sandwich)">Production Engineering (Sandwich)</option>
            </select>
          </div>
          <?php if($role == 'student'):?>
            <div class="form-group">
              <label for="year_id" class="control-label">Year of Passing</label>
              <input type="text" class="form-control" id="year_id" name="year" placeholder="Enter year of passing"  required>
            </div>
          <?php endif?>
          <div class="form-group">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>

        </form>
      </div>
    </div>
  </body>
</html>
