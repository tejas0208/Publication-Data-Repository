
<?php
  function pvd($var) {
    echo "<pre style='font-size:16px;'>";
    var_dump($var);
    echo "</pre>";
  }
  $file = 'file4';
  $entry = json_decode(file_get_contents($file), TRUE);
  $file2 = "data9.json";
  $misdetails = json_decode(file_get_contents($file2), TRUE);
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
        <form>
          <div class="form-group"> <!-- Full Name -->
            <label for="username_id" class="control-label">Username</label>
            <input type="text" class="form-control" id="username_id" name="username" value = "<?php echo $entry["cn"][0]; ?>" disabled>
          </div>

          <div class="form-group"> <!-- Full Name -->
            <label for="mis_id" class="control-label">MIS</label>
            <input type="text" class="form-control" id="mis_id" name="mis" placeholder="Enter Your MIS">
          </div>

          
          <div class="form-group"> <!-- Full Name -->
            <label for="full_name_id" class="control-label">Full Name</label>
            <input type="text" class="form-control" id="full_name_id" name="full_name" placeholder="Enter Your Name">
          </div>

          <div class="form-group"> <!-- Street 1 -->
            <label for="email_id" class="control-label">Email</label>
            <input type="text" class="form-control" id="email_id" name="email" placeholder="Enter Your E-mail ID">
          </div>

          <div class="form-group"> <!-- State Button -->
            <label for="dept_id" class="control-label">Department</label>
            <select class="form-control" id="dept_id">
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

          <div class="form-group"> <!-- State Button -->
            <label for="branch_id" class="control-label">Branch</label>
            <select class="form-control" id="branch_id">
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

          <div class="form-group"> <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>

        </form>


      </div>

    </div>
  </body>
</html>
