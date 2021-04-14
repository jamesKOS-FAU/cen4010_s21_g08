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
         
         
        <!--Posts--> 
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
         <div class="card"> 
            <div class="content"> 
                <h4><b>I Found This Leaf, Does Anyone Know What it is?</b></h4> 
                <h7><b>Posted By: TacoCat123</b></h7> 
                <p>Hey guys, found this leaf, and I snapped a picture because it seems really cool, but I don't know what it is, if you could tell me, that would be appreciated.</p> 
             </div> 
            <img src="./DSC_0161.JPG" alt="Nature Picture" style="width:100%" height="auto" class = "center"> 
             
             <br> 
             <p><button class = "like_btn2"> 
                 <span id = "icon"><i class ="far fa-thumbs-up"></i></span> 
                 <span id = "count2">43</span> NICE! 
                </button> 
             </p> 
          <div class="container"> 
          </div> 
        </div> 
         
        <div class="card"> 
            <div class="content"> 
                <h4><b>I took a nature picture</b></h4> 
                <h7><b>Posted By: TacoCat123</b></h7> 
                <p>Hey guys, found this leaf, and I snapped a picture because it seems really cool, but I don't know what it is, if you could tell me, that would be appreciated.</p> 
             </div> 
            <img src="./DSC_0162.JPG" alt="Nature Picture" style="width:100%" height="auto" class = "center"> 
             
             <br> 
             <p><button class = "like_btn3"> 
                 <span id = "icon"><i class ="far fa-thumbs-up"></i></span> 
                 <span id = "count3">29</span> NICE! 
                </button> 
            </p> 
          <div class="container"> 
          </div> 
        </div> 

	 <div class="card"> 
            <div class="content"
	<?php
		$sql = "SELECT * FROM Posts ORDER BY PostID;";
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
	 
    <?php    	
	$query = mysqli_query($link, "SELECT * FROM Posts");
	$result = array();
	$count = 0;
	while($row = mysqli_fetch_array($query)) {
		array_push($result, array($row['Creator'],$row['Timestamp'],$row['Content']));
		$count++;
	}
     ?>            
       
    <script>    
    var s; //pattern
    var t; //text
    const SIZE = 256
    let bmBcShift = new Array(SIZE); // Bad Char preprocessing table
    var bmGsShift;    //Good Suffix preprocessing table
       
    function getSearchText () {
        s = document.getElementById("search").value;
        var i;
        for (i = 0; i < s.length; i++) {
            window.alert(s.charCodeAt(i));
        }
        window.alert(s);
    }    
   
    function preBadChar (pattern, pSize, bcArr) {
        var i;
        for (i = 0; i < SIZE; i++) {
            bcArr[i] = -1;
        }
        for (i = 0; i < pSize; i++) {
            bcArr[pattern.charCodeAt(i)] = i;
        }
    }    
   
    function suffixStrong (shift, bpos, pattern, size) {
        let i = size;
        let j = size + 1;
        bpos[i] = j;
        while (i > 0) {
            while (j <= size && pattern[i-1] != pattern[j-1]) {
                if (shift[j] == 0) {
                    shift[j] = j-i;
                }
                j = bpos[j];
            }
            i--;
            j--;
            bpos[i] = j;
        }
    }
       
    function altSuffix (shift, bpos, pattern, size) {
        var i;
        var j;
        j = bpos[0];
        for (i = 0; i <= size; i++) {
            if (shift[i] == 0) {
                shift[i] = j;
            }
            if (i == j) {
                j = bpos[j];
            }
        }
    }
       
    function preGoodSuffix(shift, pattern, size) {
        var i;
        let bpos = new Array(size +1);
       
        for (i = 0; i < size + 1; i++) {
            shift[i] = 0;
        }
       
        suffixStrong(shift, bpos, pattern, size);
        altSuffix(shift, bpos, pattern, size);
    }
       
    function bmSearch () {        
        //variable declaration
        //search pattern
        let pattern = document.getElementById("search").value;
        //array of database Post entries with Creator, Timestamp, Content
         
	let aCount = <?php echo json_encode($count); ?>;     
	window.alert(aCount);
       
        //loop through Post array to search the content of each post
        //for the search pattern and record the number of times it is
        //found within each post's content
        let index = 0;
        while (index < aCount) {
	    let output = <?php echo json_encode($result); ?>;  
            let outputRow = output[index];
	    let text = output[2];
            let a = pattern.length;
            let b = text.length;
       	    window.alert(text);
            bmGsShift = new Array(a+1);        
       
            let c = 0;
            var d;
            let occur = 0;
       
            //preprocessing
            preBadChar(pattern, a, bmBcShift);
            preGoodSuffix(bmGsShift, pattern, a);
       
            //search
            while (c <= (b-a)) {
                d = a - 1;
                while (d >= 0 && pattern[d] == text[c+d]) {
                    d--;
                }          
                if (d < 0) {
                    occur++;
                    c += bmGsShift[0];
                }
                else {
                    c += Math.max(bmGsShift[d+1],d - bmBcShift[text.charCodeAt(c+d)]);
           
                }
            }
            let result = "Found search text " + occur + " times";
            window.alert(result);
            //output[index].push(occur);
            //window.alert(output);
            index++;
        }
     }
     </script>
         
    <!--Footer--> 
    <br>
    <div class="footer"> 
 	 <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
    </div> 
         
               <script src="script.js"></script> 
         
         
        </body> 
     
                    
