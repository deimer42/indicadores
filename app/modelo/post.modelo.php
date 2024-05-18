<?php
    require_once 'conexion.modelo.php';
    class PostModel{
        static public function inserciones($table, $data){
            $conectar=Conexion::conectar();

            //1.2. Obtener las columnas enviadas por el array $datos
            $columnas="";
            $valores="";
            foreach($data as $key=>$value){
                $columnas.=$key.",";
                $valores.=":".$key.","; // Los valores seran las mismas :columnas. La asignacion se hara en el bindParam()
            }
            $columnas=substr($columnas, 0, -1); //quitar las "," al final de la cadena (limpiar la cadena)
            $valores=substr($valores, 0, -1);

            //2. Se forma la consulta
            $sql="INSERT INTO $table($columnas) VALUES($valores)";
            $query=$conectar->prepare($sql);

            //3. Hacer la asignacion de cada valor a cada columna con bindParam() descomponiendo el array $data
            foreach($data as $key=>$value){
                $tipoParametro=is_numeric($data[$key]) ? PDO::PARAM_INT : PDO::PARAM_STR;
                $query->bindParam(":".$key, $data[$key], $tipoParametro); //$key contiene el nombre de la columna y $data[$key] trae el valor POST para esa columna
            }

            //4. Ejecucion y respuesta positiva o negativa
            try{
                $query->execute();
                $respuesta=array(
                    "ultimoId"=>$conectar->lastInsertId(), //No se necesita para nada
                    "tipoAviso"=>"success", //para formar el alert de bootstrap
                    "comentario"=>"Registro guardado correctamente" //Contenido del alert de bootstrap
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