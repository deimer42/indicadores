<?php
    require_once '../app/modelo/conexion.modelo.php';
    require_once '../app/config/config.php';
    require_once '../app/libs/session.lib.php'; //siempre debe ir debajo de config
    require_once '../app/controlador/get.controlador.php';

    $tituloPagina='Editar Medicion';
    $tabla2="mediciones";
    $select2="*";
    $where2="id_indicador_medicion,id_usuario_medicion";
    $equalTo2=$urlArray[3].",".$id_usuario; //$urlArray[3] contiene el id del registro
    $groupBy=null;
    $orderBy2="id_medicion";
    $orderMode2="DESC";
    $limite="1";

    $consultaMedicionEditar=GetController::obtenerDatosFiltro($tabla2, $select2, $where2, $equalTo2, $groupBy, $orderBy2, $orderMode2, $limite);

    require_once '../app/vista/secciones/header.php';
?>
    
    <h2 class="text-center p-4">Reporte cierre diario de ventas</h2>
    <h5><a href="<?php echo $_SERVER['HTTP_REFERER']; ?>#<?php echo $urlArray[3]; ?>"><img src="<?php echo $sistema['host']; ?>public/img/atras.png" width="20px" alt=""></a> Editar medicion</h5>
    <div id="avisosDesdeResponse2" class="text-center"></div>

    <?php
        foreach($consultaMedicionEditar as $mostrar){
    ?>
    <table class="table table-striped" border="1">
        <tr>
            <th colspan="2" class="text text-center">
                <?php 
                    $tabla='indicadores';
                    $select="nombre_indicador";
                    $where="id_indicador";
                    $equalTo=$mostrar->id_indicador_medicion;
                    $groupBy=null;
                    $orderBy="id_indicador";
                    $orderMode="DESC";
                    $limite=1;
                    $conNombreIndicador=GetController::obtenerDatosFiltro($tabla, $select, $where, $equalTo, $groupBy, $orderBy, $orderMode2, $limite);
                    if(!empty($conNombreIndicador)){
                        foreach($conNombreIndicador as $mostrarNombre){
                            $nombre_indicador=$mostrarNombre->nombre_indicador;
                        }
                        echo $nombre_indicador;
                    }
                ?>
            </th>
        </tr>
        <input type="hidden" value="<?php echo $mostrar->id_medicion; ?>" id="id_medicion">
        <tr>
            <td>Meta</td>
            <td><input type="number" value="<?php echo $mostrar->meta_medicion; ?>" id="meta_medicion" onchange="const porcent=new Mediciones(); porcent.calcularPorcentaje();" placeholder="Escribe..." class="form-control text-end"></td>
        </tr>
        <tr>
            <td>Resultado</td>
            <td><input type="number" value="<?php echo $mostrar->resultado_dia_medicion; ?>" id="resultado_dia_medicion" onchange="const porcent=new Mediciones(); porcent.calcularPorcentaje();" placeholder="Escribe..." class="form-control text-end"></td>
        </tr>
        <tr>
            <td>%</td>
            <td><input type="number" value="<?php echo $mostrar->porcentaje_logro_medicion; ?>" id="porcentaje_logro_medicion" placeholder="Escribe..." class="form-control text-end"></td>
        </tr>
        <tr>
            <td colspan="2" class="text-center p-3"><button type="button" class="btn btn-primary" onclick="const medicion=new Mediciones(); medicion.editarMedicion(); return false;">Actualizar</button></td>
        </tr>

        <?php } ?>
        
    </table>
<?php require_once '../app/vista/secciones/footer.php';  ?>