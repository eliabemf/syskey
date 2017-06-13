<?php

    
    require_once "conection.php";
    
    session_name(md5("seg" . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']));
   
    session_start();
   
    session_destroy();
    
    header("Location: ../_login/loginInicio.php");
?>