<?php
    class Conexion{
        static public function infoBaseDatos(){
            $infoDb=array(
                'database'=>'indicadores',
                'user'=>'root',
                'password'=>''
            );
            return $infoDb;
        }

        static public function conectar(){
            try{
                $link=new PDO('mysql:host=localhost; dbname='.Conexion::infoBaseDatos()['database'], Conexion::infoBaseDatos()['user'], Conexion::infoBaseDatos()['password']);
                $link->exec("SET NAMES utf8");
            }catch(PDOException $e){
                die("Error: ".$e->getMessage());
            }
            return $link;
        }
    }

    