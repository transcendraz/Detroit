<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
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
		.is-invalid {
			color: #E00;
			display: block;
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
	
		form{
			border-radius: 3px;
		}
		form>h1{
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
				<form action="register_confirmation.php" method="post">
                    <h1>Register</h1>
					<div class="form-group">
						<label for="username">Username:</label>
						<input type="text" class="form-control" id="username-id" name="username" required>
						<small id="username-error" class="invalid-feedback">Username is required and cannot be blank.</small>
					</div>
					<div class="form-group">
					
					</div>
					<div class="form-group">
						<label for="password">Password:</label>
						<input type="password" class="form-control" id="password-id" name="password" required>
						<small id="password-error" class="invalid-feedback">Password is required cannot be only spaces.</small>
					</div>
                    <div class="form-group">
						<label for="passC">Confirm Password:</label>
						<input type="password" class="form-control" id="passC-id" name="passC" required>
						<small id="password-error" class="invalid-feedback">Confirm Password do not conform with Password.</small>
					</div>
					<button type="submit" class="btn btn-dark">Submit</button>
                </form>
                <form action="login.php" id="extra">
						<button type="submit" class="btn btn-dark">Login</button>
				</form>
			</div>
		</div>
	</div>

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>-->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> 
	<script>
		document.querySelector('form').onsubmit = function(){
			if ( document.querySelector('#username-id').value.trim().length == 0 ) {
				document.querySelector('#username-id').classList.add('is-invalid');
			} else {
				document.querySelector('#username-id').classList.remove('is-invalid');
			}

			if ( document.querySelector('#password-id').value.trim().length == 0 ) {
				document.querySelector('#password-id').classList.add('is-invalid');
			} else {
				document.querySelector('#password-id').classList.remove('is-invalid');
			}

			if( document.querySelector('#passC-id').value.trim()!=document.querySelector('#password-id').value.trim()){
				document.querySelector('#passC-id').classList.add('is-invalid');
			}else {
				document.querySelector('#passC-id').classList.remove('is-invalid');
			}

			return ( !document.querySelectorAll('.is-invalid').length > 0 );
		}
	</script>
</body>
</html>