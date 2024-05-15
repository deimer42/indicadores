<?php
    require_once '../app/controlador/login.controlador.php';
    require_once '../app/libs/limpiarcaracteres.lib.php';

    $tituloPagina='Indicadores | Login';

    if(isset($_POST['btnLogin']) && !empty($_POST['usuario']) && !empty($_POST['contrasena_usuario'])){
        $usuario=Limpiar($_POST['usuario']);
        $contrasena_usuario=Limpiar($_POST['contrasena_usuario']);
        $ano_trabajo=Limpiar($_POST['ano_trabajo']);
        $mes_trabajo=Limpiar($_POST['mes_trabajo']);
        $dia_trabajo=Limpiar($_POST['dia_trabajo']);

        $iniciarSesion=new LoginController();
        $iniciarSesion->iniciarSesion($usuario, $contrasena_usuario, $ano_trabajo, $mes_trabajo, $dia_trabajo);
    }

    require_once '../app/vista/secciones/header.php';
?>

<style>
    @import url(https://fonts.googleapis.com/css?family=Roboto:300);
    .login-page {
        width: 360px;
        padding: 8% 0 0;
        margin: auto;
    }
    .form {
        position: relative;
        z-index: 1;
        background: #FFFFFF;
        max-width: 360px;
        margin: 0 auto 100px;
        padding: 45px;
        text-align: center;
        box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
    }
    .form input,select {
        font-family: "Roboto", sans-serif;
        outline: 0;
        background: #f2f2f2;
        width: 100%;
        border: 0;
        margin: 0 0 15px;
        padding: 15px;
        box-sizing: border-box;
        font-size: 14px;
    }
    .form button {
        font-family: "Roboto", sans-serif;
        text-transform: uppercase;
        outline: 0;
        background: #044170;
        width: 100%;
        border: 0;
        padding: 15px;
        color: #FFFFFF;
        font-size: 14px;
        -webkit-transition: all 0.3 ease;
        transition: all 0.3 ease;
        cursor: pointer;
    }
    .form button:hover,.form button:active,.form button:focus {
        background: #044170;
    }
    .form .message {
        margin: 15px 0 0;
        color: #b3b3b3;
        font-size: 12px;
    }
    .form .message a {
        color: #4CAF50;
        text-decoration: none;
    }
    .form .register-form {
        display: none;
    }
    .container {
        position: relative;
        z-index: 1;
        max-width: 300px;
        margin: 0 auto;
    }
    .container:before, .container:after {
        content: "";
        display: block;
        clear: both;
    }
    .container .info {
        margin: 50px auto;
        text-align: center;
    }
    .container .info h1 {
        margin: 0 0 15px;
        padding: 0;
        font-size: 36px;
        font-weight: 300;
        color: #1a1a1a;
    }
    .container .info span {
        color: #4d4d4d;
        font-size: 12px;
    }
    .container .info span a {
        color: #000000;
        text-decoration: none;
    }
    .container .info span .fa {
        color: #EF3B3A;
    }
    body {
        background: #fff; /* fallback for old browsers */
        /* background: rgb(141,194,111);
        background: linear-gradient(90deg, rgba(141,194,111,1) 0%, rgba(118,184,82,1) 50%); */
        font-family: "Roboto", sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;      
    }
</style>
    
    <div class="login-page">
        <div class="form">
            <h2 class="text-center">Indicadores</h2>
            <?php 
                if(isset($urlArray[2]) && $urlArray[2]=='false'){
                    echo '<div class="alert alert-danger" role="alert">Credenciales incorrectas</div>';
                }elseif(isset($urlArray[2]) && $urlArray[2]=='notsession'){
                    echo '<div class="alert alert-warning" role="alert">Primero tienes que iniciar sesion</div>';
                }
            ?>
            <form class="login-form" action="<?php echo $sistema['host'].'login'; ?>" method="POST">
                <input type="text" id="usuario" name="usuario" placeholder="Usuario" required />
                <input type="password" id="contrasena_usuario" name="contrasena_usuario" required placeholder="Contrase&ntilde;a"/>
                <table>
                    <tr>
                        <td width="30%"><input type="number" name="dia_trabajo" value="<?php echo date('d'); ?>" /></td>
                        <td width="40%" align="center">
                            <select required name="mes_trabajo">
								<option selected="selected" value="<?php echo date('m'); ?>"><?php echo date('m'); ?></option>
								<option value="1">Enero</option>
								<option value="2">Febrero</option>
								<option value="3">Marzo</option>
								<option value="4">Abril</option>
								<option value="5">Mayo</option>
								<option value="6">Junio</option>
								<option value="7">Julio</option>
								<option value="8">Agosto</option>
								<option value="9">Septiembre</option>
								<option value="10">Octubre</option>
								<option value="11">Noviembre</option>
								<option value="12">Diciembre</option>
							</select>
                        </td>
                        <td><input type="text" name="ano_trabajo" value="<?php echo date('Y'); ?>" /></td>
                    </tr>
                </table>
                <button type="submit" name="btnLogin">login</button>
                <p class="message">No registrado? <a href="<?php echo $sistema['host'].'usuarios/crear'; ?>">Crea una cuenta</a></p>
                <hr>
                <p class="message text-center">&copy; Indicadores 2024. Desarrollado por DMosquera. Licencia Shareware: Adware</p>
            </form>
        </div>
    </div>

    <script>
        $('.message a').click(function(){
            $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
        });
    </script>