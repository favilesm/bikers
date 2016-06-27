<?php
        
require_once dirname( __FILE__ ).'/../model/ClienteClass.php';
require_once dirname( __FILE__ ).'/../dao/ConexionClass.php';
require_once dirname( __FILE__ ).'/../dao/ClienteDAOClass.php';

class MiembrosController {
     
    /**
     *
     * @var Conexion
     */
    private $conexion; 
    
    /**
     *
     * @var ArrayObject
     */
    private $listaMiembros;
    
    /**
     *
     * @var ClienteDAOClass 
     */
    private $daoCliente;
    
    private $indicadorExito = false;
    private $indicadorError = false;
    private $mensajeExito = "";
    private $mensajeError = "";
    
    function __construct() {
        $this->conexion = new Conexion();
        $this->daoCliente = new ClienteDAOClass($this->conexion);
        $this->procesar();
    }

    function __destruct() {
        $this->conexion->closeConexion();
    }
    
    private function procesar() {
    
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            if(isset($_POST["operacion"]) && $_POST["operacion"]=="editar") {
                $this->procesarEditar();

            } else if(isset($_POST["operacion"]) && $_POST["operacion"]=="agregar") {
                $this->procesarAgregar();
                
            } else if(isset($_POST["operacion"]) && $_POST["operacion"]=="eliminar") {
                $this->procesarEliminar();            
            }
        }
        
       $this->listaMiembros = $this->procesarListar();
    }
    
    
    private function procesarAgregar() {
        $cliente = new Cliente();
        
        $cliente->setRut($_POST["id"]);
        $cliente->setNombre($_POST["nombre"]);
        $cliente->setApellido($_POST["apellido"]);
        $cliente->setEmail($_POST["email"]);
        $cliente->setTelefono($_POST["telefono"]);
        $cliente->setFechaNacimiento($_POST["fecha_nacimiento"]);

        if($this->daoCliente->agregar($cliente)) {            
            $this->indicadorExito = true;
            $this->mensajeExito = "El cliente se ha ingresado exitosamente";
        } else {
            $this->indicadorError = true;
            $this->mensajeError = "No se pudo ingresar el cliente";
        }
    }
    
    private function procesarEditar() {
        $cliente = new Cliente();
        
        $cliente->setRut($_POST["id"]);
        $cliente->setNombre($_POST["nombre"]);
        $cliente->setApellido($_POST["apellido"]);
        $cliente->setEmail($_POST["email"]);
        $cliente->setTelefono($_POST["telefono"]);
        $cliente->setFechaNacimiento($_POST["fecha_nacimiento"]);
        

        if($this->daoCliente->actualizar($cliente)) {
            $this->indicadorExito = true;
            $this->mensajeExito = "Los datos del cliente han sido actualizados exitosamente";
        } else {
            $this->indicadorError = true;
            $this->mensajeError = "No se pudo actualizar los datos del cliente";
        }
    }
    
    private function procesarEliminar() {
        $id = $_POST["rutCliente"];            

        if($this->daoCliente->eliminar($id)) {            
            $this->indicadorExito = true;
            $this->mensajeExito = "El cliente ha sido eliminado";
        } else {
            $this->indicadorError = true;
            $this->mensajeError = "No se pudo eliminar el cliente";
        } 
    }
    
    private function procesarListar() {        
        return $this->daoCliente->listar();    
    }
    
    function getListaMiembros() {
        return $this->listaMiembros;
    }

    function getMiembroPorId($rutMiembro) {
        return $this->daoCliente->buscarPorId($rutMiembro);
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