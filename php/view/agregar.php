<?php
    
    require_once dirname( __FILE__ ).'/../controller/UsuarioControllerClass.php';   
    require_once dirname( __FILE__ ).'/../controller/SessionControllerClass.php';
    
    $controller = new UsuarioController();
    $session = new SessionController();            

?>

    <script>

        jQuery(document).ready(function() {

            jQuery("#rutFormateadoAgregar").Rut({
                format_on: 'keyup'
            });

            jQuery("input[type='submit']").click(function(event){
                           // validar el RUT
                var rutFormateadoAgregar = jQuery("#rutFormateadoAgregar").val();
                
                if(!jQuery.Rut.validar(rutFormateadoAgregar)) {
                    // el rut no es válido
                    jQuery("#login-error-box b").text("El RUT ingresado no es válido");
                    jQuery("#login-error-box").removeClass("hidden"); 
                    
                    return;
                }
                // recuperar los valores de los campos del formulario
                var rutAgregar = jQuery.Rut.quitarFormato(rutFormateadoAgregar);
                var mantisa = rutAgregar.substr(0,rutAgregar.length -1);
                rutAgregar = mantisa;
                  
                // enlazar una funcion a ejecutar cuando la peticion ajax se termine
                ajaxRequest.done(function(jsonResponse){
                    var respuesta = JSON.parse(jsonResponse);

                    if(!respuesta.autenticado) {
                        jQuery("#login-error-box b").text(respuesta.motivo);
                        jQuery("#login-error-box").removeClass("hidden");                        
                    } else {
                        jQuery("#login-error-box").addClass("hidden");
                        jQuery("#login-success-box").removeClass("hidden");
                        jQuery("#login-box .modal-footer").addClass("hidden");
                        jQuery("body").fadeOut(2000, function(){                            
                        window.location.reload();
                        });                     
                    }
                });   
            });

            jQuery.getJSON("ajax.php?json=regiones",{},function(jsonResponse){
                jQuery.each(jsonResponse, function(clave, valor){                        
                    //console.log("<option value=\""+valor.codigo+"\">"+valor.nombre+"</option>\n");
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
            
        })

    </script>
  
    <div class="container">
<?php        
   
?>
            <header>
                <h1>Agregar Usuario</h1>
            </header>

            <div class="ajax-loading">
                <img src="img/ajax-loader.gif" />
            </div>
            
            <section>
                
                <form action="index.php?vista=usuarios" method="POST" class="form-horizontal" role="form">
                    <fieldset>
                        <legend>Datos del Nuevo Miembro</legend>
                        <input type="hidden" name="operacion" value="agregar" />
                        
                        <div class="form-group-sm has-feedback">
                            <div class="col-sm-4">
                               <label for="rutFormateadoAgregar">RUT</label>
                               <input id="rutFormateadoAgregar" type="text" name="rutFormateadoAgregar" class="form-control" maxlength="12"/>
                               <input id="rutAgregar" type="hidden" name="rutAgregar" class="form-control"/>
                                <span class="glyphicon glyphicon-ok form-control-feedback hidden"></span>
                                <span class="glyphicon glyphicon-remove form-control-feedback hidden"></span>
                            </div>                    
                            <div class="col-sm-4">
                                <label for="nombre">Nombre</label>
                                <input required id="nombre" class="form-control" type="text" name="nombre" value="" />
                            </div>
                            <div class="col-sm-4">
                                <label for="apellidoPaterno">Apellido Paterno</label>
                                <input required id="apellidoPaterno" class="form-control" type="text" name="apellidoPaterno" value="" />
                            </div>
                        </div>
                        
                        <div class="form-group-sm">
                            <div class="col-sm-4">
                                <label for="apellidoMaterno">Apellido Materno</label>
                                <input required id="apellidoMaterno" class="form-control" type="text" name="apellidoMaterno" value="" />
                            </div>
                            <div class="col-sm-4">
                                <label for="email">E-Mail</label>
                                <input required id="email" class="form-control" type="email" name="email" value="" />
                            </div>
                            <div class="col-sm-4">
                                <label for="fechanacimiento">Fecha de Nacimiento</label>
                                <input required id="fechanacimiento" class="form-control" type="date" name="fecha_nacimiento" value="" />
                            </div>
                        </div>
                        
                        <div class="form-group-sm">
                            <div class="col-sm-12">
                                <label>Comuna de residencia</label>
                                <div class="col-sm-12">                            
                                   <div class="col-sm-4">
                                       <select name="region" class="form-control">
                                           <option value="">-- Seleccione una Región --</option>
                                       </select>
                                   </div>
                                   <div class="col-sm-4">
                                       <select name="provincia" class="form-control">
                                           <option value="">-- Seleccione una Provincia --</option>
                                       </select>
                                   </div>
                                   <div class="col-sm-4">
                                       <select name="comuna" class="form-control">
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
                                    <input type="radio" id="sexom" name="sexo" value="M" checked />
                                    <label for="sexom">Masculino</label>  
                                </div>
                                <div class="col-sm-12">
                                    <input type="radio" id="sexof" name="sexo" value="F" />
                                    <label for="sexof">Femenino</label>
                                </div>
                            </div>
                            <?php
                                   if($session->isAdministrador()) {   
                            ?>
                                <div class="col-sm-3">
                                    <label>Perfil</label> 
                                    <div class="col-sm-12">
                                        <input type="radio" id="admin" name="perfil" value="admin"  />
                                        <label for="admin">Administrador</label>  
                                    </div>
                                    <div class="col-sm-12">
                                        <input type="radio" id="usuario" name="perfil" value="usuario" checked />
                                        <label for="usuario">Usuario</label>
                                    </div>
                                    <div class="col-sm-12">
                                        <input type="radio" id="editor" name="perfil" value="editor" />
                                        <label for="editor">Editor</label>  
                                    </div>
                                    <div class="col-sm-12">
                                        <input type="radio" id="publicador" name="perfil" value="publicador" />
                                        <label for="publicador">Publicador</label>  
                                    </div>
                                </div>
                            <?php 
                                   }
                            ?>
                            
                            
                            

                            <div class="col-sm-3"></div>
                        </div>        
                        
                        <div class="form-group-sm col-sm-12">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-3">
                                <label for="clave">Contraseña</label>
                                <input required id="clave" class="form-control" type="password" name="clave" value="" /> 
                            </div>
                            <div class="col-sm-3">
                                <label for="clave2">Repetir Contraseña</label>
                                <input required id="clave2" class="form-control" type="password" name="clave2" value="" />
                            </div>
                            <div class="col-sm-3"></div>
                        </div>
                        
                    </fieldset>
                  
                    <br />
                    
                    <div class="form-group-sm text-center">
                        <input class="btn btn-default" type="button" name="cancelar" value="Cancelar" onclick="location.href='index.php?vista=usuarios'" />
                        <input class="btn btn-primary" type="submit" name="guardar" value="Guardar" />
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
            
    </div>        
        