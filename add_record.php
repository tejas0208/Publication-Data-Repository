<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<!-- Meta, title, CSS, favicons, etc. -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>
			Department Store New Purchase
		</title>
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/register.css">
		<link rel="stylesheet" href="css/menu.css">
		<link rel="stylesheet" href="css/newEnquiry.css">
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/jquery-1.12.0.min.js"></script>
		<script src="js/newEnquiry.js"></script>
		<script>
			jQuery(document).ready(function() {
				jQuery('.tabs .tab-links a').on('click', function(e)  {
					
					var currentAttrValue = jQuery(this).attr('href');
					// Show/Hide Tabs
					jQuery('.tabs ' + currentAttrValue).siblings().slideUp(400);
					jQuery('.tabs ' + currentAttrValue).delay(400).slideDown(400);
					// Change/remove current tab to active
					jQuery(this).parent('li').addClass('active').siblings().removeClass('active');
					e.preventDefault();
				});
			});
		</script>
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
	    <div style="width:80%;padding:50" class="register">
	    	<form>
				<div class="form-group">
					<label for="title" class="control-label">Title</label>
					<input type="text" class="form-control" id="title" name="title" placeholder="Enter Title">
				</div>	

				<div class="form-group"> <!-- Street 1 -->
					<label for="date" class="control-label">Date</label>
					<input type="text" class="form-control" id="date" name="date" placeholder="dd/mm/yyyy">
				</div>					
										
				<div class="form-group"> <!-- Street 2 -->
					<label for="pages" class="control-label">Pages</label>
					<input type="text" class="form-control" id="pages" name="pages" placeholder="No. of pages">
				</div>	

				<div class="form-group"> <!-- City-->
					<label for="issueno" class="control-label">Issue no</label>
					<input type="text" class="form-control" id="issueno" name="issueno" placeholder="Enter issue no">
				</div>

				<div class="form-group"> <!-- City-->
					<label for="volume" class="control-label">Volume</label>
					<input type="text" class="form-control" id="volume" name="volume" placeholder="Enter Volume">
				</div>

				<div class="form-group"> <!-- City-->
					<label for="citations" class="control-label">Citations</label>
					<input type="text" class="form-control" id="citations" name="citations" placeholder="Citations">
				</div>
				<div class="form-group">
					<label for="journal_details" class="control-label">Journal Details: </label>
					<div class="checkbox">
						<label><input type="checkbox" id = "journal_details" value="national"> National </label>
					</div>
					<div class="checkbox">
						<label><input type="checkbox" id = "journal_details" value="international"> International</label>
					</div>
				</div>
				<div class="form-group">
					<label for="conference_details" class="control-label">Conference Details: </label>
					<div class="checkbox">
						<label><input type="checkbox" id = "conference_details" value="national"> National</label>
					</div>
					<div class="checkbox">
						<label><input type="checkbox" id = "conference_details" value="international"> International</label>
					</div>
				</div>

				<div class="form-group">
					<label for="funded_by" class="control-label">Funded By</label>
					<div class="checkbox">
						<label><input type="checkbox" id = "funded_by" value="isea"> ISEA</label>
					</div>
					<div class="checkbox">
						<label><input type="checkbox" id = "funded_by" value="tequip"> TEQUIP</label>
					</div>
					<div class="checkbox">
						<label><input type="checkbox" id = "funded_by" value="coep"> COEP</label>
					</div>
					<div class="checkbox">
						<label><input type="checkbox" id = "funded_by" value="rps"> RPS</label>
					</div>
					<div class="checkbox">
						<label><input type="checkbox" id = "funded_by" value="aicte"> AICTE</label>
					</div>
					<div class="checkbox">
						<label><input type="checkbox" id = "funded_by" value="others"> Others</label>
					</div>
				</div>

				<div class="form-group">
					<label for="sponsored_by" class="control-label">Sponsored By</label>
					<div class="checkbox">
						<label><input type="checkbox" id = "sponsored_by" value="isea"> ISEA</label>
					</div>
					<div class="checkbox">
						<label><input type="checkbox" id = "sponsored_by" value="tequip"> TEQUIP</label>
					</div>
					<div class="checkbox">
						<label><input type="checkbox" id = "sponsored_by" value="coep"> COEP</label>
					</div>
					<div class="checkbox">
						<label><input type="checkbox" id = "sponsored_by" value="rps"> RPS</label>
					</div>
					<div class="checkbox">
						<label><input type="checkbox" id = "sponsored_by" value="aicte"> AICTE</label>
					</div>
					<div class="checkbox">
						<label><input type="checkbox" id = "sponsored_by" value="others"> Others</label>
					</div>
				</div>

										
				<div class="form-group"> <!-- State Button -->
					<label for="state_id" class="control-label">State</label>
					<select class="form-control" id="state_id">
						<option value="AL">Alabama</option>
						<option value="AK">Alaska</option>
						<option value="AZ">Arizona</option>
						<option value="AR">Arkansas</option>
						<option value="CA">California</option>
						<option value="CO">Colorado</option>
						<option value="CT">Connecticut</option>
						<option value="DE">Delaware</option>
						<option value="DC">District Of Columbia</option>
						<option value="FL">Florida</option>
						<option value="GA">Georgia</option>
						<option value="HI">Hawaii</option>
						<option value="ID">Idaho</option>
						<option value="IL">Illinois</option>
						<option value="IN">Indiana</option>
						<option value="IA">Iowa</option>
						<option value="KS">Kansas</option>
						<option value="KY">Kentucky</option>
						<option value="LA">Louisiana</option>
						<option value="ME">Maine</option>
						<option value="MD">Maryland</option>
						<option value="MA">Massachusetts</option>
						<option value="MI">Michigan</option>
						<option value="MN">Minnesota</option>
						<option value="MS">Mississippi</option>
						<option value="MO">Missouri</option>
						<option value="MT">Montana</option>
						<option value="NE">Nebraska</option>
						<option value="NV">Nevada</option>
						<option value="NH">New Hampshire</option>
						<option value="NJ">New Jersey</option>
						<option value="NM">New Mexico</option>
						<option value="NY">New York</option>
						<option value="NC">North Carolina</option>
						<option value="ND">North Dakota</option>
						<option value="OH">Ohio</option>
						<option value="OK">Oklahoma</option>
						<option value="OR">Oregon</option>
						<option value="PA">Pennsylvania</option>
						<option value="RI">Rhode Island</option>
						<option value="SC">South Carolina</option>
						<option value="SD">South Dakota</option>
						<option value="TN">Tennessee</option>
						<option value="TX">Texas</option>
						<option value="UT">Utah</option>
						<option value="VT">Vermont</option>
						<option value="VA">Virginia</option>
						<option value="WA">Washington</option>
						<option value="WV">West Virginia</option>
						<option value="WI">Wisconsin</option>
						<option value="WY">Wyoming</option>
					</select>					
				</div>
				
				<div class="form-group"> <!-- Zip Code-->
					<label for="zip_id" class="control-label">Zip Code</label>
					<input type="text" class="form-control" id="zip_id" name="zip" placeholder="#####">
				</div>		
				
				<div class="form-group"> <!-- Submit Button -->
					<button type="submit" class="btn btn-primary">Buy!</button>
				</div>     
		
			</form>
		</div>
    	<div class="tabs">
			<ul class="tab-links">
				<li class="active"><a href="#tab1">General</a></li>
				<li><a href="#tab2">Items</a></li>
				<li><a href="#tab3">Submission Dates</a></li>
				<li><a href="#tab4">Vendors</a></li>
				<li><a href="#tab5">Terms & Conditions</a></li>
			</ul>
			<div class="tab-content" style = "width:100%;">
				<div id="tab1" class="tab active" >
					<table align = "center" style = "width:50%;height:60%;padding:10;">
						<tr>
							<td>
								<label for="title">Title : </label>
							</td>
							<td>
								<input type="text" id="title" placeholder="Enter the title" size="25"></input>
							</td>
						</tr>
						<tr>
							<td>
								<label for="date">Date : </label>
							</td>
							<td>
								<input type="text" id="date" placeholder="dd/mm/yyyy" size="15"></input>
							</td>
						</tr>
						<tr>
							<td>
								<label for="pages">Pages : </label>
							</td>
							<td>
								<input type="text" id="pages" placeholder="No. of pages" size="15"></input>
							</td>
						</tr>
						<tr>
							<td>
								<label for="issueno">Issue no</label>
							</td>
							<td>
								<input type="text" id="issueno" placeholder="Enter issue no" size="15"></input>
							</td>
						</tr>
						<tr>
							<td>
								<label for="volume">Volume : </label>
							</td>
							<td>
								<input type="text" id="volume" size="15"></input>
							</td>
						</tr>
						<tr>
							<td>
								<label for="citations">Citations : </label>
							</td>
							<td>
								<input type="text" id="citations" size="15"></input>
							</td>
						</tr>
						
						<tr>
							<td>
								Journal Details:
							</td>
							<td>
								<input type="checkbox" id = "journal_details" value="national">National<br>
								<input type="checkbox" id = "journal_details" value="international">International<br>
							</td>
						</tr>
						<tr>
							<td>
								Conference Details:
							</td>
							<td>
								<input type="checkbox" id = "conference_details" value="national">National<br>
								<input type="checkbox" id = "conference_details" value="international">International<br>
							</td>
						</tr>
						<tr>
							<td>
								Funded by:
							</td>
							<td>
								<input type="checkbox" id = "funded_by" value="isea">ISEA<br>
								<input type="checkbox" id = "funded_by" value="tequip">TEQUIP<br>
								<input type="checkbox" id = "funded_by" value="coep">COEP<br>
								<input type="checkbox" id = "funded_by" value="rps">RPS<br>
								<input type="checkbox" id = "funded_by" value="aicte">AICTE<br>
								<input type="checkbox" id = "funded_by" value="others">Others<br>
							</td>
						</tr>
						<tr>
							<td>
								Sponsored by:
							</td>
							<td>
								<input type="checkbox" id = "sponsored_by" value="isea">ISEA<br>
								<input type="checkbox" id = "sponsored_by" value="tequip">TEQUIP<br>
								<input type="checkbox" id = "sponsored_by" value="coep">COEP<br>
								<input type="checkbox" id = "sponsored_by" value="rps">RPS<br>
								<input type="checkbox" id = "sponsored_by" value="aicte">AICTE<br>
								<input type="checkbox" id = "sponsored_by" value="others">Others<br>
							</td>
						</tr>
						
						<tr >
							<td colspan ="2" >
								<button type="button" style="float:right">Next</button>
							</td>
						</tr>
					</table>
					
				</div>
				<div id="tab2" class="tab">
					<div align = "center"><h2>Items List</h2>
					</div>
					<table id="itemListTable" align = "center" style = "width:85%;padding:10;">
							<tr>
								<th style = "text-align:center;">
									Item No.
								</th>
								<th style = "text-align:center;">
									Item Name
								</th>
								<th style = "text-align:center;">
									Quantity
								</th>
								<th style = "text-align:center;">
									Description
								</th>
								<th style = "text-align:center;">
								</th>
							</tr>
							<tr id="item1" >
								<td style='text-align:center;'>
									<label >1.</label>
								</td>
								<td>
									<input type="text" id="itemName" placeholder="Item Name" size="10" required></input>
								</td>
								<td>
									<input type="number" id="itemQuantity"  min="0" required></input>
								</td>
								<td>
									<textarea rows="2" cols="20" id="itemDescription" placeholder="Add Details" min="0"></textarea>
								</td>
								<td>
									<button id= "AddButton1" type="button" onclick="addMoreItem()">ADD MORE</button>
								</td>
							</tr>
							<tr >
								<td colspan ="5" >
									<button type="button" style="float:left">Prev</button>
									<button type="button" style="float:right">Next</button>
								</td>
							</tr>
						</table>
				</div>
				<div id="tab3" class="tab">
					
				</div>
				<div id="tab4" class="tab">

				</div>
				<div id="tab5" class="tab">

				</div>
			</div>
		</div>
    </body>
</html>
