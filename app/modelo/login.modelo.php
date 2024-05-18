<?php
    require_once 'conexion.modelo.php';
    require_once 'get.modelo.php';
    require_once 'put.modelo.php';
    require_once '../app/libs/encriptado.lib.php';
    require_once '../app/config/config.php';

    class LoginModel{
        static public function iniciarSesion($usuario, $contrasena_usuario, $ano_trabajo, $mes_trabajo, $dia_trabajo){
            if(!isset($_SESSION)) {
                session_start();
            }
            
            $loginFormAction = $_SERVER['PHP_SELF'];
            if(isset($_GET['accesscheck'])) {
                $_SESSION['PrevUrl'] = $_GET['accesscheck'];
            }
            
            $loginUsername=$usuario;
            $password=$contrasena_usuario;

            //1. Consultar si existe ese usuario
            $tabla="usuarios";
            $select="id_usuario,contrasena_usuario,intentos_sesion_usuario,estado_usuario";
            $where="usuario";
            $equalTo=$loginUsername;
            $groupBy=null;
            $orderBy="id_usuario";
            $orderMode="DESC";
            $limite=1;
            $consultarUsuario=GetModel::obtenerDatosFiltro($tabla, $select, $where, $equalTo, $groupBy, $orderBy, $orderMode, $limite);
            if(!empty($consultarUsuario)){ // Si existe el user, trae sus datos para comparar pass obtenida con la pass ingresada
                foreach($consultarUsuario as $mostrar){
                    $id_usuarioObtenido=$mostrar->id_usuario;
                    $userObtenido=$mostrar->usuario;
                    $passObtenido=$mostrar->contrasena_usuario;
                    $int_sesionObtenido=$mostrar->intentos_sesion_usuario; //devuelve un int
                    $est_usuarioObtenido=$mostrar->estado_usuario;
                }
                $unEncrypt_passObtenido=encriptadoDesencriptado('desencriptar', $passObtenido, 'usuario');
                if($unEncrypt_passObtenido!=$password){
                    //echo 'Contrasena incorrecta';
                    //Sistema contador de inicios de sesion fallidos
                    $where1='id_usuario';
                    $equalTo1=$id_usuarioObtenido;
                    if($int_sesionObtenido>3){
                        $datos1=array(
                            "estado_usuario"=>"bloqueado"
                        );
                        $actEstado=PutModel::editar($tabla, $datos1, $where1, $equalTo1);
                    }else{
                        $datos2=array(
                            "intentos_sesion_usuario"=>$int_sesionObtenido+1
                        );
                        $actIntSesion=PutModel::editar($tabla, $datos2, $where1, $equalTo1);
                    }
                    $MM_redirectLoginFailed = $sistema['host']."login/false";
                    header("Location: ". $MM_redirectLoginFailed );
                }else{
                    if($est_usuarioObtenido=='bloqueado'){
                        $MM_redirectLoginFailed = $sistema['host']."login/blocked";
                        header("Location: ". $MM_redirectLoginFailed );
                    }else{
                        // 1.1. actualiza anio y mes de trabajo para mostrar los registros de ese mes
                        $datos=array(
                            "dia_trabajo"=>$dia_trabajo,
                            "mes_trabajo"=>$mes_trabajo,
                            "ano_trabajo"=>$ano_trabajo,
                            "intentos_sesion_usuario"=>0
                        );
                        $where='id_usuario';
                        $equalTo=$id_usuarioObtenido;
                        $actFechaTrabajo=PutModel::editar($tabla, $datos, $where, $equalTo);

                        // 2. Regenera la sesion
                        $loginStrGroup = "";
                        if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
                        //declare two session variables and assign them
                        $_SESSION['MM_Username'] = $loginUsername;
                        $_SESSION['MM_UserGroup'] = $loginStrGroup;	      
                        if (isset($_SESSION['PrevUrl']) && false) {
                            $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
                        }
                        $MM_redirectLoginSuccess=$sistema['host']."mediciones/inicio";
                        header("Location: " . $MM_redirectLoginSuccess );
                    }
                }
            }else{
                // echo 'El usuario no existe'; return;
                $MM_redirectLoginFailed = $sistema['host']."login/false";
                header("Location: ". $MM_redirectLoginFailed );
            }
        }

        
    }