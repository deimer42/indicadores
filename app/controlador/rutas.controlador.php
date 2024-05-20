<?php
    require_once '../app/libs/limpiarcaracteres.lib.php';
    class Rutas{
        public function index(){
            $url=$_SERVER['REQUEST_URI'];
            $urlArray=explode("/",$url);
            $urlArray=array_filter($urlArray); //eliminar elementos vacíos del array $urlArray. si la URL fuera "/usuarios/crear/", después de dividirla con explode("/", $url), obtendríamos un array como ["", "usuarios", "crear", ""]
            $urlArray=Limpiar($urlArray);
            //print_r($urlArray);

            if(!empty($urlArray)){
                if($urlArray[1]=='login'){
                    require '../app/vista/paginas/login.vista.php';
                }
                elseif($urlArray[1]=='usuarios' && $urlArray[2]=='crear'){
                    require '../app/vista/paginas/usuarioCrear.vista.php';
                }
                elseif($urlArray[1]=='mediciones' && $urlArray[2]=='crear' && !empty($urlArray[3])){
                    require '../app/vista/paginas/medicionCrear.vista.php';
                }
                elseif($urlArray[1]=='mediciones' && $urlArray[2]=='ver' && !empty($urlArray[3])){
                    require '../app/vista/paginas/medicionVer.vista.php';
                }
                elseif($urlArray[1]=='mediciones' && $urlArray[2]=='editar' && !empty($urlArray[3])){
                    require '../app/vista/paginas/medicionEditar.vista.php';
                }
                elseif($urlArray[1]=='mediciones' && $urlArray[2]=='inicio'){
                    require '../app/vista/paginas/inicio.vista.php';
                }
                else{
                    require '../app/vista/paginas/404.vista.php';
                }
            }
            else{
                require '../app/vista/paginas/login.vista.php';
            }
        }
    }