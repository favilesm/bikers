<?php

require_once dirname( __FILE__ ).'/ConexionClass.php';
require_once dirname( __FILE__ ).'/../dao/ComunaDAOClass.php';
require_once dirname( __FILE__ ).'/../model/UsuarioClass.php';


class UsuarioDAO {
    
    /**
     *
     * @var Conexion
     */
    private $conexion;
    
    /**
     * 
     * @param ComunaDAO
     */
    private $daoComuna;
    
    function __construct($conexion) {
        $this->conexion = $conexion;
        $this->daoComuna = new ComunaDAO($conexion);
    }
    
    
    function listar() {
        $query = "SELECT rut, nombre, apellido_paterno, apellido_materno, fecha_nacimiento, sexo,  clave, email, perfil, comuna FROM usuario";
        $resultado = $this->conexion->getConexion()->query($query);
        
        $listadoUsuarios = Array();
                
        while($fila = $resultado->fetch_array()) {
            $comuna = $this->daoComuna->buscarPorId($fila["comuna"]);
            $usuario = new Usuario($fila["rut"],$fila["nombre"], $fila["apellido_paterno"], $fila["apellido_materno"], $fila["fecha_nacimiento"], $fila["sexo"], $fila["clave"], $fila["email"], $fila["perfil"], $comuna->getNombre(), $comuna->getProvincia(),0,0,0);
            array_push($listadoUsuarios,$usuario);
        }
        
        return $listadoUsuarios;
    }
    
    function buscarPorId($id) {
        $query = "SELECT rut, nombre, apellido_paterno, apellido_materno, fecha_nacimiento, sexo,  clave, email, perfil, comuna FROM usuario WHERE rut = ? ";
        $consulta_preparada = $this->conexion->getConexion()->prepare($query);
        $consulta_preparada->bind_param("i", $id);
        $consulta_preparada->execute();
        $consulta_preparada->bind_result($rut, $nombre, $apellidoPaterno, $apellidoMaterno, $fechaNacimiento, $sexo, $clave, $email, $perfil, $codigoComuna);
        $ok = $consulta_preparada->fetch();
        if(!$ok) {
            return false;
        }
        
        $consulta_preparada->close();
        $comuna = $this->daoComuna->buscarPorId($codigoComuna);
        $usuario = new Usuario($rut, $nombre, $apellidoPaterno, $apellidoMaterno, $fechaNacimiento, $sexo, $clave, $email, $perfil, $comuna->getNombre(), $comuna->getProvincia(), $comuna->getCodRegion(),$comuna->getCodProvincia(), $comuna->getCodigo());
        return $usuario;
    }
    
    
    function actualizar($usuario) {
       
        return false;
    }
    
    function eliminar($rut) {
        $query = "delete from usuario where rut="
           . "'".$rut."'";
         $resultado = $this->conexion->getConexion()->query($query);
        return $resultado;
    }
    
    function agregar(Usuario $usuario) {
         $query = "INSERT INTO usuario VALUES("
                 . "'".$usuario->getRut()."',"
                 . "'".$usuario->getNombre()."',"
                 . "'".$usuario->getApellidoPaterno()."',"
                 . "'".$usuario->getApellidoMaterno()."',"
                 . "'".$this->encriptarClave($usuario->getClave())."',"
                 . "'".$usuario->getEmail()."',"
                 . "'".$usuario->getFechaNacimiento()."',"
                 . "'".$usuario->getSexo()."',"
                 . "'".$usuario->getComuna()."',"
                 . "'".$usuario->getPerfil()."')";
         $resultado = $this->conexion->getConexion()->query($query);
        return $resultado;
    }
    
    private function encriptarClave($clave) {
        $version = phpversion();
        $numero = str_replace(".", "", $version);
        $numeroVersion = substr($numero, 0, 3);
        $claveEncriptada = "";

        if($numeroVersion < 550) {             
            $claveEncriptada = sha1($clave);
        } else {
            $claveEncriptada = password_hash($clave,PASSWORD_DEFAULT);
        }
        
        return $claveEncriptada;
    }
}
