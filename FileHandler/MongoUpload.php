<?php

    require 'dbHandler.php'; //make sure that you are connected to database
        
   // echo "at the right place!";
        // GridFS : by default we will be splitting uploads into chunks for easier processing

    $grid = $database->getGridFS();

    $name = $_FILES['FileUpload']['name'];        // Get Uploaded file name
    
    // making sure to get mime type setup correctly //
    $ind = strpos($name,".")+1;
  //  echo $ind;
    $ext = substr($name,$ind);
   // echo $ext;
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
    
    $metadata = array('username'=>$_SESSION['name'],'filetype'=>$type);
    
    $grid->storeUpload('FileUpload', $metadata);
  


    $mongo->close();                                // Close connection
    
    exit(0);
?>