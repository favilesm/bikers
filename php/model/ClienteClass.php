<?php

/**
 * Description of ClienteClass
 *
 * @author cetecom
 */
class Cliente {

    private $rut;
    private $nombre;
    private $apellido;
    private $email;
    private $comuna;
    private $fechaNacimiento;
    private $telefono;
    
    function __construct(){
    }

    function getRut() {
        return $this->rut;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getApellido() {
        return $this->apellido;
    }

    function getEmail() {
        return $this->email;
    }
    
    function getComuna() {
        return $this->comuna;
    }

    function getFechaNacimiento() {
        return $this->fechaNacimiento;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function setRut($rut) {
        $this->rut = $rut;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setApellido($apellido) {
        $this->apellido = $apellido;
    }

    function setEmail($email) {
        $this->email = $email;
    }
    
    function setComuna($comuna) {
        $this->comuna = $comuna;
    }

    function setFechaNacimiento($fechaNacimiento) {
        $this->fechaNacimiento = $fechaNacimiento;
    }

    function setTelefono($telefono) {
        $this->telefono = $telefono;
    }
    
    public function __toString() {
        return "\nCliente {\n\tRUT:".$this->rut.",\n\tnombre: ".$this->nombre.",\n\tapellido: ".$this->apellido.",\n\temail: ".$this->email.",\n\tcomuna: ".$this->comuna.",\n\ttelefono: ".$this->telefono.",\n\tfechaNacimiento: ".$this->fechaNacimiento."\n}\n";
    }


}
