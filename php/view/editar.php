<?php
    
    require_once dirname( __FILE__ ).'/../controller/UsuarioControllerClass.php';   
    require_once dirname( __FILE__ ).'/../controller/SessionControllerClass.php';
    require_once dirname( __FILE__ ).'/../dao/UsuarioDAOClass.php'; 
    
    $controller = new UsuarioController();
    $session = new SessionController(); 
    
    if(isset($_GET["rutCliente"])) {
        $rut = $_GET["rutCliente"];
        
        /* @var $usuario Usuario */
        $usuario = $controller->getUsuarioPorId($rut);
        //echo 'perfil->'.$usuario->getPerfil();
    }
   
?>  

        <script>

            jQuery(document).ready(function() {
                jQuery("input[name='rut']").each(function() { 
                        var mantisa = jQuery(this).val();
                        var rut = mantisa +'-'+ jQuery.Rut.getDigito(mantisa)
                        var rutFormateado = jQuery.Rut.formatear(rut,true);
                        jQuery(this).val(rutFormateado);
                });
            })

        </script>
        
    <script>
        jQuery(document).ready(function() {
             jQuery("input[type='submit']").click(function(event){
              
                 if($('#claveEditar').val()!=$('#claveEditar2').val()){
                    alert('Las contraseñas no coinciden.');
                    return false;
                 }
                    $claveOculta = $('#claveOculta').val();
                    return true;
                 
            });
            
            //logica para carga de datos en combos dependientes
            jQuery.getJSON("ajax.php?json=regiones",{},function(jsonResponse){
                jQuery.each(jsonResponse, function(clave, valor){                        
                    jQuery("<option>").attr("value",valor.codigo).text(valor.nombre).appendTo("select[name='region']");
                })
            });

            jQuery("select[name='region']").change(function(){
                jQuery("div.ajax-loading").css("visibility","visible");
                var codigoRegion = jQuery(this).val();
                jQuery("select[name='provincia'] option").remove();
                jQuery("<option>").attr("value","").text("-- Seleccione una Provincia --").appendTo("select[name='provincia']");
                
                jQuery("select[name='comuna'] option").remove();
                jQuery("<option>").attr("value","").text("-- Seleccione una Comuna --").appendTo("select[name='comuna']");

                jQuery.getJSON("ajax.php?json=provincias", {region:codigoRegion}, function(jsonResponse){
                    jQuery.each(jsonResponse, function(clave, valor){ 
                        //console.log("<option value=\""+valor.codigo+"\">"+valor.nombre+"</option>\n");
                        jQuery("<option>").attr("value",valor.codigo).text(valor.nombre).appendTo("select[name='provincia']");
                    });

                    jQuery("div.ajax-loading").css("visibility","hidden");
                });
            });
            
             jQuery("select[name='provincia']").change(function(){
                jQuery("div.ajax-loading").css("visibility","visible");
                var codigoProvincia = jQuery(this).val();
                jQuery("select[name='comuna'] option").remove();
                jQuery("<option>").attr("value","").text("-- Seleccione una Comuna --").appendTo("select[name='comuna']");

                jQuery.getJSON("ajax.php?json=comunas", {provincia:codigoProvincia}, function(jsonResponse){
                    jQuery.each(jsonResponse, function(clave, valor){ 
                        //console.log("<option value=\""+valor.codigo+"\">"+valor.nombre+"</option>\n");
                        jQuery("<option>").attr("value",valor.codigo).text(valor.nombre).appendTo("select[name='comuna']");
                    });

                    jQuery("div.ajax-loading").css("visibility","hidden");
                });
            });
            
            // $('#region > option').eq(5).attr('selected','selected')
            // $("#region").prop("selectedIndex", 5); 
        })

    </script>
  
    <div class="container">
<?php        
        if($session->isPublicador() || $session->isAdministrador()) {        
?>
    
		
            <header>
                <h1>Editar Usuario</h1>
            </header>

            <div class="ajax-loading">
                <img src="img/ajax-loader.gif" />
            </div>
            
            <section>
                
                <form action="index.php?vista=usuarios" method="POST" class="form-horizontal" role="form" name="editar-form">
                    <fieldset>
                        <legend>Datos del Usuario</legend>
                        <input type="hidden" name="operacion" value="editar" />
                        
                        <div class="form-group-sm has-feedback">
                            <div class="col-sm-4">
                                 <label for="idcliente">RUT</label>
                                <input class="form-control" type="hidden" name="id" value="<?= $usuario->getRut() ?>" />
                                <input id="idcliente" readonly class="form-control" type="text" name="rut" value="<?= $usuario->getRut() ?>" />
                            </div>                    
                            <div class="col-sm-4">
                                <label for="nombre">Nombre</label>
                                <input required id="nombre" class="form-control" type="text" name="nombre" value="<?= $usuario->getNombre() ?>" />
                            </div>
                            <div class="col-sm-4">
                                <label for="apellidoPaterno">Apellido Paterno</label>
                                <input required id="apellidoPaterno" class="form-control" type="text" name="apellidoPaterno" value="<?= $usuario->getApellidoPaterno() ?>" />
                            </div>
                        </div>
                        
                        <div class="form-group-sm">
                            <div class="col-sm-4">
                                <label for="apellidoMaterno">Apellido Materno</label>
                                <input required id="apellidoMaterno" class="form-control" type="text" name="apellidoMaterno" value="<?= $usuario->getApellidoMaterno() ?>" />
                            </div>
                            <div class="col-sm-4">
                                <label for="email">E-Mail</label>
                                <input required id="email" class="form-control" type="email" name="email" value="<?= $usuario->getEmail() ?>" />
                            </div>
                            <div class="col-sm-4">
                                <label for="fechanacimiento">Fecha de Nacimiento</label>
                                <input required id="fechanacimiento" class="form-control" type="date" name="fecha_nacimiento" value="<?= $usuario->getFechaNacimiento() ?>" />
                            </div>
                        </div>
                        
                        <div class="form-group-sm">
                            <div class="col-sm-12">
                                <label>Comuna de residencia</label>
                                <div class="col-sm-12">                            
                                   <div class="col-sm-4">
                                       <select name="region" class="form-control" required="true">
                                           <option value="">-- Seleccione una Región --</option>
                                       </select>
                                   </div>
                                   <div class="col-sm-4">
                                       <select name="provincia" class="form-control" required="true">
                                           <option value="">-- Seleccione una Provincia --</option>
                                       </select>
                                   </div>
                                   <div class="col-sm-4">
                                       <select name="comuna" class="form-control" required="true">
                                           <option value="">-- Seleccione una Comuna --</option>
                                       </select>
                                   </div>                            
                                </div>
                            </div>  
                        </div>
                        
                        

                        <div class="form-group-sm col-sm-12">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-3">                                
                                <label>Sexo</label> 
                                <div class="col-sm-12">
                                    <input type="radio" id="sexom" name="sexo" value="M" <?= ($usuario->isHombre())?"checked":"" ?> />
                                    <label for="sexom">Masculino</label>  
                                </div>
                                <div class="col-sm-12">
                                    <input type="radio" id="sexof" name="sexo" value="F" <?= ($usuario->isMujer())?"checked":"" ?> />
                                    <label for="sexof">Femenino</label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <label>Perfil</label> 
                                <div class="col-sm-12">
                                    <input type="radio" id="admin" name="perfil" value="admin" <?= ($usuario->getPerfil()=="admin")?"checked":"" ?>  />
                                    <label for="admin">Administrador</label>  
                                </div>
                                <div class="col-sm-12">
                                    <input type="radio" id="usuario" name="perfil" value="usuario" <?= ($usuario->getPerfil()=="usuario")?"checked":"" ?> />
                                    <label for="usuario">Usuario</label>
                                </div>
                                <div class="col-sm-12">
                                    <input type="radio" id="editor" name="perfil" value="editor" <?= ($usuario->getPerfil()=="editor")?"checked":"" ?>  />
                                    <label for="editor">Editor</label>  
                                </div>
                                <div class="col-sm-12">
                                    <input type="radio" id="editor" name="perfil" value="publicador" <?= ($usuario->getPerfil()=="publicador")?"checked":"" ?>  />
                                    <label for="publicador">Publicador</label>  
                                </div>
                            </div>
                            <div class="col-sm-3"></div>
                        </div>        
                        
                        <div class="form-group-sm col-sm-12">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-3">
                                <label for="clave">Contraseña</label>
                                <input id="claveEditar" class="form-control" type="password" name="claveEditar" value="" /> 
                                <input id="claveOculta" class="form-control" type="hidden" name="claveOculta" value="<?= $usuario->getClave() ?>"/>
                            </div>
                            <div class="col-sm-3">
                                <label for="clave2">Repetir Contraseña</label>
                                <input id="claveEditar2" class="form-control" type="password" name="claveEditar2" value="" />
                            </div>
                            <div class="col-sm-3"></div>
                        </div>
                        
                    </fieldset>
                  
                    <br />
                    
                    <div class="form-group-sm text-center">
                        <input class="btn btn-default" type="button" name="cancelar" value="Cancelar" onclick="location.href='index.php?vista=usuarios'" />
                        <input class="btn btn-primary" type="submit" name="guardar" value="Guardar"  />
                    </div>
                </form>
                
                <div class="modal fade" id="mostrar-errores" role="dialog">
                    <div class="modal-dialog">
                      <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Agregar Miembro</h4>
                            </div>
                            <div class="modal-body">
                                <div class="alert alert-danger">
                                    <p>El RUT no es válido</p>
                                </div>
                            </div>
                            <div class="modal-footer">                                
                                <input type="button" class="btn btn-primary"  data-dismiss="modal" value="Aceptar" />                           
                            </div>
                        </div>
                    </div>
                </div>
                
            </section>
            

<?php
        } else {
?>

            <div class="alert alert-danger fade in">				
                <b>Error: </b> usted no dispone de privilegios para acceder a esta página.
            </div>
<?php 
        }
?>
    </div>        
        