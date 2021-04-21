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
                        <a class="nav-item nav-link active" href="./home.php">Home Page</a> 
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
                <h5> <br> Search Results from <b>PostHut</b></h5> 
            </div> 
        </section> 

<?php
//Search algorithm code
    $query = mysqli_query($link, "SELECT * FROM Posts"); 
    $resultPosts = array();
	$resultPID = array();	
    $resultContent = array();
    $count = mysqli_num_rows($query);
	while($row = mysqli_fetch_array($query)) {
		array_push($resultPosts, $row);
		array_push($resultPID, $row['PostID']);
        	array_push($resultContent,$row['Content']);
	}
    $result = $_GET['search'];
	
    //Boyer-Moore Search Algorithm 
    $bmBcShift = array();

    function preBadChar($pattern, $pSize, &$bcArr) {
        for ($i = 0; $i < 256; $i++) {
            array_push($bcArr, -1);
        }
        for ($i = 0; $i < $pSize; $i++) {
            $bcArr[ord($pattern[$i])] = $i;
        }
    }
   
    function suffixStrong(&$shift, &$bpos, $pattern, $size) {
        $i = $size;
        $j = $size + 1;
        $bpos[$i] = $j;
        while ($i > 0) {
            while ($j <= $size && $pattern[$i-1] != $pattern[$j-1]) {
                if ($shift[$i] == 0) {
                    $shift[$j] = $j-$i;
                }
                $j = $bpos[$j];
            }
            $i--;
            $j--;
            $bpos[$i] = $j;
        }        
    }

    function altSuffix(&$shift, &$bpos, $pattern, $size) {
        $j = $bpos[0];
        for ($i = 0; $i <= $size; $i++) {
            if ($shift[$i] == 0) {
                $shift[$i] = $j;
            }
            if ($i == $j) {
                $j = $bpos[$j];
            }
        }
    }

    function preGoodSuffix(&$shift, $pattern, $size) {
        $bpos = array();
        $bpos = array_fill(0, $size + 1, '');
        for ($i = 0; $i < $size + 1; $i++) {
            $shift[$i] = 0;
        }
        suffixStrong($shift, $bpos, $pattern, $size);
        altSuffix($shift, $bpos, $pattern, $size);
    }

    
    function bmSearch($pattern, &$posts, $postID, $postContent) {
        $aOccur = array();
        $aOccur = array_fill(0, count($posts), 0);
        $index = 0;
        $max = count($posts);
        
        while ($index < $max) {
            $content = $posts[$index]['Title'] . " " . $postContent[$index];
            $pid = $postID[$index];
            $a = strlen($pattern);
            $b = strlen($content);
            
            $bmBcShift = array();
            $bmGsShift = array();
            $bmGsShift = array_fill(0, strlen($pattern) + 1, '');
            $c = 0;
            $occur = 0;
            
            preBadChar($pattern, $a, $bmBcShift);
            preGoodSuffix($bmGsShift, $pattern, $a);
            
            while ($c <= ($b-$a)) {
                $d = $a - 1;
                while ($d >= 0 && $pattern[$d] == $content[$c+$d]) {
                    $d--;
                }
                if ($d < 0) {
                    $occur++;
                    $c += $bmGsShift[0];
                }
                else {
                    $c += max($bmGsShift[$d+1], $d - $bmBcShift[ord($content[$c+$d])]);
                }
            }
            array_push($posts[$index],$occur);
            $index++;
        }
    }

    bmSearch($result, $resultPosts, $resultPID, $resultContent);
    
    function cmp($a, $b) {
        if ($a[8] == $b[8]) {
            return 0;
        }
        return ($a[8] < $b[8]) ? 1 : -1;
    }

    usort($resultPosts, "cmp");
?>

	<?php
		
        foreach ($resultPosts as $row) 
			{
			if ($row[8] != 0) 
			{	?>
				<div class = 'card'>
				<div class = 'content'>
					<h4><b><?php echo $row['Title']?></b></h4>
					<p><?php echo $row['Content']?></p>
				</div>
				<?php
				if(!is_null($row['Image'])) {
					echo '<img src="data:' . $row['Filetype'] . ';base64,'.base64_encode( $row['Image'] ).'" style="width:100%" height="auto" class = "center"/>' . "<br>";
				}?>
				<br>
				<p><button class = "like_btn">
				<span id = "count"><?php echo $row['Nices']?></span> NICE!
				</button>
				</p>
				</div>
				<br>
				<?php
			}
		}
?>
			
  </body> 