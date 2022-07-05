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
    endif;


    $result = $connect->query($sql);
    echo $connect-> error;

    $response['data'] = $result->fetch_all(MYSQLI_ASSOC);
    $response['nb_hits'] = $result->num_rows;
endif; // END GET

 //IF METHOD DELETE
if($_SERVER['REQUEST_METHOD'] == 'DELETE') :
    $sql = sprintf("DELETE FROM personnes WHERE id_personnes=%d",
            $_GET['id_personnes']);
        $connect->query($sql);
    echo $connect->error;
    $response['response'] = "Suppresion personne id" . $_GET['id_personnes'];
endif; //END DELETE

 //IF METHOD POST
if($_SERVER['REQUEST_METHOD'] == 'POST') :
    //extraction de l'obectjson du paquet HTTP
    $json = file_get_contents('php://input');
    //décodag du format json, ça génère un obect php
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
    //extraction de l'obectjson du paquet HTTP
    $json = file_get_contents('php://input');
    //décodag du format json, ça génère un obect php
    $objectPOST = json_decode($json);
    $sql = sprintf("UPDATE personnes SET nom='%s', prenom='%s' WHERE id_personnes=%d",
        addslashes($objectPOST->nom),//lire une propriété d'un objet PHP
        addslashes($objectPOST->prenom),
        $_GET['id_personnes']
);
    $connect->query($sql);
    echo $connect->error;
    $response['response'] = "Editer une personne " . $_GET['id_personnes'];

endif; //END PUT

$response['code'] = 200;
$response['time'] = date('Y-m-d,H:i:s');

echo Json_encode($response);

?>
