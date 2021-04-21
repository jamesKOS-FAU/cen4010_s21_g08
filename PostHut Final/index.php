<?php 
// Initialize the session 
session_start();
  
// Check if the user is already logged in, if yes then redirect him to welcome page 
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) { 
    header("location: https://lamp.cse.fau.edu/~cen4010_s21_g08/home.php"); 
    exit; 
} 
  
// Include config file 
require_once "config.php"; 
  
// Define variables and initialize with empty values 
$username = $password = ""; 
$username_err = $password_err = ""; 
  
// Processing form data when form is submitted 
if($_SERVER["REQUEST_METHOD"] == "POST"){ 
  
    // Check if username is empty 
    if(empty(trim($_POST["username"]))){ 
        $username_err = "Please enter your username."; 
    } else{ 
        $username = trim($_POST["username"]); 
    } 
     
    // Check if password is empty 
    if(empty(trim($_POST["password"]))){ 
        $password_err = "Please enter your password."; 
    } else{ 
        $password = trim($_POST["password"]); 
    } 
     
    // Validate credentials 
    if(empty($username_err) && empty($password_err)){ 
        // Prepare a select statement 
        $sql = "SELECT id, username, password FROM Users WHERE username = ?"; 
         
        if($stmt = mysqli_prepare($link, $sql)){ 
            // Bind variables to the prepared statement as parameters 
            mysqli_stmt_bind_param($stmt, "s", $param_username); 
             
            // Set parameters 
            $param_username = $username; 
             
            // Attempt to execute the prepared statement 
            if(mysqli_stmt_execute($stmt)){ 
                // Store result 
                mysqli_stmt_store_result($stmt); 
                 
                // Check if username exists, if yes then verify password 
                if(mysqli_stmt_num_rows($stmt) == 1){                     
                    // Bind result variables 
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password); 
                    if(mysqli_stmt_fetch($stmt)){ 
                        if(password_verify($password, $hashed_password)){ 
                            // Password is correct, so start a new session 
                            session_start(); 
                             
                            // Store data in session variables 
                            $_SESSION["loggedin"] = true; 
                            $_SESSION["id"] = $id;    
                            $_SESSION["username"] = $username; 
		                          
                             
                            // Redirect user to welcome page 
                            header("location: https://lamp.cse.fau.edu/~cen4010_s21_g08/home.php"); 
                        } else{ 
                            // Display an error message if password is not valid 
                            $password_err = "The password you entered was not valid."; 
                        } 
                    } 
                } else{ 
                    // Display an error message if username doesn't exist 
                    $username_err = "No account found with that username."; 
                } 
            } else{ 
                echo "Oops! Something went wrong. Please try again later."; 
            } 
 
            // Close statement 
            mysqli_stmt_close($stmt); 
        } 
    } 
     
    // Close connection 
    mysqli_close($link); 
} 
?>

<!DOCTYPE html>
<html lang="en">
<style>
    a {
        letter-spacing: 0.5px;
        font-family: "Times New Roman", "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
    }
    h1 {
        letter-spacing: 0.5px;
        font-family: "Times New Roman", "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";      
    }
   
    h2 {
        letter-spacing: 0.75px;
        font-family: "Times New Roman", "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
    }

    h4 {
        letter-spacing: 0.75px;
        font-family: "Times New Roman", Times, serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
    }        

    p {
        letter-spacing: 0.75px;
        font-family: "Times New Roman", "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
    }
</style>


<head>
    <title>PostHut Login</title>
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
<!--===============================================================================================-->
<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=G-EDBLRPVRKG"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());

			gtag('config', 'G-EDBLRPVRKG');
		</script>

</head>
    <body>
        

    <body>
        <section>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <h1 class="display-5">Post<h1 style="color:#37b9ed">Hut</h1> </h1>
                
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                </div>
            </nav>

        </section>

        <!--JumboTron Display-->
        <section class="jumbotron jumbotron-fluid bg-info text-white" id="Portfolio">
            <div class="container">
                <center><h1 class="display-4">Welcome to PostHut</h1>
                <h5> <br> Please Login to Continue to <b>PostHut</b></h5>
		<h5> <br> Or Register for an Account <a href = "register.php">Here</a></h5></center>
            </div>
        </section>

<div class="limiter">
       <div class="wrap-login100" style="margin: auto;">
	<span class="login100-form-title p-b-34 p-t-27" style"letter-spacing: 0.75px"> Log In </span>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="login100-form validate form">
            
	    <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>, wrap-input100">
                <input type="text" name="username" class="form-control, input100" value="<?php echo $username; ?>" placeholder="Username"
		 style="letter-spacing: 0.75px;">
		<span class="focus-input100" data-placeholder="&#xf207;"></span>
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>, wrap-input100">
                <input type="password" name="password" class="form-control, input100" placeholder="Password" style="letter-spacing:0.75px">
                <span class="focus-input100" data-placeholder="&#xf191;"></span>
		<span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group, container-login100-form-btn">
                <button type="submit" class="login100-form-btn" value="Login">Login</button>
            </div>
         </form>
    </div>    
      
        </body>
    </body>
</html>