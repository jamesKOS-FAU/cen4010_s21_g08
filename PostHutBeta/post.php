<?php
	session_start();
	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
		header("location: index.php");exit;
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Create a Post</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/styles.css">
<!--===============================================================================================--></head>

<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <h1 class="display-5">Post<h1 style="color:#16BDE7">Hut</h1> </h1>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
       	      <div class="navbar-nav"> 
                   <a class="nav-item nav-link" href="./home.php">Home Page</a> 
                   <a class="nav-item nav-link" href="./theme_v0.php">Daily Theme</a> 
                   <a class="nav-item nav-link" href="./popular_v0.php">Popular Posts<span class="sr-only">(current)</span></a>
		   <a class="nav-item nav-link active" href="#">Post!</a>
		   <a class="nav-item nav-link active" href="./tpost.php">Themed Post!</a>
              </div> 
    
	</div>
     </nav>

    <section class="jumbotron jumbotron-fluid bg-info text-white" id="Portfolio">
        <div class="container">
        <h1 class="display-4">Welcome to PostHut</h1>
        <h5> <br>You can create your own post here and upload it to <b>PostHut</b>. Note the character limit of 500.</h5>
        <h5> <br>You can also upload an image related to your post. The image can be up to 8 megabytes in size.</a></h5>
            </div>
    </section>
    
    <div class="limiter">

		<div class="wrap-login100" style="margin:auto;">
	
			<form name=createpost action="postpost.php" method = "post" enctype="multipart/form-data" class="validate form">
			<span class="login100-form-title p-b-34 p-t-27">Create a Post</span>

			<div class="form-group, wrap-input100 validate-input">
	   
				<label for="Title">Title:</label><br>
				<input type="text" id="Title" name="Title" required maxlength=64><br>
			
				<label for="Content">Post Content:</label><br>
				<input type="text" id="Content" name="Content" maxlength=500><br>
			
				<label for="Image">Image Upload:</label><br>
				<input type="file" id="Image" name="Image"><br>
       </div>

            <div class="form-group, container-login100-form-btn">
                <button type="submit" class="login100-form-btn" style="letter-spacing: 0.75px" value="Submit">Submit</button>
		          &nbsp; &nbsp;
                <button type="reset" class="login100-form-btn" style="letter-spacing: 0.75px" value="Reset">Reset</button>
            </div>
        </form>
      </div>
    </div>
    
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>
</body>

</html>