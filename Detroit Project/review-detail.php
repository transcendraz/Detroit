<?php
if ( !isset($_GET['comment_id']) || empty($_GET['comment_id']) ) {
	$error = "404, the page does not exist";
} else {

	require 'config.php';

	// DB Connection
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	if ( $mysqli->connect_errno ) {
		echo $mysqli->connect_error;
		exit();
	}

	$mysqli->set_charset('utf8');


	$sql = "SELECT Comment.idComment, Comment.game AS game, Comment.stars AS stars, Comment.publish AS publish, Comment.comment AS comment, Comment.price AS price, Comment.img AS img, Users.username AS username, Platform.platform AS platform
					FROM Comment
					LEFT JOIN Users
						ON Comment.user_id = Users.idUsers
					LEFT JOIN Platform
						ON Comment.platform_id = Platform.idPlatform
					WHERE Comment.idComment = " . $_GET['comment_id'] . ";";

	//echo "<hr>" . $sql . "<hr>";

	$results = $mysqli->query($sql);
	if ( !$results ) {
		echo $mysqli->error;
		exit();
	}

	// Since we only get 1 result (searching by primary key), we don't need a loop.
	$row = $results->fetch_assoc();

	$mysqli->close();

}
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
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
        .table td{
			border-top:none;
		}
		.table th{
			border-top:none;
        }
        .comment{
			text-align:left;
			padding: .25rem;
			background-color: #fff;
			border: 1px solid #dee2e6;
			border-radius: .25rem;
			height: auto;
        }
        h3{
            padding-top:10px;
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
	      <div class="navbar-nav">
	        <a class="nav-item nav-link" href="main.php?">Games</a>
	        <a class="nav-item nav-link" href="compose.php">Compose</a>
    	  </div>
    	  <div class="navbar-nav ml-auto">
    	  	<form class="form-inline" action="home.php" method="GET">
			  <input class="search form-control-sm" type="text" placeholder="Search title" name="search">
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
        </div>
        <div class="row>">
            <?php if(isset($error) && !empty($error)) :?>
                <div class="text-danger">
                    <?php echo $error; ?>
                </div>
            <?php else: ?>
                <div class="col-12 col-lg-6 float-left">
                <img src= "<?php echo $row['img'];?>" class="img-thumbnail mx-auto d-block">
                </div>
                <div class="col-12 col-lg-6 float-right">
                    <table class="table table-borderless">
                        <tr>
                            <th class="text-right">Game:</th>
                            <td><?php echo $row['game'];?></td>
                        </tr>

                        <tr>
                            <th class="text-right">Stars:</th>
                            <td><?php echo $row['stars'];?></td>
                        </tr>

                        <tr>
                            <th class="text-right">Publish Date:</th>
                            <td><?php echo $row['publish'];?></td>
                        </tr>

                        <tr>
                            <th class="text-right">Price:</th>
                            <td><?php echo $row['price'];?></td>
                        </tr>

                        <tr>
                            <th class="text-right">Composed by:</th>
                            <td><?php echo $row['username'];?></td>
                        </tr>

                        <tr>
                            <th class="text-right">Platform:</th>
                            <td><?php echo $row['platform'];?></td>
                        </tr>
                    </table>
                </div>
                <div class="clearfix"></div>
                <h3>Comment:</h3>
                <div class="col-12 comment">
                    <?php echo $row['comment'];?>
                </div>
            <?php endif?>
		</div> <!-- .row -->
		<div class="row mt-4 mb-4">
            
			<div class="col-6 float-left">
				<a href="main.php?" role="button" class="btn btn-dark">Back</a>
            </div> <!-- .col -->
            <?php if($_SESSION['username']==$row['username']||$_SESSION['userID']==1):?>
                <div class="col-6 float-left">
                    <a class="btn btn-dark float-right" href="edit_form.php?comment_id=<?php echo $_GET['comment_id']?>">Edit</a>
                    <a class="btn btn-dark float-right" href="delete.php?comment_id=<?php echo $_GET['comment_id']?>" onclick="return confirm('Are you sure?');">Delete</a>
                </div>
            <?php endif;?>
		</div> <!-- .row -->
    </div> <!-- .container -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>-->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> 

</body>
</html>

