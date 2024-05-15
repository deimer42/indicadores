<?php
     function encriptadoDesencriptado($comando, $datoSensible, $naturalezaDato){
         $dato;
         $pass;
         switch($naturalezaDato){
             case 'usuario':
             $pass='1995@kJ51C::';
             break;

            //  case 'empresa':
            //  $pass='crearEmpresa0056_@-';
            //  break;

            //  case 'tercero':
            //  $pass='crearTercero@557893-_Bvxs';
            //  break;

            //  case 'campoHidden':
            //  $pass='Hidenizados@674987-_*/53';
            //  break;

            //  case 'variableEntorno':
            //  $pass='variableEntorno@6749variableEntorno87-_*/53';
            //  break;
            }

         if($comando=='encriptar'){
             $sal=openssl_random_pseudo_bytes(16);
             $sal_encode=base64_encode($sal);
             $concatenado=$sal_encode.$datoSensible;
             $dato=openssl_encrypt($concatenado,'AES-256-CBC',$pass,0,'1234567890123456'); 
            }

         elseif($comando=='desencriptar'){
             $datoOperado=openssl_decrypt($datoSensible, 'AES-256-CBC', $pass, 0, '1234567890123456');
             $dato=substr($datoOperado,24);
            }
         return $dato;
     }