<?php
$page_url = preg_replace('/&page=\d*/', '', $_SERVER['REQUEST_URI']);

require 'config.php';

$results_per_page = 8;

// DB Connection
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ( $mysqli->connect_errno ) {
	echo $mysqli->connect_error;
	exit();
}

$mysqli->set_charset('utf8');

$sql = "SELECT Comment.game AS game, Users.username AS user, Comment.img AS img, Comment.idComment AS id
				FROM Comment
				LEFT JOIN Users
					ON Users.idUsers = Comment.user_id
				WHERE 1 = 1";

if ( isset($_GET['search']) && !empty($_GET['search']) ) {
	$sql = $sql . " AND Comment.game LIKE '%" . $_GET['search'] . "%'";
}

if ( isset($_GET['search']) && !empty($_GET['search']) ) {
	$sql = $sql . " OR Users.username LIKE '%" . $_GET['search'] ."%'";
}


$sql = $sql . ";";

$results = $mysqli->query($sql);

if ( $results == false ) {
	echo $mysqli->error;
	exit();
}

// Define First & Last Pages.
$num_results = $results->num_rows;
$first_page = 1;
$last_page = ceil($num_results / $results_per_page);
if($last_page<$first_page){
	$last_page=$first_page;
}

// Determine current page number.
if ( isset($_GET['page']) && !empty($_GET['page']) ) {
	$current_page = $_GET['page'];
} else {
	$current_page = $first_page;
}

// Check to make sure page is within bounds.
if ( $current_page < $first_page ) {
	$current_page = $first_page;
} elseif ( $current_page > $last_page ) {
	$current_page = $last_page;
}

$start_index = ($current_page - 1) * $results_per_page;

// Remove semi-colon from SQL statement.
$sql = str_replace(';', '', $sql);

$sql = $sql . " LIMIT " . $start_index . ", " . $results_per_page . ";";

 //echo "<hr>" . $sql . "<hr>";


$results = $mysqli->query($sql);

if ( $results == false ) {
	echo $mysqli->error;
	exit();
}


// Close DB Connection.
$mysqli->close();

?>


<!DOCTYPE html>
<html>
<head>
	<title>Games</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	<link rel="stylesheet" href="overall.css">
	<style>
		body{
			font-family: fantasy;
		}
		.jumbotron {
			border: solid white 1px;
			background-image: url("./img/logo.jpg"); 
			background-size:contain; 
			background-color: white;
			text-align: center;
			border-radius: 0px;
			margin-top: 7%;
			padding-top:8%;
			padding-bottom: 15%;
			color: white;
		}
		.navbar-toggler-icon {
			background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 32 32' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba(255,255,255, 1)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 8h24M4 16h24M4 24h24'/%3E%3C/svg%3E");
		}

		.jumbotron:hover{
            border: solid red 1px;
            cursor: pointer;
		}
		
		.item{
			text-align:center;
			padding: .25rem;
			background-color: #fff;
			border: 1px solid #dee2e6;
			border-radius: .25rem;
			height: auto;
		}
		.item:hover{
			background-color:grey;
			cursor:pointer;
		}
		.title{
			font-size:150%;
		}
		.container{
			text-align:center;
		}
		.b{
			width:100px;
			color:#0F084B;
		}
		.active{
			background-color:#0F084B;
			color:white;
			position: relative;
			display: block;
			padding: .5rem .75rem;
			margin-left: -1px;
			line-height: 1.25;
			border: 1px solid #dee2e6;
		}
		@media (max-width: 992px) {
			.jumbotron {
				margin-top: 10%;
			}

		}
		@media (max-width: 768px) {
			.jumbotron {
				background-image: url("./img/logoS.jpg"); 
				background-size:contain; 
				margin-top: 20%;
				padding-top:25%;
				padding-bottom: 30%;
			}
			.item{
				padding-left:10px;
				padding-right:10px;
			}
			.special{
				display:none;
			}
		}
		
	</style>
</head>
<body>
	<nav class="navbar navbar-expand-lg fixed-top">
	  <div class="container">
	  	<a class="navbar-brand" href="landing.php">FindGame</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
	    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
	      <div class="navbar-nav text-left">
	        <a class="nav-item nav-link current" href="main.php?">Games</a>
	        <a class="nav-item nav-link" href="compose.php">Compose</a>
    	  </div>
    	  <div class="navbar-nav ml-auto">
    	  	<form class="form-inline" action="main.php?" method="GET">
			  <input class="search form-control-sm" type="text" placeholder="Search title/composer" name="search">
			  <button type="submit" class="search form-control-sm btn fa fa-search"></button>
			</form>
		  </div>
    	  <div class="navbar-nav ml-2">
    	  </div>
		</div>
	  </div>
	</nav>
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="jumbotron" onclick="window.location='landing.php';">
					
				</div>
				<br>
				<h1> All Comments </h1>
				<nav aria-label="Page navigation example">
					<ul class="pagination justify-content-center">
						<li class="page-item special">
							<a class="page-link b" href="<?php echo $page_url . "&page=1"; ?>">First</a>
						</li>
						<li class="page-item">
							<a class="page-link b" href="<?php echo $page_url . "&page=" . ($current_page-1); ?>">Previous</a>
						</li>
						<li class="page-item">
							<div class="b active"> <?php echo "Page " . $current_page; ?></div>
						</li>
						<li class="page-item">
							<a class="page-link b" href="<?php echo $page_url . "&page=" . ($current_page+1); ?>">Next</a>
						</li>
						<li class="page-item special">
							<a class="page-link b" href="<?php echo $page_url . "&page=" . $last_page; ?>">Last</a>
						</li>
					</ul>
				</nav>
				<p>
					<?php echo "Hello " . $_SESSION['username']?>
				</p>
				<p>
					<?php if($results->num_rows==0) :?>
						Showing no results
					<?php else:?>
						Showing
						<?php echo ($start_index + 1); ?>
						-
						<?php echo ($start_index + $results->num_rows); ?>
						of
						<?php echo $num_results; ?>
						result(s).
					<?php endif; ?>
				</p>
				
			</div>
		</div>
		<div class="row">
		<?php while ( $row = $results->fetch_assoc() ) : ?>
			
				<div class="col-lg-3 col-md-6 col-sm-12 item" onclick="window.location='review-detail.php?comment_id=<?php echo $row['id']; ?>'">
					<p class="title">
						<?php echo $row['game']; ?>
					</p>
					<p class="composer">
						<?php echo $row['user']; ?>
					</p>
					<img src= "<?php echo $row['img'];?>" class="img-thumbnail mx-auto d-block">
				</div>
			
		<?php endwhile; ?>
		</div>

	</div>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>