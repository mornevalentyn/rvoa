    <?php
    
    require 'dbHandler.php';
    $col = $database->ResourcesTest;
    $GLOBALS['col']=$col;
    $GLOBALS['database']=$database;

    function makeFileList($user) {
         
        $cursor = $GLOBALS['col']->find(array('Username'=>$user)); 
        $num = $cursor->count();
        echo "<h1> You have ".$num." files. </h1>";  
        
        echo "<form method='POST' action='../FileHandler/download.php' enctype='multipart/form-data'>" ;  
        foreach ($cursor as $obj) {                   // iterate through the results
            $filename = $obj['Resource Name'];

            echo "<input type='checkbox' name='filename[]' value='".$filename."'>".$filename."<br>";

        }
        if($num != 0){
            echo "  <input type='submit' value='Download'>
                </form>";  
        }
        else{
            echo '</form><br>
                <h2>Please upload some files</h2>';
                
        }
    }

   ?>  
        
        
     
   