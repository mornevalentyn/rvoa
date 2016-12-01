<?php
   require '../FileHandler/listFiles.php';
if(!isset($_SESSION["name"])){
    header("Location: index.php");
        die();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>ReVO-App: Player</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
      
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/build.css">
    <link rel="stylesheet" href="css/update.css">
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
    <link rel="apple-touch-icon-precomposed" href="img/stack-of-paperbacks-152-38869.png">
    

</head>
<body>
<div class="jumbotron text-center headerBack">
  <h1 class="title">ReVO-App</h1>
  <p class="title">Work Together, Share Together</p>
</div> 
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand" href="home.php"><span class="glyphicon glyphicon-leaf"></span> Home</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="myFiles.php"><span class="glyphicon glyphicon-folder-open"></span> &nbsp;My Files</a></li>
        <li><a href="sequencer.php"><span class="glyphicon glyphicon-sort"></span> Sequencer</a></li> 
        <li class="active"><a href="#"><span class="glyphicon glyphicon-play"></span> Player</a></li> 
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="../FileHandler/logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
  
<div class="container" style="background-color:rgba(250,240,217,0.8); padding: 10px;  border-radius: 15px;">
    <div class="row">
    <h1 style="text-align: center;">MP3 Listening Device<span data-toggle="tooltip" data-placement="right" title="Select a resource you would like to play, then click the select button below the table. Now click play on player situated next to the table. Enjoy!"> <small><span class="glyphicon glyphicon-info-sign"></span></small></span></h1>
    </div>
    <div class="row">
    <div class="col-sm-6">
        
        
         <?php
            makeFileList($_SESSION['name'], "AudioP");
        ?>
    
      </div>
  </div>
</div>
    
<div class="container input" style="background-color:rgba(250,240,217,0.8); padding: 10px; border-radius: 15px;">
    <h1 style="text-align: center;">MP4 Previewing Device</h1>
    <div class="row">
    <div class="col-sm-6">
        
         <?php
            makeFileList($_SESSION['name'], "VideoP");
        ?>
        <a name="bottom"></a>
      </div>
  </div>
</div>

    <script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
</script>
    
</body>
</html>
