<?php
require 'dbHandler.php';

$user = $_SESSION['name'];
$email = $_SESSION['email'];

$Rname1 = basename($_FILES["FileUpload"]["name"]);
$Rname2 = $_FILES["FileUpload"]["name"];
$fsize = $_FILES['FileUpload']['size'];
echo $Rname1."<br>".$Rname2;

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
if ($fsize > 10000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["FileUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["FileUpload"]["name"]). " has been uploaded.";
        
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
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
    
}
?>