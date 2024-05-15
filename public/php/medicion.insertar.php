<?php
    require_once '../../app/config/config.php';
    require_once '../../app/modelo/conexion.modelo.php';
    require_once '../../app/libs/session.lib.php'; //siempre debe ir debajo de config
    require_once '../../app/modelo/post.modelo.php';
    require_once '../../app/libs/limpiarcaracteres.lib.php';
    
    if(isset($_POST['let1']) && isset($_POST['let2']) && isset($_POST['let3']) && isset($_POST['let4'])){
        $tabla="mediciones";
        $datos=array(
            "fecha_medicion"=>Limpiar($_POST['let5']),
            "dia"=>$dia_trabajo,
            "ano"=>$ano_trabajo,
            "mes"=>$mes_trabajo,
            "id_indicador_medicion"=>Limpiar($_POST['let4']),
            "id_usuario_medicion"=>$id_usuario,
            "meta_medicion"=>Limpiar($_POST['let1']),
            "resultado_dia_medicion"=>Limpiar($_POST['let2']),
            "porcentaje_logro_medicion"=>Limpiar($_POST['let3'])
        );
        
    $enviarDatos=PostModel::inserciones($tabla, $datos);
    echo '<div class="alert alert-'.$enviarDatos['tipoAviso'].'" role="alert">'.$enviarDatos['comentario'].'</div>';
    }
    