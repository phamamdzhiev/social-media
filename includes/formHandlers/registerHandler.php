<?php 
$fname = ""; //first name
$lname = ""; // last name
$em = ""; // email
$em2 = ""; //email2
$psw = ""; //password
$psw2 = ""; //password 2
$date = ""; //date of registration
$errors_array = array(); // arr of errors


if(isset($_POST["reg_button"])) {
	$fname = strip_tags($_POST["reg_fname"]);
	$fname = str_replace(' ', '', $fname);
	$fname = ucfirst(strtolower($fname));
	$_SESSION["reg_fname"] = $fname;

	$lname = strip_tags($_POST["reg_lname"]);
	$lname = str_replace(' ', '', $lname);
	$lname = ucfirst(strtolower($lname));
	$_SESSION["reg_lname"] = $lname;

	$em = strip_tags($_POST["reg_email"]);
	$em = str_replace(' ', '', $em);
	$em = ucfirst(strtolower($em));
	$_SESSION["reg_email"] = $em;

	$em2 = strip_tags($_POST["reg_email2"]);
	$em2 = str_replace(' ', '', $em2);
	$em2 = ucfirst(strtolower($em2));
	$_SESSION["reg_email2"] = $em2;


	$psw = strip_tags($_POST["reg_password"]);
	$psw2 = strip_tags($_POST["reg_password2"]);

	$date = date("Y-m-d"); //current date

	//validating email
	if($em == $em2) {
		if(filter_var($em, FILTER_VALIDATE_EMAIL)) {
			$em = filter_var($em, FILTER_VALIDATE_EMAIL);

			$e_check = mysqli_query($con, "SELECT email FROM users WHERE email='$em'");

			$num_rows = mysqli_num_rows($e_check);

			if ($num_rows > 0 ) {
				array_push($errors_array, "$em already in use, try different one<br/>");
				
			}

		}else {
			array_push($errors_array, "$em is not a valid email!<br/>");
		}
	}else {
		array_push($errors_array, "Emails do NOT match!<br/>");
	}


	//validatig first name
	if (strlen($fname) > 25 || strlen($fname) < 2) {
		array_push($errors_array, "$fname is not a valid name<br/>");
	}
	//validation last name
	if (strlen($lname) > 25 || strlen($lname) < 2) {
		array_push($errors_array, "$lname is not a valid last name<br/>");
	}
	//check if password match 
	if ($psw != $psw2) {
		array_push($errors_array, "Passwords do NOT match<br/>");
	}else {
		if(preg_match("/[^A-Za-z0-9]/", $psw)){
			array_push($errors_array, "Password can contain only allowed symbols<br/>");
		}
	}
	if (strlen($psw) > 30 || strlen($psw) < 8) {
		array_push($errors_array, "Password must be between 8 and 30 characters<br/>");
	}


	if(empty($errors_array)) {
		$psw = md5($psw);

		$username = strtolower($fname . "_" . $lname);
		$check_username = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");

		$i = 0;
		//if exist such a username add a number on dublicated
		while (mysqli_num_rows($check_username) != 0) {
			$i++;
			$username = $username . "_" . $i;
			$check_username = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
		}


		//add default picture for new users
		$profile_pic = "assets/default-profile.png";

		//add data to database

		$query = mysqli_query($con, "INSERT INTO users VALUES (NULL, '$fname', '$lname', '$username', '$em','$psw', '$date', '$profile_pic', '0', '0', 'no', ',')");
		array_push($errors_array, "<span style='color:#14c800'>You are registered successfully!</span><br/>");

		$_SESSION['reg_fname'] = "";
		$_SESSION['reg_lname'] = "";
		$_SESSION['reg_email'] = "";
		$_SESSION['reg_email2'] = "";
		
	}


}
	
?>