<?php
    require_once 'conexion.modelo.php';
    class GetModel{
        static public function obtenerDatos($tabla, $select, $orderBy, $orderMode){
            $conectar=Conexion::conectar();
            $sql="SELECT $select FROM $tabla ORDER BY $orderBy $orderMode";
            $query=$conectar->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_CLASS);
        }

        static public function obtenerDatosFiltro($tabla2, $select2, $where2, $equalTo2, $groupBy, $orderBy2, $orderMode2, $limite){
            $conectar=Conexion::conectar();

            //1. Separar el contenido de $where y $equalToArray en un array
            $whereArray=explode(",",$where2); //$where= columna,columna,columna
            $equalToArray=explode(",",$equalTo2); ////$equalTo2= valor,valor,valor

            //2. Formar la cadena del WHERE para la consulta SQL solo si hay mas de 1 elementos en $whereArray
            $textoWhere="";
            if(count($whereArray)>1){
                foreach($whereArray as $key=>$value){
                    if($key>0){
                        $textoWhere.="AND ".$value."=:".$value." ";
                    }
                }
            }

            //3. Formar la consulta SQL
            if(empty($groupBy)){ //si $where solo trae un elemento, $whereArray tambien osea que $textoWhere queda vacio no afectando la consulta SQL
                $sql="SELECT $select2 FROM $tabla2 WHERE $whereArray[0]=:$whereArray[0] $textoWhere ORDER BY $orderBy2 $orderMode2 LIMIT $limite";
            }else{
                $sql="SELECT $select2 FROM $tabla2 WHERE $whereArray[0]=:$whereArray[0] $textoWhere GROUP BY $groupBy ORDER BY $orderBy2 $orderMode2 LIMIT $limite";
            }
            $query=$conectar->prepare($sql);

            //4. Asignacion de valores a las columnas con bindParam
            foreach($whereArray as $key=>$value){
                $query->bindParam(":".$value, $equalToArray[$key], PDO::PARAM_STR); //$key son los indices numericos, $value contiene los nombres de las columnas y $equalToArray[$key] los valores
            }

            //5. Ejecucion de la consulta y despliegue de resultados obtenidos
            $query->execute();
            return $query->fetchAll(PDO::FETCH_CLASS);
        }

        // static public function obtenerDatosVariasTablas($tabla, $tabla2, $select, $where, $equalTo, $orderBy, $orderMode){
        //     $sql="SELECT $select FROM $tabla INNER JOIN $tabla2 WHERE mediciones.id_usuario_medicion=1 AND mediciones.ano=2024 AND mediciones.mes=05 AND mediciones.id_indicador_medicion=indicadores.id_indicador";
        // }
    }