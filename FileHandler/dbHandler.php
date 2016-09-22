<?php
    
    session_start();
    
    $mongo = new MongoClient();
    $database = $mongo->test //remember to change this to suitable database
?>