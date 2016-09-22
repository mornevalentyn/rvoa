    <?php
    
    require 'dbHandler.php';
    $col = $database->ResourcesTest;
    $GLOBALS['col']=$col;
    $GLOBALS['database']=$database;

    function makeFileList($user, $butname) {
         
        $cursor = $GLOBALS['col']->find(array('Username' => $user, "Packaged" => array('$ne' => "Yes"))); 
        $num = $cursor->count();
        echo "<h1> You have ".$num." Raw files. </h1>";  
        if ($butname == "Package"){
             echo "<form method='POST' action='../FileHandler/meta.php' enctype='multipart/form-data'>" ;
        }
        else {
        echo "<form method='POST' action='../FileHandler/download.php' enctype='multipart/form-data'>" ;  
        }
        foreach ($cursor as $obj) {                   // iterate through the results
            $filename = $obj['Resource Name'];
        
        if(!isset($obj["Packaged"])){

                echo "<input type='checkbox' name='filename[]' value='".$filename."'>".$filename."<br>";
            }
                
        }
        if($num != 0){
            
            echo "  <input type='submit' value='$butname'>
                </form>";  
        }
        else{
            echo '</form><br>
                <h2>Please upload some files</h2>';
                
        }
        
            $cursor = $GLOBALS['col']->find(array('Username' => $user, "Packaged" => "Yes")); 
        $num = $cursor->count();
        echo "<h1> You have ".$num." Packaged files. </h1>";  
        if ($butname == "Package"){
             echo "<form method='POST' action='../FileHandler/meta.php' enctype='multipart/form-data'>" ;
        }
        else {
        echo "<form method='POST' action='../FileHandler/download.php' enctype='multipart/form-data'>" ;  
        }
        foreach ($cursor as $obj) {                   // iterate through the results
            $filename = $obj['Resource Name'];
        
        if(isset($obj["Packaged"])){

                echo "<input type='checkbox' name='filename[]' value='".$filename."'>".$filename."<br>";
            }
                
        }
        if($num != 0){
            
            echo "  <input type='submit' value='$butname'>
                </form>";  
        }
        else{
            echo '</form><br>
                <h2>Please upload some files</h2>';
                
        }
    }

   ?>  
        
        
     
   