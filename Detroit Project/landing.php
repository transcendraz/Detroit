<!DOCTYPE html>
<html>
<head>
	<title>Landing</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<style>
		body{
			background-image: url("./img/bg.jpg"); 
			background-size: cover;
			font-family: fantasy;
		}
		.jumbotron {
			border: solid white 1px;
			background-image: url("./img/logo.jpg"); 
			background-size:contain; 
			background-color: white;
			text-align: center;
			border-radius: 10px;
			margin-top: 7%;
			padding-top:8%;
			padding-bottom: 15%;
			color: white;
		}


		form {
			padding-top:10px;
			text-align: center;
		}

		.landing-button {
			background-color: #F2F4F3;
			color: black;
			width: 300px;
			font-size:20px;
		}
		@media (max-width: 768px) {
			.jumbotron {
				background-image: url("./img/logoS.jpg"); 
				background-size:contain; 

				padding-top:25%;
				padding-bottom: 30%;
			}

		}
	</style>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="jumbotron">
					
				</div>
				<br>
				<form action="main.php?" method="post">
					<div class="form-group">
						<a href="register.php" class="btn landing-button">Register</a>
					</div>
					<div class="form-group">
						<a href="login.php" class="btn landing-button">Login</a>
					</div>
				</form>
			</div>
		</div>
	</div>

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>-->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> 
</body>
</html>