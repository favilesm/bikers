<?php

require_once dirname( __FILE__ ).'/LoginControllerClass.php';
require_once dirname( __FILE__ ).'/SessionControllerClass.php';
require_once dirname( __FILE__ ).'/../model/UsuarioClass.php';
require_once dirname( __FILE__ ).'/../dao/ConexionClass.php';
require_once dirname( __FILE__ ).'/../dao/ComunaDAOClass.php';
require_once dirname( __FILE__ ).'/../dao/ProvinciaDAOClass.php';
require_once dirname( __FILE__ ).'/../dao/RegionDAOClass.php';

class JSONController {
    /**
     *
     * @var Conexion
     */
    private $conexion;
    
    /**
     *
     * @var ComunaDAO
     */
    private $daoComuna;
    
    /**
     *
     * @var ProvinciaDAO
     */
    private $daoProvincia;
    
    /**
     *
     * @var RegionDAO
     */
    private $daoRegion;
   
    
    public function __construct() {
        $this->conexion = new Conexion();
        $this->daoComuna = new ComunaDAO($this->conexion);
        $this->daoProvincia = new ProvinciaDAO($this->conexion);
        $this->daoRegion = new RegionDAO($this->conexion);
    }
    
    public function __destruct() {
        $this->conexion->closeConexion();
    }
    
    public function getRegiones() {
        
        $regiones = $this->daoRegion->listar();
        
        return json_encode($regiones, JSON_PRETTY_PRINT);
        
    }            
    
    public function getProvincias($idRegion) {
        
        if(isset($idRegion) && $idRegion != null) {
            $provincias = $this->daoProvincia->buscarPorIdRegion($idRegion);
        } else {
            $provincias = $this->daoProvincia->listar();
        }
        
        return json_encode($provincias, JSON_PRETTY_PRINT);        
    }
    
    public function getComunas($idProvincia) {
        
        if(isset($idProvincia)) {
            $comunas = $this->daoComuna->buscarPorIdProvincia($idProvincia);
        } else {
            $comunas = $this->daoComuna->listar();
        }
        
        return json_encode($comunas, JSON_PRETTY_PRINT);        
    }
    
    public function autenticar($rut, $clave) {
        
        $loginController = new LoginController();        
        
        if($loginController->autenticar($rut, $clave)) {            
            return json_encode(["autenticado"=>true], JSON_PRETTY_PRINT);
        } else if(empty($rut) || empty($clave)) {
            return json_encode(["autenticado"=>false, "motivo"=>"Debe introducir RUT y clave para autenticarse"], JSON_PRETTY_PRINT);
        } else {
            return json_encode(["autenticado"=>false, "motivo"=>"Las credenciales ingresadas no son válidas"], JSON_PRETTY_PRINT);
        }
        
    }
    
    public function cerrarSesion() {
        $sessionController = new SessionController();
        $sessionController->finalizar();
        return json_encode(["finalizado"=>true], JSON_PRETTY_PRINT);
    }
}

