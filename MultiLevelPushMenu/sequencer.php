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
  <title>do-OER: Sequencer</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/update.css">
     <script>
      
            $(function() {

              $(document).on('change', ':file', function() {
                var input = $(this),
                    numFiles = input.get(0).files ? input.get(0).files.length : 1,
                    label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
                input.trigger('fileselect', [numFiles, label]);
              });

              // We can watch for our custom `fileselect` event like this
              $(document).ready( function() {
                  $(':file').on('fileselect', function(event, numFiles, label) {

                      var input = $(this).parents('.input-group').find(':text'),
                          log = numFiles > 1 ? numFiles + ' files selected' : label;

                      if( input.length ) {
                          input.val(log);
                      } else {
                          if( log ) alert(log);
                      }

                  });
              });

            });</script>
    
    <script>$(function(){
    $("input[type='submit']").click(function(){
        var $fileUpload = $("input[type='file']");
        if (parseInt($fileUpload.get(0).files.length)>1){
         alert("OOPS!! Only one file at a time.");
            return false;
        }
    });    
});</script>
</head>
<body>
<div class="jumbotron text-center headerBack">
  <h1 class="title">Pack Master</h1>
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
        <li class="active"><a href="#"><span class="glyphicon glyphicon-sort"> </span> Sequencer</a></li> 
        <li><a href="player.php"><span class="glyphicon glyphicon-play"></span> Player</a></li> 
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="../FileHandler/logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
  
<div class="container">
  <div class="row" style="background-color: white;  border-radius: 15px;">
      <div class="col-sm-12">
    <h1 style="text-align:center;"> MP3 Sequencer </h1>
    <form method="POST" action="../FileHandler/upload.php" enctype="multipart/form-data">
      <div class="col-sm-3">
      </div>
      <div class="col-sm-5">
            <div class="input-group">
                <label class="input-group-btn">
                    <span class="btn btn-primary">
                        Browse&hellip; <input type="file" name="FileUpload" id="FileUpload" style="display: none;">
                    </span>
                </label>
                <input type="text" class="form-control" readonly>
            </div>
            <span class="help-block">
                Please select a resource to be uploaded. (one at a time)
            </span>
        </div>
      <div class="col-sm-1">
          <button class='btn btn-primary' type='submit' name='audio'>
            <i class='glyphicon glyphicon-upload'></i> Upload
            </button>
      </div>
            <div class="col-sm-3">
      </div>
      </form>
      </div>
      <div class="col-sm-12 input">
   
   
            <?php
            makeFileList($_SESSION['name'], "Audio");
            ?>
    

    
     </div>
      </div>

</div>
    
    <div class="container input">
  <div class="row" style="background-color: white;  border-radius: 15px;">
      <div class="col-sm-12">
    <h1 style="text-align:center;"> MP4 Sequencer </h1>
    <form method="POST" action="../FileHandler/upload.php" enctype="multipart/form-data">
      <div class="col-sm-3">
      </div>
      <div class="col-sm-5">
            <div class="input-group">
                <label class="input-group-btn">
                    <span class="btn btn-primary">
                        Browse&hellip; <input type="file" name="FileUpload" id="FileUpload" style="display: none;">
                    </span>
                </label>
                <input type="text" class="form-control" readonly>
            </div>
            <span class="help-block">
                Please select a resource to be uploaded. (one at a time)
            </span>
        </div>
      <div class="col-sm-1">
          <button class='btn btn-primary' type='submit' name='video'>
            <i class='glyphicon glyphicon-upload'></i> Upload
            </button>
      </div>
            <div class="col-sm-3">
      </div>
      </form>
      </div>
      <div class="col-sm-12 input">
   
   
            <?php
            makeFileList($_SESSION['name'], "Video");
            ?>
    

    
     </div>
      </div>

</div>

    
    

</body>
</html>
