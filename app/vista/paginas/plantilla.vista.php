<?php
    require_once '../app/modelo/conexion.modelo.php';
    require_once '../app/config/config.php';
    require_once '../app/libs/session.lib.php'; //siempre debe ir debajo de configrequire_once '../app/libs/session.lib.php';
    require_once '../app/controlador/get.controlador.php';

    $tituloPagina='Indicadores por dia';
    // $tabla="mediciones";
    // $select="id_medicion,fecha_medicion";
    // $where="id_usuario_medicion,ano,mes";
    // $equalTo="1,".date('Y').",".date('m'); //aqui iran los datos provenientes de la sesion
    // $groupBy="fecha_medicion";
    // $orderBy="id_medicion";
    // $orderMode="ASC";
    // $limite=30;
    // $consultaIndicadoresDia=GetController::obtenerDatosFiltro($tabla, $select, $where, $equalTo, $groupBy, $orderBy, $orderMode, $limite);
    require_once '../app/vista/secciones/header.php';
?>

<h2 class="text-center p-4">Reporte cierre diario de ventas</h2>

<table width="100%">
    <tr>
        <td width="50%"><h5>Inicio</h5></td>
        <td class="text-end"><a href="<?php echo $sistema['host'].'mediciones/crear/'.$sesion['fecha_sesion2']; ?>" onclick="" class="btn btn-success p-1"><img src="<?php echo $sistema['host'].'public/img/agregar.png'; ?>" style="width:25px;" alt=""></a></td>
    </tr>
</table>

<?php require_once '../app/vista/secciones/footer.php';  ?>