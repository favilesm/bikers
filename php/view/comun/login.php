
<div class="modal fade" id="login-box" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Acceso usuarios</h4>
            </div>
            <div class="modal-body">
                <form class="form">
                    <div class="form-group">
                        <label for="rutFormateado">RUT</label>
                        <input id="rutFormateado" type="text" name="rutFormateado" class="form-control" maxlength="12"/>
                        <input id="rut" type="hidden" name="rut" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="clave">Clave</label>
                        <input id="clave" type="password" name="clave" class="form-control" />
                    </div>
                    <div id="login-error-box" class="alert alert-danger fade in hidden">
                        <img src="img/chuck-norris-rejected.png" style="width:80px;" />
                        <b>Mensaje de error</b>                        
                    </div>
                    <div id="login-success-box" class="alert fade in text-center hidden">
                        <img src="img/chuck-norris-approved.png" style="width:200px;" />            
                    </div>
                </form>
            </div>
            <div class="modal-footer">                                
                <input type="button" class="btn btn-default"  data-dismiss="modal" value="Cancelar" />                           
                <input id="btn-autenticar" type="button" class="btn btn-primary"  data-dismiss="modal" value="Aceptar" />                           
            </div>
        </div>
    </div>
</div>

<script>
        
        jQuery(document).ready(function(){
            jQuery("body").css('display', 'none');
            jQuery('body').fadeIn(1000);
            
            jQuery("#rutFormateado").Rut({
                format_on: 'keyup'
            });
            
            // evento click para el enlace de cerrar sesión
            jQuery("#cerrarSesion").click(function(event){
                event.preventDefault();
                
                jQuery.getJSON("ajax.php?json=cerrarSesion",{},function(){
                    jQuery("body").fadeOut(1000, function(){
                        window.location.href = "index.php";
                    });                    
                })
            })            
            
            // evento click para el enlace de acceder a autenticarse
            jQuery("#btn-autenticar").click(function(event){
                
                //evitar que se cierre la ventana modal (popup)
                jQuery(this).removeAttr("data-dismiss");
                
                // validar el RUT
                var rutFormateado = jQuery("#rutFormateado").val();
                
                if(!jQuery.Rut.validar(rutFormateado)) {
                    // el rut no es válido
                    jQuery("#login-error-box b").text("El RUT ingresado no es válido");
                    jQuery("#login-error-box").removeClass("hidden"); 
                    
                    return;
                }
                
                // recuperar los valores de los campos del formulario
                var rut = jQuery.Rut.quitarFormato(rutFormateado);
                var mantisa = rut.substr(0,rut.length -1);
                var password = jQuery("#clave").val();
                
                // realizar la llamada asincrona con ajax
                var ajaxRequest = jQuery.ajax({url:"ajax.php?json=autenticar", method:"POST", data:{rut:mantisa,clave:password}});
                
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
        });
    
</script>