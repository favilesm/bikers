<?php

require_once dirname( __FILE__ ).'/../../controller/JSONControllerClass.php';

$jsonController = new JSONController();

if(isset($_GET["provincia"])) {
    echo $jsonController->getComunas($_GET["provincia"]);
} else {
    echo $jsonController->getComunas(null);
}

