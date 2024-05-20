<?php
    require_once '../app/modelo/conexion.modelo.php';
    require_once '../app/config/config.php';
    require_once '../app/libs/session.lib.php'; //siempre debe ir debajo de configrequire_once '../app/libs/session.lib.php';
    require_once '../app/controlador/get.controlador.php';

    $tituloPagina='Indicadores por dia';
    require_once '../app/vista/secciones/header.php';
?>

<h2 class="text-center p-4">Indicadores</h2>

<h1 style="text-align:center;">Error 404. La pagina que estas buscando no existe. <br><a href="<?php echo $sistema['host'].'mediciones/inicio' ?>">Volver al inicio</a></h1>

<?php require_once '../app/vista/secciones/footer.php';  ?>