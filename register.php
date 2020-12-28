<?php 
require "config/connection.php";
require "includes/formHandlers/registerHandler.php";
require "includes/formHandlers/loginHandler.php";


?>
<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<link rel="stylesheet" type="text/css" href="css/stylesheet.css">
	<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600&display=swap" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://kit.fontawesome.com/1447c02b36.js" crossorigin="anonymous"></script>
<script src="js/app.js"></script>
</head>
<body>
	<?php 
		if(isset($_POST['reg_button'])) {
			echo '
				<script>
					$(document).ready(function() {
						$("#login-form-wrapper").hide();
						$("#register-form-wrapper").show();
						})
				</script>

			';
		}

	?>
	<div id="title"><h1>My Social</h1></div>
	<div class="form-wrapper">
		
		<div id="login-form-wrapper">
			<h3>Login form</h3>
			<form action="register.php" method="POST">
				<?php 
					if(in_array("Incorrect email or password!<br>", $errors_array)) echo "<span style='color:red;'>Incorrect email or password!</span><br>";;
				?>
				<input type="email" name="log_email" placeholder="Email address.." value="<?php 
				if(isset($_SESSION['log_email'])) echo $_SESSION['log_email'];
				?>" required />
				<br>
				<input type="password" name="log_password" placeholder="Password.." id="pass" required />
				<label for="checkbox"><i class="fas fa-eye"></i></label>
				<input type="checkbox" name="checkbox" id="checkbox" />
				<br>
				<input type="submit" name="login" value="Login" />
				
				<br>
				<a href="#" id="login-hide">Don't have an account? Sign up for free!</a>
			</form>
		</div>
	</div>
	
	<div class="form-wrapper">
		
		<div id="register-form-wrapper">
			<h3>Register form</h3>
			<form action="register.php" method="POST" id="login-form">
				<input type="text" name="reg_fname" placeholder="First name.." value="<?php
					if(isset($_SESSION["reg_fname"])) {
						echo  $_SESSION["reg_fname"];
					}
				 ?>" required />
				<br />
				<?php if(in_array("$fname is not a valid name<br/>", $errors_array)) echo "$fname is not a valid name<br/>"; ?>
				<input type="text" name="reg_lname" placeholder="Last name.." value="<?php
					if(isset($_SESSION["reg_lname"])) {
						echo  $_SESSION["reg_lname"];
					}
				 ?>" required />
				<br />
				<?php if(in_array("$lname is not a valid last name<br/>", $errors_array)) echo "$lname is not a valid last name<br/>"; ?>
				<input type="email" name="reg_email" placeholder="Email.." value="<?php
					if(isset($_SESSION["reg_email"])) {
						echo  $_SESSION["reg_email"];
					}
				 ?>" required />
				<br />
				<!-- array with EMAIL errors -->
				<?php if(in_array("$em already in use, try different one<br/>", $errors_array)) echo "$em already in use, try different one<br/>"; 
				 else if(in_array("$em is not a valid email!<br/>", $errors_array)) echo "$em is not a valid email!<br/>";
				 else if(in_array("Emails do NOT match!<br/>", $errors_array)) echo "Emails do NOT match!<br/>"; ?>
				<!-- EMAIL input -->
				<input type="email" name="reg_email2" placeholder="Confirm Email.." value="<?php
					if(isset($_SESSION["reg_email2"])) {
						echo  $_SESSION["reg_email2"];
					}
				 ?>" required />
				<br />
				<input type="password" name="reg_password" placeholder="Password.." required />
				<br />
				<?php if(in_array("Passwords do NOT match<br/>", $errors_array)) echo "Passwords do NOT match<br/>"; 
				else if(in_array("Password can contain only allowed symbols<br/>", $errors_array)) echo "Password can contain only allowed symbols<br/>";
				else if(in_array("Password must be between 8 and 30 characters<br/>", $errors_array)) echo "Password must be between 8 and 30 characters<br/>";
				?>
				<input type="password" name="reg_password2" placeholder="Confirm Password.." required />
				<br />
				<input type="submit" name="reg_button" value="Sign up" />
				<br />
				<?php 

				if(in_array("<span style='color:#14c800'>You are registered successfully!</span><br/>", $errors_array)) echo "<span style='color:#14c800'>You are registered successfully!</span><br/>";

				?>
				<a href="#" id="register-show">Have an account? Login!</a>
			</form>
		</div>
	</div>
	<footer>
		<p>My Social is created by Petar Hamamdzhiev | &copy; 2020</p>
	</footer>
	<script>
	
			$("#checkbox").click(function() {
				var type = $("#pass").attr("type"); 
			// now test it's value

			if( type === 'password' ){
			  $("#pass").attr("type", "text");
			  $("label i").removeClass("fas fa-eye");
			  $("label i").addClass("fas fa-eye-slash");
			  
			}else{
			  $("#pass").attr("type", "password");
			 	$("label i").removeClass("fas fa-eye-slash");
			 	$("label i").addClass("fas fa-eye");
			} 
			})
			
	
	</script>
</body>
</html>