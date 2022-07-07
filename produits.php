<?php 
include 'config.php';
include 'headers.php';
//require "verif_auth.php";

 // IF METHOD GET
if($_SERVER['REQUEST_METHOD'] == 'GET') :
    if( isset($_GET['id_produit'])) : 
        $sql = sprintf("SELECT * FROM produits_categories WHERE id_produit = %d",
            $_GET['id_produit']
        );
        $response['response'] = "Un produit avec id " .$_GET['id_produit'];
    else :
        $sql = "SELECT * FROM produits_categories ORDER BY nom ASC";
        $response['response'] = "Tous les produits";
        // $nomDuArray est un array et dans les crochets c'est le type de reponse (mot invente)
        // après le = "c'est le texte qui sera affiché" --> chaîne de caractère
    endif;
    $result = $connect->query($sql);
    echo $connect-> error;
    $response['data'] = $result->fetch_all(MYSQLI_ASSOC);// $result est un objet et MYSQLI_ASSOC c'est pour dire qu'on utilise un array associatif
    $response['nb_hits'] = $result->num_rows;
endif; // END GET


 //IF METHOD DELETE
if($_SERVER['REQUEST_METHOD'] == 'DELETE') :
    if( isset($_GET['id_produit'])) :
    $sql = sprintf("DELETE FROM produits WHERE id_produit=%d",
            $_GET['id_produit']);
        $connect->query($sql);
    echo $connect->error;
    $response['response'] = "Suppresion d'un produit" . $_GET['id_produit'];
    else : 
        $response['response'] = "il manque l'id";
        $response['code'] = 500;
    endif;
endif; //END DELETE


 //IF METHOD POST
if($_SERVER['REQUEST_METHOD'] == 'POST') :
    //extraction de l'obect json du paquet HTTP
    $json = file_get_contents('php://input');
    //décodage du format json, ça génère un obect php
    $objectPOST = json_decode($json);
    $sql = sprintf("INSERT INTO produits SET nom='%s', prix='%s', id_categorie='%s'",
        strip_tags($objectPOST->nom),//lire une propriété d'un objet PHP
        strip_tags($objectPOST->prix),
        strip_tags($objectPOST->id_categorie)
);
    $connect->query($sql);
    echo $connect->error;
    $response['response'] = "Ajout d'un produit";
    $response['new_id'] = $connect->insert_id;
endif; //END POST


 //IF METHOD PUT
if($_SERVER['REQUEST_METHOD'] == 'PUT') :
    //extraction de l'obect json du paquet HTTP
    $json = file_get_contents('php://input');
    //décodage du format json, ça génère un obect php
    $objectPOST = json_decode($json);
    // on vérifie si on met toutes les données
    if(isset($objectPOST->nom) AND isset($objectPOST->prenom)) :
        $sql = sprintf("UPDATE produits SET nom='%s', prix='%s',id_categorie=%d  WHERE id_personnes=%d",
            addslashes($objectPOST->nom),//lire une propriété d'un objet PHP
            addslashes($objectPOST->prenom), //addslashes permet d'autorisé les apostrophes et ne pas confondre le simple quote
            $_GET['id_produit']
    );
        $connect->query($sql);
        echo $connect->error;
        $response['response'] = "Editer un produit " . $_GET['id_produit'];
    else : // s'il manque des données
        $response['response'] = "Il manque des données ";
        $response['code']  = 500;
    endif;
endif; //END PUT



$response['code'] = (isset($response['code'])) ? $response['code'] : 200;
$response['time'] = date('Y-m-d,H:i:s');

echo Json_encode($response);
// on converti en JSON

?>
