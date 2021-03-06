<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
	<title>JChan Reborn</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.1/css/bulma.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<title>JChan Reborn | Home</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
	<section class="hero is-info is-fullheight" style="background-image: url('http://wallpapericon.com/wp-content/uploads/2017/11/Top-Download-4K-City-Wallpaper.jpg'); 
	background-size: cover; background-repeat: no-repeat;">
		<div class="hero-head">
			<header class="navbar">
				<div class="container">
					<div class="navbar-brand">
						<a href="#" class="navbar-item">JChan Reborn</a>
						<span class="navbar-burger burger" data-target="navbarMenuHeroC">
							<span></span>
							<span></span>
							<span></span>
						</span>
					</div>
					<div id="navbarMenuHeroC" class="navbar-menu">
						<div class="navbar-end">
							<a class="navbar-item is-active">
								Home
							</a>
							<a class="navbar-item" href="login.php">
								Login
							</a>
							<a class="navbar-item" href="register.php">
								Register
							</a>
						</div>
					</div>
				</div>
			</header>
		</div>
		<div class="hero-body">
			<div class="container has-text-centered">
				<h1 class="title">JChan Reborn</h1>
				<h2 class="subtitle">Open Source Social Network</h2>
			</div>
		</div>
		<!-- If Logged In -->
		<div class="hero-foot">
			<nav class="tabs is-boxed is-fullwidth">
				<div class="container">
					<ul>
						<li class="is-active">
							<a>Home</a>
						</li>
						<li>
							<a>Timeline</a>
						</li>
						<li>
							<a>Friends</a>
						</li>
						<li>
							<a>Explore</a>
						</li>
						<li>
							<a>Account Settings</a>
						</li>
						<li>
							<a>Logout</a>
						</li>
					</ul>
				</div>
			</nav>
		</div>
	</section>
</body>

</html>