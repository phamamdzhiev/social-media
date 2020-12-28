<?php 

require "config/connection.php";


if (isset($_SESSION['username'])) {
	$userLoggedIn = $_SESSION['username'];

	$user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$userLoggedIn'");
	$user = mysqli_fetch_array($user_details_query);
}
else {
header("Location: register.php");
}


?>

<!DOCTYPE html>
<html>
<head>
	<title>Social Network &copy; | 2020</title>
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="css/header.css">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600&display=swap" rel="stylesheet">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://kit.fontawesome.com/1447c02b36.js" crossorigin="anonymous"></script>
</head>
<body>
	<div class="top_bar">
		<div class="logo">
			<a href="index.php">My social</a>
		</div>
		<nav class="navbar">
			<ul>
				<li>
					<a href="<?php echo $userLoggedIn ?>"><?php echo $user['first_name']; ?></a>
				</li>
				<li><a href="index.php"><i class="fas fa-home fa-2x" title="Home"></i></a></li>
				<li><a href=""><i class="fas fa-envelope fa-2x" title="Messages"></i></a></li>
				<li><a href=""><i class="fas fa-bell fa-2x" title="Notifications"></i></a></li>
				<li><a href=""><i class="fas fa-user-friends fa-2x" title="Friends"></i></a></li>
				<li><a href=""><i class="fas fa-cogs fa-2x" title="Settings"></i></a></li>
				<li><a href="logout.php" title="Logout"><i class="fas fa-sign-out-alt fa-2x"></i></a></li>
			</ul>
		</nav>
	</div>
	<div class="wrapper">