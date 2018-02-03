<?php
session_start();
include 'DB.php';
if($_SESSION['id'] == null) {
	header('Location: index.php');
}
$myuser = $_SESSION['username'];
$myid = $_SESSION['id'];

if(isset($_POST['postBody'])) {
	$postBody = mysqli_real_escape_string($conn, htmlspecialchars($_POST['postBody']));
	if(isset($_FILES['image']["tmp_name"])) {
			if($_FILES['image']['tmp_name'] == null) {
				$sql32 = "INSERT INTO posts (user_id, post_body, post_image, post_date) VALUES ('$myid', '$postBody', 'null', NOW())";
				$conn->query($sql32);
			} else {
				$check = getimagesize($_FILES["image"]["tmp_name"]);
				if($check !== false) {
					$data = base64_encode(file_get_contents( $_FILES["image"]["tmp_name"] ));
					$stuff = 'mime';
					$sql64 = "INSERT INTO posts (user_id, post_body, post_image, post_date) VALUES ('$myid', '$postBody', 'data:$check[$stuff];base64,$data', NOW())";
					$conn->query($sql64);
				} else {
					echo "File is not an image.";
				}	
			}
	} else {
		$sql32 = "INSERT INTO posts (user_id, post_body, post_image, post_date) VALUES ('$myid', '$postBody', null, NOW())";
		$conn->query($sql32);
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
							<span><?php echo $myuser; ?></span>
						</a>
				</div>
			</div>
		</div>
	</nav>
	<!-- End of Navbar -->
	<!-- Main Content -->
	<section id="mainContent" style="padding: 10px 15px; margin-top: 55.5px;">
		<div class="columns">
			<div class="column is-3" id="userPlusTrending">
				<div class="card">
					<div class="card-image">
						<figure class="image is-2by3">
							<img src="https://www.travelingmoments.com/wp-content/uploads/2015/11/20151021-DSC_0470-Pano.jpg" alt="Placeholder image">
						</figure>
					</div>
					<div class="card-content">
						<div class="media">
							<div class="media-left">
								<figure class="image is-48x48">
									<img src="<?php
									$sqlMyCard = "SELECT * FROM users WHERE user_name='$myuser'";
									$resultMyCard = $conn->query($sqlMyCard);
									$rowMyCard = mysqli_fetch_assoc($resultMyCard);
									echo $rowMyCard['user_pic'];
									?>" alt="Placeholder image">
								</figure>
							</div>
							<div class="media-content">
								<p class="title is-4" onclick="window.location.href = 'profile.php?id=<?php echo $_SESSION['id']; ?>'"><?php echo $myuser; ?> ✓</p>
								<p class="subtitle is-6">@<?php echo $myuser; ?></p>
							</div>
						</div>
					</div>
				</div>
				<div class="card" style="margin-top: 10px;">
					<header class="card-header">
						<p class="card-header-title">
							Trending
						</p>
						<a href="#" class="card-header-icon" aria-label="more options">
							<span class="icon">
								<i class="fa fa-angle-down" aria-hidden="true"></i>
							</span>
						</a>
					</header>
					<div class="card-content">
						<div class="content">
							<a href="#">#JEGSoftware</a>
							<br>
							<a href="#">#JChanReborn</a>
							<br>
							<a href="#">#InDevelopement</a>
							<br>
							<a href="#">#EuropeanUnion</a>
							<br>
							<a href="#">#VladimirPutin</a>
							<br>
							<a href="#">#QUEVIENENLOSRUSOS</a>
							<br>
							<a href="#">#LABOMBAESTAENELPARQUE</a>
							<br>
							<a href="#">#Nato</a>
							<br>
							<a href="#">#phpIsObsolete</a>
							<br>
							<p>@WeteTS is posting stuff about this</p>
						</div>
					</div>
				</div>
			</div>
			<div class="column is-4">
			<?php
			$postsQuery = "SELECT * FROM posts ORDER BY post_date DESC";
			$postsResult = $conn->query($postsQuery);
			while($row = mysqli_fetch_assoc($postsResult)) {
				echo '<div class="card">
				<div class="card-content">
					<div class="media">
						<div class="media-left">
							<figure class="image is-48x48">
								<img src="'; $postuserid = $row['user_id'];$userimg = "SELECT * FROM users WHERE user_id=$postuserid";
								$postimgres = $conn->query($userimg);
								$userimgres = mysqli_fetch_assoc($postimgres);
								echo $userimgres['user_pic']; echo '" alt="Placeholder image">
							</figure>
						</div>
						<div class="media-content">
							<p class="title is-4" onclick="window.location.href = \'profile.php?id='; echo $row['user_id']; echo '\'">'; echo $userimgres['user_name']; echo '</p>
							<p class="subtitle is-6">@'; echo $userimgres['user_name']; echo '</p>
						</div>
					</div>'; if($row['post_image'] != "null") {
						echo '<div class="card-image">
						<figure class="image is-4by3">
							<img src="';
							echo $row['post_image']; 
							echo '" alt="Placeholder image">
						</figure>
					</div>';
					} echo '
					<div class="content">'; if(strstr($row['post_body'], '#')) { 
						$nohastag = strstr($row['post_body'], '#', true); 
						$hastag = strstr($row['post_body'], '#');
						$hastagsen = explode(" ", $hastag);
						$afterneedle = str_replace($hastagsen[0], ' ', $hastag);
						echo $nohastag; echo '<a href="topic.php?topic='.$hastagsen[0].'">'.$hastagsen[0].'</a>'.' '.$afterneedle;
					} else {
						echo $row['post_body'];
					}
					echo '
						<br>
						<time datetime="">'; echo $row['post_date']; echo '</time>
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
			<div class="column is-5">
				<div class="card">
					<div class="card-content">
						<form action="home.php" method="POST" enctype='multipart/form-data'>
						<article class="media">
							<div class="media-content">
								<div class="field">
									<p class="control">
										<textarea class="textarea" placeholder="Add a comment..." name="postBody"></textarea>
									</p>
								</div>
								<nav class="level">
									<div class="level-left">
										<div class="level-item">
										<div class="file">
											<label class="file-label">
												<input class="file-input" type="file" name="image">
												<span class="file-cta">
													<span class="file-label">
														Choose a file…
													</span>
												</span>
											</label>
										</div>
										<input type="submit" value="Submit" class="button is-info">
										</div>
									</div>
								</nav>
							</div>
						</article>
						</form>
					</div>
				</div>
				<div class="card">
					<header class="card-header">
						<p class="card-header-title">
							Who you should Follow
						</p>
						<a href="#" class="card-header-icon" aria-label="more options">
							<span class="icon">
								<i class="fa fa-angle-down" aria-hidden="true"></i>
							</span>
						</a>
					</header>
					<?php
					$usersQueryl = "SELECT * FROM users ORDER BY user_id DESC";
					$userQuList = $conn->query($usersQueryl);
					while($rowUsers = mysqli_fetch_assoc($userQuList)) {
						echo '<div class="card-content" onclick= "window.location.href = \'profile.php?id='; echo $rowUsers['user_id']; echo'\'">
						<div class="media">
							<div class="media-left">
								<figure class="image is-48x48">
									<img src="'; echo $rowUsers['user_pic']; echo '" alt="">
								</figure>
							</div>
							<div class="media-content">
								<p class="title is-4">'; echo $rowUsers['user_name']; echo '</p>
								<p class="subtitle is-6">@'; echo $rowUsers['user_name']; echo '</p>
							</div>
						</div>
					</div>';
					}
					?>
					<!--<div class="card-content">
						<div class="media">
							<div class="media-left">
								<figure class="image is-48x48">
									<img src="http://cdn.edgecast.steamstatic.com/steamcommunity/public/images/avatars/f2/f2b5efddecd522ddd86cad72de43d52ae9f16d79_full.jpg" alt="Placeholder image">
								</figure>
							</div>
							<div class="media-content">
								<p class="title is-4">Thealexmax ✓</p>
								<p class="subtitle is-6">@thealexmax </p>
							</div>
						</div>
					</div>-->
				</div>
			</div>
		</div>
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