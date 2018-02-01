
<?php
  function pvd($var) {
    echo "<pre style='font-size:16px;'>";
    var_dump($var);
    echo "</pre>";
  }
  $file = 'file4';
  $entry = json_decode(file_get_contents($file), TRUE);
  pvd($entry);
  $file2 = "data9.json";
  $misdetails = json_decode(file_get_contents($file2), TRUE);
  pvd($misdetails);
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

    <div class = "register">
      <form>
        <div class="form-group"> <!-- Full Name -->
      		<label for="username_id" class="control-label">Username</label>
      		<input type="text" class="form-control" id="username_id" name="username" value = "<?php echo $entry["cn"][0]; ?>" disabled>
      	</div>

        <div class="form-group"> <!-- Full Name -->
      		<label for="mis_id" class="control-label">MIS</label>
      		<input type="text" class="form-control" id="mis_id" name="mis" placeholder="Enter Your MIS" onchange="fetchMisDetails()">
      	</div>

        
      	<div class="form-group"> <!-- Full Name -->
      		<label for="full_name_id" class="control-label">Full Name</label>
      		<input type="text" class="form-control" id="full_name_id" name="full_name" value = "<?php echo $misdetails["FullName"]; ?>">
      	</div>

      	<div class="form-group"> <!-- Street 1 -->
      		<label for="email_id" class="control-label">Email</label>
      		<input type="text" class="form-control" id="email_id" name="street1" value = <?php echo $entry["mail"][0];?>>
      	</div>

      	<div class="form-group"> <!-- State Button -->
      		<label for="dept_id" class="control-label">Department</label>
      		<select class="form-control" id="dept_id" disabled>
      			<option value="appsci">Department of Applied Science</option>
      			<option value="civil">Department of Civil Engineering</option>
      			<option value="compit">Department of Computer Engineering & IT</option>
      			<option value="elec">Department of Electrical Engineering</option>
      			<option value="entc">Department of Electronics and Telecommunication Engineering</option>
      			<option value="instru">Department of Instrumentation and Control Engineering</option>
      			<option value="maths">Department of Mathematics</option>
      			<option value="mech">Department of Mechanical Engineering</option>
      			<option value="meta">Department of Metallurgy and Materials Science</option>
      			<option value="phy">Department of Physics</option>
      		</select>
      	</div>

      	<div class="form-group"> <!-- Submit Button -->
      		<button type="submit" class="btn btn-primary">Submit</button>
      	</div>

      </form>


    </div>
  </body>
</html>
