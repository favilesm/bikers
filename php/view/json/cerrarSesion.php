<?php

require_once dirname( __FILE__ ).'/../../controller/JSONControllerClass.php';

$jsonController = new JSONController();

echo $jsonController->cerrarSesion();