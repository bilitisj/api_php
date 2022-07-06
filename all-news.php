<?php
include 'config.php';
include 'headers.php';
if($_SERVER['REQUEST_METHOD'] == 'GET') : 
$sql = "SELECT * FROM news";
$result = $connect->query($sql);
echo $connect->error;

$response['data'] = $result->fetch_all(MYSQLI_ASSOC);
$response['response'] = 'All News';
endif;

 //IF METHOD POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') :
    //extraction de l'obectjson du paquet HTTP
    $json = file_get_contents('php://input');
    //décodag du format json, ça génère un obect php
    $objectJSON = json_decode($json);
    $sql = sprintf("INSERT INTO news SET titre='%s', contenu='%s'",
        addslashes($objectJSON->titre),//lire une propriété d'un objet PHP
        strip_tags(addslashes($objectJSON->contenu))// strip_tags retire le code html au cas où l'uilisateur utiliserait une balise
);
    $result = $connect->query($sql);
    echo $connect->error;
    $response['response'] = "Ajout d'une news";
    $response['new_id'] = $connect->insert_id;
endif; //END POST
$response['code'] = (isset($response['code'])) ? $response['code'] : 200;
echo json_encode($response);