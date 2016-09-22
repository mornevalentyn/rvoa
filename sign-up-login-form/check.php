<?php
if($_POST['fname']){
    
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $pwd = md5(sha1($_POST['pwd']));   
    
    echo "post successful";
       // connect to mongodb
   $m = new MongoClient();
   echo "Connection to database successfully";
	
   // select a database
   $db = $m->RVOA;
   echo "Database mydb selected";
   $collection = $db->Users;
   echo "Collection selected succsessfully";
	
   $document = array( 
      "First Name" => $fname, 
      "Last Name" => $lname, 
      "email" => $email,
      "Password" => $pwd
     
   );
	
   $collection->insert($document);
   echo "Document inserted successfully";
    
}

?>