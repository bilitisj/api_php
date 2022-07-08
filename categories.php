<?php
include 'config.php';
include 'headers.php';
require "verif_auth.php";

if($_SERVER['REQUEST_METHOD'] == 'GET') :
    if( isset($_GET['id_categorie'])) : 
        $sql = sprintf("SELECT * FROM categories WHERE id_categorie = %d",
            $_GET['id_categorie']
        );
        $response['response'] = "Une catégorie avec id " .$_GET['id_categorie'];
        $sqlProd = sprintf("SELECT * FROM produits WHERE id_categorie = %d", $_GET['id_categorie']);
        $resultProd = $connect->query($sqlProd);
        if($resultProd->num_rows > 0):
            $response['produits']['data'] = $resultProd->fetch_all(MYSQLI_ASSOC);
            $response['produits']['nb_hits'] = $resultProd->num_rows;
        else :
            $response['produits'] = 0;
        endif;
    else :
        $sql = "SELECT * FROM categories ORDER BY nom ASC";
        $response['response'] = "Toutes les catégories";
        // $nomDuArray est un array et dans les crochets c'est le type de reponse (mot invente)
        // après le = "c'est le texte qui sera affiché" --> chaîne de caractère
    endif;
    $result = $connect->query($sql);
    echo $connect-> error;
    $response['data'] = $result->fetch_all(MYSQLI_ASSOC);// $result est un objet et MYSQLI_ASSOC c'est pour dire qu'on utilise un array associatif
    $response['nb_hits'] = $result->num_rows;
endif; // END GET

 //IF METHOD POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') :
    //extraction de l'obectjson du paquet HTTP
    $json = file_get_contents('php://input');
    //décodag du format json, ça génère un obect php
    $arrayJSON = json_decode($json, true);
    $sql = sprintf("INSERT INTO categories SET nom='%s'",
        addslashes(addslashes($arrayJSON['nom']))//lire une propriété d'un objet PHP
// strip_tags retire le code html au cas où l'uilisateur utiliserait une balise
);
    $result = $connect->query($sql);
    echo $connect->error;
    $response['response'] = "Ajout d'une catégorie";
    $response['new_id'] = $connect->insert_id;
endif; //END POST
$response['code'] = (isset($response['code'])) ? $response['code'] : 200;
echo json_encode($response);