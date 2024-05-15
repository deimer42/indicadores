<?php
    require_once '../../app/config/config.php';
    require_once '../../app/modelo/conexion.modelo.php';
    require_once '../../app/libs/session.lib.php'; //siempre debe ir debajo de config
    require_once '../../app/modelo/put.modelo.php';
    require_once '../../app/modelo/get.modelo.php';
    require_once '../../app/libs/limpiarcaracteres.lib.php';

    if(isset($_POST['let1']) && isset($_POST['let2']) &&  isset($_POST['let3']) &&  isset($_POST['let4'])){
        $tabla="mediciones";
        $where="id_usuario_medicion,id_medicion";
        $equalTo=$id_usuario.",".$_POST['let4']; //let4= id_medicion
        $datos=array(
            "meta_medicion"=>Limpiar($_POST['let1']) ?? 0,
            "resultado_dia_medicion"=>Limpiar($_POST['let2']) ?? 0,
            "porcentaje_logro_medicion"=>Limpiar($_POST['let3']) ?? 0
        );
        $enviarDatos=PutModel::editar($tabla, $datos, $where, $equalTo);
        echo '<div class="alert alert-'.$enviarDatos['tipoAviso'].'" role="alert">'.$enviarDatos['comentario'].'</div>';
    }
    