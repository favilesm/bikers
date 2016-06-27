<?php

/**
 * Description of Conexion
 *
 * @author cetecom
 */
class Conexion {

    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $database = "dai_ciclistas";
    private $script = "database.sql";
    /**
     * 
     * @var Mysqli 
     */
    private $conexion;
    
    function __construct() {
       
        $this->conexion = new Mysqli($this->host,$this->user, $this->password);
        
        $this->conexion->set_charset("UTF8");
        
        $ok = $this->conexion->select_db($this->database);
        
        // si la base de datos no existe (código error 1049)
        if(!$ok && $this->conexion->errno == 1049) {
            $ok = $this->crearBaseDatos(); 
            if($ok) {
                $closeBtn = '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                echo "<div class=\"alert alert-success fade in\">".$closeBtn."La base de datos se ha creado exitosamente</div>";
            }
        }
        
        if(!$ok) {
            die("Error al conectarse con la base de datos: "+$this->conexion->error);
        }
    }

    function getConexion() {
        return $this->conexion;
    }
    
    function closeConexion() {
        $this->conexion->close();
    }

    private function crearBaseDatos() {
        
        $ok = $this->conexion->query("CREATE DATABASE ". $this->database);
        
        if(!$ok) {
            return false;
        }
        
        $ok = $this->conexion->select_db($this->database);
        
        if(!$ok) {
            return false;
        }        
       
        $ok = $this->cargarScript();
        
        if(!$ok) {
            return false;
        } 
        
        $this->crearUsuarios();
        
        return true;                
    }
    
    private function crearUsuarios() {

        $this->conexion->query("INSERT INTO usuario VALUES(11111111,'Catalina','Fuentes', 'Rodríguez', '". $this->encriptarClave('123')."','catalina.fuentes@demodai.cl','1990-04-28',1,13101,'admin')");
        $this->conexion->query("INSERT INTO usuario VALUES(12345678,'Rodrigo','Carvajal', 'Pérez', '". $this->encriptarClave('123')."','rodrigo.carvajal@demodai.cl','1991-06-16',0,13101,'editor')");
        $this->conexion->query("INSERT INTO usuario VALUES(12345677,'Fernanda','Hidalgo', 'Zúñiga', '". $this->encriptarClave('123')."','fernanda.hidalgo@demodai.cl','1995-07-14',1,13101,'publicador')");
        $this->conexion->query("INSERT INTO usuario VALUES(12345676,'Francisco','Fernández', 'Íñiguez', '". $this->encriptarClave('123')."','francisco.fernandez@demodai.cl','1988-11-21',0,13101,'usuario')");
        $this->conexion->query("INSERT INTO usuario VALUES(12345675,'Pedro','Soto', 'Parraguez', '". $this->encriptarClave('123')."','pedro.soto@demodai.cl','1992-03-19',0,13101,'usuario')");
        
    }
    
    private function encriptarClave($clave) {
        $version = phpversion();
        $numero = str_replace(".", "", $version);
        $numeroVersion = substr($numero, 0, 3);
        $claveEncriptada = "";
       
        
        if($numeroVersion < 550) {             
            $claveEncriptada = sha1($clave);
        } else {
            $claveEncriptada = password_hash($clave,PASSWORD_DEFAULT);
        }
        
        return $claveEncriptada;
    }
    
    private function cargarScript() {
        // Variable temporal para cada sentencia SQL a ejecutar
        $sentencia = '';
        
        // Recuperar todas las lineas que tiene el archivo
        $lineas = file(dirname(__FILE__)."/".$this->script);
        
        // Iterar por cada línea
        foreach ($lineas as $linea) {
            
            // Omitir si es un comentario o si no tiene nada
            if (substr($linea, 0, 2) == '--' || $linea == '') {
                continue;
            }

            // adicionar la línea a la sentencia
            $sentencia .= $linea;
            
            // si tiene un punto y coma al final
            if (substr(trim($linea), -1, 1) == ';') {
                
                // entonces es el fin de la sentencia y se ejecuta
                $ok = $this->conexion->query($sentencia);
                
                if(!$ok) {
                    $closeBtn = '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                    echo "<div class=\"alert alert-danger fade in\">".$closeBtn."Error ejecutando sentencia: '<span style=\"color:red;\">" . $sentencia . "'</span>: " . $this->conexion->error ."</div>";
                }
             
                // se limpia y vuelve a dejar vacía la sentencia
                $sentencia = '';
            }
        }
        
        return true;
    }
}
