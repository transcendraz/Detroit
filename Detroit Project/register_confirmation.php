<?php

require 'config.php';

if (!isset($_POST['username']) || empty($_POST['username'])
	|| !isset($_POST['password']) || empty($_POST['password']) ) {
	$error = "Please fill out all required fields.";
}else{
	//connect to the DB to add this user info to the DB
	$mysqli=new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if($mysqli->connect_errno){
		echo $mysqli->connect_error;
		exit();
	}
	//check if username or email already exists in the user table
	$sql_registered = "SELECT * FROM Users 
	WHERE username = '" . $_POST['username'] . "'";
	//echo $sql_registered;
	//run this sql statment
	$results_registered=$mysqli->query($sql_registered);
	if(!$results_registered){
		echo $mysqli->error;
		exit();
	}
	//var_dump($results_registered);
	//if there is a match, aka at least one record was returned, then we know the username or email is taken
	if($results_registered->num_rows>0){
		$error = "Username has already been taken. Please choose another one.";
	}else{

		$password = hash('sha256', $_POST['password']);
		//echo $password;


		$sql = "INSERT INTO Users(username,password)
				VALUES('" . $_POST['username'] . "','" . $password . "');
			";
		//echo "<hr>" . $sql . "<hr>";

		$results = $mysqli->query($sql);
		if(!$results){
			echo $mysqli->error;
			exit();
		}
	}
	$mysqli->close();
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Registration Confirmation</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
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
		#extra{
			float:right;
			position: relative;
			top:-38px;
		}
	
		
		form {
			padding-top:10px;
			text-align: center;
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
                <div class="jumbotron" onclick="window.location='landing.php';">
                        
                </div>
                <br>
            
                <form>
                    <div class="form-group">
                        <?php if ( isset($error) && !empty($error) ) : ?>
                            <div class="text-danger"><?php echo $error; ?></div>
                        <?php else : ?>
                            <div class="text-success"><?php echo $_POST['username']; ?> was successfully registered.</div>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <a href="register.php" class="btn landing-button">Register</a>
                    </div>
                    <div class="form-group">
                        <a href="login.php" class="btn landing-button">Login</a>
                    </div>
                </form>
            </div>
		</div> <!-- .row -->
	</div> <!-- .container -->
   

</div> <!-- .container -->

</body>
</html>