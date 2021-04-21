<?php // Initialize the session 
	require_once "config.php";
	session_start(); // Check if the user is logged in, if not then redirect him to login page 
	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
	{ 
		header("location: index.php"); exit; 
	}
	
	//Nice count updater
	error_reporting(0);
	if($_POST['Nice']){		
		$sqlNice = "UPDATE Posts SET `Nices` = `Nices`+1 WHERE `postID` = " . $_POST['Nice'];
		$resultNice = mysqli_query($link, $sqlNice);
	}
	error_reporting(-1);
?> 

<!DOCTYPE html> 
<html lang="en"> 
<meta charset="UTF-8"> 
<meta name="viewport" content="width=device-width, initial-scale=1"> 
    <head>
	
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=G-EDBLRPVRKG"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());

			gtag('config', 'G-EDBLRPVRKG');
		</script>
        
		<title>PostHut Home</title> 
         <link rel="icon" href="./logo.png" type="image/png" sizes="80x80">
        <!--Font Links --> 
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"> 
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css"> 
        <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'> 
        <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'> 
        <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'> 
        <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet"> 
 
        <!--Element Links--> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
        <!-- Latest compiled and minified JavaScript --> 
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script> 
        <link rel="stylesheet" href="./styles.css"> 
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> 
    </head> 
     
         
 
    <body> 
         
        <!--Navigation Bar--> 
        <section> 
            <nav class="navbar navbar-expand-lg navbar-light bg-light"> 
                <h1 class="display-5">Post<h1 style="color:#16BDE7">Hut</h1> </h1> 
 
                  <div class="collapse navbar-collapse" id="navbarNavAltMarkup"> 
                    <div class="navbar-nav"> 
                        <a class="nav-item nav-link active" href="#">Home Page</a> 
                        <a class="nav-item nav-link" href="./theme_v0.php">Daily Theme</a> 
                        <a class="nav-item nav-link" href="./popular_v0.php">Popular Posts<span class="sr-only">(current)</span></a>
 			 <a class="nav-item nav-link" href="./post.php">Post!</a>
			<a class="nav-item nav-link" href="./tpost.php">Themed Post!</a>
                    </div> 
                </div> 
		<div class="collapse navbar-collapse" id="navbarNavAltMarkup">                    
			<div class="navbar-nav">                        
				<form method="get" name="form" action="searchOutput.php">
        <input type="text" placeholder="Search" name="search">
        <input type="submit" value="Go!">
		</form>                    
			</div>                
		</div>
                <form class="form-inline"> 
                    <p><b><?php echo htmlspecialchars($_SESSION["username"]); ?></b></p> 
                </form> 
            </nav> 
        </section> 
         
        <!--JumboTron Display--> 
        <section class="jumbotron jumbotron-fluid bg-info text-white" id="Portfolio"> 
            <div class="container"> 
                <h1 class="display-4">Welcome to PostHut</h1> 
                <h5> <br> Browse Some of the newest posts on <b>PostHut</b></h5> 
            </div> 
        </section> 
         
         
       	
		<?php
			$sql = "SELECT * FROM Posts ORDER BY PostID DESC;";
			$result = mysqli_query($link, $sql);
			$resultCheck = mysqli_num_rows($result);
				while ($row = mysqli_fetch_assoc($result))
				{
					?>
					<div class='card'>
						
							<h4><b><?php echo $row['Title']?></b></h4>
							<p><b>Posted By: <?php echo mysqli_fetch_assoc(mysqli_query($link,"SELECT username FROM Users WHERE id = " . $row['Creator'] . ";"))['username']?></b></p>
							<p><?php echo $row['Content']?></p>
						<?php
							if(!is_null($row['Image'])) {
								echo '<img src="data:' . $row['Filetype'] . ';base64,'.base64_encode( $row['Image'] ).'" style="width:100%;max-height:100%;max-width:100%;overflow: hidden;" class = "center">' . "<br>";
						}?>
					<br>
				<p>
					<form action="<?php echo $_SERVER['PHP_SELF']?>" method = "POST">
						<button class = "like_btn center" id="like_btn" type = "submit" value = "<?php echo $row['PostID'] ?>" name = 'Nice' formtarget=_self>
						<span id = "count"><?php echo $row['Nices']?></span> NICE!</button>
					</form>
				</p> 
				</div> 
				<br> 
				<?php
			}
		?>
		<br>

    <!--Footer--> 
    <br>
    <div class="footer"> 
 	 <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
    </div> 
	 
         
               <script src="script.js"></script> 
         
         
    </body>
</html>