<?php
session_start();

//verif authentification
if($_SERVER['REQUEST_METHOD'] != 'GET') :
    // heure actuelle
    $now = time();
    // si pas de user ou que l'heure actuelle est supérieure à l'heure d'expiration dans SESSION
    if (!isset($_SESSION['user']) OR $now > $_SESSION['expiration']) :
        // suppression des entrées liées à l'user dans la session
        unset($_SESSION['user']);
        unset($_SESSION['token']);
        unset($_SESSION['expiration']);
        // préparation de la réponse
        $response['response'] = "Token expired";
        $response['code'] = 401;
        echo json_encode($response);
        die();
    else : 
        //recup des datas json (qui contient le token)
        $json = file_get_contents('php://input');
        //décodage du format json, ça génère un array PHP
        $arrayPOST = json_decode($json, true);
        // le token passé est il different du token dans la session
        if(!isset($arrayPOST['token']) OR $arrayPOST['token'] != $_SESSION['token']) :
            $response['response'] = "Wrong token";
            $response['code'] = 401;
            echo json_encode($response);
            die();
        endif;
    endif;
    $_SESSION['expiration'] = time() + 1 * 60;
endif;

?>