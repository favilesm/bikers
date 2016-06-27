<?php    
    require_once dirname( __FILE__ ).'/../controller/SessionControllerClass.php';
    $session = new SessionController();
?>
    <!-- Image Background Page Header -->
    <!-- Note: The background image is set within the business-casual.css file. -->
    <header class="business-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="tagline">Bikers</h1>
                </div>
            </div>
        </div>
    </header>

    <!-- Page Content -->
    <div class="container">

        <hr>

        <div class="row">
            <div class="col-sm-8">
                <h2>¿Qué nos mueve?</h2>
                <p>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
				</p>
                <p>
                    <a class="btn btn-default btn-lg" href="index.php?vista=registro">Regístrate &raquo;</a>
                </p>
            </div>
            <div class="col-sm-4" id="contacto">
                <h2>Contacto</h2>
                <address>
                    <strong>Av. Qwerty Asdf</strong>
                    <br>Lorem ipsum 1234
                    <br>Región Metropolitana. Santiago
                    <br>
                </address>
                <address>
                    <abbr title="Phone">P:</abbr>(+56 9) 1234-5678
                    <br>
                    <abbr title="Email">E:</abbr> <a href="mailto:#">lorem.ipusm@asdf.cl</a>
                </address>
            </div>
        </div>
        <!-- /.row -->

        <hr>

        <div class="row" id="circuitos">
            <div class="col-sm-4">
                <img class="img-circle img-responsive img-center" src="img/foto-1.jpg" alt="">
                <h2>Circuito #1</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>
            <div class="col-sm-4">
                <img class="img-circle img-responsive img-center" src="img/foto-2.jpg" alt="">
                <h2>Circuito #2</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>
            <div class="col-sm-4">
                <img class="img-circle img-responsive img-center" src="img/foto-3.jpg" alt="">
                <h2>Circuito #3</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            </div>
        </div>
       
    </div>

</body>

</html>
