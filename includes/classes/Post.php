<?php 

class Post
{
	private $user_obj;
	private $con;
	
	public function __construct($con, $user) {
		$this->con = $con;
		$this->user_obj = new User($con, $user);

	}
	public function submitPost($body, $user_to) {

		$body = strip_tags($body);
		$body = mysqli_real_escape_string($this->con, $body);
		$body = str_replace("\r\n", "\n", $body);
		$body = nl2br($body);
		$check_if_empty = preg_replace('/\s+/', '', $body);

		if($check_if_empty !== "") {
			//curerent date and time

			$date_added = date("Y-m-d H:i:s");
			$added_by = $this->user_obj->getUsername();

			if ($added_by == $user_to) {
				$user_to = "none";
			}

			$query = mysqli_query($this->con, "INSERT INTO post VALUES('', '$body', '$added_by', '$user_to', '$date_added', 'no','no','0')");

			$retured_id = mysqli_insert_id($this->con);

			//notification 

			// number of posts
			$num_post = $this->user_obj->getNumPosts();
			$num_post++;
			$update_query = mysqli_query($this->con, "UPDATE users SET num_post='$num_post' WHERE username='$added_by'");

		}


	}

	public function loadPostsFriends() {
		$str = "";
		$data = mysqli_query($this->con, "SELECT * FROM post WHERE deleted='no' ORDER BY id DESC");	

		while($row = mysqli_fetch_array($data))
			
		{
			$id = $row['id'];
			$body = $row['body'];
			$added_by = $row['added_by'];
			$date_time = $row['date'];
			

			if($row['user_to'] === "none") {
				$user_to = "";
			}
			else {
				$user_to_obj = new User($con, $row['user_to']);
				$user_to_name = $user_to_obj->getFirstAndLastName();
				$user_to = "to <a href='". $row['user_to'] ."'>" . $user_to_name . "</a>";
 
			}
			$added_by_obj = new User($this->con, $added_by);
			if ($added_by_obj->isClosed())
			{
				continue;
			}
			$user_details_query = mysqli_query($this->con, "SELECT * FROM users WHERE username='$added_by'");
			$user_row = mysqli_fetch_array($user_details_query);
			$first_name = $user_row['first_name'];
			$last_name = $user_row['last_name'];
			$user_pic = $user_row['user_pic'];

			$date_time_now = date("Y-m-d H:i:s");
			$start_date = new DateTime($date_time); // time of post
			$end_date = new DateTime($date_time_now); //curent time
			$inerval = $start_date->diff($end_date);

			if ($inerval->y >= 1) {

				if ($inerval == 1) {
					$text_message = $inerval->y . " year ago";
				}
				else{
					$text_message = $inerval->y . " years ago";
				}
			}else if ($inerval->m >= 1){

				if ($inerval->d == 0) {

					$days = " ago";
				}else if ($inerval->d == 1){
				
					$days = $inerval->d . " day ago";
				}
				else {
				
					$days = $inerval->d . " days ago";
				}
				if ($inerval->m == 1) {
					$time_message = $inerval->m . " month" . $days;
				}else {
					$time_message = $inerval->m . " months" . $days;
				}
			}
			else if ($inerval->d >= 1) {
				if ($inerval->d == 1){
				
					$time_message = "Yesterday";
				}
				else {
				
					$time_message = $inerval->d . " days ago";
				}
			}
			else if ($inerval->h >= 1) {
				if ($inerval->h == 1){
				
					$time_message = $inerval->h . " hour ago";
				}
				else {
				
					$time_message = $inerval->h . " hours ago";
				}
			}
			else if ($inerval->i >= 1) {
				if ($inerval->i == 1){
				
					$time_message = $inerval->i . " minute ago";
				}
				else {
				
					$time_message = $inerval->i . " minutes ago";
				}

			}
			else {
				if ($inerval->s < 30) {
				
					$time_message = "Just now";
				}
				else {
				
					$time_message = $inerval->s . " seconds ago";
				}
			}

			
			$str .= "<div class='status_post'>
						<div class='post_profile-pic'>
							<img src='$user_pic' width='50'/>
						</div>


						<div class='posted_by' style='color:#acacac;'>
						 	<a href='$added_by'> $first_name $last_name </a> $user_to &nbsp;&nbsp;&nbsp;&nbsp; $time_message
						 </div>

						 <div id='post_body'>
							 $body
							 <br>
						 </div>
					</div>";
		}
		echo $str;
	}
}
 

?>