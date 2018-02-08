<?php
include 'DB.php';
session_start();
if($_SESSION['id'] == null) {
    header('Location: index.php');
}
$myid = $_SESSION['id'];
if(isset($_POST['user_name'])) {
	$user_name = mysqli_real_escape_string($conn, (htmlspecialchars($_POST['user_name'])));
	$sqlcommand = "UPDATE users SET user_name = '$user_name' WHERE user_id=$myid";
	$conn->query($sqlcommand);
	if(isset($_POST['country_code'])) {
		$country_code = mysqli_real_escape_string($conn, htmlspecialchars($_POST['country_code']));
		$sqlcommandc = "INSERT INTO "
	}
}
?>
	<!DOCTYPE html>
	<html>

	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.1/css/bulma.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<title>JChan Reborn | Home</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>

	<body style="background-color: #eaeaea; min-height: 100vh;">
		<!-- Navbar -->
		<nav class="navbar is-transparent" style="position: fixed; top: 0; left: 0; z-index: 9999; width: 100%;">
			<div class="navbar-brand">
				<a href="#" class="navbar-item">JChan Reborn</a>
				<div class="navbar-burger burger" data-target="navbarMain">
					<span></span>
					<span></span>
					<span></span>
				</div>
			</div>
			<div id="navbarMain" class="navbar-menu">
				<div class="navbar-end">
					<div class="navbar-item">
						<a href="#" class="navbar-item">Home</a>
						<a href="#" class="navbar-item">Profile</a>
						<a href="#" class="navbar-item">Friends</a>
						<a href="#" class="navbar-item">Settings</a>
						<a href="#" class="button is-info is-inverted">
							<span class="icon">
								<i class="fa fa-user"></i>
							</span>
							<span>
								<?php echo $_SESSION['username']; ?>
							</span>
						</a>
					</div>
				</div>
			</div>
		</nav>
		<!-- End of Navbar -->
		<!-- Main Content -->
		<section id="mainContent" style="padding: 10px 15px; margin-top: 55.5px;">

			<form action="settings.php" method="POST">

				<div class="field">
					<label class="label">Username</label>
					<div class="control has-icons-left has-icons-right">
						<input class="input is-success" type="text" placeholder="<?php echo $_SESSION['username']; ?>" value="<?php echo $_SESSION['username']; ?>" name="user_name">
					</div>
				</div>

				<div class="field">
					<label class="label">Country Code</label>
					<div class="control">
						<input type="text" class="input is-success" placeholder="Example, Spain = ES" name="country_code">
					</div>
				</div>

				<div class="field">
					<label class="label">About You</label>
					<div class="control">
						<textarea class="textarea" placeholder="Tell something about you" name="about"></textarea>
					</div>
				</div>

				<div class="field is-grouped">
					<div class="control">
						<button class="button is-link">Submit</button>
					</div>
					<div class="control">
						<button class="button is-text">Cancel</button>
					</div>
				</div>

			</form>

		</section>
		<!-- End of Main Content -->

		<!-- Scripts -->
		<script type="text/javascript">
			document.addEventListener('DOMContentLoaded', function () {
				// Get all "navbar-burger" elements
				var $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);
				// Check if there are any navbar burgers
				if ($navbarBurgers.length > 0) {
					// Add a click event on each of them
					$navbarBurgers.forEach(function ($el) {
						$el.addEventListener('click', function () {
							// Get the target from the "data-target" attribute
							var target = $el.dataset.target;
							var $target = document.getElementById(target);
							// Toggle the class on both the "navbar-burger" and the "navbar-menu"
							$el.classList.toggle('is-active');
							$target.classList.toggle('is-active');
						});
					});
				}
			});
		</script>
	</body>

	</html>