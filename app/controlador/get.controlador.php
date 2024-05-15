<?php
    require_once '../app/modelo/get.modelo.php';
    class GetController{
        static public function obtenerDatos($tabla, $select, $orderBy, $orderMode){
            $respuesta=GetModel::obtenerDatos($tabla, $select, $orderBy, $orderMode);
            return $respuesta;
        }

        static public function obtenerDatosFiltro($tabla2, $select2, $where2, $equalTo2, $groupBy, $orderBy2, $orderMode2, $limite){
            $respuesta=GetModel::obtenerDatosFiltro($tabla2, $select2, $where2, $equalTo2, $groupBy, $orderBy2, $orderMode2, $limite);
            return $respuesta;
        }
    }