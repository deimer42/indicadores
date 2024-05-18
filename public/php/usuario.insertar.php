<?php
    require_once '../../app/config/config.php';
    require_once '../../app/modelo/post.modelo.php';
    require_once '../../app/modelo/get.modelo.php';
    require_once '../../app/libs/encriptado.lib.php';
    require_once '../../app/libs/limpiarcaracteres.lib.php';
    
    if(isset($_POST['let1']) && isset($_POST['let2']) && isset($_POST['let3']) && isset($_POST['let4']) && isset($_POST['let5'])){
        $tabla="usuarios";
        $encryptPass=encriptadoDesencriptado('encriptar', Limpiar($_POST['let3']), 'usuario');
        $datos=array(
            "nombre_usuario"=>Limpiar($_POST['let1']),
            "usuario"=>Limpiar($_POST['let2']),
            "contrasena_usuario"=>$encryptPass,
            "rol_usuario"=>Limpiar($_POST['let4']),
            "id_empresa_usuario"=>Limpiar($_POST['let5']),
            "estado_usuario"=>"activo"
        );

        // Consultar que no haya usuario duplicado
        $select="usuario";
        $where="usuario";
        $equalTo=$datos['usuario'];
        $groupBy=null;
        $orderBy="id_usuario";
        $orderMode="DESC";
        $limite=1;
        $consultaDuplicado=GetModel::obtenerDatosFiltro($tabla, $select, $where, $equalTo, $groupBy, $orderBy, $orderMode, $limite);
        
        if(empty($consultaDuplicado)){ //si no devuelve nada, no hay duplicados
            $enviarDatos=PostModel::inserciones($tabla, $datos);
            echo '<div class="alert alert-'.$enviarDatos['tipoAviso'].'" role="alert">'.$enviarDatos['comentario'].'. Ahora puedes <a href="'.$sistema['host'].'login">iniciar sesion</a></div>';
        }else{
            echo '<div class="alert alert-danger" role="alert">Ya existe un registro con ese usuario. Prueba otro</div>';
        }
    }