<?php

require_once dirname( __FILE__ ).'/ConexionClass.php';
require_once dirname( __FILE__ ).'/../model/ProvinciaClass.php';
require_once dirname( __FILE__ ).'/../model/RegionClass.php';


class ProvinciaDAO {
    
    /**
     *
     * @var Conexion
     */
    private $conexion;
    
    function __construct($conexion) {
        $this->conexion = $conexion;
    }

    
    function buscarPorId($idProvincia) {
        $consulta_preparada = $this->conexion->getConexion()->prepare("SELECT p.codigo, p.nombre, r.codigo AS codigoRegion, r.nombre AS nombreRegion FROM provincia p, region r WHERE p.codigo = ? AND p.region = r.codigo");
        $consulta_preparada->bind_param("i", $idProvincia);
        $consulta_preparada->execute();
        $consulta_preparada->bind_result($codigo, $nombre, $codigoRegion, $nombreRegion);
        $ok = $consulta_preparada->fetch();
        
        if(!$ok) {
            return false;
        }
        
        $region = new Region($codigoRegion, $nombreRegion);
        $provincia = new Provincia($codigo, $nombre, $region);
        
        return $provincia;
    }
    
    
    function buscarPorIdRegion($idRegion) {
        $consulta_preparada = $this->conexion->getConexion()->prepare("SELECT p.codigo, p.nombre, r.codigo AS codigoRegion, r.nombre AS nombreRegion FROM provincia p, region r WHERE p.region = r.codigo AND r.codigo = ? ");
        $consulta_preparada->bind_param("i", $idRegion);
        $consulta_preparada->execute();
        $consulta_preparada->bind_result($codigo, $nombre, $codigoRegion, $nombreRegion);
        
        $listadoProvincias = Array();
                
        while($fila = $consulta_preparada->fetch()) {
            $region = new Region($codigoRegion,$nombreRegion);
            $provincia = new Provincia($codigo, $nombre, $region);
            
            array_push($listadoProvincias,$provincia);

        }
        
        return $listadoProvincias;
    }
    
    
    function listar() {
        $resultado = $this->conexion->getConexion()->query("SELECT p.codigo, p.nombre, r.codigo AS codigoRegion, r.nombre AS nombreRegion FROM provincia p, region r WHERE p.region = r.codigo");
        
        $listadoProvincias = Array();
                
        while($fila = $resultado->fetch_array()) {
            $region = new Region($fila["codigoRegion"],$fila["nombreRegion"]);
            $provincia = new Provincia($fila["codigo"],$fila["nombre"], $region);
            
            array_push($listadoProvincias,$provincia);

        }
        
        return $listadoProvincias;
    }
}
