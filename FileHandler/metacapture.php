<?php
    require "dbHandler.php";

    $languages = array("English" => "en", "Afrikaans" => "af", "French" => "fr", "German" => "de",
                      "Portuguese" => "pt", "Italian" => "it", "Spanish" => "es", "Dutch" => "nl");

  if($_SERVER["REQUEST_METHOD"]=="POST"){                        
           
if(isset($_POST['language'])){
    $sub = $_POST['subject'];
    $lang = $languages[$_POST['language']];
    $title = $_POST['title'];
    $cov = $_POST['coverage'];
    $rela = $_POST['relations'];
    $disc = $_POST['description'];
    $comm = $_POST['comments'];
    $date = date("Y-m-d");
    $time = date("h:i:s");
    $rand = mt_rand();
    $pid = "RVOA:".sha1($title.$date.$time.$rand);
     mkdir(''.$_SESSION['id'], 0777, true);
   $myfile = fopen($_SESSION['id']."/imsmanifest.xml", "w");
    
    $text = "the data i have is...
            subject = ".$sub."
            language = ".$lang."
            title = ".$title."
            coverage = ".$cov."
            relations = ".$rela."
            description = ".$disc."
            comments = ".$comm."
            and the files are ";
  
    $finalFilePath = "file:///C:/wamp64/www/Resources/".$_SESSION['email']."/Packaged/".$title.$date."/".$title.$date.".zip";
    $filePath = "C:/wamp64/www/Resources/".$_SESSION['email']."/Packaged/".$title.$date."/".$title.$date.".zip";
    
    echo $finalFilePath;
    echo $filePath;
//    print_r($_SESSION['filename']);
   
    $text = '<?xml version="1.0" encoding="UTF-8"?>
<feed xmlns="http://www.w3.org/2005/Atom">
  <id>info:fedora/'.$pid.'</id>
  <title type="text">'.$title.'</title>
  <updated>'.$date.'T'.$time.'Z</updated>
  <author>
    <name>fedoraAdmin</name>
  </author>
  <category scheme="info:fedora/fedora-system:def/model#state" term="Active"/>
  <category scheme="info:fedora/fedora-system:def/model#createdDate" term="2008-07-02T05:09:42.015Z"/>
  <icon>http://www.fedora-commons.org/images/logo_vertical_transparent_200_251.png</icon>
  <entry>
    <id>info:fedora/'.$pid.'/DC</id>
    <title type="text">DC</title>
    <updated>'.$date.'T'.$time.'Z</updated>
    <link href="info:fedora/'.$pid.'/DC/'.$date.'T'.$time.'Z" rel="alternate"/>
    <category scheme="info:fedora/fedora-system:def/model#state" term="A"/>
    <category scheme="info:fedora/fedora-system:def/model#controlGroup" term="X"/>
    <category scheme="info:fedora/fedora-system:def/model#versionable" term="true"/>
  </entry>
  <entry xmlns:thr="http://purl.org/syndication/thread/1.0">
    <id>info:fedora/'.$pid.'/DC/'.$date.'T'.$time.'Z</id>
    <title type="text">DC1.0</title>
    <updated>'.$date.'T'.$time.'Z</updated>
    <thr:in-reply-to ref="info:fedora/'.$pid.'/DC"/>
    <category scheme="info:fedora/fedora-system:def/model#formatURI" term="http://www.openarchives.org/OAI/2.0/oai_dc/"/>
    <category scheme="info:fedora/fedora-system:def/model#label" term="Dublin Core Record for this object"/>
    <content type="text/xml">
      <oai_dc:dc xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:oai_dc="http://www.openarchives.org/OAI/2.0/oai_dc/">
        <dc:title> '.$title.' </dc:title>
        <dc:date>'.$date.'T'.$time.'Z</dc:date>
        <dc:creator>'.$_SESSION['name'].' '.$_SESSION['surname'].'</dc:creator>
        <dc:subject> '.$sub.' </dc:subject>
        <dc:description> '.$disc.' </dc:description>
        <dc:coverage> '.$cov.' </dc:coverage>
        <dc:publisher> RVOA </dc:publisher>
        <dc:language> '.$lang.' </dc:language>
        <dc:relation> '.$rela.' </dc:relation>
        <dc:format>application/zip</dc:format>
        <dc:comments> '.$comm.' </dc:comments>
        <dc:identifier>'.$pid.'</dc:identifier>
      </oai_dc:dc>
    </content>
  </entry>
  <entry>
    <id>info:fedora/'.$pid.'/'.$title.'</id>
    <title type="text">'.$title.'</title>
    <updated>'.$date.'T'.$time.'Z</updated>
    <link href="info:fedora/'.$pid.'/'.$title.'/'.$date.'T'.$time.'Z" rel="alternate"/>
    <category scheme="info:fedora/fedora-system:def/model#state" term="A"/>
    <category scheme="info:fedora/fedora-system:def/model#controlGroup" term="M"/>
    <category scheme="info:fedora/fedora-system:def/model#versionable" term="true"/>
  </entry>
  <entry xmlns:thr="http://purl.org/syndication/thread/1.0">
    <id>info:fedora/'.$pid.'/'.$title.'/'.$date.'T'.$time.'Z</id>
    <title type="text">'.$title.'1.0</title>
    <updated>'.$date.'T'.$time.'Z</updated>
    <thr:in-reply-to ref="info:fedora/'.$pid.'/'.$title.'"/>
    <category scheme="info:fedora/fedora-system:def/model#label" term="'.$title.'"/>
    <summary type="text">'.$title.'1.0</summary>
    <content
      src="'.$finalFilePath.'" type="application/zip"/>
  </entry>
</feed>';
        fwrite($myfile,$text);
    fclose($myfile);
}
       }
                            
$col = $database->ResourcesTest;    

    $ease = $_SESSION['filename'];
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
array_push($ziparr, $_SESSION['id']."/imsmanifest.xml");



$files = $ziparr;


$zip = new ZipArchive();
$zip_name = $title.$date.".zip"; // Zip name
$zip->open($zip_name,  ZipArchive::CREATE);
foreach ($files as $fil) {
   $path = $fil;
  if(file_exists($path)){
  $zip->addFromString(basename($path),  file_get_contents($path));  
  }
  else{
   echo "<script>
    alert('OOPS! That file does not exist.')
        </script>";
  }
}
$zip->close();                           
                                                    
    $target_dir = "../Resources/".$_SESSION['email']."/Packaged/".$title.$date."/";


    if (!file_exists('../Resources/'.$_SESSION['email'].'/Packaged/'.$title.$date.'/')) {
        mkdir('../Resources/'.$_SESSION['email'].'/Packaged/'.$title.$date.'/', 0777, true);
    }



        $target_file = $target_dir . basename($zip_name);
        $fsize = filesize($zip_name);
        $uploadOk = 1;
        $fileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {

// Check if file already exists
            if (file_exists($target_file)) {
                    echo "<script>
                            alert('OOPS! That file already exists.')
                            </script>";
                $uploadOk = 0;
                }
// Check file size
            if ($fsize > 1000000000000) {
                   
                echo "<script>
                            alert('OOPS! That file is a little too large.')
                            </script>";
            $uploadOk = 0;
                }

                // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
            } else {
        
            $filetype = filetype($zip_name);
            if (rename($zip_name, $target_file)) {
        
        //echo "The file ". basename($zip_name). " has been uploaded.";
        
                $col = $database->ResourcesTest;
        
                    $document = array( 
                        "Username" => $_SESSION['name'],
                        "UserID" => $_SESSION['id'],
                        "Resource Name" => $zip_name, 
                        "Resource Size" => $fsize,
                        "Resource Dir" => $target_dir,
                        "Resource Path" => $target_file,
                        "Resource Type" =>$fileType,
                        "Packaged" => "Yes"

                    );

           $col->insert($document);
        } else {
            unlink($zip_name);
            echo "Sorry, there was an error uploading your file.";
        }
            }
    
        }                     
        
        rename($_SESSION['id']."/imsmanifest.xml", $target_dir."/imsmanifest.xml");
            rmdir($_SESSION['id']); 
        
            header("Location: ../MultiLevelPushMenu/myFiles.php");
            die();
                            
                            
?>