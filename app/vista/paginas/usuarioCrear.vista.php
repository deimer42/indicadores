<?php
    require_once '../app/modelo/conexion.modelo.php';
    require_once '../app/config/config.php';
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
        <td width="50%"><h5>Crear usuario</h5></td>
        <td class="text-end"><a href="#" class="btn btn-success p-1" onclick="const us = new Usuario(); us.crearUsuario(); return false;"><img src="<?php echo $sistema['host'].'public/img/salvar.png'; ?>" style="width:25px;" alt=""></a></td>
    </tr>
</table>

<div id="avisosDesdeResponse2" class="text-center"></div>

<table width="100%" class="table table-striped" border="1">
    <tr>
        <td>Nombre completo</td>
        <td><input type="text" name="nombre_usuario" id="nombre_usuario" class="form-control"></td>
    </tr>
    <tr>
        <td>Usuario</td>
        <td><input type="text" name="usuario" id="usuario" class="form-control"></td>
    </tr>
    <tr>
        <td>Contrase&ntilde;a</td>
        <td><input type="password" name="contrasena_usuario" id="contrasena_usuario" class="form-control"></td>
    </tr>
    <tr>
        <td>Confirmar contrase&ntilde;a</td>
        <td><input type="password" name="contrasena_confirm" id="contrasena_confirm" class="form-control"></td>
    </tr>
    <tr>
        <td>Rol</td>
        <td>
            <select name="rol_usuario" id="rol_usuario" class="form-control">
                <option value="Vendedor" selected>Vendedor</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>Empresa</td>
        <td>
            <select name="empresa_usuario" id="empresa_usuario" class="form-control">
                <option value="" selected>Seleccione...</option>
                <option value="1">Disprolacteos: Carnicos</option>
                <option value="2">Disprolacteos: Comercial Nutresa</option>
                <option value="3">Disprolacteos: Meals Colombia</option>
            </select>
        </td>
    </tr>
</table>

<center><a href="#" class="btn btn-success p-1" onclick="const us = new Usuario(); us.crearUsuario(); return false;"><img src="<?php echo $sistema['host'].'public/img/salvar.png'; ?>" style="width:25px;" alt=""></a></center>

<?php require_once '../app/vista/secciones/footer.php';  ?>