<?php
require '../FileHandler/listFiles.php'
?>

<!DOCTYPE html>
<html>
<title>RVOA Home</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
<link rel="stylesheet" href="css/main.css">
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif}
.w3-navbar,h1,button {font-family: "Montserrat", sans-serif}
.fa-anchor,.fa-coffee {font-size:200px}
</style>
<body>

<!-- Navbar -->
<ul class="w3-navbar w3-blue w3-card-2 w3-top w3-right-align w3-large">
<!--
  <li class="w3-hide-medium w3-hide-large w3-opennav w3-right">
    <a class="w3-padding-large w3-hover-white w3-large w3-red" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu">Logout</a>
  </li>
-->
  <li><a href="main.php" class="w3-padding-large w3-hover-white w3-left-align">Home</a></li>
  <li class="w3-hide-small"><a href="personal.php" class="w3-padding-large w3-hover-white w3-left-align">Personal</a></li>
  <li class="w3-hide-small"><a href="player.php" class="w3-padding-large w3-hover-white w3-left-align">Player</a></li>
  <li class="w3-hide-small"><a href="#" class="w3-padding-large w3-white">Packager</a></li>
  <li class="w3-hide-small w3-right-align"><a href="#" class="w3-padding-large w3-hover-white w3-right-align">Link 4</a></li>
</ul>

<!-- Navbar on small screens -->
<div id="navDemo" class="w3-hide w3-hide-large w3-hide-medium w3-top" style="margin-top:51px">
  <ul class="w3-navbar w3-left-align w3-large w3-black">
    <li><a class="w3-padding-large" href="#">Link 1</a></li>
    <li><a class="w3-padding-large" href="#">Link 2</a></li>
    <li><a class="w3-padding-large" href="#">Link 3</a></li>
    <li><a class="w3-padding-large" href="#">Link 4</a></li>
  </ul>
    
</div>

<!-- Header -->
<div class="w3-container w3-red w3-center w3-padding-128">
  <h1 class="w3-margin w3-jumbo">RVOA!!</h1>
    <h2 class="w3-margin w3-jumbo"><?php
        echo "Welcome ".$_SESSION["name"]."!";
        ?></h2>
    <h3 class="w3-margin w3-jumbo">This is the packager!!</h3>

</div>

    <div>
        <h3>
            <?php
            makeFileList($_SESSION['name'], "Package");
            ?>
        </h3>
    
    </div>


<div class="w3-container w3-black w3-center w3-opacity w3-padding-64">
    <h1 class="w3-margin w3-xlarge">Quote of the day: live life</h1>
</div>

<!-- Footer -->
<footer class="w3-container w3-padding-64 w3-center w3-opacity">
  <div class="w3-xlarge w3-padding-32">
   <a href="#" class="w3-hover-text-indigo"><i class="fa fa-facebook-official"></i></a>
   <a href="#" class="w3-hover-text-red"><i class="fa fa-pinterest-p"></i></a>
   <a href="#" class="w3-hover-text-light-blue"><i class="fa fa-twitter"></i></a>
   <a href="#" class="w3-hover-text-grey"><i class="fa fa-flickr"></i></a>
   <a href="#" class="w3-hover-text-indigo"><i class="fa fa-linkedin"></i></a>
 </div>
 <p>Powered by <a href="http://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
</footer>

<script>
// Used to toggle the menu on small screens when clicking on the menu button
function myFunction() {
    var x = document.getElementById("navDemo");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else {
        x.className = x.className.replace(" w3-show", "");
    }
}
</script>

</body>
</html>
