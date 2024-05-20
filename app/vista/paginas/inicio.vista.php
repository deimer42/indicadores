<?php    
    require_once '../app/modelo/conexion.modelo.php';
    require_once '../app/controlador/get.controlador.php';
    require_once '../app/config/config.php';
    require_once '../app/libs/session.lib.php'; //siempre debe ir debajo de config

    $tituloPagina='Indicadores por dia';
    $tabla="mediciones";
    $select="id_medicion,fecha_medicion";
    $where="id_usuario_medicion,ano,mes,id_empresa_medicion";
    $equalTo=$id_usuario.",".$ano_trabajo.",".$mes_trabajo.",".$user_empresa;
    $groupBy="fecha_medicion";
    $orderBy="fecha_medicion";
    $orderMode="DESC";
    $limite=30;
    $consultaIndicadoresDia=GetController::obtenerDatosFiltro($tabla, $select, $where, $equalTo, $groupBy, $orderBy, $orderMode, $limite);
    require_once '../app/vista/secciones/header.php';
?>

<h2 class="text-center p-4">Reporte cierre diario de ventas <br><?php echo $ano_trabajo.'-'.$mes_trabajo; ?></h2>

<table width="100%">
    <tr>
        <td width="70%"><h5>Inicio: <?php echo '<span style="color:#044170;">'.$nombre_usuario.'</span>'; ?></h5></td>
        <td class="text-end">
            <a href="<?php echo $sistema['host'].'mediciones/crear/'.$sesion['fecha_sesion2']; ?>" onclick="" class="btn btn-success p-1"><img src="<?php echo $sistema['host'].'public/img/agregar.png'; ?>" style="width:25px;" alt=""></a>
            <a href="<?php echo $logoutAction; ?>" class="btn btn-success p-1"><img src="<?php echo $sistema['host'].'public/img/poder.png'; ?>" style="width:25px;"></a>
        </td>
    </tr>
</table>

<table width="765px" class="table table-striped" border="1">
    <tr>
        <th style="background-color:#044476; color:white;" class="text-start">Indicadores por dia</th>
        <th colspan="2" style="background-color:#044476; color:white;" class="text-center">Opciones</th>
    </tr>
    <?php 
        if(!empty($consultaIndicadoresDia)){
            foreach($consultaIndicadoresDia as $mostrar){
                echo '
                <tr>
                    <td><a href="'.$sistema['host'].'mediciones/crear/'.$mostrar->fecha_medicion.'">'.$mostrar->fecha_medicion.'</a></td>
                    <td width="5%" class="text-end"><a href="'.$sistema['host'].'mediciones/ver/'.$mostrar->fecha_medicion.'" class="btn btn-info p-1"><img src="'.$sistema['host'].'public/img/visible.png" style="width:25px;"></a></td>
                    <td width="5%" class="text-end"><a href="'.$sistema['host'].'mediciones/crear/'.$mostrar->fecha_medicion.'" class="btn btn-warning p-1"><img src="'.$sistema['host'].'public/img/editar.png" style="width:25px;"></a></td>
                </tr>';
            }
        }else{
            echo '
            <tr>
                <td colspan="2">Todavia no tienes indicadores guardados en el mes elegido al iniciar sesion. <a href="'.$sistema['host'].'mediciones/crear/'.$sesion["fecha_sesion2"].'">Crea una medicion</a></td>
            </tr>';
        }
    ?>
</table>

<?php require_once '../app/vista/secciones/footer.php';  ?>