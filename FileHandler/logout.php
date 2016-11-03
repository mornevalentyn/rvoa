<?php
session_start();
session_unset();
 echo var_dump($_SESSION);
session_destroy();
    header("Location: ../MultiLevelPushMenu/index.php");
        exit();

?>