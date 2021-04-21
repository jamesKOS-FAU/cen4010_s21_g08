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
<meta name="viewport" content="width=device-width, initial-scale=1"> 
    <head> 
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
				<form onclick="bmSearch()">                           
					<label for="search">Search</label>                            
					<input type="text" id="search" name="search">                            
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
		
		
            <div class="card"> 
            <div class="content"> 
                <h4><b>Picture I took During A Walk</b></h4> 
                <h7><b>Posted By: CodedMelancholy</b></h7> 
                <p>Hey guys, I took this picture while I was going on a walk, I really liked the trees, please give this a nice if you liked it.</p> 
            </div> 
            <img src="./DSC_0153.JPG" alt="Nature Picture" style="width:100%" height="auto" class = "center"> 
            <br> 
            <p><button class = "like_btn"> 
                 <span id = "icon"><i class ="far fa-thumbs-up"></i></span> 
                 <span id = "count">127</span> NICE! 
                </button> 
            </p> 
        </div> 
        <br> 
         
	 <
	<?php
		$sql = "SELECT * FROM Posts ORDER BY PostID DESC;";
		$result = mysqli_query($link, $sql);
		$resultCheck = mysqli_num_rows($result);
		$id = []; //PostID saves here
		$i=0;
			while ($row = mysqli_fetch_assoc($result)) 
			{ ?>
				<div class='card'>
				<div class='content'> <?php
				//$id[$i] = $row['PostID']; ?>
				
				<h4><b><?php echo $row['Title']?></b></h4>
				<p><?php echo $row['Content']?></p>
				</div>
				<?php
				if(!is_null($row['Image'])) {
					echo '<img src="data:' . $row['Filetype'] . ';base64,'.base64_encode( $row['Image'] ).'" style="width:100%" height="auto" class = "center"/>' . "<br>";
				}?>
				<br>
				
				</p> 
				</div> 
				<br> 
				<p>
										
				<p><button>
				<form name="<?php echo $row['PostID']?>" action="nice.php" method = "post" class="like_btn">
				<span id = "icon"><i class ="far fa-thumbs-up"></i></span>
                <span id = "count"><?php echo $row['Nices']?></span> NICE!
				</form>  		
                </button> 
				</p> 
				</p>
				</div>
				</div>
				<?php
				//echo $row['PostID'];
				//echo "<br>";
				//echo $id[$i];
				//$i++; //i has number of posts
				
			}
			
		/*for ($x = 0; $x < $i; $x++)
		{
			if(isset($_POST['like_btn'.$id[$x]]))	//checks if  button has been pressed
			{
				//include("config.php");
				echo "BUTTON PRESSED AT ID: ". $id[$x];
				$a = $id[$x];	
				$sql = "UPADTE 'Posts' SET 'Nices'='Nices+1' WHERE PostID='$a'";
				if (mysqli_query($link, $sql)) 
					echo "Record updated successfully"; 
				else
					echo "error";
			}*/
		//}
		
	?>></div></div>
	 
 <?php    
	/*	include("config.php");
		$query = mysqli_query($link, "SELECT * FROM Posts"); 
		$resultPID = array();	
        $resultContent = array();
        $count = mysqli_num_rows($query);
		while($row = mysqli_fetch_array($query)) {
			array_push($resultPID, $row['PostID']);
            array_push($resultContent,$row['Content']);
		}	*/	
	?>            

         
    <!--Footer--> 
    <br>
    <div class="footer"> 
 	 <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
    </div> 
         
               <script src="script.js"></script> 
         
         
        </body> 
     
                    
