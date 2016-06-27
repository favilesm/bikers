<?php

class Region implements JsonSerializable {
    
    private $codigo;
    private $nombre;
    
    function __construct($codigo, $nombre) {
        $this->codigo = $codigo;
        $this->nombre = $nombre;
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

    public function jsonSerialize() {
        return ["codigo" => $this->codigo, "nombre" => $this->nombre ];
    }

}

