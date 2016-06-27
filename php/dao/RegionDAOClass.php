<?php

require_once dirname( __FILE__ ).'/ConexionClass.php';
require_once dirname( __FILE__ ).'/../model/RegionClass.php';

/**
 * Description of ClienteDAOClass
 *
 * @author Cetecom
 */
class RegionDAO {
    
    /**
     *
     * @var Conexion
     */
    private $conexion;
    
    function __construct($conexion) {
        $this->conexion = $conexion;
    }

    
    function buscarPorId($idRegion) {
        $consulta_preparada = $this->conexion->getConexion()->prepare("SELECT codigo, nombre FROM region WHERE codigo = ?");
        $consulta_preparada->bind_param("i", $idRegion);
        $consulta_preparada->execute();
        $consulta_preparada->bind_result($codigo, $nombre);
        $ok = $consulta_preparada->fetch();
        
        if(!$ok) {
            return false;
        }
        
        $region = new Region($codigo, $nombre);
        
        return $region;
    }
    
    
    function listar() {
        $resultado = $this->conexion->getConexion()->query("SELECT codigo, nombre FROM region");
       
        $listadoRegiones = Array();
                
        while($fila = $resultado->fetch_array()) {
            $region = new Region($fila["codigo"],$fila["nombre"]);
            
            array_push($listadoRegiones,$region);
        }
        
        return $listadoRegiones;
    }
}
