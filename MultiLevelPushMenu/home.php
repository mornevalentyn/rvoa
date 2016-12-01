<?php
    session_start();
    if(!isset($_SESSION["name"])){
    header("Location: index.php");
        die();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>ReVO-App: Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400" rel="stylesheet">
  <link rel="stylesheet" href="css/update.css">
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
    <link rel="apple-touch-icon-precomposed" href="img/stack-of-paperbacks-152-38869.png">
   
  <style>
      
/*      incase you are wondering why this code has been repeated in the update.css file. It is because Google chrome wasnt reading the necessary parts of the code and was not rendering as it should have. but this woks better now*/
      
      
    .homeP {
    font-family: 'Open Sans', sans-serif;
        padding-top: 5%;
        padding-left: 5%;
        line-height: 150%;
       text-align: justify;
} 
      img.crop {
          margin-left: -70px;
          margin-top: 20px;
      }
            img.crop2 {
          margin-left: 30px;
          margin-top: 20px;
      }
      
      .hovereffect {
  width: 100%;
  height: 100%;
  float: left;
  overflow: hidden;
  position: relative;
  text-align: center;
  cursor: pointer;
}

.hovereffect .overlay {
  position: absolute;
  overflow: hidden;
  opacity: 0;
  filter: alpha(opacity=0);
  width: 55%;
  height: 81%;
  left: 22%;
  top: 10%;
  border-radius: 80%;
  border: 2px solid #FFF;
  -webkit-transition: opacity 0.35s, -webkit-transform 0.35s;
  transition: opacity 0.35s, transform 0.35s;
  -webkit-transform: translate3d(50%,50%,0);
  transform: translate3d(50%,50%,0);
}

.hovereffect:hover .overlay {
  background-color: rgba(0,0,0,0.3);
}

.hovereffect img {
  display: block;
  position: relative;
  -webkit-transition: all 0.35s;
  transition: all 0.35s;
}

.hovereffect:hover img {
  filter: url('data:image/svg+xml;charset=utf-8,<svg xmlns="http://www.w3.org/2000/svg"><filter id="filter"><feComponentTransfer color-interpolation-filters="sRGB"><feFuncR type="linear" slope="1.4" /><feFuncG type="linear" slope="1.4" /><feFuncB type="linear" slope="1.4" /></feComponentTransfer></filter></svg>#filter');
  filter: brightness(1.4);
  -webkit-filter: brightness(1.4);
}
 
.hovereffect h2 {
  text-transform: uppercase;             
  text-align: center;
  position: relative;
  font-size: 17px;
  padding: 10px;
  background-color: transparent;
  color: #FFF;
  padding: 1em 0;
  opacity: 0;
  filter: alpha(opacity=0);
  -webkit-transition: opacity 0.35s, -webkit-transform 0.35s;
  transition: opacity 0.35s, transform 0.35s;
  -webkit-transform: translate3d(-150%,-400%,0);
  transform: translate3d(-150%,-400%,0);
}

.hovereffect a, .hovereffect p {
  color: #FFF;
  padding: 1em 0;
  opacity: 0;
  filter: alpha(opacity=0);
  -webkit-transition: opacity 0.35s, -webkit-transform 0.35s;
  transition: opacity 0.35s, transform 0.35s;
  -webkit-transform: translate3d(-150%,-400%,0);
  transform: translate3d(-150%,-400%,0);
}

.hovereffect:hover a, .hovereffect:hover p, .hovereffect:hover h2, .hovereffect:hover .overlay {
  opacity: 1;
  filter: alpha(opacity=100);
  -webkit-transform: translate3d(0,0,0);
  transform: translate3d(0,0,0);
}

    </style>
</head>
<body>
<div class="jumbotron text-center headerBack">
  <h1 class="title">ReVO-App</h1>
  <p class="title">Work Together, Share Together</p>
    <h2 class="title">Welcome <?php echo $_SESSION['name']?> </h2>
</div> 
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand active" href="#"><span class="glyphicon glyphicon-leaf"></span> Home</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="myFiles.php"><span class="glyphicon glyphicon-folder-open"></span> &nbsp;My Files</a></li>
        <li><a href="sequencer.php"><span class="glyphicon glyphicon-sort"> </span> Sequencer</a></li> 
        <li><a href="player.php"><span class="glyphicon glyphicon-play"></span> Player</a></li> 
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="../FileHandler/logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
  
<div class="container" style="background-color:rgba(250,240,217,0.8) ; padding: 10px;  border-radius: 15px; opacity: 1;">
  <div class="row">
    <div class="col-sm-7">
        <p class='homeP'><font size="4">With <b>SlideDog</b> you can combine PowerPoint presentations, PDF files, Prezi Presentations, movie clips, web pages and more into one innovative, seamless multimedia presentation. SlideDog allows you to create playlists of all your variuos presentation materials to make your demonstrations and lessons that much easier. No need to manually switch between applications and waste time searching between the 5 different tabs to try and find that YouTube video you want to show the class and then have to return to your PowerPoint Presentation. SlideDog orchestrates it all for you as effortlessly as dragging and dropping.</font> </p>
        
        <p class="homeP" style="padding-bottom: 3%;"><font size="4"><b>Reminder:</b> When Packaging your SlideDog presentation on ReVO-App you need to upload all the files you have included in your presentation, along with your SlideDog lesson and Package it into one folder for storage so that SlideDog still has the resources to reference the Slideshow from!</font> </p>
    </div>
    <div class="col-sm-5" style="overflow:hidden"> 
        <a href="http://slidedog.com/features/"><span>
        <div class="hovereffect">
       <img src="img/dog.png" alt="SlideDog" class='crop'>
             <div class="overlay">
                 <h2>TAKE ME THERE!</h2> 
               
            </div>
            
      </div>
            </span></a>
  </div>
</div>
</div>
    
<div class="container input" style="background-color: rgba(250,240,217,0.8); padding: 10px;  border-radius: 15px;">
  <div class="row">
    <div class="col-sm-5" style="overflow:hidden">
        <a href="https://support.office.com/en-us/article/Save-your-presentation-as-a-video-fafb9713-14cd-4013-bcc7-0879e6b7e6ce"><span>
          <div class="hovereffect">
        <img src="img/Power.png" alt="PowerPoint" class="crop2"> <div class="overlay">
                 <h2>TAKE ME THERE!</h2> </div>
        </div>
            </span></a>
    </div>
    <div class="col-sm-7">
        <p class='homeP' style="padding-right: 5%; padding-bottom: 3%;"><font size="4"><b>PowerPoint</b> has the ability to be saved in <b>video</b> fomat (mp4). With ReVO-App you can combine multiple of these complete mp4 presentations (or even snippits of various presentations) into one seemless video presentation. Be sure to try it out in the Sequencer. You can then have the option of packaging your seemless video presentation with or without the PowerPoint presentation used to record it. It’s all up to you. </font>  </p>
      
    </div>
  </div>
</div>

</body>
</html>
