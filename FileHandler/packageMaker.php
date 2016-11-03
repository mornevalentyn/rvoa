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
array_push($ziparr, "imsmanifest.xml")



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
?>