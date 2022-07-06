<?php
include 'config.php';
include 'headers.php';
require "verif_auth.php";

if($_SERVER['REQUEST_METHOD'] == 'GET') : 
    $sql = "SELECT * FROM categories";
    $result = $connect->query($sql);
    echo $connect->error;

    $response['data'] = $result->fetch_all(MYSQLI_ASSOC);
    $response['response'] = 'Toutes les catégories';
endif;

 //IF METHOD POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') :
    //extraction de l'obectjson du paquet HTTP
    $json = file_get_contents('php://input');
    //décodag du format json, ça génère un obect php
    $arrayJSON = json_decode($json, true);
    $sql = sprintf("INSERT INTO categories SET nom='%s'",
        addslashes(addslashes($arrayJSON['nom'])),//lire une propriété d'un objet PHP
        strip_tags(addslashes($arrayJSON['id_categorie']))// strip_tags retire le code html au cas où l'uilisateur utiliserait une balise
);
    $result = $connect->query($sql);
    echo $connect->error;
    $response['response'] = "Ajout d'une catégorie";
    $response['new_id'] = $connect->insert_id;
endif; //END POST
$response['code'] = (isset($response['code'])) ? $response['code'] : 200;
echo json_encode($response);