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
  <title>ReVO-App: My Files</title>
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
    
    <style>
        .checkbox:hover {
    cursor: pointer !important;
}
.checkbox-success:hover{
    cursor: pointer !important;
}

.checkbox.checkbox-success:hover{
    cursor: pointer !important;
} 
    </style>
    
    
    
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
          <li class="active"><a href="#"><span class="glyphicon glyphicon-folder-open"></span> &nbsp;My Files</a></li>
        <li><a href="sequencer.php"><span class="glyphicon glyphicon-sort"> </span> Sequencer</a></li> 
        <li><a href="player.php"><span class="glyphicon glyphicon-play"></span> Player</a></li> 
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="../FileHandler/logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
  
<div class="container" style="background-color:rgba(250,240,217,0.8); border-radius: 15px;">
    <div class='row'>
        
         <h1 style="text-align: center;">Upload Files<span data-toggle="tooltip" data-placement="right" title="This is where you come to manage all your resources. Here you can upload raw resources, download multiple resources (including ones you have packaged already), package both raw and orchestrated resources and also you can share your packaged resources on to ReVO by selecting a package and clicking share."> <small><span class="glyphicon glyphicon-info-sign"></span></small></span></h1>
    
    </div>
    
  <div class="row input">
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
          <button class='btn btn-primary' type='submit' name='submit'>
            <i class='glyphicon glyphicon-upload'></i> Upload
            </button>
      </div>
            <div class="col-sm-3">
      </div>
      </form>
 
      
    </div>
      
      <div class="row">
      
       
            <?php
            makeFileList($_SESSION['name'], "Sequence");
            ?>
    
        </div>
    </div>
    <div class="container input" style="background-color:rgba(250,240,217,0.8); border-radius: 15px;"  >
    <div class="row">
        <div class="col-sm-3">
      </div>

            <?php
            makePackageFileList($_SESSION['name']);
            ?>
        <div class="col-sm-3">
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
