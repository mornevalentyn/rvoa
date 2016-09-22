<?php
    require 'dbHandler.php';
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>Metadata Grabber</title>
		<link rel="shortcut icon" href="../favicon.ico">
		<link rel="stylesheet" type="text/css" href="css/default.css" />
		<link rel="stylesheet" type="text/css" href="css/component.css" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
		<script src="js/modernizr.custom.js"></script>
	</head>
	<body>
		<div class="container">
			<header class="clearfix">
				<span>RVOA <span class="bp-icon bp-icon-about" data-content="The Blueprints are a collection of basic and minimal website concepts, components, plugins and layouts with minimal style for easy adaption and usage, or simply for inspiration."></span></span>
				<h1>Metadata Capturing Form</h1>
			</header>	
			<div class="main">
				<form class="cbp-mc-form" action="metacapture.php"  method="post">
					<div class="cbp-mc-column">
	  					<label for="language">Language</label>
	  					<select id="country" name="language">
	  						<option>Language of Resource</option>
                                 <option>Afrikaans</option>
	  						   <option>Dutch</option>
	  						   <option>English</option>
                                 <option>French</option>
                                 <option>German</option>
                                 <option>Italian</option>
	  						   <option>Portuguese</option>
                                 <option>Spanish</option>
	  					</select>
	  					<label for="description">Description</label>
	  					<textarea id="description" name="description" placeholder="Please add a short description of the resource..."></textarea>
	  				</div>
	  				<div class="cbp-mc-column">
                        <label for="title">Title</label>
	  					<input type="text" id="title" name="title" placeholder="Awesome name goes here...">
	  					<label>Type</label>
	  					<select id="type" name="type">
	  						<option>Type of Resource</option>
	  						<option>Collection</option>
	  						<option>Sequenced Resource</option>
	  						<option>Interactive Resource</option>
                            <option>Sound</option>
                            <option>Moving Image</option>
                            <option>Still Image</option>
                            <option>Video</option>
                            <option>Text</option>
	  					</select>
	  					<label for="coverage">Educational Curriculum Followed</label>
	  					<input type="text" id="coverage" name="coverage" placeholder="CAPS...">
                        <label for="relations">Related Topics</label>
	  					<input type="text" id="relations" name="relations" placeholder="Similar or related work...">
	  					
	  				</div>
	  				<div class="cbp-mc-column">
	  					<label>Subject</label>
	  					<select id="subject" name="subject">
	  						<option>Choose a Subject</option>
	  						<option>Mathematics</option>
	  						<option>English</option>
	  						<option>Afrikaans</option>
                            <option>French</option>
                            <option>German</option>
                            <option>Accounting</option>
                            <option>Physical Sciences</option>
                            <option>Life Sciences</option>
                            <option>Chemistry</option>
                            <option>History</option>
                            <option>Geography</option>
                            <option>Life Orientation</option>
                            <option>Engineering Graphics & Design</option>
	  					</select>
						
	  					<label for="comments">Comments</label>
	  					<textarea id="comments" name="comments" placeholder="Feel free to add a short comment here..."></textarea>	
	  				</div>
	  				<div class="cbp-mc-submit-wrap"><input class="cbp-mc-submit" type="submit" name='submit' value="Send your data" /></div>
				</form>
			</div>
		</div>
                    <?php
   $_SESSION['filename'] = $_POST['filename'];

                    
?>
	</body>
</html>
