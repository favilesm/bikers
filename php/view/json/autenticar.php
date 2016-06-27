<?php

require_once dirname( __FILE__ ).'/../../controller/JSONControllerClass.php';

$jsonController = new JSONController();

if(isset($_POST["rut"]) && isset($_POST["clave"])) {    
    echo $jsonController->autenticar($_POST["rut"], $_POST["clave"]);
} else {
    echo json_encode(["autenticado"=>false, "motivo"=>"Faltan campos requeridos"]);
}