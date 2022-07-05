<?php
    require_once 'functions.php';

    define('DB_USER', 'root');
    define('DB_PASS', 'root');
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'ingrwf10_php');

    define('MODE', 'dev'); //peut être en dev ou en prod

    $connect = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

//$connect est un objet
//connect_error est une propriété
//on va cibler une propriété donc on utilise une flèche simple
    if($connect ->connect_error) :
        die('connection failed: ' . $connect->connect_error);
    else : 
        $connect->set_charset('utf8');
    endif;

    //myPrint_r($connect);
    
?>