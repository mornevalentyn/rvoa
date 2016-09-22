<?php
    
    require 'dbHandler.php';
    $grid = $database->getGridFS();                    // Initialize GridFS
      
    $ask = $_POST['filename'];                   // Get filename requested
  
    
    foreach($ask as $res){
        
        $file = $grid->findOne(array('filename' => $res));
    $files = $database->fs->files;
    $file1 = $files->findOne(array('filename' => $res));
    $id = $file->file['_id'];
    $type = $file1['filetype'];
        
        echo $type;
        
      /* Any file types you want to be downloaded can be listed in this */
       header('Content-Type: '.$type);
       header('Content-Disposition: attachment; filename='.$res); 
       header('Content-Transfer-Encoding: binary');
       $cursor = $database->fs->chunks->find(array("files_id" => $id))->sort(array("n" => 1));
       foreach($cursor as $chunk) {
          echo $chunk['data']->bin;
       
       }  
        
        
        
    } 

    $mongo->close();                                // Disconnect from Server
    exit(0);
?>