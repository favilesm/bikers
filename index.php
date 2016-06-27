<?php    
    require_once dirname( __FILE__ ).'/php/controller/SessionControllerClass.php';
    $session = new SessionController();
    $vista = "inicio.php";
            
    if(isset($_GET["vista"])) {
        switch($_GET["vista"]) {
            case "agregar": $vista = "agregar.php"; break;
            case "editar": $vista = "editar.php"; break;
            case "inicio": $vista = "inicio.php"; break;
            case "registro": $vista = "registro.php"; break;
            case "usuarios": $vista = "usuarios.php"; break;
            default: $vista = "404.php";break;            
        }
    }
?>
<!DOCTYPE html>
<html lang="es">

    <head>
<?php
	include dirname( __FILE__ )."/php/view/comun/metadata.php";
?> 
    </head>
    <body>        
<?php
	include dirname( __FILE__ )."/php/view/comun/header.php";          
        include dirname( __FILE__ )."/php/view/".$vista;
?>
        <br /><br /><br />
<?php        
        include dirname( __FILE__ )."/php/view/comun/footer.php";
?>	
    </body>
    
</html>
