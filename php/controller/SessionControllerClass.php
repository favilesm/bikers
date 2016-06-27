<?php


class SessionController {
    
    private $esEditor = false;
    private $esPublicador = false;
    private $esAdministrador = false;
    private $maximoTiempoVida = 3600; //una hora
    
    function __construct() {
        
        if(session_status() != PHP_SESSION_ACTIVE) {
            session_set_cookie_params($this->maximoTiempoVida);
            session_start();
        }

        $this->verificarPerfilUsuario();
    }

    private function verificarPerfilUsuario() {
        if(isset($_SESSION['usuario.perfil'])) {
            if($_SESSION['usuario.perfil'] == "editor") {
                $this->esEditor = true;
            } else if($_SESSION['usuario.perfil'] == "publicador") {
                $this->esPublicador = true;
            }else if($_SESSION['usuario.perfil'] == "admin") {
                $this->esAdministrador = true;
            }
        }
    }
    
    function isEditor() {
        return $this->esEditor;
    }

    function isPublicador() {
        return $this->esPublicador;
    }

    function isAdministrador() {
        return $this->esAdministrador;
    }

    function isLogged() {
        return isset($_SESSION['usuario.perfil']);
    }
    
    function getNombreUsuario() {
        if(isset($_SESSION['usuario.nombre'])) {
            return $_SESSION['usuario.nombre'];
        } else {
            return "";
        }        
    }
    
    function getEmailUsuario() {
        if(isset($_SESSION['usuario.email'])) {
            return $_SESSION['usuario.email'];
        } else {
            return "";
        }        
    }
    
    function finalizar() {
        session_destroy();
    }
    
    function inicializar($nombreUsuario, $perfilUsuario, $emailUsuario) {
        $_SESSION['usuario.nombre'] = $nombreUsuario;
        $_SESSION['usuario.perfil'] = $perfilUsuario;
        $_SESSION['usuario.email'] = $emailUsuario;
        
        $this->verificarPerfilUsuario();
    }

}
    
