<?php

require_once dirname( __FILE__ ).'/RegionClass.php';

class Provincia implements JsonSerializable{
    
    private $codigo;
    private $nombre;
    
    /**
     * 
     * @var Region
     */
    private $region;
    
    function __construct($codigo, $nombre, $region) {
        $this->codigo = $codigo;
        $this->nombre = $nombre;
        $this->region = $region;
    }

    function getCodigo() {
        return $this->codigo;
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

    function getRegion() {
        return $this->region;
    }

    function setRegion(Region $region) {
        $this->region = $region;
    }

    
    public function jsonSerialize() {
        return ["codigo" => $this->codigo, "nombre" => $this->nombre, "region" => $this->region];
    }

}

