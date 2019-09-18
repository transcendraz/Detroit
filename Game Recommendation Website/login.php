<?php


//session_start();
require 'config.php';
	//make sure a username and a password has been submitted
	if ( isset($_POST['username']) && isset($_POST['password']) ) {
		//check if user has entered in username/password
		if ( empty($_POST['username']) || empty($_POST['password']) ) {

			$error = "Please enter username and password.";

		}
		else {
			//attempt login. check thaat their username/password matches.
			$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

			if($mysqli->connect_errno) {
				echo $mysqli->connect_error;
				exit();
			}

			$passwordInput = "";
			$passwordInput= hash('sha256',$_POST['password']);

			$sql = "SELECT * FROM Users
						WHERE username = '" . $_POST['username'] . "' AND password = '" . $passwordInput . "';";

			//echo "<hr>" . $sql . "<hr>";
			
			$results = $mysqli->query($sql);

			if(!$results) {
				echo $mysqli->error;
				exit();
			}

			//if we get at least one result back, it means username/pw combo is correct
			if($results->num_rows > 0) {
				
				//Store this user info in a session
				$_SESSION['logged_in']=true;
				$row = $results->fetch_assoc();
				$_SESSION['userID']=$row['idUsers'];
				$_SESSION['username'] = $_POST['username'];
				//authentication is successful. redirect them
				header('Location: main.php?');
			
			}
			else {
				$error = "Invalid username or password.";
			}
		} 
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Landing</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<style>
		body{
			background-color:rgba(164, 164, 164, 0.509);
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
		.jumbotron:hover{
            border: solid red 1px;
            cursor: pointer;
        }
        label{
			background-color: rgba(164, 164, 164, 0.509);
			color:black;
			font-size: 115%;
			border-radius: 3px;
		}
		.is-invalid {
			color: #E00;
			display: block;
		}
		#extra{
			float:right;
			position: relative;
			top:-38px;
		}
	
		form{
			border-radius: 3px;
		}
		form>h1{
			text-align: center;
			background-color:rgba(164, 164, 164, 0);
			border-radius: 3px;
		}
		form>h6{
			text-align: center;
			background-color:rgba(164, 164, 164, 0);
			border-radius: 3px;
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
				<div class="jumbotron" onclick="window.location='landing.php';">
					
				</div>
				<br>
				<form action="login.php" method="post">
					<h1>Login</h1>
					<h6 class="font-italic text-danger">
						<!-- Show errors here. -->
						<?php
							if ( isset($error) && !empty($error) ) {
								echo $error;
							}
						?>
					</h6>
					<div class="form-group">
						<label for="username">Username:</label>
						<input type="text" class="form-control" id="username" name="username" required>
						<small id="username-error" class="invalid-feedback">Username is required and cannot be blank.</small>
					</div>
					<div class="form-group">
					</div>
					<div class="form-group">
						<label for="password">Password:</label>
						<input type="password" class="form-control" id="password" name="password" required>
						<small id="password-error" class="invalid-feedback">Password is required cannot be only spaces.</small>
					</div>
					<button type="submit" class="btn btn-dark">Submit</button>
				</form>
				<form action="register.php" id="extra">
						<button type="submit" class="btn btn-dark">Register</button>
				</form>
			</div>
		</div>
	</div>
	<script>
		document.querySelector('form').onsubmit = function(){
			if ( document.querySelector('#username').value.trim().length == 0 ) {
				document.querySelector('#username').classList.add('is-invalid');
			} else {
				document.querySelector('#username').classList.remove('is-invalid');
			}

			if ( document.querySelector('#password').value.trim().length == 0 ) {
				document.querySelector('#password').classList.add('is-invalid');
			} else {
				document.querySelector('#password').classList.remove('is-invalid');
			}

			return ( !document.querySelectorAll('.is-invalid').length > 0 );
		}
	</script>

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>-->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> 
</body>
</html>