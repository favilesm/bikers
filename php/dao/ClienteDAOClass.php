<?php

require_once dirname( __FILE__ ).'/ConexionClass.php';
require_once dirname( __FILE__ ).'/../model/ClienteClass.php';

/**
 * Description of ClienteDAOClass
 *
 * @author Cetecom
 */
class ClienteDAOClass {
    
    /**
     *
     * @var Conexion
     */
    private $conexion;
    
    function __construct($conexion) {
        $this->conexion = $conexion;
    }

    
    function buscarPorId($idCliente) {
        $consulta_preparada = $this->conexion->getConexion()->prepare("SELECT rut, nombre, apellido, email, telefono, fecha_nacimiento FROM cliente WHERE rut = ?");
        $consulta_preparada->bind_param("i", $idCliente);
        $consulta_preparada->execute();
        $consulta_preparada->bind_result($id, $nombre, $apellido, $email, $telefono, $fechaNacimiento);
        $ok = $consulta_preparada->fetch();
        
        if(!$ok) {
            return false;
        }
        
        $cliente = new Cliente();

        $cliente->setRut($id);
        $cliente->setNombre($nombre);
        $cliente->setApellido($apellido);
        $cliente->setEmail($email);
        $cliente->setTelefono($telefono);
        $cliente->setFechaNacimiento($fechaNacimiento);
        
        return $cliente;
    }
    
    function agregar($cliente) {
        /* @var $cliente Cliente */
        
        $id = $cliente->getRut();
        $nombre = $cliente->getNombre();
        $apellido = $cliente->getApellido();
        $email = $cliente->getEmail();
        $telefono = $cliente->getTelefono();
        $fechaNacimiento = $cliente->getFechaNacimiento();
        
        
        $consulta_preparada = $this->conexion->getConexion()->prepare("INSERT INTO cliente VALUES(?, ?, ?, ?, ?, ?)");            
        $consulta_preparada->bind_param("isssis", $id, $nombre,$apellido, $email, $telefono, $fechaNacimiento);

        return $consulta_preparada->execute();
    }
    
    function actualizar($cliente) {
        /* @var $cliente Cliente */
        
        $id = $cliente->getRut();
        $nombre = $cliente->getNombre();
        $apellido = $cliente->getApellido();
        $email = $cliente->getEmail();
        $telefono = $cliente->getTelefono();
        $fechaNacimiento = $cliente->getFechaNacimiento();
        
        $consulta_preparada = $this->conexion->getConexion()->prepare("UPDATE cliente SET nombre=?, apellido=?, email=?, telefono=?, fecha_nacimiento=? WHERE rut = ?");            
        $consulta_preparada->bind_param("sssisi", $nombre,$apellido, $email, $telefono, $fechaNacimiento, $id);
        
        return $consulta_preparada->execute();
    }
    
    function eliminar($idCliente) {
        $consulta_preparada = $this->conexion->getConexion()->prepare("DELETE FROM cliente WHERE rut = ?");
        $consulta_preparada->bind_param("i", $idCliente);
        
        return $consulta_preparada->execute();
    }
    
    function listar() {
        $resultado = $this->conexion->getConexion()->query("SELECT rut, nombre, apellido, email, telefono, fecha_nacimiento FROM cliente");
        
        $listadoClientes = Array();
                
        while($fila = $resultado->fetch_array()) {
            $cliente = new Cliente();

            $cliente->setRut($fila["rut"]);
            $cliente->setNombre($fila["nombre"]);
            $cliente->setApellido($fila["apellido"]);
            $cliente->setEmail($fila["email"]);
            $cliente->setTelefono($fila["telefono"]);
            $cliente->setFechaNacimiento($fila["fecha_nacimiento"]);
            
            array_push($listadoClientes,$cliente);

        }
        
        return $listadoClientes;
    }
}
