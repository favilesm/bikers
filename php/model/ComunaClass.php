<?php

require_once dirname( __FILE__ ).'/ProvinciaClass.php';

class Comuna implements JsonSerializable{
    
    private $codigo;
    private $nombre;
    
    /**
     * 
     * @var Provincia
     */
    private $provincia;
    private $codProvincia;
    private $codRegion;
    
    function __construct($codigo, $nombre, $provincia,$codProvincia,$codRegion) {
        $this->codigo = $codigo;
        $this->nombre = $nombre;
        $this->provincia = $provincia;
        $this->codProvincia = $codProvincia;
        $this->codRegion = $codRegion;
        
    }

    function getCodigo() {
        return $this->codigo;
    }
    function getProvincia() {
        return $this->provincia;
    }
    function getCodProvincia() {
        return $this->codProvincia;
    }
    function getCodRegion() {
        return $this->codRegion;
    }

    function getNombre() {
        return $this->nombre;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setProvincia(Provincia $provincia) {
        $this->provincia = $provincia;
    }
    function setCodProvincia(Provincia $codProvincia) {
        $this->codProvincia = $codProvincia;
    }
    function setCodRegion(Region $codRegion) {
        $this->codRegion = $codRegion;
    }
    
    public function jsonSerialize() {
        return ["codigo" => $this->codigo, "nombre" => $this->nombre, "provincia" => $this->provincia];
    }

}

