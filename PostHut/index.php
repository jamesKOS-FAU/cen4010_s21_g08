<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
    <head>
        <title>PostHut Login</title>
        
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
        <link rel="stylesheet" href="styles.css">
        <script src="weather.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body>
        

    <body>
        <section>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <h1 class="display-5">Post<h1 style="color:#16BDE7">Hut</h1> </h1>
                
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                </div>
            </nav>

        </section>

        <!--JumboTron Display-->
        <section class="jumbotron jumbotron-fluid bg-info text-white" id="Portfolio">
            <div class="container">
                <h1 class="display-4">Welcome to PostHut</h1>
                <h5> <br> Please Login to Continue to <b>PostHut</b></h5>
            </div>
        </section>
        
        <h2>Login Form</h2>

<form action="/action_page.php" method="post">
  <div class="container">
    <label for="username" style="color:#16BDE7"><b>Username</b></label>
    <input type="text" placeholder="Please Enter Username" name="username" required>
    <br>
      <label for="password" style="color:#16BDE7"><b>Password </b></label>
    <input type="password" placeholder="Please Enter Password" name="password" required>
        
    <button type="submit">Login</button>
  </div>

  <div class="container" style="background-color:#f1f1f1">
    <span class="password" label = "Forgot">Forgot <a href="#" style="color:#16BDE7">password?</a></span>
      <span class = "register" label = "Register"><br>Don't Have an account? Register<a href = "./register.html"style="color:#16BDE7"> Here</a></span>
    </div>
</form>
        
        </body>
    </body>
</html>