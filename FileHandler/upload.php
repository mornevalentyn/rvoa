<?php
require 'dbHandler.php';

$user = $_SESSION['name'];
$email = $_SESSION['email'];

$Rname1 = basename($_FILES["FileUpload"]["name"]);
$Rname2 = $_FILES["FileUpload"]["name"];
$fsize = $_FILES['FileUpload']['size'];
//echo $Rname1."<br>".$Rname2;

$target_dir = "../Resources/".$email."/";


if (!file_exists('../Resources/'.$email)) {
    mkdir('../Resources/'.$email, 0777, true);
}



$target_file = $target_dir . basename($_FILES["FileUpload"]["name"]);
$uploadOk = 1;
$fileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($fsize > 10000000000000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
    if(strpos($Rname1, "'") OR strpos($Rname1, "\"") OR strpos($Rname1, "\\")){
        echo "<script>
                alert('Please do not upload files with \' \" \\\ in the name');
                </script>";
        $uploadOk = 0;
    }

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} 
    else {
    if (move_uploaded_file($_FILES["FileUpload"]["tmp_name"], $target_file)) {
//        echo "The file ". basename( $_FILES["FileUpload"]["name"]). " has been uploaded.";
        
        $col = $database->ResourcesTest;
        
         $document = array( 
        "Username" => $user,
             "UserID" => $_SESSION['id'],
        "Resource Name" => $Rname2, 
        "Resource Size" => $fsize,
         "Resource Dir" => $target_dir,
             "Resource Path" => $target_file,
             "Resource Type" =>$fileType

           );

           $col->insert($document);
        
            header("Location: ../MultiLevelPushMenu/myFiles.php");
            die();  
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
  
}

if(isset($_POST["audio"])) {
    $allowed = array("audio/mp3", "audio/mpeg", "audio/x-mpeg-3");
    
    if(!in_array($_FILES["FileUpload"]["type"], $allowed)){
        header("refresh:0;url=../MultiLevelPushMenu/sequencer.php");
        $message = "OOOPS!! I think you chose the wrong file. Only MP3s here :)";
        echo "<script type='text/javascript'>alert('$message');</script>";
        $uploadOk = 0;
    }

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($fsize > 100000000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
      if(strpos($Rname1, "'") OR strpos($Rname1, "\"") OR strpos($Rname1, "\\")){
        echo "<script>
                alert('Please do not upload files with \' \" \\\ in the name');
                </script>";
        $uploadOk = 0;
    }

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
   // echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["FileUpload"]["tmp_name"], $target_file)) {
//        echo "The file ". basename( $_FILES["FileUpload"]["name"]). " has been uploaded.";
        
        $col = $database->ResourcesTest;
        
         $document = array( 
        "Username" => $user,
             "UserID" => $_SESSION['id'],
        "Resource Name" => $Rname2, 
        "Resource Size" => $fsize,
         "Resource Dir" => $target_dir,
             "Resource Path" => $target_file,
             "Resource Type" => $fileType

           );

           $col->insert($document);
        
        header("Location: ../MultiLevelPushMenu/sequencer.php");
        die();
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
    
    
}

if(isset($_POST["video"])) {
    $allowed = array("audio/mp4", "video/mp4", "application/mp4");
    
    if(!in_array($_FILES["FileUpload"]["type"], $allowed)){
        header("refresh:0;url=../MultiLevelPushMenu/sequencer.php");
        $message = "OOOPS!! I think you chose the wrong file. Only MP3s here :)";
        echo "<script type='text/javascript'>alert('$message');</script>";
        $uploadOk = 0;
    }

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($fsize > 10000000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
    if(strpos($Rname1, "'") OR strpos($Rname1, "\"") OR strpos($Rname1, "\\")){
        echo "<script>
                alert('Please do not upload files with \' \" \\\ in the name');
                </script>";
        $uploadOk = 0;
    }

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
   // echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["FileUpload"]["tmp_name"], $target_file)) {
//        echo "The file ". basename( $_FILES["FileUpload"]["name"]). " has been uploaded.";
        
        $col = $database->ResourcesTest;
        
         $document = array( 
        "Username" => $user,
             "UserID" => $_SESSION['id'],
        "Resource Name" => $Rname2, 
        "Resource Size" => $fsize,
         "Resource Dir" => $target_dir,
             "Resource Path" => $target_file,
             "Resource Type" => $fileType

           );

           $col->insert($document);
        
        header("Location: ../MultiLevelPushMenu/sequencer.php");
        die();
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
    
    
}

?>