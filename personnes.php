<?php 
include 'config.php';
include 'headers.php';

 // IF METHOD GET
if($_SERVER['REQUEST_METHOD'] == 'GET') :
    if( isset($_GET['id_personnes'])) : 
        $sql = sprintf("SELECT * FROM personnes WHERE id_personnes = %d",
            $_GET['id_personnes']
        );
        $response['response'] = "One personne whith id" .$_GET['id_personnes'];
    else :
        $sql = "SELECT * FROM personnes ORDER BY nom, prenom ASC";
        $response['response'] = "All personnes";
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
    if( isset($_GET['id_personne'])) :
    $sql = sprintf("DELETE FROM personnes WHERE id_personnes=%d",
            $_GET['id_personnes']);
        $connect->query($sql);
    echo $connect->error;
    $response['response'] = "Suppresion personne id" . $_GET['id_personnes'];
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
    $sql = sprintf("INSERT INTO personnes SET nom='%s', prenom='%s'",
        addslashes($objectPOST->nom),//lire une propriété d'un objet PHP
        addslashes($objectPOST->prenom)
);
    $connect->query($sql);
    echo $connect->error;
    $response['response'] = "Ajout d'une personne";
    $response['new_id'] = $connect->insert_id;
endif; //END POST


 //IF METHOD PUT
if($_SERVER['REQUEST_METHOD'] == 'PUT') :
    //extraction de l'obect json du paquet HTTP
    $json = file_get_contents('php://input');
    //décodage du format json, ça génère un obect php
    $objectPOST = json_decode($json);
    // on vérifie si on met toutes les données
    if(isset($arrayPOST['nom']) AND isset($arrayPOST['prenom'])) :
        $sql = sprintf("UPDATE personnes SET nom='%s', prenom='%s' WHERE id_personnes=%d",
            addslashes($arrayPOST->nom),//lire une propriété d'un objet PHP
            addslashes($arrayPOST->prenom), //addslashes permet d'autorisé les apostrophes et ne pas confondre le simple quote
            $_GET['id_personnes']
    );
        $connect->query($sql);
        echo $connect->error;
        $response['response'] = "Editer une personne " . $_GET['id_personnes'];
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
