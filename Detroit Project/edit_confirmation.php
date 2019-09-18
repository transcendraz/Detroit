<?php

if ( !isset($_POST['game']) || empty($_POST['game']) 
	|| !isset($_POST['publish_date']) || empty($_POST['publish_date'])
	|| !isset($_POST['platform']) || empty($_POST['platform'])
	|| !isset($_POST['stars']) || empty($_POST['stars'])
    || !isset($_POST['ImageUrl']) || empty($_POST['ImageUrl'])
    || !isset($_POST['comment']) || empty($_POST['comment'])
    ) {

	// Missing required fields.
	$error = "Please fill out all required fields.";

} else {
	// All required fields provided.
	require 'config.php';

	// DB Connection
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if ( $mysqli->errno ) {
		echo $mysqli->error;
		exit();
	}

	if(!isset($_POST['price']) || empty($_POST['price']) ){
        $_POST['price']=0;
	}
	
	$sql = "UPDATE Comment
					SET game = '" . $_POST['game'] . "', 
					publish = '" . $_POST['publish_date'] ."', 
					platform_id = " . $_POST['platform'] .", 
					stars = " . $_POST['stars'] .", 
					img = '" . $_POST['ImageUrl'] ."', 
					comment = '" . $_POST['comment'] ."', 
					price = " . $_POST['price'] ."
					WHERE idComment = " . $_POST['comment_id'] . ";";

	echo "<hr>" . $sql . "<hr>";

	$results = $mysqli->query($sql);
	if ( !$results ) {
		echo $mysqli->error;
		exit();
	}

	$mysqli->close();

}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Edit Confirmation</title>
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
        form{
			border-radius: 3px;
		}
		form>h1{
			text-align: center;
			background-color:white;
			border-radius: 3px;
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
	        <a class="nav-item nav-link" href="main.php?">Games</a>
	        <a class="nav-item nav-link current" href="compose.php" onclick="return writeReview();">Compose</a>
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
            <div class="col-12">
                <div class="jumbotron" onclick="window.location='landing.php';">
                        
                </div>
            </div>
            <br>
			<div class="col-12">
				<!-- Error message if required fields are not given. Else show a confirmation message. -->
				<?php if( isset($error) && !empty($error)) :?>
					<div class="text-danger">
						<?php echo $error; ?>
					</div>

				<?php else: ?>
					<div class="text-success">
						<span class="font-italic"><?php echo $_SESSION['username']?></span>'s review regarding "<?php ECHO $_POST['game']?>" was successfully edited.
					</div>
				<?php endif; ?>
			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row mt-4 mb-4">
			<div class="col-12">
				<a href="main.php?" role="button" class="btn btn-dark">Back to Main</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
    </div> <!-- .container -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>-->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> 


</body>
</html>