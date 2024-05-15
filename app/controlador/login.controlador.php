<?php
    require_once '../app/modelo/login.modelo.php';
    
    class LoginController{
        public function iniciarSesion($usuario, $contrasena_usuario, $ano_trabajo, $mes_trabajo, $dia_trabajo){
            $iniciarSesion=LoginModel::iniciarSesion($usuario, $contrasena_usuario, $ano_trabajo, $mes_trabajo, $dia_trabajo);
            return $iniciarSesion;
        }
    }