<?php // Initialize the session 
	require_once "config.php";
	session_start(); // Check if the user is logged in, if not then redirect him to login page 
	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
	{ 
		header("location: index.php"); exit; 
	} 
?> 

<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">


    <title>Popular Posts</title>

    <!--Element Link-->
    <link rel="stylesheet" href="styles.css"> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> 
    <body>
        <section>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <h1 class="display-5">Post<h1 style="color:#16BDE7">Hut</h1> </h1>

                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
			<a class="nav-item nav-link" href="./home.php">Home Page</a>
                        <a class="nav-item nav-link" href="./theme_v0.php">Daily Theme</a>
                        <a class="nav-item nav-link active" href="./popular_v0.php">Popular Posts<span class="sr-only">(current)</span></a>
			<a class="nav-item nav-link" href="./post.php">Post!</a>
			<a class="nav-item nav-link" href="./tpost.php">Themed Post!</a>
                    </div>
                </div>
                <form class="form-inline">
                    <p> <a href="accountpage.html">My Account</a></p>
                    <p> <a href="./post.php"><br>Post!</a> </p>
                    <img src="img.jpg" , width="80" height="80">

                </form>
		<form class="form-inline"> 
                    <p><b><?php echo htmlspecialchars($_SESSION["username"]); ?></b></p> 
                </form> 

            </nav>

        </section>

        <!--JumboTron Display-->
        <section class="jumbotron jumbotron-fluid bg-info text-white" id="Portfolio">
            <div class="container">
                <h1 class="display-4">Popular Posts<br> </h1>
                <h5> <br> Here are the most <b>popular</b> posts on PostHut:</h5>
                <h6>Posts are popular by the most amount of <u>Nice!</u></h6>
            </div>
        </section>

	<div class="card"> 
            <div class="content"> 
                <h4><b>Check out my cat!</b></h4> 
                <h7><b>Posted By: Sarah108</b></h7> 
                <p>Check out this beautiful picture of the sunset I took in Key West!</p> 
            </div> 
            <img src="./sunset.jpg" alt="black cat" style="width:100%" height="auto" class = "center"> 
            <br> 
            <p><button class = "like_btn"> 
                 <span id = "icon"><i class ="far fa-thumbs-up"></i></span> 
                 <span id = "count">272</span> NICE! 
                </button> 
            </p> 
        </div>
<br>
	<div class="card"> 
            <div class="content"
	<?php
		$sql = "SELECT * FROM Posts ORDER BY Nices;";
		$result = mysqli_query($link, $sql);
		$resultCheck = mysqli_num_rows($result);
			while ($row = mysqli_fetch_assoc($result)) 
			{
				echo "<div class = 'card'>";
				echo "<strong>";
					echo $row['Title'];
				echo "</strong>"; 
				echo '"<br>"';
				echo $row['Content'];
				if(!is_null($row['Image'])) {
					echo '<img src="data:' . $row['Filetype'] . ';base64,'.base64_encode( $row['Image'] ).'" style="width:100%" height="auto" class = "center"/>' . "<br>";
				echo "</div>";
				echo "<br>";
				echo "<p>";
				echo "<button class = 'like_btn'>";
				echo "<span id = 'count3'>0</span> NICE!";
				echo "</button>";
				echo "</p>";
				echo "</div>";
				echo "</div>";
				echo "<br>";
				}
			}
		
	?>

	  <!--Footer--> 
    <div class="footer"> 
 	 <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
    </div> 
         
               <script src="script.js"></script>
</body>
</html>