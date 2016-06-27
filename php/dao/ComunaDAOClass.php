<?php

require_once dirname( __FILE__ ).'/ConexionClass.php';
require_once dirname( __FILE__ ).'/../model/RegionClass.php';
require_once dirname( __FILE__ ).'/../model/ProvinciaClass.php';
require_once dirname( __FILE__ ).'/../model/ComunaClass.php';


class ComunaDAO {
    
    /**
     *
     * @var Conexion
     */
    private $conexion;
    
    function __construct($conexion) {
        $this->conexion = $conexion;
    }

    
    function buscarPorId($idComuna) {
        $query = "SELECT c.codigo, c.nombre, p.codigo AS codigoProvincia, p.nombre AS nombreProvincia, r.codigo AS codigoRegion, r.nombre AS nombreRegion FROM provincia p, comuna c, region r WHERE c.provincia = p.codigo AND p.region = r.codigo AND c.codigo = ?";
        $consulta_preparada = $this->conexion->getConexion()->prepare($query);
        $consulta_preparada->bind_param("s", $idComuna);
        $consulta_preparada->execute();
        $consulta_preparada->bind_result($codigo, $nombre, $codigoProvincia, $nombreProvincia, $codigoRegion, $nombreRegion);
        $ok = $consulta_preparada->fetch();
        
        if(!$ok) {
            return false;
        }
        
        $region = new Region($codigoRegion, $nombreRegion);
        $provincia = new Provincia($codigoProvincia, $nombreProvincia, $region);
        $comuna = new Comuna($codigo, $nombre, $nombreProvincia,$codigoProvincia,$codigoRegion);
        
        return $comuna;
    }
    
    
    function buscarPorIdRegion($idRegion) {
        $consulta_preparada = $this->conexion->getConexion()->prepare("SELECT c.codigo, c.nombre, p.codigo AS codigoProvincia, p.nombre AS nombreProvincia, r.codigo AS codigoRegion, r.nombre AS nombreRegion FROM provincia p, comuna c, region r WHERE c.provincia = p.codigo AND p.region = r.codigo AND r.codigo = ?");
        $consulta_preparada->bind_param("i", $idRegion);
        $consulta_preparada->execute();
        $consulta_preparada->bind_result($codigo, $nombre, $codigoProvincia, $nombreProvincia, $codigoRegion, $nombreRegion);
        
        $listadoComunas = Array();
                
        while($fila = $consulta_preparada->fetch()) {
            $region = new Region($codigoRegion, $nombreRegion);
            $provincia = new Provincia($codigoProvincia, $nombreProvincia, $region);
            $comuna = new Comuna($codigo, $nombre, $provincia);
            
            array_push($listadoComunas,$comuna);

        }
        
        return $listadoComunas;
    }
    
    function buscarPorIdProvincia($idProvincia) {
        $consulta_preparada = $this->conexion->getConexion()->prepare("SELECT c.codigo, c.nombre, p.codigo AS codigoProvincia, p.nombre AS nombreProvincia, r.codigo AS codigoRegion, r.nombre AS nombreRegion FROM provincia p, comuna c, region r WHERE c.provincia = p.codigo AND p.region = r.codigo AND p.codigo = ?");
        $consulta_preparada->bind_param("i", $idProvincia);
        $consulta_preparada->execute();
        $consulta_preparada->bind_result($codigo, $nombre, $codigoProvincia, $nombreProvincia, $codigoRegion, $nombreRegion);
        
        $listadoComunas = Array();
                
        while($fila = $consulta_preparada->fetch()) {
            $region = new Region($codigoRegion, $nombreRegion);
            $provincia = new Provincia($codigoProvincia, $nombreProvincia, $region);
            $comuna = new Comuna($codigo, $nombre, $provincia, $codigoProvincia, $codigoRegion);
            
            array_push($listadoComunas,$comuna);
        }
        return $listadoComunas;
    }
    
    
    function listar() {
        $resultado = $this->conexion->getConexion()->query("SELECT c.codigo, c.nombre, p.codigo AS codigoProvincia, p.nombre AS nombreProvincia, r.codigo AS codigoRegion, r.nombre AS nombreRegion FROM provincia p, comuna c, region r WHERE c.provincia = p.codigo AND p.region = r.codigo");
        
        $listadoComunas = Array();
                
        while($fila = $resultado->fetch_array()) {
            $region = new Region($fila["codigoRegion"],$fila["nombreRegion"]);
            $provincia = new Provincia($fila["codigoProvincia"],$fila["nombreProvincia"], $region);
            $comuna = new Comuna($fila["codigo"],$fila["nombre"], $provincia);
            
            array_push($listadoComunas,$comuna);

        }
        
        return $listadoComunas;
    }
}
