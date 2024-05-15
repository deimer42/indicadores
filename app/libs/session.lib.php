<?php
    require_once 'encriptado.lib.php';

     /*Restringe el acceso si no se esta logeado*/
     //initialize the session
     if (!isset($_SESSION)){
         session_start();
        }
     // ** Salir del usuario actual. **
     $logoutAction = $sistema['host']."mediciones/inicio/?doLogout=true"; //la destruccion de la sesion se debe mandar a cualquier vista siempre y cuando esta haga require a session.lib
     if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
         $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
        }
     if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
         //para desconectar por completo a un visitante, necesitamos borrar las variables de sesión
         $_SESSION['MM_Username'] = NULL;
         $_SESSION['MM_UserGroup'] = NULL;
         $_SESSION['PrevUrl'] = NULL;
         unset($_SESSION['MM_Username']);
         unset($_SESSION['MM_UserGroup']);
         unset($_SESSION['PrevUrl']);
         $logoutGoTo = $sistema['host']."login";
         if ($logoutGoTo) {
             header("Location: $logoutGoTo");
             exit;
            }
        }
     //----------------------------------------------------------------------------
     if (!isset($_SESSION)) {
         session_start();
        }
     $MM_authorizedUsers = "";
     $MM_donotCheckaccess = "true";
     // *** Restrict Access To Page: Grant or deny access to this page
     function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
         // For security, start by assuming the visitor is NOT authorized. 
         $isValid = False; 
         // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
         // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
         if (!empty($UserName)) { 
             // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
             // Parse the strings into arrays. 
             $arrUsers = Explode(",", $strUsers); 
             $arrGroups = Explode(",", $strGroups); 
             if (in_array($UserName, $arrUsers)) { 
                 $isValid = true; 
                } 
             // Or, you may restrict access to only certain users based on their username. 
             if (in_array($UserGroup, $arrGroups)) { 
                 $isValid = true; 
                } 
             if (($strUsers == "") && true) { 
                 $isValid = true; 
                } 
            } 
         return $isValid; 
        }
     $MM_restrictGoTo = $sistema['host']."login/notsession";
     if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
         $MM_qsChar = "/?";
         $MM_referrer = $sistema['host']."login";
         if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
         if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
         $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
         $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
         header("Location: ". $MM_restrictGoTo); 
         exit;
        }
    
    //Carga la configuracion del usuario actual
    $usuario = $_SESSION['MM_Username'];

    $tabla="usuarios";
    $select="id_usuario,nombre_usuario,ano_trabajo,mes_trabajo,dia_trabajo";
    $where="usuario";
    $equalTo=$usuario;

    $sql="SELECT $select FROM $tabla WHERE $where=:$where";
    $query=Conexion::conectar()->prepare($sql);
    $query->bindParam(":".$where, $equalTo, PDO::PARAM_STR);
    $query->execute();
    $resultado=$query->fetchAll(PDO::FETCH_CLASS);
    
    if(!empty($resultado)){
        foreach($resultado as $userConfigs){
            $id_usuario=$userConfigs->id_usuario;
            $nombre_usuario=$userConfigs->nombre_usuario;
            $dia_trabajo=$userConfigs->dia_trabajo;
            $mes_trabajo=$userConfigs->mes_trabajo;
            $ano_trabajo=$userConfigs->ano_trabajo;
        }
        $sesion=array(
            "fecha_sesion"=>$ano_trabajo.'-'.$mes_trabajo,
            "fecha_sesion2"=>$ano_trabajo.'-'.$mes_trabajo.'-'.$dia_trabajo //con esta fecha (la de inicio de sesion) Se crean las mediciones en el dia elegido.
        );
    }
