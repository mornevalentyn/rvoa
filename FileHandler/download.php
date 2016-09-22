<?php
    require 'dbHandler.php';
    $col = $database->ResourcesTest;    

    $ease = $_POST['filename'];
    $ask = count($ease);
    $ziparr = array();

    for($x = 0; $x < $ask ; $x++ ){
    
$filo = $col->findOne(array('Resource Name' => $ease[$x]));

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
        header("Content-Type: application/octet-stream");
        header("Content-Transfer-Encoding: Binary");
        header("Content-Length: ".filesize($zip_name));
        header("Content-Disposition: attachment; filename=\"".basename($zip_name)."\"");
        header('Pragma: no-cache');
        header('Expires: 0');
        header("connection: Keep Alive");
        flush();
        ob_clean();
        readfile($zip_name);
        exit;
        
    }
}
//header('Content-Type: application/x-zip');
//header('Content-disposition: attachment; filename='.$zip_name);
//header('Content-Transfer-Encoding: Base64');
//header('Content-Length: ' . filesize($zip_name));
//readfile($zip_name);

?>



