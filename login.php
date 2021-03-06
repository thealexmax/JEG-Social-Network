<?php
session_start();
include 'DB.php';
if(isset($_POST['username']) && isset($_POST['password'])) {
	$username = mysqli_real_escape_string($conn, htmlspecialchars($_POST['username']));
	$password = mysqli_real_escape_string($conn, hash('sha512', $_POST['password']));

	$query = "SELECT * FROM users WHERE user_name='$username' AND user_password='$password'";
	$result = $conn->query($query);
	if(!$row = mysqli_fetch_assoc($result)) {
		echo 'Please enter the correct username or password';
	} else {
		$_SESSION['id'] = $row['user_id'];
		$_SESSION['username'] = $row['user_name'];
		header('Location: home.php');
	}
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>JChan Reborn | Login</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0="
	 crossorigin="anonymous" />
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
	<!-- Bulma Version 0.6.0 -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.0/css/bulma.min.css" integrity="sha256-HEtF7HLJZSC3Le1HcsWbz1hDYFPZCqDhZa9QsCgVUdw="
	 crossorigin="anonymous" />
</head>

<body>
	<section class="hero is-info is-fullheight" style="background-image: url('http://wallpapericon.com/wp-content/uploads/2017/11/Top-Download-4K-City-Wallpaper.jpg');
	background-size: cover;">
		<div class="hero-body">
			<div class="container has-text-centered">
				<div class="column is-4 is-offset-4">
					<h3 class="title has-text-light">Login</h3>
					<p class="subtitle has-text-light">Please login to proceed.</p>
					<div class="box">
						<form action="login.php" method="POST">
							<div class="field">
								<div class="control">
									<input class="input is-large" type="text" placeholder="Your Username" autofocus="" name="username">
								</div>
							</div>

							<div class="field">
								<div class="control">
									<input class="input is-large" type="password" placeholder="Your Password" name="password">
								</div>
							</div>
							<input type="submit" value="Login" class="button is-block is-info is-large" style="margin: 0 auto; width: 100%;">
						</form>
					</div>
					<p class="has-text-light">
						<a href="../">Sign Up</a> &nbsp;·&nbsp;
						<a href="../">Forgot Password</a> &nbsp;·&nbsp;
						<a href="../">Need Help?</a>
					</p>
				</div>
			</div>
		</div>
	</section>
</body>

</html>