<?php 
include "includes/header.php";
include "includes/classes/User.php";
include "includes/classes/Post.php";


if(isset($_POST["post"])) {
	$post = new Post($con, $userLoggedIn);
	$post->submitPost($_POST['post_text'], "none");
	header("Location: index.php");
}
?>
		<div class="user__details column">
			<a href="<?php echo $userLoggedIn ?>"><img src="<?php echo $user['user_pic'] ?>"/></a>
			<div class="user__details_left_right">
				<a href="<?php echo $userLoggedIn ?>">
					<?php echo $user["first_name"] . " " .$user["last_name"] . "<br>"; ?>
				</a>
				<?php echo "Post: " . $user['num_post'] . "<br>"; echo "Likes: " . $user['num_likes']; ?>
			</div>
		</div>

		<div class="main_column column">
			
			<form class="post_form" action="index.php" method="POST">
				
				<textarea name="post_text" id="post_text" placeholder="Whats up to you, today?"></textarea>
				<input type="submit" name="post" id="psot" value="Post">
				<hr>
			</form>
<?php 
				$post = new Post($con, $userLoggedIn);
				$post->loadPostsFriends();

				?>


		</div>


<script>
	
	var logIn = "<?php echo $userLoggedIn; ?>";

	console.log(logIn);
</script>





	</div> <!-- closing tag for wrapper, comes from header.php -->

</body>
</html>