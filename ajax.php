<?php    

    $vista = "error.php";
            
    if(isset($_GET["json"])) {
        switch($_GET["json"]) {
            case "autenticar": $vista = "autenticar.php"; break;
            case "cerrarSesion": $vista = "cerrarSesion.php"; break;
            case "comunas": $vista = "comunas.php"; break;
            case "provincias": $vista = "provincias.php"; break;
            case "regiones": $vista = "regiones.php"; break;
            default: $vista = "error.php";break;            
        }
    }
    
    include dirname( __FILE__ )."/php/view/json/".$vista;

