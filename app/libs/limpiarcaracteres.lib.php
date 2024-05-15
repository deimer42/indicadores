<?php 
     function Limpiar($mensaje){
         $nopermitidos = array("'",'\\','<','>',"\"",";",",");
         $mensaje = str_replace($nopermitidos, "", $mensaje);
		 return $mensaje;
        }