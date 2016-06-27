<?php

require_once dirname( __FILE__ ).'/../../controller/JSONControllerClass.php';

$jsonController = new JSONController();

if(isset($_GET["region"])) {
    echo $jsonController->getProvincias($_GET["region"]);
} else {
    echo $jsonController->getProvincias(null);
}

