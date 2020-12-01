<!DOCTYPE html>
<html lang="en">
<head>
	<?php 
		include 'header.html'
	?>
	<title>CONTACT US</title>
</head>

<body>

	<?php 
		include 'nav.html';
	?>
	
	<div class="container">

		<br>
		<h3>Contact us</h3>
		<hr>	

		<form action="sendform.php" enctype="multipart/form-data" method="post">
			<!-- NAME -->
			<div class="row">
				<div class="form-group col-md-4">
					<label for="in_name">* Name</label>
					<input type="text" name="in_name" class="form-control" placeholder="Name" required>
				</div>
				<div class="form-group col-md-5">
					<label for="in_lname">* Last Name</label>
					<input type="text" name="in_lname" class="form-control" placeholder="Last Name" required>
				</div>

				<div class="form-group col-md-3">
					<legend class="col-form-label">Vocative</legend>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="in_vocative" value="" checked>
						<label class="form-check-label">None</label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="in_vocative" value="Mr.">
						<label class="form-check-label">Mr.</label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="in_vocative" value="Ms.">
						<label class="form-check-label">Ms.</label>
					</div>
				</div>
			</div>

			<!-- EMAIL -->
			<div class="form-group">
				<label for="in_email">* Email</label>
				<input type="email" class="form-control" name="in_email" placeholder="name.lastname@example.com" required>
			</div>

			<!-- ADDRESS -->
			<div class="row">
				<div class="form-group col-md-2">
					<label for="in_country">Country</label>
					<select name="in_country" class="form-control">
						<?php 
							require_once 'db_crud.php';
							foreach ($countrys as $country) {
								echo '<option>' . $country . '</option>';
							}
						?>
					</select>
				</div>
				<div class="form-group col-md-4">
					<label for="in_city">City</label>
					<input type="text" class="form-control" name="in_city" placeholder="City">
				</div>

				<div class="form-group col-md-6">
					<label for="in_addr">Address</label>
					<input type="text" class="form-control" name="in_addr" placeholder="Street, appartment, building, etc">
				</div>
			</div>

			
			<div class="form-group">
				<!-- TEXT -->
				<div class="form-group">
					<label for="in_txt">* Question</label>
					<textarea class="form-control" rows="5" name="in_msg" placeholder="Enter your question" required></textarea>
				</div>

				<!-- FILE -->
				<div class="form-group">
					<label for="in_file">Attach file</label>
					<input type="file" class="form-control-file" name="in_file">
				</div>	
			</div>

			<hr>
			
			<div class="row">
				<!-- CHECKBOX -->
				<div class="form-group col-lg-8 my-2" align="right">
					<div class="form-check">
						<input class="form-check-input" type="checkbox" id="in_check" required>
						<label class="form-check-label" for="in_check">
							* Agree with terms and rules
						</label>
					</div>
				</div>
				
				<!-- BUTTONS -->
				<div class="col-lg-2 my-1" align="right">
					<input type="reset" class="btn btn-secondary" value="Reset form"></input>
				</div>	
				<div class="col-lg-2 my-1" align="right">
					<button type="submit" class="btn btn-primary">Send message</button>
				</div>
			</div>
			
		</form>
		
	</div>
</body>
</html>