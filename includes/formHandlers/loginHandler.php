<?php 

if(isset($_POST["login"])) {

	$email = filter_var($_POST["log_email"], FILTER_SANITIZE_EMAIL);
	$_SESSION["log_email"] = $email;

	$log_password = md5($_POST["log_password"]);

	$check_if_exists = mysqli_query($con, "SELECT * FROM users WHERE email='$email' AND password='$log_password'");
	$if_exists_login = mysqli_num_rows($check_if_exists);

	if($if_exists_login == 1 ) {
		$row = mysqli_fetch_array($check_if_exists);
		$username = $row["username"];	
		$closed_account = mysqli_query($con, "SELECT user_closed FROM users WHERE email='$email' AND user_closed='yes'");

		if(mysqli_num_rows($closed_account) == 1) {
			$query = mysqli_query($con, "UPDATE users SET user_closed='no' WHERE email='$email'");
		}

		$_SESSION["username"] = $username;
		header("Location: index.php");
		exit();

	}else {
		array_push($errors_array, "Incorrect email or password!<br>");

	}
	
}

?>