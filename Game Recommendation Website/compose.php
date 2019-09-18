<?php

require 'config.php';

// DB Connection
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ( $mysqli->connect_errno ) {
	echo $mysqli->connect_error;
	exit();
}

$mysqli->set_charset('utf8');

// Platforms:
$sql_platform = "SELECT * FROM Platform;";
$results_platform = $mysqli->query($sql_platform);
if ( $results_platform == false ) {
	echo $mysqli->error;
	exit();
}

// Close DB Connection
$mysqli->close();

?>


<!DOCTYPE html>
<html>
<head>
	<title>Compose</title>
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
        .is-invalid {
			color: #E00;
			display: block;
		}
        form{
			border-radius: 3px;
		}
		form>h1{
			text-align: center;
			background-color:white;
			border-radius: 3px;
        }
        form>p{
            text-align:center;
        }
        .special-button{
            background-color:#0F084B;
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
			<div class="col-lg-12">
				<div class="jumbotron" onclick="window.location='landing.php';">
					
				</div>
				<br>
            
                <form id="mainform" action="compose_confirmation.php" method="POST">
                    <h1>Compose your Comment!</h1>
                    <p> A good gamer should know everything about a game! So fill every column of it!</p>
                    <div class="form-group row"></div>
                    <div class="form-group row"></div>
                    <div class="form-group row">
                        <label for="game-id" class="col-sm-3 col-form-label text-sm-left">Game: <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="game-id" name="game">
                            
                        </div>
                        <div class="col-sm-12">
                            </div>
                        </div> <!-- .form-group -->

                    <div class="form-group row">
                        <label for="publish-date-id" class="col-sm-3 col-form-label text-sm-left">Publish Date: <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="date" class="form-control" id="publish-date-id" name="publish_date">
                        </div>
                    </div> <!-- .form-group -->

                    <div class="form-group row">
                        <label for="genre-id" class="col-sm-3 col-form-label text-sm-left">Platform: <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select name="platform" id="platform-id" class="form-control">
                                <option value="" selected>-- All --</option>

                                <!-- Genre dropdown options here -->
                                <!-- Alternative PHP syntax -->
                                <?php while($row = $results_platform->fetch_assoc()) : ?>
                                    <option value= "<?php echo $row['idPlatform']; ?>">
                                        <?php echo $row["platform"] ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                    </div> <!-- .form-group -->
                    <div class="form-group row">
                        <label for="stars-id" class="col-sm-3 col-form-label text-sm-left">Stars: <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select name="stars" id="stars-id" class="form-control">
                                <option value="" selected>-- SELECT --</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                    </div> <!-- .form-group -->
                    <div class="form-group row">
                        <label for="price-id" class="col-sm-3 col-form-label text-sm-left">Price: <span class="text-danger">*</span> </label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="price-id" name="price" min="-1">
                        </div>
                    </div> <!-- .form-group -->
                    
                    <div class="form-group row">
                        <label for="image-id" class="col-sm-3 col-form-label text-sm-left">ImageUrl:<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="image-id" name="ImageUrl">
                        </div>
                    </div> <!-- .form-group -->

                    <div class="form-group row">
                        <label for="comment-id" class="col-sm-3 col-form-label text-sm-left">Comment:<span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <textarea name="comment" id="comment-id" class="form-control"></textarea>
                        </div>
                    </div> <!-- .form-group -->

                    <div class="form-group row">
                        <div class="ml-auto col-sm-9">
                            <span class="text-danger font-italic">* Required</span>
                        </div>
                    </div> <!-- .form-group -->

                    <div class="form-group row">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-9 mt-2">
                            <button type="submit" class="btn btn-dark">Submit</button>
                            <button type="reset" class="btn btn-light">Reset</button>
                        </div>
                    </div> <!-- .form-group -->

                </form>

			</div>
		</div>
	</div>
	<script>
		document.querySelector('#mainform').onsubmit = function(){
			if ( document.querySelector('#game-id').value.trim().length == 0 ) {
				document.querySelector('#game-id').classList.add('is-invalid');
			} else {
				document.querySelector('#game-id').classList.remove('is-invalid');
			}

			if ( document.querySelector('#publish-date-id').value.trim().length == 0 ) {
				document.querySelector('#publish-date-id').classList.add('is-invalid');
			} else {
				document.querySelector('#publish-date-id').classList.remove('is-invalid');
			}
            if ( document.querySelector('#platform-id').value.trim().length == 0 ) {
				document.querySelector('#platform-id').classList.add('is-invalid');
			} else {
				document.querySelector('#platform-id').classList.remove('is-invalid');
			}
            if ( document.querySelector('#stars-id').value.trim().length == 0 ) {
				document.querySelector('#stars-id').classList.add('is-invalid');
			} else {
				document.querySelector('#stars-id').classList.remove('is-invalid');
			}
            if ( document.querySelector('#price-id').value.trim().length == 0 ) {
				document.querySelector('#price-id').classList.add('is-invalid');
			} else {
				document.querySelector('#price-id').classList.remove('is-invalid');
			}
            if ( document.querySelector('#image-id').value.trim().length == 0 ) {
				document.querySelector('#image-id').classList.add('is-invalid');
			} else {
				document.querySelector('#image-id').classList.remove('is-invalid');
			}
            if ( document.querySelector('#comment-id').value.trim().length == 0 ) {
				document.querySelector('#comment-id').classList.add('is-invalid');
			} else {
				document.querySelector('#comment-id').classList.remove('is-invalid');
			}


			return ( !document.querySelectorAll('.is-invalid').length > 0 );
		}
	</script>

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>-->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> 
</body>
</html>