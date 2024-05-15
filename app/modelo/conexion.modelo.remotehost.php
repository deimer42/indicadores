<?php
    class Conexion{
        static public function infoBaseDatos(){
            $infoDb=array('database'=>'if0_36542612_indicadores','user'=>'if0_36542612','password'=>'QExTf8TmBh');
            return $infoDb;
        }

        static public function conectar(){
            try{
                $link=new PDO('mysql:host=sql204.infinityfree.com; dbname='.Conexion::infoBaseDatos()['database'], Conexion::infoBaseDatos()['user'], Conexion::infoBaseDatos()['password']);
                $link->exec("SET NAMES utf8");
            }catch(PDOException $e){
                die("Error: ".$e->getMessage());
            }
            return $link;
        }
    }

    