<?php

require_once dirname( __FILE__ ).'/../model/ComunaClass.php';

class Evento implements JsonSerializable {
    
    private $id;
    private $nombre;
    private $fecha;
    private $hora;
    private $lugar;
    /**
     *
     * @var Comuna
     */
    private $comuna;
    private $cupos;
    
    function __construct($id, $nombre, $fecha, $hora, $lugar, $comuna, $cupos) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->fecha = $fecha;
        $this->hora = $hora;
        $this->lugar = $lugar;
        $this->comuna = $comuna;
        $this->cupos = $cupos;
    }

    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getHora() {
        return $this->hora;
    }

    function getLugar() {
        return $this->lugar;
    }

    function getComuna() {
        return $this->comuna;
    }

    function getCupos() {
        return $this->cupos;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setHora($hora) {
        $this->hora = $hora;
    }

    function setLugar($lugar) {
        $this->lugar = $lugar;
    }

    function setComuna($comuna) {
        $this->comuna = $comuna;
    }

    function setCupos($cupos) {
        $this->cupos = $cupos;
    }

    public function jsonSerialize() {
        return ["id" => $this->id, 
                "nombre"=> $this->nombre,
                "fecha" => $this->fecha,
                "hora"  => $this->hora,
                "lugar" => $this->lugar,
                "comuna"=> $this->comuna,
                "cupos" => $this->cupos
            ];
    }

}
