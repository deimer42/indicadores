<?php
    require_once 'conexion.modelo.php';
    class PutModel{
        static public function editar($tabla, $datos, $where, $equalTo){
            $conectar=Conexion::conectar();
            $whereArray=explode(",",$where); // asi viene whereArray: id_usuario_medicion,id_medicion
            $equalToArray=explode(",",$equalTo);

            //descomponemos el array $datos para acceder a sus claves y formar parte de la consulta SQL
            $set="";
            if(count($datos)>0){
                foreach($datos as $key=>$value){
                    $set.=$key."=:".$key.",";
                }
                $set=substr($set,0,-1); //para eliminar la ultima coma (,)
            }
           
            //descomponemos el array $whereArray para acceder a los nombres de los campos que serviran de filtro en el WHERE
            $textoWhere="";
            if(count($whereArray)>0){
                foreach($whereArray as $key=>$value){
                    $textoWhere.=$value."=:".$value." AND ";
                }
                $textoWhere=substr($textoWhere,0,-4); //para eliminar el ultimo AND
            }

            $sql="UPDATE $tabla SET $set WHERE $textoWhere";
            $query=$conectar->prepare($sql);

            foreach($datos as $key=>$value){
                $query->bindParam(":".$key, $datos[$key],PDO::PARAM_STR);
            }
            foreach($whereArray as $key=>$value){
                $query->bindParam(":".$value, $equalToArray[$key],PDO::PARAM_STR);
            }

            try{
                $query->execute();
                $respuesta=array(
                    "tipoAviso"=>"success",
                    "comentario"=>"Registro modificado correctamente"
                );
                return $respuesta;
            }catch(PDOException $e){
                $mensajeError=$e->getMessage();
                $respuesta=array(
                    "tipoAviso"=>"danger",
                    "comentario"=>"Error: ".$mensajeError
                );
                return $respuesta;
            }
        }
    }