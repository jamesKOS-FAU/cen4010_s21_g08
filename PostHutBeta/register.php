<?php

// Include config file

require_once "config.php";

 

// Define variables and initialize with empty values

$email = $username = $password = "";

$email_err = $username_err = $password_err = "";

 

// Processing form data when form is submitted

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(empty(trim($_POST["username"]))){

        $username_err = "Please enter a username";     

    } elseif(strlen(trim($_POST["username"])) < 3){

        $username_err = "Username should be more than 3 characters";

    }

	else{

        $username = trim($_POST["username"]);

    }
    


    
    // Validate username

    if(empty(trim($_POST["email"]))){

        $email_err = "Please enter your Email Address.";

    } else{

        // Prepare a select statement

        $sql = "SELECT id FROM Users WHERE email = ?";

        

        if($stmt = mysqli_prepare($link, $sql)){

            // Bind variables to the prepared statement as parameters

            mysqli_stmt_bind_param($stmt, "s", $param_email);

            

            // Set parameters

            $param_email = trim($_POST["email"]);

            

            // Attempt to execute the prepared statement

            if(mysqli_stmt_execute($stmt)){

                /* store result */

                mysqli_stmt_store_result($stmt);

                

                if(mysqli_stmt_num_rows($stmt) == 1){

                    $email_err = "This email is already in use";

                } 

		else{

                    $email = trim($_POST["email"]);

                }

            } else{

                echo "Oops! Something went wrong. Please try again later.";

            }



            // Close statement

            mysqli_stmt_close($stmt);

        }

    }

    

    // Validate password

    if(empty(trim($_POST["password"]))){

        $password_err = "Please enter a password.";     

    } elseif(strlen(trim($_POST["password"])) < 9){

        $password_err = "Password must have at least 9 characters";

    }

	else{

        $password = trim($_POST["password"]);

    }

    

    

    // Check input errors before inserting in database

    if(empty($email_err) && empty($username_err) && empty($password_err)){

        

        // Prepare an insert statement

        $sql = "INSERT INTO Users (email, username, password) VALUES (?, ?, ?)";

         

        if($stmt = mysqli_prepare($link, $sql)){

            // Bind variables to the prepared statement as parameters

            mysqli_stmt_bind_param($stmt, "sss", $param_email, $param_username, $param_password);

            

            // Set parameters
	        $param_email = $email;
	        $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

            

            // Attempt to execute the prepared statement

            if(mysqli_stmt_execute($stmt)){

                // Redirect to login page

                header("location: index.php");

            } else{

                echo "Something went wrong. Please try again later.";

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
    <title>PostHut Create Account</title>
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
<!--===============================================================================================--></head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <h1 class="display-5">Post<h1 style="color:#16BDE7">Hut</h1> </h1>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                </div>
     </nav>

    <section class="jumbotron jumbotron-fluid bg-info text-white" id="Portfolio">
        <div class="container">
        <center><h1 class="display-4">Welcome to PostHut</h1>
        <h5> <br> To fully take advantage of<b> PostHut</b> please register an account below:</h5>
        <h5> <br> Already Have an Account? <a href = "./index.php" style ="color:white">Login Here</a></h5></center>
            </div>
    </section>
    
    <div class="limiter">

 	  <div class="wrap-login100" style="margin:auto;">
	
         <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="login100-form validate form">
	   <span class="login100-form-title p-b-34 p-t-27">Registration Form</span>

	   <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>, wrap-input100 validate-input" data-validate = "Enter username">
                <input type="text" name="username" class="form-control, input100" value="<?php echo $username; ?>" required placeholder="Username">
	        <span class="focus-input100" data-placeholder="&#xf207;"></span>
		    <span class="help-block"><?php echo $username_err; ?></span>
       </div> 

	    <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>, wrap-input100 validate-input" data-validate="Enter email">

                <input type="text" name="email" class="form-control, input100" pattern = ".+@.+" value="<?php echo $email; ?>" required placeholder="Email Address">
                <span class="focus-input100" data-placeholder="@"></span>
                <span class="help-block"><?php echo $email_err; ?></span>

            </div>    

            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>, wrap-input100 validate input" data-validate="Enter Password">

                <input type="password" name="password" class="form-control, input100" value="<?php echo $password; ?>" required placeholder = "Password" style="letter-spacing: 0.75px">
		<span class="focus-input100" data-placeholder="&#xf191;"></span>
                <span class="help-block"><?php echo $password_err; ?></span>

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

