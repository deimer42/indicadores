<?php
    class Conexion{
        static public function infoBaseDatos(){
            $infoDb=array(
                'hostBd'=>"localhost",
                'database'=>"indicadores",
                'user'=>"root",
                'password'=>""
            );
            return $infoDb;
        }

        static public function conectar(){
            try{
                $infoDb = Conexion::infoBaseDatos();
                $link=new PDO('mysql:host='.$infoDb['hostBd'].'; dbname='.$infoDb['database'], $infoDb['user'], $infoDb['password']);
                $link->exec("SET NAMES utf8");
            }catch(PDOException $e){
                die("Error: ".$e->getMessage());
            }
            return $link;
        }
    }
    