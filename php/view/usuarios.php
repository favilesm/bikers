<?php
    
    require_once dirname( __FILE__ ).'/../controller/UsuarioControllerClass.php';   
    require_once dirname( __FILE__ ).'/../controller/SessionControllerClass.php';
    
    $controller = new UsuarioController();
    $session = new SessionController();            

?>
	<script>

                jQuery(document).ready(function(){

                        jQuery("button[name='agregar']").click(function(){
                                window.location.href = "index.php?vista=agregar";
                        });

                        jQuery("button[name='editar']").click(function(){
                                var idCliente = jQuery(this).data("id-cliente");
                                window.location.href = "index.php?vista=editar&rutCliente="+idCliente;
                        });                

                        jQuery("button[name='eliminar']").click(function(){
                                var idCliente = jQuery(this).data("id-cliente");
                                jQuery(".modal-footer input[name='rutCliente']").val(idCliente);
                        });

                        jQuery(".table tbody tr td:first-child").each(function() { 
                            var mantisa = jQuery(this).text();
                            var rut = mantisa +'-'+ jQuery.Rut.getDigito(mantisa)
                            var rutFormateado = jQuery.Rut.formatear(rut,true);
                            jQuery(this).text(rutFormateado);
                        }); 

                })            

        </script>

        <!-- Page Content -->
        <div class="container">

            <hr>

                <header>
                    <h1>Listado de Miembros</h1>
                </header>

    <?php
            if($controller->getIndicadorExito()) {
    ?>            
                <div class="alert alert-success fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <b><?= $controller->getMensajeExito() ?></b>
                </div>
    <?php
            }
    ?>     

    <?php 
            if($controller->getIndicadorError()) {
    ?>            
                <div class="alert alert-danger fade in">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <b><?= $controller->getMensajeError() ?></b>
                </div>
    <?php 
            }
    ?>               
                <section>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>RUT</th>
                                <th>Nombre</th>
                                <th>Apellido Paterno</th>
                                <th>Apellido Materno</th>
                                <th>E-Mail</th>
                                <th>Comuna</th>
                                <th>Provincia</th>
                                <th>Fecha de Nacimiento</th>
                                <th>
    <?php							
            if($session->isEditor() || $session->isAdministrador()) {
    ?>
                                    Acción
    <?php		
            }
    ?>	
                                                            </th>
                            </tr>
                        </thead>
                        <tbody>
    <?php
        foreach ($controller->getListaUsuarios() as $miembro) {
            /* @var $miembro Usuario */
    ?>        
                            <tr>
                                <td><?= $miembro->getRut() ?></td>
                                <td><?= $miembro->getNombre() ?></td>
                                <td><?= $miembro->getApellidoPaterno() ?></td>
                                <td><?= $miembro->getApellidoMaterno() ?></td>
                                <td><?= $miembro->getEmail() ?></td>
                                <td><?= $miembro->getComuna() ?></td>
                                <td><?= $miembro->getProvincia() ?></td>
                                <td><?= $miembro->getFechaNacimiento() ?></td>
                                <td>

    <?php
        if($session->isEditor() || $session->isAdministrador()) {
    ?>                                
                                    <button class="btn btn-primary" name="editar" data-id-cliente="<?= $miembro->getRut() ?>">
                                        <span class="glyphicon glyphicon-pencil"></span>
                                    </button>
    <?php
        }

        if($session->isAdministrador()) {
    ?>                                 
                                    <button class="btn btn-danger" name="eliminar" data-id-cliente="<?= $miembro->getRut() ?>"  data-toggle="modal" data-target="#confirmarEliminar" >
                                        <span class="glyphicon glyphicon-remove"></span>
                                    </button>  
    <?php
        }
    ?>                                 
                                </td>
                            </tr>
    <?php
        }
    ?>    
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="7">
    <?php
        if($session->isPublicador() || $session->isAdministrador()) {
    ?>                                
                                    <button class="btn btn-primary" name="agregar" >
                                        <span class="glyphicon glyphicon-plus"></span>
                                    </button>  
    <?php
        }
    ?>    
                                </td>
                            </tr>
                        </tfoot>

                        </tbody>
                    </table>


                    <div class="modal fade" id="confirmarEliminar" role="dialog">
                        <div class="modal-dialog">
                          <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Eliminar Usuario</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="alert alert-danger">
                                        ¿Está seguro de eliminar el usuario?
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <form method="POST" action="index.php?vista=usuarios">
                                        <input type="hidden" name="operacion" value="eliminar" />
                                        <input type="hidden" name="rutCliente" value="" />
                                        <input name="confirmacionEliminar" type="submit" class="btn btn-default"  value="Si" />
                                        <input type="button" class="btn btn-primary"  data-dismiss="modal" value="No" />
                                    </form>                                
                                </div>
                            </div>
                        </div>
                    </div>

                </section>
        </div>