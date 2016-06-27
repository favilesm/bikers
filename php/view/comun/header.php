<?php

    require_once dirname( __FILE__ ).'/../../controller/SessionControllerClass.php';

    $session = new SessionController();
?>
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Navegación</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php?vista=inicio">Inicio</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li>
                    <a href="index.php?vista=usuarios">Miembros</a>
                </li>
                <li>
                    <a href="index.php?vista=inicio#circuitos">Circuitos</a>
                </li>
                <li>
                    <a href="index.php?vista=inicio#contacto">Contacto</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
<?php
                if (!$session->isLogged()) {
?>
                    <li>
                        <a href="index.php?vista=agregar">Registro</a>
                    </li>
                    <li>
                        <a href="#" data-toggle="modal" data-target="#login-box">Acceso</a>
                    </li>
<?php
                } else {
?>
                    <li>
                        <a href="#">Bienvenid@ <?= $session->getNombreUsuario() ?></a>
                    </li>
                    <li>
                        <a id="cerrarSesion" href="">Cerrar Sesi&oacute;n</a>
                    </li>
<?php
                }
?>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>

<?php
    include dirname( __FILE__ )."/login.php";
?>