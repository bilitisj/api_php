<?php
if(isset($_GET['delog'])) :
    session_start();
    unset($_SESSION['user']);
    unset($_SESSION['token']);
    $response['response'] = "déconnection";
    $response['code'] = 200;
    $response['time'] = date('Y-m-d,H:i:s');
    echo Json_encode($response);
    exit;
endif;
require 'config.php';

    $json = file_get_contents('php://input');
    $arrayPOST = json_decode($json, true);
    $sql = sprintf("SELECT * FROM users WHERE login = '%s' AND password = '%s'",
        $arrayPOST['login'],
        $arrayPOST['password']
    );
    $result = $connect->query($sql);
    echo $connect->error;
    if($result->num_rows > 0) :
        $user = $result -> fetch_assoc();
        session_start();
        $_SESSION['user'] = $user['id_users'];
        $_SESSION['token'] = md5($user['login'].time());
        $response['response'] = "ok connecté";
        $response['token'] = $_SESSION['token'];
        //myPrint_r($_SESSION);
    else :
        $response['response']  = "erreur de login et/ou mot de passe";
        $response['code'] = 403;
    endif;


$response['code'] = (isset($response['code'])) ? $response['code'] : 200;
$response['time'] = date('Y-m-d,H:i:s');

echo Json_encode($response);
?>