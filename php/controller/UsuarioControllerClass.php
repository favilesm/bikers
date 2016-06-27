<?php
        
require_once dirname( __FILE__ ).'/../model/UsuarioClass.php';
require_once dirname( __FILE__ ).'/../dao/ConexionClass.php';
require_once dirname( __FILE__ ).'/../dao/UsuarioDAOClass.php';
require_once dirname( __FILE__ ).'/../dao/ComunaDAOClass.php';

class UsuarioController {
     
    /**
     *
     * @var Conexion
     */
    private $conexion; 
    
    /**
     *
     * @var ArrayObject
     */
    private $listaUsuarios;
    
    /**
     *
     * @var UsuarioDAO 
     */
    private $daoUsuario;
    
    /**
     *
     * @var ComunaDAO 
     */
    private $daoComuna;
    
    private $indicadorExito = false;
    private $indicadorError = false;
    private $mensajeExito = "";
    private $mensajeError = "";
    private $perfilPredeterminado = "usuario";
    
    function __construct() {
        $this->conexion = new Conexion();
        $this->daoUsuario = new UsuarioDAO($this->conexion);
        $this->daoComuna = new ComunaDAO($this->conexion);
        $this->execute();
    }

    function __destruct() {
        $this->conexion->closeConexion();
    }
    
    private function execute() {
    
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            if(isset($_POST["operacion"]) && $_POST["operacion"]=="editar") {
                $this->actualizarUsuario();

            } else if(isset($_POST["operacion"]) && $_POST["operacion"]=="agregar") {
                $this->agregarUsuario();
                
            } else if(isset($_POST["operacion"]) && $_POST["operacion"]=="eliminar") {
                $this->eliminarUsuario();            
            }
        }
        
       $this->listaUsuarios = $this->listarUsuarios();
    }
    
    
    private function agregarUsuario() {     
        $perfil = null;
        if(isset($_POST["perfil"])) {
            $perfil = $this->perfilPredeterminado;
        }  
       try{
        $rut = substr ( $_POST["rutFormateadoAgregar"], 0, strlen( $_POST["rutFormateadoAgregar"]) - 1);;
        $rut = str_replace(".","",$rut);
        $rut = str_replace("-","",$rut);
        
        $usuario = new Usuario($rut,
                $_POST["nombre"],
                $_POST["apellidoPaterno"],
                $_POST["apellidoMaterno"],
                $_POST["fecha_nacimiento"],
                $_POST["sexo"] == "M",
                $_POST["clave"],
                $_POST["email"],
                $perfil,
                $_POST["comuna"],
                $_POST["provincia"],0,0,0);
 
            if(!$this->daoUsuario->buscarPorId($rut)){
                 if($this->daoUsuario->agregar($usuario)) {            
                    $this->indicadorExito = true;
                    $this->mensajeExito = "El cliente se ha ingresado exitosamente";
                 }else{
                    $this->indicadorError = true;
                    $this->mensajeError = "No se pudo ingresar el cliente, intente más tarde.";
                }
            }else{
                $this->indicadorError = true;
                $this->mensajeError = "Ya existe un usuario asociado al rut, favor verifíque";
                 return false;
            }
         }catch(Exception $e){
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
      
    }
    
    private function actualizarUsuario() {  
    try{   
        $usuario = $this->daoUsuario->buscarPorId($_POST["id"]);
        if(!$usuario) {
            $this->indicadorError = true;
            $this->mensajeError = "El usuario al que desea actualizar los datos no existe!";
            return false;
        }
        
        if(isset($_POST["nombre"])) {
            $usuario->setNombre($_POST["nombre"]);
        }
        
        if(isset($_POST["apellidoPaterno"])) {        
            $usuario->setApellidoPaterno($_POST["apellidoPaterno"]);
        }
        
        if(isset($_POST["apellidoMaterno"])) {  
            $usuario->setApellidoMaterno($_POST["apellidoMaterno"]);
        }
        
        if(isset($_POST["email"])) {  
            $usuario->setEmail($_POST["email"]);
        }
        
        if(isset($_POST["fecha_nacimiento"])) { 
            $usuario->setFechaNacimiento($_POST["fecha_nacimiento"]);        
        }
        
        if($_POST["sexo"] == "M") {
            $usuario->setSexoMasculino();
        } else {
            $usuario->setSexoFemenino();
        }
        
        if(isset($_POST["perfil"]) && !empty($_POST["perfil"])) {
            $usuario->setPerfil($_POST["perfil"]);
        } else {
            $usuario->setPerfil($this->perfilPredeterminado);
        }
        
        if(isset($_POST["comuna"]) && !empty($_POST["comuna"])) { 
            $comuna = $this->daoComuna->buscarPorId($_POST["comuna"]);
            $usuario->setComuna($comuna);
        }

        // si el formulario viene con una clave, entonce se actualiza
        if(isset($_POST["clave"]) && !empty($_POST["clave"])) {
            $usuario->setClave($_POST["clave"]);
        } else {
            // de lo contrario se setea nula para que se mantenga la existente            
            $usuario->setClave(null);
        }
        
        if($this->daoUsuario->actualizar($usuario)) {
            $this->indicadorExito = true;
            $this->mensajeExito = "Los datos del cliente han sido actualizados exitosamente";
        } else {
            $this->indicadorError = true;
            $this->mensajeError = "No se pudo actualizar los datos del cliente";
        }
        
    }catch(Exception $e){
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }
    
    private function eliminarUsuario() {
        $id = $_POST["rutCliente"];            
        
        if($this->daoUsuario->eliminar($id)) {            
            $this->indicadorExito = true;
            $this->mensajeExito = "El cliente ha sido eliminado";
        } else {
            $this->indicadorError = true;
            $this->mensajeError = "No se pudo eliminar el cliente";
        } 
    }
    
    private function listarUsuarios() {        
        return $this->daoUsuario->listar();    
    }
    
    function getListaUsuarios() {
        return $this->listaUsuarios;
    }

    function getUsuarioPorId($rut) {
        return $this->daoUsuario->buscarPorId($rut);
    }
    
    function getIndicadorExito() {
        return $this->indicadorExito;
    }

    function getIndicadorError() {
        return $this->indicadorError;
    }

    function getMensajeExito() {
        return $this->mensajeExito;
    }

    function getMensajeError() {
        return $this->mensajeError;
    }


}