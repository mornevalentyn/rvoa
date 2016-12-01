<?php
    require 'dbHandler.php';
    require 'phpmp3.php';
    require 'mydb.php';

    $col = $database->ResourcesTest;

    $user = $_SESSION['name'];

    if (isset($_POST['download'])) {
        
         $ease = $_POST['filename'];
            $ask = count($ease);
            $ziparr = array();

            for($x = 0; $x < $ask ; $x++ ){
    
                $filo = $col->findOne(array('Username' => $user, 'Resource Name' => $ease[$x]));

                $file = $filo["Resource Path"];
                array_push($ziparr, $file);     
                $ext = $filo["Resource Type"];        
  switch($ext) {
            case "jpg": $type = "image/jpeg"; break;
            case "gif": $type = "image/gif"; break;
            case "png": $type = "image/png"; break;
            case "txt": $type = "text/plain"; break;
            case "pdf": $type = "application/pdf"; break;
            case "zip": $type = "application/x-zip"; break;
            case "doc": $type = "application/msword"; break;
            case "dot": $type = "application/msword"; break;
            case "docx": $type = "application/vnd.openxmlformats-officedocument.wordprocessingml.document"; break;
            case "dotx": $type = "application/vnd.openxmlformats-officedocument.wordprocessingml.template"; break;
            case "docm": $type = "application/vnd.ms-word.document.macroEnabled.12"; break;
            case "dotm": $type = "application/vnd.ms-word.template.macroEnabled.12"; break;
            case "ppt": $type =  "application/vnd.ms-powerpoint"; break;
            case "pot": $type =  "application/vnd.ms-powerpoint"; break;
            case "pps": $type =  "application/vnd.ms-powerpoint"; break;
            case "ppa": $type =  "application/vnd.ms-powerpoint"; break;
            case "pptx": $type = "application/vnd.openxmlformats-officedocument.presentationml.presentation"; break;
            case "potx": $type = "application/vnd.openxmlformats-officedocument.presentationml.template"; break;
            case "ppsx": $type = "application/vnd.openxmlformats-officedocument.presentationml.slideshow"; break;
            case "ppam": $type = "application/vnd.ms-powerpoint.addin.macroEnabled.12"; break;
            case "pptm": $type = "application/vnd.ms-powerpoint.presentation.macroEnabled.12"; break;
            case "potm": $type = "application/vnd.ms-powerpoint.template.macroEnabled.12"; break;
            case "ppsm": $type = "application/vnd.ms-powerpoint.slideshow.macroEnabled.12"; break;
            case "mp3": $type = "audio/mpeg"; break;
            case "flv": $type = "video/x-flv"; break;
            case "mp4": $type = "video/mp4"; break;
            case "m3u8": $type = "application/x-mpegURL"; break;
            case "ts": $type = "video/MP2T"; break;
            case "3gp": $type = "video/3gpp"; break;
            case "mov": $type = "video/quicktime"; break;
            case "avi": $type = "video/x-msvideo"; break;
            case "wmv": $type = "video/x-ms-wmv"; break;
            
    }
    

if(!$file){ // file does not exist
    die('file not found');
} else {
//    header("Cache-Control: public");
// //   header("Content-Description: File Transfer");
// //   header("Content-Disposition: attachment; filename=$file");
//    header("Content-Type: ".$type);
//    header("Content-Transfer-Encoding: binary");
//
//    // read the file from disk
//    readfile($file);
}
}



$files = $ziparr;
//$zip = new ZipArchive;
//$zip->open($zipname, ZipArchive::CREATE);
//foreach ($files as $fil) {
//  //  print_r($fil);
//  $zip-> addFile($fil);
//    print_r($zip);
//}
//$zip->close();

$zip = new ZipArchive();
$zip_name = time().".zip"; // Zip name
$zip->open($zip_name,  ZipArchive::CREATE);
foreach ($files as $fil) {
  echo $path = $fil;
  if(file_exists($path)){
  $zip->addFromString(basename($path),  file_get_contents($path));  
  }
  else{
   echo"file does not exist";
  }
}
$zip->close();

if (headers_sent()) {
    echo 'HTTP header already sent';
} else {
    if (!is_file($zip_name)) {
        header($_SERVER['SERVER_PROTOCOL'].' 404 Not Found');
        echo 'File not found';
    } else if (!is_readable($zip_name)) {
        header($_SERVER['SERVER_PROTOCOL'].' 403 Forbidden');
        echo 'File not readable';
    } else {
        header($_SERVER['SERVER_PROTOCOL'].' 200 OK');
        header("Content-Description: File Transfer");
        header("Content-Type: application/zip");
        header("Content-Transfer-Encoding: Binary");
        header("Content-Length: ".filesize($zip_name));
        header("Content-Disposition: attachment; filename=\"".basename($zip_name)."\"");
        header('Pragma: no-cache');
        header('Expires: 0');
        header("connection: Keep Alive");
        flush();
        ob_clean();
        readfile($zip_name);
        unlink($zip_name);
        exit;
        
    }
}
//header('Content-Type: application/x-zip');
//header('Content-disposition: attachment; filename='.$zip_name);
//header('Content-Transfer-Encoding: Base64');
//header('Content-Length: ' . filesize($zip_name));
//readfile($zip_name);
    }
    elseif (isset($_POST['package'])) {
        # Save-button was clicked
           
  echo '<!DOCTYPE html>
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
        <script src="js/jquery-1.10.2.min.js"></script>
        <style>
            .container > header > span span:hover:before {
                    content: attr(data-content);
                    text-transform: none;
                    text-indent: 0;
                    letter-spacing: 0;
                    font-weight: 300;
                    font-size: 110%;
                    padding: 0.8em 1em;
                    line-height: 1.2;
                    text-align: left;
                    left: auto;
                    margin-left: 4px;
                    position: absolute;
                    color: #00b36b !important;
                    background: #000 !important;
                }
        </style>
	</head>
	<body>
		<div class="container">
			<header class="clearfix">
				<span>ReVO-App <span class="bp-icon bp-icon-about" data-content="Please fill out all the fields of this form pertaining to the educational package which you are constructing. Please be as detailed as possible. Don\'t forget, you can share your package with other educators on ReVO, just select a package in the \'My Files\' tab and click share."></span></span>
				<h1>Metadata Capturing Form</h1>
			</header>	
			<div class="main">
				<form class="cbp-mc-form" action="metacapture.php"  method="post">
					<div class="cbp-mc-column">
	  					<label for="language">Language</label>
	  					<select id="country" name="language" required>
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
	  					<textarea id="description" name="description" placeholder="Please add a short description of the resource..." required></textarea>
	  				</div>
	  				<div class="cbp-mc-column">
                        <label for="title">Title</label>
	  					<input type="text" id="title" name="title" placeholder="Awesome name goes here..." required>
	  					<label>Type</label>
	  					<select id="type" name="type" required>
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
	  					<select id="coverage" name="Coverage">
	  						<option>Choose a Curriculum</option>
                            <option>ACE</option>
                            <option>IEB</option>
                            <option>OBE</option>
                            <option>CAPS</option>
                            <option>Ambleside</option>
                            <option>Cambridge</option>                  
	  					</select>
                        
                        <label for="relations">Related Topics</label>
	  					<input type="text" id="relations" name="relations" placeholder="Similar or related work..." required>
	  					
	  				</div>
	  				<div class="cbp-mc-column">
	  					<label>Subject</label>
	  				<select id="subject" name="subject">
	  						<option>Choose a Subject</option>
                            <option>Accounting</option>
                            <option>Afrikaans</option>
                            <option>Art</option>
                            <option>Biology</option>
                            <option>Chemistry</option>
                            <option>Computer Science</option>
                            <option>Drama</option>
                            <option>Engineering Graphics & Design</option>
                            <option>English</option>
                            <option>French</option>
                            <option>Geography</option>
                            <option>German</option>
                            <option>History</option>
                            <option>Information Technology</option>
                            <option>Language</option>
                            <option>Life Orientation</option>
                            <option>Life Science</option>
	  						<option>Mathematics</option>
                            <option>Music</option>
	  						<option>Physical Education</option>
	  						<option>Physical Science</option>                    
	  					</select>
						
	  					<label for="comments">Comments</label>
	  					<textarea id="comments" name="comments" placeholder="How should the lesson be conducted?" required></textarea>	
	  				</div>
	  				<div class="cbp-mc-submit-wrap"><input class="cbp-mc-submit" type="submit" name="submit" value="Send your data" /></div>
				</form>
			</div>
            <script>
             $("input#title").on({
            keydown: function(e) {
                if (e.which === 32 || e.which === 222 || e.which == 220 || e.shiftKey && e.which === 222){
                alert("Please do not use spaces, quotations and backslashes");
                    return false;
                    }
            },
            change: function() {
                this.value = this.value.replace(/\s/g, "");
            }
                });</script>
		</div>';
                   
   $_SESSION['filename'] = $_POST['filename'];

                    

	echo '</body>
</html>';
    }

    elseif (isset($_POST['delete'])){
             $email = $_SESSION['email'];
          $ease = $_POST['filename'];
            $ask = count($ease);

    for($x = 0; $x < $ask ; $x++ ){
        $filo = $col->findOne(array('Username' => $user, 'Resource Name' => $ease[$x]));

        $file = $filo["Resource Path"];
        
        unlink($file);
        
        $col->remove( array( 'Username' => $user, "Resource Name" => $ease[$x] ) );
    }
        
        header("Location: ../MultiLevelPushMenu/myFiles.php");
        die();
        
    }

    elseif (isset($_POST['packDelete'])){
             $email = $_SESSION['email'];
          $ease = $_POST['filename'];
            $ask = count($ease);

    for($x = 0; $x < $ask ; $x++ ){
        $filo = $col->findOne(array('Username' => $user, 'Resource Name' => $ease[$x]));

        $file = $filo["Resource Path"];
        $fileBase = basename($file);
        $mani = str_replace($fileBase, "imsmanifest.xml", $file);
        $delDir = str_replace(".zip", "", $fileBase);
        
        unlink($file);
        unlink($mani);
        
        rmdir("../Resources/".$email."/Packaged/".$delDir);
        
        
        $col->remove( array( 'Username' => $user, "Resource Name" => $ease[$x] ) );
    }
        
        header("Location: ../MultiLevelPushMenu/myFiles.php");
        die();
        
    }

    elseif(isset($_POST['share'])){
       // print_r($_POST['filename']);
        $ease = $_POST['filename'];
        $ask = count($ease);
        
          for($x = 0; $x < $ask ; $x++ ){
        $filo = $col->findOne(array('Username' => $user, 'Resource Name' => $ease[$x]));

        $file = $filo["Resource Path"];
        $fileBase = basename($file);
              $spaceCount = substr_count($fileBase, " ");
        $mani = str_replace($fileBase, "imsmanifest.xml", $file);
              
              echo $mani;
              echo $file;
          
        
        
        
    $xml=simplexml_load_file($mani);
    $myfile = file_get_contents($mani);
    $PID = $xml->entry[1]->content->children('oai_dc', true)->children('dc', true)->identifier;
    $URL= $pName = $xml->title;
    $pSubject = $xml->entry[1]->content->children('oai_dc', true)->children('dc', true)->subject;
    $pDes = preg_replace('/\n|\r/', ' ', $xml->entry[1]->content->children('oai_dc', true)->children('dc', true)->description);
    $pDes = str_replace("'", "\'", $pDes);
    $pDes = str_replace('"', '\"', $pDes);
    if ($pDes == "") {
        $pDes = "No description given.";
    }
//     echo var_dump($arr1);
//              echo var_dump($arr2);
              
    $tmpfile = $mani;
    $filename = basename($mani);
    $tmpOpen = fopen($tmpfile, 'r');

// Get cURL resource
    $curl = curl_init();

// Set some options
    curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => 'http://localhost:8080/fedora/objects/new?format=info:fedora/fedora-system:ATOM-1.1',
        CURLOPT_PUT => 1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_USERPWD => "fedoraAdmin:1234",
        CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
        CURLOPT_HTTPHEADER => array(
            "Accept: text/xml", "Content-Type: text/xml"
        ),
        CURLOPT_INFILE => $tmpOpen,
        CURLOPT_INFILESIZE => filesize($tmpfile),
        CURLOPT_FOLLOWLOCATION => 0
    ));

// Send the request & save response to $resp
    $resp = curl_exec($curl);

// Check response
//echo $resp;
//
// Close request to clear up some resources
    curl_close($curl);
echo "<script>
alert('Upload to Fedora SUCCESSFUL!!');
window.location.href='../MultiLevelPushMenu/myFiles.php';
</script>";
              
}
 
     $pLoc = $xml->entry[1]->content->children('oai_dc', true)->children('dc', true)->creator . '/imsmanifest.xml';
        $checkExist = "select packageName, packageSubject, packageLocation from package where packageName like '$pName' and packageSubject like '$pSubject'
and packageLocation like '$pLoc' limit 1";
    $runExist = mysqli_query($conn, $checkExist);
    if (mysqli_num_rows($runExist) == 0) {
        $insertData = "INSERT INTO package (packagePID, packageUrl, packageName, packageSubject, packageDescription, packageLocation, packageDate, packageLikes, packageDislikes, packageComments)
VALUES ('$PID', '$URL', '$pName', '$pSubject', '$pDes', '$pLoc', date(now()), '', '', '')";
        $result = mysqli_query($conn, $insertData);

        if (!$result) {
            die('Invalid query: ' . mysqli_error());
        }
    } 
}
        

    elseif (isset($_POST['ADsequence']) OR isset($_POST['ASsequence'])){
        $email = $_SESSION['email'];
        $ease = $_POST['filename'];
            $ask = count($ease);
    
        $array = explode('|', $_POST['map']);
       // print_r($array);
        
        for($i = 1; $i < count($array); $i+=2){
            $order = $array[$i];
         //   echo $order;
            $array[$i] = $_POST[$order];
        }
        
       // print_r($array);
        
        $finarray = array();
        
           for($j = 1; $j < count($array); $j+=2){
            $final = explode('-',$array[$j]);
            
               for ($k = 0; $k < count($final); $k++){
                   $finarray[$final[$k]]=$array[($j-1)];
               }
        }
        ksort($finarray);
     //   print_r($finarray);
        
            $file = $col->findOne(array("Username" => $_SESSION['name'], 'Resource Name' => $finarray[1]));
            $file1 = $col->findOne(array("Username" => $_SESSION['name'], 'Resource Name' => $finarray[2]));
        
        $path = $file["Resource Path"];
        $path1 = $file1["Resource Path"];
        $mp3 = new PHPMP3($path);

        $newpath = "../Resources/".$email."/".$_POST['seqMp3Title'].".mp3";
        $mp3->striptags();

        $mp3_1 = new PHPMP3($path1);
        $mp3->mergeBehind($mp3_1);
        $mp3->striptags();
        $mp3->setIdv3_2('01',"'".$_POST['seqMp3Title']."'",'Collation',"'".$_SESSION['name']."s Sequence",'Year','Genre','Comments',"'".$_SESSION['name']."'",'OrigArtist',
                        'Copyright','url','encodedBy');
        $mp3->save($newpath);

              for ($i = 3; $i <= count($finarray); $i++ ){
                  $path = $newpath;
                  $file1 = $col->findOne(array("Username" => $_SESSION['name'], 'Resource Name' => $finarray[$i]));
                  
                  $path1 = $file1['Resource Path'];
                   $mp3 = new PHPMP3($path);

                $newpath = "../Resources/".$email."/".$_POST['seqMp3Title'].".mp3";
                $mp3->striptags();

                $mp3_1 = new PHPMP3($path1);
                $mp3->mergeBehind($mp3_1);
                $mp3->striptags();
                 $mp3->setIdv3_2('01','Track Title','Artist','Album','Year','Genre','Comments','Composer','OrigArtist',
'Copyright','url','encodedBy');
                  $mp3->save($newpath);
                  
              }      
        if(isset($_POST['ADsequence'])){
            $file3 = basename($newpath);
            $file3path = $newpath;

            if(!$file3path){ // file does not exist
                die('file not found');
                } else {
                    header("Cache-Control: public");
                header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=$file3");
            header("Content-Type: audio/x-mpeg-3");
            header("Content-Transfer-Encoding: binary");

            // read the file from disk
                
            readfile($file3path);
            }
              unlink($newpath);
              ob_clean();
          
        }
        
        elseif(isset($_POST['ASsequence'])){
                    
        $col = $database->ResourcesTest;
            
            $target_dir = "../Resources/".$email."/";
            $target_file = $target_dir . basename($newpath);
            $fileType = pathinfo($target_file,PATHINFO_EXTENSION);
        
         $document = array( 
        "Username" => $_SESSION['name'],
             "UserID" => $_SESSION['id'],
        "Resource Name" => basename($newpath), 
        "Resource Size" => filesize($newpath),
         "Resource Dir" => $target_dir,
             "Resource Path" => $target_file,
             "Resource Type" => $fileType,
             "Orchestrated" => "yes"

           );

           $col->insert($document);
             header("Location: ../MultiLevelPushMenu/sequencer.php");
        }
        
            }

  elseif (isset($_POST['VDsequence']) OR isset($_POST['VSsequence'])){
      
        $email = $_SESSION['email'];
        $ease = $_POST['filename2'];
            $ask = count($ease);
    
        $array = explode('|', $_POST['map2']);
       // print_r($array);
        
        for($i = 1; $i < count($array); $i+=2){
            $order = $array[$i];
         //   echo $order;
            $array[$i] = $_POST[$order];
        }
        
       // print_r($array);
        
        $finarray = array();
        
           for($j = 1; $j < count($array); $j+=2){
            $final = explode('-',$array[$j]);
            
               for ($k = 0; $k < count($final); $k++){
                   $finarray[$final[$k]]=$array[($j-1)];
               }
        }
        ksort($finarray);
      
     //   print_r($finarray);
            $strn ="";
            
         $file = $col->findOne(array("Username" => $_SESSION['name'], 'Resource Name' => $finarray[1]));
            $file1 = $col->findOne(array("Username" => $_SESSION['name'], 'Resource Name' => $finarray[2]));
      $id = $_SESSION['id'];
        
        $path = $file["Resource Path"];
        $path1 = $file1["Resource Path"];
      
      exec('ffmpeg -i "'.$path.'" -c copy -bsf:v h264_mp4toannexb -f mpegts "'.$id.'"1.ts 2>&1');
      exec('ffmpeg -i "'.$path1.'" -c copy -bsf:v h264_mp4toannexb -f mpegts "'.$id.'"2.ts 2>&1');
      $strn2 ='ffmpeg -i "concat:'.$id.'1.ts|'.$id.'2.ts';
      //fwrite($myfile, $strn);
      $newMp4path = "../Resources/".$email."/".$_POST["seqMp4Title"].".mp4";
      
              for ($i = 3; $i <= count($finarray); $i++ ){
                  $path = '';
                  $file1 = $col->findOne(array("Username" => $_SESSION['name'], 'Resource Name' => $finarray[$i]));
                  
                  $path1 = $file1['Resource Path'];
                 exec('ffmpeg -i "'.$path1.'" -c copy -bsf:v h264_mp4toannexb -f mpegts "'.$id.$i.'".ts 2>&1');
                  $strn2.='|'.$id.$i.'.ts';
                 // fwrite($myfile, $strn);
              }
                $strn2.='" -c copy -bsf:a aac_adtstoasc '.$newMp4path.' 2>&1';
        exec($strn2);
      
              for ($j = 1; $j < count($finarray); $j++ ){
                 $filnam = $id.$j.".ts";
                unlink($filnam);
              }
        
    //  exec('ffmpeg -f concat -safe 0 -i "'.$_SESSION['id'].'.txt" -c copy "'.$newMp4path.'.mp4" 2>&1');
    // unlink($_SESSION['id'].".txt");
//      $newMp4path.=".mp4";
      $base = basename($newMp4path);
         
        if(isset($_POST['VDsequence'])){
          // echo $newMp4path.".mp4";
            
            if(!$newMp4path){ // file does not exist
                die('file not found');
                } else {
                    header("Cache-Control: public");
                header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=$base");
            header("Content-Type: video/mp4");
            header("Content-Transfer-Encoding: binary");

            // read the file from disk
                
            readfile($newMp4path);
            }
            unlink($newMp4path);
              ob_clean();
          
        }
        
        if(isset($_POST['VSsequence'])){  //change to elseif
                    
        $col = $database->ResourcesTest;
            
            $target_dir1 = "../Resources/".$email."/";
            $target_file1 = $target_dir1 . basename($newMp4path);
            $fileType1 = pathinfo($target_file1,PATHINFO_EXTENSION);
        
         $document = array( 
        "Username" => $_SESSION['name'],
             "UserID" => $_SESSION['id'],
        "Resource Name" => basename($newMp4path), 
        "Resource Size" => filesize($newMp4path),
         "Resource Dir" => $target_dir1,
             "Resource Path" => $target_file1,
             "Resource Type" => $fileType1,
             "Orchestrated" => "yes"

           );

           $col->insert($document);
             header("Location: ../MultiLevelPushMenu/sequencer.php");
        }
        
  }

?>



