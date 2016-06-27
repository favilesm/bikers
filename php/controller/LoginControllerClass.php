<?php

require_once dirname( __FILE__ ).'/SessionControllerClass.php';
require_once dirname( __FILE__ ).'/../model/UsuarioClass.php';
require_once dirname( __FILE__ ).'/../dao/ConexionClass.php';
require_once dirname( __FILE__ ).'/../dao/UsuarioDAOClass.php';


class LoginController {
    
    /**
     *
     * @var Conexion
     */
    private $conexion;
    
    /**
     *
     * @var UsuarioDao
     */
    private $daoUsuario;
    
    public function __construct() {
        $this->conexion = new Conexion();
        $this->daoUsuario = new UsuarioDAO($this->conexion);
    }
    
    public function __destruct() {
        $this->conexion->closeConexion();
    }
    
    public function autenticar($rut, $clave) {
        $usuario = $this->daoUsuario->buscarPorId($rut);
        
        if(!$usuario) {
            return false;
        }
        
        if($usuario->isClaveValida($clave)) {
            $session = new SessionController();
            $session->inicializar($usuario->getNombre(). " ". $usuario->getApellidoPaterno(), $usuario->getPerfil(), $usuario->getEmail());
            return true;
        } else {
            return false;
        }
        
    }
}
