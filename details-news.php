<?php 
include 'config.php';
include 'headers.php';

require "verif_auth.php";


//myPrint_r($_GET);


 // IF METHOD GET
if($_SERVER['REQUEST_METHOD'] == 'GET') :
        $sql = sprintf("SELECT * FROM news WHERE id = %d",
            $_GET['id_news']
        );
        $result = $connect->query($sql);
        echo $connect->error;
    if($result->num_rows > 0) :
        $response['data'] = $result->fetch_all(MYSQLI_ASSOC);
        $response['response'] = "une news" .$_GET['id_news'];
    else :
        $response['response'] = "contenu non disponible";
        $response['code'] = 404;
    endif;
endif; // END GET

 //IF METHOD DELETE
if($_SERVER['REQUEST_METHOD'] == 'DELETE') :
    $sql = sprintf("DELETE FROM news WHERE id = %d",
            $_GET['id_news']
    );
    $connect->query($sql);
    echo $connect->error;
    $response['response'] = "Suppresion d'une news" . $_GET['id_news'];
endif; //END DELETE

 //IF METHOD PUT
if($_SERVER['REQUEST_METHOD'] == 'PUT') :
    //extraction de l'obectjson du paquet HTTP
    $json = file_get_contents('php://input');
    //décodag du format json, ça génère un obect php
    $arrayJSON = json_decode($json, true);
    $sql = sprintf("UPDATE news SET titre='%s', contenu='%s' WHERE id=%d",
        strip_tags(addslashes($arrayJSON['titre'])),//lire une propriété d'un objet PHP
        strip_tags(addslashes($arrayJSON['contenu'])),
        $_GET['id_news']
);
    $connect->query($sql);
    echo $connect->error;
    $response['new_data'] = $arrayJSON;
    $response['response'] = "Editer une news " . $_GET['id_news'];

endif; //END PUT

$response['code'] = (isset($response['code'])) ? $response['code'] : 200;


echo Json_encode($response);
exit;
?>
