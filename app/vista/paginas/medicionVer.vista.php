<?php 
    require_once '../app/modelo/conexion.modelo.php';
    require_once '../app/config/config.php';
    require_once '../app/libs/session.lib.php'; //siempre debe ir debajo de config
    require_once '../app/controlador/get.controlador.php';

    $tituloPagina='Indicadores';
    $tabla = "indicadores";
    $select = "id_indicador,nombre_indicador";
    $where = "id_empresa_indicador,ano_indicador,mes_indicador";
    $equalTo =$user_empresa.",".$ano_trabajo.",".$mes_trabajo;
    $groupBy=null;
    $orderBy=null;
    $orderBy = "id_indicador";
    $orderMode = "ASC";
    $limite=30;
    $consultaNombreMediciones = GetController::obtenerDatosFiltro($tabla, $select, $where, $equalTo, $groupBy, $orderBy, $orderMode, $limite);
    require_once '../app/vista/secciones/header.php';
?>
<style>
    body{
        font-size:12px;
    }
</style>

<h2 class="text-center p-4">Reporte cierre diario de ventas <br><?php echo $urlArray[3]; ?></h2>

<table width="100%">
    <tr>
        <td width="50%"><h5><?php echo '<span style="color:#044170;">'.$nombre_usuario.'</span>'; ?></h5></td>
        <td class="text-end">
            <a href="<?php echo $sistema['host']; ?>mediciones/inicio" class="btn btn-primary p-1"><img src="<?php echo $sistema['host']; ?>public/img/home.png" width="20px" alt=""></a>
            <button id="captureButton" onclick="const capture=new Mediciones(); capture.tomarCapture(); return false;" class="btn btn-primary p-1"><img src="<?php echo $sistema['host']; ?>public/img/captura-de-pantalla.png" width="20px" alt=""></button>
            <a href="<?php echo $logoutAction; ?>" class="btn btn-success p-1"><img src="<?php echo $sistema['host'].'public/img/poder.png'; ?>" style="width:25px;"></a>
        </td>
    </tr>
</table>

<table width="765px" class="table table-striped" border="1">
    <tr>
        <th style="background-color:#044476; color:white;" class="text-center">Indicador</th>
        <th style="background-color:#044476; color:white;" class="text-center">Meta</th>
        <th style="background-color:#044476; color:white;" class="text-center">Resultado</th>
        <th style="background-color:#044476; color:white;" class="text-center">%</th>
    </tr>
    <?php 
        if(!empty($consultaNombreMediciones)) {
            foreach($consultaNombreMediciones as $filas){
                /* 
                    Consulta si del listado de indicadores desplegado ya existe un registro de medicion
                    con fecha igual a la de la sesion actual para mostrar determinado boton
                */
                $id_indicador=$filas->id_indicador;
                $tabla2="mediciones";
                $select2="*";
                $where2="fecha_medicion,id_indicador_medicion,id_usuario_medicion,id_empresa_medicion";
                $equalTo2=$urlArray[3].",".$id_indicador.",".$id_usuario.",".$user_empresa; //$urlArray[3] contiene la fecha introducida en la url Ej: http://indicadores.com/mediciones/crear/2024-05-13
                $groupBy=null;
                $orderBy2="id_medicion";
                $orderMode2="DESC";
                $limite="1";
                $consultaMedicionHoy=GetController::obtenerDatosFiltro($tabla2, $select2, $where2, $equalTo2, $groupBy, $orderBy2, $orderMode2, $limite);

                //Muestra diferente icono (editar/agregar) segun haya medicion para el respectivo indicador
                if(!empty($consultaMedicionHoy)){
                    echo '
                        <tr>
                            <td colspan="" class="text-end" style="background-color:#7f8c8d; color:#fff;">'.$filas->nombre_indicador.'</td>';
                    //Imprime la medicion para el respectivo indicador de la lista (Si es que ha sido agregado ya)
                    foreach($consultaMedicionHoy as $filas2){
                        echo '
                            <td class="text-end">'.number_format($filas2->meta_medicion).'</td>
                            <td class="text-end">'.number_format($filas2->resultado_dia_medicion).'</td>
                            <td class="text-center"><b>'.number_format($filas2->porcentaje_logro_medicion, 1, ',','.').'%</b></td>
                        </tr>';
                    }
                }else{
                    echo '
                    <tr>
                        <td colspan="" class="text-center">'.$filas->nombre_indicador.'</td>
                        <td class="text-end">0</td>
                        <td class="text-end">0</td>
                        <td class="text-center"><b>0%</b></td>
                    </tr>';
                }
            }
        }
    ?>
</table>

<?php require '../app/vista/secciones/footer.php'; ?>