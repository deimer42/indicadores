<?php
    class Rutas{
        public function index(){
            $url=$_SERVER['REQUEST_URI'];
            $urlArray=explode("/",$url);
            $urlArray=array_filter($urlArray);
            //print_r($urlArray);

            if(!empty($urlArray)){
                if($urlArray[1]=='login'){
                    require '../app/vista/paginas/login.vista.php';
                }
                if($urlArray[1]=='usuarios' && $urlArray[2]=='crear'){
                    require '../app/vista/paginas/usuarioCrear.vista.php';
                }
                if($urlArray[1]=='mediciones' && $urlArray[2]=='crear' && !empty($urlArray[3])){
                    require '../app/vista/paginas/medicionCrear.vista.php';
                }
                if($urlArray[1]=='mediciones' && $urlArray[2]=='ver' && !empty($urlArray[3])){
                    require '../app/vista/paginas/medicionVer.vista.php';
                }
                if($urlArray[1]=='mediciones' && $urlArray[2]=='editar' && !empty($urlArray[3])){
                    require '../app/vista/paginas/medicionEditar.vista.php';
                }
                if($urlArray[1]=='mediciones' && $urlArray[2]=='inicio'){
                    require '../app/vista/paginas/inicio.vista.php';
                }
            }
            else{
                require '../app/vista/paginas/login.vista.php';
            }
        }
    }