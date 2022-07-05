<?php
header("Access-Control-Allow-Origin:*");
// j'autorise n'importe quel domaine à utiliser mon api
// on enlève cette première ligne si on veut utiliser ...

header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
//je precise les methodes que j'accepte

header("Content-Type:application/json");
//les retours que le serveur va faire sont en json

?>