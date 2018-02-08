<?php
include 'DB.php';
session_start();
if($_SESSION['id'] == null) {
    header('Location: index.php');
}
if(isset($_GET['id'])) {
    $getuserid = mysqli_real_escape_string($conn, $_GET['id']);
    $query = "SELECT * FROM users WHERE user_id='$getuserid'";
    $userres = $conn->query($query);
    if(!$row = mysqli_fetch_assoc($userres)) {
        die("User not found!");
    } else {
        $pusername = $row['user_name'];
        $userpic = $row['user_pic'];
        $userid = $row['user_id'];
    }
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.1/css/bulma.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/2.9.0/css/flag-icon.min.css">
	<title>JChan Reborn | Home</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/home.css">
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
						<a href="#" class="button is-info is-inverted">
							<span class="icon">
								<i class="fa fa-user"></i>
							</span>
							<span>Thealexmax</span>
						</a>
				</div>
			</div>
		</div>
	</nav>
	<!-- End of Navbar -->
	<!-- Banner -->
	<!-- <section id="banner" style="background-image: url(https://www.travelingmoments.com/wp-content/uploads/2015/11/20151021-DSC_0470-Pano.jpg); background-size: cover; width: 100%; height: 50vh;">
	</section> -->
	<!-- End of Banner -->
	<!-- Main Content -->
	<section id="mainContent" style="margin-top: 55.5px;">
		<!-- Banner -->
		<div id="banner">
			<section class="hero is-info is-large" style="background-image: url(https://www.travelingmoments.com/wp-content/uploads/2015/11/20151021-DSC_0470-Pano.jpg); background-size: cover; background-repeat: no-repeat;">
				<div class="hero-body">
					<div class="container">
						<img src="<?php echo $userpic ?>" style="float: left;" width="130" class="hideOnMobile">
						<h1 class="title" id="profileTitle">
							<?php echo $pusername; ?>
						</h1>
						<h2 class="subtitle" id="profileTitle">
							JChan Reborn Developer
						</h2>
						<img src="https://osu.ppy.sh/images/flags/ES.png" width="50" style="margin-left: 20px;">
					</div>
				</div>
			</section>
		</div>
		<section id="userInfo" class="hero is-dark">
			<div class="hero-body">
				<div class="container">
					<h1 class="title"><?php echo $pusername ?>:</h1>
					<h2 class="subtitle">Country: Spain</h2>
					<div class="columns">
						<div class="column">
							<a href="#" class="button is-light"><i class="fa fa-user"></i> Following: 30</a>
							<a href="#" class="button is-light"><i class="fa fa-user"></i> Followers: 500</a>
							<a href="#" class="button is-light"><i class="fa fa-user"></i> Posts: 700</a>
							<a href="#" class="button is-light"><i class="fa fa-user"></i> Follow</a>
							<a href="#" class="button is-danger"><i class="fa fa-user-plus"></i> Add as a Friend</a>
							<a href="#" class="button is-danger"><i class="fa fa-paper-plane"></i> Send Message</a>
						</div>
					</div>
				</div>
			</div>
		</section>
		<br>
		<section id="sparator" class="hero is-dark">
			<div class="hero-body">
				<div class="container">
					<h1 class="title">Posts</h1>
				</div>
			</div>
		</section>
		<br>
		<section id="userPosts">
			<div class="columns">
			<div class="column is-4 is-offset-4">
                <?php
                $thisuserposts = "SELECT * FROM posts WHERE user_id='$userid' ORDER BY post_date DESC";
                $postsres = $conn->query($thisuserposts);
                while($posts = mysqli_fetch_assoc($postsres)) {
                    echo '<div class="card">
                <div class="card-content">
                    <div class="media">
                        <div class="media-left">
                            <figure class="image is-48x48">
                                <img src="'; echo $userpic; echo '" alt="">
                            </figure>
                        </div>
                        <div class="media-content">
                            <p class="title is-4">'; echo $pusername; echo '</p>
                            <p class="subtitle is-6">@'; echo $pusername; echo '</p>
                        </div>
					</div>';
					if($posts['post_image'] != "null") {
						echo '<div class="card-image">
                        <figure class="image is-4by3">
                            <img src="'; echo $posts['post_image']; echo '" alt="">
                        </figure>
                    </div>';
					}
					echo ' 
                    <div class="content">
						'; 
						if(strstr($posts['post_body'], '#')) { 
							$nohastag = strstr($posts['post_body'], '#', true); 
							$hastag = strstr($posts['post_body'], '#');
							$hastagsen = explode(" ", $hastag);
							$afterneedle = str_replace($hastagsen[0], ' ', $hastag);
							echo $nohastag; echo '<a href="topic.php?topic='.$hastagsen[0].'">'.$hastagsen[0].'</a>'.' '.$afterneedle;
						} else {
							echo $posts['post_body'];
						}
						echo '
                        <br>
                        <time datetime="2016-1-1">'; echo $posts['post_date']; echo '</time>
                        <br>
                        <span class="icon">
                            <i class="fa fa-comment"></i>
                        </span>
                        <span class="icon">
                            <i class="fa fa-heart-o"></i>
                        </span>
                        <span class="icon">
                            <i class="fa fa-bookmark-o"></i>
                        </span>
                    </div>
                </div>
            </div>';
                }
                ?>
			</div>
		</div>
		</section>
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