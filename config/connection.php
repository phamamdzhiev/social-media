	<?php
ob_start();
session_start();
$timezone = date_default_timezone_set("Europe/Sofia");
$con = mysqli_connect("localhost", "root", "", "social");
if (mysqli_connect_errno()) {
	echo "Fail to load " . mysqli_connect_errno();
}
?>